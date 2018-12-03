<?php
session_start();
$_SESSION['msg'] = '';
/**
* 
*/
class User
{
	private $dbhost;
	private $dbusername;
	private $dbpassword;
	private $dbname;
	
	public function __construct(){
		$this->dbhost ='localhost';
		$this->dbusername = 'root';
		$this->dbpassword = '';
		$this->dbname = 'jobs';
		
		$this->con = new mysqli($this->dbhost, $this->dbusername, $this->dbpassword, $this->dbname);
		if(mysqli_connect_errno()){
			echo "Cant connect";
			exit();
		}
	}

	public function getConnection(){
		return $this->con;
	}

	public function cleanText($string){
		$string = trim($string);
		$string = stripslashes($string);
		$string = htmlspecialchars($string);
		$string = mysqli_real_escape_string($this->con, $string);
	}

	public function employerRegistration($company_name, $company_profile1, $emailaddress, $contact_number, $street, $city, $username, $password, $mobilenumber_validation){
		$check_sql = "SELECT * FROM accounts WHERE EMAILADDRESS = '$emailaddress' OR USERNAME = '$username'";
		$check_query = $this->con->query($check_sql);
		$check_numRows = $check_query->num_rows;
		if($check_numRows > 0){
			$_SESSION['msg'] = "<div class='alert alert-success' style='margin-top: 30px;'>Emailaddress or username is already exist, try another one</div>";
		}
		else if(!filter_var($emailaddress, FILTER_VALIDATE_EMAIL)){
			$_SESSION['msg'] = "<div class='alert alert-warning' style='margin-top: 30px;'>$emailaddress is not a valid emailaddress</div>";
		}
		else if(!preg_match($mobilenumber_validation, $contact_number)){
			$_SESSION['msg'] = "<div class='alert alert-warning' style='margin-top: 30px;'>Invalid contact number format</div>";
		}
		else if(!(strlen($contact_number) == 11)){
			$_SESSION['msg'] = "<div class='alert alert-warning' style='margin-top: 30px;'>Mobile number atleast 11 digits</div>";
		}
		else{
			//insert account
			$account_sql = "INSERT INTO `accounts`(`ACCOUNT_ID`, `ACCOUNT_TYPE`, `EMAILADDRESS`, `USERNAME`, `PASSWORD`) VALUES (NULL, 'EMPLOYER', '$emailaddress', '$username', '$password')";
			$account_query = $this->con->query($account_sql);
			$account_id = $this->con->insert_id;
			//end
			//insert location
			$location_sql = "INSERT INTO `location`(`LOCATION_ID`, `STREET`, `CITY`) VALUES (NULL,'$street','$city')";
			$location_query = $this->con->query($location_sql);
			$location_id = $this->con->insert_id;
			//end
			//insert employer
			$employer_sql = "INSERT INTO `employer`(`ID`, `ACCOUNT_ID`, `LOCATION_ID`, `COMPANY_NAME`, `COMPANY_PROFILE`, `CONTACT_NUMBER`) VALUES (NULL, '$account_id', '$location_id', '$company_name', '$company_profile1', '$contact_number')";
			$employer_query = $this->con->query($employer_sql);
			//end
			try{
				if($account_query && $location_query && $employer_query == TRUE){
					$_SESSION['msg'] = "<div class='alert alert-success' style='margin-top: 30px;'>Successfully registered</div>";
				}
				else{
					throw new Exception("Invalid registration");
					
				}
			}
			catch(Exception $ex){
				$_SESSION['msg'] = "<div class='alert alert-warning' style='margin-top: 30px;'>".$ex->getMessage()."</div>";
			}
		}
	}

	public function applicantRegistration($firstname, $middlename, $lastname, $username, $emailaddress, $password){
		$check_sql = "SELECT * FROM accounts WHERE EMAILADDRESS = '$emailaddress' AND USERNAME = '$username'";
		$check_query = $this->con->query($check_sql);
		$numRows = $check_query->num_rows;
		try{
			if($numRows == 0){
				$account_sql = "INSERT INTO `accounts`(`ACCOUNT_ID`, `ACCOUNT_TYPE`, `EMAILADDRESS`, `USERNAME`, `PASSWORD`) VALUES (NULL,'APPLICANT','$emailaddress','$username','$password')";
				$account_query = $this->con->query($account_sql);
				$account_id = $this->con->insert_id;

				$applicant_sql = "INSERT INTO `applicants_profile`(`PROFILE_ID`, `ACCOUNT_ID`, `FIRSTNAME`, `MIDDLENAME`, `LASTNAME`) VALUES (NULL,'$account_id','$firstname','$middlename','$lastname')";
				$applicant_query = $this->con->query($applicant_sql);
				try{
					if($account_query && $applicant_query == TRUE){
						$_SESSION['msg'] = "<div class='alert alert-success' style='margin-top: 20px;'>Successfully registered</div>";				}
					else{
						throw new Exception("Error query");
					}
				}
				catch(Exception $ex){
					$_SESSION['msg'] = "<div class='alert alert-danger'>".$ex->getMessage()."</div>";
				}
			}
			else{
				throw new Exception("Emailaddress or username is already exist");
			}
		}
		catch(Exception $ex){
			$_SESSION['msg'] = "<div class='alert alert-warning'>".$ex->getMessage()."</div>";
		}
	}

