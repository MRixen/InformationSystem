 <?php
	$GLOBALS["servername"] = "localhost";
	$GLOBALS["username"] = "root";
	$GLOBALS["password"] = "rbc";
	$GLOBALS["dbname"] = "bitnami_wordpress";
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
					<form class="myForm" action="<?php 
									$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									if(isset($_POST['remove1'])){
										$result = $conn->query("DELETE FROM mobile_number WHERE id='1'");
									}
									$conn->close();
									?>" method="post">
						<button name="remove1" type="submit" class="pure-button"><i class="fa fa-minus-square-o"></i></button>
					</form>
					</td>
				</tr>
				<tr>
					<td id="number2">&nbsp;</td>
					<td id="number22">&nbsp;</td>
					<td class="spezial">
					<form class="myForm" action="<?php 
									$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									if(isset($_POST['remove2'])){
										$result = $conn->query("DELETE FROM mobile_number WHERE id='2'");
									}
									$conn->close();
									?>" method="post">
						<button name="remove2" type="submit" class="pure-button"><i class="fa fa-minus-square-o"></i></button>
					</form>
					</td>
				</tr>
				<tr>
					<td id="number3">&nbsp;</td>
					<td id="number33">&nbsp;</td>
					<td class="spezial">
					<form class="myForm" action="<?php 
									$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									if(isset($_POST['remove3'])){
										$result = $conn->query("DELETE FROM mobile_number WHERE id='3'");
									}
									$conn->close();
									?>" method="post">
						<button name="remove3" type="submit" class="pure-button"><i class="fa fa-minus-square-o"></i></button>
					</form>
					</td>
				</tr>
				<tr>
					<td id="number4">&nbsp;</td>
					<td id="number44">&nbsp;</td>
					<td class="spezial">
					<form class="myForm" action="<?php 
									$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									if(isset($_POST['remove4'])){
										$result = $conn->query("DELETE FROM mobile_number WHERE id='4'");
									}
									$conn->close();
									?>" method="post">
						<button name="remove4" type="submit" class="pure-button"><i class="fa fa-minus-square-o"></i></button>
					</form>
					</td>
				</tr>
			<tr id="linespace"> </tr>
			</tbody>			
			<tbody>
			<tr>
				<?php
					echo '<td><form class="myForm" style="margin-top:0px;" action="insertMobileNumber.php" method="post"><input size="15" type="text" name="fname"/></td> <td><input size="15" type="text" name="lname"/></td> <td class="spezial"> <button name="remove4" type="submit" class="pure-button"><i class="fa fa-plus-square-o"></i></button></form></td>';
				?>
				</tr>
			</tbody>
			<tbody>
			<tr>
				<?php
					echo '<td><form class="myForm" style="margin-top:0px;" action="insertSollValue.php" method="post"> <input size="15" type="text" name="zname"/></td> <td></td> <td class="spezial"> <button name="buttonZname" type="submit" class="pure-button"><i class="fa fa-check-square-o"></i></button></form></td>';
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

			<?php				
				// Connect to db
				$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				// Get data from db
				$sql_mobile_number = "SELECT * FROM mobile_number";
				$result_mobile_number = $conn->query($sql_mobile_number); 
				$dbDataNumber = array();
				$dbDataId = array();
				$counter = 0;
				if ($result_mobile_number->num_rows > 0) {
					while($row = $result_mobile_number->fetch_assoc()) {
						$dbDataNumber[$counter] = $row["number"];
						$dbDataId[$counter] = $row["id"];
						$counter = $counter+1;
					}
				}
				$conn->close();			
			?>
			
			<!-- Populate table with db data -->
			<script>
				var cellElementsID = ["number1", "number2", "number3", "number4"];
				var cellElementsNumber = ["number11", "number22", "number33", "number44"];
				var jArrayId= <?php echo json_encode($dbDataId); ?>;
				var jArrayNumber= <?php echo json_encode($dbDataNumber); ?>;
				var fLen = jArrayId.length;
				
				if(fLen > 4) fLen = 4; 
				
				for (i = 0; i < 4; i++) {
					document.getElementById(cellElementsID[i]).innerHTML = i+1;
				}
				for (i = 0; i < fLen; i++) {
					document.getElementById(cellElementsNumber[jArrayId[i]-1]).innerHTML = jArrayNumber[i];
				}
			</script>

</body>
</html>