<template>
    <div class="login-form">
        <div class="form-wrapper">
            <form @submit.prevent="submit()">
                <table>
                    <tr>
                        <router-link tag="td" to="/" align="center"><img src="../../../public/logo/logo.png" width="350px" height="200px"></router-link>
                    </tr>
                    <tr v-if="message">
                    <td>
						<br><div class="alert alert-danger" role="alert" align="center">{{message}}</div>
					</td>
                    </tr>
                    <tr v-else-if="success">
                        <td>
                            <br><div class="alert alert-success" role="alert" align="center">{{success}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                    </tr>
                    <tr>
                        <td>
                            <input v-model="first_name" class="form-control" type="text" name="first_name" id="first_name" size="50" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                    </tr>
                    <tr>
                        <td>
                            <input v-model="last_name" class="form-control" type="text" name="last_name" id="last_name" size="50" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                    </tr>
                    <tr>
                        <td>
                            <input v-model="email" class="form-control" type="email" name="email" id="email" size="50" required disabled>
                        </td>
                    </tr>
                    <small style="cursor: pointer;" v-if="!gantipw" class="form-text text-muted" @click="gantipass()" align="center"><a> Ganti Password?</a></small>
                    <div v-else>
                        <tr>
                            <td>Password</td>
                        </tr>
                        <tr>
                            <td>
                                <input v-model="password" class="form-control" type="password" name="password" id="password" size="50" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                        </tr>
                        <tr>
                            <td>
                                <input v-model="confirm_password" class="form-control" type="password" name="confirm_password" id="confirm_password" size="50" required>
                            </td>
                        </tr>
                        <small style="cursor: pointer;" class="form-text text-muted" align="center" @click="batal()"><a>Batal?</a></small>
                    </div>
                    <tr>
                        <td><button style="margin-left: 120px;" type="submit" name="submit" class="btn btn-primary">SIMPAN</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['userid'],
        data() {
            return {
                user_id : this.userid,
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                confirm_password: null,
                message: null,
                gantipw: false,
                success: null
            }
        },
        methods: {
            submit() {
                if(this.password!=this.confirm_password)
                {
                    this.message="Password dan Confirm Password tidak sama"
                    return false;
                }

                axios.put('/api/user/update/'+this.user_id, {
                    'first_name': this.first_name,
                    'last_name': this.last_name,
                    'password': this.password
                })
                .then((result) => {
                    if(this.gantipw==false)
                        this.success= 'Akun berhasil diedit';
                    else
                    {
                        const success='Akun berhasil diedit, silakan Login kembali';
                        this.$session.destroy();
                        this.$router.push({name: 'login', params: {scs: success}});
                    }

                }).catch((err) => {
                    this.message = 'Akun gagal diedit';
                });
            },
            gantipass(){
                this.gantipw=true
            },
            batal(){
                this.gantipw=false
            }
        },
        created() {
            if(this.$session.exists() && this.$session.has('userid')){
                axios.get('/api/user/'+this.user_id).then((result) => {
                    this.first_name = result.data.first_name;
                    this.last_name = result.data.last_name;
                    this.email = result.data.email;
                }).catch((err) => {});
            }
            else{
                const message='Silakan Login terlebih dahulu';
                this.$router.push({name: 'login', params: {msg: message}});
            }
        }
    }
</script>

<style scoped>
    .login-form {
        padding-left: 450px;
        padding-top: 30px;
        padding-bottom: 61px;
        background-color: white;
    }
</style>


