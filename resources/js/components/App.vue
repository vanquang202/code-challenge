<template>
    <div >
        <div  class="shadow-lg p-2" style="z-index: 99;background: white;position: fixed; top: 0; right: 0; padding: 5px; ">
                <router-link v-if="!user"  :to="{ name: 'Login'}">Đăng nhập </router-link>
                <div v-else >
                    <h2 style="color: #0d6efd" role="button" @click.prevent="$router.push({ name: 'Content' })">Challenge...</h2>
                    <hr>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p
                                role="button"
                                @click.prevent="$router.push({ name: 'Profile' })"
                                style="color: #0d6efd ; margin : 0"
                            >
                                {{ $store.state.user.name }}
                            </p>
                        </li>
                        <li class="list-group-item"><span @click="logout" role="button">Đăng xuất </span></li>
                    </ul>



                </div>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user : false,
            }
        },
        created() {
            if(localStorage.getItem("user") && localStorage.getItem("token")){
                    this.user = JSON.parse(localStorage.getItem("user"));
                    this.$store.dispatch("setUser", JSON.parse(localStorage.getItem("user")));
                    this.$store.dispatch("setToken", JSON.parse(localStorage.getItem("token")));
                    this.user = true;
            }else{
                this.$router.push({ name: "Login" });
            }
        },
        methods: {
            logout(){
                const user = JSON.parse(localStorage.getItem("user"));
                const token = JSON.parse(localStorage.getItem("token"));
                return axios.post("https://api.laravel.org/api/logout",
                    {
                        email: user.email
                    },
                    {
                        headers: {
                            Authorization: 'Bearer ' + token,
                        }
                    }
                ).then(res => {
                    this.removeAcount();
                }).catch(err => {
                    this.removeAcount();
                });
            },
            removeAcount()
            {
                this.user = false;
                localStorage.removeItem("user")
                localStorage.removeItem("token")
                this.$store.dispatch("setUser", null);
                this.$store.dispatch("setToken", null);
                this.$router.push({ name: "Login" })
            }
        },
    }
</script>
