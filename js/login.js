$(document).ready(function () {
    $(document).on("click", "#bt-login", function () {
        var username = $(document).find("#username").val();
        var password = $(document).find("#password").val();
    
        if (username.length != '' && password.length != '') {
            $.ajax({
                url: './db/check-login.php',
                type: 'GET',
                data: {
                    func: 'login',
                    username: username,
                    password: password
                },
                dataType: 'json',
                success: function (data) {
                    if (data == 0) {
                        Swal.fire({
                            icon: "success",
                            title: "เข้าสู่ระบบเสร็จสิ้น",
                            showConfirmButton: false,
                            timer: 1200
                        });
                        setTimeout(function () { window.location.href = "index.php"; }, 1200);
                    }else if (data == 1) {
                        Swal.fire({
                            icon: "error",
                            title: "รหัสผ่านไม่ถูกต้อง!!",
                            confirmButtonText: "ปิด"
                        });
                    }else if(data == 2){
                        Swal.fire({
                            icon: "error",
                            title: "ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง!!",
                            confirmButtonText: "ปิด"
                        });
                    }
                }
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "ข้อมูลไม่ครบถ้วน!!",
                text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                confirmButtonText: "ปิด"
            });
        }
    });
});
