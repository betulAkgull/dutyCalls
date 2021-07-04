<!DOCTYPE html>
<html>

<head>
<title> dutyCalls / Company HomePage</title>
</head>

<body>

<h2>
    <?php

    if (isset($_COOKIE['name'])) {
        $name = $_COOKIE['name'];
        echo "hello, " . $name;
    }

    ?>
    </h2>


    <ul>
     <li><a href="displayHrr.php? name=<?php echo $name?>">Display Hrrs</a></li>
     <li><a href="displayCompanyPostings.php? name=<?php echo $name?>">Display Job Postings</a></li>
     <li><a href="displayInternshipPostings.php? name=<?php echo $name?>">Display Internship Postings</a></li>
    
    </ul>

</body>

</html>