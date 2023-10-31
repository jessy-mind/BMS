<template>
  <div>
    <div id="wrapper">
      <Sidebar />
      <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
          <Navbar />
          <div class="container-fluid">
            <div class="card shadow">
              <div class="card-header py-3">
                <Row>
                  <Col span="9">
                    <Button @click="addingModal = true" type="primary" ghost>
                      <Icon type="md-add" />
                      Add Product</Button
                    >
                  </Col>
                  <Col span="6">
                    <h6 class="text-primary m-0 fw-bold">Products Info</h6>
                  </Col>
                  <Col span="7" offset="2">
                    <Input
                      search
                      @keyup="searchSuperAdmin()"
                      v-model="keyword"
                      placeholder="Seach super admin name, phone number or email"
                    />
                  </Col>
                </Row>
              </div>
              <div class="card-body">
                <div>
                  <template>
                    <Table
                      :loading="tableLoading"
                      stripe
                      border
                      height="450"
                      :columns="columns"
                      :data="products"
                    >
                      <template slot-scope="{ row, index }" slot="action">
                        <Button
                          @click="
                            editProductModal(
                              index,
                              row.id,
                              row.stores_id,
                              row.product_name,
                              row.product_quantity,
                              row.buying_price,
                              row.selling_price
                            )
                          "
                          type="success"
                          size="small"
                        >
                          <Icon type="md-create" size="16" /> Edit</Button
                        >
                        <i-switch
                          @change="
                            updateStatus(
                              row.status != 'Available' ? 'Available' : 'Out of Stock'
                            )
                          "
                          v-model="row.status"
                          true-value="Available"
                          false-value="Out of Stock"
                          true-color="#13ce66"
                          false-color="#ff4949"
                          size="small"
                          :disabled="true"
                        />
                      </template>
                    </Table>
                  </template>
                </div>
                <div class="row">
                  <div class="col-md-6 align-self-center"></div>
                  <div class="col-md-6"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <Footer />
      </div>
      <a class="border rounded d-inline scroll-to-top" href="#page-top"
        ><i class="fas fa-angle-up"></i
      ></a>
    </div>
    <Modal v-model="addingModal" title="Add New Product" width="50%">
      <template>
        <Form ref="addFormValidation" :model="product" :rules="ruleValidate">
          <Row>
            <Col span="24">
              <FormItem label="Store" prop="stores_assigned">
                <Select v-model="product.stores_assigned" filterable multiple>
                  <Option
                    v-for="(store, i) in stores"
                    :key="store.id"
                    :value="store.id"
                    >{{ store.store_name }}</Option
                  >
                </Select>
              </FormItem>
            </Col>
            <Col span="24">
              <FormItem label="Product Name" prop="product_name">
                <Input
                  v-model="product.product_name"
                  type="text"
                  placeholder="Tembo Cement"
                ></Input>
              </FormItem>
            </Col>
            <Col span="7">
              <FormItem label="Product Quantity" prop="quantity">
                <Input
                  v-model="product.quantity"
                  type="number"
                  placeholder="10 pcs"
                ></Input>
              </FormItem>
            </Col>
            <Col span="8" offset="1">
              <FormItem label="Buying Price per quantity" prop="buying_price">
                <Input
                  v-model="product.buying_price"
                  type="number"
                  placeholder="10000 per pc"
                ></Input>
              </FormItem>
            </Col>
            <Col span="7" offset="1">
              <FormItem label="Selling Price per quantity" prop="selling_price">
                <Input
                  v-model="product.selling_price"
                  type="number"
                  placeholder="12000 per pc"
                ></Input>
              </FormItem>
            </Col>
          </Row>
        </Form>
      </template>
      <div slot="footer">
        <Button @click="closeModal('addFormValidation')" type="error">
          <Icon type="md-close-circle" size="18" />
          Cancel</Button
        >
        <Button
          @click="addProduct('addFormValidation')"
          type="primary"
          :disabled="isSaving"
          :loading="isSaving"
        >
          <Icon type="md-document" size="18" />
          {{ isSaving ? "Saving..." : "Save" }}</Button
        >
      </div>
    </Modal>

    <Modal v-model="editingModal" title="Edit Product Info" width="50%">
      <template>
        <Form ref="editFormValidation" :model="product" :rules="updateRuleValidate">
          <Row>
            <Col span="24">
              <FormItem label="Store" prop="stores_assigned">
                <Select v-model="product.stores_assigned" filterable multiple>
                  <Option
                    v-for="(store, i) in stores"
                    :key="store.id"
                    :value="store.id"
                    >{{ store.store_name }}</Option
                  >
                </Select>
              </FormItem>
            </Col>
            <Col span="24">
              <FormItem label="Product Name" prop="product_name">
                <Input
                  v-model="product.product_name"
                  type="text"
                  placeholder="Tembo Cement"
                ></Input>
              </FormItem>
            </Col>
            <Col span="7">
              <FormItem label="Product Quantity" prop="quantity">
                <Input
                  v-model="product.quantity"
                  type="number"
                  placeholder="10 pcs"
                ></Input>
              </FormItem>
            </Col>
            <Col span="8" offset="1">
              <FormItem label="Buying Price per quantity" prop="buying_price">
                <Input
                  v-model="product.buying_price"
                  type="number"
                  placeholder="10000 per pc"
                ></Input>
              </FormItem>
            </Col>
            <Col span="7" offset="1">
              <FormItem label="Selling Price per quantity" prop="selling_price">
                <Input
                  v-model="product.selling_price"
                  type="number"
                  placeholder="12000 per pc"
                ></Input>
              </FormItem>
            </Col>
          </Row>
        </Form>
      </template>
      <div slot="footer">
        <Button @click="closeModal('editFormValidation')" type="error">
          <Icon type="md-close-circle" size="18" />
          Cancel</Button
        >
        <Button
          @click="editProduct('editFormValidation')"
          type="primary"
          :disabled="isEditing"
          :loading="isEditing"
        >
          <Icon type="md-document" size="18" />
          {{ isEditing ? "Updating..." : "Update" }}</Button
        >
      </div>
    </Modal>
  </div>
