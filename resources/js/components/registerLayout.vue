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
                            <br>
                            <div class="alert alert-danger" role="alert" align="center">{{message}}</div>
                        </td>
                    </tr>
                    <tr v-else-if="success">
                        <td>
                            <br>
                            <div class="alert alert-success" role="alert" align="center">{{success}}</div>
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
                            <input v-model="email" class="form-control" type="email" name="email" id="email" size="50" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                    </tr>
                    <tr>
                        <td>
                            <input v-model="password" class="form-control" type="password" name="password" id="password" size="50" required>
                            <router-link tag="small" to="/login" class="form-text text-muted"><a style="cursor: pointer;">Sudah punya akun?</a></router-link>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><button type="submit" name="submit" class="btn btn-primary">REGISTER</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                message: null,
                success: null,
            }
        },
        methods: {
            submit() {
                axios.post('/api/user/create', {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    password: this.password
                }).then((result) => {
                    if (result.status == 201) {
                        this.message = null
                        this.success = "Akun berhasil dibuat, verifikasi email telah dikirim"
                    } else {
                        this.success = null
                        this.message = result.data.message;
                    }
                })
                .catch((err) => {
                    console.log(err);
                    this.message = 'Akun gagal dibuat';
                    this.success = null
                });
            }
        },
        mounted() {
            this.message = this.$route.query.msg;
            this.success = this.$route.query.scs;
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


