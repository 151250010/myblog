<template>
  <my-content>
    <div class="main-content">

      <div class="bg-img">    
        <md-layout>
          <md-layout>
              <div class="bg">
                <div class="word">
                  <a href="http://software.nju.edu.cn/" target="_blank">南京大学软件学院</a>大二学生
                  <br>
                  <a href="http://lol.qq.com/" target="_blank">LoL</a>er
                  <br>
                  想做全栈
                </div>
              </div>
          </md-layout>
        </md-layout>
      </div>


    </div>
  </my-content>
</template>

<style scoped>
 @media(max-width: 500px){
     .bg-img{
      background-image: url('../assets/03.jpg');
     }
}

 @media(min-width: 500px){
    .bg-img{
      background-image:url('../assets/joker-3.jpg');
    }
}

  @media(min-width:760px ){
     .word{
      margin-left: 200px;
     }
  }

.bg-img{

   background-position:center;
  width:100%;height:100%;
  background-repeat:repeat-X;
  background-size:cover;
  background-attachment:fixed;
 /* -webkit-filter: blur(2px);
  -moz-filter: blur(2px);
  -o-filter: blur(2px);
  -ms-filter: blur(2px);
  filter: blur(2px);*/
}

.word{
 /* border: 1px solid #80b2ff;*/
 border-radius: 5px;
 background-color: #fff;
  opacity: 0.5;
  font-size: 30px;
  margin-top: 80px;
  padding-left: 50px;
  padding-right: 50px;
  line-height: 50px;
  color:#404040;
}

.md-theme-default a:not(.md-button){
  color:#4078c0;
}

.md-theme-default a:not(.md-button):hover{
  color:#1cb495 !important;
}

</style>
