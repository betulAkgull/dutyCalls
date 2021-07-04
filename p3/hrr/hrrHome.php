


<!DOCTYPE html>
<html>

<head>
<title>dutyCalls/HRR HomePage</title>
</head>

<body>

     <h2>
    <?php

    if (isset($_COOKIE['username'])) {
        $username = $_COOKIE['username'];
        echo "hello, " . $username;
    }

    ?>
    </h2>


    <ul>
    <li> <a href="createJobPosting.php? name=<?php echo $username ?>"> Create Job Posting </a></li>
    <li> <a href="myPostings.php? name=<?php echo $username ?>"> Display My Postings </a></li>
    
    </ul>

</body>

</html>