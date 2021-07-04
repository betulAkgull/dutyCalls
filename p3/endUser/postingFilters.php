<?php

$con = mysqli_connect("localhost", "root", "", "dutycalls");

$companyList = "SELECT DISTINCT name FROM company";
$companyListRes = mysqli_query($con, $companyList);
$rowCount = mysqli_num_rows($companyListRes);


?>


<!DOCTYPE html>
<html>

<head>
    <title> dutyCalls/Spesific Filters</title>
</head>

<body>
    <form method="POST" action="filterResult.php">

        <h3> Please Select Job Title *</h3>
        <input type="radio" name="job"  value="manager" >Manager Job<br><br>

        <input type="radio" name="job" value="intern">Internship Job<br><br>

        <input type="radio" name="job"  value="jobPosting">All Jobs<br><br>

        <h3>To see Open Postings </h3>
        <input type="radio" name="open" value="open">Open Job<br><br>
        
        <h3> Sort Job Postings by Salary </h3>
        Salary Listing:
        <ul>
            <li><input type="radio" name="salary" value="high-to-low">High-to-Low
            <li><input type="radio" name="salary" value="low-to-high">Low-to-High
            
        </ul>

        <br>
        <h3>  Select Manager Job's Department Size  </h3>
        Department Size: <br>
        <input type="range" name="range" min="0" max="50" oninput="this.nextElementSibling.value = this.value">
        <output></output>
    
        <br><br>
        <h3>  Select Company Location  </h3>
        Location: <br>
        <input type="search" name="location">
        <br>
        
        <h3>  Select Company </h3>
        Company: <br>
        <select name="company">
            <option value=""> Select From Company List </option>
            <?php
            for ($i = 1; $i <= $rowCount; $i++) {
                $row = mysqli_fetch_array($companyListRes);
                $compName = $row['name'];
                echo  "<option value='$compName'>$compName</option>";
            }

            ?>

        </select>

        <h3>  Select Contract Type </h3>
        
        <input type="radio" name="type" value="PT"> Part-Time <br><br>
        <input type="radio" name="type" value="FT"> Full-Time <br><br>

        <button type="reset" style="width: 100px;"  >Clear</button>
        <button type="$_POST" name="filter" style="width: 100px;">Filter</button>
        
    </form>
    
</body>

</html>
