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
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Reset Password Form <i class="bi bi-person-circle"></i></h3>
                            <form action="database/reset_clients_phone.php" method="post" id="forget-password-form">
                                <div class="row">
                                    <div class="col-md-3 mb-1 pb-2 w-100">
                                        <div class="form-outline">
                                            <span id="check-phone-unique"></span>
                                            <input type="tel" id="phone" class="form-control form-control-lg" name="phone" onInput="checkPhoneUnique()" />
                                            <label class="form-label" for="phoneNumber"><i class="bi bi-telephone-fill"> Phone Number</i></label>
                                            <div class="fst-italic">
                                                <div class="d-flex justify-content-start input-group mb-3">
                                                    <input class="btn btn-primary btn-lg" type="submit" value="Send OTP to your phone" name="verify-phone" id="verify-phone" />
                                                </div>
                                            </div>
                                            <div class=" d-flex justify-content-end">
                                                <div class="col-4">
                                                    <p class="mb-0 d-flex justify-content-center "><a href='../../index.php' class="text-black-50 fw-bold text-decoration-none" onclick="goToLoginPage()"><i class="bi bi-arrow-90deg-left"></i> Back </a></p>
                                                </div>
                                            </div>
                                        </div>
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
            $('#forget-password-form').submit(function(event) {
                event.preventDefault(); // prevent form from submitting normally

                var phone = $('#phone').val();

                // Check if any field is empty
                if (phone == "") {
                    alert("Please fill out the information completely");
                    return false;
                }
                // Check Phone format
                if (!/^(\+84)[0-9]{9}$/.test(phone)) {
                    alert("Incorrect OTP format. Please enter a valid phone number starting with '+84' followed by 9 digits.");
                    return false;
                }
                // Check if email already exists in database
                $.ajax({
                    type: 'POST',
                    //url: 'http://localhost:8012/web2-new--main/web2-new--main/database/check_OTP_email.php',
                    url: '../../database/check_phone.php',
                    data: {
                        phone: phone,
                    },
                    success: function(response) {
                        if (response == 'not_found') {
                            alert("phone number does not exist, please re-enter.");
                            //window.location.href = './database/reset_clients_phone.php';
                        } else {
                            $.ajax({
                                type: 'POST',
                                //url: 'http://localhost:8012/web2-new--main/web2-new--main/database/check_OTP_email.php',
                                url: '../../database/reset_clients_phone.php',
                                data: {
                                    phone: phone,
                                    'verify-phone': 1,
                                },
                                success: function(response) {
                                    if (response == 'verification_code') {
                                        alert("Please check your SMS for verification code.");
                                        window.location.href = '../../page/reset_password/OTP_phone_reset.php';
                                    } else {
                                        alert("Please check your SMS for verification code.");
                                        window.location.href = '../../page/reset_password/OTP_phone_reset.php';
                                    }
                                }
                            });
                        }
                    }
                });
            });
        });

        function checkPhoneUnique() {
            // ensure the phone number starts with '+84'
            let phone = $("#phone").val();
            if (!phone.startsWith("+84")) {
                phone = "+84" + phone;
            }
            jQuery.ajax({
                url: "../../database/check_availability_register.php",
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