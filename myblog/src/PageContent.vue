<template>
  <div class="page-content">
      <md-button class="md-icon-button nav-trigger" @click.native="toggleSidenav">
        <md-icon md-src="./dist/icon-menu.png"></md-icon>
      </md-button>
    <slot></slot>
  </div>
</template>

<style lang="sass" scoped>
  .page-content {
    min-height: 100%;
    max-height: 100%;
    flex: 1;
    display: flex;
    flex-flow: column
  }

  .nav-trigger {

    margin-top:10px;
    @media (min-width: 1281px) {
      display: none;
    }
  }


</style>

<script>
  export default {
    methods: {
      toggleSidenav() {
        this.$root.toggleSidenav();
      }
    }
  };
</script>
