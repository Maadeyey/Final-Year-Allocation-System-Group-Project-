<!-- Module Coordinator - Projects CRUD (Create, Read, Update, Delete) Page -->
<!-- Used to add, update or delete projects -->

<?php
include_once 'projects.php';
session_start();

    //initialize variables
    $projectNo = "";
    $projectName = "";
    $sprvisor = "";
    $sprvisorNo = "";
    $projectDesc = "";
    $update = false;
    
    
// connect to server address, username, password, then database 
$connection=mysqli_connect("localhost","root","","enterprise_pro");

// if 'Add Project' button is clicked
if (isset($_POST['add'])){
    $projectNo = $_POST['projectNo'];
    $projectName = $_POST['projectName'];
    $projectDesc = $_POST['projectDesc'];
    $sprvisor = $_POST['sprvisor'];
    $sprvisorNo = $_POST['sprvisorNo'];

    //adds record to 'Projects' database
    $query = "INSERT INTO projects (projectNo, projectName, projectDesc, sprvisor, sprvisorNo) 
              VALUES ('$projectNo', '$projectName', '$projectDesc', '$sprvisor', '$sprvisorNo')";
    mysqli_query($connection, $query);

    $_SESSION['msg'] = "Project Record Added";              //display message on screen when record added
    header('location: projects.php');                       //redirect to main page after insertion
}

// if 'Update Record' button is clicked
if (isset($_POST['update'])) {
    $projectNo = mysqli_real_escape_string($connection, $_POST['projectNo']);
    $projectName = mysqli_real_escape_string($connection, $_POST['projectName']);
    $projectDesc = mysqli_real_escape_string($connection, $_POST['projectDesc']);
    $sprvisor = mysqli_real_escape_string($connection, $_POST['sprvisor']);
    $sprvisorNo = mysqli_real_escape_string($connection, $_POST['sprvisorNo']);

    //updates record in 'Projects' Database
    mysqli_query($connection, "UPDATE projects SET projectNo='$projectNo', 
    projectName='$projectName', projectDesc='$projectDesc', sprvisor='$sprvisor', sprvisorNo='$sprvisorNo'
     WHERE projectNo='$projectNo'");

    $_SESSION['msg'] = "Record updated";                //display message on screen when record added
    header('location: projects.php');                   //redirect to main page after update

}

// if 'Delete' button is clicked
if (isset($_GET['del'])) {
    $id=$_GET['del'];

    //deletes record from 'Project' database
    $query = "DELETE FROM projects WHERE projectNo='$id'";
    mysqli_query($connection, $query);

    $_SESSION['msg'] = "Project Record Deleted";       //display message on screen when record added
    header('location: projects.php');                  //redirect to main page after deletion
}
?>
