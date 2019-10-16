<template>
    <div class="col-p">
        <div class="all">
            <div class="profile">
                <div class="col-sm">
                    <h2><img class="fotoP" src="../../../public/logo/icon.png" style="float: left;" />{{user.first_name}} {{user.last_name}}</h2>
                    <router-link tag="a" :to="{path: '/editprofile/'+user.id}" class="btn btn-edit">Edit Profil</router-link>
                </div>
            </div>
            <div class="col-sm-1">
                <h2>Konten</h2>
            </div>
            <div v-for="(review, index) of reviews" v-bind:key="review.id" class="konten">
                <div class="col-sm">
                    <router-link tag="a" :to="{path: '/detailreview/'+review.user_id+'/'+review.id}">
                        <h2>{{review.judul}}</h2>
                    </router-link>
                    <p style="white-space: pre-line">{{review.konten}}</p>
                    <router-link tag="a" :to="{path: '/editreview/'+review.id}" class="btn btnEK">Edit</router-link>
                    <a class="btn btnDK" @click="deleteReview(review.id, index)">Hapus</a>
                </div>
            </div>
            <div v-for="(recipe, index) of recipes" v-bind:key="recipe.id" class="konten">
                <div class="col-sm">
                    <router-link tag="a" :to="{path: '/detailrecipe/'+recipe.user_id+'/'+recipe.id}">
                        <h2>{{recipe.judul}}</h2>
                    </router-link>
                    <p style="white-space: pre-line">{{recipe.konten}}</p>
                    <router-link tag="a" :to="{path: '/editrecipe/'+recipe.id}" class="btn btnEK">Edit</router-link>
                    <a class="btn btnDK" @click="deleteRecipe(recipe.id, index)">Hapus</a>
                </div>
            </div>
            <div v-for="(cafe, index) of cafes" v-bind:key="cafe.id" class="konten">
                <div class="col-sm">
                    <router-link tag="a" :to="{path: '/detailcafe/'+cafe.user_id+'/'+cafe.id}">
                        <h2>{{cafe.nama}}</h2>
                    </router-link>
                    <p style="white-space: pre-line">{{cafe.konten}}</p>
                    <router-link tag="a" :to="{path: '/editcafe/'+cafe.id}" class="btn btnEK">Edit</router-link>
                    <a class="btn btnDK" @click="deleteCafe(cafe.id, index)">Hapus</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      reviews: [],
      recipes: [],
      cafes: [],
      user: {}
    };
  },
  methods: {
    deleteReview(id, index) {
      axios
        .delete("/api/review/delete/" + id)
        .then(result => {
          this.reviews.splice(index, 1);
          alert("Review berhasil dihapus");
        })
        .catch(err => {});
    },
    deleteRecipe(id, index) {
      axios
        .delete("/api/recipe/delete/" + id)
        .then(result => {
          this.recipes.splice(index, 1);
          alert("Recipe berhasil dihapus");
        })
        .catch(err => {});
    },
    deleteCafe(id, index) {
      axios
        .delete("/api/cafe/delete/" + id)
        .then(result => {
          this.cafes.splice(index, 1);
          alert("Cafe berhasil dihapus");
        })
        .catch(err => {});
    }
  },
  created() {
    if (this.$session.exists() && this.$session.has("userid")) {
      axios
        .get("/api/user/" + this.$route.params.userid)
        .then(result => {
          this.user = result.data;
        })
        .catch(err => {});

      axios
        .get("/api/review")
        .then(result => {
          for (var i = 0; i < result.data.length; i++) {
            if (result.data[i].user_id == this.$route.params.userid) {
              this.reviews.push(result.data[i]);
            }
          }
        })
        .catch(err => {
          console.log(err);
        });

      axios
        .get("/api/recipe")
        .then(result => {
          for (var i = 0; i < result.data.length; i++) {
            if (result.data[i].user_id == this.$route.params.userid) {
              this.recipes.push(result.data[i]);
            }
          }
        })
        .catch(err => {
          console.log(err);
        });

      axios
        .get("/api/cafe")
        .then(result => {
          for (var i = 0; i < result.data.length; i++) {
            if (result.data[i].user_id == this.$route.params.userid) {
              this.cafes.push(result.data[i]);
            }
          }
        })
        .catch(err => {
          console.log(err);
        });
    } else {
      const message = "Silakan Login terlebih dahulu";
      this.$router.push({
        name: "login",
        params: {
          msg: message
        }
      });
    }
  }
};
</script>
