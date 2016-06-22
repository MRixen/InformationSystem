 <?php
	$GLOBALS["servername"] = "localhost";
	$GLOBALS["username"] = "root";
	$GLOBALS["password"] = "rbc";
	$GLOBALS["dbname"] = "bitnami_wordpress";
				
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$zname = htmlentities($_POST['zname']);				
		// Save data to db
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		if(isset($_POST['buttonZname'])){
			$result = $conn->query("UPDATE production_actual SET Soll = '$zname' WHERE 1");
		}
		$conn->close();
	}
 ?>
 
 <html>
 <head>
  <link rel="stylesheet" type="text/css" href="styleLight.css">
  <title>System Configuration</title>
 </head>
 <body>
<div id="seite">
	<div id="kopfbereich">
		<h1>System Configuration</h1>
	</div>
  
	<div id="inhalt">	
		<div id="inhalt3">
			 <table class="table4" id="table"> 
			<caption> </caption>
			<thead>
				<tr>
					<th color="white">ID</th>
					<th>Mobile Number</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td id="number1">&nbsp;</td>
					<td id="number11">&nbsp;</td>
				</tr>
				<tr>
					<td id="number2">&nbsp;</td>
					<td id="number22">&nbsp;</td>
				</tr>
				<tr>
					<td id="number3">&nbsp;</td>
					<td id="number33">&nbsp;</td>
				</tr>
				<tr>
					<td id="number4">&nbsp;</td>
					<td id="number44">&nbsp;</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div id="inhalt4">
			 <table class="table5" id="table"> 
			<caption> </caption>
			<thead>
				<tr>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>

					</td>
				</tr>
				<tr>
					<td>

					</td>
				</tr>
				<tr>
					<td>

					</td>
				</tr>
				<tr>
					<td>

					</td>
				</tr>
			</tbody>
		</table>	
		</div>
		        
		<div id="inhalt5">
			 <table class="table4" id="table"> 
			<caption> </caption>
			<tbody>
				<tr>
					<td>					
										
					</td>
				</tr>
			</tbody>
		</table>
		<br>
		<table class="table4" id="table"> 
			<caption> </caption>
			<tbody>
				<tr>
					<td>					
						<a href="config.php" target="_parent">CLICK TO RETURN</a>						
					</td>
				</tr>
			</tbody>
		</table>
		</div>
</div>		
<div id="fussbereich">
	<p>Copyright rbc Fördertechnik GmbH <a href="www.rbc-robotics.de" target="_blank">www.rbc-robotics.de</a><p>
</div>
</body>
</html>