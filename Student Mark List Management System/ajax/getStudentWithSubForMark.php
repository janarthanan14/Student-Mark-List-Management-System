<?php
include "../db/db_connection.php"; // Using database connection file here


if (isset($_POST['courseName'])) {
    $courseName = mysqli_real_escape_string($conn, $_POST['courseName']);
    $semCount = mysqli_real_escape_string($conn, $_POST['semCount']);
    $tempSubjectName = mysqli_real_escape_string($conn, $_POST['tempSubjectName']);
}

$courseName = preg_replace('/\s+/', '', $courseName);

$students_arr = array();
$getStudentInfoForExam = array();

$db = $conn;

$tableName = $courseName."_sem".$semCount."_examReg";

$columnsStudent = ['studentId', 'studentName', 'subjectName'];
$fetchData = fetch_data($db, $tableName, $columnsStudent, $tempSubjectName);

function fetch_data($db, $tableName, $columnsStudent, $tempSubjectName)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columnsStudent) || !is_array($columnsStudent)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {

        $columnName = implode(", ", $columnsStudent);
        $query = "SELECT " . $columnName . " FROM " . $tableName . " WHERE subjectName='" . $tempSubjectName . "' and examAuthz = 'approved';";
        $result = $db->query($query);

        if ($result == true) {
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $msg = $row;
            } else {
                $msg = "No Data Found";
            }
        } else {
            $msg = mysqli_error($db);
        }
    }
    return $msg;
}


if (is_array($fetchData)) {
    krsort($fetchData);
    $sn = 1;
    foreach ($fetchData as $data) {
        $studentId = $data['studentId'];
        $studentName = $data['studentName'];
        $subjectName = $data['subjectName'];
        $students_arr[] = array("studentId" => $studentId, "studentName" => $studentName, "subjectName" => $subjectName);
        $sn++;
    }
    $subCount_arr =  array("studentCount" => $sn);

    $getStudentInfoForExam = array_merge($students_arr, $subCount_arr);
}

echo json_encode($getStudentInfoForExam);