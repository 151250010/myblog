<template>
<my-content>
	<div class="main-content">

	  <md-snackbar md-position="top center" ref="snackbar" :md-duration="4000">
	    <span>发表评论成功!可以在评论列表底看到最新评论</span>
	    <md-button class="md-primary" @click.native="$refs.snackbar.close()">好的</md-button>
	  </md-snackbar>

		<md-dialog md-open-from=".showDialog" md-close-to=".showDialog" ref="dialog6">
			<md-dialog-title>输入你的简称和发表评论：</md-dialog-title>

			<md-dialog-content>
			   <form action="">
				<md-input-container>
				    <label>输入简称：</label>
					<md-textarea v-model="name"></md-textarea>
				</md-input-container>

				<md-input-container>
				    <label>你的评论：</label>
					<md-textarea v-model="newComment"></md-textarea>
				</md-input-container>
			   </form>
			</md-dialog-content>

			  <md-dialog-actions>
			    <md-button class="md-primary" @click.native="closeDialog('dialog6')">取消</md-button>
			    <md-button class="md-primary" @click.native="add(),closeDialog('dialog6')">发表</md-button>
			  </md-dialog-actions>
		</md-dialog>

		<md-whiteframe class="whiteframe">
			<md-card>
		  <md-card-content>
		    <div v-html="content"></div>
		  </md-card-content>
		  <md-card-actions>
		  	<md-button class="md-primary md-raised" @click.native="openDialog('dialog6')">发表评论</md-button>
		  </md-card-actions>
		</md-card>

		<md-card v-for="json in comments" class="comment">
			<md-card-header v-if="json.isreply==0">
				<div class="md-title">
					{{json.author}}&nbsp;发表评论:
				</div>
				<div class="md-subhead">
					{{json.date}}
				</div>
			</md-card-header>

			<md-card-header v-else>
				<div class="md-title">
					{{json.author}}&nbsp;回复&nbsp;{{json.repliedone}}:
				</div>
				<div class="md-subhead">
					{{json.date}}
				</div>
			</md-card-header>

			<md-card-content>
				{{json.comment}}
			</md-card-content>

			  <md-card-actions>
			    <md-button class="md-primary md-raised showDialog" @click.native="reply(json.author),openDialog('dialog6')">回复</md-button>
			    <md-button @click.native="report">举报</md-button>
			  </md-card-actions>
		</md-card>
		</md-whiteframe>
	</div>
</my-content>
</template>

<script>
	export default{
		data(){
			return{
				content:'',
				articleId:this.$route.params.id,
				comments:[{
					author:'123',
					repliedone:'123',
					comment:'123'
				}],
				repliedOne:'',
				newComment:'',
				name:''
			}
		},
		mounted(){
			// 这里存在一个this指向问题
		   const self = this;
           var articleId = self.$route.params.id +'.html';
           
           //读取blog内容
           this.axios.get('static/blogs/'+articleId).then(function(response){
           	   self.content=response.data;
           }
           ).catch(function(error){
           	   self.content=error.data;
           });

           //从数据库读取blog评论
           this.axios.get('server/comment.php',{
           	params:{
           		articleId:self.articleId,
           		act:'get'
           	}
           }).then(function(response){
           	self.comments=response.data.slice();
           }).catch(function(error){
           })
		},
		methods:{
			reply(repliedOne){
				this.repliedOne=repliedOne
			},
			report(){
				alert("好的，举报成功")
			},
		    openDialog(ref) {
		      this.$refs[ref].open();
		    },
		    closeDialog(ref) {
		      this.$refs[ref].close();
		    },
		    onOpen() {
		      console.log('Opened');
		    },
		    onClose(type) {
		      console.log('Closed', type);
		    },
		    add(){
		    	if(this.repliedOne==''){
		    		//添加数据到数据库
		    		const self = this;
		    		this.axios.get('server/comment.php',{
		    			params:{
		    				act:'add',
		    				articleId:self.articleId,
			    			author:self.name,
			    			comment:self.newComment,
			    			isreply:0,
			    			repliedone:'',
			    			date:self.getCurrentDate()
		    			}
		    		}).then(function(response){
		    			if(response.data=='success'){
		    				self.openSnack();
				    		var json = {
				    			author:self.name,
				    			comment:self.newComment,
				    			isreply:0,
				    			repliedone:'',
				    			date:self.getCurrentDate()
				    		};

				    		self.comments.push(json);

				    		self.name='';
				    		self.newComment='';
		    			}else{
		    				alert('出现了未知的错误');
		    				self.repliedOne='';
		    			}
		    		}).catch(function(error){
		    			alert(error.data);
		    		})
		    	}else{
		    		//添加数据到数据库
		    		const self = this;
		    		this.axios.get('server/comment.php',{
		    			params:{
		    				act:'add',
		    				articleId:self.articleId,
			    			author:self.name,
			    			comment:self.newComment,
			    			isreply:1,
			    			repliedone:self.repliedOne,
			    			date:self.getCurrentDate()
		    			}
		    		}).then(function(response){
		    			if(response.data == 'success'){
		    				self.openSnack();
				    		var json2 ={
				    			author:self.name,
				    			comment:self.newComment,
				    			isreply:1,
				    			repliedone:self.repliedOne,
				    			date:self.getCurrentDate()
				    		};

				    		self.comments.push(json2);

				    		self.name='';
				    		self.newComment='';
		    			}else{
		    				console.log(response.data);
		    				self.repliedOne='';
		    				alert('出现了未知的错误')
		    			}
		    		}).catch(function(error){
		    			alert(error.data);
		    		})
		    	}
		    },
		    openSnack(){
		    	this.$refs.snackbar.open();
		    },
		    getCurrentDate(){
		    	var date = new Date();
			    var seperator1 = "-";
			    var seperator2 = ":";
			    var month = date.getMonth() + 1;
			    var strDate = date.getDate();
			    if (month >= 1 && month <= 9) {
			        month = "0" + month;
			    }
			    if (strDate >= 0 && strDate <= 9) {
			        strDate = "0" + strDate;
			    }
			    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
			            + " " + date.getHours() + seperator2 + date.getMinutes()
			            + seperator2 + date.getSeconds();
			    return currentdate;
		    }
		}
	}
</script>

<style scoped>
.comment{
	margin-top: 20px;
}

.whiteframe{
    margin-left: -10px;
}
</style>