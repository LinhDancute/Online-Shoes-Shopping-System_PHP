<?php
// @ob_start();
// session_start(); 
// $permissions = [    
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
// ];

$user_group = isset($_SESSION['user_group']) ? $_SESSION['user_group'] : null;

if ($user_group !== null && in_array('add', $permissions[$user_group]['sanpham'])) {
    // Display the add product form
    // ...
} else if ($user_group === null) {
    // Display an error message or redirect the user
    // ...
}
// ob_flush();
?>

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
        <input type="hidden" name="chon" value=<?php
                                                if (isset($_GET['chon']))
                                                    echo $_GET["chon"];

                                                ?>>
        <input type="hidden" name="sort" value=<?php
                                                if (isset($_GET['sort']))
                                                    echo $_GET["sort"];

                                                ?>>
        <input type="hidden" name="ASC" value=<?php
                                                if (isset($_GET['ASC']))
                                                    echo $_GET["ASC"];

                                                ?>>
        <input class="form-control w-50" name="s" type="search" placeholder="Search" aria-label="Search" value="<?php
                                                                                                                if (isset($_GET["s"]))
                                                                                                                    echo $_GET["s"];
                                                                                                                ?>" />
        <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>
    <table class="table" id="Product">
        <thead>
            <tr>
                <th><a class="btn fw-bold" href=<?php
                                                $url = "admin.php?chon=product&sort=ID&";
                                                if (isset($_GET["s"]))
                                                    $url = $url . "s=" . $_GET["s"] . "&";
                                                if (isset($_GET["ASC"]) && $_GET["ASC"] == "YES")
                                                    echo  $url . "ASC=NO";
                                                else
                                                    echo $url . "ASC=YES";
                                                ?>>ID</a></th>

                <th>
                    <a class="btn fw-bold" href="<?php
                                                    $url = "admin.php?chon=product&sort=Name&";
                                                    if (isset($_GET["s"])) {
                                                        $url .= "s=" . $_GET["s"] . "&";
                                                    }
                                                    if (isset($_GET["ASC"]) && $_GET["ASC"] == "YES") {
                                                        echo $url . "ASC=NO";
                                                    } else {
                                                        echo $url . "ASC=YES";
                                                    }
                                                    ?>">Name</a>
                </th>

                <th>
                    <a class="btn fw-bold" href=<?php
                                                $url = "admin.php?chon=product&sort=Price&";
                                                if (isset($_GET["s"])) {
                                                    $url = $url . "s=" . $_GET["s"] . "&";
                                                }
                                                if (isset($_GET["ASC"]) && $_GET["ASC"] == "YES") {
                                                    echo $url . "ASC=NO";
                                                } else {
                                                    echo $url . "ASC=YES";
                                                }
                                                ?>>Price</a>
                </th>
                <th>Category</th>
                <th>Brand</th>

                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
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
        $asc = "DESC"; // default sorting order
        if (isset($_GET["ASC"]) && $_GET["ASC"] == "YES") {
            $asc = "ASC";
        }
        $sort = "ID"; // default sorting column
        if (isset($_GET["sort"])) {
            $sort = $_GET["sort"];
        }
        if (isset($_GET["s"])) {
            $s = $_GET["s"];
            $URL = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $query = "select * from product where ID LIKE '%$s%' OR Name LIKE '%$s%' OR Brand_ID LIKE '%$s%' OR category_ID LIKE '%$s%' ORDER BY $sort $asc LIMIT $start_row, $rows_per_page";
        } else {

            $query = "Select * from product ORDER BY $sort $asc LIMIT $start_row, $rows_per_page";
        }
        $result = $dbcon->select($query, $conn);
        while ($row = mysqli_fetch_assoc($result)) {
            print <<<HERE
                <tr>
                <td>$row[ID]</td>
                <td>$row[Name]</td>
                <td>$row[Price]</td>
                <td>$row[Category_ID]</td>
                <td>$row[Brand_ID]</td>
                <td style='Display:none'>$row[Description]</td>
                <td style='Display:none'>$row[Img]</td>
                <td style='Display:none'>$row[status]</td>
                <td><button type="button"  id="Sizebtn" onclick="Size_Details('Product')" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#QuantityModal">
                Quantity
            </button></td>
                <td>
                    <button type="button" id="Detailbtn" onclick="Product_Details('Product')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateProduct">
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
        echo "<button type='button' class='btn btn-primary mx-5' data-bs-toggle='modal' data-bs-target='#AddProduct'>
                    Create new product
                </button>";
    }

    ?>
    <!-- <button type="button" class="btn btn-primary mx-5" data-bs-toggle="modal" data-bs-target="#AddProduct">
        Create new product
    </button> -->
    <!--Add Product Modal Start-->
    <div class="modal fade" id="AddProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="product/Product_Controller.php" id="add-product-form">
                        <div class="mb-3 row">
                            <div class="col-6">
                                <input type="hidden" name="action" value="insert">
                                <label for="Name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="Name" name="Name">
                                <label for="Price" class="form-label">Price</label>
                                <input type="text" class="form-control" id="Price" name="Price">
                                <label for="Description" class="form-label">Description</label>
                                <textarea type="text-area" class="form-control" id="Description" name="Description"></textarea>
                                <label for="Category" class="form-label">Category</label>
                                <select class="form-select" aria-label="Default select example" id="Category" name="Category">
                                    <?php
                                    $query = "select * from category";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value=" . $row["ID"] . ">" . $row["Name"] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="Brand" class="form-label">Brand</label>
                                <select class="form-select" aria-label="Default select example" id="Brand" name="Brand">
                                    <?php
                                    $query = "select * from Brand";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value=" . $row["ID"] . ">" . $row["Name"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6 text-center">
                                <input type="file" name="img_file" id="img_file" class="form-control-plain-text mb-3" onchange="Displayimg('img_file','product_img')">
                                <img src="" class="rounded img-fluid img-thumbnail" alt="product_img" id="product_img">
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
    <div class="modal fade" id="UpdateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="product/Product_Controller.php" id="detail-product-form">
                        <div class="mb-3 row">
                            <div class="col-6">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" class="form-control" id="default_img" name="default_img" value="">
                                <input type="hidden" class="form-control" id="DID" name="ID" value=>
                                <label for="DName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="DName" name="Name" value=>
                                <label for="DPrice" class="form-label">Price</label>
                                <input type="text" class="form-control" id="DPrice" name="Price">
                                <label for="Description" class="form-label">Description</label>
                                <textarea type="text-area" class="form-control" id="DDescription" name="Description"></textarea>
                                <label for="DCategory" class="form-label">Category</label>
                                <select class="form-select" aria-label="Default select example" id="DCategory" name="Category">
                                    <?php
                                    $query = "select * from category";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value=" . $row["ID"] . ">" . $row["Name"] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="DBrand" class="form-label">Brand</label>
                                <select class="form-select" aria-label="Default select example" id="DBrand" name="Brand">
                                    <?php
                                    $query = "select * from Brand";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value=" . $row["ID"] . ">" . $row["Name"] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" aria-label="Default select example" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>


                                </select>

                            </div>
                            <div class=" col-6 text-center">
                                <label for="Dimg_file" class="form-control" role="button">Select img</label>
                                <input type="file" name="img_file" id="Dimg_file" class="form-control d-none" onchange="Displayimg('Dimg_file','Dproduct_img')">
                                <img src="" class="rounded img-fluid img-thumbnail" alt="product_img" id="Dproduct_img">
                            </div>
                        </div>
                        <div class="modal-footer">

                            <?php
                            $action_group_ID = $_SESSION['user_group'];
                            if (checkStatus(1, $action_group_ID)) {
                                echo "<div class='modal-footer'>
                                    <input type='submit' class='btn btn-primary' value='Save'>
                                        </div>";
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

    <!-- Quantity modal start -->
    <div class="modal fade" id="QuantityModal" tabindex="-1" aria-labelledby="QuantityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="QuantityModalLabel">Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="product/Quantity_Controller.php" id="size_form">

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Quantity modal end -->
    <?php
    $query = "SELECT COUNT(*) FROM product";
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

    <script src="./js.js"></script>
</body>

</html>