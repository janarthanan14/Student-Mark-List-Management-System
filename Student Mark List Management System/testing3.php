<?php $title = "Testing"; ?>
<?php include 'header.php' ?>

<?php
include("./db/db_connection.php");

$nameErr = $genderErr = "";
$name = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['save'])){
     if(!empty($_POST['fullName']) && !empty($_POST['gender'])){
         $fullName = $_POST['fullName'];
         $gender = $_POST['gender'];

         $query = "insert into test2(fullName,gender) values('$fullName', '$gender')";
         $result = mysqli_query($conn, $query);
     //     if($result){
     //         echo "Success";
     //     }
     //     else{
     //         echo "Error";
     //     }
     }
     // else{
     //     echo "<div class='alert alert-danger'>Please fill in all fields</div>";
     // }
}

?>


<main class="content">

     <div class="row">
          <div class="col-sm-4">
               <h3 class="text-primary"> HTML Form to Insert Data</h3>
               <!--=================HTML Form=======================-->
               <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group">
                         <div><input type="text" class="form-control" placeholder="Full Name" name="fullName"><span class="error"><?php echo $nameErr;?></span></div>
                    </div>

                    <div class="form-group">
                         <div class="form-check-inline">
                              <input type="radio" class="form-check-input" name="gender" value="male">Male
                         </div>
                         <div class="form-check-inline">
                              <input type="radio" class="form-check-input" name="gender" value="female">Female
                         </div>
                         <span class="error"><?php echo $genderErr;?></span>
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