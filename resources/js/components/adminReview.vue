<template>
    <div class="container">
         <h3>Food Review</h3>
         <table class="table">
            <th>ID</th>
            <th>Judul</th>
            <th>Lokasi</th>
            <th>Harga</th>
            <th>User ID</th>
            <th>Aksi</th>
            <tbody>
                <tr v-for="(review, index) of reviews" v-bind:key="review.id">
                    <td>{{review.id}}</td>
                    <router-link tag="td" style="cursor: pointer;" :to="{path: '/detailreview/'+review.user_id+'/'+review.id}">{{review.judul}}</router-link>
                    <td>{{review.lokasi}}</td>
                    <td>{{review.harga}}</td>
                    <td>{{review.user_id}}</td>
                    <td>
                        <a @click="deleteReview(review.id, index)" style="cursor: pointer;"><img src="../../../public/logo/delete_icon.png" width="10px" height="15px" alt=""></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                reviews: []
            }
        },
        created() {
            axios.get("/api/review").then((result) => {
                this.reviews = result.data;
            }).catch((err) => {console.log(err)});
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
            }
        }
    }
</script>

<style scoped>
table{
    border: 10px;
}

th{
    background-color: #dc3545;
    border: 1px;
}
td{
    background-color: whitesmoke;
    color: gray;
}
</style>

