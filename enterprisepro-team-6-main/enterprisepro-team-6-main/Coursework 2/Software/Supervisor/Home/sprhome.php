<!-- Supervisor's Home Page
Used by Supervisors to view their own details and projects and to add/update/delete their projects-->


<?php include('sprhomecrud.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Supervisor Home - Final Year Project Allocation System</title>
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

/* 'Add New Project' & 'Update Project' Form CSS */
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

/* 'Add Project/'Update Record' Button CSS */
.form-btn {
  border-radius: 8px;
  background: #0082B2;
  border: none;
  cursor: pointer;
  font-size: 14px;
  padding: 10px;
  transition-duration: 0.4s;
}

/* Change colour of 'Add Project'/'Update Record'/ button when hovered over */
.form-btn:hover {
  background-color: #00A9ED;
}

/* 'View Description' Collapsible Box CSS */
.collapsible {
  background-color: #0082B2;
  color: white;
  width: 100%;
  cursor: pointer;
  border: none;
  outline: none;
  padding: 10px;
  text-align: left;
  font-size: 15px;
}

/* Change colour of collapsible box when hovered over */
.active, .collapsible:hover {
  background-color: #00A9ED;
}

/* Collapsible box Text CSS */
.collapsible-text {
  background-color: #ffffff;  
  display: none;
  padding: 0 18px;
  overflow: hidden;
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
  <a href="http://localhost/enterprisepro/supervisor/home/sprhome.php">Home</a>
  <a href="http://localhost/enterprisepro/supervisor/viewstudents/viewstudents.php">View Allocated Students</a>
  <a href="http://localhost/enterprisepro/login/login.php">Logout</a>
</div>

<!-- Main Body -->
  <div class="main">
    <h2> Welcome, Supervisor </h2>
    <p> On this page, you can view your personal details, as well as your projects.
        You can also add, update or delete your projects </p>
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
if (isset($_GET['update'])) {                                   //if 'Update' button is clicked
  $projectNo = $_GET['update'];
  $update = true;
  $rec = mysqli_query($connection, "SELECT * FROM projects WHERE projectNo='$projectNo'");          //for the specific project to be updated, select all of its information
  $record = mysqli_fetch_array($rec);                           //fetch all of the records to be updated
  $projectNo = $record['projectNo'];                            //project ID record
  $projectName = $record['projectName'];                        //project Name record
  $projectDesc = $record['projectDesc'];                        //project Description record
  $sprvisor = $record['sprvisor'];                              //project supervisor record
}
?>
    
<!-- 'Add New Project' & 'Update Project Info' Form' -->
<form autocomplete="off" class="form" method="POST" action="sprhomecrud.php">
   <?php if ($update == false): ?>                               <!-- Default state of form: when 'update' button is not clicked, by default the form will 'add' project -->
    <h2 class="form-header"> Add a New Project: </h2>            <!-- Title of Form -->
  <?php else: ?>                                                 <!-- When 'update' button is clicked, form changes to update project information -->
    <h2 class="form-header"> Update Project Information: </h2>      <!-- Title of Form -->
    <?php endif ?>

    <div class="form-input">
      <label>Project ID: </label>                               <!-- 'Project ID' input field, required field that only takes numbers -->
      <input type="text" name="projectNo" required value="<?php echo $projectNo; ?>">
   </div>

   <div class="form-input">
      <label>Project Name: </label>                             <!-- 'Project Name' input field, required field -->
      <input type="text" name="projectName" required value="<?php echo $projectName; ?>">
   </div>

   <div class="form-input">
      <label>Project Description: </label>                      <!-- 'Project Description' input field, required field -->
      <input type="text" name="projectDesc" required value="<?php echo $projectDesc; ?>">
   </div>

   <div class="form-input">
      <label>Supervisor ID: </label>                            <!-- 'Supervisor ID' dropdown list -->
      <select id="supervisorsID" name="sprvisorNo" value="<?php echo $sprvisorNo; ?>">
      <?php $sql = "SELECT sprvisorNo FROM supervisors
      WHERE sprvisorNo = '{$_SESSION['userID']}'";              //supervisor can only add/update their own projects, not anyone elses
      $result = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_array($result)) {
        echo '<option>'.$row['sprvisorNo'].'</option>';         //display only the logged in supervisor's supervisorID as the dropdown list option
      } ?>
      </select>
   </div>

   <div class="form-input">
      <label>Supervisor: </label>                               <!-- 'Supervisor' dropdown list -->
      <select id="supervisors" name="sprvisor" value="<?php echo $sprvisor; ?>">
      <?php $sql = "SELECT sprvisorName FROM supervisors
      WHERE sprvisorNo = '{$_SESSION['userID']}'";              //supervisor can only add/update their own projects, not anyone elses
      $result = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_array($result)) {
        echo '<option>'.$row['sprvisorName'].'</option>';       //display only the logged in supervisor's name as the dropdown list option
      } ?>
      </select>
   </div>

   <div class="form-input">
     <?php if ($update == false): ?>                          <!-- Default state of form, when 'update' button is not clicked, by default the form will show 'Add Project' button -->
      <button type="submit" name="add" class="form-btn">Add Project</button>        <!-- 'Add Project' Button -->
    <?php else: ?>                                            <!-- When 'Update' button is clicked, form changes to show 'Update Record' button -->
      <button type="submit" name="update" class="form-btn">Update Record</button>   <!-- 'Update Record' Button -->
    <?php endif ?>
   </div>
 </form>                        <!-- End of 'Add Project'/'Update Project Information' Form -->
 
 <br>
 <br>

 <?php
 //connect to server address, username, password, then database 
   $connection=mysqli_connect("localhost","root","","enterprise_pro");

