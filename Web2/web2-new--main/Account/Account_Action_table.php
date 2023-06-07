<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table class="table">

        <?php
        echo " <tr>";
        echo "<thead>";
        $query = "SELECT * FROM action_group where action_group_ID >= 1";
        include_once("./dbconnect.php");
        $dbcon = new dbconnect();
        $conn = $dbcon->connect();
        $result = $dbcon->select($query, $conn);
        echo "<td>Chucnang/Nhom</td>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<td>$row[Name]</td>";
        }
        echo " </tr>";
        echo "</thead>";
        $query = "select * from myaction";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Name'] . "</td>";

            $query2 = "select * from action_table where action_ID=" . $row['action_ID'] . " ORDER by action_group_ID ASC";
            $result2 = mysqli_query($conn, $query2);
            while ($row2 = mysqli_fetch_assoc($result2)) {
                if ($row2['Status'] == 1) {
                    echo " <td><input type='checkbox' checked id='$row[action_ID].$row2[action_group_ID]' onchange='setAction($row[action_ID],$row2[action_group_ID])' ></td>";
                } else {
                    echo " <td><input type='checkbox'  id='$row[action_ID].$row2[action_group_ID]' onchange='setAction($row[action_ID],$row2[action_group_ID])'></td>";
                }
            }
            echo "</tr>";
        }

        ?>
    </table>
    <script src="./js.js"></script>
</body>

</html>