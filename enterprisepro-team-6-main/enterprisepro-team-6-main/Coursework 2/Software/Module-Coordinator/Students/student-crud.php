<!-- Module Coordinator - Students CRUD (Create, Read, Update, Delete) Page -->
<!-- Used to add, update or delete students -->


<?php
include_once 'students.php';
session_start();

    //initialize variables
    $studentNo = "";
    $fName = "";
    $lName = "";
    $project = "";
    $sprvisorNo = "";
    $sprvisor = "";
    $update = false;
    
    
    // connect to server address, username, password, then database name
    $connection=mysqli_connect("localhost","root","","enterprise_pro");

    // if 'Add Student' button is clicked
    if (isset($_POST['add'])){
        $studentNo = $_POST['studentNo'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $project = $_POST['project'];
        $sprvisorNo = $_POST['sprvisorNo'];
        $sprvisor = $_POST['sprvisor'];
        $userID = $_POST['studentNo'];
        $username = substr($_POST['fName'], 0, 1) . '.' . $_POST['lName'];
        $password = 'student123';
        $userType = 'student';

        //adds record to 'Students' database (Creates new student)
        $sql = "INSERT INTO students (studentNo, fName, lName, project, sprvisorNo, sprvisor) 
                VALUES ('$studentNo', '$fName', '$lName', '$project', '$sprvisorNo', '$sprvisor')";
        $query = mysqli_query($connection, $sql);  
        
        //adds record to 'User' database (Creates new user account for student)
        if($query) {
        $sql2 = "INSERT INTO users (userID, username, password, userType)
        VALUES ('$userID', '$username', '$password', '$userType')";
        $query2 = mysqli_query($connection, $sql2);
        }

        $_SESSION['msg'] = "Student Record Added & User Account Created";       //display message on screen when record added
        header('location: students.php');                                       //redirect to main page after insertion
    }

    // if 'Update Record' button is clicked
    if (isset($_POST['update'])) { 
        $studentNo = mysqli_real_escape_string($connection, $_POST['studentNo']);
        $fName = mysqli_real_escape_string($connection, $_POST['fName']);
        $lName = mysqli_real_escape_string($connection, $_POST['lName']);
        $project = mysqli_real_escape_string($connection, $_POST['project']);
        $sprvisorNo = mysqli_real_escape_string($connection, $_POST['sprvisorNo']);
        $sprvisor = mysqli_real_escape_string($connection, $_POST['sprvisor']);
        
        //updates record in 'Students' Database table
        mysqli_query($connection, "UPDATE students SET studentNo='$studentNo', 
        fName='$fName', lName='$lName', project='$project', sprvisorNo='$sprvisorNo', sprvisor='$sprvisor'
        WHERE studentNo=$studentNo");

        $_SESSION['msg'] = "Record updated";            //display message on screen when record updated
        header('location: students.php');               //redirect to main page after update
    }

    // if 'Delete' button is clicked
    if (isset($_GET['del'])) {
        $id=$_GET['del'];

        //Deletes record from 'Students' database (Deletes student record)
        $sql = "DELETE FROM students WHERE studentNo='$id'";
        $query = mysqli_query($connection, $sql);

        //Deletes record from 'Users' database (Deletes user account)
        if($query) {
            $sql2 = "DELETE FROM users WHERE userID = '$id'";
            $query2 = mysqli_query($connection, $sql2);
        }

        $_SESSION['msg'] = "Student Record & User Account Deleted";         //display message on screen when record deleted
        header('location: students.php');                                   //redirect to main page after deletion
    }
?>
