<?php 
class dbconnect{
    function connect(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $DB = "data_web2";
        // Create connection
        $conn = new mysqli($servername, $username, $password,$DB);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
        // echo "Connected successfully";
    }
    function select($query,$conn){
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function insert($query,$conn){
        if ($query->execute()===True) {
            header("Location:".$_SERVER["HTTP_REFERER"]);
        } else {
           echo "Error: " . $query . "<br>" . $conn->error;
        }
        $conn->close();
    }
    function delete($query,$conn){
        if (mysqli_query($conn, $query)) {
            header("Location:".$_SERVER["HTTP_REFERER"]);
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    
}
function checkStatus($action_ID, $action_group_ID)
{
    //$user_group = $_SESSION['user_group'];

    $dbcon = new dbconnect();
    $conn = $dbcon->connect();
    $query = "Select * from action_table where action_ID = $action_ID  AND action_group_ID = $action_group_ID";

    $result = $dbcon->select($query, $conn);
    $row = mysqli_fetch_assoc($result);
    if ($row['Status'] == 1) {
        //echo 'http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=product&sort=ID&ASC=YES';
        return true;
    } else
        // echo 'http://localhost:8012/web2-new--main/web2-new--main/Admin.php?chon=403';
        return false;
}
 ?>