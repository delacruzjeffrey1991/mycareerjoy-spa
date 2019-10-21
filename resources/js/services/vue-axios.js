import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
Vue.use(VueAxios, axios);

window.axios = axios;

/* Allows Us To Authorized Api Request If Authenticated Using Web Middleware */
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
/* Set The Token if Present So We Can Authorize Request */
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
  console.error(
    "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
  );
}

window.axios.interceptors.response.use(
  response => {
    return response;
  },
  error => {
    switch (error.response.status) {
      case 401:
        window.location.href = '/login';
        break;
      case 402:
        if (error.response.data.errors){
          for(let key in error.response.data.errors){
            vm.$validator.errors.add({field: key, msg: error.response.data.errors[key]})
          }
        } 
        break;
      case 422:
        if (error.response.data.errors){
          for(let key in error.response.data.errors){
            vm.$validator.errors.add({field: key, msg: error.response.data.errors[key]})
          }
        } 
        break;
    }
    return Promise.reject(error);
  }
);