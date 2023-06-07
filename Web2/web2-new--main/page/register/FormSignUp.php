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
</head>

<body>
    <section class="vh-100 gradient-custom mh-75">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form <i class="bi bi-person-circle"></i></h3>
                            <form action="database/register_clients_email.php" method="post" id="signup-form">
                                <div class="row">
                                    <div class="col-md-3 mb-1 pb-2 w-100">
                                        <div class="form-outline">
                                            <input type="text" id="username" class="form-control form-control-lg" name="username" />
                                            <label class="form-label" for="username"><i class="bi bi-person-add"></i> Username</label>
                                        </div>
                                        <div class="form-outline">
                                            <span id="check-email-unique"></span>
                                            <input type="email" id="email" class="form-control form-control-lg" name="email" onInput="checkEmailUnique()" />
                                            <label class="form-label" for="email"><i class="bi bi-envelope-at-fill"></i> Email</label>
                                        </div>
                                        <div class="form-outline">
                                            <span id="check-phone-unique"></span>
                                            <input type="tel" id="phone" class="form-control form-control-lg" name="phone" onInput="checkPhoneUnique()" />
                                            <label class="form-label" for="phoneNumber"><i class="bi bi-telephone-fill"> Phone Number</i></label>
                                            <div class="col-md-6 mb-4 pb-2 w-100">
                                                <div class="form-outline">
                                                    <input type="address" id="address" class="form-control form-control-lg" name="address" />
                                                    <label class="form-label" for="address"><i class="bi bi-house-add"> Address</i></label>
                                                </div>
                                                <div class="form-outline">
                                                    <input type="password" id="password" class="form-control form-control-lg" name="password" />
                                                    <label class="form-label" for="password"><i class="bi bi-file-lock"> Password</i></label>
                                                </div>
                                                <div class="form-outline">
                                                    <input type="password" id="repeat_password" class="form-control form-control-lg" name="repeat_password" />
                                                    <label class="form-label" for="repeat_password"><i class="bi bi-file-lock"> Repeat password</i></label>
                                                </div>
                                            </div>
                                            <div class="fst-italic">
                                                <div class="d-flex justify-content-start input-group mb-3">
                                                    <input class="btn btn-primary btn-lg" id="check-email" type="submit" value="Send OTP to your email" name="verify-email" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" d-flex justify-content-end">
                                    <div class="col-4">
                                        <p class="mb-0 d-flex justify-content-center "><a href='index.php?number=login' class="text-black-50 fw-bold text-decoration-none" onclick="goToLoginPage()"><i class="bi bi-arrow-90deg-left"></i> Back </a></p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function goToLoginPage() {
            window.location.href = "http://localhost:8012/web2-new--main/web2-new--main/index.php?number=login";
        }
        $(document).ready(function() {
            $('#signup-form').submit(function(event) {
                event.preventDefault(); // prevent form from submitting normally

                var username = $('#username').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var address = $('#address').val();
                var password = $('#password').val();
                var repeat_password = $('#repeat_password').val();

                // Check if any field is empty
                if (username == "" || email == "" || phone == "" || address == "" || password == "" || repeat_password == "") {
                    alert("Please fill out the information completely");
                    return false;
                }

                // Check if passwords match
                if (password != repeat_password) {
                    alert("Password does not match");
                    return false;
                }

                // Check if email already exists in database
                $.ajax({
                    type: "POST",
                    url: "../../database/check_email.php",
                    data: {
                        email: email
                    },
                    success: function(response) {
                        if (response == "exists") {
                            alert("Email already exists, please use another email.");
                        } else {
                            // Check if phone number already exists in database
                            $.ajax({
                                type: "POST",
                                url: "../../database/check_phone.php",
                                data: {
                                    phone: phone
                                },
                                success: function(response) {
                                    if (response == "exists") {
                                        alert("Phone number already exists, please use another phone number.");
                                    } else {
                                        // Submit the form if both email and phone number are unique
                                        $.ajax({
                                            type: "POST",
                                            url: "../../database/register_clients_email.php",
                                            data: {
                                                username: username,
                                                email: email,
                                                phone: phone,
                                                address: address,
                                                password: password,
                                                'verify-email': 1

                                            },
                                            success: function(response) {
                                                if (response == "verification_code") {
                                                    alert("Please check your email for verification code.");
                                                    window.location.href = "../../page/register/OTP_email_register.php";
                                                } else {
                                                    alert("Please check your email for verification code.");
                                                    window.location.href = "../../page/register/OTP_email_register.php";
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    }
                });
            });
        });


        function checkEmailUnique() {
            // Get the email value from the input field
            let email = $("#email").val();

            // Check if email has the correct format
            if (!/^([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9_\-.]+)\.([a-zA-Z]{2,5})$/.test(email)) {
                $("#check-email-unique").html("Email address must be in a valid format.");
                return false;
            }

            // If email has the correct format, check if it exists in the database
            jQuery.ajax({
                url: "../../database/check_availability.php",
                data: 'email=' + email,
                type: "POST",
                success: function(data) {
                    $("#check-email-unique").html(data);
                },
                error: function() {}
            });
        }


        function checkPhoneUnique() {
            // ensure the phone number starts with '+84'
            let phone = $("#phone").val();
            if (!phone.startsWith("+84")) {
                phone = "+84" + phone;
            }
            jQuery.ajax({
                url: "../../database/check_availability.php",
                data: {
                    phone: phone
                },
                type: "POST",
                success: function(data) {
                    $("#check-phone-unique").html(data);
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