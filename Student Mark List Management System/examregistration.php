<?php $title = "Examregistration"; ?>
<?php include 'header.php' ?>

<?php
include("./db/db_connection.php");

$db = $conn;

$tableName = "courses";

$currentTable = $tableName;
$columns = ['id', 'course', 'noSemester'];
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
?>
<main class="content">
    <div class="container">
        <div class="row d-flex">
            <div class="col-xl-12 col-xxl-9 mg-auto">
                <!--HTML FORM-->
                <form method="post" class="custom-formContainer">

                    <div class="formHeader mb-40">
                        <h3 class="secondaryTitle">Exam Registration</h3>
                        <p class="secondaryPharagraph">Give us some information to Add Exam Candidates Details</p>
                    </div>

                    <div class="formContent">
                        <div class="row mb-24">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Course <span class="text-danger">*</span></label>
                                <select id="examRegCourseLoad" class="form-select" name="course">
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

                            <div class="col-lg-6">

                                <label class="custom-form-lable">Semester <span class="text-danger">*</span></label>
                                <select id="examRegSemLoad" class="form-select" name="semester">
                                    <option disabled selected value="0">Select Semester</option>

                                </select>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-6">

                                <label class="custom-form-lable">Student Name <span class="text-danger">*</span></label>
                                <select id="examRegSnameLoad" class="form-select" name="studentName">
                                    <option disabled selected value="0">Select Name</option>
                                </select>

                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Student ID <span class="text-danger">*</span></label>
                                <select id="examRegSidLoad" class="form-select" name="studentId">
                                    <option disabled selected value="0">Select Id</option>

                                </select>
                            </div>

                        </div>

                        <div id='loadSubTable' class="modal-table-wrapper mb-40">

                        </div>

                        <div class="row mb-24">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Transaction No
                                    <!--span class="text-danger">*</span--></label>
                                <input type="text" class="form-control" name="studentTransNo">
                            </div>

                            <div class="col-lg-6">

                                <label class="custom-form-lable">Date <!--span class="text-danger">*</span--></label>
                                <input type="date" class="form-control" name="studentTransDate">

                            </div>

                        </div>
                    </div>

                    <div class="formFooter d-flex-space-bw">
                        <button type="submit" name="clear" class="btn btn-primary">Clear</button>
                        <button type="button" id="saveExamRegData" name="saveExamRegData" class="btn btn-success">Save</button>
                    </div>
            </div>


            </form>
            <!--HTML FORM-->
        </div>
    </div>

</main>

<?php include 'footer.php' ?>