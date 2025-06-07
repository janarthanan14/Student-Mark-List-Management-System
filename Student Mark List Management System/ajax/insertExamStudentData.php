<?php
include "../db/db_connection.php"; // Using database connection file here


if (isset($_POST['saveExamRegData'])) {
    $courseVal = mysqli_real_escape_string($conn, $_POST['insertDbCourse']);
    $semesterVal = mysqli_real_escape_string($conn, $_POST['insertDbSemeseter']);
    $studentNameVal = mysqli_real_escape_string($conn, $_POST['insertDbStudentName']);
    $studentIdVal = mysqli_real_escape_string($conn, $_POST['insertDbStudentId']);
    $studentSubCodeVal = mysqli_real_escape_string($conn, $_POST['insertDbSubCode']);
    $studentSubNameVal = mysqli_real_escape_string($conn, $_POST['insertDbSubName']);
    $studentSubTypeVal = mysqli_real_escape_string($conn, $_POST['insertDbSubType']);
    $examAuthzVal = mysqli_real_escape_string($conn, $_POST['insertDbSubAuthz']);
    $studentTxnVal = mysqli_real_escape_string($conn, $_POST['insertDbTxn']);
    $studentTxnDateVal = mysqli_real_escape_string($conn, $_POST['insertDbTxnDate']);
}

// $sem_arr = array();

$dbInsert = $conn;

// $tableName = "courses";

$tableName = preg_replace('/\s+/', '', $courseVal);

$tableNameInsert = $tableName . "_sem" . $semesterVal . "_examReg";

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

// $inputData = [
//     'course' => validate($courseName) ?? "",
//     'courseCode'   => validate($courseCode) ?? "",
//     'branch'   => validate($branch) ?? "",
//     'noSemester'   => validate($noSemester) ?? "",
// ];

$inputData = [
    'studentId'   => validate($studentIdVal) ?? "",
    'studentName'   => validate($studentNameVal) ?? "",
    'course' => validate($courseVal) ?? "",
    'semester'   => validate($semesterVal) ?? "",
    'subjectCode' => validate($studentSubCodeVal) ?? "",
    'subjectName'   => validate($studentSubNameVal) ?? "",
    'subjectType'   => validate($studentSubTypeVal) ?? "",
    'examAuthz'   => validate($examAuthzVal) ?? "",
    'TransactionNo'   => validate($studentTxnVal) ?? "",
    'TransactionDate'   => validate($studentTxnDateVal) ?? "",
];

$result = insert_data($dbInsert, $tableNameInsert, $inputData);

// echo json_encode($sem_arr);