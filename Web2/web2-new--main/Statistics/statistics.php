<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
</head>

<body>
  <?php
  include_once("./dbconnect.php");
  $dbcon = new dbconnect();
  $conn = $dbcon->connect();

  if (isset($_GET["fromdate"], $_GET["todate"])) {
    $fromdate = $_GET["fromdate"];
    $todate = $_GET["todate"];
  }
  ?>
  <form class="ms-auto my-3 my-lg-0">
    <div class="w-25">
      <input type="hidden" name="chon" value="statistics">
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
    <label for="searchkey">Search by Category:</label>
    <div class="w-25 d-flex my-2">
      <select class="form-select" aria-label="Default select example" id="DCategory" name="Category">
        <?php
        $query = "select * from category";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<option value=" . $row["ID"] . ">" . $row["Name"] . "</option>";
        }
        echo "<option value='all'> ALL </option>";
        ?>
      </select>
      <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i>
      </button>
    </div>
  </form>
  <label for="limit">Search by top sale</label>
  <div class="my-2 w-25 d-flex">
    <br>
    <input type="number" class="form-control" name="limit" id="limit" value=<?php
                                                                            if (isset($_GET['limit']))
                                                                              echo $_GET['limit'];
                                                                            ?>>
    <button class="btn btn-primary mx-0" id="btn-topsale" onclick="findtopsale()"><i class="bi bi-search"></i></button>
  </div>
  <?php
  if (isset($_GET['Category']) || isset($_GET['topsale'])) {
    if (isset($_GET['Category'])) {
      if ($_GET['Category'] == 'all') {
        $sql = "SELECT a.Name,SUM(b.total_quantity*a.Price) as total_price,sum(b.total_quantity)  FROM 
  (SELECT c.Name,p.ID,p.Price FROM category c INNER JOIN product p on c.ID=p.Category_ID ) a LEFT JOIN 
  (SELECT od.Product_ID,SUM(od.Quantity) as total_quantity FROM 
  orders o INNER JOIN order_detail od on o.ID=od.Order_ID GROUP BY od.Product_ID) b on a.ID=b.Product_ID GROUP BY a.Name";
      } else {
        $Category = $_GET['Category'];
        $sql = " SELECT a.Name,(b.total_quantity*a.Price) as total_price,b.total_quantity  FROM 
  (SELECT p.ID,p.Price,p.Name FROM category c INNER JOIN product p on c.ID=p.Category_ID WHERE c.id=$Category) a LEFT JOIN 
  (SELECT od.Product_ID,SUM(od.Quantity) as total_quantity FROM 
  orders o INNER JOIN order_detail od on o.ID=od.Order_ID WHERE BuyDate BETWEEN '$fromdate' AND '$todate' GROUP BY od.Product_ID) b on a.ID=b.Product_ID";
      }
    }
    if (isset($_GET['topsale'])) {
      $limit = $_GET['limit'];

      $sql = "SELECT p.Name,p.Price*o1.qt as total_price FROM product p INNER JOIN
      (SELECT od.Product_ID,SUM(od.Quantity) as qt FROM order_detail od
       INNER JOIN orders o on od.Order_ID = o.ID WHERE o.BuyDate BETWEEN '$fromdate' AND '$todate' GROUP BY od.Product_ID ORDER BY SUM(od.Quantity) DESC LIMIT $limit)
       as o1 on p.ID = o1.Product_ID";
    }

    $result = $dbcon->select($sql, $conn);
    while ($row = mysqli_fetch_assoc($result)) {
      $name[] = $row['Name'];
      $total_price[] = $row['total_price'];
    }
  }
  ?>
  <div>
    <canvas id="myChart"></canvas>
  </div>
   <br>
  <div>
    <span>
      <?php
      if (isset($total_price)){
        $sum = array_sum($total_price);
        echo "The sum is: " . $sum;
      }
      

      ?>
    </span>
  </div> 


  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($name) ?>,
        datasets: [{
          label: 'Total $',
          data: <?php echo json_encode($total_price) ?>,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
  <script src="./js.js">
  </script>
</body>

</html>