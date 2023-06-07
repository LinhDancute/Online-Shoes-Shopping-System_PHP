<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>

<body>
    <form>
        <form action="index.php" method="post">
        <br>
        <p>input a: <input type="number" name="number1" ></p>
        <p>input b: <input type="number" name="number2" ></p>
        <input type="hidden" name="number" value="sum" >
        <input type="submit" value="Tổng" class="btn-primary btn btn-block" name="btn-sum">
        </form>
    </form>
    <?php 
        function addition(){
            if(isset($_GET["btn-sum"])) {
            $sum = 0;
            $number1 = $_GET["number1"];
            $number2 = $_GET["number2"];
            $sum = $number1 + $number2;
            echo $number1 . " + " . $number2 . " = " .$sum;
            } 
        }
        addition();     
    ?>
</body>

</html>