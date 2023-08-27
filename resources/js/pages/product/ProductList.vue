<template>
  <b-card>
    <b-container fluid>
      <data-table ref="productTable" :provider="dataTable" :columns="columns">
        <template #cell(description)="{ item }">
          {{ item.description | formatLength(40) }}
        </template>
        <template #cell(price)="{ item }"> $ {{ item.price }} </template>
        <template #cell(action)="{ item }">
          <b-button-toolbar>
            <router-link :to="{ name: 'edit-product', params: { id: item.id } }" class="mr-2 btn btn-warning btn-sm">
              <font-awesome-icon icon="edit" />
            </router-link>
            <b-button variant="danger" size="sm" @click.prevent="remove(item)">
              <font-awesome-icon icon="trash" />
            </b-button>
          </b-button-toolbar>
        </template>
      </data-table>
    </b-container>
  </b-card>
</template>

<script>
import DataTable from '@/@core/components/datatable/DataTable.vue'
import { mapActions } from 'vuex'
export default {
  components: { DataTable },
  data() {
    return {
      columns: [
        { key: 'sku', label: 'SKU', sortable: true },
        { key: 'name', label: 'Name', sortable: true },
        { key: 'description', label: 'Description', sortable: true },
        { key: 'style', label: 'Style', sortable: true },
        { key: 'color', label: 'Color', sortable: true },
        { key: 'size', label: 'Size', sortable: true },
        { key: 'price', label: 'Price', sortable: true },
        { key: 'action', label: 'Action', sortable: false },
      ],
    }
  },
  methods: {
    ...mapActions('product', { dataTable: 'dataTable', deleteProduct: 'delete' }),
    remove(item) {
      this.$apiHandler.apiResponseWrapper(async () => {
        const res = await this.deleteProduct(item.id)
        this.$refs.productTable.refresh()
        return res
      })
    },
  },
  filters: {
    formatLength(value, length = 30) {
      if (typeof value !== 'string') return value
      return value.length > length ? value.substr(0, length) + '...' : value
    },
  },
}
</script>