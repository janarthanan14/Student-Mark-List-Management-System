<?php $title = "Testing"; ?>
<?php include 'header.php' ?>

<?php
include("./db/db_connection.php");

extract($_POST);

function insert_data($db, $tableName, $inputData)
{
     $data = implode(" ", $inputData);
     if (empty($db)) {
          $msg = "Database connection error";
     } elseif (empty($tableName)) {
          $msg = "Table Name is empty";
     } elseif (trim($data) == "") {
          $msg = "Empty Data not allowed to insert";
     } else {
          $query  = "INSERT INTO " . $tableName . " (";
          $query .= implode(",", array_keys($inputData)) . ') VALUES (';
          $query .= "'" . implode("','", array_values($inputData)) . "')";
          $execute = $db->query($query);
          if ($execute === true) {
               $msg = "Data was inserted successfully.. :)";
          } else {
               $msg = mysqli_error($db);
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


<main class="content">

     <div class="row">
          <div class="col-sm-4">
               <h3 class="text-primary"> HTML Form to Insert Data</h3>
               <p><?php echo !empty($result) ? $result : ''; ?></p>
               <!--=================HTML Form=======================-->

               <?php
               if (isset($save)) {
                    if (!empty($_POST['fullName']) && !empty($_POST['gender'])) {
                         $inputData = [
                              'fullName' => validate($fullName) ?? "",
                              'gender'   => validate($gender) ?? "",
                         ];

                         $tableName = "test2";
                         $db = $conn;
                         $result = insert_data($db, $tableName, $inputData);
                    } else {
                         echo "<div class='alert alert-danger'>Please fill in all fields</div>";
                    }
               }
               ?>

               <form method="post">
                    <div class="form-group">
                         <input type="text" class="form-control" placeholder="Full Name" name="fullName">
                    </div>

                    <div class="form-group">
                         <div class="form-check-inline">
                              <input type="radio" class="form-check-input" name="gender" value="male">Male
                         </div>
                         <div class="form-check-inline">
                              <input type="radio" class="form-check-input" name="gender" value="female">Female
                         </div>
                    </div>

                    <button type="submit" name="save" class="btn btn-primary">Save</button>
               </form>
               <!--======================== HTML Form============================ -->
          </div>
          <div class="col-sm-8">

          </div>
     </div>

</main>

<?php include 'footer.php' ?>