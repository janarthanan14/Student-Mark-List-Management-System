<?php $title = "Reports"; ?>
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
?>
<main class="content">
    <div class="container">
        <div class="row d-flex">
            <div class="col-xl-12">
                <!--HTML FORM-->
                <form method="post" class="custom-formContainer">

                    <div class="formHeader mb-40">
                        <h3 class="secondaryTitle">All Reports</h3>
                        <p class="secondaryPharagraph">Select Report to get an individual Report Details.</p>
                    </div>

                    <div class="formContent">
                        <div class="row mb-24">

                            <div class="col-lg-3">
                                <select id="loadReportsOptions" class="form-select" name="reports">
                                    <option disabled selected value="0">Select Report</option>
                                    <option value="loadExamCandidates">Exam Candidates Reports</option>
                                    <!-- <option value="loadMarks">Mark List Report</option> -->
                                </select>
                            </div>

                        </div>

                        <div class="loadReportsOptionsWrapper">
                            <div class="courseOptions hide">
                                <div class="row mb-24">

                                    <div class="col-lg-3">
                                        <label class="custom-form-lable">Course <span class="text-danger">*</span></label>
                                        <select id="examRegCourseLoad" class="form-select reportCourseSelect" name="course">
                                            <option disabled selected value="0">Select Course</option>

                                            <?php
                                            if (is_array($fetchData)) {
                                                krsort($fetchData);
                                                $sn = 1;
                                                foreach ($fetchData as $data) {
                                            ?>
                                                    <option value="<?php echo $data['course'] ?? ''; ?>">
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
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-3">

                                        <label class="custom-form-lable">Semester <span class="text-danger">*</span></label>
                                        <select id="examRegSemLoad" class="form-select" name="semester">
                                            <option disabled selected value="0">Select Semester</option>

                                        </select>

                                    </div>

                                    <div class="col-lg-3">

                                        <label class="custom-form-lable">Subject <span class="text-danger">*</span></label>
                                        <select id="examRegSubLoad" class="form-select" name="subject">
                                            <option disabled selected value="0">Select Subject</option>

                                        </select>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id='loadReportsTable' class="modal-table-wrapper">

                        </div>
                    </div>
            </div>


            </form>
            <!--HTML FORM-->
        </div>
    </div>

</main>

<?php include 'footer.php' ?>