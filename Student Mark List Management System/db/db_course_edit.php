<?php
include "db_connection.php"; // Using database connection file here

$db= $conn;
$tableName="courses";

if(isset($_GET['edit'])){
$id = validate($_GET['edit']);
$condition= ['id' =>$id];
$columns= ['id','course', 'courseCode', 'branch', 'noSemester'];
$editData = edit_data($db, $tableName, $columns, $condition);
}

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

function edit_data($db, $tableName, $columns, $condition){

if(empty($db)){
 $msg= "Database connection error";
}elseif (empty($columns) || !is_array($columns)) {
  $msg="columns Name must be defined in an indexed array";
}elseif (!is_array($condition)) {
  $msg= "Condition data must be an associative array";
}
elseif(empty($tableName)){
  $msg= "Table Name is empty";
}else{
$columnName = implode(", ", $columns);

    $conditionData='';
    $i=0;
    foreach($condition as $index => $data){
        $and = ($i > 0)?' AND ':'';
         $conditionData .= $and.$index." = "."'".$data."'";
         $i++;
    }

$query = "SELECT ".$columnName." FROM $tableName";
$query .= " WHERE ".$conditionData;
$result = $db->query($query);
$row= $result->fetch_assoc();
return $row;

if($row== true){
  
 if ($result->num_rows > 0) {

    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $msg= $row;
    

 } else {
    $msg= "No Data Found";
  
 }

}else{
  $msg= mysqli_error($db);
}
}

return $msg;

}

// update data
extract($_POST);
if(isset($update) && isset($_GET['edit'])){


$inputData = [
  'courseName' => validate($courseName) ?? "",
  'courseCode'   => validate($courseCode) ?? "",
  'branch'   => validate($branch) ?? "",
  'noSemester'   => validate($noSemester) ?? "",
];

$id = validate($_GET['edit']);
$condition= ['id' =>$id];

$result= update_data($db, $tableName, $inputData, $condition);
header("location:../courses.php");
}

function update_data($db, $tableName, $inputData, $condition){

 $data = implode(" ",$inputData);
if(empty($db)){
 $msg= "Database connection error";
}elseif(empty($tableName)){
  $msg= "Table Name is empty";
}elseif(trim( $data ) == ""){
  $msg= "Empty Data not allowed to update";
}elseif(!is_array($inputData) && !is_array($condition)){
  $msg= "Input data & condition must be in array"; 
}else{

// dynamic column & input value
    $cv=0;
    $columnsAndValue='';
    foreach ($inputData as $index => $data) {
      $comma= ($cv>0)?', ':'';
      $columnsAndValue .= $comma.$index." = "."'".$data."'";
    $cv++;
    }
   
// dynamic condition       
    $conditionData='';
    $c=0;
    foreach($condition as $index => $data){
        $and = ($c>0)?', ':'';
        $conditionData .= $and.$index." = "."'".$data."'";
        $c++;
    }

// update query        
    $query   =  "UPDATE ".$tableName;
    $query  .= " SET ".$columnsAndValue;
    $query  .= " WHERE ".$conditionData;

    $execute= $db->query($query);
   
   if($execute=== true){
      $msg= "Data was updated successfully";
  }else{
      $msg= $query;
  }
}
 return $msg;

}

 function validate($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
 }

?>