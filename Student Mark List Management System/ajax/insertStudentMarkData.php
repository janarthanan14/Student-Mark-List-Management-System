<?php
include "../db/db_connection.php"; // Using database connection file here


if (isset($_POST['saveExamRegData'])) {
    $countPlus1Val = mysqli_real_escape_string($conn, $_POST['countPlus1']);
    $courseVal = mysqli_real_escape_string($conn, $_POST['insertDbCourse']);
    $semesterVal = mysqli_real_escape_string($conn, $_POST['insertDbSemeseter']);
    $studentSubNameVal = mysqli_real_escape_string($conn, $_POST['insertDbSubName']);
    $studentIdVal = mysqli_real_escape_string($conn, $_POST['insertDbStudentId']);
    $studentNameVal = mysqli_real_escape_string($conn, $_POST['insertDbStudentName']);
    $insertDbStudentMarkVal = mysqli_real_escape_string($conn, $_POST['insertDbStudentMark']);
}

// $sem_arr = array();

$dbInsert = $conn;

// $tableName = "courses";

$tableName = preg_replace('/\s+/', '', $courseVal);
$studentSubNameVal = preg_replace('/\s+/', '', $studentSubNameVal);

$tableNameInsert = $tableName . "_sem" . $semesterVal . "_" . $studentSubNameVal . "_marks";

if ($countPlus1Val == 1) {
    $sql = "CREATE TABLE `" . $tableNameInsert . "` (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        studentId VARCHAR(30) Null,
        studentName VARCHAR(50) Null,
        subjectName VARCHAR(30) NULL,
        marks VARCHAR(30) NULL
        )";

    $result = mysqli_query($dbInsert, $sql) or die("ERROR: in Add columns" . mysqli_error($dbInsert));
    if (mysqli_query($dbInsert, $sql)) {
        echo ("Database Table Created Successfully!");
    } else {
        echo ("Database Creation Failed :" . mysqli_error($dbInsert));
    }

    extract($_POST);

    function insert_data($dbInsert, $tableNameInsert, $inputData)
    {
        $data = implode(" ", $inputData);
        if (empty($dbInsert)) {
            $msg = "Database connection error";
        } elseif (empty($tableNameInsert)) {
            $msg = "Table Name is empty";
        } elseif (trim($data) == "") {
            $msg = "Empty Data not allowed to insert";
        } else {
            $query  = "INSERT INTO " . $tableNameInsert . " (";
            $query .= implode(",", array_keys($inputData)) . ') VALUES (';
            $query .= "'" . implode("','", array_values($inputData)) . "')";
            $execute = $dbInsert->query($query);
            if ($execute === true) {
                $msg = "Data was inserted successfully.. :)";
            } else {
                $msg = mysqli_error($dbInsert);
            }
            // if ($execute === true) {
            //      $msg = mysqli_error($db);
            // }
            echo $msg;
        }
        return $msg;
    }

    function validate($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }

    $inputData = [
        'studentId'   => validate($studentIdVal) ?? "",
        'studentName'   => validate($studentNameVal) ?? "",
        'subjectName'   => validate($studentSubNameVal) ?? "",
        'marks'   => validate($insertDbStudentMarkVal) ?? "",
    ];

    $result = insert_data($dbInsert, $tableNameInsert, $inputData);
} else {

    extract($_POST);

    function insert_data($dbInsert, $tableNameInsert, $inputData)
    {
        $data = implode(" ", $inputData);
        if (empty($dbInsert)) {
            $msg = "Database connection error";
        } elseif (empty($tableNameInsert)) {
            $msg = "Table Name is empty";
        } elseif (trim($data) == "") {
            $msg = "Empty Data not allowed to insert";
        } else {
            $query  = "INSERT INTO " . $tableNameInsert . " (";
            $query .= implode(",", array_keys($inputData)) . ') VALUES (';
            $query .= "'" . implode("','", array_values($inputData)) . "')";
            $execute = $dbInsert->query($query);
            if ($execute === true) {
                $msg = "Data was inserted successfully.. :)";
            } else {
                $msg = mysqli_error($dbInsert);
            }
            // if ($execute === true) {
            //      $msg = mysqli_error($db);
            // }
            echo $msg;
        }
        return $msg;
    }

    function validate($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }

    $inputData = [
        'studentId'   => validate($studentIdVal) ?? "",
        'studentName'   => validate($studentNameVal) ?? "",
        'subjectName'   => validate($studentSubNameVal) ?? "",
        'marks'   => validate($insertDbStudentMarkVal) ?? "",
    ];

    $result = insert_data($dbInsert, $tableNameInsert, $inputData);
}


// echo json_encode($result);