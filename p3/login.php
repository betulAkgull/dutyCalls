<?php

$con = mysqli_connect("localhost", "root", "", "dutycalls");


if (isset($_REQUEST["submit"])) {

    $username = $_REQUEST["username"];
    $passwrd = $_REQUEST["pwd"];


    $query1 = mysqli_query($con, "SELECT * FROM end_user WHERE username = '$username' && passwrd = '$passwrd'");    /* checks if user is an end_user*/
    $query2 = mysqli_query($con,"SELECT * FROM hrr WHERE username = '$username' && passwrd = '$passwrd'");         /* checks if user is hrr*/
    $query3 = mysqli_query($con,"SELECT * FROM company WHERE name = '$username' && cid = '$passwrd'");            /* checks if user is company*/

    
    $rowCount1 = mysqli_num_rows($query1);
    $rowCount2 = mysqli_num_rows($query2);
    $rowCount3 = mysqli_num_rows($query3);

  
    if($rowCount1 == true ){
        header("Location: endUser/endUserHome.php");
    }elseif($rowCount2 == true){
        setcookie("username",$username,time() + (86400 * 30));   /* available for 30 days */
        header("Location: hrr/hrrHome.php");
    }elseif($rowCount3 == true){
        setcookie("name",$username,time() + (86400 * 30));   /* available for 30 days */
        header("Location: company/companyHome.php");
    }else{
        echo "username or password is wrong";
        die();
    }

    
    
}



?>




<!DOCTYPE html>
<html>

<head>
    <title>dutyCalls/login</title>
</head>

<body>
    <h2> Login </h2>
    <form method="POST">

        <label for="username">Username: *</label>
        <input type="text" name="username" required> <br>

        <label for="pwd">Password: *</label>
        <input type="password" name="pwd" required><br>

        <button type="submit" name="submit"> Login </button>

    </form>

</body>

</html>