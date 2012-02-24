<?php
require_once("admin_include.php");

function check($key) {
	return isset($_POST[$key]);
}

if (check("adminId") && check("adminPassword")) {
	$loginMessage = "Welcome onboard Captain!";
	$res = $authentication -> login($_POST["adminId"], $_POST["adminPassword"]);

	if ($res === FALSE) {
		$loginMessage = "Invalid username/password";
	} else {
		header("Location: index.php");
	}
}
?>
<h2><?php echo $loginMessage;?></h2>
<form action="" method="post">
	<input type="text" name="adminId" />
	<br />
	<input type="password" name="adminPassword" />
	<input type="submit" value="Login" />
</form>