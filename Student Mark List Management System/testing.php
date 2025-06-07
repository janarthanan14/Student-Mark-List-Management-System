<?php $title = "Testing"; ?>
<?php include 'header.php' ?>

<?php
include("./db/db_connection.php");

$db = $conn;
$tableName = "users";
$columns = ['id', 'name', 'age'];
$fetchData = fetch_data($db, $tableName, $columns);
sort($fetchData);

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

     <div class="row">
          <div class="col-sm-6">
               <?php echo $deleteMsg ?? ''; ?>
               <div class="table-responsive">
                    <table class="table table-bordered">
                         <thead>
                              <tr>
                                   <th>ID</th>
                                   <th>Name</th>
                                   <th>Age</th>

                         </thead>
                         <tbody>
                              <?php
                              if (is_array($fetchData)) {
                                   $sn = 1;
                                   foreach ($fetchData as $data) {
                              ?>
                                        <tr>
                                             <td><?php echo $sn; ?></td>
                                             <td><?php echo $data['name'] ?? ''; ?></td>
                                             <td><?php echo $data['age'] ?? ''; ?></td>
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
          </div>
     </div>

</main>

<?php include 'footer.php' ?>