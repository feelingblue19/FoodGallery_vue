<template>
    <div>
        <div v-show="fetched">
            <div class="col-md-8">
                <div class="boxhead">
                    <table class="tablefood">
                        <tr>
                            <th class="thfood" colspan="1">
                                <h1 style="float: left; text-align: left;">
                                    {{nama}}
                                </h1>
                            </th>
                            <th class="thfood" colspan="2">
                                <h5 align="right"><img src="../../../public/logo/icon.png" width="30px" height="30px"> {{first_name}} {{last_name}}
                                </h5>
                            </th>
                        </tr>
                        <tr>
                            <td align="right" width="200px">
                                <h5 style="display: inline;"><img src="../../../public/logo/lokasi.png" width="15px" height="20px"> {{lokasi}}
                                </h5>
                            </td>
                            <td align="right" width="170px">
                                <h5 style="display: inline;"><img src="../../../public/logo/duit.png" width="20px" height="20px"> {{range_harga}}
                                </h5>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="boxall">
                    <div class="boximg">
                        <div class="img-thumbnail">
                            <img height="250px" width="350px" :src="'/uploads/'+foto">
                        </div>
                    </div>
                    <div class="boxtext">
                        <h5>Review</h5>
                        <p style="white-space: pre-line">
                            {{konten}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div v-show="!fetched" class="push"></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cafeid: this.id,
                nama: null,
                lokasi: null,
                range_harga: null,
                foto: null,
                konten: null,
                user_id: null,
                first_name: null,
                last_name: null,
                fetched: null,
            }
        },
        created() {
            axios.get('/api/cafe/' + this.$route.params.id).then((result) => {
                this.nama = result.data.nama;
                this.lokasi = result.data.lokasi;
                this.range_harga = result.data.range_harga;
                this.foto = result.data.foto;
                this.konten = result.data.konten;
            }).catch((err) => {
                console.log('Error mengambil data cafe');
            });

            axios.get('/api/user/' + this.$route.params.userid).then((result) => {
                console.log(result);
                this.first_name = result.data.first_name;
                this.last_name = result.data.last_name;
                this.fetched = true;
            }).catch((err) => {
                console.log('Error mengambil data user');
            });
        },
    }
</script>

<style>
    .boxhead {
        width: 700px;
        height: auto;
        background: #e1e3e8;
        display: inline-block;
        margin-left: 10px;
        margin-bottom: 10px;
        padding: 20px 20px 20px 20px;
        border-radius: 10px;
    }

    .box {
        width: 200px;
        height: 200px;
        background: white;
        display: inline-block;
        margin-top: 10px;
        margin-left: 10px;
    }

    .boxtext {
        background: white;
        display: inline-block;
        margin-top: 10px;
        margin-left: 10px;
    }

    .boximg {
        width: 210px;
    }

    .boxrekomen {
        width: 650px;
        height: 225px;
        background: #800000;
        display: inline-block;
        margin-left: 10px;
        margin-top: 10px;
    }

    .boxall {
        width: 700px;
        background: white;
        display: inline-block;
        margin-left: 10px;
        margin-bottom: 10px;
        border-style: solid;
        border-radius: 10px;
        padding: 10px 10px 10px 10px;
    }

    .tablefood {
        background: transparent;
        width: 650px;
    }

    .thfood {
        background: transparent;
        width: 400px;
        border-width: 0px;
    }

    .push {
        margin-bottom: 500px;
    }
</style>