//checks whether the database connection is successful or not
  if ($connection) {
        echo "";
    }else { 
        die("Connection failed");
    } ?>

<!-- MYSQL Database Table to show Supervisor's Details -->
<h2> Your Details: </h2>
<table class="table">
      <thead>
        <tr>
          <!-- Table Headers -->
          <th> Supervisor ID </th>  
          <th> First Name </th>
          <th> Last Name </th>
        </tr>
    </thead>

    <tbody>
    <?php

    //executes the correct columns from the SQL Database
    $_SESSION["userID"];
    $sql="SELECT sprvisorNo, fName, lName
    FROM supervisors a INNER JOIN users b ON a.sprvisorNo = b.userID
    WHERE a.sprvisorNo = '{$_SESSION['userID']}'";                      //uses the supervisor's userID to retrieve only their specific, personal information
    $results=mysqli_query($connection,$sql);  
    
    //displays the user's specific, personal records from database table
    if (mysqli_num_rows($results)>0) {
    while($row=mysqli_fetch_array($results)) {
      echo "<tr>
      <td>" . $row["sprvisorNo"] . "</td>                               <!-- displays user's supervisorID -->
      <td>" . $row["fName"] . "</td>                                    <!-- displays user's first name -->
      <td>" . $row["lName"] . "</td>                                    <!-- display user's last name -->
    </tr>";
    }
    }

    ?>
    </tbody>
  </table>              <!-- End of MySQL Database Table showing Supervisor's Details -->

  <br><br><br>

<!-- MYSQL Database Table to show Supervisor's Projects -->
<h2> Your Projects: </h2>
<p>View all of your projects and click 'View Description' for more details. 
    You can also click 'Update' or 'Delete' to edit or remove records </p>
  <table class="table">
    <!-- Table Headers -->
    <th> Project ID </th>
    <th> Project Name </th>
    <th> Project Description </th>
    <th> Modify Project </th>

  <?php

    //executes the correct columns from the SQL Database
    $_SESSION["userID"];
    $sql="SELECT projectNo, projectName, projectDesc
    FROM projects a INNER JOIN users b ON a.sprvisorNo = b.userID
    WHERE a.sprvisorNo = '{$_SESSION['userID']}'";                  //uses the supervisor's userID to retrieve only their specific projects
    $results=mysqli_query($connection,$sql);


    //displays the user's specific project records from database table
    if (mysqli_num_rows($results)>0) {
        while($row=mysqli_fetch_array($results)) {
          echo "<tr>
          <td>" . $row["projectNo"] . "</td>                                            <!-- display project IDs -->
          <td>" . $row["projectName"] . "</td>                                          <!-- display project names -->
          <td><button type='button' class='collapsible'>View Description</button>       <!-- 'View Description' Collapsible Box -->
          <div class='collapsible-text'>
          <p>" . $row["projectDesc"] . " </p> </div></td>                               <!-- display project descriptions -->
          <td>
          <a href='sprhome.php?update=". $row["projectNo"] . "' class='update-btn'>Update</a>       <!-- 'Update' Button -->
          <a href='sprhome.php?del=" . $row["projectNo"] . "' class='delete-btn'>Delete</a>         <!-- 'Delete' Button -->
        </tr>";
        }
        } ?>

<!-- JavaScript for 'View Description' collapsible box - When clicked, box shows project description -->
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>

<?php
    //close the database connection
    mysqli_close($connection);
    ?>

</table>                <!-- End of MySQL Database Table showing Supervisor's Projects -->
  <br>

</body>
</html>    