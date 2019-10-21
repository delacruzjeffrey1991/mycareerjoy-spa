export default {
    register(payload){
        return axios.post('register', payload);
    },

    login(payload){
        return axios.post('login', payload);
    },

    resetPassword(payload){

    },

    logout(){
        return axios.post('logout');
    }
}