<?php $title = "View Staff Details"; ?>
<?php
include "../db/db_connection.php"; // Using database connection file here

$db = $conn;
$tableName = "staffs";

if (isset($_GET['view'])) {
    $id = validate($_GET['view']);
    $condition = ['id' => $id];
    $columns = ['id', 'staffsName', 'staffsId', 'designation', 'accessLevel'];
    $viewData = view_data($db, $tableName, $columns, $condition);
}

function view_data($db, $tableName, $columns, $condition)
{

    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (!is_array($condition)) {
        $msg = "Condition data must be an associative array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $columnName = implode(", ", $columns);

        $conditionData = '';
        $i = 0;
        foreach ($condition as $index => $data) {
            $and = ($i > 0) ? ' AND ' : '';
            $conditionData .= $and . $index . " = " . "'" . $data . "'";
            $i++;
        }

        $query = "SELECT " . $columnName . " FROM $tableName";
        $query .= " WHERE " . $conditionData;
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        return $row;

        if ($row == true) {

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

function validate($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

?>

<?php
$staffsName = $viewData['staffsName'] ?? '';
$staffsId = $viewData['staffsId'] ?? '';
$designation = $viewData['designation'] ?? '';
$accessLevel = $viewData['accessLevel'] ?? '';
?>

<?php include("inner_header.php"); ?>

<main class="content">
    <div class="container">
        <div class="row mb-24">
            <div class="col-sm-9 mg-auto">
                <div class="row">
                    <div class="col-sm-12 d-flex">
                        <button class="print-btn btn btn-primary" onclick="printData();">Print this page</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="printContent" class="container">
        <div class="row">
            <div class="col-sm-9 mg-auto">
                <div class="row mb-24">
                    <div class="col-sm-12">
                        <h3>Course Details :</h3>
                    </div>
                </div>
                <div class="row mb-24">
                    <div class="col-sm-6">
                        <h6>Staff Name: <span><?php echo $staffsName ?></span></h6>
                    </div>
                    <div class="col-sm-6">
                        <h6>Staff ID: <span><?php echo $staffsId ?></span></h6>
                    </div>
                </div>
                <div class="row mb-24">
                    <div class="col-sm-6">
                        <h6>Designation: <span><?php echo $designation ?></span></h6>

                    </div>
                    <div class="col-sm-6">
                        <h6>Access Level: <span><?php echo $accessLevel ?></span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>

</html>