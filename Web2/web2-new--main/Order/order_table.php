<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form class="ms-auto my-3 my-lg-0">
        <div class="w-25">
            <input type="hidden" name="chon" value="orders">
            <label for="startdate">From:</label>
            <input type="date" name="fromdate" id="fromdate" class="form-control" value="<?php
                                                                                            if (isset($_GET["fromdate"]))
                                                                                                echo $_GET["fromdate"];
                                                                                            ?>">
            <label for="totdate">To:</label>
            <input type="date" name="todate" id="todate" class="form-control" value="<?php
                                                                                        if (isset($_GET["todate"]))
                                                                                            echo $_GET["todate"];
                                                                                        ?>">
        </div>
        <label for="searchkey">Customer_ID:</label>
        <div class="w-50 d-flex">
            <input class="form-control w-50" type="search" name="s" id="searchkey" placeholder="Search" aria-label="Search" value="<?php
                                                                                                                                    if (isset($_GET["s"]))
                                                                                                                                        echo $_GET["s"];
                                                                                                                                    ?>" />

            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
    <table class="table" id="order">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer_ID</th>
                <th>Buy Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        require_once("dbconnect.php");
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
        if (isset($_GET["s"], $_GET["fromdate"], $_GET["todate"])) {
            $fromdate = $_GET["fromdate"];
            $todate = $_GET["todate"];
            $s = $_GET["s"];
            $URL = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $query = "select * from orders where BuyDate BETWEEN '$fromdate' AND '$todate' AND Customer_ID LIKE '%$s%' LIMIT $start_row, $rows_per_page";
        } else
            $query = "Select * from orders LIMIT $start_row, $rows_per_page";
        $result = $dbcon->select($query, $conn);
        while ($row = mysqli_fetch_assoc($result)) {
            print <<<HERE
                <tr>
                <td>$row[ID]</td>
                <td>$row[Customer_ID]</td>
                <td>$row[BuyDate]</td>
                <td>$row[Status]</td>
                <td>
                    <button type="button" id="Orderbtn" onclick="Order_Details('order')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateOrder">
                        Details
                    </button>
                </td>
                </tr>
            HERE;
        }
        ?>
    </table>
    <!-- Details modal start -->
    <div class="modal fade" id="UpdateOrder" tabindex="-1" aria-labelledby="Order_Detail_modal" aria-hidden="true">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Order_Detail_modal">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="Order/Order_Controller.php">
                        <div class="mb-3 row">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="DID" id="DID">
                            <input type="hidden" class="form-control" id="Order_ID" name="Order_ID" readonly>
                            <label for="Customer_ID" class="form-label">Customer_ID</label>
                            <input type="text" class="form-control" id="Customer_ID" name="Customer_ID" readonly>
                            <label for="BuyDate" class="form-label">BuyDate</label>
                            <input type="text" class="form-control" id="BuyDate" name="Buy_Date" readonly>
                            <label for="Status" class="form-label">Status</label>
                            <select name="Status" id="Status" class="form-select">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            <div class="modal-footer">
                                <table class="table" id="Order_Details_tbl">
                                </table>
                                
                                <?php
                                $action_group_ID = $_SESSION['user_group'];
                                if (checkStatus(2, $action_group_ID)) {
                                    echo "<input type='submit' class='btn btn-primary' value='Save'>
                                <a class='btn btn-danger' onclick=\"del('Order')\">Delete</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Details modal end -->

    <?php
    $query = "SELECT COUNT(*) FROM orders";
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