<template>
  <div>
    <b-container  fluid="sm" class="mt-5">
      <b-row align-h="center">
        <b-col cols="4">
          <h4>Edit Product</h4>
          <b-form @submit.stop.prevent="updateProduct" id="form" >
            <b-form-group id="input-group-1" label="Name" label-for="input-1">
              <b-form-input
                id="input-1"
                name="input-1"
                v-model="form.name"
                v-validate="'required'"
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
                id="makes"
                name="make"
                data-vv-as="make"
                v-model="form.make"
                :placeholder="form.make"
                :options="optionsMake"
                :state="validateState('make')"
                v-validate="'required'"
                aria-describedby="make-live-feedback"
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
                :clearable="false"
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
                :clearable="false"
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
                v-validate="'required'"
                v-model="form.part_number"
                :state="validateState('input-5')"
                type="text"
              ></b-form-input>
              <b-form-invalid-feedback id="input-5-live-feedback">{{
                  veeErrors.first('input-5')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <div>
              <div class="d-inline-flex" v-for="(image, index) in image_product">
                <b-img
                  :src="image.image_link"
                  class="preview"
                  width="150"
                  height="100"
                  :ref="image +parseInt(index)"
                  alt="Image"></b-img>
                <b-button class="mr-2" letiant="outline-warning" @click="deletePhoto(image.id)">&times;
                </b-button>
              </div>
            </div>
            <b-form-group id="input-group-6" label="Image" label-for="input-6">
              <b-form-file
                accept="image/*"
                multiple
                type="file"
                id="input-6"
                name="input-6"
                ref="file-input"
                v-validate="'required'"
                :state="validateState('input-6')"
                v-model='image'
              >
                <b-form-invalid-feedback id="input-6-live-feedback">{{
                    veeErrors.first('input-6')
                  }}
                </b-form-invalid-feedback>
              </b-form-file>
<!--              <div v-for="(image, key) in images">-->
<!--                <div>-->
<!--                  <img class="preview" :ref="'image' +parseInt( key )" />-->
<!--                  {{ image.name }}-->
<!--                </div>-->
<!--              </div>-->
              <b-button @click="clearFiles" class="mr-2">Reset via method</b-button>
            </b-form-group>
            <b-button type="submit">Save Product</b-button>
          </b-form>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      images:[],
      form: {},
      image_product: '',
      image: [],
      optionsMake: [],
      optionsModel: [],
      optionsYear: [],
      allMake: [],
      allModel: [],
    }
  },
  mounted() {
    this.getProduct(this.$route.params.id)
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
    getProduct(id) {
      this.axios.get(`/products/${id}`).then(res => {
        if (res.status === 200) {
          this.form = res.data.product
          this.image_product = res.data.product.images;
        }
      })
    },
    getKey(object, value) {
      return Object.keys(object).find(key => object[key] === value);
    },
    updateProduct() {
      this.$validator.validateAll().then(result => {
          console.log(result)
          if (!result) {
            return;
          }
      this.$store.dispatch('updateProduct', [this.form, this.image, this.$route.params.id]).then(res => {
        console.log(this.image)
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
    },
    deletePhoto(id) {
      if(confirm("Are You SURE? ")){
        return new Promise((resolve, reject) => {
          axios.post(`/photo/delete/${id}`,id).then(res => {
          if(res.status === 200){
            this.getProduct(this.$route.params.id)
          }
          })
        })
      }
    }
  }

}
</script>

<style scoped>

img.preview {
  width: 200px;
  background-color: white;
  border: 1px solid #DDD;
  padding: 5px;
}


</style>
