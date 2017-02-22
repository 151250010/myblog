<template>
  <div class="container">
    <md-sidenav class="main-sidebar md-left md-fixed" md-swipeable ref="main-sidebar">
      <md-toolbar class="vue-material-logo" md-theme="white">
        <router-link exact to="/introduction">
          <md-avatar class="md-large">
            <img src="./assets/04.jpg" alt="People">
          </md-avatar>
          <span class="lineBelowImage">Hello Guy</span>
        </router-link>
      </md-toolbar>

      <div class="main-sidebar-links">
        <md-list class="md-dense">
          <md-list-item class="bttn-fill">
            <router-link exact to="/bloglist">个人博客</router-link>
          </md-list-item>

          <md-list-item class="bttn-fill">
            <router-link exact to="/introduction">作者简介</router-link>
          </md-list-item>

          <md-list-item class="bttn-fill">
            <router-link exact to="/message">同城交友</router-link>
          </md-list-item>

          <md-list-item class="bttn-fill">
            <router-link exact to="/contact">和我联系</router-link>
          </md-list-item>
        </md-list>
      </div>
    </md-sidenav>

    <transition name="fade" appear enter-active-class="animated fadeIn">
      <router-view></router-view>
    </transition>
  </div>
</template>

<style lang="sass">

  $material-shadow-2dp: 0 1px 5px rgba(#000, .2),
                        0 2px 2px rgba(#000, .14),
                        0 3px 1px -2px rgba(#000, .12) !default;
  html,
  body {
    height: 100%;
    overflow: hidden;
  }

  body {
    display: flex;
  }

  .container {
    min-height: 100%;
    display: flex;
    flex-flow: column nowrap;
    flex: 1;
    /*transition: $swift-ease-out;*/

    @media (min-width: 1281px) {
      padding-left: 280px;
    }
  }

  .main-sidebar.md-sidenav {
    .md-sidenav-content {
      width: 280px;
      display: flex;
      flex-flow: column;
      overflow: hidden;

      @media (min-width: 1281px) {
        top: 0;
        pointer-events: auto;
        transform: translate3d(0, 0, 0);
        box-shadow: $material-shadow-2dp;
      }
    }

    
    .md-backdrop {
      @media (min-width: 1281px) {
        opacity: 0;
        pointer-events: none;
      }
    }
    

    .md-toolbar {
      min-height: 172px;
      border-bottom: 1px solid rgba(#000, .12);
    }

    .vue-material-logo {
      font-size: 24px;

      a {
        width: 100%;
        display: flex;
        flex-flow: column;
        justify-content: center;
        align-items: center;
        color: inherit;
        text-decoration: none;

        &:hover {
          color: inherit;
          text-decoration: none;
        }
      }

      img {
        width: 160px;
        margin-bottom: 16px;
      }
    }

    .main-sidebar-links {
      overflow: auto;
      flex: 1;
      
      .md-list{
        min-height:100%;
        display:flex;
      }

      .md-inset .md-list-item-container {

        padding-left: 50px;
      }

      .md-list-item-container {
       
        font-size: 20px;
        font-weight: 500;
      }

      .md-list-item a{
        min-height:100px;
        padding-left:33%;
      }

     }

  }

  .main-content {
    padding: 16px;
    flex: 1;
    overflow: auto;
    background-color: #fff;
   /*
    transform: translate3D(0, 0, 0);
    transition: $swift-ease-out;
    transition-delay: .2s;
    */
  }

  .md-button:hover:not([disabled]):not(.md-raised){
    background:none;
  }

  /*路由页面切换动画*/
  .animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }

  /*fadeIn動畫*/

@-webkit-keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

.fadeIn {
  -webkit-animation-name: fadeIn;
  animation-name: fadeIn;
}

/*fadeOut動畫*/
@-webkit-keyframes fadeOut {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
  }
}

@keyframes fadeOut {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
  }
}

.fadeOut {
  -webkit-animation-name: fadeOut;
  animation-name: fadeOut;
}

@-webkit-keyframes fadeOutDown {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
  }
}
span.lineBelowImage{
  margin-top:20px;
}


</style>

<script>
  import Vue from 'vue';

  export default {
    methods: {
      toggleSidenav() {
        this.$refs['main-sidebar'].toggle();
      },
      closeSidenav() {
        this.$refs['main-sidebar'].close();
      }
    }
  };
</script>
