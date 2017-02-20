<?php 
// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');

// 响应类型
header('Access-Control-Allow-Methods:GET,POST,PUT');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header("content-type:application/json"); 
/*
提供两个接口，增加评论和获取评论信息
传递参数时候加上act:get or add
传递articleId 需要大写I
get返回的是json数组
add传递的需要是json格式： {author:'',repliedone:'',date:'',isreply:0,comment:''} 参数名data 和参数名artiicleId

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
	case 'get':
	    $articleId=$_GET['articleId'];
	    $sql="select * from comment where articleid={$articleId}";
	    $res=mysql_query($sql);
	    $final=array();
	    while($row=mysql_fetch_array($res)){
	    	$arr=array();
			array_push($arr, '"articleId":"'.$row[0].'"');
			array_push($arr, '"author":"'.$row[1].'"');
			array_push($arr, '"repliedone":"'.$row[2].'"');
			array_push($arr, '"date":"'.$row[3].'"');
			array_push($arr, '"isreply":'.$row[4]);
			array_push($arr, '"comment":"'.$row[5].'"');
			
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
	
	case 'add':

	    $articleId=$_GET['articleId'];

	    //记住decode 将json转化
	    // $data=json_decode(urldecode($_GET['data']));
	    // $author=$data->author;
	    // $repliedone=$data->repliedone;
	    // $date=$data->date;
	    // $isreply=$data->isreply;
	    // $comment=$data->comment;
	    
	    // 直接使用json里面参数名获取数据
	    $author=$_GET['author'];
	    $repliedone=$_GET['repliedone'];
	    $date=$_GET['date'];
	    $isreply=$_GET['isreply'];
	    $comment=$_GET['comment'];

	    $sql="insert into comment (articleid,author,repliedone,date,isreply,comment) values ('{$articleId}','{$author}','{$repliedone}','{$date}',{$isreply},'{$comment}')";
        mysql_query($sql);
		// echo "{\"error\": 0, \"author\": {$author}, \"comment\": {$comment},\"articleid\": {$articleId}}";
        echo 'success';
        break; 
}

mysql_close($db);
 ?>
