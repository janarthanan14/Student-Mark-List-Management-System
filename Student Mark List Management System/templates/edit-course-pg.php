<?php $title = "Edit Course"; ?>
<?php include("../db/db_course_edit.php"); ?>

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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Course Details</h5>
                        </div>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-24">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Course Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Course Name" name="courseName" value="<?php echo $editData['course'] ?? ''; ?>">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Course Code <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Courses Code" name="courseCode" value="<?php echo $editData['courseCode'] ?? ''; ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row mb-24">

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Branch <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" placeholder="Enter branch" name="branch" list="branchname" value="<?php echo $editData['branch'] ?? ''; ?>">
                                <datalist id="branchname">
                                    <?php
                                    if (is_array($fetchData)) {
                                        krsort($fetchData);
                                        $sn = 1;
                                        foreach ($fetchData as $data) {
                                    ?>
                                            <option><?php echo $data['branch'] ?? ''; ?></option>
                                        <?php
                                            $sn++;
                                        }
                                    } else { ?>
                                        <option><?php echo $fetchData; ?></option>
                                    <?php
                                    } ?>
                                </datalist>
                            </div>

                            <div class="col-lg-6">
                                <label class="custom-form-lable">Years <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="noSemester">
                                    <option selected>Select Number of Years</option>
                                    <option>6 Months</option>
                                    <option>1 years</option>
                                    <option>2 years</option>
                                    <option>3 years</option>
                                    <option>4 years</option>
                                </select>
                            </div>

                        </div>

                    </div>
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