<?php

$con = mysqli_connect("localhost", "root", "", "dutycalls");
$jid = $_GET['jid'];
$jobDes = $_GET['desc'];
$cid = $_GET['cid'];

$numberOfApplicants = "SELECT COUNT(username) as number FROM application WHERE jid = '$jid'";

$numberOfApplicantsres = mysqli_query($con, $numberOfApplicants);
$row = mysqli_fetch_array($numberOfApplicantsres);
$number = $row['number'];


?>


<html>


<head>
    <title> DutyCalls / Application Details </title>
</head>

<body>
 <h2><?php echo $jobDes .',' ?></h2>

 <ul>
 <li >Number Of Applicants: <strong> <?php echo $number?> </strong></li>
 <li> <a href="internDetails.php? jid=<?php echo $jid?>"> Applicants Details</a></li>
 
 </ul>
</body>



</html>