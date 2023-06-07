<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-0">Register Form/Verify Email</h3>
                            <form action="../../database/check_OTP_email.php" method="POST" id="otp-form">

                                <div class="container overflow-hidden">
                                    <p>Check your email, OTP have already sent</p>
                                    <div class="row gy-3">

                                        <div class="col-md-6 mb-0 w-100">
                                            <input type="text" id="OTP" class="form-control form-control-lg" name="OTP" />
                                            <label class="form-label" for="email"> Verify Email/OTP</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-evenly text-decoration-none">
                                    <div class="fst-italic">
                                        <div class="d-flex justify-content-start input-group mb-3">
                                            <input class="btn btn-primary btn-lg" type="submit" value="Back" name="back" id="back" onclick="goToLoginPage()" />
                                        </div>
                                    </div>
                                    <script>
                                        function goToLoginPage() {
                                            window.location.href = "http://localhost:8012/web2-new--main/web2-new--main/index.php?number=login";
                                        }
                                    </script>
                                    <div class="fst-italic">
                                        <div class="d-flex justify-content-start input-group mb-3">
                                            <input class="btn btn-primary btn-lg" type="submit" value="Next" name="check-verify-email" id="next" />
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
        $(document).ready(function() {
            $('#otp-form').submit(function(event) {
                event.preventDefault(); // prevent form from submitting normally

                var OTP = $('#OTP').val();

                if (OTP == "") {
                    alert("OTP cannot be empty, please enter correct OTP");
                    return false;
                }
                // check OTP format
                if (!/^[a-zA-Z0-9]{6}$/.test(OTP)) {
                    alert("Incorrect OTP format, please enter a 6-digit alphanumeric OTP");
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    //url: 'http://localhost:8012/web2-new--main/web2-new--main/database/check_OTP_email.php',
                    url: '../../database/check_OTP_email.php',
                    data: {
                        OTP: OTP,
                    },
                    success: function(response) {
                        if (response == 'success') {
                            console.log('Verification successful');
                            alert("Verification successful. You will now be redirected to the main page.");
                            window.location.href = '../../index.php';
                        } else if (response == 'incorrect_otp') {
                            console.log('Incorrect OTP entered');
                            alert("Incorrect OTP entered. Please try again.");
                        } else {
                            console.log('Other response');
                            alert(response);
                        }
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>