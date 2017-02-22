
import introduction from './components/Introduction.vue'
import bloglist from './components/BlogList.vue'
import message from './components/Message.vue'
import contact from './components/Contact.vue'
import article from './components/Article.vue'

export default [
{path:'/',component:bloglist},
{path:'/bloglist',component:bloglist},
{path:'/introduction',component:introduction},
{path:'/message',component:message},
{path:'/contact',component:contact},
{path:'/article/:id',component:article}]