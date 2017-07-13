<?php
require_once("includes/db.php");
session_start();
$databaseConnector = new DatabaseConnector;
$employeeId = $databaseConnector->get_employee_id_by_login($_SESSION['user']);
$result = $databaseConnector->is_chief($employeeId);
$row = mysqli_fetch_array($result);
if ($row["id"] != NULL)
	$databaseConnector->change_experience($_POST["id"]);
header('Location: personalArea.php');
exit;
?>
