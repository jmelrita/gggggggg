<?php
    include "connection.php";
	
    $stuID = $_GET["stuID"];
    $sql = "DELETE FROM students where stuID = '$stuID'";
    if($con->query($sql)===TRUE){
		header("Location: index.php");
		exit();
	}
$con->close();
?>