<?php
session_start();
$permissions = [
  1 => [
    'sanpham' => ['view'],
    'order' => ['view'],
    'users' => ['view', 'add', 'edit', 'delete'],
    'clients' => ['view', 'add', 'edit', 'delete'],
    'brand' => ['view'],
    'category' => ['view'],
    'statistics' => ['view']
  ],
  2 => [
    'sanpham' => ['view', 'add', 'edit', 'delete'],
    'order' => ['view', 'add', 'edit', 'delete'],
    'users' => ['view'],
    'clients' => ['view'],
    'brand' => ['view', 'add', 'edit', 'delete'],
    'category' => ['view', 'add', 'edit', 'delete'],
    'statistics' => ['view', 'add', 'edit', 'delete']
  ]
];
$user_group = $_SESSION['user_group'];
$page = basename($_SERVER['PHP_SELF'], '.php');
if(!isset($user_group)){
  header("Location: ./page/FormLogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/Admin.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <!-- top navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavBar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

              <i class="bi bi-person-fill"></i>

            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="./page/logout.php">Log out</a></li>

            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- top navigation bar -->
  <!-- offcanvas -->
  <div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
    <div class="offcanvas-body p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav">
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3">
              PRODUCT
            </div>
          </li>
          <li>
            <a href="http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=product&sort=ID&ASC=YES" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Product</span>
            </a>
          </li>
          <li>
            <a href="http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=brand" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Brand</span>
            </a>
          </li>
          <li>
            <a href="http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=Category" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Category</span>
            </a>
          </li>
          <li class="my-4">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
              Orders
            </div>
          </li>


          <li>
            <a href="http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=orders" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-receipt"></i></span>
              <span>Orders</span>
            </a>
          </li>
          <li class="my-4">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
              Account Management
            </div>
          </li>
          <li>
            <a href="<?php
                      require_once("dbconnect.php");
                      $action_group_ID = $_SESSION['user_group'];
                      if (checkStatus(3, $action_group_ID)) {
                        echo "http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=users";
                      } else {
                        echo 'http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=403';
                      }
                      ?>" class="nav-link px-3">

              <span class="me-2"><i class="bi bi-person-square"></i></span>
              <span>Users</span>
            </a>
          </li>
          <li>
            <a href="<?php
                      require_once("dbconnect.php");
                      $action_group_ID = $_SESSION['user_group'];
                      if (checkStatus(3, $action_group_ID)) {
                        echo "http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=clients";
                      } else {
                        echo 'http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=403';
                      }
                      ?>" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person-square"></i></span>
              <span>Clients</span>
            </a>
          </li>
          <li>
            <a href="<?php
                      require_once("dbconnect.php");
                      $action_group_ID = $_SESSION['user_group'];
                      if (checkStatus(3, $action_group_ID)) {
                        echo "http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=action";
                      } else {
                        echo 'http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=403';
                      }
                      ?>" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-table"></i></span>
              <span>Acount Action</span>
            </a>
          </li>
          <li class="my-4">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
              Management
            </div>
          </li>
          <li>
            <a href="<?php
                      require_once("dbconnect.php");
                      $action_group_ID = $_SESSION['user_group'];
                      if (checkStatus(4, $action_group_ID)) {
                        echo "http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=statistics";
                      } else {
                        echo 'http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=403';
                      }
                      ?>" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-graph-up"></i></span>
              <span>Statistics</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- offcanvas -->
  <main class="mt-5 p-5">
    <?php
    if (isset($_GET['chon'])) {
      switch ($_GET['chon']) {
        case "product":
          require("product/sanpham_table.php");
          break;
        case "orders":
          require("./Order/order_table.php");
          break;
        case "users":
          require("Account/users_table.php");
          break;
        case "clients":
          require("Account/clients_table.php");
          break;
        case "googleuser":
          require("Account/googleuser_table.php");
          break;
        case "action":
          require("Account/Account_Action_table.php");
          break;
        case "brand":
          require("Brand/Brand_table.php");
          break;
        case "Category":
          require("Category/Category_table.php");
          break;
        case "statistics":
          require("Statistics/statistics.php");
          break;
        case "createUser":
          require("./createUser.php");
          break;
        case "403":
          echo
          "<div class='d-flex justify-content-center'>
            <img src='/img/403.png' width=70%>;
          </div>";
          break;
      }
    } else
      require("product/sanpham_table.php");
    ?>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="./bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
  <script src="./bootstrap-5.0.2-dist/js/Admin.js"></script>
  <script src="./jquery-3.6.4.min.js"></script>
  <script src="./js.js"></script>
</body>

</html>