<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>

    <link rel="shortcut icon" href="./img/png/mushroom.png" type="image/x-icon">
    <link rel="stylesheet" href="./import/app/app.css">
    <link rel="stylesheet" href="./import/app/app-dark.css">
    <link rel="stylesheet" href="./css/auth.css">

    <style>
        .unselectable {
            -webkit-user-select: none;
            -webkit-touch-callout: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
</head>

<body>
    <script src="import/app/initTheme.js"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-xl-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.php"><img src="./img/png/logo-mushroom.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title unselectable">เข้าสู่ระบบ</h1>
                    <p class="auth-subtitle mb-5 unselectable">กรุณากรอกข้อมูลให้ถูกต้อง.</p>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" id="username" placeholder="ชื่อผู้ใช้">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" id="password" placeholder="รหัสผ่าน">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label text-gray-600 unselectable" for="flexCheckDefault">
                            จดจำการเข้าสู่ระบบ
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" id="bt-login">เข้าสู่ระบบ</button>
                </div>
            </div>
            <div class="col-xl-7 d-none d-xl-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>

    <!-- Import Script -->
    <script src="import/jquery-3.7.1.min.js"></script>
    <script src="import/sweetalert2@11.js"></script>

    <!-- Import Custom Script -->
    <script src="js/login.js"></script>

    <script>
        $("#password").keydown(function(event) {
            if (event.keyCode === 13) {
                $("#bt-login").click();
            }
        });
    </script>
</body>

</html>