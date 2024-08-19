<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>

    <link rel="shortcut icon" href="./img/png/mushroom.png" type="image/x-icon">
    <link rel="stylesheet" href="./import/app/app.css">
    <link rel="stylesheet" href="./import/app/app-dark.css">
    <link rel="stylesheet" href="./import/iconly/iconly.css">
    <link rel="stylesheet" href="./css/custom.css">

</head>

<body>
    <script src="import/app/initTheme.js"></script>
    <div id="app">
        <?php include 'sidebar.php'; ?>


        <div class="page-heading">
            <h3>สถานะระบบ &nbsp;
                <?php if (isset($_SESSION["adminID"])) { ?>
                    <p id="esp32-status" class="d-inline fs-6">⬤ Checking...</p>
                <?php }; ?>
                <span class="clock"></span>
                <img src="./img/index/png/wall-clock.png">
            </h3>
        </div>
        <div class="page-content">
            <section class="row">

                <!-- Status Sensor -->
                <div class="row">
                    <div class="col-lg-2 col-12 status-sensor">
                        <div class="row d-flex justify-content-center">
                            <div class="row card-sensor">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-start mx-auto">
                                                <div class="stats-icon green mb-2">
                                                    <i class="bi bi-thermometer-snow" style="margin: 0 5px 30px 0;"></i>
                                                </div>
                                            </div>
                                            <div class="col-auto mx-auto text-sensor">
                                                <h6 class="text-muted font-semibold text-center">อุณหภูมิ</h6>
                                                <h6 class="font-extrabold mb-0 text-center" id="temp"> </h6>
                                                <h6 class="text-muted mb-0 text-center" id="temp-outdoor">1 </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row card-sensor">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-start mx-auto">
                                                <div class="stats-icon orange mb-2">
                                                    <i class="bi bi-droplet-fill" style="margin: 0 10px 30px 0;"></i>
                                                </div>
                                            </div>
                                            <div class="col-auto mx-auto text-sensor">
                                                <h6 class="text-muted font-semibold text-center">ความชื้น</h6>
                                                <h6 class="font-extrabold mb-0 text-center" id="humi"> </h6>
                                                <h6 class="text-muted mb-0 text-center" id="humi-outdoor">2 </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row card-sensor">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-start mx-auto">
                                                <div class="stats-icon red mb-2">
                                                    <img src="./img/index/png/co2.png" class="w-75">
                                                </div>
                                            </div>
                                            <div class="col-auto mx-auto text-sensor">
                                                <h6 class="text-muted font-semibold text-center">CO₂</h6>
                                                <h6 class="font-extrabold mb-0 text-center" id="co2"> </h6>
                                                <h6 class="text-muted mb-0 text-center" id="co2-outdoor">3 </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Status Sensor -->

                    <!-- Status Graph -->
                    <div class="col-lg-10 col-12 status-graph">
                        <div class="row">
                            <div class="card" style="height: 459px;">
                                <div class="card-header">
                                    <h4>กราฟสภาพแวดล้อม วันนี้</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-success" width="32" height="32" fill="blue" style="width:10px">
                                                    <use xlink:href="./img/index/svg/bootstrap-icons.svg#circle-fill" />
                                                </svg>
                                                <h5 class="mb-0 ms-3 text-graph">อุณหภูมิ</h5>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <h5 class="mb-0 text-end temp-max"></h5>
                                        </div>
                                        <div class="col-12">
                                            <div id="chart-temp"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-success" width="32" height="32" fill="blue" style="width:10px">
                                                    <use xlink:href="./img/index/svg/bootstrap-icons.svg#circle-fill" />
                                                </svg>
                                                <h5 class="mb-0 ms-3 text-graph">ความชื้น</h5>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <h5 class="mb-0 text-end humi-max"></h5>
                                        </div>
                                        <div class="col-12">
                                            <div id="chart-humi"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-danger" width="32" height="32" fill="blue" style="width:10px">
                                                    <use xlink:href="./img/index/svg/bootstrap-icons.svg#circle-fill" />
                                                </svg>
                                                <h5 class="mb-0 ms-3 text-graph">คาร์บอนไดออกไซด์</h5>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <h5 class="mb-0 text-end co2-max"></h5>
                                        </div>
                                        <div class="col-12">
                                            <div id="chart-co2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Status Graph -->

                <!-- Controller -->
                <?php if (isset($_SESSION["adminID"])) { ?>
                    <div class="row">
                        <div class="col-12 col-lg-3 col-md-6 col-sm-6 card-controller">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row mt-1">
                                        <div class="col-auto d-flex justify-content-start icon-controller mx-auto">
                                            <div class="stats-icon purple mb-2">
                                                <img src="./img/index/png/Water-Pump.png" class="img-control">
                                            </div>
                                        </div>
                                        <div class="col-auto status-controller mx-auto">
                                            <h6 class="text-controller text-center">สถานะ: ปั้มน้ำ</h6>
                                            <h6 class="controller-status status-pump"></h6>
                                        </div>
                                        <div class="col-auto d-flex justify-content-center mx-auto sw-check">
                                            <label class="switch-pump">
                                                <input type="checkbox" class="ct-sw">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-3 col-md-6 col-sm-6 card-controller">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-auto d-flex justify-content-start icon-controller mx-auto">
                                            <div class="stats-icon red mb-2">
                                                <img src="./img/index/png/Fan.png" class="img-control">
                                            </div>
                                        </div>
                                        <div class="col-auto status-controller mx-auto">
                                            <h6 class="text-controller text-center">สถานะ: พัดลม</h6>
                                            <h6 class="controller-status status-fan"></h6>
                                        </div>
                                        <div class="col-auto d-flex justify-content-center mx-auto sw-check">
                                            <label class="switch-fan">
                                                <input type="checkbox" class="ct-sw">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-lg-3 col-md-6 col-sm-6 card-controller">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-auto d-flex justify-content-start icon-controller mx-auto">
                                            <div class="stats-icon green mb-2">
                                                <img src="./img/index/png/Valve.png" class="img-control">
                                            </div>
                                        </div>
                                        <div class="col-auto status-controller mx-auto">
                                            <h6 class="text-controller text-center">สถานะ: วาล์วน้ำ</h6>
                                            <h6 class="controller-status status-valve"></h6>
                                        </div>
                                        <div class="col-auto d-flex justify-content-center mx-auto sw-check">
                                            <label class="switch-valve">
                                                <input type="checkbox" class="ct-sw">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-3 col-md-6 col-sm-6 card-controller">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-auto d-flex justify-content-start icon-controller mx-auto">
                                            <div class="stats-icon blue mb-2">
                                                <img src="./img/index/png/LED.png" class="img-control">
                                            </div>
                                        </div>
                                        <div class="col-auto status-controller mx-auto">
                                            <h6 class="text-controller text-center">สถานะ: หลอดไฟ</h6>
                                            <h6 class="controller-status status-led"></h6>
                                        </div>
                                        <div class="col-auto d-flex justify-content-center mx-auto">
                                            <label class="switch-led">
                                                <input type="checkbox" class="ct-sw">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <input type="checkbox" id="auto-bt" onclick="return false;">
                    <label class="btn-lock" for="auto-bt">
                        <svg width="40" height="40" viewBox="0 0 36 40">
                            <path class="lockb" d="M 28.924 33.609 L 23.252 33.609 A 1.594 1.594 0 0 1 22.8 33.551 Q 22.297 33.402 22.156 32.875 A 1.704 1.704 0 0 1 22.103 32.508 A 28.422 28.422 0 0 0 21.941 30.381 Q 21.815 29.25 21.598 27.965 A 61.022 61.022 0 0 0 21.26 26.133 L 8.463 26.133 A 60.674 60.674 0 0 0 8.05 28.743 Q 7.771 30.809 7.713 32.508 A 1.531 1.531 0 0 1 7.63 32.964 Q 7.453 33.453 6.905 33.572 A 1.839 1.839 0 0 1 6.517 33.609 L 0.963 33.609 A 1.191 1.191 0 0 1 0.621 33.562 A 0.958 0.958 0 0 1 0.26 33.363 A 0.672 0.672 0 0 1 0.078 33.095 Q -0.012 32.863 0.002 32.508 Q 0.103 30.272 0.593 27.509 A 56.925 56.925 0 0 1 0.764 26.59 A 76.227 76.227 0 0 1 1.948 21.477 A 87.672 87.672 0 0 1 2.439 19.711 A 99.734 99.734 0 0 1 4.736 12.738 Q 6.002 9.328 7.361 6.492 A 43.354 43.354 0 0 1 8.371 4.51 Q 9.204 2.98 10.01 1.852 Q 10.573 1.055 11.192 0.613 A 3.393 3.393 0 0 1 11.451 0.445 A 3.11 3.11 0 0 1 12.363 0.098 Q 12.754 0.012 13.207 0.002 A 5.526 5.526 0 0 1 13.338 0 L 16.713 0 A 4.913 4.913 0 0 1 17.553 0.068 Q 18.03 0.151 18.422 0.335 A 2.853 2.853 0 0 1 18.635 0.445 Q 19.305 0.832 19.906 1.605 A 6.957 6.957 0 0 1 20.088 1.852 Q 21.072 3.229 22.089 5.214 A 45.178 45.178 0 0 1 22.724 6.504 A 73.272 73.272 0 0 1 24.357 10.229 A 90.41 90.41 0 0 1 25.338 12.75 Q 26.603 16.149 27.623 19.699 A 89.368 89.368 0 0 1 28.901 24.664 A 77.005 77.005 0 0 1 29.299 26.531 A 46.406 46.406 0 0 1 29.765 29.263 Q 29.938 30.514 30.011 31.634 A 25.951 25.951 0 0 1 30.049 32.367 A 2.607 2.607 0 0 1 30.049 32.416 Q 30.049 33.609 28.924 33.609 Z M 14.932 7.406 L 14.791 7.406 Q 13.342 9.711 12.12 12.859 A 45.145 45.145 0 0 0 11.955 13.289 A 69.472 69.472 0 0 0 9.728 20.32 L 19.9 20.32 A 78.591 78.591 0 0 0 17.627 13.289 A 50.953 50.953 0 0 0 16.476 10.479 Q 15.864 9.107 15.227 7.936 A 28.999 28.999 0 0 0 14.932 7.406 Z"></path>

                            <path class="bling" d="M29 20L31 22"></path>
                            <path class="bling" d="M31.5 15H34.5"></path>
                            <path class="bling" d="M29 10L31 8"></path>
                        </svg>
                    </label>

                    <div class="modal fade" id="configModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">กำหนดค่าการทำงาน (กำหนด 0 เมื่อไม่ต้องการควบคุม)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>อุณหภูมิ (℃)</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" id="config-temp" onKeyPress="if(this.value.length==2) return false;">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label>ความชื้น (%)</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" id="config-humi" onKeyPress="if(this.value.length==2) return false;">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label>คาร์บอนไดออกไซด์ (PPM)</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" id="config-co2" onKeyPress="if(this.value.length==5) return false;">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="at-off">ปิดการทำงาน</button>
                                    <button type="button" class="btn btn-primary" id="at-on">เปิดการทำงาน</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Controller -->


            </section>
        </div>
    </div>
    
    <!-- Import Script -->
    <script src="import/jquery-3.7.1.min.js"></script>
    <script src="import/app/dark.js"></script>
    <script src="import/app/perfect-scrollbar.min.js"></script>
    <script src="import/app/app.js"></script>
    <script src="import/apexcharts.min.js"></script>
    <script src="import/sweetalert2@11.js"></script>
    <script src="js/datachart/dashboard.js"></script>

    <!-- Import Custom Script -->
    <script src="js/index.js"></script>

</body>

</html>