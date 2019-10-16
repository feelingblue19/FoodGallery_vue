<template>
    <div class="container">
        <div class="form-wrapper">
            <form @submit.prevent="submit()">
		    <table>
				<tr>
					<td>Nama Cafe</td>
					<td>
						<input class="form-control" v-model="nama_cafe" type="text" name="judul" id="judul" size="50" required="">
					</td>
				</tr>
				<tr>
					<td>Lokasi</td>
					<td>
						<input class="form-control" v-model="lokasi" type="text" name="location" id="location" size="50" required="">
					</td>
				</tr>
				<tr>
					<td>Range Harga</td>
					<td>
						<input class="form-control" v-model="harga" type="text" name="harga" id="harga" size="50" required="">
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top">Foto</td>
					<td>
						<input v-if="!displayed" class="form-control" ref="foto" @change="processfile()" type="file" name="photo1" id="image" accept="image/jpg, image/png"  required=""/>
                        <div class="preview" v-if="url && displayed">
                            <img :src="url" width="350px" height="250px"><br><br>
                            <div class="btn btn-danger" @click="removefile()">Remove</div>
                        </div>
					</td>
				</tr>
				<tr>
					<td valign="top">Konten</td>
					<td>
						<textarea v-model="konten" class="form-control" cols="150" rows="9" name="content" id="content" required=""></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right"><button type="submit" name="submit" class="btn btn-primary" >Submit</button></td>
				</tr>
		    </table>
            </form>
	    </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
            nama_cafe: null,
            lokasi: null,
            harga: null,
            foto: [],
            konten: null,
            user_id: null,
            url: null,
            displayed: null,
        }
    },
    methods: {
        submit(){
            let formData=new FormData();
            formData.append('nama', this.nama_cafe);
            formData.append('lokasi', this.lokasi);
            formData.append('range_harga', this.harga);
            formData.append('foto', this.foto);
            formData.append('konten', this.konten);
            formData.append('user_id', this.user_id);

            axios.post('/api/cafe/create', formData).then(function(response){
                console.log('Cafe berhasil dibuat')
                alert("Cafe berhasil dibuat")
            }).catch(function(error){
                console.log('Gagal membuat cafe')
                alert("Cafe gagal dibuat")
            });
        },
        processfile(){
            this.foto = this.$refs.foto.files[0];
            const file=this.$refs.foto.files[0];
            this.url=URL.createObjectURL(file);
            this.displayed=true;
        },
        removefile(){
            this.displayed=false;
            this.url=null;
            this.$refs.foto.files=null;
        }
    },
    created(){
        if(this.$session.exists() && this.$session.has('userid')){
            this.user_id=this.$session.get('userid');
            axios.get('/api/user/'+this.user_id).then(result => {
                this.nama=result.data.first_name;
            }).catch(err=>{
            })
        }
        else{
            const message='Silakan Login terlebih dahulu';
            this.$router.push({name: 'login', params: {msg: message}});
        }
    }
}
</script>
