<template>
	<my-content>
		<div class="main-content">
		  <md-snackbar md-position="top center" ref="snackbar" :md-duration="4000">
		    <span>发表留言成功!可以在留言列表底看到最新留言</span>
		    <md-button class="md-primary" @click.native="$refs.snackbar.close()">好的</md-button>
		  </md-snackbar>

			<md-dialog md-open-from=".showDialog" md-close-to=".showDialog" ref="dialog_message">
				<md-dialog-title>输入主题和留言：</md-dialog-title>

				<md-dialog-content>
				   <form action="">
					<md-input-container>
					    <label>输入主题：</label>
						<md-textarea v-model="title"></md-textarea>
					</md-input-container>

					<md-input-container>
					    <label>留言：</label>
						<md-textarea v-model="message"></md-textarea>
					</md-input-container>
				   </form>
				</md-dialog-content>

				  <md-dialog-actions>
				    <md-button class="md-primary" @click.native="closeDialog('dialog_message')">取消</md-button>
				    <md-button class="md-primary" @click.native="add(),closeDialog('dialog_message')">发表</md-button>
				  </md-dialog-actions>
			</md-dialog>


		  	<md-button class="md-warn md-raised large" @click.native="openDialog('dialog_message')">
			  	我要留言
		  	</md-button>
	

	  	  <md-snackbar md-position="top center" ref="snackbar_agree" :md-duration="4000">
		    <span>点赞成功!</span>
		    <md-button class="md-primary" @click.native="$refs.snackbar_agree.close()">好的</md-button>
		  </md-snackbar>

		  <md-snackbar md-position="top center" ref="snackbar_comment" :md-duration="4000">
		    <span>评论成功!</span>
		    <md-button class="md-primary" @click.native="$refs.snackbar_comment.close()">好的</md-button>
		  </md-snackbar>


  		<md-dialog md-open-from=".showDialog" md-close-to=".showDialog" ref="dialog">
			<md-dialog-title>请输入评论：</md-dialog-title>

			<md-dialog-content>
			   <form action="">
				<md-input-container>
				    <label>输入评论：</label>
					<md-textarea v-model="comment"></md-textarea>
				</md-input-container>
			   </form>
			</md-dialog-content>

			  <md-dialog-actions>
			    <md-button class="md-primary" @click.native="closeDialog('dialog')">取消</md-button>
			    <md-button class="md-primary" @click.native="addComment(),closeDialog('dialog')">发表</md-button>
			  </md-dialog-actions>
		</md-dialog>


		  <md-list>
		  	<md-list-item v-for="(json,index) in messages" class="message">
		  		<md-card>
		  			<md-card-header>
		  				<div class="md-title">
		  					{{json.title}}
		  				</div>
		  				<div class="md-subhead">
		  					{{json.date}}
		  				</div>
		  				<br>
		  				<div class="md-subhead">
		  					{{json.content}}
		  				</div>
		  			</md-card-header>

		  			<md-card-actions>
			  			    <md-button class="md-raised md-primary" @click.native="agree(index,json.agree)">点赞<span>{{json.agree}}</span></md-button>
			  			    <md-button class="md-raised md-warn" @click.native="openDialog('dialog'),select(index)">评论</md-button>
			  		</md-card-actions>

			  		<md-card-content>
			  		    <hr>
			  			<p style="color:#e91e63" class="md-headline">全部评论:</p>
			  		</md-card-content>

		  			<md-card-content v-for="comment in json.comments">
		  					{{comment}}
		  			</md-card-content>
		  		</md-card>
		  	</md-list-item>
		  </md-list>
		</div>
	</my-content>
</template>

<script>
	export default{
		data(){
			return {
				messages:[],
				comment:'',
				selectedid:-1,
				title:'',
				message:''
				// preNum:0
			}
		},
		methods:{
			agree(index,preNum){
				const self =this;
				// //记录点赞的id
				// self.selectedid=index;
				// self.preNum=preNum;

				//调用后端接口，改变数据库中赞的数目
				this.axios.get('server/message.php',{
					params:{
						act:'agree',
						id:index,
						number:preNum+1
					}
				}).then(function(response){
                    if(response.data.error==0){

                    	//成功的话 弹窗提示
                    	self.$refs.snackbar_agree.open();

                    	//?????????????????????????????????不确定能不能修改
                    	//改变列表中赞的数目
                    	self.messages[index].agree=preNum+1;
                    }else{
                    	conso.log(response.data.error);
                    }
				}).catch(function(error){
					alert(error.data);
				})
			},
			openDialog(ref){
				this.$refs[ref].open();
			},
			closeDialog(ref){
				this.$refs[ref].close();
			},
			//回复时选定id
			select(index){
				this.selectedid=index;
			},
			addComment(){
				const self = this;
				this.axios.get('server/message.php',{
					params:{
						act:'addComment',
						id:self.selectedid,
						newComment:self.comment
					}
				}).then(function(response){
                    if(response.data.error==0){
                    	self.$refs.snackbar_comment.open();
                    	console.log()
                    	self.messages[self.selectedid].comments.push(self.comment);//修改列表显示内容

                    	//清零
                    	self.comment='';
                    	self.selectedid=-1;
                    }
				}).catch(function(error){
					alert(error.data);
				})
			},
			add(){
				const self = this;
				const id=self.messages.length;

				this.axios.get('server/message.php',{
					params:{
						act:'addMessage',
						id:id,
						title:self.title,
						date:self.getCurrentDate(),
						content:self.message
					}
				}).then(function(response){
					if(response.data.error==0){
						var json ={
							id:id,
							title:self.title,
							date:self.getCurrentDate(),
							content:self.message,
							agree:0,
							commens:[]
						};

						self.messages.push(json);
						self.$refs.snackbar.open();
						self.title='';
						self.message='';
					}else{
						alert(reponse.data.error);
					}
				}).catch(function(error){
					alert(error.data);
				});
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
		},
		mounted(){
			const self = this;
			this.axios.get('server/message.php',{
				params:{
					act:'getMessages'
				}
			}).then(function(response){
				self.messages=response.data.slice();
			}).catch(function(error){
				alert(error.data)
			})
		}
	}
</script>

<style scoped>
	.message{
		margin-top:30px;
	}

	.md-card{
		width: 100%;
	}

	.large{
		margin-left:16px;
	}
</style>