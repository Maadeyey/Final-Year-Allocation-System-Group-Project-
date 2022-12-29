<!-- Module Coordinator - View Students Page -->
<!-- Used by Module Coordinators to view all students and add, update or delete students -->


<?php include('student-crud.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>View Students - Final Year Project Allocation System</title>
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

/* Increase Page Title font size */
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

/* Main body */
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

/* Table Data CSS */
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

/* 'Add New Student' & 'Update Student Records' Form CSS */
.form {
  border: 2px solid black;
  width: 1450px;
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

/* Form Dropdown List CSS */
.form-dropdown {
  padding: 12px;
  text-align: left;
  position: relative;
  left: -225px;
  margin-top: 10px;
}

/* Form 'Supervisor' Dropdown List CSS */
.form-sprvisor {
  padding: 12px;
  text-align: left;
  position: relative;
  left: -225px;
  margin-top: 10px;
}

/* Form 'Project' Dropdown List CSS */
.form-project {
  padding: 12px;
  text-align: left;
  position: relative;
  left: -225px;
  top: 20px;
  margin-top: 10px;
}

/* Form 'Add Student'/'Update Record' Button CSS */
.form-btn {
  border-radius: 8px;
  background: #0082B2;
  border: none;
  cursor: pointer;
  font-size: 14px;
  padding: 10px;
  position: relative;
  left: 225px;
  transition-duration: 0.4s;
}

/* Change colour of 'Add Student'/'Update Record' button when hovered over */
.form-btn:hover {
  background-color: #00A9ED;
}

/* Search Bar CSS */
.search-bar {
  width: 100%;
  position: relative;
 
}

/* 'Search Table' Button CSS */
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
    <h2> Welcome, Module Coordinator </h2>
    <p> On this page, you can view all student records and add, update or delete records </p>
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

<!-- When update button is clicked, fetch the record to be updated -->
<?php
if (isset($_GET['update'])) {                             //if 'Update' button is clicked
  $studentNo = $_GET['update'];
  $update = true;
  $rec = mysqli_query($connection, "SELECT * FROM students WHERE studentNo=$studentNo");    //for the specific student to be updated, select all of their information
  $record = mysqli_fetch_array($rec);                     //fetch all of the records to be updated
  $studentNo = $record['studentNo'];                      //student ID record
  $fName = $record['fName'];                              //student First Name record
  $lName = $record['lName'];                              //student Last Name record
  $project = $record['project'];                          //student Allocated Project record
  $sprvisorNo = $record['sprvisorNo'];                    //student's Allocated supervisor's num record
  $sprvisor = $record['sprvisor'];                        //student's Allocated supervisor record
}
?>


<!-- 'Add New Student' & 'Update Student Info' Form' -->
  <form autocomplete="off" class="form" method="POST" action="student-crud.php">
   <?php if ($update == false): ?>        <!-- Default state of form: when 'update' button is not clicked, by default the form will 'add' students -->
    <h2 class="form-header"> Add a New Student: </h2>   <!-- Title of form -->
  <?php else: ?>                          <!-- When 'update' button is clicked, form changes to update student information -->
    <h2 class="form-header"> Update Student Information: </h2>  <!-- Title of form -->
  <?php endif ?>

  <div class="form-input">
      <label>Student ID: </label>     <!-- 'Student ID' input field, required field that only takes numbers -->
      <input type="number" name="studentNo" required value="<?php echo $studentNo; ?>">
   </div>

   <div class="form-input">
      <label>First Name: </label>     <!-- 'First Name' input field, required field -->
      <input type="text" name="fName" required value="<?php echo $fName; ?>">
   </div>
   
   <div class="form-input">
      <label>Last Name: </label>      <!-- 'Last Name' input field, required field -->
      <input type="text" name="lName" required value="<?php echo $lName; ?>">
   </div>

   <div class="form-dropdown">
      <label>Supervisor ID: </label>      <!-- 'Supervisor ID' dropdown list -->
      <select id="supervisorNo" name="sprvisorNo" value="<?php echo $sprvisorNo; ?>">
      <option value="" disabled selected>Select</option>
      <?php $sql = "SELECT sprvisorNo FROM supervisors";    //fill dropdown list directly with database records
      $result = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_array($result)) {
        echo '<option>'.$row['sprvisorNo'].'</option>';     //display database records as dropdown list options
      } ?>
      </select>
   </div>

   <div class="form-sprvisor">
      <label>Supervisor: </label>                   <!-- 'Supervisor' dropdown list -->
      <select id="supervisors" name="sprvisor" onChange="changeproj(this.value);" value="<?php echo $sprvisor; ?>">   <!-- Based on the supervisor selected from the list, the 'Allocated Project' list will show only their projects -->
    <option value="" disabled selected>Select</option>
    <?php $sql = "SELECT sprvisorName FROM supervisors";    //fill dropdown list directly with database records
      $result = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_array($result)) {
        echo '<option>'.$row['sprvisorName'].'</option>';   //display database records as dropdown list options
      } ?>
      </select>
  </div>

  <div class="form-project">
    <label>Allocated Project: </label>              <!-- 'Allocated Project' dropdown list - based on supervisor selected, this list will only show their projects -->
