$(document).ready(function () {
  fetchDataProduct();
  setInterval(fetchDataProduct, 3000);
});
var year_selectID;

$('#yearSelect').on('change', function () {
  year_selectID = $(document).find("#yearSelect").val();
  fetchDataProduct();
});

function fetchDataProduct() {
  $.ajax({

    url: './db/fetchchart.php',
    type: 'GET',
    data: { func: 'fetch-dataProduct', year_id: year_selectID },
    dataType: 'json',
    success: function (data) {
      chartProduct.updateSeries([{
        data: data.map(item => item.sum_product)
      }])
    },
  });
}



var dataProduct = {
  series: [{
    name: 'ผลผลิต',
    data: [],
  },
  ],
  annotations: {
    position: "back",
  },
  dataLabels: {
    enabled: false,
  },
  chart: {
    type: "bar",
    height: 300,
  },
  fill: {
    opacity: 1,
  },
  plotOptions: {
    bar: {
      dataLabels: {
        position: 'top'
      }
    }
  },
  colors: "#435ebe",
  xaxis: {
    categories: [
      "มกราคม",
      "กุมภาพันธ์",
      "มีนาคม",
      "เมษายน",
      "พฤษภาคม",
      "มิถุนายน",
      "กรกฎาคม",
      "สิงหาคม",
      "กันยายน",
      "ตุลาคม",
      "พฤศจิกายน",
      "ธันวาคม",
    ],
  },
  yaxis: {
    min: 0,
    max: 1000,
    tickAmount: 10,
  },
  title: {
    text: "กิโลกรัม",
    style: {
      fontSize: '12px',
    },
  }
}

var chartProduct = new ApexCharts(
  document.querySelector("#chart-product"),
  dataProduct
)

chartProduct.render()