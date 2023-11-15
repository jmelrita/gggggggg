<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["create"])) {
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];

        $sql = "INSERT INTO students(fname, mname, lname) VALUES('$fname', '$mname', '$lname')";

        if ($con->query($sql) === TRUE) {
            echo "";
        } else {
            echo "error";
        }
    }

    if (isset($_POST["search"])) {
        $search_text = $_POST["search_text"];

        $sql = "SELECT * FROM students WHERE fname LIKE '%$search_text%' OR mname LIKE '%$search_text%' OR lname LIKE '%$search_text%'";
        $result = $con->query($sql);
    }
}

$sql_students = "SELECT students.*, exam.starts, exam.finished, exam.score FROM students LEFT JOIN exam ON students.stuID = exam.stuID";
$result_students = $con->query($sql_students);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students</title>
</head>
<style>
    th, td {
        border-bottom: 1px solid black;
        padding: 15px;
    }

    table {
        border: 1px solid black;
    }

    div {
        margin: 0 auto;
        width: 800px;
    }

    nav {
        background-color: red;
        padding: 10px;
        margin: 0;
    }
</style>
<body>
<nav>
    <a href="index.php">Students</a>
    <a href="questions.php">Questionnaire</a>
    <a href="exam.php">Examination</a>
    <form style="float:right;" method="post">
        <input type="text" name="search_text" placeholder="Search...">
        <input type="submit" name="search" value="Search">
    </form>
</nav><br>
<div>
    <form method="post">
        <input type="text" name="fname" placeholder="First Name"><br><br>
        <input type="text" name="mname" placeholder="Middle Name"><br><br>
        <input type="text" name="lname" placeholder="Last Name"><br><br>
        <input type="submit" name="create" value="ADD"><br><br>
    </form>

    <?php
    if ($result_students->num_rows > 0) {
        echo "<table cellspacing=0> <tr>";
        echo "<th> ID </th>";
        echo "<th> Firstname </th>";
        echo "<th> Middlename </th>";
        echo "<th> Lastname </th>";
        echo "<th> Fullname </th>";
        echo "<th> Starts </th>";
        echo "<th> Finished </th>";
        echo "<th> Score </th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";

        while ($row = $result_students->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["stuID"] . "</td>";
            echo "<td>" . $row["fname"] . "</td>";
            echo "<td>" . $row["mname"] . "</td>";
            echo "<td>" . $row["lname"] . "</td>";
            echo "<td>" . $row["fname"] . " " . $row["mname"] . " " . $row["lname"] . "</td>";
            echo "<td>" . $row["starts"] . "</td>";
            echo "<td>" . $row["finished"] . "</td>";
            echo "<td>" . $row["score"] . "</td>";
            echo "<td><a href='update.php?stuID=" . $row["stuID"] . "'>Edit</a></td>";
            echo "<td><a href='delete.php?stuID=" . $row["stuID"] . "'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "No records found";
    }

    ?>
</div>

	<a href="index.php">REFRESH</a>
</body>
</html>

<?php
$con->close();
?>
