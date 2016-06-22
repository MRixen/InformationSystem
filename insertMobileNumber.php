 <?php
	$GLOBALS["servername"] = "localhost";
	$GLOBALS["username"] = "root";
	$GLOBALS["password"] = "rbc";
	$GLOBALS["dbname"] = "bitnami_wordpress";
	
	$ids = array( -1 );
	
									// Connect to db
									$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									// Get data from db
									$sql_mobile_number = "SELECT * FROM mobile_number";
									$result_mobile_number = $conn->query($sql_mobile_number); 
									$counter = 0;
									if ($result_mobile_number->num_rows > 0) {
										while($row = $result_mobile_number->fetch_assoc()) {
											$ids[$counter] = $row["id"];
											$counter = $counter+1;
										}
									}
									$conn->close();
										
									 if($_SERVER['REQUEST_METHOD'] == 'POST'){
										$fname = htmlentities($_POST['fname']);
										$lname = htmlentities($_POST['lname']);
										
										$idIsValid = false;
										
										// Check valid range of the id (range must be 1-4)
										 if( (($fname >= 1) && ($fname <= 4)) && ($lname > 0) ){									 
											// Check if id already exists
											if($ids[0] != -1){
												for ($x = 0; $x < sizeof($ids); $x++) {
													if($ids[$x] == $fname){
														$idIsValid = false;
													}
													else {
														$idIsValid = true;
													}
												}
											}
											else $idIsValid = false;
										}
										
										// Save data to db
										if($idIsValid){
											$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
											if ($conn->connect_error) {
												die("Connection failed: " . $conn->connect_error);
											} 

											if(isset($_POST['remove4'])){
												$result = $conn->query("insert into mobile_number (id, number) values ('$fname','$lname')");
											}
											$conn->close();
											}
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