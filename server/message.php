<?php 
// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');

// 响应类型
header('Access-Control-Allow-Methods:GET,POST,PUT');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header("content-type:application/json"); 

/*
提供三个接口，增加评论和获取评论信息
传递参数时候加上act:agree or getMessages or addComment
agree()传参数act id number 返回error:0
getMessages() 传参数 act 返回json数组
addComment() 传参数act id newComment 返回error:0
addMessage() 传参数act id title date content 返回error:0
 */

 $mysql_database='blog_comment';

// 连接数据库
 $db=@mysql_connect('localhost', 'root', 'mysql');

// 记住需要加上一句设置编码
mysql_query("set names 'utf8'");

mysql_select_db($mysql_database);

//开始提供接口
$act=$_GET['act'];

switch ($act) {
	case 'getMessages':
	    $sql="select * from message";
	    $res=mysql_query($sql);
	    $final=array();
	    while($row=mysql_fetch_array($res)){
	    	$arr=array();
			array_push($arr, '"id":'.$row[0]);
			array_push($arr, '"title":"'.$row[1].'"');
			array_push($arr, '"date":"'.$row[2].'"');
			array_push($arr, '"content":"'.$row[3].'"');
			array_push($arr, '"agree":'.$row[4]);

			//用'/'分割评论 得到数组 例如['a','b']
			$arr_comment=explode("/", $row[5]);

			//合并评论形成 a","b
			$allComments=implode('","',$arr_comment);

			//首位加上[] 形成[a,b]
			$tobeImplode='["'.$allComments.'"]';

			array_push($arr, '"comments":'.$tobeImplode);
			
			//将数组元素合并加入到final数组中
			array_push($final, implode(',', $arr));
	    }

	    //将最终数组元素形成json数组发送
	    if(count($final)>0){
			echo '[{'.implode('},{', $final).'}]';
	    }else{
	    	echo '[]';
	    }
		break;
	
	case 'agree':
		$id=(int)$_GET['id'];
		
		$res=mysql_query("SELECT agree FROM message WHERE ID={$id}");
		
		$row=mysql_fetch_array($res);
		
		$old=(int)$row[0]+1;
		
		$sql="UPDATE message SET agree={$old} WHERE id={$id}";
		
		mysql_query($sql);
		
		echo '{"error":0}';
		break;

	case 'addComment':
	    $id=(int)$_GET['id'];

	    $newComment=$_GET['newComment'];

	    $res=mysql_query("SELECT comments FROM message WHERE id={$id}");
		
		$row=mysql_fetch_array($res);

		if(!$row[0]){
            $sql="UPDATE message SET comments='{$newComment}' WHERE id={$id}";
            mysql_query($sql);
		}else{
			//拼凑的时候要加上“”
			$newC='"'.$row[0].'/'.$newComment.'"';
            $sql="UPDATE message SET comments={$newC} WHERE id={$id}";
            mysql_query($sql);			
		}

		echo '{"error":0}';
		break;

	case 'addMessage':

	    $id=(int)$_GET['id'];
	    $title=$_GET['title'];
	    $date=$_GET['date'];
	    $content=$_GET['content'];
	    $comments='';

	    $sql="insert into message (id,title,date,content,agree,comments) values ({$id},'{$title}','{$date}','{$content}',0,'{$comments}')";
	    mysql_query($sql);

		echo '{"error":0}';
		break;
}

mysql_close($db);
 ?>
