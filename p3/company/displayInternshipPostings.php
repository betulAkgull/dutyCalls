<?php 

$con = mysqli_connect("localhost", "root", "", "dutycalls");
$compName = $_GET['name'];

$getCid = "SELECT cid FROM company WHERE name = '$compName'";
$getCidRes = mysqli_query($con,$getCid);
$row = mysqli_fetch_array($getCidRes);
$cid = $row['cid'];


$getInternJobs = "SELECT description,hrr_username,openingdate,contract_type,job_posting.jid 
                  FROM internshipjobposting,job_posting 
                  INNER JOIN company ON job_posting.comp_cid = company.cid 
                  WHERE cid = $cid AND job_posting.jid = internshipjobposting.jid
                  ORDER BY description";


$getInternJobsRes = mysqli_query($con,$getInternJobs);
$rowCount = mysqli_num_rows($getInternJobsRes);

 ?>


<!DOCTYPE html>
<html>

<head>
    <title> dutyCalls/ Internship Postings </title>
</head>

<body>
<table border="1px">

<tr>

<th> Job Description </th>
<th> Hrr Username </th>
<th> Opening Date </th>
<th> Contract Type</th>


</tr>

<?php
            for ($i = 1; $i <= $rowCount; $i++) {      /* loop retrieves all job postings */

                $row1 = mysqli_fetch_array($getInternJobsRes);


            ?>
                <tr>
                    
                    <td><a href="InternshipPostingDetails.php? jid=<?php echo $row1['jid'] ?> & desc=<?php echo $row1['description'] ?>  & cid= <?php echo $cid ?>"><?php echo $row1['description'] ?></a></td>
                    <td><?php echo $row1['hrr_username'] ?></td>
                    <td><?php echo $row1['openingdate'] ?></td>
                    <td><?php echo $row1['contract_type'] ?></td>
                    
                </tr>
            <?php
            }
            ?>


</table>
</body>

</html>