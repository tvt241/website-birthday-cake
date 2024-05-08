<template>
  <div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card card-default card-mini">
            <div class="card-header">
                <h2>{{ saleCount }}</h2>
                <div class="sub-title">
                    <span class="mr-1">Đơn hàng năm nay</span>
                    <!-- <span class="mx-1">45%</span>
                    <i class="mdi mdi-arrow-up-bold text-success"></i> -->
                </div>
            </div>
            <div class="card-body">
                <div class="chart-wrapper">
                    <div>
                        <div id="sales-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card card-default card-mini">
            <div class="card-header">
                <h2>{{ formatCurrency(revenueCount) }}</h2>
                <div class="sub-title">
                    <span class="mr-1">Doanh thu năm nay</span> 
                    <!-- <span class="mx-1">35%</span>
                    <i class="mdi mdi-arrow-up-bold text-success"></i> -->
                </div>
            </div>
            <div class="card-body">
                <div class="chart-wrapper">
                    <div>
                        <div id="revenue-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card card-default card-mini">
        <div class="card-header">
            <h2>{{ formatCurrency(expenseCount) }}</h2>
            <div class="sub-title">
                <span class="mr-1">Chi phí năm nay</span> 
                <!-- <span class="mx-1">50%</span>
                <i class="mdi mdi-arrow-down-bold text-danger"></i> -->
            </div>
        </div>
        <div class="card-body">
            <div class="chart-wrapper">
                <div>
                    <div id="expense-chart"></div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card card-default card-mini">
            <div class="card-header">
                <h2>{{ formatCurrency(incomeCount) }}</h2>
                <div class="sub-title">
                    <span class="mr-1">Lợi nhuận năm nay</span> 
                    <!-- <span class="mx-1">20%</span>
                    <i class="mdi mdi-arrow-down-bold text-danger"></i> -->
                </div>
            </div>
            <div class="card-body">
                <div class="chart-wrapper">
                    <div>
                        <div id="income-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
      <div class="col-xl-12">        
          <div class="card card-default">
              <div class="card-header">
                  <h2>Thu nhập và chi tiêu</h2>
              </div>
              <div class="card-body">
                  <div class="chart-wrapper">
                      <div id="income-and-expenses"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-xl-4">
          <div class="card card-default">
              <div class="card-header">
                  <h2>Khách hàng hàng đầu</h2>
              </div>
              <div class="card-body">
              <table class="table table-borderless table-thead-border">
                  <thead>
                      <tr>
                          <th>Tên</th>
                          <th class="text-right">Chi tiêu</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td class="text-dark font-weight-bold">Gunter Reich</td>
                          <td class="text-right">$2,560</td>
                      </tr>
                      <tr>
                          <td class="text-dark font-weight-bold">Anke Kirsch</td>
                          <td class="text-right">$1,720</td>
                      </tr>
                      <tr>
                          <td class="text-dark font-weight-bold">Karolina Beer</td>
                          <td class="text-right">$1,230</td>
                      </tr>
                      <tr>
                          <td class="text-dark font-weight-bold">Lucia Christ</td>
                          <td class="text-right">$875</td>
                      </tr>
                      <tr>
                          <td class="text-dark font-weight-bold">Lucia Christ</td>
                          <td class="text-right">$875</td>
                      </tr>
                  </tbody>
                  <tfoot class="border-top">
                  <tr>
                      <td>
                          <a href="#" class="text-uppercase">Xem tất cả</a>
                      </td>
                  </tr>
                  </tfoot>
              </table>
              </div>
          </div>
      </div>
      <div class="col-xl-8">
          <div class="card card-default">
              <div class="card-header align-items-center">
                  <h2 class="">Sản phẩm bán chạy</h2>
              </div>
              <div class="card-body">
                  <div class="tab-content">
                      <table id="product-sale" class="table table-product " style="width:100%">
                          <thead>
                              <tr>
                                  <th>Tên sản phẩm</th>
                                  <th>Số lượng</th>
                                  <th>Thu nhập</th>
                                  <th>% đã bán</th>
                                  <th class="th-width-250"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>Coach Swagger</td>
                                  <td>134</td>
                                  <td>$24541</td>
                                  <td>35.28%</td>
                                  <td>
                                      <div class="progress progress-md rounded-0">
                                      <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70%" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                  </td>
                              </tr>

                              <tr>
                                  <td>Toddler Shoes</td>
                                  <td>119</td>
                                  <td>$20225</td>
                                  <td>27.05%</td>
                                  <td>
                                      <div class="progress progress-md rounded-0">
                                      <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55%" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                  </td>
                              </tr>

                              <tr>
                                  <td>Hat Black Suits</td>
                                  <td>101</td>
                                  <td>$17,290</td>
                                  <td>20.25%</td>
                                  <td>
                                      <div class="progress progress-md rounded-0">
                                      <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45%" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                  </td>
                              </tr>

                              <tr>
                                  <td>Backpack Gents</td>
                                  <td>59</td>
                                  <td>$1150</td>
                                  <td>12.50%</td>
                                  <td>
                                      <div class="progress progress-md rounded-0">
                                      <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25%" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                  </td>
                              </tr>

                              <tr>
                                  <td>Speed 500 Ignite</td>
                                  <td>25</td>
                                  <td>$590</td>
                                  <td>02.10%</td>
                                  <td>
                                      <div class="progress progress-md rounded-0">
                                      <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10%" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                  </td>
                              </tr>

                              <tr>
                                  <td>Earphone & Headphone</td>
                                  <td>23</td>
                                  <td>$450</td>
                                  <td>02%</td>
                                  <td>
                                      <div class="progress progress-md rounded-0">
                                      <div class="progress-bar" role="progressbar" style="width: 8%" aria-valuenow="8%" aria-valuemin="0"
                                          aria-valuemax="100"></div>
                                      </div>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import ApexCharts from 'apexcharts';
