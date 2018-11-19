<?php 

include 'user.php';
$obj = new User();

if(isset($_POST['login'])){
    $obj->cleanText($_POST['username']);
    $obj->cleanText($_POST['password']);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $obj->logIn($username, $password);
}

if(isset($_POST['find_jobs'])){
    $category = $_POST['category'];
    $job_title = $_POST['job_title'];
    $location = $_POST['location'];
    $obj->findJobs($category, $job_title, $location);
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
    <title>Find jobs</title>
</head>
<body>
    <?php if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        }?>
    <div class="header">
        <a href="" class="fa fa-search" style="margin-top: 6px;"> Find Jobs</a>
        <a href="employer_reg.php" class="fa fa-users"> Employers/Post Jobs</a>
        <a href="create_profile.php" class="fa fa-user-plus"> Create profile/Account</a>
        <div class="header-right">
            <form action="#" method="POST">
                Username: <input type="text" name="username" required>
                Password: <input type="password" name="password" required>
                <button name="login">Login</button>
            </form>
        </div>
    </div>
    <div id="container">
        <div class="col-md-2"></div>
        <table>
            <tr>
                <td></td>
                <td><label for="">Category</label></td>
                <td><label for="">What</label></td>
                <td><label for="">Where</label></td>
            </tr>
            <tr>
                <form action="#" method="POST">
                    <td><a href=""><img src="img/logo.png" alt="" class="logo"></a></td>
                    <td><input type="text" name="category" class="form-control text1" placeholder="Category"></td>
                    <td><input type="text" name="job_title" class="form-control text1" placeholder="job title, keywords"></td>
                    <td><input type="text" name="location" class="form-control text2" placeholder="street, city"></td>
                    <td><button name="find_jobs" class="fa fa-search"> Find Jobs</button></td>
                </form>
            </tr>
            </table>
    </div>
    <div class="footer">
            <center><strong style="color:#b4bab9"><p>Like us on:</strong>&nbsp
            <a href=""><span class="fa fa-facebook"></span></a>&nbsp
            <a href=""><span class="fa fa-twitter"></span></a>&nbsp
            <a href=""><span class="fa fa-instagram"></span></a>&nbsp
            <a href=""><span class="fa fa-google-plus"></span></a>&nbsp
            <a href=""><span class="fa fa-steam"></span></a></p>
            Job Portal 2018</center>
            <a href="#" style="color: rgb(41, 41, 41);">FAQ's</a>-<a href="#" style="color: rgb(41, 41, 41);">About</a>-<a href="#" style="color: rgb(41, 41, 41);">Vission-Mission</a>-<a href="" style="color: rgb(41, 41, 41);">Help center</a>
            <i style="float:right;">JobBoard &copy;2018</i>
    </div>
</body>
</html>