<template>
    <div style="overflow: hidden;" class="container bg-light shadow-lg mt-2 p-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a role="button" @click="$router.push({ name: 'Content' })" href="#">Challenge...</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $store.state.user.name }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img :src="checkAvatar" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ $store.state.user.name }}</h5>
<!--                            <p class="text-muted mb-1">Full Stack Developer</p>-->
<!--                            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>-->
<!--                            <div class="d-flex justify-content-center mb-2">-->
<!--                                <button type="button" class="btn btn-primary">Follow</button>-->
<!--                                <button type="button" class="btn btn-outline-primary ms-1">Message</button>-->
<!--                            </div>-->
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                    </div>
                </div>
                <div class="col-lg-8">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Người dùng : </p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $store.state.user.name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email : </p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $store.state.user.email }}</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">Danh sách </span>
                                        bài code đã làm
                                    </p>

                                    <div
                                        v-for="v,k in results"
                                        :key="k"
                                    >
                                        <p
                                            role="button"
                                            @click="$router.push({ name: 'ShowContent', params: { id: v.challenge.id} })"
                                            class="mb-1"
                                            style="font-size: .77rem;color: blue">
                                            {{ v.challenge.name }}
                                        </p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div
                                                class="progress-bar"
                                                role="progressbar"
                                                :style="'width: '+(v.challenge.rank_point.top1/v.point)*100+'%'"
                                                :aria-valuenow="v.point"
                                                 aria-valuemin="0"
                                                :aria-valuemax="v.challenge.rank_point.top1">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Profile",
    data() {
        return {
            results: [],
        }
    },
    created() {
        this.getProfile();
    },
    computed: {
        checkAvatar() {
            if(this.$store.state.user.avatar) return this.$store.state.user.avatar;
            return 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp';
        }
    },
    methods: {
        async getProfile()
        {
            const headers = {
                headers: {
                    Authorization:  'Bearer ' +  this.$store.state.token,
                }
            };
            return await axios.get(
                "https://api.laravel.org/api/profile",
                headers
            ).then(res => {
                this.results = res.data.result;
            }).catch(err => {
                // this.$router.push({ name : "Login"});
            });
        }
    }
}
</script>

<style scoped>

</style>
