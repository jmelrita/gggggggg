<?php
	include "connection.php";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$queID = $_POST["queID"];
		$queMain = $_POST["queMain"];
		$queOpt1 = $_POST["queOpt1"];
		$queOpt2 = $_POST["queOpt2"];
		$queAns = $_POST["queAns"];
		
		if($queAns == "Option 1"){
				$queAns = $queOpt1;
			}elseif($queAns == "Option 2"){
				$queAns = $queOpt2;
			}
		
		$sql = "UPDATE questions set queMain = '$queMain', queOpt1 = '$queOpt1', queOpt2 = '$queOpt2', queAns = '$queAns' where queID = '$queID'";
        if($con->query($sql)===TRUE){
            header("Location: questions.php");
            exit();
        }else{
            echo "error";
        }
	}
	
	if(isset($_GET["queID"])){
		$queID = $_GET["queID"];
		$sql = "SELECT * FROM questions WHERE queID = '$queID'";
		$result = $con->query($sql);
		
		if($result->num_rows == 1){
			$row = $result->fetch_assoc();
			$queMain = $row["queMain"];
			$queOpt1 = $row["queOpt1"];
			$queOpt2 = $row["queOpt2"];
			$queAns = $row["queAns"];
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
    <input type="hidden" name="queID" value="<?php echo $queID?>"><br><br>
    <input type="text" name="queMain" value="<?php echo $row["queMain"];?>"><br><br>
    <input type="text" name="queOpt1" value="<?php echo $row["queOpt1"];?>"><br><br>
    <input type="text" name="queOpt2" value="<?php echo $row["queOpt2"];?>"><br><br>
	<select name="queAns" value="<?php echo $row["queAns"];?>">
			<option>Option 1</option>
			<option>Option 2</option>
		</select>
    <input type="submit" value="Update"><br><br>
    </form>
</body>
</html>
<?php
$con->close();
?>