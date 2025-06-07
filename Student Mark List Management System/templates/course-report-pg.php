<?php $title = "Course Report"; ?>
<?php include '../db/db_course_fetch.php'; ?>

<?php
$data1 = $viewData['department'] ?? '';
$data2 = $viewData['course'] ?? '';
$data3 = $viewData['courseCode'] ?? '';
$data4 = $viewData['noSemester'] ?? '';
?>

<style>
    
</style>
<?php include("inner_header.php"); ?>

<main class="content">
    <div class="container">
        <div class="row mb-24">
            <div class="col-sm-9 mg-auto">
                <div class="row">
                    <div class="col-sm-12 d-flex">
                        <!--<button class="print-btn btn btn-primary" onclick="printData();">Print this page</button>-->
                        <h3 class="col-sm-6">Course Details</h3>
                        <select class="form-select" aria-label="Default select example" name="department" style="margin-right:20px">
                                    <option selected>Select Department</option>
                                    <option>Computer Science</option>
                                    <option>Visual Communication</option>
                                    <option>Commerce</option>
                                    <option>Bio-Chemistry</option>
                                    <option>Management</option>
                                </select>
                        <select class="form-select" aria-label="Default select example" name="Batch" style="margin-right:20px">
                                    <option selected>Select Batch</option>
                                    <option>2001</option>
                                    <option>2002</option>
                                    <option>2003</option>
                                    <option>2004</option>
                                    <option>2005</option>
                                </select>
                                <a  class="btn btn-success" style="background: #21314b">Go</a>
                    </div>
                </div>

                <div class="modal-table-wrapper modal-table-wrapper-1">
        <table class="modal-table responsive-table">
            <thead class="responsive-table__head">
                <tr class="responsive-table__row responsive-table__row-1">
                    <th class="responsive-table__head__title responsive-table__head__title--1">Course</th>
                    <th class="responsive-table__head__title responsive-table__head__title--2">Batch</th>
                    <th class="responsive-table__head__title responsive-table__head__title--3">Duration</th>
                    <th class="responsive-table__head__title responsive-table__head__title--4">No of Semester</th>
                </tr>
            </thead>
            <tbody>
            <tr class="responsive-table__row responsive-table__row-1">
                    <td class="responsive-table__body__text responsive-table__body__text--1">BCA</td>
                   <td class="responsive-table__body__text responsive-table__body__text--2">2020</td>
                    <td class="responsive-table__body__text responsive-table__body__text--3">3 Years</td>
                    <td class="responsive-table__body__text responsive-table__body__text--4">6 Semesters</td>
                </tr>

                <tr class="responsive-table__row responsive-table__row-1">
                    <td class="responsive-table__body__text responsive-table__body__text--1">BBA</td>
                    <td class="responsive-table__body__text responsive-table__body__text--2">2021</td>
                    <td class="responsive-table__body__text responsive-table__body__text--3">3 Years</td>
                    <td class="responsive-table__body__text responsive-table__body__text--4">5 Semesters</td>
                </tr>

                <tr class="responsive-table__row responsive-table__row-1">
                    <td class="responsive-table__body__text responsive-table__body__text--1">BCOM</td>
                    <td class="responsive-table__body__text responsive-table__body__text--2">2022</td>
                    <td class="responsive-table__body__text responsive-table__body__text--3">2 Years</td>
                    <td class="responsive-table__body__text responsive-table__body__text--4">4 Semesters</td>
                </tr>
            </tbody>
        </table>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            <button type="submit" name="save" class="btn btn-primary" style="background: #21314b; margin-top: 20px" onclick="printData();">Print</button>
        </div>
    </div> 
</div>
</div>
</div>
</main>

</body>

</html>