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
  <link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" href="pure-release-0.6.0/pure-min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>System Configuration</title>
 </head>
 <body>
<div id="seite">
	<div id="container">	
	<div id="kopfbereich">	
		<h1>System Configuration</h1>
	</div>	
	<div id="kopfbereich2">	
		<img src="rbclogo.png" alt="" style="float:left;width:200px;height:105px;">
	</div>

	</div>
  
	<div id="inhalt">	
	<div id="inhalt2">	

	<table id="table"> 
			<caption> </caption>
			<thead>
				<tr>
					<th>ID</th>
					<th>Mobile Number</th>
					<th class="spezial"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td id="number1">&nbsp;</td>
					<td id="number11">&nbsp;</td>
					<td class="spezial">
					<form>						
					</form>
					</td>
				</tr>
				<tr>
					<td id="number2">&nbsp;</td>
					<td id="number22">&nbsp;</td>
					<td class="spezial">
					<form>
					</form>
					</td>
				</tr>
				<tr>
					<td id="number3">&nbsp;</td>
					<td id="number33">&nbsp;</td>
					<td class="spezial">
					<form>
					</form>
					</td>
				</tr>
				<tr>
					<td id="number4">&nbsp;</td>
					<td id="number44">&nbsp;</td>
					<td class="spezial">
					<form>
					</form>
					</td>
				</tr>
			<tr id="linespace"> </tr>
			</tbody>			
			<tbody>
			<tr>
				<?php
					echo '<td><form style="margin-top:0px;" action="config.php"><input size="30" type="hidden" name="hidden"/> </td> <td></td> <td class="spezial"> <button name="remove4" type="submit" class="pure-button"><i class="fa fa-hand-o-left"></i></button></form></td>';
				?>
				</tr>
			</tbody>
			<tbody>
			<tr>
				<?php
					echo '<td><form style="margin-top:0px;">  </td> <td></td> <td class="spezial"> </form></td>';
				?>
				</tr>
			</tbody>
		</table>
		</div>
		
</div>	
<div id="fussbereich">
	<p>Copyright rbc Fördertechnik GmbH <a href="www.rbc-robotics.de" target="_blank">www.rbc-robotics.de</a><p>
</div>
</div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>

</body>
</html>