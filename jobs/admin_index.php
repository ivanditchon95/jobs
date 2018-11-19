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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/default.css">
    <link rel="icon" type="image/png" href="img/glass2.jpg">
    <title>Home</title>
</head>
<body>
    <div class="header">
        <a href="#" style="font-size: 15px;">Welcome to administration area</a>
        <div class="header-right">
            <a href="admin_index.php" class="fa fa-home"> Home</a>
            <a href="all_jobs.php" class="fa fa-superpowers"> All jobs</a>
            <a href="employers_information.php" class="fa fa-users"> Employers information</a>
            <a href="applicants_information.php" class="fa fa-users" style="margin-top: 6px;"> Applicants information</a>
            <a href="admin_index.php?logout=logout" class="fa fa-sign-out">Logout</a>
        </div>
    </div>
</body>
</html>