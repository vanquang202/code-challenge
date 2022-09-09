<template>
    <div style="overflow: hidden;" class="container bg-light shadow-lg mt-2 p-2">

        <div v-if="flagResultSubmit" @click="flagResultSubmit = false" class="shadow-lg "
            style="position: fixed; background : rgb(204, 204, 204 , .6);   top: 0;  left: 0;  bottom: 0;  right: 0;"
            >
            <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px;">
                <h1>Thành công  <span class="loader-gs"></span></h1>
                <p>Điểm nhận được : {{ data_result.point }}</p>
                <p>Số lần thực hiện :  {{ data_result.flag_point }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="p-1">
                    <h1>{{ name_challenge }} <span style="font-size: 25px;" role="button" @click="$router.push({ name : 'Content' })" >🔙</span> </h1>
                    {{ content_challenge }}
                </div>
            </div>

            <div class="col-6">
                <div class="p-1">
                     <select  style="margin-right: 50px;float:right;float: right; margin-bottom: 10px; padding: 5px 10px; border-radius: 20px;"  @change="changeSelect($event)">
                        <option v-for="item,key in selectHasCod" :key="key" :value="key"  :selected="keySelected == item.code_language.id"  > {{item.code_language.name}}</option>
                    </select>

                    <textarea
                        onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"
                        class="form-control mt-1"
                        rows="30"
                        cols="100"
                        v-model="dataTextAr"></textarea>

                    <button style="    background: #7c7c7c;" class="btn btn-primary mt-1" type="button" v-if="flagClick" @click="runCode">Chạy thử </button>
                    <button style="    background: #7c7c7c;" class="btn btn-primary mt-1" type="button" v-else >Đang test ...  </button>
                    <button style="    background: black;" class="btn btn-primary mt-1" v-if="flagClickSubmit" @click="runCodeSubmit" type="button" >Chạy </button>
                    <button style="    background: black;" class="btn btn-primary mt-1" v-else type="button" >Đang chạy </button>
                    <div
                        class="shadow-lg"
                        style="
                            width: 100%;
                            height: 150px;
                            padding: 20px;
                            border-radius: 20px;
                            margin: 10px 0px;
                            align-items: center;
                            display: flex;
                            justify-content: center;"
                        >
                        <div v-if="flag_test" >{{ messageError }}</div>
                        <div v-else ><span class="loader-code"></span></div>
                    </div>

                    <div class="row">
                        <div
                            class="col-sm-6"
                            v-for="item,key in test"
                            :key="key"
                        >
                            <div
                                class="m-1 p-2 shadow-lg"
                                v-if="flag_test"
                                :style="item.flag == true
                                    ?'background : #000000 ; color : #0cef1e;border-radius: 10px;'
                                    :  'background : #a19393 ; color : white;border-radius: 10px;' " >

                                <span>
                                    Test {{ key + 1 }} : {{ item.input }}
                                </span>
                                <p >{{ 'Đầu ra mong muốn  : ' + item.output}}</p>
                                <p v-if="item.time && item.time !== 'false'" >{{ 'Thời gian : ' + item.time}}</p>
                                <p v-if="item.result" >{{ ' Kết quả : ' + item.result }}</p>

                            </div>
                            <div class="m-1" v-else>
                                <span class="loader"></span>
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

        data() {
            return {
                selectHasCod: [],
                test: [],
                result: [],
                dataTextAr: '',
                keyId: null,
                flagClick: true,
                flag_test: true,
                flagClickSubmit: true,
                flagResultSubmit: false,
                content_challenge: '',
                name_challenge: '',
                data_result: [],
                keySelected: null,
                messageError: 'Code',
            }
        },
        created() {
            this.challCode(this.$route.params.id);
        },
        methods: {
            async challCode(id) {
                const headers = {
                    headers: {
                        Authorization:  'Bearer ' +  this.$store.state.token,
                    }
                };
                return await axios.get('https://api.laravel.test/api/codechall/'+id,
                        headers
                    )
                    .then(res => {
                        this.selectHasCod = res.data.payload.has_cod;
                        if(this.selectHasCod.length == 0) {
                            alert('Không có ngôn ngữ lập trình !');
                            this.$router.push({ name: "Content"});
                        }

                        this.keyId =  this.selectHasCod[0].type_id;
                        this.result = res.data.payload.result;
                        if(this.result.length > 0) this.dataTextAr = this.result[0].content;
                        if(this.result.length > 0) this.keySelected = this.result[0].type_id;
                        if(this.result.length == 0) this.dataTextAr = this.selectHasCod[0].qs_code;
                        this.test = res.data.payload.type_test;
                        this.content_challenge = res.data.payload.content;
                        this.name_challenge = res.data.payload.name;
                        for(let i = 0 ; i < this.test.length ; i++ )
                        {
                            this.test[i].flag=false;
                        };
                        console.log(res.data);
                    });
            },
            changeSelect(el){
                this.keyId =  this.selectHasCod[el.target.value].type_id;
                if(this.result[0].type_id == this.selectHasCod[el.target.value].type_id) {
                    if(this.result.length > 0) this.dataTextAr = this.result[0].content;
                    return ;
                }
                this.dataTextAr = this.selectHasCod[el.target.value].qs_code;
            },
            runCode(){
                this.flagClick = false;
                this.flag_test = false;
                return axios.post("https://api.laravel.test/api/run-code/"+this.$route.params.id,{
                    type_id: this.keyId,
                    content: this.dataTextAr,
                }).then(res => {
                    this.flagClick = true;
                    this.flag_test = true;
                    if(res.data[0].hasError == true) this.messageError = res.data[0].result;
                    this.test = res.data;
                })
                ;
            },
            async runCodeSubmit(){
                this.flagClickSubmit = false;
                this.flag_test = false;
                let token =  this.$store.state.token;
                return await axios.post(
                        "https://api.laravel.test/api/run-submit-code/"+this.$route.params.id,
                        {
                            type_id: this.keyId,
                            content: this.dataTextAr,
                        },
                        {
                            headers: {
                                Authorization: 'Bearer ' + token,
                            }
                        }
                    ).then(res => {
                        this.flag_test = true;
                        this.flagClickSubmit = true;
                        if(res.data.status) this.flagResultSubmit = true;
                        if(res.data.data[0].hasError == true) this.messageError = res.data.data[0].result;
                        this.data_result = res.data.data_result;
                        this.test = res.data.data;
                    }).catch(err => {
                        this.flag_test = true;
                        this.flagClickSubmit = true;
                });
            }
        },
    }
