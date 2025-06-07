<?php
include "../db/db_connection.php"; // Using database connection file here


if (isset($_POST['subCourseName'])) {
    $subCourseName = mysqli_real_escape_string($conn, $_POST['subCourseName']);
    
    $subSemCount = mysqli_real_escape_string($conn, $_POST['subSemCount']);
}

$subCourseName = preg_replace('/\s+/', '', $subCourseName);

$subTable_arr = array();

// $subCount_arr = array();

$db = $conn;

$tableName = $subCourseName."_sem".$subSemCount."_subjects";

$columns = ['subjectName','subjectCode','subjectType'];
$fetch_subTable_data = fetch_subTable_data($db, $tableName, $columns);

function fetch_subTable_data($db, $tableName, $columns)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {

        $columnName = implode(", ", $columns);
        $query = "SELECT " . $columnName . " FROM $tableName";
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


if (is_array($fetch_subTable_data)) {
    // krsort($fetch_subTable_data);
    $sn = 1;
    foreach ($fetch_subTable_data as $data) {
        $subjectName = $data['subjectName'];
        $subjectCode = $data['subjectCode'];
        $subjectType = $data['subjectType'];

        $subTable_arr[] = array("subjectName" => $subjectName, "subjectCode" => $subjectCode, "subjectType" => $subjectType);
        $sn++;
    }
}

$fetch_subTableCount_data = fetch_subTableCount_data($db, $tableName, $columns);

function fetch_subTableCount_data($db, $tableName, $columns)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {

        $query = "SELECT COUNT(*) FROM $tableName";
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

if (is_array($fetch_subTableCount_data)) {
    // krsort($fetch_subTable_data);
    $sn = 1;
    foreach ($fetch_subTableCount_data as $data) {
        $subCount = $data['COUNT(*)'];
        $sn++;
    }
}

$subCount_arr =  array("subCount" => $subCount);

$getSubForExam = array_merge($subTable_arr, $subCount_arr);

echo json_encode($getSubForExam);