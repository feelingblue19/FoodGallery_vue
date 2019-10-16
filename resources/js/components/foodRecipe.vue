<template>
    <div v-if="fetched" class="col-sm8">
        <div id="poptrox">
            <ul id="gallery">
                <li class="nopad" v-for="recipe of recipes" v-bind:key="recipe.id">
                    <div class="img-thumbnail">
                        <router-link tag="a" :to="{path: '/detailrecipe/'+recipe.user_id+'/'+recipe.id}"><img :src="'/uploads/'+recipe.foto" width="350" height="250"></router-link>
                        <router-link tag="a" :to="{path: '/detailrecipe/'+recipe.user_id+'/'+recipe.id}"><h3 align="center">{{recipe.judul}}</h3></router-link>
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
            recipes: [],
            fetched: false
        }
    },
    created(){
        axios.get('/api/recipe').then((result) => {
            this.recipes=result.data
            this.fetched=true
        }).catch((err) => {
            console.log('Error mengambil data review');
        });
    }
}
</script>

<style scoped>
    .push {
        margin-bottom: 500px;
    }
</style>
