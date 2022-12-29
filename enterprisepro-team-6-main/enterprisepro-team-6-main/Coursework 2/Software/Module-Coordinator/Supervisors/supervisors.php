<!-- Module Coordinator - View Supervisors Page -->
<!-- Used by Module Coordinators to view all supervisors and add, update or delete supervisors -->


<?php include('supervisors-crud.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>View Supervisors - Final Year Project Allocation System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

/* Body CSS */
body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Header CSS */
.header {
  background: #004C6D;
  text-align: center;
  padding: 75px;
  color: white;
}

/* Increase Title font size */
.header h1 {
  font-size: 40px;
}

/* Navigation bar CSS */
.navbar {
  background-color: #007BAF;
  overflow: hidden;
}

/* Navigation bar links */
.navbar a {
  display: block;
  padding: 14px 20px;
  color: black;
  float: left;
  text-align: center;
  text-decoration: none;
  position: relative;
  left: 500px;
}

/* Change Navigation bar links on hover */
.navbar a:hover {
  background-color: #00A4E5;
  color: black;
}

/* Main body CSS */
.main {   
  padding: 20px;
}

/* When screen is less than 400px wide, navbar links adjust*/
@media screen and (max-width: 400px) {
  .navbar a {
    width:100%;
    float: none;
  }
}

/* Alert message when adding/updating/deleting records CSS */
.msg {
  padding: 10px;
  background-color: #63D35B;
  text-align: center;
  color: black;
  border: 2px solid black;
  border-color: #33632B;
  width: 35%;
  margin: 30px auto;
  border-radius: 10px;
}

/* Database Table CSS */
table, td, th {
  border: 1.2px solid black;
  padding: 5px;
}

/* Database Table CSS */
table{
  border-collapse: collapse;
  width: 75%;
}

/* Database Table Headers CSS */
th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #008EC6;
  color: black;
}

