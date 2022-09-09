<template>
    <div>
        <h2>Thêm mới bài test </h2>
        <hr>
        <div class="row">
            <div class="col-4 mb-3">
                <label class="form-label">Tên bài test </label>
                <input type="text" v-model="challenge.name" class="form-control">
            </div>
            <div class="col-8 mb-3">
                <label class="form-label">Nội dung </label>
                <textarea class="form-control" v-model="challenge.content"></textarea>
            </div>
            <div class="col-3 mb-3">
                <label class="form-label">Điểm thưởng top 1</label>
                <input type="number" class="form-control" v-model="challenge.top1">
            </div>
            <div class="col-3 mb-3">
                <label class="form-label">Điểm thưởng top 2</label>
                <input type="number" class="form-control" v-model="challenge.top2">
            </div>
            <div class="col-3 mb-3">
                <label class="form-label">Điểm thưởng top 3</label>
                <input type="number" class="form-control" v-model="challenge.top3">
            </div>
            <div class="col-3 mb-3">
                <label class="form-label">Điểm thưởng còn lại</label>
                <input type="number" class="form-control" v-model="challenge.none">
            </div>
            <div class="col-12 mb-3">
                <button @click.prevent="storeChallenge" class="btn btn-primary">Thêm</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "StoreChallenge",
    data() {
        return {
            challenge: {
                name: '',
                content: '',
                top1: '',
                top2: '',
                top3: '',
                none: ''
            }
        }
    },
    methods: {
        async storeChallenge()
        {
            const rank_point = JSON.stringify({
                top1 : this.challenge.top1,
                top2 : this.challenge.top2,
                top3 : this.challenge.top3,
                none : this.challenge.none,
            });
            return axios.post("https://api.laravel.org/api/admin/challenge",{
                    "name" : this.challenge.name,
                    "content" : this.challenge.content,
                    "rank_point" : rank_point
                })
                .then(res => {
                    this.$router.push({ name : "AdminChallenge"});
                })
                .catch(err => {
                    // this.$router.push({ name : "AdminChallenge"});
                });
        }
    }
}
</script>

<style scoped>

</style>
