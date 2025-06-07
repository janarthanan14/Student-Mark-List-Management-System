<?php $title = "External Mark Entry"; ?>
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

$db = $conn;

$tableName = "students";

$currentTable = $tableName;
$columns = ['id', 'studentId', 'studentName', 'course', 'batch'];
$fetchData_one = fetch_data_one($db, $tableName, $columns);

function fetch_data_one($db, $tableName, $columns)
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

$courseNameTable = "courses";
$courseNameTableColumns = ['course'];

$fetchCourseNameData = fetch_course_name($db, $courseNameTable, $courseNameTableColumns);
function fetch_course_name($db, $courseNameTable, $courseNameTableColumns)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($courseNameTableColumns) || !is_array($courseNameTableColumns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($courseNameTable)) {
        $msg = "Table Name is empty";
    } else {

        $columnName = implode(", ", $courseNameTableColumns);
        $query = "SELECT " . $columnName . " FROM $courseNameTable";
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

function insert_data_one($dbInsert, $tableNameInsert, $inputData)
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

function validate_one($value)
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
                <!--HTML FORM-->
                <form method="post" class="form-class">
                    <div>
                        <div class="formHeader mb-40">
                            <h3 class="secondaryTitle">External Mark Entry</h3>
                            <p class="secondaryPharagraph">Enter some information about the Internal Marks</p>
                        </div>
                    </div>

                    <div class="row mb-24">

                        <div class="col-lg-6">
                            <label class="custom-form-lable">Branch <span class="text-danger">*</span></label>
                            <select class="form-select" name="branch">
                                <option disabled selected value="default">Select Branch</option>

                                <?php
                                if (!isset($addSub)) {
                                    if (is_array($fetchData)) {
                                        krsort($fetchData);
                                        $sn = 1;
                                        foreach ($fetchData as $data) {
                                            ?>
                                            <option>
                                                <?php echo $data['branch'] ?? ''; ?>
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

                        <div class="col-lg-6">

                            <label class="custom-form-lable">Course Name <span class="text-danger">*</span></label>
                            <select class="form-select" name="courseName">
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
                                    <option selected="<?php echo $_POST['subNoSemester'] ?? ''; ?>">
                                        <?php echo $_POST['subNoSemester']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>

                        </div>

                    </div>

                    <div class="row mb-24">

                        <div class="col-lg-6">
                            <label class="custom-form-lable">Year <span class="text-danger">*</span></label>
                            <select class="form-select" name="batch">
                                <option disabled selected value="default">Select Year</option>

                                <?php
                                if (!isset($addSub)) {
                                    if (is_array($fetchData_one)) {
                                        krsort($fetchData_one);
                                        $sn = 1;
                                        foreach ($fetchData_one as $data) {
                                            ?>
                                            <option>
                                                <?php echo $data['batch'] ?? ''; ?>
                                            </option>
                                            <?php
                                            $sn++;
                                        }
                                    } else { ?>
                                        <option>
                                            <?php echo $fetchData_one; ?>
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

                        <div class="col-lg-6">

                            <label class="custom-form-lable">Semester <span class="text-danger">*</span></label>
                            <select class="form-select" name="subNoSemester">
                                <option disabled selected value="default">Select Semester</option>
                                <?php
                                if (!isset($addSub)) {
                                    if (is_array($fetchData)) {
                                        krsort($fetchData);
                                        $sn = 1;
                                        foreach ($fetchData as $data) {
                                            ?>
                                            <option>
                                                <?php echo $data['noSemester'] ?? ''; ?> Semester
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
                                    <option selected="<?php echo $_POST['subNoSemester'] ?? ''; ?>">
                                        <?php echo $_POST['subNoSemester']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>

                        </div>

                    </div>

                    <div class="row mb-40">

                        <div class="col-lg-6">
                            <label class="custom-form-lable">Subject <span class="text-danger">*</span></label>
                            <select class="form-select" name="subjectName">
                                <option disabled selected value="default">Select Subject</option>

                                <?php
                                if (!isset($addSub)) {
                                    if (is_array($fetchData)) {
                                        krsort($fetchData);
                                        $sn = 1;
                                        foreach ($fetchData as $data) {
                                            ?>
                                            <option>
                                                <?php echo $data['subjectName'] ?? ''; ?>
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

                        <div class="col-lg-6">

                            <label class="custom-form-lable">Type <span class="text-danger">*</span></label>
                            <select class="form-select" name="type">
                                <option disabled selected value="default">Select Type</option>
                                <?php
                                if (!isset($addSub)) {
                                    if (is_array($fetchData)) {
                                        krsort($fetchData);
                                        $sn = 1;
                                        foreach ($fetchData as $data) {
                                            ?>
                                            <option>
                                                <?php echo $data['subType'] ?? ''; ?> Semester
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
                                    <option selected="<?php echo $_POST['subNoSemester'] ?? ''; ?>">
                                        <?php echo $_POST['subNoSemester']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>

                        </div>
                    </div>

                    <div class="row mb-24">
                        <div class="table-wrapper mb-40">
                            <table class="modal-table responsive-table">
                                <thead class="responsive-table__head_one">
                                    <tr class="responsive-table__row_one">
                                        <th class="responsive-table__head__title responsive-table__head__title--1">S No
                                        </th>
                                        <th class="responsive-table__head__title responsive-table__head__title--2">
                                            Register
                                            Number</th>
                                        <th class="responsive-table__head__title responsive-table__head__title--3">
                                            Student
                                            Name</th>
                                        <th class="responsive-table__head__title responsive-table__head__title--4">
                                            Mark Scored
                                        </th>
                                        <th class="responsive-table__head__title responsive-table__head__title--5">
                                            Total Marks</th>

                                </thead>
                                <tbody class="responsive-table__body_one">
                                    <?php
                                    if (is_array($fetchData_one)) {
                                        krsort($fetchData_one);
                                        $sn = 1;
                                        foreach ($fetchData_one as $data) {
                                            ?>
                                            <tr class="responsive-table__row_one">
                                                <td class="responsive-table__body__text responsive-table__body__text--1">
                                                    <?php echo $data['id'] ?? ''; ?>
                                                </td>
                                                <td class="responsive-table__body__text responsive-table__body__text--2">
                                                    <?php echo $data['studentId'] ?? ''; ?>
                                                </td>
                                                <td class="responsive-table__body__text responsive-table__body__text--3">
                                                    <?php echo $data['studentName'] ?? ''; ?>
                                                </td>
                                                <td class="responsive-table__body__text responsive-table__body__text--4">
                                                    <div class="form-check">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </td>
                                                <td class="responsive-table__body__text responsive-table__body__text--5">
                                                    <div class="form-check">
                                                        <select type="text" class="form-select">
                                                            <option value="">
                                                                Select No
                                                            </option>
                                                            <option value="">
                                                                25
                                                            </option>
                                                            <option value="">
                                                                10
                                                            </option>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            $sn++;
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="8">
                                                <?php echo $fetchData; ?>
                                            </td>
                                        <tr>
                                            <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12 d-flex">
                            <button type="reset" name="clear" class="btn btn-primary mb-40" value="reset">Clear</button>
                            <button type="submit" name="save" class="btn btn-success mb-40 combtn">Submit</button>
                        </div>

                    </div>



            </div>


        </div>


        </form>
        <!--HTML FORM-->
    </div>
    </div>

</main>

<?php include 'footer.php' ?>