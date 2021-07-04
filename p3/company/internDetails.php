<?php 

$con = mysqli_connect("localhost", "root", "", "dutycalls");
$jid = $_GET['jid'];



$query = "SELECT end_user.fname,end_user.lname,resumee,univ,program,gpa,standing,numDays,applyDate
FROM application,end_user 
WHERE jid = $jid AND end_user.username = application.username";

$queryRes =mysqli_query($con,$query);
$rowCount1 = mysqli_num_rows($queryRes);

?>


<html>

<head>
<title> DutyCalls / Applicants Details </title>
</head>

<body>


<table border="1px">

<tr>
    <th> First Name </th>
    <th> Last Name </th>
    <th> Resume </th>
    <th> University </th>
    <th> University Program </th>
    <th> GPA </th>
    <th> Standing</th>
    <th> Number of Days </th>
    <th> Date Applied </th>

</tr>
<?php
for ($i = 1; $i <= $rowCount1; $i++) {      

    $row1 = mysqli_fetch_array($queryRes);


?>
    <tr>
        <td><?php echo $row1['fname'] ?></td>
        <td><?php echo $row1['lname'] ?></td>
        <td><?php echo $row1['resumee'] ?></td>
        <td><?php echo $row1['univ'] ?></td>
        <td><?php echo $row1['program'] ?></td>
        <td><?php echo $row1['gpa'] ?></td>
        <td><?php echo $row1['standing'] ?></td>
        <td><?php echo $row1['numDays'] ?></td>
        <td><?php echo $row1['applyDate'] ?></td>
    </tr>
<?php
}
?>

</table>
    
</body>


</html>