<template>
    <div v-if="fetched" class="col-md-8">
        <div class="boxhead">
            <table class="tablefood">
                <tr>
                    <th class="thfood" colspan="1">
                        <h1 style="float: left; text-align: left;">
                            {{nama}}
                        </h1>
                    </th>
                    <th class="thfood" colspan="2">
                        <h5 align="right"><img  src="../../../public/logo/icon.png" width="30px" height="30px">
                            {{first_name}} {{last_name}}
                        </h5>
                    </th>
                </tr>
                <tr>
                    <td align="right" width="200px">
                        <h5 style="display: inline;"><img src="../../../public/logo/kalender.png" width="15px" height="20px">
                        {{tanggal}}
                        </h5>
                    </td>
                    <td align="right" width="200px">
                        <h5 style="display: inline;"><img src="../../../public/logo/lokasi.png" width="15px" height="20px">
                        {{lokasi}}
                        </h5>
                    </td>
                    <td align="right" width="200px">
                        <h5 style="display: inline;"><img src="../../../public/logo/duit.png" width="15px" height="20px">
                        {{harga}}
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
                <p>
                    {{konten}}
                </p>
            </div>
        </div>
    </div>
    <div v-else class="push"></div>
</template>

<script>
import axios from 'axios';

    export default {
        props: ['id', 'userid'],
        data() {
            return {
                reviewid: this.id,
                user_id: this.userid,
                nama: null,
                lokasi: null,
                harga: null,
                tanggal: null,
                foto: null,
                konten: null,
                first_name: null,
                last_name: null,
                fetched: false
            }
        },
        created(){
            axios.get('/api/review/'+this.reviewid).then((result) => {
                this.nama=result.data.judul;
                this.lokasi=result.data.lokasi;
                this.harga=result.data.harga;
                this.tanggal=result.data.tanggal;
                this.foto=result.data.foto;
                this.konten=result.data.konten;
            }).catch((err) => {

            });

            axios.get('/api/user/' + this.user_id).then((result) => {
                console.log(result);
                this.first_name = result.data.first_name;
                this.last_name = result.data.last_name;
                this.fetched = true
            }).catch((err) => {
                console.log('Error mengambil data user');
            });
        }
    }
</script>

<style>
			.boxhead{
				width:700px;
				height:auto;
				background: #e1e3e8;
				display: inline-block;
				margin-left: 10px;
				margin-bottom: 10px;
				padding: 20px 20px 20px 20px;
				border-radius: 10px;
			}
		</style>

		<style>
			.box{
				width:200px;
				height:200px;
				background:white;
				display: inline-block;
				margin-top: 10px;
				margin-left: 10px;
			}
		</style>

		<style>
			.boxtext{
				background:white;
				display: inline-block;
				margin-top: 10px;
				margin-left: 10px;
			}
		</style>

		<style>
			.boximg{
			width:210px;
			}
		</style>

		<style>
			.boxrekomen{
				width:650px;
				height:225px;
				background:#800000;
				display: inline-block;
				margin-left: 10px;
				margin-top: 10px;
			}
		</style>
		<style>
			.boxall{
				width:700px;
				background: white;
				display: inline-block;
				margin-left: 10px;
				margin-bottom: 10px;
				border-style: solid;
				border-radius: 10px;
				padding: 10px 10px 10px 10px;
			}
		</style>
		<style>
			.tablefood
			{
				background: transparent;
				width: 650px;
			}
		</style>
		<style>
			.thfood
			{
				background: transparent;
				width: 400px;
				border-width: 0px;
			}

            .push {
        margin-bottom: 500px;
    }
		</style>