import reportApi from "~/Core/api/reportApi";
import { formatCurrency } from "../helpers/currencyHelper";

const saleCount = ref(0);
const revenueCount = ref(0);
const expenseCount = ref(0);
const incomeCount = ref(0);

const saleData = [];
const revenueData = [];
const expenseData = [];
const incomeData = [];

function chartArea(data, id, group, background){
  return {
    chart: { 
      id: id, 
      group: group, 
      height: 135, 
      width: "100%", 
      background: background, 
      type: "area", 
      sparkline: { 
        enabled: true 
      } 
    },
    yaxis: { 
      labels: { 
        minWidth: 40 
      } 
    },
    stroke: { 
      width: 2
    },
    colors: ["rgba(255, 255, 255, .6)"],
    fill: { 
      type: "gradient", 
      gradient: { 
        shade: "light", 
        shadeIntensity: 1, 
        opacityFrom: 0.3, 
        opacityTo: 0.3, 
        stops: [0, 50, 100] 
      } 
    },
    tooltip: { 
      theme: "dark",  
      marker: { 
        show: false 
      }, 
      x: { 
        show: false 
      }, 
      y: { 
        title: {
          formatter: () => "",
        },
      },
    },
    series: [
      {
        data: data,
      },
    ],
  }
}

const series = [
  {
    name: "Thu nhập",
    type: "column",
    data: revenueData,
  },
  {
    name: "Chi phí",
    type: "column",
    data: expenseData,
  },
  {
    name: "Lời nhuận",
    type: "line",
    data: incomeData,
  },
]

const categories = [
  "Một",
  "Hai",
  "Ba",
  "Bốn",
  "Năm",
  "Sáu",
  "Bảy",
  "Tám",
  "Chín",
  "Mười",
  "Mười một",
  "Mười hai",
]

const colors = ["#9e6de0", "#faafca", "#f2e052"];

function chartBar(series, id, categories, colors){
 return {
    chart: {
      id: id,
      height: 370,
      type: "bar",
      toolbar: {
        show: false,
      },
    },
    colors: colors,
    legend: {
      show: true,
      position: "top",
      horizontalAlign: "right",
      markers: {
        width: 20,
        height: 5,
        radius: 0,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "50%",
        barHeight: "10%",
        distributed: false,
      },
    },
    dataLabels: {
      enabled: false,
    },

    stroke: {
      show: true,
      width: 2,
      curve: "smooth",
    },

    series: series,
    xaxis: {
      categories: categories,

      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      crosshairs: {
        width: 40,
      },
    },

    fill: {
      opacity: 1,
    },

    tooltip: {
      shared: true,
      intersect: false,
      followCursor: true,
      fixed: {
        enabled: false,
      },
      x: {
        show: false,
      },
      y: {
        title: {
          formatter: function (seriesName) {
            return seriesName;
          },
        },
      },
    },
  };
}

async function getReportByYear(){
  try {
    const response = await reportApi.getReportByYear();
    const data = response.data;
    data.forEach(month => {
      const sale = month ? Number(month.total_sale) : 0;
      saleCount.value += sale;
      saleData.push(sale);

      const revenue = month ? Number(month.total_revenue) : 0;
      revenueCount.value += revenue;
      revenueData.push(revenue);

      const expense = month ? Number(month.total_expense) + Number(month.total_fee) + Number(month.total_coupon) : 0;
      expenseCount.value += expense;
      expenseData.push(expense);

      const income = month ? Number(month.total_revenue) - expense : 0;
      incomeCount.value += income;
      incomeData.push(income);
    });
  } catch (error) {
    console.log(error);
  }
}

onMounted(async () => {
    await getReportByYear();

    const salesChart = chartArea(saleData, "#sales-chart", "reports", "#fd5190");
    new ApexCharts(document.querySelector('#sales-chart'), salesChart).render();

    const revenueChart = chartArea(revenueData, "#revenue-chart", "reports", "#46c79e");
    new ApexCharts(document.querySelector('#revenue-chart'), revenueChart).render();

    const expenseChart = chartArea(expenseData, "#expense-chart", "reports", "#9e6de0");
    new ApexCharts(document.querySelector('#expense-chart'), expenseChart).render();

    const incomeChart = chartArea(incomeData, "#income-chart", "reports", "#6696fe");
    new ApexCharts(document.querySelector('#income-chart'), incomeChart).render();
    
    document.querySelector('#income-and-expenses').innerHTML = "";
    const incomeAndExpensesChart = chartBar(series, '#income-and-expenses', categories, colors);
    new ApexCharts(document.querySelector('#income-and-expenses'), incomeAndExpensesChart).render();
});
</script>