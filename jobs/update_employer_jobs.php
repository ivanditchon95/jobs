<?php

include 'user.php';
$obj = new User();

$job_id = $_GET['job_id'];

if(isset($_POST['update_jobs'])){
    $job_title = $_POST['job_title'];
    $job_summary = $_POST['job_summary'];
    $status = $_POST['status'];
    $obj->updateEmployerJobs($job_id, $job_title, $job_summary, $status);
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
        <?php $employer_id = $_SESSION['employer_id']  ?>
        <a href="job_details.php?employer_id=<?php echo $employer_id ?>" style="float: right; margin-bottom: 20px;">Back</a>
        <div class="col-md-1"></div>
        <div class="col-md-14">
        <?php 
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
        }
        ?>
            <form action="#" method="POST">
                <div class="panel" style="border: 1px solid #ffc60a; margin-top: 30px;">
                    <div class="panel-heading" style="background-color: #ffc60a;"><strong>Jobs information</strong></div>
                    <div class="panel-body">
                    <?php 
                        $sql = "SELECT jobs.JOB_ID AS job_id, jobs.JOB_TITLE AS job_title, jobs.JOB_SUMMARY AS job_summary, status.STATUS_DESC AS status FROM jobs INNER JOIN status ON jobs.STATUS_ID = status.STATUS_ID WHERE JOB_ID = '$job_id'";
                        $query = $obj->getConnection()->query($sql);
                        $numRows = $query->num_rows;
                        if($numRows > 0){
                            while($row = $query->fetch_assoc()){
                                $job_title = $row['job_title'];
                                $job_summary = $row['job_summary'];
                                $status = $row['status'];
                        ?>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="job_title">Job title:</label>
                                <input type="text" name="job_title" id="job_title" class="form-control" value="<?php echo $job_title ?>" required>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <label for="job_summary">Job summary:</label>
                                <textarea name="job_summary" id="job_summary" class="form-control" rows="20" required><?php echo $job_summary ?></textarea>
                            </div>
                            <div class="col-md-2">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" required>
                                    <option value="<?php echo $status ?>"><?php echo $status ?></option>
                                    <option value="OPEN">OPEN</option>
                                    <option value="CLOSED">CLOSED</option>
                                </select>
                            </div>
                        </div>
                <?php   
                            }   

                        }    ?>
                    </div>
                    <div class="panel-footer">
                        <div class="row" style="text-align: center;">
                            <button name="update_jobs" class="btn btn-primary">Update</button>
                        </div>
                    </div>   
                </div>
            </form>
        </div>
    </div>
</body>
</html>