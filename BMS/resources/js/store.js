import axios from 'axios';
import vuex from 'vuex'
import Vue from 'vue';

Vue.use(vuex)

export default new vuex.Store({
     state :{
    
        userInfos: false,
    },
    
    getters: {
    
        loginData() {
            return state.userInfos
        },
    },
    
    mutations: {
    
        updateUser(state, data){
            state.userInfos = data
        }
    
    },

    actions: {
    
    },
})