<select id="projects" name="project" value="<?php echo $project; ?>">
    <option value="" disabled selected>Select</option>
</select>


<!-- In 'Allocated Project' dropdown list, show projects based on the supervisor selected -->
<script>
var projectBySupervisor = {
    'Amr Abdullatif': ["Efficient deep neural network architecture search", "Unsupervised learning for 3D-structure-aware scene representation", "Speech emotion recognition", "Sign Language Interpreter using Machine Learning and Raspberry Pi"],
    'Irfan Awan': ["Analysis of Security Vulnerabilities in Software Defined Networking", "Secured Messaging", "Evaluation of Anti Virus Systems Against Malwares", "Intelligent Malwares Classification and Detection", "Ransomware Detection Using Behavioural Based Analysis", "Network Security with Honeypots Logfiles Analysis", "Detection and Analysis of Low and Slow Attacks"],
    'Mai Elshehaly': ["Visualising Biological Pathways", "A Comparative Study of Visualisation Evaluation Methodologies for Augmented Reality", "Visualising the landscape of VR Applications in Brain Research"],
    'Ibrahim Ghafir': ["Machine Learning for the Detection of Wireless Injection Attacks", "Machine Learning for Anomaly Detection in Network Traffic", "Cyber Attacks Mitigation: Detecting Malicious Activities in Network Traffic"],
    'Rob Holton': ["Visualising cryptographic protocols written in Alice & Bob notation", "Analysing cryptographic protocols using the Spi calculus", "PEPA visualisation tool", "Using the Pi-calculus to model mobile protocols", "Real-Time Specification Case Study"],
    'Sohag Kabir': ["Safety and Reliability Analysis of IoT-Enabled Smart Environment", "Addressing conflicting requirements for the safe operation of Cyber-Physical Systems", "Failure Behaviour analysis of Unmanned Aerial Vehicles", "A model-driven Bayesian Approach for Reliability Analysis of Systems"],
    'Savas Konur': ["Computational Modelling and Analysis of Biological Systems", "Detection of Retinal Disease Detection Using Machine Learning", "Detection of Brain Tumour Using Image Processing and Machine Learning"],
    'Ci Lei': ["Modelling of Nano-Scale Electronic Devices", "Programming for pricing financial derivatives", "Line segment intersection detection with OpenGL", "Path planning using polygon triangulation", "Visualization of quantum states evolution", "Wearable safety vest for cyclists showing speed", "Football coaching app"],
    'Raluca Lefticaru': ["Own Project (Library)", "Own Project (CRM System)", "Learn2Drive E-Learning Mobile Application", "GM5: Human Computer Interface (HCI) and E-Learning or E-Commerce", "Own Project (Fitness App)"],
    'Daniel Neagu': ["Machine Learning for Big Data Analytics", "Responsible Artificial Intelligence chatbots for blended academic VLE delivery", "Decentralised AI and Big Data Analytics in Blockchain Transactions"],
    'Amna Qureshi': ["Internet-of-Things Hacking", "Privacy challenges associated with COVID-19 surveillance systems", "Detection of Cyberbullying on Social Media Platforms using Machine Learning", "An Efficient Vulnerability Detection Method for Smart Contracts"],
    'Rami Qahwaji': ["Development of Machine Learning System for Knowledge Extraction from Medical Data Sets", "Application of Visual Computing Techniques for the Visualisation of big data", "Development of Computer Vision System for the Processing of Videos", "Development of Computer Vision System for the Digital Diagnostic of Medical Scans"],
    'Daniele Scrimieri': ["A mobile app for secure voting", "Evaluation of spatial indexing techniques for transferring finite element data across meshes", "Development of spatial indexing techniques for transferring finite element data across meshes", "A web application for the configuration of a Linux packet filtering firewall"],
    'Karim Sadik': ["Mobile Applications for Healthcare", "Internet Monitoring and Control System", "Health care consultant", "Insurance Brokerage and Management System (IBMS)", "Operating System Android Environment Security", "Simulating Data Security In E-Business Network Infrastructure Using CISCO Packet Trace Software", "M-Government using MongoDB"],
    'Dhaval Thakker': ["Smart Home and Elderly care", "A data browser to support cultural understanding", "Internet of Things (IoT) and Data Analytics based Flood monitoring for a Smart City project", "Internet of Things (IoT) and Data Analytics based Intelligence recycling for a Smart City project"],
    'Paul Trundle': ["AI for Artificial, Intelligent Game Opponents", "Serious Games", "Creating Worlds: Terrain Generation in Computer Games and Virtual Environments", "Data Mining Game AI"],
    'Apostol Vourdas': ["Gabor Signal Analysis", "Appointment booking system", "Time-frequency analysis of signals using Wigner functions", "Ambiguity functions for Radar signal analysis", "Information theory calculations for quantum communications", "Quantum superpositions, Wigner functions and their applications to Quantum Computing", "Computer Graphics with Bezier curves",
                        "Boolean algebra, Boolean ring and reversible computation", "Heyting (Brouwerian) logic", "Detection of plagiarism in the music industry"],
    'Kit Qichun Zhang': ["Stochastic distribution control for dynamic systems", "Entropy optimisation for dynamic systems", "Filter design for dynamic non-Gaussian systems", "Statistical data visualisation platform"]
    
}

