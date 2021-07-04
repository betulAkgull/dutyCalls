<?php

$con = mysqli_connect("localhost", "root", "", "dutycalls");

/* query retrieves internship job postings with some attributes, from job posting wia jid */
$openInternshipQuery = "SELECT job_posting.description , job_posting.openingdate, job_posting.duration, job_posting.contract_type,
                    (DATE_ADD(job_posting.openingdate, INTERVAL job_posting.duration DAY) < CURRENT_DATE) `openjob`
                    FROM job_posting
                    INNER JOIN internshipjobposting ON job_posting.jid = internshipjobposting.jid
                    WHERE job_posting.jid IS NOT NULL and (DATE_ADD(job_posting.openingdate, INTERVAL job_posting.duration DAY) < CURRENT_DATE) = 0
                    ORDER BY job_posting.openingdate DESC";

$openInternshipRes = mysqli_query($con, $openInternshipQuery);
$rowCount = mysqli_num_rows($openInternshipRes);


?>


<!DOCTYPE html>
<html>

<head>
    <title> dutyCalls/OpenInternshipPostings</title>
</head>

<body>
    <form action="">


        <table border="1px">

            <tr>
                <th> Job Description </th>
                <th> Opening Date </th>
                <th> Contract Type </th>


            </tr>
            <?php
            for ($i = 1; $i <= $rowCount; $i++) {      /* loop retrieves all job postings */

                $row1 = mysqli_fetch_array($openInternshipRes);


            ?>
                <tr>
                    <td><?php echo $row1['description'] ?></td>
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