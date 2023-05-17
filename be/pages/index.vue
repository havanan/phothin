<template>
  <v-container fluid>
    <v-row class="mt-5">
      <v-col cols="12" md="5">
        <div class="d-flex flex-row justify-start align-center">
          <!-- <img
            src="~/assets/image/logo.png"
            class="mr-5 nav-logo"
            width="80px"
          /> -->
          <h4 class="text-h5">
            Chào mừng:<strong class="ml-2 base-color"
              >{{ $auth.user.name }} !</strong
            >
          </h4>
        </div>
      </v-col>
      <v-col cols="12" md="7">
        <v-row>
          <v-col cols="6" md="3"
            ><v-card
              ><v-card-title>
                <v-btn small color="success" fab
                  ><v-icon color="white">mdi-cart</v-icon></v-btn
                > </v-card-title
              ><v-card-text> biểu đồ 4 </v-card-text></v-card
            ></v-col
          >
          <v-col cols="6" md="3"
            ><v-card
              ><v-card-title>
                <v-btn small color="error" fab
                  ><v-icon>mdi-truck-fast</v-icon></v-btn
                >
              </v-card-title>
              <v-card-text> biểu đồ 1 </v-card-text></v-card
            ></v-col
          >
          <v-col cols="6" md="3"
            ><v-card
              ><v-card-title>
                <v-btn small color="primary" fab
                  ><v-icon>mdi-cash-multiple</v-icon></v-btn
                > </v-card-title
              ><v-card-text> biểu đồ 3 </v-card-text></v-card
            ></v-col
          >
          <v-col cols="6" md="3"
            ><v-card
              ><v-card-title>
                <v-btn small color="purple" fab
                  ><v-icon color="white">mdi-truck-fast</v-icon></v-btn
                > </v-card-title
              ><v-card-text> biểu đồ 2 </v-card-text></v-card
            ></v-col
          >
        </v-row>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" md="5">
        <v-container fluid>
          <v-card>
            <v-card-title
              ><h5 class="text-base font-weight-medium mb-1">
                Đơn hàng chờ xử lý
              </h5></v-card-title
            >
            <v-card-text>
              <v-simple-table>
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-h6 text-left">Khách hàng</th>
                      <th class="text-h6 text-left">Ngày đặt</th>
                      <th class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in desserts" :key="item.name">
                      <td>{{ item.name }}</td>
                      <td>{{ item.calories }}</td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-card-text>
          </v-card>
        </v-container>
        <v-container fluid>
          <v-card>
            <v-card-title
              ><h5 class="text-base font-weight-medium mb-1">
                Đặt lịch chờ xử lý
              </h5></v-card-title
            >
            <v-card-text>
              <v-simple-table>
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-h6 text-left">Khách hàng</th>
                      <th class="text-h6 text-left">Số khách</th>
                      <th class="text-h6 text-left">Ngày đặt</th>
                      <th class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in desserts" :key="item.name">
                      <td>{{ item.name }}</td>
                      <td>{{ item.calories }}</td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-card-text>
          </v-card>
        </v-container>
      </v-col>
      <v-col cols="12" md="7">
        <v-container fluid>
          <v-card>
            <v-card-title>
              <v-row>
                <v-col cols="12" md="6">
                  <h5 class="text-base font-weight-medium mb-1">
                    Biểu đồ đơn hàng
                  </h5>
                </v-col>
                <v-col cols="12" md="6">
                  <v-radio-group
                    class="category-group-checkbox"
                    v-model="billType"
                    row
                  >
                    <v-radio
                      v-for="(item, index) in category"
                      :key="index"
                      :label="item.title"
                      :value="item.type"
                      :color="item.color"
                    ></v-radio>
                  </v-radio-group>
                </v-col>
              </v-row>
            </v-card-title>
            <v-card-text>
              <v-container fluid class="d-flex justify-end"> </v-container>
            </v-card-text>
          </v-card>
        </v-container>
        <v-container fluid>
          <v-card>
            <v-card-title>
              <v-row>
                <v-col cols="12" md="6"
                  ><h5 class="text-base font-weight-medium mb-1">
                    Biểu đồ doanh thu
                  </h5></v-col
                >
                <v-col cols="12" md="6">
                  <v-radio-group
                    class="category-group-checkbox"
                    v-model="revenueType"
                    row
                  >
                    <v-radio
                      v-for="(item, index) in category"
                      :key="index"
                      :label="item.title"
                      :value="item.type"
                      :color="item.color"
                    ></v-radio>
                  </v-radio-group>
                </v-col>
              </v-row>
            </v-card-title>
            <v-card-text>
              <v-container fluid class="d-flex justify-end"> </v-container>
            </v-card-text>
          </v-card>
        </v-container>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "IndexPage",
  head() {
    return {
      title: "Dashboard",
    };
  },
  data() {
    return {
      billType: 0,
      revenueType: 0,
      category: [
        { title: "Ngày", type: 0, color: "success" },
        { title: "Tuần", type: 1, color: "primary" },
        { title: "Tháng", type: 2, color: "error" },
      ],
      desserts: [
        {
          name: "Frozen Yogurt",
          calories: 159,
        },
        {
          name: "Ice cream sandwich",
          calories: 237,
        },
        {
          name: "Eclair",
          calories: 262,
        },
        {
          name: "Cupcake",
          calories: 305,
        },
        {
          name: "Gingerbread",
          calories: 356,
        },
      ],
    };
  },
};
</script>
v-list-item--active v-list-item v-list-item--link theme--light
v-list-group__header v-list-item v-list-item--active v-list-item--link theme--light
v-list-item--active v-list-item v-list-item--link theme--light
