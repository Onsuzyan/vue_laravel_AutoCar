<template>
  <div>
    <b-container class="mt-5">
      <b-row align-h="center">
        <b-col cols="4">
          <h4>New product</h4>
          <b-form @submit.stop.prevent="createProduct">
            <b-form-group id="input-group-1" label="Name" label-for="input-1">
              <b-form-input
                id="input-1"
                name="input-1"
                v-model="form.name"
                v-validate="'required|min:3'"
                :state="validateState('input-1')"
                type="text"
              ></b-form-input>
              <b-form-invalid-feedback id="input-1-live-feedback">{{
                  veeErrors.first('input-1')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-2" label="Make" label-for="input-2">
              <v-select
                id="input-2"
                name="input-2"
                v-model="form.make"
                :options="optionsMake"
                v-validate="'required'"
                :state="validateState('input-2')"
                type="text"
              ></v-select>
              <b-form-invalid-feedback id="input-2-live-feedback">{{
                  veeErrors.first('input-2')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-3" label="Model" label-for="input-3">
              <v-select
                id="input-3"
                name="input-3"
                v-model="form.model"
                :options="optionsModel"
                v-validate="'required'"
                :state="validateState('input-3')"
                type="text"
              >
              </v-select>
              <b-form-invalid-feedback id="input-3-live-feedback">{{
                  veeErrors.first('input-3')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-4" label="Year" label-for="input-4">
              <v-select
                id="input-4"
                name="input-4"
                v-model="form.year"
                :options="optionsYear"
                v-validate="'required'"
                :state="validateState('input-4')"
                type="text"
              ></v-select>
              <b-form-invalid-feedback id="input-4-live-feedback">{{
                  veeErrors.first('input-4')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-5" label="Part Number" label-for="input-5">
              <b-form-input
                id="input-5"
                name="input-5"
                v-model="form.part_number"
                v-validate="'required'"
                :state="validateState('input-5')"
                type="text"
              ></b-form-input>
              <b-form-invalid-feedback id="input-5-live-feedback">{{
                  veeErrors.first('input-5')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
<!--            <div v-for="(image, key) in images">-->
<!--              <div>-->
<!--                <img class="preview" :ref="'image' +parseInt(key)" />-->
<!--              </div>-->
<!--            </div>-->
            <b-form-group id="input-group-6" label="Image" label-for="input-6">
              <b-form-file
                multiple
                type="file"
                id="input-6"
                name="input-6"
                ref="file-input"
                v-model="image"
                v-validate="'required'"
                :state="validateState('input-6')"
              >
                <b-form-invalid-feedback id="input-6-live-feedback">{{
                    veeErrors.first('input-6')
                  }}
                </b-form-invalid-feedback>
              </b-form-file>
              <b-button @click="clearFiles" class="mr-2">Reset image</b-button>
            </b-form-group>
            <b-button type="submit">Create Product</b-button>
          </b-form>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      images:[],
      form: {
        name: '',
        model: '',
        make: '',
        year: '',
        part_number: ''
      },
      image: [],
      optionsMake: [],
      optionsModel: [],
      optionsYear: [],
      allMake: [],
      allModel: [],
    }
  },
  created() {
    this.$store.dispatch('getMake').then(res => {
      this.optionsMake = Object.values(res.data);
      this.allMake = res.data;
    }).catch(e => {
      console.log(e)
    })
  },
  watch: {
    'form.make': function () {
      let index = this.getKey(this.allMake, this.form.make);
      this.$store.dispatch('getModel', index).then(res => {
        this.optionsModel = Object.values(res.data)
        this.allModel = res.data;
      })
    },
    'form.model': function () {
      if(this.form.make === null || this.form.make === ''){
        this.form.model = '';
      }
      this.$store.dispatch('getYear', this.form.model).then(res => {
        this.optionsYear = Object.values(res.data);
      })
    },
    'form.year': function () {
      if(this.form.make === null || this.form.make === '' || this.form.model === null || this.form.model === ''){
        this.form.year = '';
      }
      this.$store.dispatch('getYear', this.form.model).then(res => {
        this.optionsYear = Object.values(res.data);
      })
    }
  },
  methods: {
    // previewImage(e){
    //   let selectedFiles = e.target.files;
    //   for (let i=0; i < selectedFiles.length; i++){
    //     this.images.push(selectedFiles[i]);
    //   }
    //
    //   for (let i=0; i<this.images.length; i++){
    //     let reader = new FileReader();
    //     reader.addEventListener('load', function(){
    //       this.$refs['image' + parseInt(i)][0].src = reader.result;
    //     }.bind(this), false);
    //     reader.readAsDataURL(this.images[i]);
    //   }
    // },
    getKey(object, value) {
      return Object.keys(object).find(key => object[key] === value);
      //Верни из всех клячей тот у которого значения ровно выбраного
    },
    createProduct() {
      this.$validator.validateAll().then(result => {
          console.log(result)
          if (!result) {
            return;
          }
      this.$store.dispatch('setProduct', [this.form, this.image]).then(res=> {
        console.log(res)
        })
      })
    },
    validateState(ref) {
      if (this.veeFields[ref] && (this.veeFields[ref].dirty || this.veeFields[ref].validated)) {
        return !this.veeErrors.has(ref);
      }
      return null;
    },
    clearFiles() {
      this.$refs['file-input'].reset()
    }
  }

}
</script>

<style scoped>

</style>
