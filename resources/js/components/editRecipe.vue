<template>
    <div class="container">
        <div class="form-wrapper">
            <form @submit.prevent="submit()">
                <table>
                    <tr>
                        <td>Judul Recipe</td>
                        <td>
                            <input class="form-control" v-model="recipe.judul" type="text" name="judul" id="judul" size="50" required="">
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>
                            <input class="form-control" v-model="recipe.tanggal" type="date" name="tanggal" id="tanggal" size="50" required="">
                        </td>
                    </tr>
                     <tr>
                        <td style="vertical-align: top">Foto</td>
                        <td>
                            <input v-if="!displayed" class="form-control" ref="foto" @change="processfile()" type="file" name="photo1" id="image" accept="image/jpg, image/png" required="" />
                            <div class="preview" v-else>
                                <img v-if="!url" :src="'/uploads/'+recipe.foto" width="350px" height="250px">
                                <img v-if="url" :src="url" width="350px" height="250px">
                                <br><br>
                                <div class="btn btn-danger" @click="removefile()">Remove</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Konten</td>
                        <td>
                            <textarea v-model="recipe.konten" class="form-control" cols="150" rows="9" name="content" id="content" required=""></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right"><button type="submit" name="submit" class="btn btn-primary">Submit</button></td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        data() {
            return {
                recipe: {},
                judul: null,
                tanggal: null,
                foto: [],
                konten: null,
                user_id: null,
                url: null,
                displayed: true
            };
        },
        methods: {
            submit() {
                let formData = new FormData();
                formData.append("judul", this.recipe.judul);
                formData.append("tanggal", this.recipe.tanggal);
                formData.append("foto", this.foto);
                formData.append("konten", this.recipe.konten);
                formData.append("user_id", this.recipe.user_id);
                axios
                    .post("/api/recipe/update/"+this.$route.params.id, formData)
                    .then(function(response) {
                        console.log("Recipe berhasil diubah");
                        alert("Recipe berhasil diubah");
                    })
                    .catch(function(error) {
                        console.log("Gagal mengubah recipe");
                        alert("Recipe gagal diubah");
                    });
            },
            processfile() {
                this.foto = this.$refs.foto.files[0];
                const file = this.$refs.foto.files[0];
                this.url = URL.createObjectURL(file);
                this.displayed = true;
            },
            removefile() {
                this.displayed = false;
                this.url = null;
                this.foto = null;
            }
        },
        created() {
            if (this.$session.exists() && this.$session.has("userid")) {
                this.user_id = this.$session.get("userid");
                axios
                    .get("/api/recipe/" + this.$route.params.id)
                    .then(result => {
                        this.recipe = result.data;
                    })
                    .catch(err => {});

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
