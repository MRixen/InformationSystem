<script>
	document.getElementById("cell").innerHTML = myArgument;
</script>
<?php
	$GLOBALS["servername"] = "localhost";
	$GLOBALS["username"] = "root";
	$GLOBALS["password"] = "rbc";
	$GLOBALS["dbname"] = "bitnami_wordpress";
	
	$connection = mysql_connect($GLOBALS["servername"],$GLOBALS["username"],$GLOBALS["password"]); // Establishing Connection with Server
	$db = mysql_select_db($GLOBALS["dbname"], $connection); // Selecting Database from Server
	if(isset($_POST['remove'])){ // Fetching variables of the form which travels in URL
		$query = mysql_query("DELETE FROM mobile_number WHERE 1");
	}
	mysql_close($connection); // Closing Connection with Server
	header('Location: configTest.php');
?>