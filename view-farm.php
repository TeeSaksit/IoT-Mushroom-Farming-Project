<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลฟาร์มเกษตร</title>

    <link rel="shortcut icon" href="./img/png/mushroom.png" type="image/x-icon">
    <link rel="stylesheet" href="./import/app/app.css">
    <link rel="stylesheet" href="./import/app/app-dark.css">
    <link rel="stylesheet" href="./import/iconly/iconly.css">

</head>

<body>
    <script src="import/app/initTheme.js"></script>
    <div id="app">
        <?php include 'sidebar.php'; ?>


        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>ข้อมูลฟาร์มเกษตร มหาวิทยาลัยราชภัฏพระนครศรีอยุธยา</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ข้อมูลฟาร์มเกษตร</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <section class="row">
                <div class="row">
                    <div id="demo" class="carousel slide mx-auto" data-bs-ride="carousel" style=" height: 400px;">

                        <!-- Indicators/dots -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                        </div>

                        <!-- The slideshow/carousel -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/view-farm/jpg/view1.jpg" style="height: 400px;" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="img/view-farm/jpg/view2.jpg" style="height: 400px;" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="img/view-farm/jpg/view3.jpg" style="height: 400px;" class="d-block w-100">
                            </div>
                        </div>

                        <!-- Left and right controls/icons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">ข้อมูลเพิ่มเติม</h5>
                                </div>
                                <div class="card-body">
                                    <div class="googlemaps">
                                        ...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">แผนที่</h5>
                                </div>
                                <div class="card-body">
                                    <div class="googlemaps">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15461.414214126928!2d100.5631918!3d14.3489395!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e27439d817f259%3A0x985c4ac5faa7935!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4Lij4Liy4LiK4Lig4Lix4LiP4Lie4Lij4Liw4LiZ4LiE4Lij4Lio4Lij4Li14Lit4Lii4Li44LiY4Lii4Liy!5e0!3m2!1sth!2sth!4v1709850467344!5m2!1sth!2sth" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Import Script -->
    <script src="import/jquery-3.7.1.min.js"></script>
    <script src="import/app/dark.js"></script>
    <script src="import/app/perfect-scrollbar.min.js"></script>
    <script src="import/app/app.js"></script>

</body>

</html>