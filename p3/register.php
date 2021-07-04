<?php

$con = mysqli_connect("localhost", "root", "", "dutycalls");



if (isset($_POST["submit"])) {
  $cname = $_POST["cname"];
  $cid = $_POST["cid"];
  $caddr = $_POST["caddr"];
  $cphone = $_POST["cphone"];
  $stat = $_POST["stat"];
  $username = $_POST["username"];
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $passwrd = $_POST["passwrd"];



  if (!empty($cname) && !empty($cid)) /* checks if registered user is a company */ {
    registerCompany($con, $cid, $cname, $caddr, $cphone);
  } else {
    if (!empty($stat)) {
      registerEndUser($con, $stat, $username, $passwrd, $email, $fname, $lname); /* if user entered military status then he/she is an enduser */
    } else {
      registerHRR($con, $username, $passwrd, $email, $fname, $lname);
    }
  }
}




function registerCompany($con, $cid, $cname, $caddr, $cphone)
{

  $uniqueIdQuery = "SELECT * FROM company WHERE cid = '$cid'";  /* checks if cid is used */
  $Idresult = mysqli_query($con, $uniqueIdQuery);
  $rowCount1 = mysqli_num_rows($Idresult);

  if ($rowCount1 == false) {            /* if id is not used */

    $companyQuery = "INSERT INTO company(cid,name,address,phone) values ('$cid','$cname','$caddr','$cphone')";
    mysqli_query($con, $companyQuery);
    echo "company has registered";
    header("Location: company/companyHome.php");    /* direct to company homepage */
    die();
  } else {
    echo "id you entered is used please try different id";
  }
}


function registerEndUser($con, $stat, $username, $passwrd, $email, $fname, $lname)
{


  $uniqueUserName = "SELECT * FROM end_user WHERE username = '$username'";   /* checks if username is used*/
  $userNameResult = mysqli_query($con, $uniqueUserName);
  $rowCount2 = mysqli_num_rows($userNameResult);

  if ($rowCount2 != true) {          /* if username is not used*/
    $endUserQuery = "INSERT INTO end_user(username,passwrd,fname,lname,military_service_stat) values ('$username','$passwrd','$fname','$lname','$stat')";
    mysqli_query($con, $endUserQuery);
    $endUserMail = "INSERT INTO eu_emails(username,email) values ('$username','$email')";
    mysqli_query($con, $endUserMail);
    echo "user has registered";
    header("Location: endUser/endUserHome.php");   /* direct to end_user homepage*/
    die();
  } else {
    echo "username is used please try different username";
  }
}

function registerHRR($con, $username, $passwrd, $email, $fname, $lname)
{


  $uniqueHRRuserName = "SELECT * FROM hrr WHERE username = '$username'"; /* checks if hrr username is used */
  $hrrResult = mysqli_query($con, $uniqueHRRuserName);
  $rowCount3 = mysqli_num_rows($hrrResult);

  if ($rowCount3 == false) {   /* if hrr username is not used */

    $hrrQuery = "INSERT INTO hrr(username,passwrd,email,fname,lname,endUser_username) values('$username','$passwrd','$email','$fname','$lname',NULL)";
    mysqli_query($con, $hrrQuery);
    echo "hrr has registered"; 
    header("Location: hrr/hrrHome.php");  /* directs to hrr homepage */
    die();
  } else {
    echo "username is used please try different username";
  }
}


?>









<!DOCTYPE html>
<html>

<head>
  <title> dutycalls/register </title>


</head>

<body>

  <h2> Register to DutyCalls ! </h2>

  <form method="POST">

    <label for="username">Username: </label><br>
    <input type="text" name="username">
    <br>

    <label for="fname">First name: </label><br>
    <input type="text" name="fname"><br>

    <label for="lname">Last name: </label><br>
    <input type="text" name="lname">
    <br>
    <label for="email">Email: </label><br>
    <input type="email" id="email" name="email">
    <br>

    <label for="pwd">Password: </label><br>
    <input type="password" name="passwrd" minlength="8">
    <br>

    <h3> select your military status </h3>
    <input type="radio" name="stat" value="C"> Completed
    <input type="radio" name="stat" value="D"> Delayed
    <input type="radio" name="stat" value="E"> Exempt
    <br><br>


    <h2>If you are a company, fill up here</h2>

    <label for="cname"> Company Name: </label><br>
    <input type="text" name="cname"><br>

    <label for="caddr"> Company Address: </label><br>
    <input type="text" name="caddr"><br>

    <label for="cphone"> Company Phone: </label><br>
    <input type="text" name="cphone"><br>

    <label for="cid"> Company Id: </label><br>
    <input type="text" name="cid"><br>


    <button type="submit" name="submit" value="submit"> Register </button>
  </form>



</body>



</html>