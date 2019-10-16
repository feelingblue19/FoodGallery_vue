<template>
    <div>
        <div v-if="fetched" class="col-sm8">
            <div id="poptrox">
                <ul id="gallery">
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
    </div>
</template>

<script>
export default {
    data(){
        return{
            cafes: [],
            fetched: false
        }
    },
    created(){
        axios.get('/api/cafe').then((result) => {
            this.cafes=result.data
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
