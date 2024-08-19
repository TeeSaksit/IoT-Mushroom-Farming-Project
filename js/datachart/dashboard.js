$(document).ready(function () {
  fetchDatachart();
  setInterval(fetchDatachart, 60000);
});

function fetchDatachart() {
  $.ajax({
    url: './db/fetchchart.php',
    type: 'GET',
    data: { func: 'fetch-datachart' },
    dataType: 'json',
    success: function (data) {

      chartTemp.updateOptions({
        xaxis: {
          categories: data.map(item => item.chartDatetime)
        }
      });

      chartTemp.updateSeries([{
        data: data.map(item => item.sensorTemp)
      }]);

      chartHumi.updateOptions({
        xaxis: {
          categories: data.map(item => item.chartDatetime)
        }
      });

      chartHumi.updateSeries([{
        data: data.map(item => item.sensorHumi)
      }]);

      chartCo2.updateOptions({
        xaxis: {
          categories: data.map(item => item.chartDatetime)
        }
      });

      chartCo2.updateSeries([{
        data: data.map(item => item.sensorCO2)
      }]);

      let tempArray = Object.values(data.map(item => item.sensorTemp));
      let maxtemp = Math.max.apply(null, tempArray);

      let humiArray = Object.values(data.map(item => item.sensorHumi));
      let maxhumi = Math.max.apply(null, humiArray);

      let co2Array = Object.values(data.map(item => item.sensorCO2));
      let maxco2 = Math.max.apply(null, co2Array);

      $('.temp-max').html("สูงสุด " + maxtemp + " °C");
      $('.humi-max').html("สูงสุด " + maxhumi + " %");
      $('.co2-max').html("สูงสุด " + maxco2 + " ppm");

    }
  });
}

// Change config:
    const chart_height = 80;


var dataTemp = {
  series: [
    {
      name: "อุณหภูมิ",
      data: [],
    },
  ],
  chart: {
    height: chart_height,
    type: "area",
    toolbar: {
      show: false,
    },
  },
  colors: ["#5350e9"],
  stroke: {
    width: 2,
  },
  grid: {
    show: false,
  },
  dataLabels: {
    enabled: false,
  },
  xaxis: {
    categories: null,
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
    labels: {
      show: false,
    },
  },
  show: false,
  yaxis: {
    labels: {
      show: false,
    },
  },
  tooltip: {
    x: {
      format: "dd/MM/yy HH:mm",
    },
  },
}

var dataHumi = {
  series: [
    {
      name: "ความชื้น",
      data: [],
    },
  ],
  chart: {
    height: chart_height,
    type: "area",
    toolbar: {
      show: false,
    },
  },
  colors: ["#5350e9"],
  stroke: {
    width: 2,
  },
  grid: {
    show: false,
  },
  dataLabels: {
    enabled: false,
  },
  xaxis: {
    categories: [],
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
    labels: {
      show: false,
    },
  },
  show: false,
  yaxis: {
    labels: {
      show: false,
    },
  },
  tooltip: {
    x: {
      format: "dd/MM/yy HH:mm",
    },
  },
}

var dataCo2 = {
  series: [
    {
      name: "Co2",
      data: [],
    },
  ],
  chart: {
    height: chart_height,
    type: "area",
    toolbar: {
      show: false,
    },
  },
  colors: ["#5350e9"],
  stroke: {
    width: 2,
  },
  grid: {
    show: false,
  },
  dataLabels: {
    enabled: false,
  },
  xaxis: {
    categories: [],
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
    labels: {
      show: false,
    },
  },
  show: false,
  yaxis: {
    labels: {
      show: false,
    },
  },
  tooltip: {
    x: {
      format: "dd/MM/yy HH:mm",
    },
  },
}

let optionsTemp = {
  ...dataTemp,
  colors: ["#008b75"],
}
let optionsHumi = {
  ...dataHumi,
  colors: ["#ffc434"],
}
let optionsCo2 = {
  ...dataCo2,
  colors: ["#dc3545"],
}

var chartTemp = new ApexCharts(
  document.querySelector("#chart-temp"),
  optionsTemp
)
var chartHumi = new ApexCharts(
  document.querySelector("#chart-humi"),
  optionsHumi
)
var chartCo2 = new ApexCharts(
  document.querySelector("#chart-co2"),
  optionsCo2
)

chartTemp.render()
chartHumi.render()
chartCo2.render()