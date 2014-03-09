<?php
// Database connection
include("config.php");
$db_selected=config();
// Insert User Data in Database on create new user
if(isset($_POST['user_name']) && isset($_POST['email']) && isset($_POST['pwd']))
{

    $encrypted_pwd=md5($_POST['pwd']);
	$query = "INSERT INTO  users (`username`, `email`, `password`) VALUES ('".$_POST['user_name']."', '".$_POST['email']."', '".$encrypted_pwd."')";
	$result=mysql_query($query);

	header("Location:newuser.php?creteduser=yes");


}
else if(isset($_POST['login_username']) && isset($_POST['login_pwd']))
{
	//check for correct Username & PWD match
	$encrypted_pwd=md5($_POST['login_pwd']);
	
	$result=mysql_query("SELECT * FROM `users` WHERE `username`='".$_POST['login_username']."' and `password`='".$encrypted_pwd."'");

	$row = mysql_num_rows($result);
	if($row)
	{
		// Start Session & add username to Session
		session_start();
		$_SESSION['username']=$_POST['login_username'];
		while($row1 = mysql_fetch_array($result))
		{
			$_SESSION['user_email']=$row1['email'];
		}

			
		header("Location:courses.php");
	}
	else
	{
		header("Location:index.php");

	}
}else if(isset($_POST['forgot_user_name']))
{
	//send email when user forgot password
	
	
	//generate new random Password.
	$random_generated_pwd=str_rand(6, 'alphanum');
	
	$query = "SELECT * FROM users where username='".$_POST['forgot_user_name']."'";
	$result=mysql_query($query);
	$to2 = "gvairagk@gmail.com";
	while($row = mysql_fetch_array($result))
	{
		$message = "Dear StudyStuff User,
				Below is your Account credentials.
				Username : ".$row['username']."
				Your New Password : ".$random_generated_pwd."\nRegards\nYour StudyStuff Team";
			
		$to2 = $row['email'];
	}

	$subject = "Your Password at StudyStuff !";

	$from = "info@studystuff.de";
	$headers = "From:" . $from;

	mail($to2,$subject,$message,$headers);

	//update new Password in Database
	$encrypted_pwd=md5($random_generated_pwd);
	$query = "UPDATE users SET  password='".$encrypted_pwd."' where username='".$_POST['forgot_user_name']."'";
	$result=mysql_query($query);	
	
	header("Location:forgotpwd.php?passwordsent=yes");

}else if(isset($_POST['acc_user_name']) && isset($_POST['acc_email']) && isset($_POST['acc_pwd']))
{
	session_start();
	$encrypted_pwd=md5($_POST['acc_pwd']);
	$query = "UPDATE users SET username='".$_POST['acc_user_name']."', email='".$_POST['acc_email']."', password='".$encrypted_pwd."' where username='".$_SESSION['username']."'";
	$result=mysql_query($query);


	// Set new Session variables
	$_SESSION['username']=$_POST['acc_user_name'];

	$_SESSION['user_email']=$_POST['acc_email'];

	header("Location:my_account.php?updated=yes");

}
function str_rand($length = 6, $seeds = 'alphanum')
{
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
    $seedings['hexidec'] = '0123456789abcdef';
    
    // Choose seed
    if (isset($seedings[$seeds]))
    {
        $seeds = $seedings[$seeds];
    }
    
    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);
    
    // Generate
    $str = '';
    $seeds_count = strlen($seeds);
    
    for ($i = 0; $length > $i; $i++)
    {
        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
    }
    
    return $str;
}


?>