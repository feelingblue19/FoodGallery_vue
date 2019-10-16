<template>
    <div class="container">
         <h3>Food Recipe</h3>
         <table class="table">
                <th>ID</th>
                <th>Judul</th>
                <th>User ID</th>
                <th>Aksi</th>
            <tbody>
                <tr v-for="(recipe, index) of recipes" v-bind:key="recipe.id">
                    <td>{{recipe.id}}</td>
                    <router-link tag="td" style="cursor: pointer;" :to="{path: '/detailrecipe/'+recipe.user_id+'/'+recipe.id}">{{recipe.judul}}</router-link>
                    <td>{{recipe.user_id}}</td>
                    <td>
                        <a @click="deleteRecipe(recipe.id, index)" style="cursor: pointer;"><img src="../../../public/logo/delete_icon.png" width="10px" height="15px" alt=""></a>
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
                recipes: []
            }
        },
        created() {
            axios.get("/api/recipe").then((result) => {
                console.log(result);
                this.recipes = result.data;
            }).catch((err) => {});
        },
        methods: {
            deleteRecipe(id, index) {
                axios
                    .delete("/api/recipe/delete/" + id)
                    .then(result => {
                        this.recipes.splice(index, 1);
                        console.log(result)
                        alert("Recipe berhasil dihapus")
                    })
                    .catch(err => {
                        console.log(err)
                    });
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

