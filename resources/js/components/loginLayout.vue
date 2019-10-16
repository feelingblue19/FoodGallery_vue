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
                        <td>Email</td>
                    </tr>
                    <tr>
                        <td>
                            <input v-model="email" class="form-control" type="email" name="email" id="email" size="50" required="">
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                    </tr>
                    <tr>
                        <td>
                            <input v-model="password" class="form-control" type="password" name="password" id="password" size="50" required="">
                            <router-link tag="small" to="/register" class="form-text text-muted"><a style="cursor: pointer;">Buat Akun?</a></router-link>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><button type="submit" name="submit" class="btn btn-primary">LOG IN</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['msg', 'scs'],
        data() {
            return {
                email: null,
                password: null,
                message: null,
                success: null,
            }
        },
        methods: {
            submit() {
                if (this.email == "admin@admin.com" && this.password == "admin") {
                    this.$session.start();
                    this.$session.set('admin', 'admin');
                    this.$router.push('/admin/user');
                } else {
                    axios.post('/api/user/login', {
                        email: this.email,
                        password: this.password
                    }).then((result) => {
                        if (result.status == 200) {
                            this.$session.start();
                            this.$session.set('userid', result.data.user.id);
                            this.$router.push('/');
                        } else {
                            this.message = result.data.message
                        }
                    }).catch((err) => {
                        console.log(err);
                    });
                }
            }
        },
        created() {
            if (this.msg)
                this.message = this.msg;
            else if (this.scs)
                this.success = this.scs;
            else if (this.$route.query.scs)
                this.success = this.$route.query.scs;
            else if (this.$route.query.msg)
                this.message = this.$route.query.msg;
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