</script>
<style>
.loader-gs {
    width: 24px;
    height: 9px;
    top: -6vh;
    right: -5vh;
    position: relative;
}
.loader-gs::before , .loader-gs::after{
  content: '';
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50% , -50%);
  width: 48em;
  height: 48em;
  background-image:
    radial-gradient(circle 10px, #00ff4e 100%, transparent 0),
    radial-gradient(circle 10px, #00ff4e 100%, transparent 0),
    radial-gradient(circle 10px, #00ff4e 100%, transparent 0),
    radial-gradient(circle 10px, #00ff4e 100%, transparent 0),
    radial-gradient(circle 10px, #00ff4e 100%, transparent 0),
    radial-gradient(circle 10px, #00ff4e 100%, transparent 0),
    radial-gradient(circle 10px, #00ff4e 100%, transparent 0),
    radial-gradient(circle 10px, #00ff4e 100%, transparent 0);
  background-position: 0em -18em, 0em 18em, 18em 0em, -18em 0em,
                       13em -13em, -13em -13em, 13em 13em, -13em 13em;
    background-repeat: no-repeat;
  font-size: 0.5px;
  border-radius: 50%;
  animation: blast 1s ease-in infinite;
}
.loader-gs::after {
  font-size: 1px;
  background: #00ff4e;
  animation: bounce 1s ease-in infinite;
}

@keyframes bounce {
  0% , 100%{ font-size: 0.75px }
  50% { font-size: 1.5px }
}
@keyframes blast {
  0% , 40% {
    font-size: 0.5px;
  }
  70% {
    opacity: 1;
    font-size: 4px;
  }
   100% {
     font-size: 6px;
    opacity: 0;
  }
}


.loader-code {
    color: black;
    font-family: Consolas, Menlo, Monaco, monospace;
    font-weight: bold;
    font-size: 78px;
    opacity: 0.8;
}
.loader-code:before {
    content: "{";
    display: inline-block;
    animation: pulse 0.4s alternate infinite ease-in-out;
}
.loader-code:after {
    content: "}";
    display: inline-block;
    animation: pulse 0.4s 0.3s alternate infinite ease-in-out;
}

@keyframes pulse {
    to {
        transform: scale(0.8);
        opacity: 0.5;
    }
}

</style>
