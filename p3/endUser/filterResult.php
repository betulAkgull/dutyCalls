<?php

/* because of no error handling, returns error when 'open manager/internship jobs'   */
$con = mysqli_connect("localhost", "root", "", "dutycalls");


if (isset($_POST['job'])) {
    $tableName = "";
    if (($_POST['job']) == "manager") {

        $query = "SELECT  deptName,deptSize,description,name,address,
        openingdate,contract_type,salary  
        FROM job_posting,company,manager_job_posting
        WHERE job_posting.comp_cid = company.cid 
        AND manager_job_posting.jid = job_posting.jid";

        $tableName == "manager_job_posting";
        echo $tableName;
    } elseif (($_POST['job']) == "intern") {

        $query = "SELECT  minnumDays,description,name,address,openingdate,contract_type,salary
        FROM job_posting,company,internshipjobposting
        WHERE job_posting.comp_cid = company.cid 
        AND internshipjobposting.jid = job_posting.jid";

        $tableName == "internshipjobposting";
        echo $tableName;
    } elseif (($_POST['job']) == "jobPosting") {

        $query = "SELECT description,name,address,openingdate,contract_type,salary
        FROM job_posting,company
        WHERE job_posting.comp_cid = company.cid ";
        $tableName == "job_posting";
        echo $tableName;
    }
} else {
    echo "please select job title";
    die();
}



if (!empty($_POST['open'])) {
    $query .= "AND ((DATE_ADD(openingdate, INTERVAL duration DAY) < CURRENT_DATE) = 0)";
}


if (!empty($_POST['location'])) {
    $compAddress = $_POST['location'];
    $query  .=  " AND address LIKE '%$compAddress%'";
}


if (!empty($_POST['company'])) {

    $compName =  $_POST['company'];
    $query  .=  " AND name = '$compName'";
}

if (!empty($_POST['type'])) {

    if ($_POST['type'] == "PT") {
        $contractType = "PT";
        $query .= "AND contract_type = '$contractType'";
    } elseif ($_POST['type'] == "FT") {
        $contractType = "FT";
        $query .= "AND contract_type = '$contractType'";
    }
}


if (($_POST['job']) == "manager") {

    if (!empty($_POST['range'])) {

        $deptSize = $_POST['range'];
        $query  .= " AND deptSize <= $deptSize";
    }
}

if (!empty($_POST['salary'])) {

    if ($_POST['salary'] == "low-to-high") {
        $sort = "ASC";
        $query  .=  " ORDER BY salary $sort";
    } elseif ($_POST['salary'] == "high-to-low") {
        $sort = "DESC";
        $query  .=  " ORDER BY salary $sort";
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>dutyCalls/Filter Result</title>
</head>

<body>
    <h2>Select Filters</h2>

    <table border="1px">





        <tr>
            <?php

            switch (($_POST['job'])) {
                case "manager":
                    echo "<th> Department Name </th>";
                    echo "<th> Department Size </th>";
                    break;
                case "intern";
                    echo "<th> Minimum Days </th>";
                    break;
            }

            ?>


            <th> Job Description </th>
            <th> Company Name </th>
            <th> Company Address </th>
            <th> Job Opening Date </th>
            <th> Job Contract Type </th>
            <th> Salary </th>


        </tr>



        <?php

        $queryRes = mysqli_query($con, $query);
        $rowCount1 = mysqli_num_rows($queryRes);
        
       


        for ($i = 1; $i <= $rowCount1; $i++) {

            $row1 = mysqli_fetch_array($queryRes);


        ?>



            <tr>
                <?php

                switch (($_POST['job'])) {
                    case "manager":
                        echo "<td>" . $row1['deptName'] . "</td>";
                        echo "<td>" . $row1['deptSize'] . "</td>";
                        break;
                    case "intern";
                        echo "<td>" . $row1['minnumDays'] . "</td>";
                        break;
                }

                ?>


                <td><?php echo $row1['description'] ?></td>
                <td><?php echo $row1['name'] ?></td>
                <td><?php echo $row1['address'] ?></td>
                <td><?php echo $row1['openingdate'] ?></td>
                <td><?php echo $row1['contract_type'] ?></td>
                <td><?php echo $row1['salary'] ?></td>


            </tr>
        <?php
        }


        ?>
    </table>




</body>


</html>

