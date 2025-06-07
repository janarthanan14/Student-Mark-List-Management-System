<?php
include "db_connection.php"; // Using database connection file here

$db= $conn;
$tableName="courses";

if(isset($_GET['view'])){
$id = validate($_GET['view']);
$condition= ['id' =>$id];
$columns= ['id','course', 'courseCode', 'branch', 'noSemester'];
$viewData = view_data($db, $tableName, $columns, $condition);
}

function view_data($db, $tableName, $columns, $condition){

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

 function validate($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
 }

 ?>