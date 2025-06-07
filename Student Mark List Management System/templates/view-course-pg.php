<?php $title = "View Course"; ?>
<?php include '../db/db_course_fetch.php'; ?>

<?php
$data1 = $viewData['branch'] ?? '';
$data2 = $viewData['course'] ?? '';
$data3 = $viewData['courseCode'] ?? '';
$data4 = $viewData['noSemester'] ?? '';
?>

<?php include("inner_header.php"); ?>

<main class="content">
    <div class="container">
        <div class="row mb-24">
            <div class="col-sm-9 mg-auto">
                <div class="row">
                    <div class="col-sm-12 d-flex">
                        <button class="print-btn btn btn-primary" onclick="printData();">Print this page</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="printContent" class="container">
        <div class="row">
            <div class="col-sm-9 mg-auto">
                <div class="row mb-24">
                    <div class="col-sm-12">
                        <h3>Course Details :</h3>
                    </div>
                </div>
                <div class="row mb-24">
                    <!-- <div class="col-sm-12">
                <h4><?php echo $course ?> :</h4>
            </div> -->
                    <div class="col-sm-6">
                        <h6>Branch Name: <span><?php echo $data1 ?></span></h6>
                    </div>
                    <div class="col-sm-6">
                        <h6>Course Name: <span><?php echo $data2 ?></span></h6>
                    </div>
                </div>
                <div class="row mb-24">
                    <div class="col-sm-6">
                        <h6>Course Code: <span><?php echo $data3 ?></span></h6>

                    </div>
                    <div class="col-sm-6">
                        <h6>Number of Semesters: <span><?php echo $data4 ?></span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>

</html>