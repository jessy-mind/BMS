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
                      Add Store</Button
                    >
                  </Col>
                  <Col span="6">
                    <h6 class="text-primary m-0 fw-bold">Stores Info</h6>
                  </Col>
                  <Col span="7" offset="2">
                    <Input
                      search
                      @keyup="searchstore()"
                      v-model="keyword"
                      placeholder="Seach store name"
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
                      :data="stores"
                    >
                      <template slot-scope="{ row, index }" slot="photo">
                        <img
                          v-if="row.photo"
                          class="img-fluid"
                          width="60"
                          style="border-radius: 10%"
                          :src="`uploads/store/${row.photo}`"
                          alt="Store Image"
                        />
                        <img
                          class="img-fluid"
                          width="60"
                          style="border-radius: 10%"
                          v-else
                          src="uploads/store/default.png"
                          alt="Store Image"
                        />
                      </template>
                      <template slot-scope="{ row, index }" slot="action">
                        <Button
                          @click="
                            editStoreModal(index, row.id, row.store_name, row.photo)
                          "
                          type="success"
                        >
                          <Icon type="md-create" size="16" /> Edit</Button
                        >
                        <i-switch
                          @change="
                            updateStatus(row.status != 'Active' ? 'Active' : 'Blocked')
                          "
                          v-model="row.status"
                          true-value="Active"
                          false-value="Blocked"
                          true-color="#13ce66"
                          false-color="#ff4949"
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
    <Modal v-model="addingModal" title="Add Store" width="40%">
      <template>
        <Form ref="addFormValidation" :model="store" :rules="ruleValidate">
          <Row>
            <Col span="24">
              <FormItem label="Store Name" prop="store_name">
                <Input
                  v-model="store.store_name"
                  type="text"
                  placeholder="Kabweza Hardware"
                ></Input>
              </FormItem>
            </Col>
            <template>
              <Upload
                action="/upload_store."
                type="drag"
                :headers="{ 'x-csrf-token': token }"
                :on-success="handleSuccess"
                :format="['png', 'jpg', 'jpeg']"
                :on-format-error="handleFormatError"
                :on-exceeded-size="handleMaxSize"
                :max-size="2048"
              >
                <div style="padding: 20px 0">
                  <Icon type="ios-cloud-upload" size="52" style="color: #3399ff" />
                  <p>Click or drag store picture here to upload</p>
                </div>
              </Upload>
            </template>
            <Col span="24" v-if="store.store_picture">
              <img :src="`uploads/store/${store.store_picture}`" class="img-fluid" />
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
          @click="addStore('addFormValidation')"
          type="primary"
          :disabled="isSaving"
          :loading="isSaving"
        >
          <Icon type="md-document" size="18" />
          {{ isSaving ? "Saving..." : "Save" }}</Button
        >
      </div>
    </Modal>

    <Modal v-model="editingModal" title="Edit Store Info" width="40%">
      <template>
        <Form ref="editFormValidation" :model="store" :rules="ruleValidate">
          <Row>
            <Col span="24">
              <FormItem label="Store Name" prop="store_name">
                <Input
                  v-model="store.store_name"
                  type="text"
                  placeholder="Kabweza Hardware"
                ></Input>
              </FormItem>
            </Col>
            <template>
              <Upload
                action="/upload_store_picture"
                type="drag"
                :headers="{ 'x-csrf-token': token }"
                :on-success="handleSuccess"
                :format="['png', 'jpg', 'jpeg']"
                :on-format-error="handleFormatError"
                :on-exceeded-size="handleMaxSize"
                :max-size="2048"
              >
                <div style="padding: 20px 0">
                  <Icon type="ios-cloud-upload" size="52" style="color: #3399ff" />
                  <p>Click or drag store picture here to upload</p>
                </div>
              </Upload>
            </template>
            <Col span="24" v-if="store.store_picture">
              <img :src="`uploads/store/${store.store_picture}`" class="img-fluid" />
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
          @click="editStore('editFormValidation')"
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
      stores: [],
      tableLoading: true,
      keyword: "",
      editingModal: false,
      isEditing: false,
      storeId: "",
      rowIndex: "",
      status: "",
      token: "",
      store: { store_name: "", store_picture: "" },

      ruleValidate: {
        store_name: [
          {
            required: true,
            message: "Store name cannot be empty.",
            trigger: "blur",
          },
        ],
      },

      updateRuleValidate: {
        store_name: [
          {
            required: true,
            message: "Store name cannot be empty.",
            trigger: "blur",
          },
        ],
      },

      columns: [
        { title: "Picture", slot: "photo", align: "center" },
        { title: "Store Name", key: "store_name", align: "center", sortable: true },
        { title: "Status", key: "status", align: "center" },
        { title: "Action", slot: "action", align: "center" },
      ],
    };
  },

  async created() {
    this.token = window.Laravel.csrfToken;
    await this.getStores();
  },

  methods: {
    handleSuccess(res, file) {
      this.store.store_picture = res;
    },

    handleFormatError(file) {
      this.$Notice.warning({
        title: "The file format is incorrect",
        desc: "File format of " + file.name + " is incorrect, Please select jpg or png. ",
      });
    },

    handleMaxSize(file) {
      this.$Notice.warning({
        title: "Exceeding file size limit",
        desc: "File " + file.name + " is too large, no more than 2 MB. ",
      });
    },

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

    addStore(name) {
      this.$refs[name].validate(async (valid) => {
        if (valid) {
          this.isSaving = true;
          const res = await this.callApi("post", "/add_new_store", this.store);
          if (res.data.status_code === 201) {
            this.getStores();
            this.addingModal = false;
            this.isSaving = false;
            this.$refs[name].resetFields();
            return this.s(res.data.data.store_name + " was added successfully as store");
          } else {
            this.isSaving = false;
            return this.swr();
          }
        } else {
        }
      });
    },

    editStoreModal(index, id, store_name, store_picture) {
      this.editingModal = true;
      this.rowIndex = index;
      this.storeId = id;
      this.store.store_name = store_name;
      if (store_picture) {
        this.store.store_picture = store_picture;
      } else {
        this.store.store_picture = "";
      }
    },

    editStore(name) {
      this.$refs[name].validate(async (valid) => {
        if (valid) {
          this.isEditing = true;
          const updatedData = { id: this.storeId, ...this.store };
          const res = await this.callApi("post", "/edit_store", updatedData);
          if (res.data.status === "success") {
            await this.getStores();
            this.editingModal = false;
            this.isEditing = false;
            this.$refs[name].resetFields();
            return this.s(res.data.data.store_name + " info was updated successfully");
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

    searchStore() {
      console.log(this.keyword);
      return this.stores.filter((object) => {
        return (
          object.store_name.toLowerCase().includes(this.keyword.toLowerCase()) ||
          object.email.toLowerCase().includes(this.keyword.toLowerCase()) ||
          object.phone_number.toLowerCase().includes(this.keyword.toLowerCase())
        );
      });
    },

    closeModal(name) {
      (this.addingModal = false),
        (this.editingModal = false),
        (this.store.store_picture = "");
      this.$refs[name].resetFields();
    },
  },
};
</script>
