<?php
	$connectionFile = $_SERVER['DOCUMENT_ROOT'] . "connexion/Database.php";
	include($connectionFile);

	$db = new Connexion();


	$today = getdate();
	$m = $today['mon'];
	$j = $today['mday'];

	if($m < 10)
	{
		$m = '0' . $today['mon'];
	}

	if($j < 10)
	{
		$j = '0' . $today['mday'];
	}


	$jour = $today['year'] .  '-' . $m . '-' . $j;

	echo '
	<form method="post">
		<input type="date" name="date" id="date" value="' . $jour . '" />
		<input type="submit" value="Filtrer" />
	</form>';



	$resultats = $db->select('SELECT * FROM Absence');

	echo '<table>
		<tr>
			<th>IdAbsence</th>
			<th>HeureD</th>
			<th>StatuTraitement</th>
			<th>HeureF</th>
			<th>IdProf</th>
			<th>IdEleve</th>
			<th>IdDate</th>
			<th>IdAdmin</th>
		</tr>';
	while($l = $resultats->fetch())
	{
		echo '<tr>';
		foreach ($l as $key => $value) {
			if(is_numeric($key))
			{
				echo '<td>' . $value . '</td>';
			}
		}
		echo '</tr>';
	}
	echo "</table>";
?>