import Vue from 'vue'
import axios from 'axios';

require('./bootstrap')

require('vue');

const app = new Vue({
    el: '#app',
    data : {
        error : '',
        searchField : 'manila',
        weather: '',
        location : '',
        finalResults : 1
    },
    methods : {
        search : function(){
            axios.post(`/api/search-weather`, {
                searchField : this.searchField
            })
            .then(response => {
                this.weather = response.data.response
                this.finalResults = 1
            })
            .catch(e => {
                this.error = 'Oops something wen wrong'
                this.finalResults = 0
            })


            axios.post(`/api/search-location`, {
                searchField : this.searchField
            })
            .then(response => { 
                this.location = response.data.response.response.groups[0]
                this.finalResults = 1
            })
            .catch(e => {
                this.error = 'Oops something wen wrong'
                this.finalResults = 0
            })
        },
    },
    created(){
        this.search()
    }  
});