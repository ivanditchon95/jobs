<?php 

include_once 'user.php';
$obj = new User();

if(isset($_POST['submit'])){
    $obj->cleanText($_POST['company_name']);
    $obj->cleanText($_POST['company_profile']);
    $obj->cleanText($_POST['emailaddress']);
    $obj->cleanText($_POST['contact_number']);
    $obj->cleanText($_POST['street']);
    $obj->cleanText($_POST['city']);
    $obj->cleanText($_POST['username']);
    $obj->cleanText($_POST['password']);

    $company_name = $_POST['company_name'];
    $company_profile = $_POST['company_profile'];
    $company_profile1 = nl2br($company_profile);
    $emailaddress = $_POST['emailaddress'];
    $contact_number = $_POST['contact_number'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobilenumber_validation = "/^[0-9]+$/";

    $obj->employerRegistration($company_name, $company_profile1, $emailaddress, $contact_number, $street, $city, $username, $password, $mobilenumber_validation);

    /**$sql = "SELECT * FROM accounts WHERE EMAILADDRESS = '$_POST[emailaddress]' AND USERNAME = '$_POST[username]'";
    $qry = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($qry);
    
    if($num_rows > 0){
        echo "<script>alert('Username or emailaddress is already exist')</script>";
    }
    else if(!filter_var($_POST['emailaddress'], FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid email format')</script>";
    }
    else if(!preg_match($contact_number_validation, $_POST['contact_number'])){
        echo "<script>alert('Invalid contact number format')</script>";
    }
    else if(!(strlen($_POST['contact_number'])==11)){
        echo "<script>alert('Contact number atleast 11 digits')</script>";
    }
    else{
        $account_sql = "INSERT INTO `accounts`(`ACCOUNT_ID`, `ACCOUNT_TYPE`, `EMAILADDRESS`, `USERNAME`, `PASSWORD`) 
        VALUES (NULL,'EMPLOYER','$_POST[emailaddress]','$_POST[username]','$_POST[password]')";
        $accout_qry = mysqli_query($con, $account_sql);
        $_SESSION['account_id'] = mysqli_insert_id($con);
        $account_id = $_SESSION['account_id'];
        $location_sql = "INSERT INTO `location`(`LOCATION_ID`, `STREET`, `CITY`) VALUES (NULL,'$_POST[street]','$_POST[city]')";
        $location_qry = mysqli_query($con, $location_sql);
        $_SESSION['location_id'] = mysqli_insert_id($con);
        $location_id = $_SESSION['location_id'];
        $employer_sql = "INSERT INTO `employer`(`ID`, `ACCOUNT_ID`, `LOCATION_ID`, `COMPANY_NAME`, `CONTACT_NUMBER`) 
        VALUES (NULL,'$account_id','$location_id','$_POST[company_name]','$_POST[contact_number]')";
        $employer_qry = mysqli_query($con, $employer_sql);
        if($accout_qry && $location_qry && $employer_qry == TRUE){
            echo "<script>alert('Successfully register')</script>";
        }
        else{
            return FALSE;
        }
    }
}*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <title>Employers registration</title>
</head>
<body>
    <div class="container">
        <div class="col-md-1"></div>
        <a href="index.php" style="float: right; text-decoration: none;">Home</a>
        <div class="col-md-14">
            <?php if($_SESSION['msg']){
                echo $_SESSION['msg'];
            }?>
            <form action="#" method="POST">
                <div class="panel" style="border: 1px solid #ffc60a; margin-top: 30px;">
                    <div class="panel-heading" style="background-color: #ffc60a;"><strong>Information</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="company_name">Company name:</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo isset($_POST['company_name']) ? $_POST['company_name'] : ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="emailaddress">Emailaddress:</label>
                                <input type="text" name="emailaddress" id="emailaddress" class="form-control" value="<?php echo isset($_POST['emailaddress']) ? $_POST['emailaddress'] : ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="contact_number">Contact number:</label>
                                <input type="text" name="contact_number" id="contact_number" class="form-control" value="<?php echo isset($_POST['contact_number']) ? $_POST['contact_number'] : ''; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="company_profile">Company profile:</label>
                                <textarea name="company_profile" class="form-control" rows="10" style="text-indent: 0;" required>
                                    <?php echo isset($company_profile1) ? $company_profile1 : ''; ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading" style="background-color: #ffc60a;"><strong>Location</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="street">Street:</label>
                                <input type="text" name="street" id="street" class="form-control" value="<?php echo isset($_POST['street']) ? $_POST['street'] : ''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="city">City:</label>
                                <input type="text" name="city" id="city" class="form-control" value="<?php  echo isset($_POST['city']) ? $_POST['city'] : ''; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading" style="background-color: #ffc60a;"><strong>Account</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
                            </div>
                        </div>
                        <div class="row" style="text-align: center; font-family: fira code; margin-top: 20px;">
                            <button name="submit" class="btn btn-primary" style="text-align: center;">Register</button>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <i><center>Employers registration 2018</center></i>
                    </div>   
                </div>
            </form>
        </div>
    </div>
</body>
</html>