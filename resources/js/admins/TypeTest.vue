<template>
  <div>
      <h2>Quản lý test {{ challenge.name }}</h2>
      <hr>
      <div class="row">

          <div class="col-6">
              <h2>Test </h2>

              <div class="form row">
                  <div class="col-6 mb-3">
                      <label class="form-label">Đầu vào </label>
                      <textarea v-model="typeCodeData.input" class="form-control"></textarea>
                  </div>
                  <div class="col-6 mb-3">
                      <label class="form-label">Kết quả</label>
                      <textarea v-model="typeCodeData.output" class="form-control"></textarea>
                  </div>
                  <div class="col-8 mb-3">
                      <label class="form-label">Tình trạng </label>
                      <select  v-model="typeCodeData.status" class="form-control">
                          <option value="1">Mở</option>
                          <option value="0">Khóa</option>
                      </select>
                  </div>
                  <div style="display: flex;  justify-content: center; align-items: center;" class="shadow-lg col-4 mb-3">
                      <button v-if="typeCodeData.flagCreate" @click="typeTestStore" class="btn btn-primary">Thêm</button>
                      <button v-else class="btn btn-primary">Cập nhật</button>
                  </div>
              </div>

              <div style="position: relative" class="shadow-lg mb-2 p-3" v-for="v,k in typeCode" :key="k">
                  <p>
                      Đầu vào :  {{ v.input }}
                  </p>
                  <p>
                      Đầu ra :  {{ v.output }}
                  </p>
                  <p>
                      Tình trạng :  {{ v.status == 1 ? 'Mở' : 'Khóa' }}
                  </p>
                  <div style="position: absolute; top: 5px ; right: 5px">
                      <button class="btn btn-dark">Sửa </button>
                  </div>
              </div>
          </div>

          <div class="col-6">
            <h2>Đầu vào đầu ra </h2>

            <div class="form row">

                <div class="col-6 mb-3">
                    <label class="form-label">Khung funtion code  </label>
                    <textarea v-model="hasCodData.qs_code"  class="form-control"></textarea>
                </div>
                <div class="col-6 mb-3">
                  <label class="form-label">Function chạy code </label>
                    <textarea v-model="hasCodData.run_qs_code" class="form-control"></textarea>
                </div>
                <div class="col-8 mb-3">
                  <label class="form-label">Ngôn ngữ  </label>
                  <select v-model="hasCodData.type_id" class="form-control">
                      <option v-for="v,k in codeLanguage" :key="k" :value="v.id">{{ v.name }}</option>
                  </select>
                </div>
                <div style="display: flex;  justify-content: center; align-items: center;" class="shadow-lg col-4 mb-3">
                  <button v-if="hasCodData.flagCreate" @click="hasCodeStore" class="btn btn-primary">Thêm</button>
                  <button v-else class="btn btn-primary">Cập nhật</button>
                </div>

            </div>

            <div style="position: relative" class=" shadow-lg mb-2 p-3" v-for="v,k in hasCod" :key="k">
                <p>
                    Nội dung  :  {{ v.qs_code }}
                </p>
                <p>
                    Đầu ra chạy :  {{ v.run_qs_code  }}
                </p>
                <p>
                    Ngôn ngữ  :  {{ v.code_language.name }}
                </p>
                <div style="position: absolute; top: 5px ; right: 5px">
                    <button class="btn btn-dark">Sửa </button>
                </div>
            </div>
          </div>

      </div>
  </div>
</template>

<script>
export default {
    name: "TypeTest",
    data() {
        return {
            challenge: {},
            typeCode: [],
            hasCod: [],
            codeLanguage: [],
            typeCodeData: {
                input: "",
                output: "",
                status: 1,
                flagCreate: true,
            },
            hasCodData: {
                qs_code: "",
                run_qs_code: "",
                type_id: 1,
                flagCreate: true,
            },

        }
    },
    created() {
        this.getChallenge(this.$route.params.id);
    },
    methods: {
        async getChallenge(id)
        {
            return await axios.get("https://api.laravel.org/api/admin/challenge/"+id)
                .then(res => {
                    this.challenge = res.data.data;
                    this.typeCode = res.data.data.type_test;
                    this.hasCod = res.data.data.has_cod;
                    this.codeLanguage = res.data.codeLanguage;
                })
                .catch(err => {

                });
        },
        async hasCodeStore()
        {
            return await axios.post("https://api.laravel.org/api/admin/has-cod/",
                    {
                        qs_code: this.hasCodData.qs_code,
                        run_qs_code: this.hasCodData.run_qs_code,
                        type_id: this.hasCodData.type_id,
                        challenge_id: this.$route.params.id,
                    }
                )
                .then(res => {
                    this.getChallenge(this.$route.params.id);
                })
                .catch(err => {

                });
        },
        async typeTestStore()
        {
            return await axios.post("https://api.laravel.org/api/admin/type-code/",
                {
                    input: this.typeCodeData.input,
                    output: this.typeCodeData.output,
                    status: this.typeCodeData.status,
                    challenge_id: this.$route.params.id,
                }
            )
                .then(res => {
                    this.getChallenge(this.$route.params.id);
                })
                .catch(err => {

                });
        }
    }
}
</script>

<style scoped>

</style>
