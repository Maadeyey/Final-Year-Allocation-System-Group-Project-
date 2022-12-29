<!-- Student's Choose Project Page -->
<!-- Used by Students to view all available projects and choose their preferred one -->


<?php include('chooseprojectcrud.php'); 
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Choose Project - Final Year Project Allocation System</title>
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

/* Alert message when updating records CSS */
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


/* 'Update Project' Form CSS */
.form {
  border: 2px solid black;
  width: 900px;
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
  display: inline-block;
  top: -55px;
  white-space: nowrap;
}

/* Form Text Input Fields CSS */
.form-input {
  padding: 12px;
  text-align: left;
  position: relative;
  left: -235px;
  margin-top: 10px;
}

/* Form 'Update' Button CSS */
.form-btn {
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    padding: 7px; 
    position: relative; 
    left: -100px;
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

/* Collapsible Box CSS */
.collapsible-text {
  background-color: #ffffff;  
  display: none;
  padding: 0 18px;
  overflow: hidden;
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

<!-- Page Title and subtitle-->
<div class="header">
  <h1>Final Year Project Allocation System</h1>
  <p>By Team Horizon</p>
</div>

<!-- Navigation bar Links -->
<div class="navbar">
  <a href="http://localhost/enterprisepro/student/home/studhome.php">Home</a>
  <a href="http://localhost/enterprisepro/student/chooseproject/chooseproject.php">Choose Project</a>
  <a href="http://localhost/enterprisepro/login/login.php">Logout</a>
</div>

  <!-- Main Body -->
  <div class="main">
    <h2> Choose project </h2>
    <p> On this page, you can view all available projects
         and choose your preferred one </p>
    <br>

    <!-- Alert Message when updating project -->
    <?php if (isset($_SESSION['msg'])): ?>
     <div class="msg">
        <?php
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        ?>   
     </div>
    <?php endif ?> 

        <!-- Update Project Form -->
    <form autocomplete="off" class="form" method="POST" action="chooseprojectcrud.php">
    <h2 class="form-header"> Select from the list: </h2>        <!-- Form Instruction -->

    <div class="form-input">
      <label>Supervisor: </label>                               <!-- 'Supervisor' dropdown list -->
      <select id="supervisors" name="sprvisor" onChange="changeproj(this.value);" value="<?php echo $sprvisor; ?>">
    <option value="" disabled selected>Select</option>
    <?php $sql = "SELECT sprvisorName FROM supervisors";        //fill dropdown list directly with database records
      $result = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_array($result)) {
        echo '<option>'.$row['sprvisorName'].'</option>';       //display database records as dropdown list options
      } ?>
      </select>
      </div>

  <div class="form-input">
    <label>Allocated Project: </label>                       <!-- 'Allocated Project' dropdown list - based on supervisor selected, this list will only show their projects -->
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

    </div>
   <div class="form-btn">
      <button type="submit" name="update" class="form-btn">Update</button>      <!-- 'Update Record' Button -->
   </div>
 </form>                <!-- End of 'Update Project' Form -->
 
 <br>
 <br>

 <h2> List of all projects: </h2>
 <p> Use the search box below to find what you're looking for
    and click 'View Description' for more details.</p>

    <br>

<!-- Search bar function -->
<form autocomplete="off" name="search_form" class="search-bar" method="POST" action="chooseproject.php">
  <input type="text" name="search_box" placeholder="Search..." value="" />                      <!-- Search box text input field -->
  <input type="submit" name="search" class="search-button" value="Search Table">                <!-- 'Search Table' Button -->
</form>                     <!-- End of Search Bar Function -->

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
          <th> Project ID </th>
          <th> Project Name </th>
          <th> Project Description </th>
          <th> Supervisor </th>
        </tr>
    </thead>

    <tbody>
      <?php

        //executes the correct columns from the SQL Database
        $_SESSION["userID"];
        $sql="SELECT projectNo, projectName, projectDesc, sprvisor FROM projects";
        $results=mysqli_query($connection,$sql);

        //retrieves data that was searched
        $searchsql = "SELECT * FROM projects ";
        if (isset($_POST['search'])) {                      //if 'Search Table' button is clicked
          $search_term = mysqli_real_escape_string($connection, $_POST['search_box']);

          //display records that contains the same characters as in the search term
          $searchsql .= "WHERE projectNo LIKE '%{$search_term}%'";
          $searchsql .= " OR projectName LIKE '%{$search_term}%'";
          $searchsql .= " OR sprvisor LIKE '%{$search_term}%'";
        }
        $results = mysqli_query($connection,$searchsql);

        //displays all records from database table
        if (mysqli_num_rows($results)>0) {
        while($row=mysqli_fetch_array($results)) {
          echo "<tr>
          <td>" . $row["projectNo"] . "</td>                                                <!-- display project IDs -->
          <td>" . $row["projectName"] . "</td>                                              <!-- display project Names -->
          <td><button type='button' class='collapsible'>View Description</button>           <!-- 'View Description' Collapsible Box -->
          <div class='collapsible-text'>
          <p>" . $row["projectDesc"] . " </p> </div></td>                                   <!-- display project Descriptions -->
          <td>" . $row["sprvisor"] . "</td>                                                 <!-- display project supervisors -->
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
    </tbody>
  </table>                      <!-- End of Database Table -->
  <br>
  

</body>
</html>