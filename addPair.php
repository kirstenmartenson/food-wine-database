<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","lallyk-db","2eAZ1GEvgLgqcnDe","lallyk-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
	<meta charset="utf-8"/>
	
	<link rel="stylesheet" type="text/css" href="foodWineDB.css" />

	
</head>
	<?php
if(!($stmt = $mysqli->prepare("INSERT INTO pair (food_id, wine_id)
VALUES ((SELECT id FROM food WHERE name = ?), (SELECT id FROM wine WHERE name = ?))"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss",$_POST['food_name'],$_POST['wine_name']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "You added " . $stmt->affected_rows . " row to our pair list, thank you!";
}
?>
       	<div class="button"><a href="food-wine-DB-main.php">Return To Main Page</a></div>
    </html>