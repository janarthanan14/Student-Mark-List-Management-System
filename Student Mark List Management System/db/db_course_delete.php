<?php

include "db_connection.php"; // Using database connection file here

$db = $conn;
$tableName = "courses";

if (isset($_GET['delete'])) {
  $id = validate($_GET['delete']);
  $condition = ['id' => $id];

  $columns = ['course', 'noSemester'];
  $fetchData = fetch_data($db, $tableName, $columns, $id);
  $deleteMsg = delete_data($db, $tableName, $condition);

  header("location:../courses.php");
}
function delete_data($db, $tableName, $condition)
{

  $conditionData = '';
  $i = 0;
  foreach ($condition as $index => $data) {
    $and = ($i > 0) ? ' AND ' : '';
    $conditionData .= $and . $index . " = " . "'" . $data . "'";
    $i++;
  }

  $query = "DELETE FROM " . $tableName . " WHERE " . $conditionData;
  $result = $db->query($query);

  if ($result) {
    $msg = "data was deleted successfully";
  } else {
    $msg = $db->error;
  }
  return $msg;
}

function fetch_data($db, $tableName, $columns, $id)
{
  if (empty($db)) {
    $msg = "Database connection error";
  } elseif (empty($columns) || !is_array($columns)) {
    $msg = "columns Name must be defined in an indexed array";
  } elseif (empty($tableName)) {
    $msg = "Table Name is empty";
  } else {

    $columnName = implode(", ", $columns);
    $query = "SELECT " . $columnName . " FROM " . $tableName . " WHERE id='" . $id . "';";
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
    $courseName = $data['course'];
    $semCount = $data['noSemester'];
    $sn++;
  }

  $totNoSem = $semCount;

  $courseName = preg_replace('/\s+/', '', $courseName);

  $i = 1;
  while ($i <= $totNoSem) {
    $childTableNames = $courseName . "_sem" . $i . "_subjects";

    $sql = "DROP TABLE " . $childTableNames;
    $result = $db->query($sql);
    if ($result) {
      $msg2 = "Table was deleted successfully";
    } else {
      $msg2 = $db->error;
    }
    $i++;
  }
}

function validate($value)
{
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
