<template>
    <div class="container">
        <div class="form-wrapper">
            <form @submit.prevent="submit()">
                <table>
                    <tr>
                        <td>Nama Cafe</td>
                        <td>
                            <input class="form-control" v-model="cafe.nama" type="text" name="judul" id="judul" size="50" required="">
                        </td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>
                            <input class="form-control" v-model="cafe.lokasi" type="text" name="location" id="location" size="50" required="">
                        </td>
                    </tr>
                    <tr>
                        <td>Range Harga</td>
                        <td>
                            <input class="form-control" v-model="cafe.range_harga" type="text" name="harga" id="harga" size="50" required="">
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Foto</td>
                        <td>
                            <input v-if="!displayed" class="form-control" ref="foto" @change="processfile()" type="file" name="photo1" id="image" accept="image/jpg, image/png" required="" />
                            <div class="preview" v-else>
                                <img v-if="!url" :src="'/uploads/'+cafe.foto" width="350px" height="250px">
                                <img v-if="url" :src="url" width="350px" height="250px">
                                <br><br>
                                <div class="btn btn-danger" @click="removefile()">Remove</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Konten</td>
                        <td>
                            <textarea v-model="cafe.konten" class="form-control" cols="150" rows="9" name="content" id="content" required=""></textarea>
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
                cafe: {},
                url: null,
                foto: [],
                displayed: true
            };
        },
        methods: {
            submit() {
                let formData = new FormData();
                formData.append("nama", this.cafe.nama);
                formData.append("lokasi", this.cafe.lokasi);
                formData.append("range_harga", this.cafe.range_harga);
                formData.append("foto", this.foto);
                formData.append("konten", this.cafe.konten);
                axios
                    .post("/api/cafe/update/" + this.$route.params.id, formData)
                    .then(function(response) {
                        console.log("Cafe berhasil diubah");
                        alert("Cafe berhasil diubah");
                    })
                    .catch(function(error) {
                        console.log("Gagal mengubah cafe");
                        alert("Cafe gagal diubah");
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
                    .get("/api/cafe/" + this.$route.params.id)
                    .then(result => {
                        this.cafe = result.data;
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
    }
</script>