//JavaScript to show projects based on supervisor selected
function changeproj(value) {
  if (value.length == 0) document.getElementById("projects").innerHTML = "<option></option>";
  else {
      var projOptions = "";
      for (projectId in projectBySupervisor[value]) {
        projOptions += "<option>" + projectBySupervisor[value][projectId] + "</option>";
      }
      document.getElementById("projects").innerHTML = projOptions;
    }
}
</script>

  <?php if ($update == false): ?>      <!-- Default state of form, when 'update' button is not clicked, by default the form will show 'Add Student' button -->
    <button type="submit" name="add" class="form-btn">Add Student</button>      <!-- 'Add Student' Button -->
  <?php else: ?>                        <!-- When 'Update' button is clicked, form changes to show 'Update Record' button -->
    <button type="submit" name="update" class="form-btn">Update Record</button>   <!-- 'Update Record' Button -->
  <?php endif ?>
  </div>
</form>        <!-- End of 'Add Student'/'Update Student Information' Form -->

<br>
<br>

<h2> List of all student records: </h2>
<p> Use the search box below to find what you're looking for
    and click 'Update' or 'Delete' to edit or remove records </p>

<br>

<!-- Search bar function -->
<form autocomplete="off" name="search_form" class="search-bar" method="POST" action="students.php">
  <input type="text" name="search_box" placeholder="Search..." value="" />        <!-- Search box text input field -->
  <input type="submit" name="search" class="search-button" value="Search Table">  <!-- 'Search Table' button -->
</form>               <!-- End of Search bar function -->

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
        <th> Supervisor </th>
        <th> Modify </th>
      </tr>
    </thead>

    <tbody>
      <?php

        //executes the correct columns from the SQL Database
        $sql="SELECT studentNo, fName, lName, project, sprvisor FROM students";
        $results=mysqli_query($connection,$sql);

        //retrieves data that was searched in the Search Bar
        $searchsql = "SELECT * FROM students ";
        if (isset($_POST['search'])) {          //if 'Search Table' button is clicked
          $search_term = mysqli_real_escape_string($connection, $_POST['search_box']);

          //display records that contains the same characters as in the search term
          $searchsql .= "WHERE studentNo LIKE '%{$search_term}%'";
          $searchsql .= " OR fName LIKE '%{$search_term}%'";
          $searchsql .= " OR lName LIKE '%{$search_term}%'";
          $searchsql .= " OR project LIKE '%{$search_term}%'";
          $searchsql .= " OR sprvisor LIKE '%{$search_term}%'";
        }
        $results = mysqli_query($connection,$searchsql);

        //displays all records from database table
        if (mysqli_num_rows($results)>0) {
        while($row=mysqli_fetch_array($results)) {
          echo "<tr>
          <td>" . $row["studentNo"] . "</td>          <!-- display student IDs -->
          <td>" . $row["fName"] . "</td>              <!-- display student first names -->
          <td>" . $row["lName"] . "</td>              <!-- display student last names -->
          <td>" . $row["project"] . "</td>            <!-- display student's allocated projects -->
          <td>" . $row["sprvisor"] . "</td>           <!-- display student's allocated supervisors -->
          <td>
            <a href='students.php?update=". $row["studentNo"] . "' class='update-btn'>Update</a>        <!-- 'Update' button -->
            <a href='student-crud.php?del=" . $row["studentNo"] . "' class='delete-btn'>Delete</a>      <!-- 'Delete' button -->
        </tr>";
        }
        }
      

        //close the database connection
        mysqli_close($connection);

     
    ?>
    </tbody>
  </table>          <!-- End of MySQL Database Table -->
  <br>

</body>
</html>