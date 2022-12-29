<!-- Student's Choose Project CRUD (Create, Read, Update, Delete) Page -->
<!-- Used to update student's chosen project -->


<?php
include_once 'chooseproject.php';

    //initialize variables
    $studentNo = "";
    $fName = "";
    $lName = "";
    $project = "";
    $sprvisor = "";
    $update = false;
    
// connect to server address, username, password, then database name
$connection=mysqli_connect("localhost","root","","enterprise_pro");

//if 'Update' button is clicked
if(isset($_POST['update'])) {
    $project = mysqli_real_escape_string($connection, $_POST['project']);
    $sprvisor = mysqli_real_escape_string($connection, $_POST['sprvisor']);

    //updates record in 'Students' database
    mysqli_query($connection, "UPDATE students s SET s.project = '$project', s.sprvisor = '$sprvisor'
    WHERE s.studentNo = '{$_SESSION['userID']}'");                                //only updates for the student who is logged in, won't allow a student to change someone else's project

    $_SESSION['msg'] = "Allocated Project Updated";                             //display message on screen when record added 
    header('location: http://localhost/enterprisepro/student/chooseproject/chooseproject.php');     //redirect to main page after update
}

?>