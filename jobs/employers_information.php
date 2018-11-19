<?php 

include 'user.php';
$obj = new User();

if(isset($_GET['employer_id'])){
    $employer_id = $_GET['employer_id'];
    $obj->deleteEmployer($employer_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employers Information</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/default.css">
    <link rel="icon" type="image/png" href="img/glass2.jpg">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.delete_data').click(function(){
                var employer_id = $(this).attr('id')
                if(confirm('Are you sure you want to delete this?')){
                    window.location = 'employers_information.php?employer_id='+employer_id;
                }
                else{
                    return false;
                }
            })
        });
    </script>
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
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <?php if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
        } ?>
        <table class="table table-striped" style="border: 1px solid #cccccc;">
            <tr>
                <th>Company name</th>
                <th>Jobs</th>
                <th>Employer informations</th>
                <th>Action</th>
            </tr>
            <?php
            $data = $obj->getEmployerDetails();
            if(!empty($data)){   
                foreach ($data as $datas) { ?>
                    <tr>
                        <td><?php echo $datas['COMPANY_NAME'] ?></td>
                        <td>
                            <a href="job_details.php?employer_id=<?php echo $datas['ID'] ?>"><button class="btn btn-primary"><span class="glyphicon glyphicon-folder-open"></span>  &nbspView jobs</button></a>
                        </td>
                        <td>
                            <a href="employer_details.php?id=<?php echo $datas['ID'] ?>"><button class="btn btn-primary"><span class="glyphicon glyphicon-folder-open"></span>  &nbspView informations</button></a> <a href="update_employer_info.php?id=<?php echo $datas['ID'] ?>"><button class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span>  &nbspEdit</button></a> 
                        </td>
                        <td><a href="#" class="delete_data" id="<?php echo $datas['ID'] ?>"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>  &nbspDelete</button></a></td>
                    </tr>             
    <?php       }
            }
            else{
                echo "<td colspan='4'><div class='alert alert-danger' style='text-align: center;'>No entry</div></td>";
            }
          ?>
        </table>
    </div>
</body>
</html>

