<?php

$con = mysqli_connect("localhost", "root", "", "dutycalls");
$jid = $_GET['jid'];
$cid = $_GET['cid'];

?>


<html>

<head>
    <title> DutyCalls / Applicant Filters </title>
</head>

<body>
    <h2> Filter Applicants</h2>

    <form action="appFiltersRes.php? jid=<?php echo $jid ?> & cid=<?php echo $cid ?>" method="POST">


        <ul>

            <li><strong>Select Employed or Unemployed Applicants</strong> <br>
                <input type="radio" name="radio" value="emp"> Employed <br>
                <input type="radio" name="radio" value="unemp"> Unemployed <br>
            </li><br>
            <li><input type="radio" name="radio" value="max"><strong>Display Max Experience Level</strong> </a><br></li> <br>
            <li><input type="radio" name="radio" value="otherapps"><strong>Display Applicant's Other Applications</strong></a><br></li><br>  <!-- applicants other applications in the COMPANY -->
            <li><input type="radio" name="radio" value="longest"><strong>Display by Longest Working Period </strong></a><br></li><br>

        </ul>

        <input type="submit" name="submit" value="Filter">
    </form>
</body>



</html>