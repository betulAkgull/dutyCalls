<?php
$con = mysqli_connect("localhost", "root", "", "dutycalls");
$jid = $_GET['jid'];
$cid = $_GET['cid'];


$query = "SELECT end_user.fname,end_user.lname,resumee,applyDate
FROM application,end_user 
WHERE jid = $jid AND end_user.username = application.username";



if (!empty($_POST['radio'])) {

    if ($_POST['radio'] == "emp") {

        $query .= " AND end_user.username  in (select distinct username from eu_employer)";
    } elseif ($_POST['radio'] == "unemp") {

        $query .= " AND end_user.username not in (select distinct username from eu_employer)";
    } elseif ($_POST['radio'] == "max") {
        $query = "SELECT DISTINCT end_user.fname,end_user.lname,resumee,applyDate
        from (select sum(endDate - beginDate) as exp, employment_history.username
                from employment_history
                group by username) as e,application,end_user
        where jid = $jid AND end_user.username = application.username AND e.exp >= all (select sum(endDate - beginDate) 
                            from employment_history 
                            group by employment_history.username)";
    } elseif ($_POST['radio'] == "otherapps") {
        $query = "SELECT username, count(*) AS numberOfApplications
        from application
        INNER JOIN job_posting ON job_posting.jid = application.jid
        WHERE job_posting.comp_cid=$cid
        group by username
        order by count(*) desc";
    } elseif ($_POST['radio'] == "longest") {
        $query = "SELECT end_user.fname,end_user.lname,resumee,applyDate
        FROM application,end_user 
        WHERE jid = $jid AND end_user.username = application.username AND end_user.username in (select username
        from eu_employer as e
        where e.beginDate = (select min(beginDate) from eu_employer))";
    }
}






?>


<html>

<head>


</head>

<body>



    <table border="1px">

        <tr>
            <?php
            if ($_POST['radio'] == "otherapps") {
                echo "<th> Username </th>";
                echo "<th> Number Of Applications </th>";
            } else {
                echo "<th> First Name </th>
                      <th> Last Name </th>
                      <th> Resume </th>
                      <th> Date Applied </th>";
            }

            ?>

        </tr>
        <?php

        $queryRes = mysqli_query($con, $query);
        $rowCount1 = mysqli_num_rows($queryRes);

        for ($i = 1; $i <= $rowCount1; $i++) {

            $row1 = mysqli_fetch_array($queryRes);


        ?>
            <tr>
                <?php

                if ($_POST['radio'] == "otherapps") {
                    echo "<td>" . $row1['username'] . "</td>";
                    echo "<td>" . $row1['numberOfApplications'] . "</td>";
                } else {
                    echo "<td>" . $row1['fname'] . "</td>";
                    echo "<td>" . $row1['lname'] . "</td>";
                    echo "<td>" . $row1['resumee'] . "</td>";
                    echo "<td>" . $row1['applyDate'] . "</td>";
                }

                ?>

            </tr>
        <?php
        }
        ?>

    </table>


</body>


</html>