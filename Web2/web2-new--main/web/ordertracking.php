<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <article class="card">
            <header class="card-header"> My Orders / Tracking </header>
            <?php
            require_once('connectDB.php');
            Session_start();
            $userid= $_SESSION['id'];
            $sql="SELECT * FROM orders WHERE Customer_ID= $userid ";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<div class="card-body">
                <h6>Order ID: '.$row['ID'].'</h6>
                <article class="card">
                    <div class="card-body row">
    

                        <div class="col"> <strong>Status:</strong> <br> Picked by the courier </div>
                    </div>
                </article>
                <div class="track">';
                if($row['Status']=='Yes'){
                    echo ' <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>';
                }
                else{
                        echo ' <div class="step active"> <span class="icon"> <i class="fa fa-x"></i> </span> <span class="text">Order is not confirmed</span> </div>';
                }
                   
                    echo'<div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On
                            the
                            way </span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready
                            for
                            pickup</span> </div>
                </div>
                <hr>
                <ul class="row">';
                    $query= "SELECT p.Name,od.size,od.Quantity,p.Img,p.Price*od.Quantity AS 'total'
                    from product p join order_detail od on p.ID = od.Product_ID
                            WHERE od.Order_ID = ".$row['ID']."";
                    $result1 = mysqli_query($conn, $query);

                    while($row1 = mysqli_fetch_assoc($result1)){
                        echo ' <li class="col-md-4">
                        <figure class="itemside mb-3">
                            <div class="aside"><img src="../image/'.$row1["Img"].'" class="img-thumbnail"></div>
                            <figcaption class="info align-self-center">
                                <p class="title">'.$row1["Name"]. '</p> <span
                                    class="text-muted">total :'. $row1["total"] . '$
                                </span>
                                <span class="text-muted">, Quantity :' . $row1["Quantity"] . '
                                </span>
                                <span class="text-muted">, Size :' . $row1["size"] . '
                                </span>
                            </figcaption>
                        </figure>
                    </li>';
                    }
                echo'</ul>
                <hr>
            </div>';
                }
            }
            else{
                echo'You dont have Any Order';
            }
            
            
            
            
            ?>
           
        
        
        </article>
        <a href="../index.php" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to
            orders</a>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>