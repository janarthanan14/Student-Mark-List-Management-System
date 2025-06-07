<?php $title = "View Student Details"; ?>
<?php
include "../db/db_connection.php"; // Using database connection file here

$db = $conn;
$tableName = "students";

if (isset($_GET['view'])) {
    $id = validate($_GET['view']);
    $condition = ['id' => $id];
    $columns = ['id', 'studentId', 'studentName', 'course', 'batch'];
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
$data1 = $viewData['studentName'] ?? '';
$data2 = $viewData['studentId'] ?? '';
$data3 = $viewData['course'] ?? '';
$data4 = $viewData['batch'] ?? '';
?>

<?php include("inner_header.php"); ?>

<main class="content">
    <div class="conatiner">
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
                        <h6>Student Name: <span><?php echo $data1 ?></span></h6>
                    </div>
                    <div class="col-sm-6">
                        <h6>Student ID: <span><?php echo $data2 ?></span></h6>
                    </div>
                </div>
                <div class="row mb-24">
                    <div class="col-sm-6">
                        <h6>branch: <span><?php echo $data3 ?></span></h6>

                    </div>
                    <div class="col-sm-6">
                        <h6>Batch(Year): <span><?php echo $data4 ?></span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>

</html>