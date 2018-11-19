<?php

include 'user.php';
$obj = new User();

$id = $_GET['id'];
$sql = "SELECT employer.COMPANY_NAME AS company_name, employer.COMPANY_PROFILE AS company_profile, employer.CONTACT_NUMBER AS contact_number, accounts.EMAILADDRESS AS emailaddress, location.STREET AS street, accounts.USERNAME AS username, accounts.PASSWORD AS password, location.CITY AS city FROM employer INNER JOIN accounts ON employer.ACCOUNT_ID = accounts.ACCOUNT_ID INNER JOIN location ON employer.LOCATION_ID = location.LOCATION_ID WHERE ID = '$id'";
$query = $obj->getConnection()->query($sql);
$numRows = $query->num_rows;
if($numRows > 0){
    $row = $query->fetch_assoc();
    $company_name = $row['company_name'];
    $company_profile = $row['company_profile'];
    $contact_number = $row['contact_number'];
    $emailaddress = $row['emailaddress'];
    $street = $row['street'];
    $city = $row['city'];
    $username = $row['username'];
    $password = $row['password'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <title>Employer details</title>
</head>
<body>
    <div class="container">
        <a href="employers_information.php" style="float: right; margin-bottom: 20px;">Back</a>
        <div class="col-md-1"></div>
        <div class="col-md-14">
            <form action="#" method="POST">
                <div class="panel" style="border: 1px solid #ffc60a; margin-top: 30px;">
                    <div class="panel-heading" style="background-color: #ffc60a;"><strong>Company information</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="company_name">Company name:</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo $company_name ?>" disabled>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <label for="company_profile">Company profile:</label>
                                <textarea name="company_profile" id="company_profile" class="form-control" rows="20" disabled><?php echo $company_profile ?></textarea>
                            </div>
                            <div class="col-md-2">
                                <label for="contact_number">Contact number:</label>
                                <input type="text" name="contact_number" class="form-control" id="contact_number" value="<?php echo $contact_number ?>" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="emailaddress">Emailaddress:</label>
                                <input type="text" name="emailaddress" id="emailaddress" class="form-control" value="<?php echo $emailaddress ?>" disabled>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                    <div class="panel-heading" style="background-color: #ffc60a;"><strong>Location</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="street">Street:</label>
                                <input type="text" name="street" id="street" class="form-control" value="<?php echo $street ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="city">City:</label>
                                <input type="text" name="city" id="city" class="form-control" value="<?php  echo $city ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading" style="background-color: #ffc60a;"><strong>Account</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="password">Password:</label>
                                <input type="text" name="password" id="password" class="form-control" value="<?php echo $password ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                    </div>   
                </div>
            </form>
        </div>
    </div>
</body>
</html>