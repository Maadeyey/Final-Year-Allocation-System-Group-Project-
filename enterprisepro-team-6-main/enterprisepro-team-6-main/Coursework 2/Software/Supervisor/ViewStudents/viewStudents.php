<!-- Supervisor's View Allocated Students Page -->
<!-- Used by Supervisors to view their allocated students -->


<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>View Allocated Students - Final Year Project Allocation System</title>
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

/* Database Table Header CSS */
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
  <h2> View Allocated Students </h2>
  <p> On this page, you can view all of the students allocated to you </p>
    
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
          <th> Student ID </th>
          <th> First Name </th>
          <th> Last Name </th>
          <th> Allocated Project </th>
        </tr>
    </thead>

    <tbody>
      <?php

        //executes the correct columns from the SQL Database
        $_SESSION["userID"];
        $sql="SELECT st.studentNo, st.fName, st.lName, st.project 
        FROM students st INNER JOIN supervisors su ON st.sprvisorNo = su.sprvisorNo
        WHERE su.sprvisorNo = {$_SESSION['userID']} ";                               //uses the supervisor's userID to retrieve only their specific, allocated students
        $results=mysqli_query($connection,$sql);

        //displays the user's specific, allocated students from database table
        if (mysqli_num_rows($results)>0) {
        while($row=mysqli_fetch_array($results)) {
          echo "<tr>
          <td>" . $row["studentNo"] . "</td>                                    <!-- displays student IDs -->
          <td>" . $row["fName"] . "</td>                                        <!-- displays student first names -->
          <td>" . $row["lName"] . "</td>                                        <!-- displays student last names -->
          <td>" . $row["project"] . "</td>                                      <!-- display student projects -->
        </tr>";
        }
        }

        //close the database connection
        mysqli_close($connection);

     
    ?>
    </tbody>
  </table>                           <!-- End of MySQL Database Table -->
  <br>
  

</body>
</html>