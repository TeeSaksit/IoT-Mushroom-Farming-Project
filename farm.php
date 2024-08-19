<?php
session_start();
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลโรงเพาะเห็ด</title>

    <link rel="shortcut icon" href="./img/png/mushroom.png" type="image/x-icon">
    <link rel="stylesheet" href="./import/app/app.css">
    <link rel="stylesheet" href="./import/app/app-dark.css">
    <link rel="stylesheet" href="./css/farm.css">
    <link rel="stylesheet" href="./import/datatable/datatables.min.css">
</head>

<body>
    <script src="import/app/initTheme.js"></script>
    <div id="app">
        <?php include 'sidebar.php'; ?>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3><?php echo (isset($_SESSION["adminID"])) ? 'จัดการโรงเพาะเห็ด' : 'ข้อมูลโรงเพาะเห็ด'; ?></h3>
                        <div class="col-xxl-6 mb-4">
                            <h6>&emsp; &emsp;เลือกแถว</h6>

                            <?php echo (isset($_SESSION["adminID"])) ? '<a type="button" id="row-edit"><img src="./img/png/add.png" class="bt-add-row"></a>' : ''; ?>
                            <fieldset class="form-group select-row-data w-50">
                                <select class="form-select" id="rowSelect">
                                    <option value="0">ทั้งหมด</option>
                                </select>
                            </fieldset>
                            <?php echo (isset($_SESSION["adminID"])) ? '<button type="button" class="btn btn-primary me-1 mb-1" id="bt-add">เพิ่มข้อมูล</button>' : ''; ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-md-end float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">จัดการโรงเพาะเห็ด </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <!-- Minimal jQuery Datatable start -->
            <section class="section">
                <h5>&emsp;ข้อมูลเห็ด</h5>
                <div class="row" id="row-detail">

                </div>
            </section>
            <!-- Minimal jQuery Datatable end -->


            <!-- Basic Tables start -->
            <?php if (isset($_SESSION["adminID"])) { ?>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                รายงานข้อมูลโรงเพาะเห็ด
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="all">แถวที่</th>
                                            <th class="all">วันที่เพาะเห็ด</th>
                                            <th class="all">สายพันธุ์เห็ด</th>
                                            <th class="all">วันที่เก็บเกี่ยว</th>
                                            <th class="all">จำนวนก้อนเห็ด</th>
                                            <th class="all">ผลผลิต (กิโลกรัม)</th>
                                            <th class="text-center all">สถานะ</th>
                                            <th class="text-center all">แก้ไข</th>
                                            <th class="text-center all">ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <!-- Basic Tables end -->

            <!-- Modal start -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title title-edit" id="exampleModalLabel">เพิ่มข้อมูลเห็ด</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modal-add">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>สายพันธุ์เห็ด</label>
                                        <input type="text" id="m-name" class="form-control" placeholder="กรอกชื่อสายพันธุ์เห็ด" name="m-name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>แถว</label>
                                        <fieldset class="form-group">
                                            <select class="form-select" id="rowSelectadd" name="m-row">
                                                <option disabled selected value>--เลือกแถว--</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>วันที่เพาะเห็ด</label>
                                        <input type="date" class="form-control mb-3" id="m-date" name="m-date">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>จำนวนก้อนเห็ด</label>
                                        <input type="text" id="m-amount" class="form-control" placeholder="กรอกข้อมูลจำนวนเห็ด" name="m-amount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-primary" id="bt-insert">บันทึก</button>
                            <button type="button" class="btn btn-warning bt-updaterow" id="bt-insert" hidden>แก้ไข</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->

            <!-- Modal row start -->
            <div class="modal fade" id="rowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">จัดการแถว</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped" id="table-row">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>สายพันธุ์เห็ด</th>
                                        <th class="w-25 text-center">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-primary" id="row-add">เพิ่ม</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal row end -->

            <!-- Modal table start -->
            <div class="modal fade" id="tableModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title title-table" id="exampleModalLabel">เก็บเกี่ยว</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-harvest">
                            <div class="row">
                                <div class="col-md-6 col-12">

                                    <div class="form-group">
                                        <label>วันที่เก็บเกี่ยว</label>
                                        <input type="date" class="form-control mb-3" id="harvest-date" name="harvest-date">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>ผลผลิต (กิโลกรัม)</label>
                                        <input type="text" class="form-control" placeholder="กรอกข้อมูลผลผลิต" id="harvest-amount" name="harvest-amount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-primary bt-Addharvest">บันทึก</button>
                            <button type="button" class="btn btn-warning bt-Editharvest" hidden>แก้ไข</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal table end -->


        </div>
    </div>
    </div>
    
    <!-- Import Script -->
    <script src="import/jquery-3.7.1.min.js"></script>
    <script src="import/app/dark.js"></script>
    <script src="import/app/perfect-scrollbar.min.js"></script>
    <script src="import/app/app.js"></script>
    <script src="import/datatable/datatables.min.js"></script>
    <script src="import/sweetalert2@11.js"></script>

    <!-- Import Custom Script -->
    <script src="js/farm.js"></script>

</body>

</html>