<?php $title = "Subjects"; ?>
<?php include 'header.php' ?>

<?php
include("./db/db_connection.php");

$db = $conn;
$tableName = "courses";
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
        $query = "INSERT INTO " . $tableNameInsert . " (";
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
                <form method="post" class="custom-form-container">

                    <div class="formHeader mb-40">
                        <h3 class="secondaryTitle">Add Subject</h3>
                        <p class="secondaryPharagraph">Give us some information about the new Subject Details</p>
                    </div>

                    <div class="formContent">
                        <div class="row mb-40">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Course <span class="text-danger">*</span></label>
                                <select class="form-select" name="subCourseName">
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
                                        <option selected="<?php echo $_POST['subCourseName'] ?? ''; ?>">
                                            <?php echo $_POST['subCourseName']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-6 mb-24">

                                <label class="custom-form-lable">Semesters <span class="text-danger">*</span></label>
                                <select class="form-select" name="subNoSemester">
                                    <option disabled selected value="default">Select Number of Semesters</option>
                                    <?php if (!isset($addSub)) { ?>
                                        <option>2 Semsters</option>
                                        <option>4 Semsters</option>
                                        <option>6 Semsters</option>
                                        <option>8 Semsters</option>
                                    <?php

                                    } else { ?>
                                        <option selected="<?php echo $_POST['subNoSemester'] ?? ''; ?>">
                                            <?php echo $_POST['subNoSemester']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>

                            </div>

                            <div class="col-lg-12 d-flex">
                                
                                <button type="submit" name="addSub" class="btn btn-success mg-l-auto">Go</button>
                            </div>

                        </div>

                        <div class="row">
                            <?php
                            if (isset($addSub)) {
                                if (!empty($_POST['subCourseName']) && !empty($_POST['subNoSemester'])) {
                                    $addSubNoSemester = $_POST['subNoSemester'];

                                    $i = 1;
                                    $semCounter = 1;

                                    while ($i <= $addSubNoSemester) { ?>

                                        <div class="col-lg-6 mb-40">
                                            <div class="dynamic_field_controle">
                                                <label class="custom-form-lable">Semester <?php echo $semCounter; ?><span class="text-danger"> *</span></label>
                                                <button type="button" class="btn btn-primary addSubBtn" id="addSub<?php echo $semCounter; ?>">Add</button>
                                                <a class="btn btn-danger removeSubBtn btn_remove<?php echo $semCounter; ?>" id="8<?php echo $semCounter; ?>">remove</a>
                                            </div>
                                            <div id="dynamic_field<?php echo $semCounter; ?>">
                                                <div id="addSem1Sub<?php echo $semCounter; ?>" class="subjectFieldWrapper mb-24">
                                                    <input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject 1 Name" name="subName<?php echo $semCounter; ?>[]">
                                                    <input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject 1 Code" name="subCode<?php echo $semCounter; ?>[]">
                                                    <select class="form-select" name="subType<?php echo $semCounter; ?>[]">
                                                        <option disabled selected value="default">Select Subject 1 Type</option>
                                                        <option>Theory</option>
                                                        <option>Practical</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <?php $semCounter++; ?>
                            <?php $i++;
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Please fill in all fields</div>";
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="formFooter">
                        <button type="submit" name="clear" class="btn btn-secondary mg-l-auto">Clear</button>
                        <button type="submit" name="addSubSave" class="btn btn-success addSubSaveBtn">Save</button>
                        <?php
                        if (isset($addSubSave)) {
                            if (!empty($_POST['subCourseName']) && !empty($_POST['subNoSemester'])) {

                                $subTableNameInsert = $_POST['subCourseName'];
                                $subTableNameInsert = preg_replace('/\s+/', '', $subTableNameInsert);

                                $subSemCount = $_POST['subNoSemester'];
                                $subSemCount = filter_var($subSemCount, FILTER_SANITIZE_NUMBER_INT);

                                $subExecuteCount = 1;


                                while ($subExecuteCount <= $subSemCount) {

                                    // Counting No fo inputs
                                    $subNameCount = count($_POST["subName$subExecuteCount"]);

                                    //Getting post values
                                    $subName = $_POST["subName$subExecuteCount"];
                                    $subCode = $_POST["subCode$subExecuteCount"];
                                    $subType = $_POST["subType$subExecuteCount"];

                                    if ($subNameCount > 1) {

                                        for ($i = 0; $i < $subNameCount; $i++) {

                                            if (trim($_POST["subName$subExecuteCount"][$i] != '' && $_POST["subCode$subExecuteCount"][$i] != '' && $_POST["subType$subExecuteCount"][$i] != '')) {
                                                $sql = mysqli_query($conn, "INSERT INTO " . $subTableNameInsert . "_sem" . $subExecuteCount . "_subjects(subjectName,subjectCode,subjectType) VALUES('$subName[$i]','$subCode[$i]','$subType[$i]')");
                                            }
                                        }
                                    } else {
                                        echo "<script>alert('Please enter all data properly');</script>";
                                    }
                                    $subExecuteCount++;
                                }

                                $semCounter = 1;
                                $courseName = $subTableNameInsert;
                                $noSemester = $subSemCount;

                                while ($semCounter <= $noSemester) {

                                    $sql = "CREATE TABLE `" . $courseName . "_sem" . $semCounter . "_examReg` (
                                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    studentId VARCHAR(30) Null,
                                    studentName VARCHAR(50) Null,
                                    course VARCHAR(30) NULL,
                                    semester VARCHAR(30) NULL,
                                    subjectCode VARCHAR(30) NULL,
                                    subjectName VARCHAR(30) NULL,
                                    subjectType VARCHAR(30) NULL,
                                    examAuthz VARCHAR(30) NULL,
                                    TransactionNo VARCHAR(30) NULL,
                                    TransactionDate VARCHAR(30) NULL
                                    )";

                                    $result = mysqli_query($conn, $sql) or die("ERROR: in Add columns" . mysqli_error($conn));

                                    $semCounter++;
                                }
                                if (mysqli_query($conn, $sql))
                                    echo ("Database Table Created Successfully");
                                else
                                    echo ("Database Creation Failed" . mysqli_error($conn));

                                echo "<meta http-equiv='refresh' content='0'>";
                            } else {
                                echo "<div class='alert alert-danger'>Please fill in all fields</div>";
                            }
                        }
                        ?>
                    </div>

                </form>
                <!--=== HTML Form=== -->

            </div>
        </div>
    </div>
</main>


<?php include 'footer.php' ?>