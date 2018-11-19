<?php

include 'user.php';
$obj = new User();

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
    <title>Employer details</title>
</head>
<body>
    <div class="header">
        <a href="#" style="font-size: 15px;">Welcome to administration area</a>
        <div class="header-right">
            <a href="admin_index.php" class="fa fa-home"> Home</a>
            <a href="#" class="fa fa-superpowers"> All jobs</a>
            <a href="employers_information.php" class="fa fa-users"> Employers information</a>
            <a href="applicants_information.php" class="fa fa-users" style="margin-top: 6px;"> Applicants information</a>
            <a href="admin_index.php?logout=logout" class="fa fa-sign-out">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-14">
            <form action="#" method="POST">
                <table class="table table-striped" style="border: 1px solid #cccccc;">
                    <tr>
                        <th>Job title</th>
                        <th>Job summary</th>
                        <th>Status</th>
                    </tr>
                    <?php 
                        $data = $obj->getAllJobs();
                        if(!empty($data)){
                            foreach($data AS $datas){    
                    ?>
                                <tr>
                                    <td class="col-md-3"><input type="" name="" class="form-control" value="<?php echo $datas['JOB_TITLE'] ?>" disabled></td>
                                    <td><textarea name="company_profile" id="company_profile" class="form-control" rows="20" disabled><?php echo $datas['JOB_SUMMARY'] ?></textarea></td>
                                    <td class="col-md-1"><input type="" name="" class="form-control" value="<?php echo $datas['status'] ?>" disabled></td>
                                </tr>
                            
                    <?php   
                            }
                        }
                        else{
                            echo "<td colspan='3'><div class='alert alert-danger' style='text-align: center;'>No entry</div></td>";
                        } 
                    ?>
                </table>
            </form>
        </div>
    </div>
</body>
</html>