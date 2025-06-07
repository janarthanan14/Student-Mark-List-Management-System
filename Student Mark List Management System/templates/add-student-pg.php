<?php $title = "Edit Student Details"; ?>
<?php
include "../db/db_connection.php"; // Using database connection file here

$db = $conn;
$tableName = "courses";
$currentTable = $tableName;
$columns = ['id', 'courseName', 'courseCode', 'branch', 'noSemester'];

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

$branchTable = "branch";
$branchTableColumns = ['branchName'];

$fetchBranchData = fetch_branch_data($db, $branchTable, $branchTableColumns);
function fetch_branch_data($db, $branchTable, $branchTableColumns)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($branchTableColumns) || !is_array($branchTableColumns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($branchTable)) {
        $msg = "Table Name is empty";
    } else {

        $columnName = implode(", ", $branchTableColumns);
        $query = "SELECT " . $columnName . " FROM $branchTable";
        $branchResult = $db->query($query);

        if ($branchResult == true) {
            if ($branchResult->num_rows > 0) {
                $row = mysqli_fetch_all($branchResult, MYSQLI_ASSOC);
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
?>

<?php include("inner_header.php"); ?>



</body>

</html>