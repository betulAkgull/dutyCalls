<?php
$con = mysqli_connect("localhost", "root", "", "dutycalls");

$compName = $_GET['name'];


$getCid = "SELECT cid FROM company WHERE name = '$compName'";
$getCidRes = mysqli_query($con,$getCid);
$row = mysqli_fetch_array($getCidRes);
$cid = $row['cid'];


$getHrrs = "SELECT DISTINCT fname,lname,hrr_username FROM hrr,job_posting 
INNER JOIN company ON job_posting.comp_cid = company.cid WHERE cid = $cid AND job_posting.hrr_username = hrr.username ORDER BY fname";

$getHrrsRes = mysqli_query($con, $getHrrs);
$rowCount = mysqli_num_rows($getHrrsRes);

?>


<!DOCTYPE html>
<html>

<head>
    <title> dutyCalls/ Company HRRs </title>
</head>

<body>
<table border="1px">

<tr>

<th> Hrr First Name </th>
<th> Hrr Last Name </th>
<th> Hrr Username </th>

</tr>

<?php
            for ($i = 1; $i <= $rowCount; $i++) {      /* loop retrieves all job postings */

                $row1 = mysqli_fetch_array($getHrrsRes);


            ?>
                <tr>
                    <td><?php echo $row1['fname'] ?></td>
                    <td><?php echo $row1['lname'] ?></td>
                    <td><?php echo $row1['hrr_username'] ?></td>
                   
                </tr>
            <?php
            }
            ?>


</table>
</body>

</html>