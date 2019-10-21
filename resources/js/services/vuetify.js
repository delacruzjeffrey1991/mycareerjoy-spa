import Vue from 'vue';
//import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import 'material-design-icons-iconfont/dist/material-design-icons.css' // Ensure you are using css-loader
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'


Vue.use(Vuetify)

export default new Vuetify({
  icons: {
    iconfont: 'md', // default - only for display purposes
  },
  theme: {
    themes: {
      light: {
        primary: '#9652ff',
        success: '#3cd1c2',
        info: '#ffaa2c',
        error: '#f83e70'
      }
    }
  }
})