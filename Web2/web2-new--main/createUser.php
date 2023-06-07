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



    <section class="">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                    <form action="database/register_users.php" method="post" id="signup-form">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="username" class="form-control form-control-lg" name="username" />
                                    <label class="form-label" for="username"><i class="bi bi-person-add"></i> Username</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="fullname" class="form-control form-control-lg" name="fullname" />
                                    <label class="form-label" for="fullname"><i class="bi bi-pencil-square"></i> Full Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4 d-flex align-items-center">
                                <div class="form-outline datepicker w-100">
                                    <input type="date" class="form-control form-control-lg" id="birthday" name="birthday" />
                                    <label for="birthdayDate" class="form-label"><i class="bi bi-calendar"></i> Birthday</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">

                                <h6 class="mb-2 pb-1">Gender: </h6>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="female" checked />
                                    <label class="form-check-label" for="femaleGender"><i class="bi bi-gender-female"></i> Female</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="male" />
                                    <label class="form-check-label" for="maleGender"><i class="bi bi-gender-male"></i> Male</label>
                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4 pb-2">

                                <div class="form-outline">
                                    <span id="check-email-unique"></span>
                                    <input type="email" id="email" class="form-control form-control-lg" name="email" onInput="checkEmailUnique()" />
                                    <label class="form-label" for="emailAddress"><i class="bi bi-envelope-at-fill"></i> Email</label>
                                </div>

                            </div>
                            <div class="col-md-6 mb-4 pb-2">

                                <div class="form-outline">
                                    <span id="check-phone-unique"></span>
                                    <input type="tel" id="phone" class="form-control form-control-lg" name="phone" onInput="checkPhoneUnique()" />
                                    <label class="form-label" for="phoneNumber"><i class="bi bi-telephone-fill"> Phone Number</i></label>
                                </div>

                            </div>

                            <div class="col-md-6 mb-4 pb-2 w-100">
                                <div class="form-outline">
                                    <input type="address" id="address" class="form-control form-control-lg" name="address" />
                                    <label class="form-label" for="address"><i class="bi bi-house-add"> Address</i></label>
                                </div>
                                <div class="form-outline">
                                    <input type="password" id="password" class="form-control form-control-lg" name="password" />
                                    <label class="form-label" for="password"><i class="bi bi-file-lock"> Password</i></label>
                                </div>

                            </div>

                            <div class="col-md-6 mb-4 pb-2 w-100">

                                <div class="form-outline">
                                    <input type="password" id="repeat_password" class="form-control form-control-lg" name="repeat_password" />
                                    <label class="form-label" for="repeat_password"><i class="bi bi-file-lock"> Repeat password</i></label>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <select class="select form-control-lg" name="user_type" id="user_type">
                                    <option value="choose_user_type" disabled>Choose type of user you want to create</option>
                                    <option value="1">Admin</option>
                                    <option value="2">NhanVien</option>
                                </select>
                                <label class="form-label select-label"><i class="bi bi-person-fill-gear"></i> Choose user type option</label>

                            </div>
                        </div>
                        <div class="mt-4 pt-2">
                            <input class="btn btn-primary btn-lg" type="submit" value="Register" name="btn-reg" id="check-email" />
                        </div>

                    </form>
                </div>
            </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#signup-form').submit(function(event) {
                event.preventDefault(); // prevent form from submitting normally

                var username = $('#username').val();
                var fullname = $('#fullname').val();
                var birthday = $('#birthday').val();
                var gender = $('#gender').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var address = $('#address').val();
                var password = $('#password').val();
                var repeat_password = $('#repeat_password').val();
                var user_type = $('#user_type').val();

                // Check if any field is empty
                if (username == "" || fullname == "" || birthday == "" || gender == "" || email == "" || phone == "" || address == "" || password == "" || repeat_password == "" || user_type == "") {
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
                    url: "./database/check_email.php",
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
                                url: "./database/check_phone.php",
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
                                            url: "./database/register_users.php",
                                            data: {
                                                username: username,
                                                fullname: fullname,
                                                birthday: birthday,
                                                gender: gender,
                                                email: email,
                                                phone: phone,
                                                address: address,
                                                password: password,
                                                user_type: user_type,
                                                'btn-reg': 1

                                            },
                                            success: function(response) {
                                                if (response == "verification_code") {
                                                    alert("Register successfully");
                                                    window.location.href = "./Admin.php";
                                                } else {
                                                    alert("Register successfully");
                                                    window.location.href = "./Admin.php";
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
            jQuery.ajax({
                url: "database/check_availability.php",
                data: 'email=' + $("#email").val(),

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
                url: "database/check_availability.php",
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