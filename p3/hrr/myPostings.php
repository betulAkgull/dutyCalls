<?php


$con = mysqli_connect("localhost", "root", "", "dutycalls");

$hrrUsername = $username = $_GET['name'];

$hrrListings = "SELECT description,phone,openingdate,contract_type,hrr_username FROM job_posting WHERE hrr_username = '$hrrUsername'";
$hrrListingsRes = mysqli_query($con,$hrrListings);
$rowCount1 = mysqli_num_rows($hrrListingsRes);

?>


<!DOCTYPE html>
<html>

<head>
    <title> DutyCalls / HRRpostings</title>
</head>

<body>



<table border="1px">

            <tr>
                <th> Job Description </th>
                <th> Company Phone Number </th>
                <th> Job Opening Date </th>
                <th> Job Contract Type </th>
                <th> Hrr Username </th>

            </tr>
            <?php
            for ($i = 1; $i <= $rowCount1; $i++) {      /* loop retrieves all job postings */

                $row1 = mysqli_fetch_array($hrrListingsRes);


            ?>
                <tr>
                    <td><?php echo $row1['description'] ?></td>
                    <td><?php echo $row1['phone'] ?></td>
                    <td><?php echo $row1['openingdate'] ?></td>
                    <td><?php echo $row1['contract_type'] ?></td>
                    <td><?php echo $row1['hrr_username'] ?></td>
                </tr>
            <?php
            }
            ?>

        </table>





</body>

</html>