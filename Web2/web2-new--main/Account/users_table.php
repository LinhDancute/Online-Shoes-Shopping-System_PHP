<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form class="input-group float-right w-50 my-3" action="" method="get">
        <input type="hidden" name="chon" value=accounts>
        <input class="form-control w-50" name="s" type="search" placeholder="Search" aria-label="Search" value="<?php
                                                                                                                if (isset($_GET["s"]))
                                                                                                                    echo $_GET["s"];
                                                                                                                ?>" />
        <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <?php
    include_once("./dbconnect.php");
    $dbcon = new dbconnect();
    $conn = $dbcon->connect();
    if (isset($_GET['page'])) {
        $page = intval($_GET['page']);
    } else {
        $page = 1;
    }
    // Calculate the starting row for this page
    $rows_per_page = 10;
    $start_row = ($page - 1) * $rows_per_page;
    if (isset($_GET["s"])) {
        $s = $_GET["s"];

        $URL = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $query = "select * from users where ID LIKE '%$s%' OR Username LIKE '%$s%' OR Name LIKE '%$s%' OR Phone LIKE '%$s%' LIMIT $start_row, $rows_per_page";
    } else
        $query = "Select * from users LIMIT $start_row, $rows_per_page";
    $result = $dbcon->select($query, $conn);
    print <<<HERE
        <table class="table" id="users">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Password</th>
                <th>Type</th>
                <th style='Display:none'>Created_at</th>
                <th>Action</th>
            </tr>
        </thead>
        HERE;
    while ($row = mysqli_fetch_assoc($result)) {
        print <<<HERE
                <tr>
                <td>$row[id]</td>
                <td>$row[username]</td>
                <td style='Display:none'>$row[fullname]</td>
                <td style='Display:none'>$row[birthday]</td>
                <td style='Display:none'>$row[gender]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td style='Display:none'>$row[address]</td>
                <td>$row[password]</td>
                <td>$row[user_type]</td>
                <td style='Display:none'>$row[created_at]</td>
                <td>
                    <button type="button" id="Accountbtn" onclick="User_Details('users')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateAccount">
                        Details
                    </button>
                </td>
                </tr>
            HERE;
    }
    ?>
    </table>
    <?php
    // Check if the user has permission to add a product
    if ($user_group !== null && in_array('add', $permissions[$user_group]['users'])) {
        echo "<a href='http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=createUser' type='button' class='btn btn-primary mx-5'>
        Add new user
    </a>";
    } else {
        // echo "<script>alert('Brand already exists');</script>";
        // echo "<script>location.href='http://localhost:8080/admin/admin.php?chon=brand';</script>";
    }
    ?>
    <!-- Details modal start -->
    <div class="modal fade" id="UpdateAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Account Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="Account/users_Controller.php">
                        <div class="mb-3 row">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" class="form-control" id="DID" name="ID" value=>
                            <label for="DName" class="form-label my-1">Name</label>
                            <input type="text" class="form-control" id="DName" name="Name">
                            <label for="DPhone" class="form-label my-1">Phone</label>
                            <input type="text" class="form-control" id="DPhone" name="Phone">
                            <label for="DAdress" class="form-label my-1">Address</label>
                            <input type="text" class="form-control" id="DAddress" name="Address">
                            <label for="DUsername" class="form-label my-1">Username</label>
                            <input type="text" class="form-control" id="DUsername" name="Username">
                            <label for="DPassword" class="form-label my-1">Password</label>
                            <input type="text" class="form-control" id="DPassword" name="Password">
                            <label for="Dgender" class="form-label my-1">Gender</label>
                            <select class="form-select" aria-label="Default select example" id="Dgender" name="Gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="Demail" class="form-label my-1">Email</label>
                            <input type="text" class="form-control" id="Demail" name="Email">
                            <label for="Dbirthday" class="form-label my-1">BirthDay</label>
                            <input type="date" class="form-control" id="Dbirthday" name="Birthday">
                            <label for="DType" class="form-label my-1">Type</label>
                            <select class="form-select" aria-label="Default select example" id="DType" name="Type">
                                <?php
                                $query = "select * from action_group";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value=" . $row["action_group_ID"] . ">" . $row["Name"] . "</option>";
                                }
                                ?>
                            </select>
                            <label for="DType" class="form-label my-1">Created at</label>
                            <input type="text" class="form-control" id="created_at" name="created_at" readonly>
                        </div>
                        <div class="modal-footer">
                            <?php
                            if ($user_group !== null && in_array('edit', $permissions[$user_group]['users'])) {
                                echo "<input type='submit' class='btn btn-primary' value='Save'>
                                    <a class='btn btn-danger' onclick='del('Account')'>Delete</a>
                                
                                ";
                            } else {
                            }
                            ?>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
    $query = "SELECT COUNT(*) FROM users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $total_rows = $row[0];
    $total_pages = ceil($total_rows / $rows_per_page);

    echo '<div class="d-flex justify-content-center">';
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination">';

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $query = $_GET;
            // replace parameter(s)
            $query['page'] = $i;
            // rebuild url
            $query_result = http_build_query($query);
            echo "<li class='page-item'><a class='page-link' href='$_SERVER[PHP_SELF]?$query_result'>$i</a></li>";
        }
    }

    echo '</ul>';
    echo '</nav>';
    echo '</div>';
    ?>

    <!-- Details modal end -->

</body>

</html>