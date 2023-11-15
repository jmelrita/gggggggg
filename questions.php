<?php
	include "connection.php";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST["create"])){
			$queMain = $_POST["queMain"];
			$queOpt1 = $_POST["queOpt1"];
			$queOpt2 = $_POST["queOpt2"];
			$queAns = $_POST["queAns"];
			
			if($queAns == "Option 1"){
				$queAns = $queOpt1;
			}elseif($queAns == "Option 2"){
				$queAns = $queOpt2;
			}
			
			$sql = "INSERT INTO questions(queMain, queOpt1, queOpt2, queAns) VALUES('$queMain','$queOpt1','$queOpt2','$queAns')";
			if($con->query($sql) === TRUE){
				echo "";
			}else{
				echo "error" .$con->error;
			}
			
		}
	}
	
	$sql = "SELECT * FROM questions";
	$result = $con->query($sql);

?>
<html>
<head>

</head>
<body>
	<form method="post">
		<label>Question: </label>
		<input type="text" name="queMain"><br><br>
		<label>Option 1: </label>
		<input type="text" name="queOpt1"><br><br>
		<label>Option 2: </label>
		<input type="text" name="queOpt2"><br><br>
		<label>Answer: </label>
		<select name="queAns">
			<option>Option 1</option>
			<option>Option 2</option>
		</select>
		<input type="submit" name="create"><br><br>

		<a href="index.php">back to menu</a>

	</form>
	<?php
		if($result -> num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo "<table><tr>";
				echo "<th> Question: </th>";
				echo "<td>" . $row["queMain"]."</td></tr>";
				echo "<th> Option 1: </th>";
				echo "<td>" . $row["queOpt1"]."</td></tr>";
				echo "<th> Option 2: </th>";
				echo "<td>" . $row["queOpt2"]."</td></tr>";
				echo "<th> Answer: </th>";
				echo "<td>" . $row["queAns"] ."</td></tr>";
				echo "<td><a href='updateQuestions.php?queID=" . $row["queID"] . "'>edit</a></td>";
				echo "<td><a href='deleteQuestions.php?queID=" . $row["queID"] . "'>delete</a></td>";
			}
		}else{
			echo "no questions";
		}
	?>
</body>
</html>
<?php
$con->close();
?>