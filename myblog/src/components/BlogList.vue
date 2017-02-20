<template>
	<my-content>
		<div class="main-content">
		    <md-card class="blog">
			  <md-card-header>
			    <div class="md-title">当老天赐给你一片荒野时，就意味着，他要你成为一只高飞的鹰。</div>
			    <div class="md-subhead">---简捷</div>
			  </md-card-header>
			</md-card>

			<router-link to="/article/001"  class="concreteBlog">
				<md-card md-with-hover class="blog">
				  <md-card-header>
				    <div class="md-title">血泪交织！聊聊搭建博客php后端踩过的坑</div>
				    <div class="md-subhead">2017-02-20 11:52:01</div>
				  </md-card-header>

				  <md-card-content>
				    网页前端与后端之间如何交互，用php作为后端连接数据库需要注意哪些问题。
				    网页一般都是前后端分离，前端需要数据的时候可以通过后端提供的接口传递准确参数，以GET,POST等方式与后端进行交互，然后提供一个回调函数来对得到的数据进行处理。
				  </md-card-content>

				</md-card>
			</router-link>


			<md-card md-with-hover class="blog">
			  <md-card-header>
			    <div class="md-title">欢迎来到这里</div>
			    <div class="md-subhead">这个是副标题</div>
			  </md-card-header>

			  <md-card-content>
			    这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字。
			  </md-card-content>

			</md-card>

			<md-card md-with-hover class="blog">
			  <md-card-header>
			    <div class="md-title">欢迎来到这里</div>
			    <div class="md-subhead">这个是副标题</div>
			  </md-card-header>

			  <md-card-content>
			    这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字。
			  </md-card-content>
			</md-card>

			<md-card md-with-hover class="blog">
			  <md-card-header>
			    <div class="md-title">欢迎来到这里</div>
			    <div class="md-subhead">这个是副标题</div>
			  </md-card-header>

			  <md-card-content>
			    这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字。
			  </md-card-content>
			</md-card>

			<md-card md-with-hover class="blog">
			  <md-card-header>
			    <div class="md-title">欢迎来到这里</div>
			    <div class="md-subhead">这个是副标题</div>
			  </md-card-header>

			  <md-card-content>
			    这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字，这是一段测试文字。
			  </md-card-content>
			</md-card>
		</div>
	</my-content>
</template>

<script>
	export default{
		data(){
			return{

			}
		}
	}
</script>
<style>
	.blog{
       margin-bottom: 20px;
	}

	.concreteBlog{
		text-decoration: none;
	}

	.md-theme-default a:not(.md-button){
		color:inherit;
	}

	.md-theme-default a:not(.md-button):hover{
		text-decoration: none;
	}
</style>