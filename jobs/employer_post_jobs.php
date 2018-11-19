<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="img/glass2.jpg">
    <title>Post jobs</title>
</head>
<body>
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="panel" style="border: 1px solid #BCBCBC; margin-top: 20px;">
                <div class="panel-heading" style="border-bottom: 3px solid #f2f2f2;"><strong>Job information</strong></div>
                <div class="panel-body">
                    <div class="row">   
                        <div class="col-md-12">
                            <label for="job_title">Title:</label>
                            <input type="text" name="job_title" id="job_title" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-12">
                            <label for="job_summary">Summary:</label>
                            <textarea name="job_summary" id="job_summary" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px; text-align: center;">   
                        <button name="post_job" class="btn btn-primary">Post</button>
                    </div>
                </div>
                <div class="panel-footer">
                    <center><i>Post Jobs &copy 2018</i></center>
                </div>
            </div>
        </form>
    </div>
</body>
</html>