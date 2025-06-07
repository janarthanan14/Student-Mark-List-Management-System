<?php
include "../db/db_connection.php"; // Using database connection file here


if (isset($_POST['courseName'])) {
    $courseName = mysqli_real_escape_string($conn, $_POST['courseName']);

    $semCount = mysqli_real_escape_string($conn, $_POST['semCount']);
}

$courseName = preg_replace('/\s+/', '', $courseName);

$students_arr = array();

$db = $conn;

$tableName = $courseName."_sem".$semCount."_examReg";
$columns = ['subjectName'];

$fetch_subNameDataForMark = fetch_subNameDataForMark($db, $tableName, $columns);
function fetch_subNameDataForMark($db, $tableName, $columns)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {

        $columnName = implode(", ", $columns);
        $query = "SELECT " . $columnName . " FROM " . $tableName . " limit 1;";
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
$tempSubjectName ="";

if (is_array($fetch_subNameDataForMark)) {
    krsort($fetch_subNameDataForMark);
    $sn = 1;
    foreach ($fetch_subNameDataForMark as $data) {
        $tempSubjectName = $data['subjectName'];
        $sn++;
    }
}




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