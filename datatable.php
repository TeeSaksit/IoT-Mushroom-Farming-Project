<?php
session_start();
if (!isset($_SESSION["adminID"])) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานผลผลิต</title>


    <link rel="shortcut icon" href="./img/png/mushroom.png" type="image/x-icon">
    <link rel="stylesheet" href="./import/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./import/datatable/datatables.min.css">
    <link rel="stylesheet" href="./import/app/app.css">
    <link rel="stylesheet" href="./import/app/app-dark.css">
    <link rel="stylesheet" href="./css/reportdata.css">
</head>

<body>

    <script src="import/app/initTheme.js"></script>

    <div id="app">
        <?php include 'sidebar.php'; ?>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>รายงานผลผลิต</h3>
                        <h6>ปีที่แสดงผล</h6>
                        <fieldset class="form-group select-row-data w-25">
                            <select class="form-select" id="yearSelect" onclick="fetchYear();">
                                <option value="0"></option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">รายงาน</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Minimal jQuery Datatable start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 id="graph-product">กราฟผลผลิต ปี <?php echo date("Y") + 543; ?></h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-product">

                        </div>
                    </div>
                </div>

            </section>
            <!-- Minimal jQuery Datatable end -->

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" id="report-product">
                            รายงานผลทั้งหมด ปี <?php echo date("Y") + 543; ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table2">
                                <thead>
                                    <tr>
                                        <th>วันที่เก็บเกี่ยว</th>
                                        <th>สายพันธุ์เห็ด</th>
                                        <th>ผลผลิต (กิโลกรัม)</th>
                                        <th>วันที่เพาะปลูก</th>
                                        <th>จำนวนก้อนเห็ด</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
            <!-- Minimal jQuery Datatable end -->

        </div>

    </div>
    </div>

    <!-- Import Script -->
    <script src="import/jquery-3.7.1.min.js"></script>
    <script src="import/app/dark.js"></script>
    <script src="import/app/perfect-scrollbar.min.js"></script>
    <script src="import/app/app.js"></script>
    <script src="import/datatable/datatables.min.js"></script>
    <script src="import/apexcharts.min.js"></script>
    <script src="import/sweetalert2@11.js"></script>
    <script src="js/datachart/reportchart.js"></script>

    <!-- Import Custom Script -->
    <script src="js/reportdata.js"></script>

</body>

</html>