<?php

include 'user.php';
$obj = new User();

$id = $_GET['id'];
$sql = "SELECT jobs.JOB_TITLE AS job_title, jobs.JOB_SUMMARY AS job_summary, status.STATUS_DESC AS status FROM jobs INNER JOIN status ON jobs.STATUS_ID = status.STATUS_ID WHERE JOB_COMPANY_ID = '$id'";
$query = $obj->getConnection()->query($sql);
$numRows = $query->num_rows;
if($numRows > 0){
    $row = $query->fetch_assoc();
    $job_title = $row['job_title'];
    $job_summary = $row['job_summary'];
    $status = $row['status'];
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
                    <div class="panel-heading" style="background-color: #ffc60a;"><strong>Jobs information</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="job_title">Job title:</label>
                                <input type="text" name="job_title" id="job_title" class="form-control" value="<?php echo $job_title ?>" disabled>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <label for="job_summary">Job summary:</label>
                                <textarea name="job_summary" id="job_summary" class="form-control" rows="20" disabled><?php echo $job_summary ?></textarea>
                            </div>
                            <div class="col-md-2">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" disabled>
                                    <option value="<?php echo $status ?>"><?php echo $status ?></option>
                                    <option value="1">OPEN</option>
                                    <option value="2">CLOSED</option>
                                </select>
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