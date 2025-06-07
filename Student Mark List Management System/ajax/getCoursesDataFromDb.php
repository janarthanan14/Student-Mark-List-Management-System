<?php
include "../db/db_connection.php"; // Using database connection file here


if (isset($_POST['dbTableName'])) {
    $dbTableName = mysqli_real_escape_string($conn, $_POST['dbTableName']);
}

$courses_arr = array();
$getCourseDatas = array();

$db = $conn;

// $tableName = "courses";
$tableName = preg_replace('/\s+/', '', $dbTableName);
$currentTable = $tableName;
$columns = ['id', 'course', 'courseCode', 'branch', 'noSemester'];

$fetchData = fetch_data($db, $tableName, $columns);
function fetch_data($db, $tableName, $columns)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {

        $columnName = implode(", ", $columns);
        $query = "SELECT " . $columnName . " FROM $tableName" . " ORDER BY id DESC";
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
        $courseName = $data['course'];
        $courseCode = $data['courseCode'];
        $branch = $data['branch'];
        $noSemester = $data['noSemester'];
        $courses_arr[] = array("courseId" => $courseId, "courseName" => $courseName, "courseCode" => $courseCode, "branch" => $branch, "noSemester" => $noSemester);
        $sn++;
    }
    $courseCount_arr =  array("courseCount" => $sn);

    $getCourseDatas = array_merge($courses_arr, $courseCount_arr);
}else{
    $getCourseDatas = array("error" => $fetchData);
}



echo json_encode($getCourseDatas);