<?php 

include 'user.php';
$obj = new User();

if(isset($_GET['logout'])){
    $obj->logOut();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/glass2.jpg">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <a href="employer_jobs.php">MyJobs</a>
        <a href="employer_post_jobs.php">PostJobs</a>
        <a href="employer_applicants.php">Applicants</a>
        <a href="employer_account.php">My account</a>
        <a href="admin_index.php?logout=logout" style="float: right;">Logout</a>
    </div>
</body>
</html>