<template>
    <div class="container">
        <div class="form-wrapper">
            <form @submit.prevent="submit()">
                <table>
                    <tr>
                        <td>Judul Review</td>
                        <td>
                            <input class="form-control" v-model="review.judul" type="text" name="judul" id="judul" size="50" required="">
                        </td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>
                            <input class="form-control" v-model="review.lokasi" type="text" name="location" id="location" size="50" required="">
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>
                            <input class="form-control" v-model="review.tanggal" type="date" name="tanggal" id="tanggal" size="50" required="">
                        </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>
                            <input class="form-control" v-model="review.harga" type="number" name="harga" id="harga" size="50" required="">
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Foto</td>
                        <td>
                            <input v-if="!displayed" class="form-control" ref="foto" @change="processfile()" type="file" name="photo1" id="image" accept="image/jpg, image/png" required="" />
                            <div class="preview" v-else>
                                <img v-if="!url" :src="'/uploads/'+review.foto" width="350px" height="250px">
                                <img v-if="url" :src="url" width="350px" height="250px">
                                <br><br>
                                <div class="btn btn-danger" @click="removefile()">Remove</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Konten</td>
                        <td>
                            <textarea v-model="review.konten" class="form-control" cols="150" rows="9" name="content" id="content" required=""></textarea>
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
                foto: [],
                user_id: null,
                url: null,
                displayed: true,
                review: {}
            };
        },
        methods: {
            submit() {
                let formData = new FormData();
                formData.append("judul", this.review.judul);
                formData.append("lokasi", this.review.lokasi);
                formData.append("tanggal", this.review.tanggal);
                formData.append("harga", this.review.harga);
                formData.append("foto", this.foto);
                formData.append("konten", this.review.konten);
                formData.append("user_id", this.review.user_id);

                axios
                    .post(
                        "/api/review/update/" + this.$route.params.id,
                        formData
                    )
                    .then(function(response) {
                        console.log("Review berhasil diubah");
                        alert("Review berhasil diubah");
                    })
                    .catch(function(error) {
                        console.log("Gagal mengubah review");
                        alert("Review gagal diubah");
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
                    .get("/api/user/" + this.user_id)
                    .then(result => {
                        this.nama = result.data.first_name;
                        axios
                            .get("/api/review/" + this.$route.params.id)
                            .then(result => {
                                this.review = result.data;
                                console.log(this.url);
                            })
                            .catch(err => {});
                    })
                    .catch(err => {
                        //define here
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

