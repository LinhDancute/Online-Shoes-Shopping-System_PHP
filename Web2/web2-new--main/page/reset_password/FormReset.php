<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Reset Password<i class="bi bi-person-circle"></i></h3>
                            <form action="../../database/resetPassword.php" method="post" id="reset-password">
                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2 w-100">
                                        <div class="form-outline">
                                            <input type="password" id="password" class="form-control form-control-lg" name="password" />
                                            <label class="form-label" for="password"><i class="bi bi-file-lock"> New password</i></label>
                                        </div>
                                        <div class="form-outline">
                                            <input type="password" id="repeat_password" class="form-control form-control-lg" name="repeat_password" />
                                            <label class="form-label" for="repeat_password"><i class="bi bi-file-lock"> Repeat new password</i></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="fst-italic">
                                    <div class="d-flex flex-row-reverse bd-highlight input-group mb-3">
                                        <input class="btn btn-primary btn-lg" type="submit" value="Accept" name="Accept" id="Accept" />
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
            $('#reset-password').submit(function(event) {
                event.preventDefault(); // prevent form from submitting normally

                var password = $('#password').val();
                var repeat_password = $('#repeat_password').val();

                if (password === "" || repeat_password === "") {
                    alert("Please enter both password and confirm password fields.");
                    return false;
                }

                // Check if password and confirm password match
                if (password !== repeat_password) {
                    alert("Password does not match. Please re-enter the password.");
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    //url: 'http://localhost:8012/web2-new--main/web2-new--main/database/check_OTP_email.php',
                    url: '../../database/resetPassword.php',
                    data: {
                        password: password,
                        repeat_password: repeat_password,
                        'Accept': 1,
                    },
                    success: function(response) {
                        if (response == 'success') {
                            // Passwords match, redirect to the index page
                            alert("Reset password successfully.");
                            window.location.href = '../../index.php';
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