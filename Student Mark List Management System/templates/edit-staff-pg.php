<?php $title = "Edit Staff Details"; ?>

<?php
include "../db/db_connection.php"; // Using database connection file here

$db = $conn;
$tableName = "staffs";

if (isset($_GET['edit'])) {
    $id = validate($_GET['edit']);
    $condition = ['id' => $id];
    $columns = ['id', 'staffsName', 'staffsId', 'designation', 'accessLevel'];
    $editData = edit_data($db, $tableName, $columns, $condition);
}

function edit_data($db, $tableName, $columns, $condition)
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

// update data
extract($_POST);
if (isset($update) && isset($_GET['edit'])) {


    $inputData = [
        'staffsId' => validate($staffsId) ?? "",
        'staffsName'   => validate($staffsName) ?? "",
        'designation'   => validate($designation) ?? "",
        'accessLevel'   => validate($accessLevel) ?? ""
    ];

    $id = validate($_GET['edit']);
    $condition = ['id' => $id];

    $result = update_data($db, $tableName, $inputData, $condition);
    header("location:../staffs.php");
}

function update_data($db, $tableName, $inputData, $condition)
{

    $data = implode(" ", $inputData);
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } elseif (trim($data) == "") {
        $msg = "Empty Data not allowed to update";
    } elseif (!is_array($inputData) && !is_array($condition)) {
        $msg = "Input data & condition must be in array";
    } else {

        // dynamic column & input value
        $cv = 0;
        $columnsAndValue = '';
        foreach ($inputData as $index => $data) {
            $comma = ($cv > 0) ? ', ' : '';
            $columnsAndValue .= $comma . $index . " = " . "'" . $data . "'";
            $cv++;
        }

        // dynamic condition       
        $conditionData = '';
        $c = 0;
        foreach ($condition as $index => $data) {
            $and = ($c > 0) ? ', ' : '';
            $conditionData .= $and . $index . " = " . "'" . $data . "'";
            $c++;
        }

        // update query        
        $query   =  "UPDATE " . $tableName;
        $query  .= " SET " . $columnsAndValue;
        $query  .= " WHERE " . $conditionData;

        $execute = $db->query($query);

        if ($execute === true) {
            $msg = "Data was updated successfully";
        } else {
            $msg = $query;
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

<?php include("inner_header.php"); ?>

<main class="content">
    <div class="container">
        <div class="row d-flex">
            <div class="col-sm-9 mg-auto">
                <!--=== HTML Form==-->
                <form method="post" class="modal-content">
                    
                    <p><?php echo !empty($resultEdit) ? $resultEdit : ''; ?></p>
                    <div class="modal-header">
                        <div class="model-header-content">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Staff Details</h5>
                            <!-- <p class="secondaryPharagraph">Give us some information about the new course</p> -->
                        </div>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">

                        <div class="row mb-24">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Staff Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Staff Name" name="staffsName" value="<?php echo $editData['staffsName'] ?? ''; ?>">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Staff ID <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Staff ID" name="staffsId" value="<?php echo $editData['staffsId'] ?? ''; ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row mb-24">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Designation <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="designation" value="<?php echo $editData['designation'] ?? ''; ?>">
                                    <option selected>Select Designation</option>
                                    <option>Tamil teacher</option>
                                    <option>English teacher</option>
                                    <option>Maths teacher</option>
                                    <option>Science teacher</option>
                                    <option>Social teacher</option>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Access Level <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="accessLevel" value="<?php echo $editData['accessLevel'] ?? ''; ?>">
                                    <option selected>Select Access Level</option>
                                    <option>Admin</option>
                                    <option>H.O.D</option>
                                    <option>class teacher</option>
                                    <option>Non-teaching Staff</option>
                                    <option>Visitor</option>
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

                    </div>-->
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" name="<?php echo empty($editData) ? 'save' : 'update'; ?>" class="btn btn-primary">Save</button>
                    </div>
                    <p><?php echo !empty($resultEdit) ? $resultEdit : ''; ?></p>
                </form>
                <!--=== HTML Form=== -->
            </div>
        </div>
    </div>
</main>

</body>

</html>