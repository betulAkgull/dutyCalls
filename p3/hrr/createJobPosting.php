<?php

$con = mysqli_connect("localhost", "root", "", "dutycalls");

$hrrUsername = $username = $_GET['name'];


$companyCids = "SELECT cid,name FROM company";
$companyCidsRes = mysqli_query($con, $companyCids);
$rowCount = mysqli_num_rows($companyCidsRes);





if (isset($_POST['submit'])) {

    $jid = $_POST['jid'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];
    $phone = $_POST['phone'];
    $numOpenings = $_POST['numOpenings'];
    $hrrUsername = $username = $_GET['name']; /* gets from prev page by cookie */
    $openingdate = $_POST['openingdate'];
    $duration = $_POST['duration'];
    $comp_cid = $_POST['comp_cid'];
    $is_manOrIntern = $_POST['is_manOrIntern'];
    $contract_type = $_POST['contract_type'];

    $queryJid = "SELECT jid FROM job_posting WHERE jid = $jid";   /* unique jid check */
    $queryJidRes = mysqli_query($con, $queryJid);
    $rowCountJid = mysqli_num_rows($queryJidRes);

    if ($rowCountJid == false) {              /* if jid is not used */


        if ($is_manOrIntern == "1") {   /* manager jobs cant be part-time */
            $contract_type = "FT";

            $query = "INSERT INTO job_posting(jid,description, salary, phone, numOpenings, hrr_username, openingdate, duration, comp_cid,
                   is_manOrIntern, contract_type)
                   VALUES ('$jid', '$description','$salary', '$phone', '$numOpenings','$username', '$openingdate', '$duration','$comp_cid','$is_manOrIntern','$contract_type')";

            mysqli_query($con, $query);

            echo "job posting has submitted";
            die();
        } elseif ($is_manOrIntern == "0") {
            $query = "INSERT INTO job_posting(jid,description, salary, phone, numOpenings, hrr_username, openingdate, duration, comp_cid,
        is_manOrIntern, contract_type)
        VALUES ('$jid', '$description','$salary', '$phone', '$numOpenings','$username', '$openingdate', '$duration','$comp_cid','$is_manOrIntern','$contract_type')";

            mysqli_query($con, $query);

            echo "job posting has submitted";
            die();
        }
    } else {
        echo "jid is used please select a different jid";
        die();
    }
}








?>

<!DOCTYPE html>
<html>

<head>
    <title>dutyCalls/ Create Job Posting</title>
</head>

<body>
    <h2> Create New Job Posting </h2> <br>
    <form method="POST">

        <ul>
            <li>
                Enter Job Id *:
                <input type="number" name="jid" min="0" maxlength="11" required> <!-- check if jid is used or not -->
            </li><br>
            <li>
                Enter Job Description: <br>
                <input type="text" name="description" style="height: 70px; width:200px;">
            </li><br>
            <li>
                Enter Job Salary:
                <!-- turn this into float -->
                <input type="number" name="salary" step="any" min="0">
            </li><br>
            <li>
                Enter Job Phone:
                <!-- turn this into float -->
                <input type="number" name="phone" step="any" minlength="10">
            </li><br>
            <li>
                Enter Number of Openings:
                <input type="number" name="numOpenings" min="1" maxlength="11">
            </li><br>
            <li>
                Enter Job Opening Date:
                <input type="date" name="openingdate">
            </li><br>
            <li>
                Enter Duration:
                <input type="number" name="duration" min="0" maxlength="11">
            </li><br>
            <li>
                Enter Company Cid *:
                <select name="comp_cid" required>
                    <option value=""> Select From Company List </option>
                    <?php
                    for ($i = 1; $i <= $rowCount; $i++) {
                        $row = mysqli_fetch_array($companyCidsRes);
                        $compcid = $row['cid'];
                        $compName = $row['name'];
                        echo  "<option value='$compcid'>$compcid , $compName</option>";
                    }

                    ?>

                </select>
            </li><br>
            <li>
                Is Manager Job: <br>
                <input type="radio" name="is_manOrIntern" value="1"> Yes <br> <!-- manager jobs cant be part time -->
                <input type="radio" name="is_manOrIntern" value="0"> No
            </li><br>
            <li>
                Select Contract Type: <br>
                <input type="radio" name="contract_type" value="PT"> Part Time <br>
                <input type="radio" name="contract_type" value="FT"> Full Time

            </li>


        </ul>
        <button type="reset" style="color: red;" >Clear</button>
        <button type="submit" name="submit"> Submit </button>

    </form>

</body>

</html>