	public function getEmployerDetails(){
		$sql = "SELECT * FROM employer";
		$query = $this->con->query($sql);
		$numRows = $query->num_rows;
		if($numRows > 0){
			while($row = $query->fetch_assoc()){
	            		$array[] = $row;
	        	}
	    		return $array; 
		}
		else{
			return 0;
		}
	}

	public function getAllJobs(){
		$sql = "SELECT jobs.JOB_TITLE AS JOB_TITLE, jobs.JOB_SUMMARY AS JOB_SUMMARY, status.STATUS_DESC AS status FROM jobs INNER JOIN status ON jobs.STATUS_ID = status.STATUS_ID";
		$query = $this->con->query($sql);
		$numRows = $query->num_rows;
		if($numRows > 0){
			while($row = $query->fetch_assoc()){
				$array[] = $row;
			}
			return $array;
		}
		else{
			return 0;
		}
	}

	public function updateEmployerInfo($id, $company_name, $company_profile, $emailaddress, $contact_number, $username, $password, $street, $city){
		//select account_id
		$sql = "SELECT * FROM employer WHERE ID = '$id'";
		$query = $this->con->query($sql);
		$numRows = $query->num_rows;
		try{
			if($numRows > 0){
				$row = $query->fetch_assoc();
				$account_id = $row['ACCOUNT_ID'];
				$location_id = $row['LOCATION_ID'];
			}
			else{
				throw new Exception("No matched found");
			}
		}
		catch(Exception $ex){
			$_SESSION['msg'] = "<div class='alert alert-warning'>
									<a href='index.php' class='close'>&times</a>".$ex->getMessage()."
       							</div>";
		}
		//update employer
		$employer_sql = "UPDATE `employer` SET `COMPANY_NAME`='$company_name',`COMPANY_PROFILE`='$company_profile',`CONTACT_NUMBER`='$contact_number' WHERE `ID` = '$id'";
		$employer_query = $this->con->query($employer_sql);
		//update account
		$account_sql = "UPDATE `accounts` SET `EMAILADDRESS`='$emailaddress',`USERNAME`='$username',`PASSWORD`='$password' WHERE ACCOUNT_ID = '$account_id'";
		$account_query = $this->con->query($account_sql);
		//update location
		$location_sql = "UPDATE `location` SET `STREET`='$street',`CITY`='$city' WHERE LOCATION_ID = '$location_id'";
		$location_query = $this->con->query($location_sql);

		try{
			if($employer_query && $account_query && $location_query == !TRUE){
				$_SESSION['msg'] = "<div class='alert alert-warning'>
										<a href='update_employer_info.php'>Cant updated</a>
									</div>";
			}
			else{
				throw new Exception('Successfully updated');
			}
		}
		catch(Exception $ex){
			$_SESSION['msg'] = "<div class='alert alert-success' style='margin-top: 30px;'>
							<a href='update_employer_info.php?id=$id' class='close'>&times</a>".$ex->getMessage()."
						</div>";
		}
	}

	public function updateEmployerJobs($job_id, $job_title, $job_summary, $status){
		$sql = "SELECT * FROM status WHERE STATUS_DESC = '$status'";
		$query = $this->con->query($sql);
		$numRows = $query->num_rows;
		if($numRows > 0){
			$row = $query->fetch_assoc();
			$status_id = $row['STATUS_ID'];
		}
		else{
			return 0;
		}

		$sql = "UPDATE `jobs` SET `JOB_TITLE`='$job_title',`JOB_SUMMARY`='$job_summary',`STATUS_ID`='$status_id' WHERE JOB_ID = '$job_id'";
		$query = $this->con->query($sql);
		
		try{
			if($query == !FALSE){
				$_SESSION['msg'] = "<div class='alert alert-success' style='margin-top: 30px;'><a href='update_employer_jobs.php?job_id=$job_id' class='close'>&times</a>Successfully updated</div>";
			}
			else{
				throw new Exception("Error query");
				
			}
		} 
		catch (Exception $ex){
			$_SESSION['msg'] = "<div class='alert alert-danger'>".$ex->getMessage()."</div>";
		}
	}

