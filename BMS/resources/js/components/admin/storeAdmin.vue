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
                      Add Store Admin</Button
                    >
                  </Col>
                  <Col span="6">
                    <h6 class="text-primary m-0 fw-bold">Store Admin Info</h6>
                  </Col>
                  <Col span="7" offset="2">
                    <Input
                      search
                      @keyup="searchstoreAdmin()"
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
                      :data="storeAdmins"
                    >
                      <template slot-scope="{ row, index }" slot="action">
                        <Button
                          @click="
                            editStoreAdminModal(
                              index,
                              row.id,
                              row.full_name,
                              row.email,
                              row.stores_id,
                              row.phone_number
                            )
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
    <Modal v-model="addingModal" title="Add New Store Admin" width="70%">
      <template>
        <Form ref="addFormValidation" :model="storeAdmin" :rules="ruleValidate">
          <Row>
            <Col span="11">
              <FormItem label="Full Name" prop="full_name">
                <Input
                  v-model="storeAdmin.full_name"
                  type="text"
                  placeholder="Ferdinand Mwitumba"
                ></Input>
              </FormItem>
            </Col>
            <Col span="12" offset="1">
              <FormItem label="Email Address" prop="email_address">
                <Input
                  v-model="storeAdmin.email_address"
                  type="email"
                  placeholder="example@mail.com"
                ></Input>
              </FormItem>
            </Col>
            <Col span="24">
              <FormItem label="Store" prop="stores_assigned">
                <Select v-model="storeAdmin.stores_assigned" filterable multiple>
                  <Option
                    v-for="(store, i) in stores"
                    :key="store.id"
                    :value="store.id"
                    >{{ store.store_name }}</Option
                  >
                </Select>
              </FormItem>
            </Col>
            <Col span="11">
              <FormItem label="Phone Number" prop="phone_number">
                <Input
                  v-model="storeAdmin.phone_number"
                  type="tel"
                  placeholder="+255 768 543 991"
                ></Input>
              </FormItem>
            </Col>
            <Col span="12" offset="1">
              <FormItem label="Password" prop="password">
                <Input
                  v-model="storeAdmin.password"
                  type="password"
                  placeholder="**********"
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
          @click="addStoreAdmin('addFormValidation')"
          type="primary"
          :disabled="isSaving"
          :loading="isSaving"
        >
          <Icon type="md-document" size="18" />
          {{ isSaving ? "Saving..." : "Save" }}</Button
        >
      </div>
    </Modal>

    <Modal v-model="editingModal" title="Edit Store Admin Info" width="70%">
      <template>
        <Form ref="editFormValidation" :model="storeAdmin" :rules="updateRuleValidate">
          <Row>
            <Col span="11">
              <FormItem label="Full Name" prop="full_name">
                <Input
                  v-model="storeAdmin.full_name"
                  type="text"
                  placeholder="Ferdinand Mwitumba"
                ></Input>
              </FormItem>
            </Col>
            <Col span="12" offset="1">
              <FormItem label="Email Address" prop="email_address">
                <Input
                  v-model="storeAdmin.email_address"
                  type="email"
                  placeholder="example@mail.com"
                ></Input>
              </FormItem>
            </Col>
            <Col span="24">
              <FormItem label="Store" prop="stores_assigned">
                <Select v-model="storeAdmin.stores_assigned" filterable multiple>
                  <Option
                    v-for="(store, i) in stores"
                    :key="store.id"
                    :value="store.id"
                    >{{ store.store_name }}</Option
                  >
                </Select>
              </FormItem>
            </Col>
            <Col span="11">
              <FormItem label="Phone Number" prop="phone_number">
                <Input
                  v-model="storeAdmin.phone_number"
                  type="tel"
                  placeholder="+255 768 543 991"
                ></Input>
              </FormItem>
            </Col>
            <Col span="12" offset="1">
              <FormItem label="Password" prop="password">
                <p style="color: red" class="text-center">
                  Leave empty if you don't want to change password
                </p>
                <Input
                  v-model="storeAdmin.password"
                  type="password"
                  placeholder="**********"
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
          @click="editStoreAdmin('editFormValidation')"
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
      storeAdmins: [],
      tableLoading: true,
      keyword: "",
      editingModal: false,
      isEditing: false,
      storeAdminId: "",
      rowIndex: "",
      status: "",
      stores: [],
      storeAdmin: {
        full_name: "",
        email_address: "",
        phone_number: "",
        stores_assigned: [],
        password: "",
      },

      ruleValidate: {
        full_name: [
          {
            required: true,
            message: "Full name field cannot be empty.",
            trigger: "blur",
          },
        ],
        email_address: [
          { required: true, message: "Mailbox cannot be empty.", trigger: "blur" },
          { type: "email", message: "Incorrect email format", trigger: "blur" },
        ],
        phone_number: [
          { required: true, message: "Phone number cannot be empty.", trigger: "blur" },
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
        password: [
          { required: true, message: "Password cannot be empty.", trigger: "blur" },
        ],
      },

      updateRuleValidate: {
        full_name: [
          {
            required: true,
            message: "Full name field cannot be empty.",
            trigger: "blur",
          },
        ],
        email_address: [
          { required: true, message: "Mailbox cannot be empty.", trigger: "blur" },
          { type: "email", message: "Incorrect email format", trigger: "blur" },
        ],
        phone_number: [
          { required: true, message: "Phone number cannot be empty.", trigger: "blur" },
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
        { title: "Name", key: "full_name", sortable: true },
        { title: "Email", key: "email" },
        { title: "Phone Number", key: "phone_number" },
        { title: "Assigned Store", key: "stores_id", sortable: true },
        { title: "Status", key: "status", sortable: true },
        { title: "Action", slot: "action", align: "center" },
      ],
    };
  },

  async created() {
    await this.getStoreAdmins();
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

    async getStoreAdmins() {
      const res = await this.callApi("get", "/get_store_admins");
      if (res.data.status === "success") {
        this.storeAdmins = res.data.data;
        this.tableLoading = false;
      } else {
        this.storeAdmins = [];
        this.tableLoading = false;
      }
    },

    addStoreAdmin(name) {
      this.$refs[name].validate(async (valid) => {
        if (valid) {
          this.isSaving = true;
          const res = await this.callApi("post", "/add_new_store_admin", this.storeAdmin);
          if (res.data.status_code === 201) {
            await this.getStoreAdmins();
            this.addingModal = false;
            this.isSaving = false;
            this.$refs[name].resetFields();
            return this.s(
              res.data.data.full_name + " was added successfully as super admin"
            );
          } else {
            this.isSaving = false;
            return this.swr();
          }
        } else {
        }
      });
    },

    editStoreAdminModal(index, id, full_name, email, stores_id, phone_number) {
      this.editingModal = true;
      this.rowIndex = index;
      this.storeAdminId = id;
      this.storeAdmin.full_name = full_name;
      this.storeAdmin.email_address = email;
      this.storeAdmin.stores_assigned = [stores_id];
      this.storeAdmin.phone_number = phone_number;
    },

    editStoreAdmin(name) {
      this.$refs[name].validate(async (valid) => {
        if (valid) {
          this.isEditing = true;
          const updatedData = { id: this.storeAdminId, ...this.storeAdmin };
          const res = await this.callApi("post", "/edit_store_admin", updatedData);
          if (res.data.status === "success") {
            await this.getStoreAdmins();
            this.editingModal = false;
            this.isEditing = false;
            this.$refs[name].resetFields();
            return this.s(res.data.data.full_name + " info was updated successfully");
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

    searchstoreAdmin() {
      console.log(this.keyword);
      return this.storeAdmins.filter((object) => {
        return (
          object.full_name.toLowerCase().includes(this.keyword.toLowerCase()) ||
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
