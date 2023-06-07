<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Document</title>
</head>

<body>
    <?php

    // $permission = [    
    //     1 => [
    //         'sanpham' => ['view'],
    //         'order' => ['view'],
    //         'account' => ['view', 'add', 'edit', 'delete'],
    //         'brand' => ['view'],
    //         'category' => ['view'],
    //         'statistics' => ['view']
    //     ],
    //     2 => [
    //         'sanpham' => ['view', 'add', 'edit', 'delete'],
    //         'order' => ['view', 'add', 'edit', 'delete'],
    //         'account' => ['view'],
    //         'brand' => ['view', 'add', 'edit', 'delete'],
    //         'category' => ['view', 'add', 'edit', 'delete'],
    //         'statistics' => ['view', 'add', 'edit', 'delete']
    //     ]
    //     ];
    $user_group = isset($_SESSION['user_group']) ? $_SESSION['user_group'] : null;
    // $user_group = 1;
    // session_start();
    // $_SESSION['user_group'] = $user_group;
    // Check if the user has permission to add a product
    if ($user_group !== null && in_array('add', $permissions[$user_group]['category'])) {
        // Display the add product form
        // ...
    } else {
        // Display an error message or redirect the user
        // ...
    }

    ?>
    <table class="table" id="Category">
        <thead>
            <tr>
                <th role="button">ID</th>
                <th role="button">Name</th>
                <th role="button">Action</th>
            </tr>
        </thead>
        <?php
        include_once("./dbconnect.php");
        $dbcon = new dbconnect();
        $conn = $dbcon->connect();
        $query = "Select * from category";
        $result = $dbcon->select($query, $conn);
        while ($row = mysqli_fetch_assoc($result)) {
            print <<<HERE
                <tr>
                <td>$row[ID]</td>
                <td>$row[Name]</td>
                <td>
                    <button type="button" onclick="Product_Details('Category')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateCategory">
                        Details
                    </button>
                </td>
                </tr>
            HERE;
        }
        ?>
    </table>
    <?php
    $action_group_ID = $_SESSION['user_group'];
    if (checkStatus(1, $action_group_ID)) {
        echo "<button type='button' class='btn btn-primary mx-5' data-bs-toggle='modal' data-bs-target='#AddCategory'>
                    Create new product
                </button>";
    }
    ?>
    <!--Add Product Modal Start-->
    <div class="modal fade" id="AddCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/Admin/Category/Category_Controller.php">
                        <div class="mb-3 row">
                            <div class="col-6">
                                <input type="hidden" name="action" value="insert">
                                <label for="Name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="Name" name="Name">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--Add Product Modal end-->

    <!-- Details modal start -->
    <div class="modal fade" id="UpdateCategory" tabindex="-1" aria-labelledby="Category_Details_modal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Category_Details_modal">Category Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/Admin/Category/Category_Controller.php">
                        <div class="mb-3 row">
                            <div class="col-6">
                                <input type="hidden" name="action" value="update">

                                <input type="hidden" class="form-control" id="DID" name="ID" value=>
                                <label for="DName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="DName" name="Name" value=>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php
                            $action_group_ID = $_SESSION['user_group'];
                            if (checkStatus(1, $action_group_ID)) {
                                echo "<div class='modal-footer'>
                                    <input type='submit' class='btn btn-primary' value='Save'>
                                        </div>
                                    <a class='btn btn-danger' onclick=\"del('Category')\">Delete</a>";
                            } else {
                            }
                            ?>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Details modal end -->


    <script src="./js.js"></script>
</body>

</html>