<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการเพาะเห็ด</title>

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
                        <h3>ข้อมูลการเพาะเห็ด</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ข้อมูลการเพาะเห็ด</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <section class="row">
                <div class="row">

                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">อุณหภูมิ</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <img src="./img/information/temp.png" style="width: 40%;">
                                        <p class="mt-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อุณหภูมิเป็นปัจจัยสำคัญในการเพาะเห็ด โดยมีผลต่อการเจริญเติบโต การออกดอก และคุณภาพของผลผลิต เห็ดแต่ละชนิดต้องการอุณหภูมิที่เหมาะสมเฉพาะตัว การควบคุมอุณหภูมิที่ถูกต้องจะช่วยกระตุ้นการออกดอก ป้องกันโรคและศัตรูพืช รวมถึงส่งเสริมให้ได้ผลผลิตเห็ดที่มีคุณภาพดี</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">ความชื้น</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <img src="./img/information/humi.png" style="width: 40%;">
                                        <p class="mt-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ความชื้นมีบทบาทสำคัญในการเป็นตัวกำหนดสภาพแวดล้อมที่เหมาะสมสำหรับการเจริญเติบโตของเส้นใยและการพัฒนาของดอกเห็ด ระดับความชื้นที่เหมาะสมช่วยในการดูดซึมอาหารและการสร้างดอกเห็ด แต่ต้องระวังไม่ให้ชื้นเกินไปเพราะอาจทำให้เกิดเชื้อราหรือโรคได้</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">คาร์บอนไดซ์ออกไซด์</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <img src="./img/information/co2.png" style="width: 40%;">
                                        <p class="mt-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คาร์บอนไดออกไซด์มีผลต่อการเจริญเติบโตของเส้นใยและการพัฒนาของดอกเห็ด ระดับที่เหมาะสมช่วยกระตุ้นการเติบโตของเส้นใย แต่ในระยะออกดอก ต้องลดระดับลงเพื่อให้ดอกเห็ดพัฒนาได้ดี การควบคุมปริมาณคาร์บอนไดออกไซด์ที่เหมาะสมจึงเป็นสิ่งสำคัญ เพื่อให้ได้ผลผลิตเห็ดที่มีคุณภาพและปริมาณตามต้องการ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">สภาพแวดล้อมที่เหมาะต่อการเพาะเห็ด</h5>
                                    <h6 style="display: inline; color: black;">เลือกชนิดเห็ด</h6>
                                    <fieldset class="form-group" style="width: 10rem; display: inline;">
                                        <select class="form-select" id="mushroomSelect">
                                            <option value="0">เห็ดนางฟ้า</option>
                                            <option value="1">เห็ดเป๋าฮื้อ</option>
                                            <option value="2">เห็ดภูฐาน</option>
                                            <option value="3">เห็ดนางรม</option>
                                            <option value="4">เห็ดหูหนู</option>
                                            <option value="5">เห็ดฟาง</option>
                                            <option value="6">เห็ดขอน</option>
                                            <option value="7">เห็ดลม</option>
                                            <option value="8">เห็ดตีนแรด</option>
                                            <option value="9">เห็ดนางนวล</option>
                                            <option value="10">เห็ดหอม</option>
                                            <option value="11">เห็ดยานางิ</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6 col-12 mt-5">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card mb-3" style="max-width: 100%;">
                                                            <div class="row g-0 d-flex justify-content-center">
                                                                <div class="col-md-4 rounded-circle border border-primary border-5" style="width: 6rem; height: 6rem;">
                                                                    <div class="row d-flex justify-content-center">
                                                                        <img src="./img/information/temp.png" class="mt-1" style="width: 96%;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 mt-lg-0 mt-2">
                                                                    <div class="card-body rounded-pill border border-success border-5 ms-2 me-2" style="height: 6rem;">
                                                                        <h1 class="card-title text-center text-success mush0">33 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush1" hidden>33 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush2" hidden>33 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush3" hidden>33 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush4" hidden>33 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush5" hidden>34 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush6" hidden>33 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush7" hidden>33 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush8" hidden>33 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush9" hidden>33 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush10" hidden>27 °C</h1>
                                                                        <h1 class="card-title text-center text-success mush11" hidden>28 °C</h1>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="card mb-3" style="max-width: 100%;">
                                                            <div class="row g-0 d-flex justify-content-center">
                                                                <div class="col-md-4 rounded-circle border border-primary border-5" style="width: 6rem; height: 6rem;">
                                                                    <div class="row d-flex justify-content-center">
                                                                        <img src="./img/information/humi.png" class="mt-2 ms-1" style="width: 85%;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 mt-lg-0 mt-2">
                                                                    <div class="card-body rounded-pill border border-success border-5 ms-2 me-2" style="height: 6rem;">
                                                                        <h1 class="card-title text-center text-success mush0">75 %</h1>
                                                                        <h1 class="card-title text-center text-success mush1" hidden>75 %</h1>
                                                                        <h1 class="card-title text-center text-success mush2" hidden>75 %</h1>
                                                                        <h1 class="card-title text-center text-success mush3" hidden>75 %</h1>
                                                                        <h1 class="card-title text-center text-success mush4" hidden>75 %</h1>
                                                                        <h1 class="card-title text-center text-success mush5" hidden>75 %</h1>
                                                                        <h1 class="card-title text-center text-success mush6" hidden>75 %</h1>
                                                                        <h1 class="card-title text-center text-success mush7" hidden>75 %</h1>
                                                                        <h1 class="card-title text-center text-success mush8" hidden>75 %</h1>
                                                                        <h1 class="card-title text-center text-success mush9" hidden>75 %</h1>
                                                                        <h1 class="card-title text-center text-success mush10" hidden>85 %</h1>
                                                                        <h1 class="card-title text-center text-success mush11" hidden>79 %</h1>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="card mb-3" style="max-width: 100%;">
                                                            <div class="row g-0 d-flex justify-content-center">
                                                                <div class="col-md-4 rounded-circle border border-primary border-5" style="width: 6rem; height: 6rem;">
                                                                    <div class="row d-flex justify-content-center">
                                                                        <img src="./img/information/co2.png" class="mt-2" style="width: 88%;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 mt-lg-0 mt-2">
                                                                    <div class="card-body rounded-pill border border-success border-5 ms-2 me-2" style="height: 6rem;">
                                                                        <h1 class="card-title text-center text-success mush0" >1000 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush1" hidden>1250 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush2" hidden>800 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush3" hidden>800 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush4" hidden>2000 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush5" hidden>1250 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush6" hidden>1500 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush7" hidden>1000 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush8" hidden>2000 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush9" hidden>1000 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush10" hidden>1250 PPM</h1>
                                                                        <h1 class="card-title text-center text-success mush11" hidden>1250 PPM</h1>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="row d-flex justify-content-center">
                                                    <img src="./img/information/m1.png" style="width: 50%;" class="mush0">
                                                    <img src="./img/information/m2.png" style="width: 50%;" class="mush1" hidden>
                                                    <img src="./img/information/m3.png" style="width: 50%;" class="mush2" hidden>
                                                    <img src="./img/information/m4.png" style="width: 50%;" class="mush3" hidden>
                                                    <img src="./img/information/m5.png" style="width: 50%;" class="mush4" hidden>
                                                    <img src="./img/information/m6.png" style="width: 50%;" class="mush5" hidden>
                                                    <img src="./img/information/m7.png" style="width: 50%;" class="mush6" hidden>
                                                    <img src="./img/information/m8.png" style="width: 50%;" class="mush7" hidden>
                                                    <img src="./img/information/m9.png" style="width: 50%;" class="mush8" hidden>
                                                    <img src="./img/information/m10.png" style="width: 50%;" class="mush9" hidden>
                                                    <img src="./img/information/m11.png" style="width: 50%;" class="mush10" hidden>
                                                    <img src="./img/information/m12.png" style="width: 50%;" class="mush11" hidden>
                                                </div>
                                                <div class="row">
                                                    <h4 class="text-center mb-0" id="mush-name">เห็ดนางฟ้า</h4>
                                                    <p class="mush0">&nbsp&nbsp&nbsp&nbspเห็ดนางฟ้าเป็นเห็ดสีขาวถึงครีม มีหมวกเห็ดกว้าง ปลูกในถุงพลาสติกที่มีขี้เลื่อยหรือฟาง รสชาติอ่อนและเนื้อนุ่ม เหมาะกับสภาพอากาศชื้นและอบอุ่น นิยมใช้ในอาหารหลายชนิด</p>
                                                    <p class="mush1" hidden>&nbsp&nbsp&nbsp&nbspเห็ดเป๋าฮื้อ หรือ เห็ดหอยโข่งทะเล มีลักษณะดอกสีครีมถึงเทาเข้ม เนื้อหนากรอบ รสชาติคล้ายเนื้อไก่ นิยมนำมาปรุงอาหารจีน มีสรรพคุณช่วยกระตุ้นภูมิคุ้มกัน</p>
                                                    <p class="mush2" hidden>&nbsp&nbsp&nbsp&nbspเห็ดภูฐานเป็นเห็ดสมุนไพรจากเทือกเขาหิมาลัย เติบโตบนตัวหนอนผีเสื้อ มีสรรพคุณทางยาหลากหลาย เดิมหายากและราคาสูง ปัจจุบันเพาะเลี้ยงได้ ควรระวังในการบริโภคและปรึกษาแพทย์ก่อนใช้เป็นยา เนื่องจากอาจมีผลข้างเคียง</p>
                                                    <p class="mush3" hidden>&nbsp&nbsp&nbsp&nbspเห็ดนางรมเป็นเห็ดที่มีคุณค่าทางโภชนาการสูง โปรตีนสูง ไขมันดี กรดอะมิโน วิตามิน แร่ธาตุ ครบครัน  เพาะเลี้ยงง่าย เจริญเติบโตดีในเขตอบอุ่น นิยมนำมาปรุงอาหาร รสชาติดี เนื้อนุ่ม เหมาะกับคนทุกเพศทุกวัย  มีสรรพคุณทางยา ช่วยบำรุงร่างกาย ป้องกันโรค</p>
                                                    <p class="mush4" hidden>&nbsp&nbsp&nbsp&nbspเห็ดหูหนู เห็ดราที่มีประโยชน์ พบได้ทั่วไปตามต้นไม้ใหญ่ที่เน่าเปื่อย ลักษณะคล้ายใบหู มีทั้งสีขาว สีน้ำตาล และสีดำ อุดมไปด้วยใยอาหาร โปรตีน วิตามิน แร่ธาตุ ช่วยบำรุงร่างกาย ป้องกันโรค ต้านมะเร็ง นิยมนำมาปรุงอาหาร ต้ม ยำ แกง ตุ๋น หรือทานสด</p>
                                                    <p class="mush5" hidden>&nbsp&nbsp&nbsp&nbspเห็ดฟาง เห็ดยอดนิยม เพาะง่าย ทานอร่อย อุดมไปด้วยโปรตีน วิตามิน แร่ธาตุ ใยอาหาร  นิยมนำมาปรุงอาหารหลากหลายเมนู ต้ม ยำ แกง ผัด ทอด ตุ๋น หรือทานสด  มีสรรพคุณทางยา ช่วยบำรุงร่างกาย ป้องกันโรค  เพาะเลี้ยงได้ตลอดทั้งปี ผลผลิตดี ราคาไม่แพง</p>
                                                    <p class="mush6" hidden>&nbsp&nbsp&nbsp&nbspเห็ดขอนขาว เห็ดพื้นเมืองนิยมในภาคเหนือและอีสาน รสชาติดี คุณค่าทางโภชนาการสูง โปรตีนสูง ไขมันต่ำ อุดมไปด้วยแร่ธาตุ วิตามิน และสารต้านอนุมูลอิสระ เพาะเลี้ยงง่ายบนขอนไม้ ผลผลิตดี เก็บเกี่ยวได้หลายรุ่น</p>
                                                    <p class="mush7" hidden>&nbsp&nbsp&nbsp&nbspเห็ดลม เห็ดป่าที่มีคุณค่าทางโภชนาการสูง พบได้ตามขอนไม้ผุในภาคเหนือ ภาคตะวันออกเฉียงเหนือ และภาคกลาง นิยมนำมาปรุงอาหารหลากหลาย เช่น แกงแค แกงเห็ด ยำ หรือผัด เห็ดลมมีสรรพคุณบำรุงร่างกาย แก้ไข้ และกระตุ้นภูมิคุ้มกัน</p>
                                                    <p class="mush8" hidden>&nbsp&nbsp&nbsp&nbspเห็ดตีนแรด เป็นเห็ดที่พบได้ทั่วไปในประเทศไทย นิยมนำมารับประทาน มีทั้งสีขาวและสีขาวปนเทา ดอกเห็ดมีขนาดใหญ่ ก้านหนา เนื้อแน่น รสชาติดี มีคุณค่าทางโภชนาการสูง อุดมไปด้วยโปรตีน คาร์โบไฮเดรต ไขมัน และแร่ธาตุต่างๆ เช่น เหล็ก แคลเซียม ฟอสฟอรัส และวิตามินดี</p>
                                                    <p class="mush9" hidden>&nbsp&nbsp&nbsp&nbspเห็ดนางนวล เป็นเห็ดสีชมพู อีกสายพันธุ์หนึ่งของเห็ดนางฟ้า เพาะง่าย ให้ผลผลิตดี  มีคุณค่าทางโภชนาการสูง  นิยมนำมาปรุงอาหาร รสชาติอร่อย  และมีสรรพคุณช่วยลดน้ำตาลในเลือด ปรับความดันโลหิต  ลดอาการอักเสบ  บำรุงสายตา  และยับยั้งเซลล์มะเร็ง</p>
                                                    <p class="mush10" hidden>&nbsp&nbsp&nbsp&nbspเห็ดหอม ราชาแห่งเห็ด อุดมไปด้วยคุณค่าทางโภชนาการ  มีทั้งวิตามิน เกลือแร่ กรดอะมิโน และสารประกอบสำคัญต่างๆ ช่วยเสริมสร้างระบบภูมิคุ้มกัน ลดคอเลสเตอรอล บำรุงกระดูก ป้องกันมะเร็ง และดีต่อสุขภาพหัวใจ  อร่อย หอม หาซื้อง่าย นำมาประกอบอาหารได้หลากหลาย  ทั้งต้ม ตุ๋น ผัด ยำ หรือทานสด</p>
                                                    <p class="mush11" hidden>&nbsp&nbsp&nbsp&nbspเห็ดยานางิ หรือ เห็ดโคนญี่ปุ่น เป็นเห็ดที่มีราคาค่อนข้างสูง รสชาติอร่อย มีทั้งความเหนียวนุ่มที่หมวกและความกรอบที่ก้าน นิยมนำมาประกอบอาหารได้หลากหลาย  เห็ดยานางิมีคุณค่าทางโภชนาการสูง ช่วยต้านมะเร็ง ควบคุมระดับน้ำตาล ลดไขมัน ดีต่อตับและหัวใจ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </div>

    </section>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#mushroomSelect").on("change", function() {
                $("#mush-name").html($("#mushroomSelect option:selected").text());

                for (let i = 0; i <= 11; i++) {
                    $(".mush"+i).attr("hidden","");
                }

                switch ($("#mushroomSelect option:selected").val()) {
                    case "0":
                        $(".mush0").removeAttr("hidden");
                        break;
                    case "1":
                        $(".mush1").removeAttr("hidden");
                        break;
                    case "2":
                        $(".mush2").removeAttr("hidden");
                        break;
                    case "3":
                        $(".mush3").removeAttr("hidden");
                        break;
                    case "4":
                        $(".mush4").removeAttr("hidden");
                        break;
                    case "5":
                        $(".mush5").removeAttr("hidden");
                        break;
                    case "6":
                        $(".mush6").removeAttr("hidden");
                        break;
                    case "7":
                        $(".mush7").removeAttr("hidden");
                        break;
                    case "8":
                        $(".mush8").removeAttr("hidden");
                        break;
                    case "9":
                        $(".mush9").removeAttr("hidden");
                        break;
                    case "10":
                        $(".mush10").removeAttr("hidden");
                        break;
                    case "11":
                        $(".mush11").removeAttr("hidden");
                }
            });
        });
    </script>

    <!-- Import Script -->
    <script src="import/jquery-3.7.1.min.js"></script>
    <script src="import/app/dark.js"></script>
    <script src="import/app/perfect-scrollbar.min.js"></script>
    <script src="import/app/app.js"></script>

</body>

</html>