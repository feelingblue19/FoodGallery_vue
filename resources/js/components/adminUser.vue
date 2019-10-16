<template>
    <div class="container">
         <h3>User</h3>
         <table class="table">
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Status</th>
            <tbody>
                <tr v-for="user of users" v-bind:key="user.index">
                    <td>{{user.id}}</td>
                    <td>{{user.first_name}}</td>
                    <td>{{user.last_name}}</td>
                    <td>{{user.email}}</td>
                    <td v-if="user.email_verified_at">Aktif</td>
                    <td v-else>Belum Aktif</td>
                </tr>
            </tbody>
         </table>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: []
            }
        },
        created() {
            axios.get("/api/user").then((result) => {
                this.users = result.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        methods: {

        }
    }
</script>

<style scoped>
table{
    border: 10px;
}

th{
    background-color: #dc3545;
    border: 1px;
}
td{
    background-color: whitesmoke;
    color: gray;
}
</style>

