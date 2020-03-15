<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Account Confirmation</title>
</head>

<body>
<?php
require_once("config.php");

		$uname = $_GET['uname'];
		$dbcode = $_GET['code'];
		$query = "SELECT * FROM user WHERE uname ='$uname'";
		$result = mysqli_query($conn, $query);

		while($row = mysqli_fetch_array($result))
		{

			$code = $row['code'];
		}

		if($code == $dbcode)
		{
			mysqli_query($conn,"UPDATE user SET account_status = 'verified' WHERE uname ='$uname'");
			mysqli_query($conn,"UPDATE user SET code = '0' WHERE uname ='$uname'");
			echo "Thank You .. Your Email Has been Confirmed .. You May Now Login :)";
		}

		else
		{
			echo "Sorry Your Account Cannot Be Verified !! ";
			echo "Maybe The Verification Link is Expired ..";
			echo "Please Try Again Some Time";
		}
?>
</body>
</html>