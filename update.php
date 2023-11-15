<?php
    include "connection.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $stuID = $_POST["stuID"];
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];

        $sql = "UPDATE students set fname = '$fname', mname = '$mname', lname = '$lname' where stuID = '$stuID'";
        if($con->query($sql)===TRUE){
            header("Location: index.php");
            exit();
        }else{
            echo "error";
        }
    }

    if(isset($_GET["stuID"])){
        $stuID = $_GET["stuID"];
        $sql = "SELECT * FROM students where stuID = '$stuID'";
        $result = $con->query($sql);

        if($result -> num_rows == 1){
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $mname = $row["mname"];
            $lname = $row["lname"];
        }else{
            echo "error";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <form method="POST">
    <input type="hidden" name="stuID" value="<?php echo $stuID?>"><br><br>
    <input type="text" name="fname" value="<?php echo $row["fname"];?>"><br><br>
    <input type="text" name="mname" value="<?php echo $row["mname"];?>"><br><br>
    <input type="text" name="lname" value="<?php echo $row["lname"];?>"><br><br>
    <input type="submit" value="Update"><br><br>
    </form>
</body>
</html>
<?php
$con->close();
?>