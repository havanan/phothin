<template>
  <v-container fluid>
    <div class="d-flex flex-row justify-center align-center">
      <img src="~/assets/image/logo.png" class="mr-5 nav-logo" width="80px" />
      <h4 class="text-h5">
        Chào mừng:<strong class="ml-2">{{ $auth.user.name }} !</strong>
      </h4>
    </div>
    <v-row class="mt-5">
      <v-col cols="12" md="5">
        <v-container fluid>
          <v-card>
            <v-card-title class="d-flex justify-center"
              ><h5 class="text-h5">Đơn hàng mới</h5></v-card-title
            >
            <v-card-text>
              <v-simple-table>
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-h6 text-left">Khách hàng</th>
                      <th class="text-h6 text-left">Giá đơn</th>
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
            <v-card-title class="d-flex justify-center"
              ><h5 class="text-h5">Đặt lịch mới</h5></v-card-title
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
            <v-card-title class="d-flex justify-center"
              ><h5 class="text-h5">Biểu đồ đơn hàng</h5></v-card-title
            >
            <v-card-text>
              <v-container fluid class="d-flex justify-end">
                <v-radio-group v-model="billType" row>
                  <v-radio
                    v-for="(item, index) in category"
                    :key="index"
                    :label="item.title"
                    :value="item.type"
                    :color="item.color"
                  ></v-radio>
                </v-radio-group>
              </v-container>
            </v-card-text>
          </v-card>
        </v-container>
        <v-container fluid>
          <v-card>
            <v-card-title class="d-flex justify-center"
              ><h5 class="text-h5">Biểu đồ doanh thu</h5></v-card-title
            >
            <v-card-text>
              <v-container fluid class="d-flex justify-end">
                <v-radio-group v-model="revenueType" row>
                  <v-radio
                    v-for="(item, index) in category"
                    :key="index"
                    :label="item.title"
                    :value="item.type"
                    :color="item.color"
                  ></v-radio>
                </v-radio-group>
              </v-container>
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
