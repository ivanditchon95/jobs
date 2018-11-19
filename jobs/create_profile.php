<?php 

include 'user.php';
$obj = new User();

if(isset($_POST['submit'])){
    $obj->cleanText($_POST['firstname']);
    $obj->cleanText($_POST['middlename']);
    $obj->cleanText($_POST['lastname']);
    $obj->cleanText($_POST['username']);
    $obj->cleanText($_POST['emailaddress']);
    $obj->cleanText($_POST['password']);
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $emailaddress = $_POST['emailaddress'];
    $password = $_POST['password'];
    $obj->applicantRegistration($firstname, $middlename, $lastname, $username, $emailaddress, $password);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <title>Create profile</title>
</head>
<body>
    <div class="container">
        <?php 
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
        }
        ?>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <a href="index.php" style="float: right; text-decoration: none;">Home</a>
            <form action="#" method="POST">
                <div class="panel" style="border: 1px solid #ffc60a; margin-top: 30px;">
                    <div class="panel-heading" style="background-color: #ffc60a;"><strong>Personal information</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="firstname">Firstname:</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="middlename">Middlename:</label>
                                <input type="text" name="middlename" id="middlename" class="form-control" value="<?php echo isset($_POST['middlename']) ? $_POST['middlename'] : ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="lastname">Lastname:</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading" style="background-color: #ffc60a;"><strong>Account</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="emailaddress">Emailaddress:</label>
                                <input type="text" name="emailaddress" id="emailaddress" class="form-control" value="<?php echo isset($_POST['emailaddress']) ? $_POST['emailaddress'] : ''; ?>"" required>
                            </div>
                            <div class="col-md-4">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"" required>
                            </div>
                            <div class="col-md-4">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                        <div class="row" style="text-align: center; font-family: fira code; margin-top: 20px; margin-bottom: 20px;">
                            <button name="submit" class="btn btn-primary" style="text-align: center;">Register</button>
                        </div>
                    <div class="panel-footer">
                        <i><center>Applicant registration 2018</center></i>
                    </div>   
                </div>
            </form>
        </div>
    </div>
</body>
</html>