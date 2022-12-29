<!-- Login Page -->


<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Login - Final Year Project Allocation System</title>

<style>

/* Body CSS */
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #007BAF;
}

/* Header CSS */
.header {
  background: #004C6D;
  text-align: center;
  padding: 15px;
  color: white;
}

/* Increase Title font size */
.header h1 {
  font-size: 40px;
}

/* Login Form CSS */
.form {
  border: 2px solid black;
  width: 300px;
  height:225px;
  background: #E8E8E8;
  border-radius: 10px;
  padding: 10px;
  align-items: center;
  position: relative;
  top: 40%;
  left: 40%;
  box-shadow: 15px 15px 12px #006587;
}

/* Form Header CSS */
.form-header {
    text-align: center;
}

/* Form Text Input CSS */
.form-input {
    position: absolute;
    left: 95px;
    width: 55%;
}

/* 'Login' Button CSS */
.submit-button {
    display: block;
    width: 100%;
    background-color: #0083B7;
    border: none;
    border-radius: 4px;
    padding: 7px;
    cursor: pointer;
    text-align: center;  
}

/* Change colour of 'Login' button when hovered over */
.submit-button:hover {
    background-color: #009DDB;
}

</style>
</head>
<body>

<!-- Page Title and subtitle -->
<div class="header">
  <h1>Final Year Project Allocation System</h1>
  <p>By Team Horizon</p>
</div> 

<br><br><br><br><br><br>

    <!-- Login Form -->
    <form autocomplete="off" class="form" action="" method="POST">
    <h2 class="form-header"> Enter your Details: </h2>
    <br>

    <div>
        <label class="label">User ID: </label>              <!-- 'User ID' input field, required field that only takes numbers -->
        <input class="form-input" type ="number" name="userID" required placeholder="Unique 8 Digit Number">
    </div>   
    
    <br>

    <div>
        <label class="label">Username: </label>             <!-- 'Username' input field, required field -->
        <input class="form-input" type ="text" name="username" required placeholder="e.g. 'j.doe'">
    </div>   

    <br>

    <div>
        <label class="label">Password: </label>             <!-- 'Password' input field, required field -->
        <input class="form-input" type ="password" name="password" required placeholder="Case Sensitive">
    </div>  

    <div>
     <br>
        <input class="submit-button" type="submit" value="Login">       <!-- 'Login' Button -->
    </div>   
    </form>             <!-- End of Login form -->
</body>   
</html> 

<?php

    // connect to server address, username, password, then database 
    $connection=mysqli_connect("localhost","root","","enterprise_pro");

    //checks whether the database connection is successful or not
    if ($connection) {
        echo "";
        } else { 
        die("Connection failed");
        }

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $userID=$_POST["userID"];
        $username=$_POST["username"];
        $password=$_POST["password"];

        //executes the correct columns from the SQL Database
        $sql="SELECT userID, username, password, usertype FROM users 
        WHERE userID = '" . $userID . "' AND username= '" . $username . "' AND BINARY password= '" . $password . "' ";
        $result=mysqli_query($connection, $sql);

        //reads data from database
        $row=mysqli_fetch_array($result);

        //redirect to the correct page based on usertype
        if($row["usertype"] == "student") {                     //if 'user' is a student
            $_SESSION["userID"] = $userID;                      //use their userID to begin a login session
            $id = $row['userID'];                               //use their userID to retrieve only the user's specific personal information (the user's name, allocated project, supervisor etc.)
            header("location: http://localhost/enterprisepro/student/home/studhome.php?id=".$id);       //redirect user to the student home page, and display their specific information
        }

        elseif($row["usertype"] == "supervisor") {              //if 'user' is a supervisor
            $_SESSION["userID"] = $userID;                      //use their userID to begin a login session
            $id = $row['userID'];                               //use their userID to retrieve only the user's specific personal information (the user's name, projects etc.)
            header("location:http://localhost/enterprisepro/supervisor/home/sprhome.php?id=".$id);      //redirect user to the supervisor home page, and display their specific information
        }

        elseif($row["usertype"] == "module coordinator") {      //if 'user' is a module coordinator
            $_SESSION["userID"] = $userID;                      //use their userID to begin a login session
            $id = $row['userID'];                               //use their userID to retrieve only the user's specific personal information (the user's name, allocated project, supervisor etc.)
            header("location: http://localhost/enterprisepro/module-coordinator/students/students.php?id=".$id);    //redirect user to the module coordinator page
        }

        elseif($row["usertype"] == null) {                      //if user's details (userID, username or password) are incorrect
            header("location: http://localhost/enterprisepro/login/login.php");     //do not allow access and refresh the login page
        }

    }    

?>