/* Change colour of table rows when hovered over */
tr:nth-child(even) {background-color: #E8E8E8}
tr:hover {background-color: #CCCCCC}

/* Database Table Data CSS */
td {
  text-align: center;
}

/* Update Button CSS */
.update-btn {
  background: #00A2D3;
  color: black;
  padding: 2px;
  margin: 8px;
  border-radius: 2px;
  transition-duration: 0.4s;
}

/* Change colour of Update button when hovered over */
.update-btn:hover {
  background-color: #00C7FF;
}

/* Delete Button CSS */
.delete-btn {
  background: #EA0000;
  color: black;
  padding: 2px;
  margin: 8px;
  border-radius: 2px;
  transition-duration: 0.4s;
}

/* Change colour of Delete button when hovered over */
.delete-btn:hover {
  background-color: #FF0000;
}

/* 'Add New Supervisor' & 'Update Supervisor Records' Form */
.form {
  border: 2px solid black;
  width: 1130px;
  height:120px;
  background: #E8E8E8;
  border-radius: 10px;
  padding: 10px;
  display: flex;
  align-items: center;
}

/* Form Header CSS */
.form-header {
  text-align: center;
  position: relative;
  top: -53px;
  display: inline-block;
  white-space: nowrap;
}

/* Form Text Input CSS */
.form-input {
  padding: 12px;
  text-align: left;
  position: relative;
  left: -225px;
  margin-top: 10px;
}

/* Form 'Add Supervisor'/'Update Record' Button CSS */
.form-btn {
  border-radius: 8px;
  background: #0082B2;
  border: none;
  cursor: pointer;
  font-size: 14px;
  padding: 10px;
  transition-duration: 0.4s;
}

/* Change colour of 'Add Supervisor'/'Update Record' Button CSS */
.form-btn:hover {
  background-color: #00A9ED;
}

/* Search Bar CSS */
.search-bar {
  width: 100%;
  position: relative;
 
}

/* 'Search Table' CSS */
.search-button {
  border-color: #0082B2;
  border: 1px solid black;
  border-radius: 5px;
  padding: 7px;
  background: #00A8E5;
  cursor: pointer;
  transition-duration: 0.4s;
}

/* Change colour of 'Search Table' button when hovered over */
.search-button:hover {
  background-color: #00B6FF;
}

</style>
</head>
<body>

<!-- Page Title and subtitle -->
<div class="header">
  <h1>Final Year Project Allocation System</h1>
  <p>By Team Horizon</p>
</div>

<!-- Navigation bar Links -->
<div class="navbar">
  <a href="http://localhost/enterprisepro/module-coordinator/students/students.php">Students</a>
  <a href="http://localhost/enterprisepro/module-coordinator/supervisors/supervisors.php">Supervisors</a>
  <a href="http://localhost/enterprisepro/module-coordinator/projects/projects.php">Projects</a>
  <a href="http://localhost/enterprisepro/login/login.php">Logout</a>
</div>

<!-- Main Body -->
  <div class="main">
    <h2>Supervisors</h2>
    <p> On this page, you can view all supervisor records
         and add, update or delete records </p>
    <br>

<!-- Message displayed when records added, updated or deleted -->
    <?php if (isset($_SESSION['msg'])): ?>
      <div class ="msg">
    <?php
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    ?>
     </div>
    <?php endif ?>
<br>

<!-- When 'Update' button is clicked, fetch the record to be updated -->
<?php
if (isset($_GET['update'])) {                           //if 'Update' button is clicked
  $sprvisorNo = $_GET['update'];
  $update = true;
  $rec = mysqli_query($connection, "SELECT * FROM supervisors WHERE sprvisorNo=$sprvisorNo");       //for the specific supervisor to be updated, select all of their information
  $record = mysqli_fetch_array($rec);                   //fetch all of the records to be updated
  $sprvisorNo = $record['sprvisorNo'];                  //supervisor ID record
  $fName = $record['fName'];                            //supervisor First Name record
  $lName = $record['lName'];                            //supervisor Last Name record
}
?>

<!-- 'Add New Supervisor' & 'Update Supervisor Information' Form' -->
   <form autocomplete="off" class="form" method="POST" action="supervisors-crud.php">
   <?php if ($update == false): ?>                   <!-- Default state of form: when 'update' button is not clicked, by default the form will 'add' supervisors -->
    <h2 class="form-header"> Add a New Supervisor: </h2>            <!-- Title of form -->
  <?php else: ?>                                      <!-- When 'update' button is clicked, form changes to update supervisor information -->
    <h2 class="form-header"> Update Supervisor Information: </h2>   <!-- Title of form -->
    <?php endif ?>

    <div class="form-input">
      <label>Supervisor ID: </label>                <!-- 'Supervisor ID' input field, required field that only takes numbers -->
      <input type="number" name="sprvisorNo" required value="<?php echo $sprvisorNo; ?>">
   </div>

   <div class="form-input">
      <label>First Name: </label>                   <!-- 'First Name' input field, required field -->
      <input type="text" name="fName" required value="<?php echo $fName; ?>">
   </div>

   <div class="form-input">
      <label>Last Name: </label>                    <!-- 'Last Name' input field, required field -->
      <input type="text" name="lName" required value="<?php echo $lName; ?>">
   </div>

   <div class="form-input">
     <?php if ($update == false): ?>                <!-- Default state of form, when 'update' button is not clicked, by default the form will show 'Add Supervisor' button -->
      <button type="submit" name="add" class="form-btn">Add Supervisor</button>     <!-- 'Add Supervisor' Button -->
    <?php else: ?>                                  <!-- When 'Update' button is clicked, form changes to show 'Update Record' button -->
      <button type="submit" name="update" class="form-btn">Update Record</button>   <!-- 'Update Record' Button -->
    <?php endif ?>
   </div>
 </form>                 <!-- End of 'Add Supervisor'/'Update Supervisor Information' Form -->
 
<br>
<br>

<h2> List of all supervisor records: </h2>
<p> Use the search box below to find what you're looking for
    and click 'Update' or 'Delete' to edit or remove records </p>

<br>

<!-- Search bar function -->
<form autocomplete="off" name="search_form" class="search-bar" method="POST" action="supervisors.php">
  <input type="text" name="search_box" placeholder="Search..." value="" />              <!-- Search box text input field -->
  <input type="submit" name="search" class="search-button" value="Search Table">        <!-- 'Search Table' Button -->
</form>             <!-- End of Search Bar Function -->

<br>

<?php
//connect to server address, username, password, then database 
  $connection=mysqli_connect("localhost","root","","enterprise_pro");

//checks whether the database connection is successful or not
  if ($connection) {
    echo "";
    } else { 
         die("Connection failed");
      } ?>

<!-- MYSQL Database Table -->
    <table class="table">
      <thead>
        <tr>
          <!-- Table Headers -->
          <th> Supervisor ID </th>
          <th> First Name </th>
          <th> Last Name </th>
          <th> Modify </th>
        </tr>
    </thead>

    <tbody>
      <?php

        //executes the correct columns from the SQL Database
        $sql="SELECT s.sprvisorNo, s.fName, s.lName FROM supervisors s";
        $results=mysqli_query($connection,$sql);

        //retrieves data that was searched in the Search Bar
        $searchsql = "SELECT * FROM supervisors ";
        if (isset($_POST['search'])) {                      //if 'Search Table' button is clicked
          $search_term = mysqli_real_escape_string($connection, $_POST['search_box']);
          
          //display records that contains the same characters as in the search term
          $searchsql .= "WHERE sprvisorNo LIKE '%{$search_term}%'";
          $searchsql .= " OR fName LIKE '%{$search_term}%'";
          $searchsql .= " OR lName LIKE '%{$search_term}%'";
        }
        $results = mysqli_query($connection,$searchsql);

        //displays all records from database table
        if (mysqli_num_rows($results)>0) {
        while($row=mysqli_fetch_array($results)) {
          echo "<tr>
          <td>" . $row["sprvisorNo"] . "</td>                   <!-- display supervisor IDs -->
          <td>" . $row["fName"] . "</td>                        <!-- display supervisor first names -->
          <td>" . $row["lName"] . "</td>                        <!-- display supervisor last names -->
          <td>
            <a href='supervisors.php?update=". $row["sprvisorNo"] . "' class='update-btn'>Update</a>            <!-- 'Update' button -->
            <a href='supervisors-crud.php?del=" . $row["sprvisorNo"] . "' class='delete-btn'>Delete</a>         <!-- 'Delete' button -->
        </tr>";
        }
        }

        //close the database connection
        mysqli_close($connection);

     
    ?>
    </tbody>
  </table>              <!-- End of MySQL Database Table -->
  <br>
  

</body>
</html>