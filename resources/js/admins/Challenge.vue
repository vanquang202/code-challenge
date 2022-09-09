<template>
    <div>
        <h2>Quản lý Challenge</h2>
        <div class="card-body">
            <hr>
            <div class="table">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Bài test</th>
                            <th scope="col">Nội dung </th>
                            <th scope="col">Điểm thưởng </th>
                            <th scope="col">Số test  </th>
                            <th scope="col">Thao tác  </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="v,k in challenge" :key="k">
                            <td>{{ k + 1 }}</td>
                            <td>{{ v.name }}</td>
                            <td style="    width: 100vh;">{{ v.content }}</td>
                            <td>
                                <p>Top 1 : {{ v.rank_point.top1 }}</p>
                                <p>Top 2 : {{ v.rank_point.top2 }}</p>
                                <p>Top 3 : {{ v.rank_point.top3 }}</p>
                                <p>None : {{ v.rank_point.none }}</p>
                            </td>
                            <td>{{ v.type_test.length }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Thao tác
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <router-link
                                                class="dropdown-item"
                                                :to="{ name: 'AdminChallengeTest' , params : { id : v.id } }">
                                                Quản lý các test và ngôn ngữ
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li v-for="v,k in links" :key="k" @click="onpage(v.url)" :class="{'page-item' : true , 'active' : v.active}">
                            <a v-if="k == 0" :class="{'page-link' : true }" href="#">
                                ◀️
                            </a>
                            <a v-else-if="k == (links.length - 1)" :class="{'page-link' : true }" href="#">
                                ▶️
                            </a>
                            <a v-else class="page-link" href="#">{{v.label}}</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Challenge",
    data() {
        return {
            challenge : [],
            links: []
        }
    },
    created() {
        this.getChallenge();
    },
    methods: {
        async getChallenge(url = null)
        {
            return await axios.get(url ?? "https://api.laravel.org/api/admin/challenge")
                .then(res => {
                    this.challenge = res.data.data.data;
                    this.links = res.data.data.links;
                })
                .catch(err => {
                    alert('Đã xảy ra lỗi !');
                })
        },
        async onpage(link){
            if(link !== null){
                return this.getChallenge(link);
            }
            return false;
        }
    }
}
</script>

<style scoped>

</style>
