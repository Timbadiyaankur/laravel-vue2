<template>
  <b-card>
    <b-container fluid>
      <b-row>
        <b-col sm="12" md="4">
          <validation-observer ref="productForm" v-slot="{ handleSubmit, invalid }">
            <b-form @submit.prevent="handleSubmit(onSubmit)">
              <validation-provider rules="required" name="Sku" vid="sku" v-slot="{ errors }">
                <b-form-group label="SKU" class="mb-3" :state="!errors.length" :invalid-feedback="errors[0]">
                  <b-form-input v-model="form.sku" placeholder="Sku" :class="{ 'is-invalid': errors.length }" />
                </b-form-group>
              </validation-provider>
              <validation-provider rules="required" name="Name" vid="name" v-slot="{ errors }">
                <b-form-group label="Name" class="mb-3" :state="!errors.length" :invalid-feedback="errors[0]">
                  <b-form-input v-model="form.name" placeholder="Name" :class="{ 'is-invalid': errors.length }" />
                </b-form-group>
              </validation-provider>
              <validation-provider name="Description" vid="description" v-slot="{ errors }">
                <b-form-group label="Description" class="mb-3" :state="!errors.length" :invalid-feedback="errors[0]">
                  <b-form-textarea v-model="form.description" placeholder="Description" :class="{ 'is-invalid': errors.length }" />
                </b-form-group>
              </validation-provider>
              <validation-provider name="Style" vid="style" v-slot="{ errors }">
                <b-form-group label="Style" class="mb-3" :state="!errors.length" :invalid-feedback="errors[0]">
                  <b-form-input v-model="form.style" placeholder="Style" :class="{ 'is-invalid': errors.length }" />
                </b-form-group>
              </validation-provider>
              <validation-provider name="Color" vid="color" v-slot="{ errors }">
                <b-form-group label="Color" class="mb-3" :state="!errors.length" :invalid-feedback="errors[0]">
                  <b-form-input v-model="form.color" placeholder="Color" :class="{ 'is-invalid': errors.length }" />
                </b-form-group>
              </validation-provider>
              <validation-provider name="Size" vid="size" v-slot="{ errors }">
                <b-form-group label="Size" class="mb-3" :state="!errors.length" :invalid-feedback="errors[0]">
                  <b-form-input v-model="form.size" placeholder="Size" :class="{ 'is-invalid': errors.length }" />
                </b-form-group>
              </validation-provider>
              <validation-provider name="Price" vid="price" v-slot="{ errors }">
                <b-form-group label="Price" class="mb-3" :state="!errors.length" :invalid-feedback="errors[0]">
                  <b-form-input
                    type="number"
                    step="0.01"
                    v-model="form.price"
                    placeholder="Price"
                    :class="{ 'is-invalid': errors.length }"
                  />
                </b-form-group>
              </validation-provider>
              <b-row>
                <b-col>
                  <b-button type="submit" variant="primary" :disabled="invalid">Create</b-button>
                </b-col>
              </b-row>
            </b-form>
          </validation-observer>
        </b-col>
      </b-row>
    </b-container>
  </b-card>
</template>

<script>
import { mapActions, mapMutations, mapState } from 'vuex'
export default {
  components: {},
  data() {
    return {}
  },
  computed: {
    ...mapState('product', { form: 'product' }),
  },
  methods: {
    ...mapActions('product', { createProduct: 'create' }),
    ...mapMutations('product', { resetForm: 'emptyProduct' }),
    onSubmit() {
      this.$apiHandler.apiResponseWrapper(async () => {
        const res = await this.createProduct(this.form)
        this.resetForm()
        this.$router.push({
          name: 'product-list',
        })
        return res
      }, this.$refs.productForm)
    },
  },
  beforeDestroy() {
    this.resetForm()
  },
}
</script>