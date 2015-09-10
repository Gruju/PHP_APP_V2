<?php
# This function reads your DATABASE_URL configuration automatically set by Heroku
# the return value is a string that will work with pg_connect
function pg_connection_string() {
  return "dbname=d982vlbpdpu737 host=ec2-54-235-162-144.compute-1.amazonaws.com port=5432 user=ydsgglksiqckdh password=SPgVICpqS9AGYXGHwSE65WJLt6 sslmode=require";
}
 
# Establish db connection
$db = pg_connect(pg_connection_string());
if (!$db) {
    echo "Database connection error.";
    exit;
} 


$name = '';
$FirstName = '';
$surname = '';
$dobDay = '';
$dobMonth = '';
$dobYear = '';
$row = '';
$MartianDays = '';

$resultTable = "";
if(isset($_REQUEST['action'])) {
		if($_REQUEST['action'] == "submit") {
				$Firstname = $_POST['Firstname'];
				$surname = $_POST['surname'];
				$dobDay = $_POST['dob-day'];
				$dobMonth = $_POST['dob-month'];
				$dobYear = $_POST['dob-year'];
				$dob = strtotime($dobDay."-".$dobMonth."-".$dobYear);
				$dobFormat = date('Y-m-d',$dob);
				$Now = date('Y-m-d');
				$dStart = new DateTime($dobFormat);
				$dEnd = new DateTime($Now);
				$dDiff = $dStart->diff($dEnd);
				$string = " Martian Days.";
				$hasbeenAliveString = "has been alive for: ";
				$days = $dDiff->days;
				$years = $dDiff->years;
				$MD = ($days/365)*686;
				$MartianDays = round($MD); 
				$resultTable .= "<h2>Database Table</h2>
								<table>
								<tr>
									<th>ID</th>
									<th>First Name</th>
									<th>Surname</th>
									<th>DOB</th>
									<th width='350'>Timestamp</th>
									<th>Days Alive</th>
								</tr>";
				$sql = "INSERT INTO person_refined(pname,dobday,dobmonth,dobyear,timestamp,daysalive,surname) VALUES('$Firstname','$dobDay','$dobMonth','$dobYear',Now(),'$days','$surname')";
				//$sql = "INSERT INTO person_refined (pname) VALUES('TEST')";
				$dbInsert = pg_query($db,$sql);
				if($dbInsert == FALSE)
				{
					echo pg_last_error();
				}
				$result = pg_query($db, "SELECT * FROM person_refined");
				while($row = pg_fetch_assoc($result)) {
					//echo $row;
					$resultTable .= "<tr>
										<td align='center'>".$row['p_id']."</td>
										<td align='center'>".$row['pname']."</td>
										<td align='center'>".$row['surname']."</td>
										<td align='center'>".$row['dobday']."-".$row['dobmonth']."-".$row['dobyear']."</td>
										<td align='center'>".$row['timestamp']."</td>
										<td align='center'>".$row['daysalive']."</td>
									</tr>";}
			$resultTable .= "</table>";

			//echo $resultTable;
			//header('location:index.php');
			}};

?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SWE3004 - Assignment 1</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="description" content="SW30004: Software Deployment and Evolution - Assignment 1" />
	<meta name="keywords" content="SWE3004" />
</head>
<body>
<h1>SWE3004: Assignment 1</h1>
<h2>Simple Web Application</h2>
		<form id="standard" action="?action=submit" method="post" enctype="multipart/form-data">
		<h4>How many days a person has been alive</h4>
		<label for="Firstname">First Name: </label>
		<input type="text" name="Firstname" id="Firstname"/>
		<br/>
		<label for="surname">Surname: </label>
		<input type="text" name="surname" id="surname"/>
		<br/>
		<label for="dob-day">Day: </label>
			<select class="round-border" id="dob-day" name="dob-day" data-validate="required:false">
			<option value="">Please select...</option>
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="12">13</option>
			<option value="12">14</option>
			<option value="12">15</option>
			<option value="12">16</option>
			<option value="12">17</option>
			<option value="12">18</option>
			<option value="12">19</option>
			<option value="12">20</option>
			<option value="12">21</option>
			<option value="12">22</option>
			<option value="12">23</option>
			<option value="12">24</option>
			<option value="12">25</option>
			<option value="12">26</option>
			<option value="12">27</option>
			<option value="12">28</option>
			<option value="12">29</option>
			<option value="12">30</option>
			<option value="12">31</option>
			</select>
			
		<label for="dob-month">Month: </label>
			<select class="round-border" id="dob-month" name="dob-month" data-validate="required:false">
			<option value="">Please select...</option>
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			</select>
			
		<label for="dob-year">Year:</label>
			<select class="round-border" id="dob-year" name="dob-year" data-validate="required:false">
			<option value="">Please select...</option>
			<option value="1990">1990</option>
			<option value="1991">1991</option>
			<option value="1992">1992</option>
			<option value="1993">1993</option>
			<option value="1994">1994</option>
			<option value="1995">1995</option>
			<option value="1996">1996</option>
			<option value="1997">1997</option>
			<option value="1998">1998</option>
			<option value="1999">1999</option>
			<option value="2000">2000</option>
			<option value="2001">2001</option>
			<option value="2002">2002</option>
			<option value="2003">2003</option>
			<option value="2004">2004</option>
			<option value="2005">2005</option>
			<option value="2006">2006</option>
			<option value="2007">2007</option>
			<option value="2008">2008</option>
			<option value="2009">2009</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
			<option value="2015">2015</option>
			</select>
			
			<br/>
			<br/>
		<div class="submit">
			<input type="submit" id="submit_button" value="Calculate" />
		</div>
		<input type="hidden" name="FormSubmit" value="true" />
		<br/>
		<?=$Firstname;?>
		<?=$surname;?>
		<?=$hasbeenAliveString;?>
		<?=$MartianDays;?>
		<?=$string;?>
		<?=$resultTable;?>
		</form>
</body>
</html>