$(document).ready(function () {
  clockUpdate();
  fetchData();
  fetchAUTO();
  setInterval(clockUpdate, 1000);
  setInterval(fetchData, 3000);
  setInterval(function () {
    if (!$("#configModal").hasClass("show")) {
      fetchAUTO();
    }
  }, 15000);

  setInterval(fetchStatus, 2000);

  $('.ct-sw').change(function () {
    changeSwitch();
  });


  $("#auto-bt").on("click", function () {
    $('#configModal').modal('show');
    fetchAUTO();
  });

})

$(document).on("click", "#at-off", function () {
  $.ajax({
    url: './db/fetch.php',
    type: 'GET',
    data: { func: 'autoOFF' },
    dataType: 'json',
    success: function (data) {
      $('#configModal').modal('hide');
      fetchAUTO();
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1200,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "error",
        title: "ปิดใช้งานการทำงานอัตโนมัติ"
      });
    }
  });
});


$(document).on("click", "#at-on", function () {
  var temp = $(document).find("#config-temp").val();
  var humi = $(document).find("#config-humi").val();
  var co2 = $(document).find("#config-co2").val();
  var status = (temp > 0 || humi > 0 || co2 > 0) ? 1 : 0;

  $.ajax({
    url: './db/fetch.php',
    type: 'GET',
    data: { func: 'autoON', status: status, co2: co2, temp: temp, humi: humi },
    dataType: 'json',
    success: function (data) {
      $('#configModal').modal('hide');
      fetchAUTO();
      if (status == 1) {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 1200,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          }
        });
        Toast.fire({
          icon: "success",
          title: "เปิดใช้งานการทำงานอัตโนมัติ"
        });
      }
    }
  });
});

function fetchAUTOCheck() {
  if ($('#auto-bt').is(':checked')) {
    $(".sw-check").attr("hidden", true);
  } else {
    $(".sw-check").removeAttr("hidden");
  }
}

function fetchAUTO() {
  $.ajax({
    url: './db/fetch.php',
    type: 'GET',
    data: { func: 'autoFetch' },
    dataType: 'json',
    success: function (data) {
      $('#config-temp').val(parseInt(data.config_temp));
      $('#config-humi').val(parseInt(data.config_humi));
      $('#config-co2').val(parseInt(data.config_co2));
      $('#auto-bt').prop('checked', data.config_status == 1 ? true : false);
      fetchAUTOCheck();
    }
  });
}

function clockUpdate() {
  var date = new Date();

  function addZero(x) {
    if (x < 10) {
      return x = '0' + x;
    } else {
      return x;
    }
  }

  var h = addZero(date.getHours());
  var m = addZero(date.getMinutes());
  var s = addZero(date.getSeconds());

  $('.clock').text(h + ':' + m + ':' + s);
}

function fetchData() {
  $.ajax({
    url: './db/fetch.php',
    type: 'GET',
    data: {
      func: 'fetchSensor',
    },
    dataType: 'json',
    success: function (data) {
      $('#temp').html(data.sensorTemp_1 + ' °C');
      $('#humi').html(data.sensorHumi_1 + ' %');
      $('#co2').html(Intl.NumberFormat().format(data.sensorCO2_1) + ' ppm');
      $('#temp-outdoor').html('('+data.sensorTemp_2 + ' °C)');
      $('#humi-outdoor').html('('+data.sensorHumi_2 + ' %)');
      $('#co2-outdoor').html('('+Intl.NumberFormat().format(data.sensorCO2_2) + ' ppm)');
    }
  });
}

function fetchStatus() {
  $.ajax({
    url: './db/fetch.php',
    type: 'GET',
    data: {
      func: 'fetchController'
    },
    dataType: 'json',
    success: function (data) {
      const statusElement = $('#esp32-status');
      let currentTime = new Date().getTime();
      let lastUpdate = new Date(data.last_time).getTime();
      let timeDifference = (currentTime - lastUpdate) / 1000;

      if (timeDifference > 5) {
        statusElement.text('⬤ Disconnected');
        statusElement.css('color', 'red');
      } else {
        statusElement.text('⬤ Connected'+'🔋'+data.voltage+'V');
        statusElement.css('color', 'green');
      }

      // Switch Status Start
      if (data.switch_pump == '1') {
        $('.switch-pump > input').prop('checked', true);
      } else {
        $('.switch-pump > input').prop('checked', false);
      }

      if (data.switch_fan == '1') {
        $('.switch-fan > input').prop('checked', true);
      } else {
        $('.switch-fan > input').prop('checked', false);
      }

      if (data.switch_valve == '1') {
        $('.switch-valve > input').prop('checked', true);
      } else {
        $('.switch-valve > input').prop('checked', false);
      }

      if (data.switch_led == '1') {
        $('.switch-led > input').prop('checked', true);
      } else {
        $('.switch-led > input').prop('checked', false);
      }
      // Switch Status End

      //Status Start
      if (data.status_pump == '1') {
        $('.status-pump').text('เปิด').css('color', 'green');
      } else {
        $('.status-pump').text('ปิด').css('color', 'red');
      }

      if (data.status_fan == '1') {
        $('.status-fan').text('เปิด').css('color', 'green');
      } else {
        $('.status-fan').text('ปิด').css('color', 'red');
      }

      if (data.status_valve == '1') {
        $('.status-valve').text('เปิด').css('color', 'green');
      } else {
        $('.status-valve').text('ปิด').css('color', 'red');
      }

      if (data.status_led == '1') {
        $('.status-led').text('เปิด').css('color', 'green');
      } else {
        $('.status-led').text('ปิด').css('color', 'red');
      }
      //Status End

    }
  });

}

function changeSwitch() {
  var sw_pump, sw_led, sw_valve, sw_fan;
  sw_pump = ($('.switch-pump > input').is(':checked') ? sw_pump = 1 : sw_pump = 0);
  sw_fan = ($('.switch-fan > input').is(':checked') ? sw_fan = 1 : sw_fan = 0);
  sw_valve = ($('.switch-valve > input').is(':checked') ? sw_valve = 1 : sw_valve = 0);
  sw_led = ($('.switch-led > input').is(':checked') ? sw_led = 1 : sw_led = 0);

  $.ajax({
    url: './db/fetch.php',
    type: 'GET',
    data: {
      func: 'changeSwitch',
      sw_pump: sw_pump,
      sw_fan: sw_fan,
      sw_valve: sw_valve,
      sw_led: sw_led
    },
    dataType: 'json',
    success: function (data) {
      fetchStatus();
    }
  });
}
