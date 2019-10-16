<template>
    <div class="container">
        <h3>Cafe Review</h3>
        <table class="table">
            <th>ID</th>
            <th>Nama</th>
            <th>Lokasi</th>
            <th>Range Harga</th>
            <th>User ID</th>
            <th>Aksi</th>
            <tbody>
                <tr v-for="(cafe, index) of cafes" v-bind:key="cafe.id">
                    <td>{{cafe.id}}</td>
                    <router-link tag="td" style="cursor: pointer;" :to="{path: '/detailcafe/'+cafe.user_id+'/'+cafe.id}">{{cafe.nama}}</router-link>
                    <td>{{cafe.lokasi}}</td>
                    <td>{{cafe.range_harga}}</td>
                    <td>{{cafe.user_id}}</td>
                    <td>
                        <a @click="deleteCafe(cafe.id, index)" style="cursor: pointer;"><img src="../../../public/logo/delete_icon.png" width="10px" height="15px" alt=""></a>
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
                cafes: []
            }
        },
        created() {
            axios.get("/api/cafe").then((result) => {
                console.log(result);
                this.cafes = result.data;
                console.log(this.cafes)
            }).catch((err) => {
                console.log(err);
            });
        },
        methods: {
            deleteCafe(id, index) {
                axios
                    .delete("/api/cafe/delete/" + id)
                    .then(result => {
                        this.cafes.splice(index, 1);
                        alert("Cafe berhasil dihapus");
                    })
                    .catch(err => {});
            }
        }
    }
</script>


<style scoped>
    table {
        border: 10px;
    }

    th {
        background-color: #dc3545;
        border: 1px;
    }

    td {
        background-color: whitesmoke;
        color: gray;
    }
</style>

