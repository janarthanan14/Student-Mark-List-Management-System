<?php $title = "Staff's"; ?>
<?php include 'header.php' ?>

<?php
include("./db/db_connection.php");

$db = $conn;

$tableName = "staffs";

$currentTable = $tableName;
$columns = ['id', 'staffsName', 'staffsId', 'designation', 'accessLevel'];
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

<main class="content modal-table-content">

    <div class="addModalWrapper">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Staff
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-backdrop fade show custom-backdrop"></div>
            <div class="modal-dialog modal-dialog-scrollable">
                <form method="post" class="modal-content">
                    <div class="modal-header">
                        <div class="model-header-content">
                            <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                            <p class="secondaryPharagraph">Give us some information about the new staff</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-24">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Staff Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Staff Name" name="staffsName">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Staff ID <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Staff ID" name="staffsId">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Designation <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="designation">
                                    <option selected>Select Designation</option>
                                    <option >Tamil teacher</option>
                                    <option >English teacher</option>
                                    <option >Maths teacher</option>
                                    <option >Science teacher</option>
                                    <option >Social teacher</option>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Access Level <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="accessLevel">
                                    <option selected>Select Access Level</option>
                                    <option >Admin</option>
                                    <option >H.O.D</option>
                                    <option >class teacher</option>
                                    <option >Non-teaching Staff</option>
                                    <option >Visitor</option>
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
                        if (!empty($_POST['staffsId']) && !empty($_POST['staffsName']) && !empty($_POST['designation']) && !empty($_POST['accessLevel'])) {
                            $inputData = [
                                'staffsId' => validate($staffsId) ?? "",
                                'staffsName'   => validate($staffsName) ?? "",
                                'designation'   => validate($designation) ?? "",
                                'accessLevel'   => validate($accessLevel) ?? ""
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
        <table class="modal-table responsive-table">
            <thead class="responsive-table__head">
                <tr class="responsive-table__row">
                    <th class="responsive-table__head__title responsive-table__head__title--1">Staff ID</th>
                    <th class="responsive-table__head__title responsive-table__head__title--2">Staff Name</th>
                    <th class="responsive-table__head__title responsive-table__head__title--3">Designation</th>
                    <th class="responsive-table__head__title responsive-table__head__title--4">Access Level</th>
                    <th class="responsive-table__head__title responsive-table__head__title--5">View</th>
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
                        <tr class="responsive-table__row">
                            <td class="responsive-table__body__text responsive-table__body__text--1"><?php echo $data['staffsId'] ?? ''; ?></td>
                            <td class="responsive-table__body__text responsive-table__body__text--2"><?php echo $data['staffsName'] ?? ''; ?></td>
                            <td class="responsive-table__body__text responsive-table__body__text--3"><?php echo $data['designation'] ?? ''; ?></td>
                            <td class="responsive-table__body__text responsive-table__body__text--4"><?php echo $data['accessLevel'] ?? ''; ?></td>
                            <td class="responsive-table__body__text responsive-table__body__text--5"><a class="btn btn-success" href="./templates/view-staff-pg.php?view=<?php echo $data['id']; ?>">Details</a></td>
                            <td class="responsive-table__body__text responsive-table__body__text--6"><a href="./templates/edit-staff-pg.php?edit=<?php echo $data['id']; ?>" class="btn btn-secondary">Edit</a></td>
                            <td class="responsive-table__body__text responsive-table__body__text--7"><a href="./db/db_staff_delete.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a></td>
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