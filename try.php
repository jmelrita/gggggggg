<?php
include "connection.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $stuID = $_POST["stuID"];
        $starts = date('Y-m-d H:i:s');
        $finished = date('Y-m-d H:i:s', strtotime($starts . ' +1 hour'));

        $score = 0;
        $sql_questions = "SELECT queID, queAns FROM questions";
        $result_questions = $con->query($sql_questions);

        while ($row_question = $result_questions->fetch_assoc()) {
            $queID = $row_question["queID"];
            $selectedAnswer = $_POST[$queID]; // Assuming you have set the 'name' attribute to queID for each radio button

            if ($selectedAnswer == $row_question["queAns"]) {
                $score++;
            }
        }

        // Insert the exam record
        $sql_insert_exam = "INSERT INTO exam(stuID, starts, finished, score) VALUES ('$stuID', '$starts', '$finished', '$score')";
        if ($con->query($sql_insert_exam) === TRUE) {
            echo "Congrats! Your score is: $score";
        } else {
            echo "Error inserting exam record: " . $con->error;
        }
    }
}
else {
    // Automatically set starts and finished for new exams
    $starts = date('Y-m-d H:i:s');
    $finished = date('Y-m-d H:i:s', strtotime($starts . ' +1 hour'));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXAMINATION</title>
</head>
<body>
    <form method="POST">
        <label for="stuID">Name: </label>
        <select name="stuID" id="stuID">
            <?php
            $sql_students = "SELECT * FROM students";
            $result_students = $con->query($sql_students);
            while ($row_student = $result_students->fetch_assoc()) {
                echo "<option value='" . $row_student["stuID"] . "'>" . $row_student["fname"] . " " . $row_student["lname"] . "</option>";
            }
            ?>
        </select>

        <label>Select your answer:</label><br><br>
        <?php
        $sql_questions = "SELECT * FROM questions";
        $result_questions = $con->query($sql_questions);
        while ($row_question = $result_questions->fetch_assoc()) {
            echo "Question: " . $row_question["queMain"] . "<br>";
            echo "<input type='radio' name='" . $row_question["queID"] . "' value='" . $row_question["queOpt1"] . "'>" . $row_question["queOpt1"] . "<br>";
            echo "<input type='radio' name='" . $row_question["queID"] . "' value='" . $row_question["queOpt2"] . "'>" . $row_question["queOpt2"] . "<br>";
        }
        ?>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
<?php
$con->close();
?>