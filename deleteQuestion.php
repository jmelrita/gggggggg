<?php
    include "connection.php";

        $queID = $_GET["queID"];

        $sql = "DELETE FROM questions where queID = '$queID'";
        if($con->query($sql)===TRUE){
            header("Location: questions.php");
            exit();
        }
$con->close();
?>