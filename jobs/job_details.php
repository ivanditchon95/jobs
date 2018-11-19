<?php

include 'user.php';
$obj = new User();

if(isset($_GET['job_id'])){
    $job_id = $_GET['job_id'];
    $obj->deleteJob($job_id, $employer_id);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employer details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.delete_data').click(function(){
                var job_id = $(this).attr('id')
                if(confirm('Are you sure you want to delete this?')){
                    window.location = 'job_details.php?job_id='+job_id;
                }
                else{
                    return false;
                }
            })
        });
    </script>
</head>
<body>
    <div class="container">
        <a href="employers_information.php" style="float: right; margin-bottom: 20px;">Back</a>
        <div class="col-md-1"></div>
        <div class="col-md-14">
            <table class="table table-striped" style="border: 1px solid #cccccc;">
                <tr>
                    <th>Job title</th>
                    <th>Job summary</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                 <?php 
                    @$employer_id = $_GET['employer_id'];
                    $_SESSION['employer_id'] = $employer_id;
                    $sql = "SELECT jobs.JOB_ID AS JOB_ID, jobs.JOB_TITLE AS job_title, jobs.JOB_SUMMARY AS job_summary, status.STATUS_DESC as status FROM jobs INNER JOIN status ON jobs.STATUS_ID = status.STATUS_ID WHERE JOB_COMPANY_ID = '$employer_id'";
                    $query = $obj->getConnection()->query($sql);
                    $numRows = $query->num_rows;
                    if($numRows > 0){
                        while($row = $query->fetch_assoc()){ 
                            $job_id = $row['JOB_ID'];
                            $job_title = $row['job_title'];
                            $job_summary = $row['job_summary'];
                            $status = $row['status']; ?>
                            <tr>
                                <td class="col-md-3"><input type="" name="" class="form-control" value="<?php echo $job_title ?>" disabled></td>
                                <td class="col-md-5"><textarea name="company_profile" id="company_profile" class="form-control" rows="20" disabled><?php echo $job_summary ?></textarea></td>
                                <td class="col-md-2"><input type="" name="" class="form-control" value="<?php echo $status ?>" disabled></td>
                                <td class="col-md-2"><a href="update_employer_jobs.php?job_id=<?php echo $job_id ?>"><button class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Edit</button></a> <a href="#" class="delete_data" id="<?php echo $job_id ?>"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button></a></td>
                            </tr>
                            
                <?php   }  
                    }
                    else{
                         echo "<td colspan='4'><div class='alert alert-danger' style='text-align: center;'>No entry</div></td>";
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>