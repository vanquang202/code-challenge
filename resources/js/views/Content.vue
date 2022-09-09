<template>
    <div class="container "  >
        <div class="bg-light shadow-lg p-2" >
            <h1>Challenge... <div class="loader-head"></div> </h1> 
        </div>

        <div v-if="flagCallApi == false" class="bg-light shadow-lg  m-2 p-4 card-body" v-for="item,key in challenges" :key="key">
            <router-link style="text-decoration: none;" class="card-title" :to="{ name: 'ShowContent' , params: { id: item.id} }">
                <h3>{{ item.name}} </h3>
            </router-link>
            <br>
            <small>Hỗ trợ: <span v-for="i,k in item.has_cod" :key="k" >{{ i.code_language.name + "," }}</span></small>
        </div>
        <div v-else class="bg-light shadow-lg  m-2 card-body">
            <span class="loader-content"></span>
        </div>
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
</template>

<script>
    export default {
        data() {
            return {
                challenges: [],
                links: [],
                flagCallApi: true
            }
        },
        created() {
            this.fetchCode();
        },
        methods: {
            async fetchCode(url = null) {
                this.flagCallApi = true
                return await axios.get(url ?? 'https://api.laravel.test/api/codechalls')
                    .then(res => {
                        this.flagCallApi = false
                        this.challenges = res.data.payload.data;
                        this.links = res.data.payload.links;
                    })
                    .catch(err => {
                        this.flagCallApi = false
                    })
            },
            async onpage(link){
                if(link !== null){
                    return this.fetchCode(link);
                }
                return false;
            }
        },
    }
</script>
<style>
.loader-content {
  width: 100%;
  height: 150px;
  margin: auto;
  display: block;
  position: relative;
  background: #FFF;
  box-sizing: border-box;
}
.loader-content::after {
  content: '';  
  width: calc(100% - 30px);
  height: calc(100% - 30px);
  top: 15px;
  left: 15px;
  position: absolute;
  background-image: linear-gradient(100deg, transparent, rgba(255, 255, 255, 0.5) 50%, transparent 80%), linear-gradient(#DDD 56px, transparent 0), linear-gradient(#DDD 24px, transparent 0), linear-gradient(#DDD 18px, transparent 0), linear-gradient(#DDD 66px, transparent 0);
  background-repeat: no-repeat;
  background-size: 75px 130px, 55px 56px, 160px 30px, 260px 20px, 290px 56px;
  background-position: 0% 0, 0 0, 70px 5px, 70px 38px, 0px 66px;
  box-sizing: border-box;
  animation: animloader 1s linear infinite;
}

@keyframes animloader {
  0% {
    background-position: 0% 0, 0 0, 70px 5px, 70px 38px, 0px 66px;
  }
  100% {
    background-position: 150% 0, 0 0, 70px 5px, 70px 38px, 0px 66px;
  }
}
</style>