	public function deleteEmployer($employer_id){
		//select location id, account_id
		$sql = "SELECT location.LOCATION_ID AS location_id, accounts.ACCOUNT_ID AS account_id FROM employer INNER JOIN location ON employer.LOCATION_ID = location.LOCATION_ID INNER JOIN accounts ON employer.ACCOUNT_ID = accounts.ACCOUNT_ID WHERE ID = '$employer_id'";
		$query = $this->con->query($sql);
		$numRows = $query->num_rows;
		$row = $query->fetch_assoc();
		$location_id = $row['location_id'];
		$account_id = $row['account_id'];
		//delete accounts
		$account_sql = "DELETE FROM accounts WHERE ACCOUNT_ID = '$account_id'";
		$account_query = $this->con->query($account_sql);
		//delete location 
		$location_sql = "DELETE FROM location WHERE LOCATION_ID = '$location_id'";
		$location_query = $this->con->query($location_sql);
		//delete employer
		$employer_sql = "DELETE FROM employer WHERE ID = '$employer_id'";
		$employer_query = $this->con->query($employer_sql);
		//delete jobs
		$job_sql = "DELETE FROM jobs WHERE JOB_COMPANY_ID = '$employer_id'";
		$job_query = $this->con->query($job_sql);
		try{
			if($account_query && $location_query && $employer_query && $job_query == TRUE){
				$_SESSION['msg'] = "<div class='alert alert-success' style='margin-top: 30px;'><a href='employers_information.php' class='close'>&times</a>Successfully deleted</div>";
			}
			else{
				throw new Exception("Error" .mysqli_error());
			}
		}
		catch(Exception $ex){
			$_SESSION['msg'] = "<div class='alert alert-success' style='margin-top: 30px;'>".$ex->getMessage()."</div>";
		}
	}

	public function deleteJob($job_id){
		$employer_id = $_SESSION['employer_id'];
		$sql = "DELETE FROM jobs WHERE JOB_ID = '$job_id'";
		$query = $this->con->query($sql);
		try{
			if($query == TRUE){
				echo "<script>alert('Successfully deleted')</script>";
				echo "<script>window.open('job_details.php?employer_id=$employer_id','_self')</script>";
			}
			else{
				throw new Exception("Not deleted");	
			}
		}
		catch(Exception $ex){
			$_SESSION['msg'] = "<div class='alert alert-warning'>".$ex->getMessage()."</div>";
		}
	}

	public function findJobs($category, $job_title, $location){
		$sql = "SELECT * FROM jobs";
	}

	public function logIn($username, $password){
		$sql = "SELECT * FROM accounts WHERE USERNAME = '$username' AND PASSWORD = '$password'";
		$query = $this->con->query($sql);
		$numRows = $query->num_rows;
		$row = $query->fetch_assoc();
		try{
			if($numRows > 0){
				if($row['ACCOUNT_TYPE'] == 'ADMIN'){
					$_SESSION['account_id'] = $row['ACCOUNT_ID'];
					$_SESSION['is_login'] = TRUE;
					$redirectURL = 'http://localhost/jobs/admin_index.php';
	                echo "<script type='text/javascript'>window.location.href='$redirectURL'</script>";
				}
				else if($row['ACCOUNT_TYPE'] == 'EMPLOYER'){
					$_SESSION['account_id'] = $row['ACCOUNT_ID'];
					$_SESSION['is_login'] = TRUE;
					$redirectURL = 'http://localhost/jobs/employer_index.php';
	                echo "<script type='text/javascript'>window.location.href='$redirectURL'</script>";
				}
				else if($row['ACCOUNT_TYPE'] == 'APPLICANT'){
					$_SESSION['account_id'] = $row['ACCOUNT_ID'];
					$_SESSION['is_login'] = TRUE;
					$redirectURL = 'http://localhost/jobs/applicant_index.php';
	                echo "<script type='text/javascript'>window.location.href='$redirectURL'</script>";
				}
			}
			else{
				throw new Exception("Invalid username or password");
			}
		}
		catch(Exception $ex){
			$_SESSION['msg'] = "<div class='alert alert-warning'>
        <a href='index.php' class='close'>&times</a>".$ex->getMessage()."
       </div>";
		}
	}

	public function logOut(){
		$_SESSION['is_login'] = FALSE;
		session_destroy();
		header("location:index.php");
	}
}

?>