</template>

<script>
import Sidebar from "./incs/sidebar.vue";
import Navbar from "./incs/navbar.vue";
import Footer from "./incs/footer.vue";

export default {
  components: { Sidebar, Navbar, Footer },

  data() {
    return {
      addingModal: false,
      isSaving: false,
      products: [],
      stores: [],
      tableLoading: true,
      keyword: "",
      editingModal: false,
      isEditing: false,
      productId: "",
      rowIndex: "",
      status: "",
      product: {
        product_name: "",
        quantity: "",
        buying_price: "",
        selling_price: "",
        stores_assigned: "",
      },

      ruleValidate: {
        product_name: [
          {
            required: true,
            message: "Product name is required.",
            trigger: "blur",
          },
        ],
        quantity: [
          { required: true, message: "Product quantity is required.", trigger: "blur" },
        ],
        buying_price: [
          { required: true, message: "Buying price is required.", trigger: "blur" },
        ],
        selling_price: [
          { required: true, message: "Selling price is required.", trigger: "blur" },
        ],
        stores_assigned: [
          {
            required: true,
            type: "array",
            min: 1,
            message: "Please select at least one store",
            trigger: "change",
          },
        ],
      },

      updateRuleValidate: {
        product_name: [
          {
            required: true,
            message: "Product name is required.",
            trigger: "blur",
          },
        ],
        quantity: [
          { required: true, message: "Product quantity is required.", trigger: "blur" },
        ],
        buying_price: [
          { required: true, message: "Buying price is required.", trigger: "blur" },
        ],
        selling_price: [
          { required: true, message: "Selling price is required.", trigger: "blur" },
        ],
        stores_assigned: [
          {
            required: true,
            type: "array",
            min: 1,
            message: "Please select at least one store",
            trigger: "change",
          },
        ],
      },

      columns: [
        { title: "Name", key: "product_name", sortable: true },
        { title: "Store(s)", key: "stores_id" },
        { title: "Available QTY", key: "product_quantity" },
        { title: "Buying @", key: "buying_price", sortable: true },
        { title: "Selling @", key: "selling_price", sortable: true },
        { title: "Status", key: "status", sortable: true },
        { title: "Action", slot: "action", align: "center" },
      ],
    };
  },

  async created() {
    await this.getProducts();
    await this.getStores();
  },

  methods: {
    async getStores() {
      const res = await this.callApi("get", "/get_stores");
      if (res.data.status === "success") {
        this.stores = res.data.data;
        this.tableLoading = false;
      } else {
        this.stores = [];
        this.tableLoading = false;
      }
    },

    async getProducts() {
      const res = await this.callApi("get", "/get_products");
      if (res.data.status === "success") {
        this.products = res.data.data;
        this.tableLoading = false;
      } else {
        this.products = [];
        this.tableLoading = false;
      }
    },

    addProduct(name) {
      this.$refs[name].validate(async (valid) => {
        if (valid) {
          this.isSaving = true;
          const res = await this.callApi("post", "/add_new_product", this.product);
          if (res.data.status_code === 201) {
            await this.getProducts();
            this.addingModal = false;
            this.isSaving = false;
            this.$refs[name].resetFields();
            return this.s(
              res.data.data.product_name + " was added successfully as new product"
            );
          } else {
            this.isSaving = false;
            return this.swr();
          }
        } else {
        }
      });
    },

    editProductModal(
      index,
      id,
      stores_id,
      product_name,
      quantity,
      buying_price,
      selling_price
    ) {
      this.editingModal = true;
      this.rowIndex = index;
      this.productId = id;
      this.product.stores_assigned = [stores_id];
      this.product.product_name = product_name;
      this.product.quantity = quantity;
      this.product.buying_price = buying_price;
      this.product.selling_price = selling_price;
    },

    editProduct(name) {
      this.$refs[name].validate(async (valid) => {
        if (valid) {
          this.isEditing = true;
          const updatedData = { id: this.productId, ...this.product };
          const res = await this.callApi("post", "/edit_product", updatedData);
          if (res.data.status === "success") {
            await this.getProducts();
            this.editingModal = false;
            this.isEditing = false;
            this.$refs[name].resetFields();
            return this.s(res.data.data.product_name + " info was updated successfully");
          } else {
            this.isEditing = false;
            return this.swr();
          }
        } else {
        }
      });
    },

    updateStatus(status) {
      console.log(status);
    },

    searchSuperAdmin() {
      console.log(this.keyword);
      return this.products.filter((object) => {
        return (
          object.product_name.toLowerCase().includes(this.keyword.toLowerCase()) ||
          object.email.toLowerCase().includes(this.keyword.toLowerCase()) ||
          object.phone_number.toLowerCase().includes(this.keyword.toLowerCase())
        );
      });
    },

    closeModal(name) {
      (this.addingModal = false),
        (this.editingModal = false),
        this.$refs[name].resetFields();
    },
  },
};
</script>
