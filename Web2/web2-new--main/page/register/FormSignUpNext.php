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
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Complete Information <i class="bi bi-database-add"></i></h3>
                            <form action="database/register_clients.php" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-4 w-100">
                                        <div class="form-outline">
                                            <input type="text" id="username" class="form-control form-control-lg" name="username" />
                                            <label class="form-label" for="username"><i class="bi bi-person-add"></i> Username</label>
                                            
                                            <input type="text" id="fullname" class="form-control form-control-lg" name="fullname" />
                                            <label class="form-label" for="fullname"><i class="bi bi-pencil-square"></i> Full Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div class="form-outline datepicker w-100">
                                            <input type="date" class="form-control form-control-lg" id="birthdayDate" name="birthday" />
                                            <label for="birthdayDate" class="form-label"><i class="bi bi-calendar"></i> Birthday</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">

                                        <h6 class="mb-2 pb-1">Gender: </h6>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="female" checked />
                                            <label class="form-check-label" for="femaleGender"><i class="bi bi-gender-female"></i> Female</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="maleGender" value="male" />
                                            <label class="form-check-label" for="maleGender"><i class="bi bi-gender-male"></i> Male</label>
                                        </div>


                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2 w-100">
                                        <div class="form-outline">
                                            <input type="address" id="address" class="form-control form-control-lg" name="address" />
                                            <label class="form-label" for="address"><i class="bi bi-house-add"> Address</i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 pb-2 w-100">
                                        <div class="form-outline">
                                            <input type="password" id="password" class="form-control form-control-lg" name="password" />
                                            <label class="form-label" for="password"><i class="bi bi-file-lock"> password</i></label>
                                        </div>
                                        <div class="form-outline">
                                            <input type="password" id="repeat_password" class="form-control form-control-lg" name="repeat_password" />
                                            <label class="form-label" for="repeat_password"><i class="bi bi-file-lock"> Repeat password</i></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-evenly">
                                    <div class="col-4">
                                        <p class="mb-0 d-flex justify-content-center"><a href='index.php?number=signup' class="text-black-50 fw-bold text-decoration-none"><i class="bi bi-arrow-90deg-left"></i> Back</a></p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 d-flex justify-content-center"><a href='index.php?number=signup-next' class="text-black-50 fw-bold text-decoration-none">Register</a></p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>