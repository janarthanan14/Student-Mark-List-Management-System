<?php $title = "Students"; ?>
<?php include 'header.php' ?>

<?php
include("./db/db_connection.php");

$db = $conn;

$tableName = "students";

$currentTable = $tableName;
$columns = ['id', 'studentId', 'studentName', 'course', 'batch'];
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Student
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-backdrop fade show custom-backdrop"></div>
            <div class="modal-dialog modal-dialog-scrollable">
                <form method="post" class="modal-content">
                    <div class="modal-header">
                        <div class="model-header-content">
                            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                            <p class="secondaryPharagraph">Give us some information about the new student</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-24">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Student Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Student Name" name="studentName">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Student ID <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Student ID" name="studentId">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Course <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="course">
                                    <option disabled selected value="default">Select Course</option>

                                    <?php
                                    if (is_array($fetchCourseNameData)) {
                                        krsort($fetchCourseNameData);
                                        $sn = 1;
                                        foreach ($fetchCourseNameData as $data) {
                                    ?>
                                            <option>
                                                <?php echo $data['course'] ?? ''; ?>
                                            </option>
                                        <?php
                                            $sn++;
                                        }
                                    } else { ?>
                                        <option>
                                            <?php echo $fetchCourseNameData; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Batch(Year) <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="Default select example" id="studentBatch" name="batch">
                                    <option>2018</option>    
                                    x<option>2019</option>
                                    <option>2020</option>
                                </select>
                            </div>

                        </div>

                    </div>
                    <!-- <div class="modal-body add-sub-wrapper">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="add-sub-header">
                                    <label class="custom-form-lable add-sub-lable">Subject Name <span class="text-danger">*</span></label>
                                    <button type="button" class="btn btn-primary add-sub-btn">Add Subject</button>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Subject Name" value="">
                                </div>
                            </div>

                        </div>

                    </div> -->
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                    <p><?php echo !empty($result) ? $result : ''; ?></p>
                    <?php
                    if (isset($save)) {
                        if (!empty($_POST['studentId']) && !empty($_POST['studentName']) && !empty($_POST['course']) && !empty($_POST['batch'])) {
                            $inputData = [
                                'studentId' => validate($studentId) ?? "",
                                'studentName'   => validate($studentName) ?? "",
                                'course'   => validate($course) ?? "",
                                'batch'   => validate($batch) ?? ""
                            ];

                            $tableNameInsert = $currentTable;
                            $dbInsert = $conn;
                            $result = insert_data($dbInsert, $tableNameInsert, $inputData);
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
        <table id="studentTableList" class="modal-table responsive-table">
            <thead class="responsive-table__head">
                <tr class="responsive-table__row responsive-table__row_col-6">
                    <th class="responsive-table__head__title responsive-table__head__title--1">Student ID</th>
                    <th class="responsive-table__head__title responsive-table__head__title--2">Student Name</th>
                    <th class="responsive-table__head__title responsive-table__head__title--3">course</th>
                    <th class="responsive-table__head__title responsive-table__head__title--4">Batch</th>
                    <!-- <th class="responsive-table__head__title responsive-table__head__title--5">View</th> -->
                    <th class="responsive-table__head__title responsive-table__head__title--6">Edit</th>
                    <th class="responsive-table__head__title responsive-table__head__title--7">Delete</th>

            </thead>
            <tbody class="responsive-table__body">
                <?php
                if (is_array($fetchData)) {
                    krsort($fetchData);
                    $sn = 1;
                    foreach ($fetchData as $data) {
                ?>
                        <tr class="responsive-table__row responsive-table__row_col-6">
                            <td class="responsive-table__body__text responsive-table__body__text--1"><?php echo $data['studentId'] ?? ''; ?></td>
                            <td class="responsive-table__body__text responsive-table__body__text--2"><?php echo $data['studentName'] ?? ''; ?></td>
                            <td class="responsive-table__body__text responsive-table__body__text--3"><?php echo $data['course'] ?? ''; ?></td>
                            <td class="responsive-table__body__text responsive-table__body__text--4"><?php echo $data['batch'] ?? ''; ?></td>
                            <!-- <td class="responsive-table__body__text responsive-table__body__text--5"><a class="btn btn-success" href="./templates/view-student-pg.php?view=<?php echo $data['id']; ?>">Details</a></td> -->
                            <td class="responsive-table__body__text responsive-table__body__text--6"><a href="./templates/edit-student-pg.php?edit=<?php echo $data['id']; ?>" class="btn btn-secondary">Edit</a></td>
                            <td class="responsive-table__body__text responsive-table__body__text--7"><a href="./db/db_student_delete.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a></td>
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
</main>
<?php include 'footer.php' ?>