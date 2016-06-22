<!--SET DB CONNECTION PARAMETERS-->
<?php
	$GLOBALS["servername"] = "localhost";
	$GLOBALS["username"] = "root";
	$GLOBALS["password"] = "rbc";
	$GLOBALS["dbname"] = "bitnami_wordpress";
 ?>
  
<!--SET TABLE DATA-->
<html>
 <head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>System Information</title>
 </head>
 <META HTTP-EQUIV="refresh" CONTENT="2"/>
 <body>
<div id="seite">
	<div id="kopfbereich">	
		<img src="rbclogo.png" alt="" style="float:left;width:200px;height:105px;"><h1>System Information</h1>
	</div>
  
	<div id="inhalt">
		<div id="inhalt2">
		 <table class="table2" id="table" onload="updateTables(
			<?php	
				// Connect to database
				$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbname"]);
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				// Get data from database production_actual
				$sql_production_actual = "SELECT * FROM production_actual";
				$result_production_actual = $conn->query($sql_production_actual); 
				$row_production_actual = $result_production_actual->fetch_assoc();
				
				// Calculate trend for current article and get database content again
				$trendTemp = (3600/(float)$row_production_actual["Cycletime"]);
				$trend = sprintf("%.3f", $trendTemp);
				$result = $conn->query("UPDATE production_actual SET Trend = '$trend' WHERE 1");
				
				$sql_production_actual = "SELECT * FROM production_actual";
				$result_production_actual = $conn->query($sql_production_actual); 
				$row_production_actual = $result_production_actual->fetch_assoc();
				
				// Get data from database machine_data
				$sql_machine_data = "SELECT * FROM machine_data";
				$result_machine_data = $conn->query($sql_machine_data); 
				$row_machine_data = $result_machine_data->fetch_assoc();
				$conn->close();
				
				$dbData = array(
				  0 => $row_production_actual["Soll"], 
				  1 => $row_production_actual["Ist"], 
				  2 => $row_production_actual["Trend"], 
				  3 => $row_production_actual["Cycletime"], 
				  4 => $row_machine_data["MachineData"], 
				  5 => $row_machine_data["ProjectNo"], 
				  6 => $row_machine_data["BuildYear"], 
				  7 => $row_machine_data["PreAccept"], 
				  8 => $row_machine_data["FinAccept"], 
				  9 => $row_machine_data["SerialNo"], 
				  10 => $row_machine_data["SoftwareSerial"], 
				  11 => $row_machine_data["RobotType"], 
				  12 => $row_machine_data["ControllerId"], 
				  13 => $row_machine_data["IpAddress"], 
				  14 => $row_machine_data["HmiLanguage"], 
				  15 => $row_machine_data["RobSpeed"], 
				  16 => $row_machine_data["ActOv"], 
				  17 => $row_machine_data["DyteTime"], 
					);
			?>)"> 
			<caption> </caption>
			<thead>
				<tr>
					<th>Soll</th>
					<th>Ist</th>
					<th>Trend</th>
					<th>Cycletime</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td id="Soll">&nbsp;</td>
					<td id="Ist">&nbsp;</td>
					<td id="Trend">&nbsp;</td>
					<td id="Cycletime">&nbsp;</td>
				</tr>
			</tbody>
		</table>
		<br>
		<br>
		<table class="table1" id="table2"> 
			<caption> </caption>
			<!-- SECTION 1 -->
			<thead>
				<tr>
					<th>Machine Name</th>
					<th>Project No.</th>
					<th>Build Year</th>
					<th>Pre. Accept</th>
				</tr>
			</thead>
			<tbody class="section">
				<tr>
					<td id="MachineName">&nbsp;</td>
					<td id="ProjectNo">&nbsp;</td>
					<td id="BuildYear">&nbsp;</td>
					<td id="PreAccept">&nbsp;</td>
				</tr>
			<tr id="linespace"> </tr>
			</tbody>
			<!-- SECTION 2 -->
			<thead>
				<tr>
					<th>Fin. Accept</th>
					<th>Serial No.</th>
					<th>Software Serial</th>
					<th>Robot Type</th>
				</tr>
			</thead>
			<tbody class="section">
				<tr>
					<td id="FinAccept">&nbsp;</td>
					<td id="SerialNo">&nbsp;</td>
					<td id="SoftwareSerial">&nbsp;</td>
					<td id="RobotType">&nbsp;</td>
				</tr>
			<tr id="linespace"> </tr>
			</tbody>
			<!-- SECTION 3 -->
			<thead>
				<tr>
					<th>Controller ID</th>
					<th>IP Address</th>
					<th>HMI Language</th>
					<th>Rob Speed [mm/s]</th>
				</tr>
			</thead>
			<tbody class="section">
				<tr>
					<td id="ControllerId">&nbsp;</td>
					<td id="IpAddress">&nbsp;</td>
					<td id="HmiLanguage">&nbsp;</td>
					<td id="RobSpeed">&nbsp;</td>
				</tr>
			<tr id="linespace"> </tr>
			</tbody>
			<!-- SECTION 4 -->
			<thead>
				<tr>
					<th>Act. OV [%]</th>
					<th>Dyte Time [h]</th>
					<th> </th>
					<th> </th>
				</tr>
			</thead>
			<tbody class="section">
				<tr>
					<td id="ActOv">&nbsp;</td>
					<td id="DyteTime">&nbsp;</td>
					<td id="na1">&nbsp;</td>
					<td id="na2">&nbsp;</td>
				</tr>
			<tr id="linespace"> </tr>
			</tbody>
		</table>
		</div> 
		
	</div> 	
<div id="fussbereich">
	<p>Copyright rbc Fördertechnik GmbH <a href="http://www.rbc-robotics.de" target="_blank">www.rbc-robotics.de</a><p>
</div>	
</div>




<script type="text/javascript">
	function updateTables(){
		var jArray= <?php echo json_encode($dbData); ?>;
		// Populate data for production 
		document.getElementById("Soll").innerHTML = jArray[0];
		document.getElementById("Ist").innerHTML = jArray[1];
		var elementTrend = document.getElementById("Trend");
		elementTrend.innerHTML = jArray[2];
		// Set text color to red if trend is smaller than soll
		if(parseInt(jArray[2]) < parseInt(jArray[0])){
			elementTrend.style.backgroundColor='red';
		}		
		document.getElementById("Cycletime").innerHTML = jArray[3];
		

		
		// Populate data for production 
		document.getElementById("MachineName").innerHTML = jArray[4];
		document.getElementById("ProjectNo").innerHTML = jArray[5];
		document.getElementById("BuildYear").innerHTML = jArray[6];
		document.getElementById("PreAccept").innerHTML = jArray[7];
		document.getElementById("FinAccept").innerHTML = jArray[8];
		document.getElementById("SerialNo").innerHTML = jArray[9];
		document.getElementById("SoftwareSerial").innerHTML = jArray[10];
		document.getElementById("RobotType").innerHTML = jArray[11];
		document.getElementById("ControllerId").innerHTML = jArray[12];
		document.getElementById("IpAddress").innerHTML = jArray[13];
		document.getElementById("HmiLanguage").innerHTML = jArray[14];
		document.getElementById("RobSpeed").innerHTML = jArray[15];
		document.getElementById("ActOv").innerHTML = jArray[16];
		document.getElementById("DyteTime").innerHTML = jArray[17];
	}
    window.onload = function () {		
		window.setInterval(function(){ 
			document.getElementById("table").onload();
		}, 1);
    }
 </script>
</body>
</html>