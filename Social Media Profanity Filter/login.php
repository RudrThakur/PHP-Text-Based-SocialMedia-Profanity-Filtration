<?php
session_start();
require_once("config.php");

	if (isset($_POST['uname'])) {
		$uname = mysqli_real_escape_string($conn,$_POST['uname']);
		$pass = mysqli_real_escape_string($conn,$_POST['pass']);
            

			$query = "SELECT * FROM user WHERE uname='$uname' AND pass='$pass'";
			$results = mysqli_query($conn, $query);
                  
                        
                        $row = mysqli_fetch_array($results,MYSQLI_ASSOC);
                        
                        
			if (mysqli_num_rows($results) ==1) {
                       

				if ($row['account_status']=="verified")
				{
					$_SESSION['uname'] = $uname;
                                        $_SESSION['fullname'] = $row['fullname'];
                                        $_SESSION['violationcount']= $row['violationcount'];
                                        
                                        header('location: index.php');
                                        
                                        
                                        }
                                        
                                        }
                                        
                                        }
                                        
                                        
                                        else{
                                        echo"An Error Occured !";
                                        
                                        }


?>