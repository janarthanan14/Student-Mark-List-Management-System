<?php
include "../db/db_connection.php"; // Using database connection file here


if (isset($_POST['totNoSem'])) {
    $totNoSem = mysqli_real_escape_string($conn, $_POST['totNoSem']);
}

$sem_arr = array();

$db = $conn;

$tableName = "courses";

$columns = ['noSemester'];
$fetchData = fetch_data($db, $tableName, $columns, $totNoSem);

function fetch_data($db, $tableName, $columns, $totNoSem)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {

        $columnName = implode(", ", $columns);
        $query = "SELECT " . $columnName . " FROM " . $tableName . " WHERE course='" . $totNoSem . "';";
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
        $noSem = $data['noSemester'];

        $sem_arr[] = array("noSemester" => $noSem);
        $sn++;
    }
}

echo json_encode($sem_arr);