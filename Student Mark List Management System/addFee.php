<?php $title = "Add Fee Details"; ?>
<?php include 'header.php' ?>

<?php
include("./db/db_connection.php");

$db = $conn;
$tableName = "courses";
$currentTable = $tableName;
$columns = ['id', 'course'];

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


<main class="content">

    <div class="container">
        <div class="row d-flex">
            <div class="col-sm-9 mg-auto">

                <!--=== HTML Form==-->
                <form method="post" class="custom-formContainer">

                    <div class="formHeader mb-40">
                        <h3 class="secondaryTitle">Add Fees Details</h3>
                        <p class="secondaryPharagraph">Give us some information about the Fees details for the Courses</p>
                    </div>

                    <div class="formContent">
                        <div class="row mb-40">
                            <div class="col-lg-4">
                                <label class="custom-form-lable">Course <span class="text-danger">*</span></label>
                                <select class="form-select" name="feeCourseName">
                                    <option disabled selected value="default">Select Course</option>

                                    <?php
                                    if (!isset($addSub)) {
                                        if (is_array($fetchData)) {
                                            krsort($fetchData);
                                            $sn = 1;
                                            foreach ($fetchData as $data) {
                                    ?>
                                                <option>
                                                    <?php echo $data['course'] ?? ''; ?>
                                                </option>
                                            <?php
                                                $sn++;
                                            }
                                        } else { ?>
                                            <option>
                                                <?php echo $fetchData; ?>
                                            </option>
                                        <?php
                                        }
                                    } else { ?>
                                        <option selected="<?php echo $_POST['feeCourseName'] ?? ''; ?>">
                                            <?php echo $_POST['feeCourseName']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="custom-form-lable">Theory(₹) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Enter Theory fee" name="theoryFee">
                            </div>
                            <div class="col-lg-4">
                                <label class="custom-form-lable">Practical(₹) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Enter Practical fee" name="practicalFee">
                            </div>
                            <div class="col-lg-4">
                                <div class="saveFeeWrapper">
                                    <button type="submit" name="clear" class="btn btn-secondary mg-l-auto">Clear</button>
                                    <button type="submit" name="addFeeInfo" class="btn btn-success addSubSaveBtn">Save</button>
                                    <?php
                                    if (isset($_POST['addFeeInfo'])) {
                                        if (!empty($_POST['feeCourseName']) && !empty($_POST['theoryFee']) && !empty($_POST['practicalFee'])) {

                                            $inputData = [
                                                'course' => validate($feeCourseName) ?? "",
                                                'theory'   => validate($theoryFee) ?? "",
                                                'practical'   => validate($practicalFee) ?? ""
                                            ];

                                            $tableNameInsert = 'fee_info';
                                            $dbInsert = $conn;
                                            $result = insert_data($dbInsert, $tableNameInsert, $inputData);
                                            // header("Refresh: 0");
                                            echo "<meta http-equiv='refresh' content='0'>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Please fill in all fields</div>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <!--=== HTML Form=== -->

            </div>
        </div>
    </div>

</main>

<?php include 'footer.php' ?>