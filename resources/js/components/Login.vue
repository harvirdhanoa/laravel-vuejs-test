<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <form v-on:submit.prevent="Login">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

                <div class="form-group">
                    <label for="email"> Email Address</label>
                    <input type="email" v-model="user.email" class="form-control" name="email" placeholder="Email Address">
                </div>
                <span class="error" v-if="errorDisplay == true">{{ errorMssg }}</span>

                <div class="form-group">
                    <label for="password"> Password</label>
                    <input type="password" v-model="user.password" class="form-control" name="password" placeholder="Password">
                </div>

                <button class="btn btn-lg btn-primary btn-block mt-5" @click.prevent="login">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
    .error{ color:red;}
</style>
<script>
    import Auth from '../Auth.js';
    import authService from "../services/auth.service";

    export default {
        data() {
            return {
                user: {
                    email: '',
                    password: '',
                },
                errorDisplay: false,
                errorMssg: ''
            };
        },

        methods: {
            async login() {
                this.errorDisplay = false;
                this.errorMssg = '';

                let response = await authService.signIn(this.user);
                if(response.status == 200){
                    let accessToken = response.data.access_token;
                    let loggedUser = response.data.user;
                    Auth.login(accessToken,loggedUser);
                    this.$router.push({ name: 'Products'});
                    this.$router.go()
                }else{
                    this.errorDisplay = true;
                    this.errorMssg = response.message;
                }
            }
        }
    }
</script>