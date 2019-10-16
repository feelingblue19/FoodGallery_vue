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
            </ul>
        </div>
    </div>
    <div v-else class="push"></div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      reviews: [],
      fetched: false
    };
  },
  created() {
    axios
      .get("/api/review")
      .then(result => {
        this.reviews = result.data;
        this.fetched = true
      })
      .catch(err => {
        console.log("Error mengambil data review");
      });
  }
};
</script>

<style scoped>
.push {
        margin-bottom: 500px;
    }
</style>
