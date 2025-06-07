<?php
include "../db/db_connection.php"; // Using database connection file here


if (isset($_POST['courseName'])) {
    $courseName = mysqli_real_escape_string($conn, $_POST['courseName']);
    $semCount = mysqli_real_escape_string($conn, $_POST['semCount']);
}

$courses_arr = array();
$courseCount_arr = array();
$getCourseDatas = array();

$db = $conn;

$courseName = preg_replace('/\s+/', '', $courseName);




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




$tempSubjectName = preg_replace('/\s+/', '', $tempSubjectName);
// $tableName = "courses";


$tableName = $courseName."_sem".$semCount."_examReg";

$columns = ['id', 'studentId', 'studentName', 'course', 'semester','subjectCode','subjectName','subjectType','examAuthz','TransactionNo','TransactionDate' ];

$fetchData = fetch_data($db, $tableName, $columns, $tempSubjectName);
function fetch_data($db, $tableName, $columns, $tempSubjectName)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {

        $columnName = implode(", ", $columns);
        $query = "SELECT " . $columnName . " FROM " . $tableName . " WHERE subjectName='" . $tempSubjectName . "';";
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
        $courseId = $data['id'];
        $studentId = $data['studentId'];
        $studentName = $data['studentName'];
        $course = $data['course'];
        $semester = $data['semester'];
        $subjectCode = $data['subjectCode'];
        $subjectName = $data['subjectName'];
        $subjectType = $data['subjectType'];
        $examAuthz = $data['examAuthz'];
        $TransactionNo = $data['TransactionNo'];
        $TransactionDate = $data['TransactionDate'];
        $courses_arr[] = array("courseId" => $courseId, "studentId" => $studentId, "studentName" => $studentName, "course" => $course, "semester" => $semester, "subjectCode" => $subjectCode,"subjectName" => $subjectName,"subjectType" => $subjectType,"examAuthz" => $examAuthz,"TransactionNo" => $TransactionNo,"TransactionDate" => $TransactionDate );
        $sn++;
    }
    $courseCount_arr =  array("courseCount" => $sn);

    $getCourseDatas = array_merge($courses_arr, $courseCount_arr);
}else{
    $getCourseDatas = array("error" => $fetchData);
}



echo json_encode($getCourseDatas);