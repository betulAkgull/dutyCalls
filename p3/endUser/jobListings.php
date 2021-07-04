<?php

$con = mysqli_connect("localhost", "root", "", "dutycalls");


$jobPostings = "SELECT description,salary,phone,openingdate,contract_type FROM job_posting ORDER BY openingdate DESC";
$jobPostingsRes = mysqli_query($con, $jobPostings);
$rowCount1 = mysqli_num_rows($jobPostingsRes);

?>





<!DOCTYPE html>
<html>

<head>
    <title> dutyCalls/AllJobPostings</title>
</head>

<body>
    <form action="">


        <table border="1px">

            <tr>
                <th> Job Description </th>
                <th> Company Phone Number </th>
                <th> Job Opening Date </th>
                <th> Job Contract Type </th>

            </tr>
            <?php
            for ($i = 1; $i <= $rowCount1; $i++) {      /* loop retrieves all job postings */

                $row1 = mysqli_fetch_array($jobPostingsRes);


            ?>
                <tr>
                    <td><?php echo $row1['description'] ?></td>
                    <td><?php echo $row1['phone'] ?></td>
                    <td><?php echo $row1['openingdate'] ?></td>
                    <td><?php echo $row1['contract_type'] ?></td>
                </tr>
            <?php
            }
            ?>

        </table>

    </form>
</body>

</html>