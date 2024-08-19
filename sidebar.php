<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="index.php"><img src="./img/png/logo-mushroom.png" alt="Logo" srcset=""></a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li id="side1" class="sidebar-item ">
                    <a href="index.php" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>หน้าแรก</span>
                    </a>
                </li>

                <li id="side2" class="sidebar-item ">
                    <a href="farm.php" class='sidebar-link'>
                        <i class="bi bi-house-fill"></i>
                        <span><?php echo (isset($_SESSION["adminID"])) ? 'จัดการโรงเพาะเห็ด' : 'ข้อมูลโรงเพาะเห็ด'; ?></span>
                    </a>
                </li>

                <li id="side8" class="sidebar-item ">
                    <a href="information.php" class='sidebar-link'>
                        <i class="bi bi-tree-fill"></i>
                        <span>ข้อมูลการเพาะเห็ด</span>
                    </a>
                </li>

                <li id="side3" class="sidebar-item ">
                    <a href="view-farm.php" class='sidebar-link'>
                        <i class="bi bi-image"></i>
                        <span>ฟาร์มเกษตร มรภ.อยุธยา</span>
                    </a>
                </li>

                <?php if (!isset($_SESSION["adminID"])) { ?>

                    <li id="side4" class="sidebar-item position-absolute bottom-0" style="width: 236px; margin-bottom: 3px;">
                        <a href="login.php" class='sidebar-link'>
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>เข้าสู่ระบบ</span>
                        </a>
                    </li>

                <?php } elseif (isset($_SESSION["adminID"])) { ?>

                    <li id="side4" class="sidebar-item ">
                        <a href="datatable.php" class='sidebar-link'>
                            <i class="bi bi-table"></i>
                            <span>รายงานผลผลิต</span>
                        </a>
                    </li>

                    <li id="side5" class="sidebar-item ">
                        <a type="button" class='sidebar-link' id="tableAdmin">
                            <i class="bi bi-people-fill"></i>
                            <span>ตารางผู้ดูแลระบบ</span>
                        </a>
                    </li>

                    <li id="side6" class="sidebar-item" style="width: 236px;">
                        <a type="button" class='sidebar-link' id="bt-userinfo">
                            <i class="bi bi-person-circle"></i>
                            <span>ข้อมูลส่วนตัว</span>
                        </a>
                    </li>

                    <li id="side7" class="sidebar-item position-absolute bottom-0" style="width: 236px; margin-bottom: 3px;">
                        <a href="./db/check-login.php?func=logout" class='sidebar-link' id="bt-logout">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>ออกจากระบบ</span>
                        </a>
                    </li>

                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<!-- Modal admin start -->
<?php
if (isset($_SESSION["adminID"])) {

    include './db/connectDB.php';
    $admin_id = $_SESSION["adminID"];
    $sql_checkLevel = "SELECT * FROM admin WHERE adminID='$admin_id' AND admin_level = 1";
    $result_checkLevel = $conn->query($sql_checkLevel);

    $sql_getinfoAdmin = "SELECT * FROM admin WHERE adminID='$admin_id'";
    $result_getinfoAdmin = $conn->query($sql_getinfoAdmin);
    $row_getinfoAdmin = $result_getinfoAdmin->fetch_assoc()
?>
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog <?php echo ($result_checkLevel->num_rows > 0) ? 'modal-lg' : ''; ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ผู้ดูแลระบบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="table-row">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>เบอร์โทร</th>
                                <th>ชื่อผู้ใช้งาน</th>

                                <?php
                                if ($result_checkLevel->num_rows > 0) {
                                ?>
                                    <th class="text-center">แก้ไข</th>
                                    <th class="text-center">ลบ</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <?php if ($result_checkLevel->num_rows > 0) { ?>
                        <button type="button" class="btn btn-primary" id="modalinsertAdmin">เพิ่ม</button>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Modal admin end -->

<!-- Modal info start -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลส่วนตัว</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label>ชื่อ</label>
                        <input type="text" class="form-control" id="info-name">
                    </div>
                    <div class="col-6">
                        <label>เบอร์โทร</label>
                        <input type="tel" class="form-control" id="info-tel">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label>ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" id="info-username">
                    </div>
                    <div class="col-6 pt-4">
                        <button type="button" class="btn btn-info" id="info-passwordChange">เปลี่ยนรหัสผ่าน</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-warning" id="info-edit" data-id="<?php echo $row_getinfoAdmin['adminID']; ?>">แก้ไข</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal info end -->

<!-- Modal change password start -->
<div class="modal fade" id="changepassAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เปลี่ยนรหัสผ่าน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modaladdAdmin">
                <div class="row">
                    <div class="col-12">
                        <label>รหัสผ่านปัจจุบัน</label>
                        <input type="password" class="form-control" id="achange-password-old">
                    </div>
                    <div class="col-12 mt-3">
                        <label>รหัสผ่านใหม่</label>
                        <input type="password" class="form-control" id="achange-password">
                    </div>
                    <div class="col-12 mt-3">
                        <label>ยืนยันรหัสผ่านใหม่</label>
                        <input type="password" class="form-control" id="achange-password-check">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="bt-changePassword" data-id="<?php echo $row_getinfoAdmin['adminID']; ?>" value="<?php echo $row_getinfoAdmin['admin_password']; ?>">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal change password end -->

<!-- Modal addAdmin start -->
<div class="modal fade" id="insertAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleAdminModal">เพิ่มข้อมูลผู้ดูแลระบบ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modaladdAdmin">
                <div class="row">
                    <div class="col-6">
                        <label>ชื่อ</label>
                        <input type="text" class="form-control" id="ainsert-name">
                    </div>
                    <div class="col-6">
                        <label>เบอร์โทร</label>
                        <input type="tel" class="form-control" id="ainsert-tel">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label>ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" id="ainsert-username">
                    </div>
                    <div class="col-6">
                        <label>ระดับผู้ดูแลระบบ</label>
                        <select id="ainsert-level" class="form-select">
                            <option value="0">ระดับทั่วไป</option>
                            <option value="1">ระดับสูง (แก้ไขรายชื่อผู้ดูแลได้)</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3 pass-admin">
                    <div class="col-6">
                        <label>รหัสผ่าน</label>
                        <input type="password" class="form-control" id="ainsert-password">
                    </div>
                    <div class="col-6">
                        <label>ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" id="ainsert-password-check">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-success" id="bt-insertAdmin">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal addAdmin end -->

<div id="main" class="layout-navbar navbar-fixed" style="padding: 32px;">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block" style="width: fit-content;">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <script src="import/jquery-3.7.1.min.js"></script>
    <script src="import/md5.min.js"></script>
    <script>
        $(document).ready(function() {
            var href = document.location.href;
            var page = href.substr(href.lastIndexOf('/') + 1);
            var lastPathSegment = page.substring(0, page.lastIndexOf('.php') + 4);

            if (lastPathSegment == "index.php") {
                $('#side1').addClass('active');
            } else if (lastPathSegment == "farm.php") {
                $('#side2').addClass('active');
            } else if (lastPathSegment == "view-farm.php") {
                $('#side3').addClass('active');
            } else if (lastPathSegment == "datatable.php") {
                $('#side4').addClass('active');
            }else if (lastPathSegment == "information.php") {
                $('#side8').addClass('active');
            } else {
                $('#side1').addClass('active');
            }

            $("#bt-userinfo").on("click", function() {
                $('#infoModal').modal('show');
                fetchinfoUser();
            });

            $("#info-edit").on("click", function() {
                var adminID = $(this).attr('data-id');
                var name = $(document).find("#info-name").val();
                var tel = $(document).find("#info-tel").val();
                var username = $(document).find("#info-username").val();

                $.ajax({
                    url: './db/check-login.php',
                    type: 'GET',
                    data: {
                        func: 'update_admin',
                        adminID: adminID,
                        name: name,
                        tel: tel,
                        username: username
                    },
                    dataType: 'json',
                    success: function(data) {
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
                            title: "แก้ไขข้อมูลเสร็จสิ้น"
                        });
                        fetchinfoUser();
                        $('#infoModal').modal('hide');
                    }
                });


            });

            $("#bt-changePassword").on("click", function() {
                if (MD5.generate($(document).find("#achange-password-old").val()) == $(this).attr('value')) {
                    if ($(document).find("#achange-password").val() == $(document).find("#achange-password-check").val() && $(document).find("#achange-password").val() != '') {
                        $.ajax({
                            url: './db/check-login.php',
                            type: 'GET',
                            data: {
                                func: 'update_password',
                                adminID: $(this).attr('data-id'),
                                password: $(document).find("#achange-password").val()
                            },
                            dataType: 'json',
                            success: function(data) {
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
                                    title: "เปลี่ยนรหัสผ่านเสร็จสิ้น"
                                });
                                $("#bt-changePassword").attr("value", MD5.generate($(document).find("#achange-password").val()));
                                $(document).find("#achange-password-old").val('');
                                $(document).find("#achange-password-check").val('');
                                $(document).find("#achange-password").val('');
                                $('#changepassAdminModal').modal('hide');
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "รหัสผ่านไม่ตรงกัน!!",
                            text: "กรุณากรอกรหัสผ่านให้ตรงกัน",
                            confirmButtonText: "ปิด"
                        });
                        $(document).find("#achange-password-old").val('');
                        $(document).find("#achange-password-check").val('');
                        $(document).find("#achange-password").val('');
                    }
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "รหัสผ่านไม่ถูกต้อง!!",
                        text: "กรุณากรอกรหัสผ่านเดิมให้ถูกต้อง",
                        confirmButtonText: "ปิด"
                    });
                    $(document).find("#achange-password-old").val('');
                    $(document).find("#achange-password-check").val('');
                    $(document).find("#achange-password").val('');
                }
            });

            $(document).on("click", "#bt-insertAdmin", function() {
                var name = $(document).find("#ainsert-name").val();
                var tel = $(document).find("#ainsert-tel").val();
                var level = $(document).find("#ainsert-level").val();
                var username = $(document).find("#ainsert-username").val();
                var password = $(document).find("#ainsert-password").val();
                var password_check = $(document).find("#ainsert-password-check").val();

                if (name.length != '' && tel.length == '12' && level.length != '' && username.length != '' && password.length != '' && password_check.length != '') {
                    if (password == password_check) {
                        $.ajax({
                            url: './db/check-login.php',
                            type: 'GET',
                            data: {
                                func: 'check_username',
                                username: username
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data == 0) {
                                    Swal.fire({
                                        icon: "error",
                                        title: "ชื่อผู้ใช้นี้ถูกใช้แล้ว!!",
                                        text: "กรุณาเปลี่ยนชื่อผู้ใช้",
                                        confirmButtonText: "ปิด"
                                    });
                                } else {
                                    $.ajax({
                                        url: './db/check-login.php',
                                        type: 'GET',
                                        data: {
                                            func: 'insert_admin',
                                            name: name,
                                            tel: tel,
                                            level: level,
                                            username: username,
                                            password: password
                                        },
                                        dataType: 'json',
                                        success: function(data) {
                                            Swal.fire({
                                                icon: "success",
                                                title: "เพิ่มข้อมูลเสร็จสิ้น",
                                                showConfirmButton: false,
                                                timer: 1200
                                            });
                                            $('#insertAdminModal').modal('hide');
                                            fetchtableAdmin();
                                        }
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "รหัสผ่านไม่ตรงกัน!!",
                            text: "กรุณากรอกรหัสผ่านให้ตรงกัน",
                            confirmButtonText: "ปิด"
                        });
                    }

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "ข้อมูลไม่ครบถ้วน!!",
                        text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                        confirmButtonText: "ปิด"
                    });
                }
            });

            $(document).on("click", ".delete-admin", function() {
                var adminID = $(this).attr('id');

                Swal.fire({
                    title: "คุณแน่ใจที่จะลบข้อมูล หรือไม่ ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f34235",
                    confirmButtonText: "ลบข้อมูล",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: './db/check-login.php',
                            type: 'GET',
                            data: {
                                func: 'delete_admin',
                                adminID: adminID
                            },
                            dataType: 'json',
                            success: function(data) {
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
                                    icon: "warning",
                                    title: "ลบข้อมูลเสร็จสิ้น"
                                });
                                fetchtableAdmin();
                            }
                        });
                    }
                });
            });

        });


        $("#tableAdmin").on("click", function() {
            $('#adminModal').modal('show');
            fetchtableAdmin();
        });

        $("#info-passwordChange").on("click", function() {
            $('#changepassAdminModal').modal('show');
        });

        $(document).on("click", ".edit-admin", function() {
            $('#insertAdminModal').modal('show');
            $('#titleAdminModal').html("แก้ไขข้อมูลผู้ดูแลระบบ");
            $('#bt-insertAdmin').html("แก้ไข");
            $('#bt-insertAdmin').addClass("bt-updateAdmin")
            $('.bt-updateAdmin').attr("id", $(this).attr('id'));
            $('.pass-admin').hide();
            var adminID = $(this).attr('id');
            $.ajax({
                url: './db/check-login.php',
                type: 'GET',
                data: {
                    func: 'get_adminID',
                    adminID: adminID
                },
                dataType: 'json',
                success: function(data) {
                    var name = $(document).find("#ainsert-name").val(data.admin_name);
                    var tel = $(document).find("#ainsert-tel").val(data.admin_tel);
                    var level = $(document).find("#ainsert-level").val(data.admin_level);
                    var username = $(document).find("#ainsert-username").val(data.admin_username);
                }
            });
        });

        $(document).on("click", ".bt-updateAdmin", function() {
            var adminID = $(this).attr('id');
            var name = $(document).find("#ainsert-name").val();
            var tel = $(document).find("#ainsert-tel").val();
            var level = $(document).find("#ainsert-level").val();
            var username = $(document).find("#ainsert-username").val();
            $.ajax({
                url: './db/check-login.php',
                type: 'GET',
                data: {
                    func: 'update_admin',
                    adminID: adminID,
                    name: name,
                    tel: tel,
                    level: level,
                    username: username,
                },
                dataType: 'json',
                success: function(data) {
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
                        title: "แก้ไขข้อมูลเสร็จสิ้น"
                    });
                    fetchtableAdmin();
                    $('#insertAdminModal').modal('hide');
                }
            });
        });

        $(document).on("click", "#modalinsertAdmin", function() {
            var name = $(document).find("#ainsert-name").val('');
            var tel = $(document).find("#ainsert-tel").val('');
            var level = $(document).find("#ainsert-level").val('0');
            var username = $(document).find("#ainsert-username").val('');
            var password = $(document).find("#ainsert-password").val('');
            var password_check = $(document).find("#ainsert-password-check").val('');
            $('#titleAdminModal').html("เพิ่มข้อมูลผู้ดูแลระบบ");
            $('.bt-updateAdmin').attr("id", "bt-insertAdmin");
            $('#bt-insertAdmin').removeClass("bt-updateAdmin");
            $('#bt-insertAdmin').html("บันทึก");
            $('.pass-admin').show();
            $('#insertAdminModal').modal('show');
        });

        function fetchtableAdmin() {
            $.ajax({
                url: './db/check-login.php',
                type: 'GET',
                data: {
                    func: 'fetch-tableAdmin'
                },
                dataType: 'json',
                success: function(data) {
                    var trow = $('#table-row tbody');
                    trow.empty();

                    if (document.getElementById('modalinsertAdmin') != null) {
                        $.each(data, function(index, row) {
                            var row = '<tr>' +
                                '<td>' + row.admin_name + '</td>' +
                                '<td>' + row.admin_tel + '</td>' +
                                '<td>' + row.admin_username + '</td>' +
                                '<td class="text-center"><a type="button" id="' + row.adminID + '" class="edit-admin"><span class="badge"><img src="img/png/edit.png" style="width: 2rem;"></span></a></td>' +
                                '<td class="text-center"><a type="button" id="' + row.adminID + '" class="delete-admin"><span class="badge"><img src="img/png/delete.png" style="width: 2rem;"></span></a></td>' +
                                '</tr>';
                            trow.append(row);
                        });
                    } else {
                        $.each(data, function(index, row) {
                            var row = '<tr>' +
                                '<td>' + row.admin_name + '</td>' +
                                '<td>' + row.admin_tel + '</td>' +
                                '<td>' + row.admin_username + '</td>' +
                                '</tr>';
                            trow.append(row);
                        });
                    }


                }
            });
        }

        function fetchinfoUser() {
            var adminID = $('#info-edit').attr('data-id');
            $.ajax({
                url: './db/check-login.php',
                type: 'GET',
                data: {
                    func: 'get_adminID',
                    adminID: adminID
                },
                dataType: 'json',
                success: function(data) {
                    var name = $(document).find("#info-name").val(data.admin_name);
                    var tel = $(document).find("#info-tel").val(data.admin_tel);
                    var username = $(document).find("#info-username").val(data.admin_username);
                }
            });
        }

        function phoneMask() {
            var num = $(this).val().replace(/\D/g, '');
            $(this).val(num.substring(0, 3) + (num.length > 3 ? '-' : '') + num.substring(3, 6) + (num.length > 6 ? '-' : '') + num.substring(6, 10));
        }
        $('[type="tel"]').keyup(phoneMask);
    </script>