<?php
require_once __DIR__ . "/../database/connect_google.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body>

    <section class="vh-100 gradient-custom mh-75">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-4">Login Form</h3>
                            <form action="" method="post" id="login-form">
                                <div>
                                    <p class="mb-0 d-flex justify-content-center">Don't have an account? <a href='./register/FormSignUp.php' class="text-black-50 fw-bold">Sign Up</a></p>
                                </div>
                                <div class="d-flex justify-content-center text-center mt-2 pt-1">
                                    <a href='<?php
                                                echo $client->createAuthUrl(); ?>' class="text-black">
                                        <i class="fab fa-google fa-lg"></i>
                                    </a>
                                </div>

                                <div class="container overflow-hidden">
                                    <div class="row gy-3">
                                        <div class="col-md-6 mb-0 w-100">
                                            <div class="form-outline">
                                                <span id="check-email-exist"></span>
                                                <input type="text" id="email" class="form-control form-control-lg" name="email" onInput="checkEmailExist()" />
                                                <label class="form-label" for="email"><i class="bi bi-person-add"></i> Email</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-1 pb-2 w-100">

                                            <div class="form-outline">
                                                <input type="password" id="password" class="form-control form-control-lg" name="password" />
                                                <label class="form-label" for="password"><i class="bi bi-password-fill"><i class="bi bi-file-lock"></i> Password</i></label>
                                            </div>
                                            <p class="mb-3 pb-lg-2 d-flex flex-row-reverse bd-highlight"><a href='./reset_password/FormForget.php' class="text-black-50 fw-bold">Forgot password</a></p>
                                        </div>
                                    </div>
                                    <div class="">
                                        <input class="btn btn-primary btn-lg" type="submit" value="Login" id="btn-log" name="btn-log" />
                                    </div>
                                </div>
                            </form>
                            <div class="alert alert-danger d-none" role="alert">
                                Login failed. Please try again.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').submit(function(event) {
                event.preventDefault(); // prevent form from submitting normally

                var email = $('#email').val();
                var password = $('#password').val();

                if (email == "" || password == "") {
                    alert("Email and password cannot be empty, please enter correct email and password");
                    return false;
                }


                $.ajax({
                    url: '../database/login.php', // Specify the path to login.php file
                    type: 'post',
                    data: {
                        email: email,
                        password: password,
                        'btn-log': 1
                    },
                    success: function(response) {
                        if (response == 'Admin') {

                            alert("Login successful as Admin.");
                            window.location = '../Admin.php?chon=users';
                        } else if (response == 'NhanVien') {
                            alert("Login successful as NhanVien.");
                            window.location = '../Admin.php';
                        } else if (response == 'clients') {
                            alert("Login successful as Client.");
                            window.location = '../index.php';
                        } else {
                            alert(response);
                        }
                    }
                });
            });
        });


        function checkEmailExist() {
            jQuery.ajax({
                url: "../database/check_availability_login.php",
                data: 'email=' + $("#email").val(),

                type: "POST",
                success: function(data) {
                    $("#check-email-exist").html(data);
                },
                error: function() {}
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>