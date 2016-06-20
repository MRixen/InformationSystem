 <?php
	$GLOBALS["servername"] = "localhost";
	$GLOBALS["username"] = "root";
	$GLOBALS["password"] = "rbc";
	$GLOBALS["dbname"] = "bitnami_wordpress";
 ?>
 <html>
 <head>
  <link rel="stylesheet" type="text/css" href="style.css">
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
					<th>ID</th>
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
					<form action="<?php 
									$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									if(isset($_POST['remove1'])){
										$result = $conn->query("DELETE FROM mobile_number WHERE id='1'");
									}
									$conn->close();
									?>" method="post">
						<input name="remove1" class="buttonClass" type="submit" value="-"/>
					</form>
					</td>
				</tr>
				<tr>
					<td>
					<form action="<?php 
									$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									if(isset($_POST['remove2'])){
										$result = $conn->query("DELETE FROM mobile_number WHERE id='2'");
									}
									$conn->close();
									?>" method="post">
						<input name="remove2" class="buttonClass" type="submit" value="-"/>
					</form>
					</td>
				</tr>
				<tr>
					<td>
					<form action="<?php 
									$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									if(isset($_POST['remove3'])){
										$result = $conn->query("DELETE FROM mobile_number WHERE id='3'");
									}
									$conn->close();
									?>" method="post">
						<input name="remove3" class="buttonClass" type="submit" value="-"/>
					</form>
					</td>
				</tr>
				<tr>
					<td>
					<form action="<?php 
									$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									if(isset($_POST['remove4'])){
										$result = $conn->query("DELETE FROM mobile_number WHERE id='4'");
									}
									$conn->close();
									?>" method="post">
						<input name="remove4" class="buttonClass" type="submit" value="-"/>
					</form>
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
					<form action="insert.php" method="post">
						ID: <input size="1" type="text" name="fname" /> 
						Mobile Number: <input size="15" type="text" name="lname" />
						<input name="remove4" class="buttonClass" type="submit" value="+"/>
					</form>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
</div>		
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
		
 <script type="text/javascript">
          function sum1()
          {
            //var num1 = document.myform.name1.value;
            //var num2 = document.myform.name2.value;
			//if((num1 == "") || (num2 == "")){
			//	num1 = "-1";
			//	num2 = "-1";
			//}
			alert("Sum1");
          }
		  function sum2()
          {
			// Get data from input fields
			document.getElementById("inputField2").onchange();
          }
        </script>
<div id="fussbereich">
	<p>Copyright rbc Fördertechnik GmbH <a href="www.rbc-robotics.de" target="_blank">www.rbc-robotics.de</a><p>
</div>
</body>
</html>