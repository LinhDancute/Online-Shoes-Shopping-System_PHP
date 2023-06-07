<?php
require_once __DIR__ . "/../database/connectDB.php";
session_start(); // start the session 

if (!isset($_SESSION['user_token']) && !isset($_SESSION['email'])) {
    // user is not logged in, redirect to login page
    header("Location: ../index.php");
    //echo("out");
    die();
}

//display user info
if (isset($_SESSION['user_token'])) {
    // user logged in via Google
    $userinfo = $_SESSION['userinfo'];
    $email = $userinfo['email'];
    $username = $userinfo['username'];

    $sql = "SELECT * FROM clients WHERE email ='{$userinfo['email']}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    //$email = $_SESSION['email'];

    $address = isset($_SESSION['address']) ? $_SESSION['address'] : null;
    // you can add more fields here if needed
}
if (isset($_SESSION['email'])) {
    // user logged in normally
    $email = $_SESSION['email'];
    // query the clients table for user info
    $sql = "SELECT * FROM clients WHERE email='$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $phone = $row['phone'];
    $address = $row['address'];
    // you can add more fields here

}

// close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <?php if (isset($_SESSION['user_token'])) { ?>
        <div class="container">
            <h1>Welcome, <?= $username ?></h1>
            <div class="row">
                <div class="col-md-3">
                    <img src="<?= $userinfo['picture'] ?>" alt="" class="img-thumbnail" width="150px" height="150px">
                </div>
                <div class="col-md-9">
                    <ul class="list-group">
                        <li class="list-group-item">Full Name: <?= $username ?></li>
                        <li class="list-group-item">Email Address: <?= $email ?></li>
                        <?php if (!empty($row['address'])) : ?>
                            <li class="list-group-item">
                                Address:
                                <span id="address"><?= $row['address'] ?></span>
                                <a href="#" id="edit-address-gg">Edit</a>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="update-address-form-gg" style="display: none;">
                                    <div class="input-group">
                                        <input type="text" name="address-gg" id="address-input-gg" class="form-control" value="<?= $row['address'] ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </li>

                            <li class="list-group-item">
                                Phone number:
                                <span id="phone"><?= $row['phone'] ?></span>
                                <a href="#" id="edit-phone-gg">Edit</a>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="update-phone-form-gg" style="display: none;">
                                    <div class="input-group">
                                        <input type="text" name="phone-gg" id="phone-input-gg" class="form-control" value="<?= $row['phone'] ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <!-- add more fields here -->
                            <div class="d-flex justify-content-around input-group mb-3">
                                <a class="btn btn-primary btn-lg" href="./../page/logout.php">Logout</a>
                                <input class="btn btn-primary btn-lg" type="submit" value="Back" onclick="goBack()" />
                            </div>
                            <script>
                                const editAddressLink_GG = document.querySelector('#edit-address-gg');
                                const addressElement_GG = document.querySelector('#address');
                                const addressInput_GG = document.querySelector('#address-input-gg');
                                const updateAddressForm_GG = document.querySelector('#update-address-form-gg');


                                editAddressLink_GG.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    addressElement_GG.style.display = 'none';
                                    editAddressLink_GG.style.display = 'none';
                                    updateAddressForm_GG.style.display = 'block';
                                    addressInput_GG.style.width = '35%';
                                });

                                updateAddressForm_GG.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    const xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                        if (this.readyState === 4 && this.status === 200) {
                                            location.reload();

                                        }
                                    };
                                    xhr.open('POST', './../page/updateInformationGG.php');
                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                    xhr.send('address=' + encodeURIComponent(addressInput_GG.value));
                                });
                            </script>
                            <script>
                                const editPhoneLink_GG = document.querySelector('#edit-phone-gg');
                                const phoneElement_GG = document.querySelector('#phone');
                                const phoneInput_GG = document.querySelector('#phone-input-gg');
                                const updatePhoneForm_GG = document.querySelector('#update-phone-form-gg');

                                editPhoneLink_GG.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    phoneElement_GG.style.display = 'none';
                                    editPhoneLink_GG.style.display = 'none';
                                    updatePhoneForm_GG.style.display = 'block';
                                    phoneInput_GG.style.width = '35%';
                                });

                                updatePhoneForm_GG.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    const xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                        if (this.readyState === 4 && this.status === 200) {
                                            location.reload();
                                        }
                                    };
                                    xhr.open('POST', './../page/updateInformationGG_phone.php');
                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                    xhr.send('phone=' + encodeURIComponent(phoneInput_GG.value));
                                });
                            </script>
                        <?php else : ?>
                            <li class="list-group-item">
                                <a href="#" id="add-address">Add Address</a>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="add-address-form" style="display: none;">
                                    <div class="input-group">
                                        <input type="text" name="new-address" id="new-address-input" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Add</button>
                                            <a href="#" id="cancel-add-address" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <script>
                                const addAddressLink_GG = document.querySelector('#add-address');
                                const cancelAddAddressLink_GG = document.querySelector('#cancel-add-address');
                                const newAddressInput_GG = document.querySelector('#new-address-input');
                                const addAddressForm_GG = document.querySelector('#add-address-form');

                                addAddressLink_GG.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    addAddressLink_GG.style.display = 'none';
                                    addAddressForm_GG.style.display = 'block';
                                });

                                cancelAddAddressLink_GG.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    addAddressForm_GG.style.display = 'none';
                                    addAddressLink_GG.style.display = 'block';
                                });

                                addAddressForm_GG.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    const xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                        if (this.readyState === 4) {
                                            if (this.status === 200) {
                                                location.reload();

                                            } else {
                                                console.log('Error: ' + this.status);
                                            }
                                        }
                                    };
                                    xhr.open('POST', './../page/updateInformationGG.php');
                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                    xhr.send('new-address=' + encodeURIComponent(newAddressInput_GG.value));
                                });
                            </script>
                            <li class="list-group-item">
                                <a href="#" id="add-phone">Add Phone number</a>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="add-phone-form" style="display: none;">
                                    <div class="input-group">
                                        <input type="text" name="new-phone" id="new-phone-input" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Complete</button>
                                        </div>
                                    </div>
                                </form>
                            </li>

                            <div class="d-flex justify-content-around input-group mb-3">
                                <a class="btn btn-primary btn-lg" href="./../page/logout.php">Logout</a>
                                <input class="btn btn-primary btn-lg" type="submit" value="Back" onclick="goBack()" />
                            </div>

                        <?php endif; ?>

                        <script>
                            const addPhoneLink_GG = document.querySelector('#add-phone');
                            const cancelAddPhoneLink_GG = document.querySelector('#cancel-add-phone');
                            const newPhoneInput_GG = document.querySelector('#new-phone-input');
                            const addPhoneForm_GG = document.querySelector('#add-phone-form');

                            addPhoneLink_GG.addEventListener('click', function(e) {
                                e.preventDefault();
                                addPhoneLink_GG.style.display = 'none';
                                addPhoneForm_GG.style.display = 'block';
                            });

                            cancelAddPhoneLink_GG.addEventListener('click', function(e) {
                                e.preventDefault();
                                addPhoneForm_GG.style.display = 'none';
                                addPhoneLink_GG.style.display = 'block';
                            });

                            addPhoneForm_GG.addEventListener('submit', function(e) {
                                e.preventDefault();
                                const xhr = new XMLHttpRequest();
                                xhr.onreadystatechange = function() {
                                    if (this.readyState === 4) {
                                        if (this.status === 200) {
                                            location.reload();

                                        } else {
                                            console.log('Error: ' + this.status);
                                        }
                                    }
                                };
                                xhr.open('POST', './../page/updateInformationGG_phone.php');
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.send('new-phone-number=' + encodeURIComponent(newPhoneInput_GG.value));
                            });
                        </script>
                    </ul>
                </div>
            <?php } else { ?>
                <div class="container">
                    <h1>Welcome, <?= isset($email) ? $email : $email ?></h1>
                    <div class="row">
                        <div class="col-md-3">
                            <img src="/img/default_profile_picture.png" alt="" width="150px" height="150px">
                        </div>
                        <div class="col-md-9">
                            <ul class="list-group">
                                <li class="list-group-item">Email Address: <?= $email ?></li>
                                <?php if (isset($phone)) : ?>
                                    <li class="list-group-item">Phone Number: <?= $phone ?></li>
                                <?php endif; ?>
                                <?php if (isset($address)) : ?>
                                    <li class="list-group-item">
                                        Address:
                                        <span id="address"><?= $address ?></span>
                                        <a href="#" id="edit-address">Edit</a>
                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="update-address-form" style="display: none;">
                                            <input type="text" name="address" id="address-input" value="<?= $address ?>">
                                            <button type="submit">Save</button>
                                        </form>
                                    </li>
                                <?php endif; ?>
                                <!-- Add more fields here -->
                                <div class="d-flex justify-content-around input-group mb-3">
                                    <a class="btn btn-primary btn-lg" href="./../page/logout.php">Logout</a>
                                    <input class="btn btn-primary btn-lg" type="submit" value="Back" onclick="goBack()" />
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <script>
                    const editAddressLink = document.querySelector('#edit-address');
                    const addressElement = document.querySelector('#address');
                    const addressInput = document.querySelector('#address-input');
                    const updateAddressForm = document.querySelector('#update-address-form');

                    editAddressLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        addressElement.style.display = 'none';
                        editAddressLink.style.display = 'none';
                        updateAddressForm.style.display = 'block';
                        addressInput.style.width = '35%';
                    });

                    updateAddressForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                            if (this.readyState === 4 && this.status === 200) {
                                location.reload();
                            }
                        };
                        xhr.open('POST', './../page/updateInformation.php');
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.send('address=' + encodeURIComponent(addressInput.value));
                    });
                </script>
            <?php } ?>

            <script>
                // JavaScript function to go back to the previous page
                function goBack() {
                    window.history.back();
                }
            </script>
</body>

</html>