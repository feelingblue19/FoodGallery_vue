<template>
    <div>
        <div v-if="fetched">
            <div class="col-md-8">
                <div class="boxhead">
                    <h1>
                        {{nama}}
                    </h1>
                    <h3><img src="../../../public/logo/icon.png" width="30px" height="30px"> {{first_name}} {{last_name}}
                    </h3>
                    <!-- <h5 style="display: inline;"><img src="../../../public/logo/kalender.png" width="15px" height="20px"> {{tanggal}}
                    </h5> -->
                </div>
                <div class="boxall">
                    <div class="boximg">
                        <div class="img-thumbnail">
                            <img height="250px" width="350px" :src="'/uploads/'+foto">
                        </div>
                    </div>
                    <div class="boxtext">
                        <h5>Recipe</h5>
                        <p style="white-space: pre-line">
                            {{konten}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="push" v-else></div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['userid', 'id'],
        data() {
            return {
                recipeid: this.id,
                nama: null,
                tanggal: null,
                foto: null,
                konten: null,
                user_id: this.userid,
                first_name: null,
                last_name: null,
                fetched: null,
            }
        },
        created() {
            axios.get('/api/recipe/' + this.recipeid).then((result) => {
                this.nama = result.data.judul;
                this.tanggal = result.data.tanggal;
                this.foto = result.data.foto;
                this.konten = result.data.konten;
            }).catch((err) => {});

            axios.get('/api/user/' + this.user_id).then((result) => {
                this.first_name = result.data.first_name;
                this.last_name = result.data.last_name;
                this.fetched = true;
            }).catch((err) => {
                console.log('Error mengambil data user');
            });
        }
    }
</script>

<style scoped>
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
