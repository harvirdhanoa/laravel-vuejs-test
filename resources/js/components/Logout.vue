<template>
    <a href="javascript:void(0);" @click="logout">Logout</a>
</template>
<script>
    import Auth from '../Auth.js';
    import authService from "../services/auth.service";

    export default {
        data() {
            return { };
        },

        methods: {
            async logout() {
              
                let response = await authService.logout();
                if(response.status == 200){
                    Auth.logout();
                    this.$router.push({ name: 'Login'});
                    this.$router.go()
                }
                
            }
        }
    }
</script>