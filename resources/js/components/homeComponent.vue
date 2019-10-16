<template>
    <div v-if="fetched" class="col-sm8">
        <div id="poptrox">
            <ul id="gallery">
                <li class="nopad" v-for="review of reviews" v-bind:key="review.id">
                    <div class="img-thumbnail">
                        <router-link tag="a" :to="{path: '/detailreview/'+review.user_id+'/'+review.id}"><img :src="'/uploads/'+review.foto" width="350" height="250"></router-link>
                        <router-link tag="a" :to="{path: '/detailreview/'+review.user_id+'/'+review.id}"><h3 align="center">{{review.judul}}</h3></router-link>
                    </div>
                </li>
                <li class="nopad" v-for="recipe of recipes" v-bind:key="recipe.id">
                    <div class="img-thumbnail">
                        <router-link tag="a" :to="{path: '/detailrecipe/'+recipe.user_id+'/'+recipe.id}"><img :src="'/uploads/'+recipe.foto" width="350" height="250"></router-link>
                        <router-link tag="a" :to="{path: '/detailrecipe/'+recipe.user_id+'/'+recipe.id}"><h3 align="center">{{recipe.judul}}</h3></router-link>
                    </div>
                </li>
                <li class="nopad" v-for="cafe of cafes" v-bind:key="cafe.id">
                    <div class="img-thumbnail">
                        <router-link tag="a" :to="{path: '/detailcafe/'+cafe.user_id+'/'+cafe.id}"><img :src="'/uploads/'+cafe.foto" width="350" height="250"></router-link>
                        <router-link tag="a" :to="{path: '/detailcafe/'+cafe.user_id+'/'+cafe.id}"><h3 align="center">{{cafe.nama}}</h3></router-link>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div v-else class="push"></div>
</template>

<script>
import axios from 'axios'
export default {
    data(){
        return{
            reviews: [],
            recipes: [],
            cafes: [],
            fetched: false
        }
    },
    created(){
        axios.get('/api/review').then((result) => {
            this.reviews=result.data
        }).catch((err) => {
            console.log('Error mengambil data review');
        });
        axios.get('/api/recipe').then((result) => {
            this.recipes=result.data
        }).catch((err) => {
            console.log('Error mengambil data recipe');
        });
        axios.get('/api/cafe').then((result) => {
            this.cafes=result.data
            this.fetched=true
        }).catch((err) => {
            console.log('Error mengambil data cafe');
        });
    },

}
</script>

<style scoped>
    .push {
        margin-bottom: 500px;
    }
</style>

