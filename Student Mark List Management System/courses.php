<?php $title = "Courses"; ?>
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
?>

<main class="content modal-table-content">

    <div class="addModalWrapper">
        <!-- Button trigger modal -->
        <!-- <a class="btn btn-success" href="./templates/course-report-pg.php">
            Report
        </a> -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Course
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-backdrop fade show custom-backdrop"></div>
            <div class="modal-dialog modal-dialog-scrollable">

                <form method="post" class="modal-content">
                    <div class="modal-header">
                        <div class="model-header-content">
                            <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
                            <p class="secondaryPharagraph">Give us some information about the new course</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-24">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Course Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Course Name" value="" name="courseName">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Course Code <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Courses Code" value="" name="courseCode">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Branch <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Branch Name" name="branch" list="branchname">
                                <datalist id="branchname">
                                    <?php
                                    if (is_array($fetchBranchData)) {
                                        krsort($fetchBranchData);
                                        $sn = 1;
                                        foreach ($fetchBranchData as $data) {
                                    ?>
                                            <option><?php echo $data['branchName'] ?? ''; ?></option>
                                        <?php
                                            $sn++;
                                        }
                                    } else { ?>
                                        <option><?php echo $fetchBranchData; ?></option>
                                    <?php
                                    } ?>
                                </datalist>
                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Years <span class="text-danger">*</span></label>
                                <select class="form-select" name="noSemester">
                                    <option disabled selected value="default">Select Number of Years</option>
                                    <option value="1">6 Months</option>
                                    <option value="2">1 years</option>
                                    <option value="4">2 years</option>
                                    <option value="6">3 years</option>
                                    <option value="8">4 years</option>
                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                    <p><?php echo !empty($result) ? $result : ''; ?></p>
                    <?php
                    if (isset($save)) {
                        if (!empty($_POST['courseName']) && !empty($_POST['courseCode']) && !empty($_POST['branch']) && !empty($_POST['noSemester'])) {
                            $inputData = [
                                'course' => validate($courseName) ?? "",
                                'courseCode'   => validate($courseCode) ?? "",
                                'branch'   => validate($branch) ?? "",
                                'noSemester'   => validate($noSemester) ?? "",
                            ];

                            $tableNameInsert = $tableName;

                            $result = insert_data($db, $tableNameInsert, $inputData);


                            $viewBranch = $_POST['branch'];
                            $query = "INSERT INTO branch (branchName)
                            VALUES ('$viewBranch')";
                            $execute = mysqli_query($conn, $query);
                            if ($execute === true) {
                                $msg = "Data was inserted successfully";
                            } else {
                                $msg = mysqli_error($conn);
                            }
                            echo $msg;

                            $noSemester = $_POST['noSemester'];
                            $courseName = $_POST['courseName'];
                            $courseName = preg_replace('/\s+/', '', $courseName);

                            $semCounter = 1;

                            while($semCounter <= $noSemester){

                            $sql = "CREATE TABLE `" . $courseName . "_sem".$semCounter."_subjects` (
                                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                subjectName VARCHAR(30) NULL,
                                subjectCode VARCHAR(30) NULL,
                                subjectType VARCHAR(30) NULL,
                                fee VARCHAR(30) NULL
                                )";

                                $result = mysqli_query($conn, $sql)or die("ERROR: in Add columns" . mysqli_error($conn));

                                $semCounter++;
                            }
                            if(mysqli_query($conn, $sql))
                                echo("Database Table Created Successfully");
                            else
                                echo("Database Creation Failed".mysqli_error($conn));

                            // header("Refresh: 0");
                            echo "<meta http-equiv='refresh' content='0'>";
                        } else {
                            echo "<div class='alert alert-danger'>Please fill in all fields</div>";
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-table-wrapper">
        <table class="modal-table responsive-table">
            <thead class="responsive-table__head">
                <tr class="responsive-table__row responsive-table__row_col-6">
                    <th class="responsive-table__head__title responsive-table__head__title--1">Branch</th>
                    <th class="responsive-table__head__title responsive-table__head__title--2">Course Name</th>
                    <th class="responsive-table__head__title responsive-table__head__title--3">Course Code</th>
                    <th class="responsive-table__head__title responsive-table__head__title--4">No of Semester</th>
                    <!-- <th class="responsive-table__head__title responsive-table__head__title--5">View</th> -->
                    <th class="responsive-table__head__title responsive-table__head__title--6">Edit</th>
                    <th class="responsive-table__head__title responsive-table__head__title--7">Delete</th>
                </tr>

            </thead>
            <tbody class="responsive-table__body">
                <?php
                if (is_array($fetchData)) {
                    krsort($fetchData);
                    $sn = 1;
                    foreach ($fetchData as $data) {
                ?>
                        <tr class="responsive-table__row responsive-table__row_col-6">
                            <td class="responsive-table__body__text responsive-table__body__text--1"><?php echo $data['branch'] ?? ''; ?></td>
                            <td class="responsive-table__body__text responsive-table__body__text--2"><?php echo $data['course'] ?? ''; ?></td>
                            <td class="responsive-table__body__text responsive-table__body__text--3"><?php echo $data['courseCode'] ?? ''; ?></td>
                            <td class="responsive-table__body__text responsive-table__body__text--4"><?php echo $data['noSemester'] ?? ''; ?></td>
                            <!-- <td class="responsive-table__body__text responsive-table__body__text--5"><a href="./templates/view-course-pg.php?view=<?php echo $data['id']; ?>" class="btn btn-success">Details</a></td> -->
                            <td class="responsive-table__body__text responsive-table__body__text--6"><a href="./templates/edit-course-pg.php?edit=<?php echo $data['id']; ?>" class="btn btn-secondary">Edit</a></td>
                            <td class="responsive-table__body__text responsive-table__body__text--7"><a href="./db/db_course_delete.php?delete=<?php echo $data['id'];
                                                                                                                                                $currentTable; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php
                        $sn++;
                    }
                } else { ?>
                    <tr class="responsive-table__row">
                        <td class="responsive-table__body__text" colspan="8">
                            <?php echo $fetchData; ?>
                        </td>
                    <tr>
                    <?php
                } ?>
            </tbody>
        </table>
    </div>
</main>

<?php include 'footer.php' ?>