<!-- Module Coordinator - Supervisors CRUD (Create, Read, Update, Delete) Page -->
<!-- Used to add, update or delete supervisors -->


<?php
include_once 'supervisors.php';
session_start();

    //initialize variables
    $sprvisorNo = "";
    $fName = "";
    $lName = "";
    $update = false;
    
    
//connect to server address, username, password, then database 
$connection=mysqli_connect("localhost","root","","enterprise_pro");

//if 'Add Supervisor' button is clicked
if (isset($_POST['add'])){
    $sprvisorNo = $_POST['sprvisorNo'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $sprvisorName = $_POST['fName'] . ' ' . $_POST['lName'];
    $userID = $_POST['sprvisorNo'];
    $username = substr($_POST['fName'], 0, 1) . '.' . $_POST['lName'];
    $password = 'supervisor123';
    $userType = 'supervisor';    

    //adds record to 'Supervisors' database (Creates new supervisor)
    $sql = "INSERT INTO supervisors (sprvisorNo, fName, lName, sprvisorName) 
              VALUES ('$sprvisorNo', '$fName', '$lName', '$sprvisorName')";
    $query = mysqli_query($connection, $sql);

    //adds record to 'Users' database (Creates new user account for supervisor)
    if($query) {
        $sql2 = "INSERT INTO users (userID, username, password, userType)
        VALUES ('$userID', '$username', '$password', '$userType')";
        $query2 = mysqli_query($connection, $sql2);
        }

    $_SESSION['msg'] = "Supervisor Record Added & User Account Created";            //display message on screen when record added
    header('location: supervisors.php');                                            //redirect to main page after insertion
}

// if 'Update Record' button is clicked
if (isset($_POST['update'])) {
    $sprvisorNo = mysqli_real_escape_string($connection, $_POST['sprvisorNo']);
    $fName = mysqli_real_escape_string($connection, $_POST['fName']);
    $lName = mysqli_real_escape_string($connection, $_POST['lName']);
    $sprvisorName = mysqli_real_escape_string($connection, $_POST['fName'] . ' ' . $_POST['lName']);
    
    //updates record in 'Supervisors' database
    mysqli_query($connection, "UPDATE supervisors SET sprvisorNo='$sprvisorNo', 
    fName='$fName', lName='$lName', sprvisorName='$sprvisorName' WHERE sprvisorNo=$sprvisorNo");

    $_SESSION['msg'] = "Record updated";                                        //display message on screen when record added
    header('location: supervisors.php');                                        //redirect to main page after update

}

// if 'Delete' button is clicked
if (isset($_GET['del'])) {
    $id=$_GET['del'];

    //Deletes record from 'Supervisors' database 
    $sql = "DELETE FROM supervisors WHERE sprvisorNo='$id'";
    $query = mysqli_query($connection, $sql);

    //Deletes record from 'Users' database (Deletes user account)
    if($query) {
        $sql2 = "DELETE FROM users WHERE userID ='$id'";
        $query2 = mysqli_query($connection, $sql2);
    }

    $_SESSION['msg'] = "Supervisor Record & User Account Deleted";          //display message on screen when record added
    header('location: supervisors.php');                                    //redirect to main page after deletion
}
?>
