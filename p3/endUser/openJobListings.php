<?php

$con = mysqli_connect("localhost", "root", "", "dutycalls");

/* query retrieves "open jobs" which means duration not end yet */
$openJobs = "SELECT job_posting.description,job_posting.phone,job_posting.openingdate,job_posting.contract_type ,(DATE_ADD(job_posting.openingdate, INTERVAL job_posting.duration DAY) < CURRENT_DATE) `openjob`
            from job_posting 
            where (DATE_ADD(job_posting.openingdate, INTERVAL job_posting.duration DAY) < CURRENT_DATE) = 0  
            ORDER BY `job_posting`.`openingdate` DESC";

$openJobsRes = mysqli_query($con,$openJobs);
$rowCount = mysqli_num_rows($openJobsRes);

?>

<!DOCTYPE html>
<html>

<head>
    <title>dutyCalls/Open Job Postings</title>
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
            for ($i = 1; $i <= $rowCount; $i++) {      /* loop retrieves all job postings */

                $row = mysqli_fetch_array($openJobsRes);


            ?>
                <tr>
                    <td><?php echo $row['description'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td><?php echo $row['openingdate'] ?></td>
                    <td><?php echo $row['contract_type'] ?></td>
                </tr>
            <?php
            }
            ?>

        </table>

    </form>
</body>

</html>