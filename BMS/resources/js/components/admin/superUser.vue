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
                      Add Super Admin</Button
                    >
                  </Col>
                  <Col span="6">
                    <h6 class="text-primary m-0 fw-bold">Super Admin Info</h6>
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
                      :data="superAdmins"
                    >
                      <template slot-scope="{ row, index }" slot="action">
                        <Button
                          @click="
                            editSuperUserModal(
                              index,
                              row.id,
                              row.full_name,
                              row.email,
                              row.store_limit,
                              row.package,
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
    <Modal v-model="addingModal" title="Add New Super Admin" width="70%">
      <template>
        <Form ref="addFormValidation" :model="superAdmin" :rules="ruleValidate">
          <Row>
            <Col span="11">
              <FormItem label="Full Name" prop="full_name">
                <Input
                  v-model="superAdmin.full_name"
                  type="text"
                  placeholder="Ferdinand Mwitumba"
                ></Input>
              </FormItem>
            </Col>
            <Col span="12" offset="1">
              <FormItem label="Email Address" prop="email_address">
                <Input
                  v-model="superAdmin.email_address"
                  type="email"
                  placeholder="example@mail.com"
                ></Input>
              </FormItem>
            </Col>
            <Col span="11">
              <FormItem label="Store" prop="store_limit">
                <Input
                  v-model="superAdmin.store_limit"
                  type="number"
                  placeholder="Number of store"
                ></Input>
              </FormItem>
            </Col>
            <Col span="12" offset="1">
              <FormItem label="Package" prop="package">
                <Select v-model="superAdmin.package">
                  <Option value="beijing">Uhuru</Option>
                  <Option value="shanghai">Umoja</Option>
                  <Option value="shenzhen">Twaweza</Option>
                </Select>
              </FormItem>
            </Col>
            <Col span="11">
              <FormItem label="Phone Number" prop="phone_number">
                <Input
                  v-model="superAdmin.phone_number"
                  type="tel"
                  placeholder="+255 768 543 991"
                ></Input>
              </FormItem>
            </Col>
            <Col span="12" offset="1">
              <FormItem label="Password" prop="password">
                <Input
                  v-model="superAdmin.password"
                  type="password"
                  placeholder="**********"
                ></Input>
              </FormItem>
            </Col>
          </Row>

          <!-- <FormItem label="Select">
            <Select v-model="formItem.select">
              <Option value="beijing">New York</Option>
              <Option value="shanghai">London</Option>
              <Option value="shenzhen">Sydney</Option>
            </Select>
          </FormItem>
          <FormItem label="DatePicker">
            <Row>
              <Col span="11">
                <DatePicker
                  type="date"
                  placeholder="Select date"
                  v-model="formItem.date"
                ></DatePicker>
              </Col>
              <Col span="2" style="text-align: center">-</Col>
              <Col span="11">
                <TimePicker
                  type="time"
                  placeholder="Select time"
                  v-model="formItem.time"
                ></TimePicker>
              </Col>
            </Row>
          </FormItem> -->
        </Form>
      </template>
      <div slot="footer">
        <Button @click="closeModal('addFormValidation')" type="error">
          <Icon type="md-close-circle" size="18" />
          Cancel</Button
        >
        <Button
          @click="addSuperUser('addFormValidation')"
          type="primary"
          :disabled="isSaving"
          :loading="isSaving"
        >
          <Icon type="md-document" size="18" />
          {{ isSaving ? "Saving..." : "Save" }}</Button
        >
      </div>
    </Modal>

    <Modal v-model="editingModal" title="Edit Super Admin Info" width="70%">
      <template>
        <Form ref="editFormValidation" :model="superAdmin" :rules="updateRuleValidate">
          <Row>
            <Col span="11">
              <FormItem label="Full Name" prop="full_name">
                <Input
                  v-model="superAdmin.full_name"
                  type="text"
                  placeholder="Ferdinand Mwitumba"
                ></Input>
              </FormItem>
            </Col>
            <Col span="12" offset="1">
              <FormItem label="Email Address" prop="email_address">
                <Input
                  v-model="superAdmin.email_address"
                  type="email"
                  placeholder="example@mail.com"
                ></Input>
              </FormItem>
            </Col>
            <Col span="11">
              <FormItem label="Store" prop="store_limit">
                <Input
                  v-model="superAdmin.store_limit"
                  type="number"
                  placeholder="Number of store"
                ></Input>
              </FormItem>
            </Col>
            <Col span="12" offset="1">
              <FormItem label="Package" prop="package">
                <Select v-model="superAdmin.package">
                  <Option value="beijing">Uhuru</Option>
                  <Option value="shanghai">Umoja</Option>
                  <Option value="shenzhen">Twaweza</Option>
                </Select>
              </FormItem>
            </Col>
            <Col span="11">
              <FormItem label="Phone Number" prop="phone_number">
                <Input
                  v-model="superAdmin.phone_number"
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
                  v-model="superAdmin.password"
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
          @click="editSuperUser('editFormValidation')"
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
      superAdmins: [],
      tableLoading: true,
      keyword: "",
      editingModal: false,
      isEditing: false,
      superAdminId: "",
      rowIndex: "",
      status: "",
      superAdmin: {
        full_name: "",
        email_address: "",
        store_limit: "",
        phone_number: "",
        package: "",
        password: "",
      },

      ruleValidate: {
        full_name: [
          {
            required: true,
            message: "Full name field cannot be empty!",
            trigger: "blur",
          },
        ],
        email_address: [
          { required: true, message: "Mailbox cannot be empty!", trigger: "blur" },
          { type: "email", message: "Incorrect email format", trigger: "blur" },
        ],
        store_limit: [
          { required: true, message: "Store number cannot be empty!", trigger: "blur" },
        ],
        phone_number: [
          { required: true, message: "Phone number cannot be empty!", trigger: "blur" },
        ],
        package: [
          { required: true, message: "Please select package", trigger: "change" },
        ],
        password: [
          { required: true, message: "Password cannot be empty!", trigger: "blur" },
        ],
      },

      updateRuleValidate: {
        full_name: [
          {
            required: true,
            message: "Full name field cannot be empty!",
            trigger: "blur",
          },
        ],
        email_address: [
          { required: true, message: "Mailbox cannot be empty!", trigger: "blur" },
          { type: "email", message: "Incorrect email format", trigger: "blur" },
        ],
        store_limit: [
          { required: true, message: "Store number cannot be empty!", trigger: "blur" },
        ],
        phone_number: [
          { required: true, message: "Phone number cannot be empty!", trigger: "blur" },
        ],
        package: [
          { required: true, message: "Please select package", trigger: "change" },
        ],
      },

      columns: [
        { title: "Name", key: "full_name", sortable: true },
        { title: "Email", key: "email" },
        { title: "Phone Number", key: "phone_number" },
        { title: "Total Store", key: "store_limit", sortable: true },
        { title: "Status", key: "status", sortable: true },
        { title: "Action", slot: "action", align: "center" },
      ],
    };
  },

  async created() {
    await this.getSuperAdmins();
  },

  methods: {
    async getSuperAdmins() {
      const res = await this.callApi("get", "/get_super_admins");
      if (res.data.status === "success") {
        this.superAdmins = res.data.data;
        this.tableLoading = false;
      } else {
        this.superAdmins = [];
        this.tableLoading = false;
      }
    },

    addSuperUser(name) {
      this.$refs[name].validate(async (valid) => {
        if (valid) {
          this.isSaving = true;
          const res = await this.callApi("post", "/add_new_super_admin", this.superAdmin);
          if (res.data.status_code === 201) {
            await this.getSuperAdmins();
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

    editSuperUserModal(index, id, full_name, email, store_limit, packages, phone_number) {
      this.editingModal = true;
      this.rowIndex = index;
      this.superAdminId = id;
      this.superAdmin.full_name = full_name;
      this.superAdmin.email_address = email;
      this.superAdmin.store_limit = store_limit;
      this.superAdmin.package = packages;
      this.superAdmin.phone_number = phone_number;
    },

    editSuperUser(name) {
      this.$refs[name].validate(async (valid) => {
        if (valid) {
          this.isEditing = true;
          const updatedData = { id: this.superAdminId, ...this.superAdmin };
          const res = await this.callApi("post", "/edit_super_admin", updatedData);
          if (res.data.status === "success") {
            await this.getSuperAdmins();
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

    searchSuperAdmin() {
      console.log(this.keyword);
      return this.superAdmins.filter((object) => {
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
