<?php
require_once("includes/db.php");
session_start();
$databaseConnector = new DatabaseConnector;
$idResult = $databaseConnector->get_employee_id_by_login($_SESSION['user']);
$result = $databaseConnector->is_chief($idResult);
$row = mysqli_fetch_array($result);
if ($row["id"] == NULL) {
	header('Location: personalArea.php');
}
if (!array_key_exists("user", $_SESSION)) {
	header('Location: index.php');
	exit;
}
if ($_POST["id"] == "") {
	$employee = array("id" => $_POST["employeeId"], "firstName" => $databaseConnector->get_first_name_by_id($_POST["employeeId"]), "lastName" => $databaseConnector->get_last_name_by_id($_POST["employeeId"]));
} else {
	$employee = array("id" => $_POST["id"], "firstName" => $databaseConnector->get_first_name_by_id($_POST["id"]), "lastName" => $databaseConnector->get_last_name_by_id($_POST["id"]));
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (array_key_exists("back", $_POST)) {
		header('Location: personalArea.php'); 
		exit;
	}
	if ($_POST['employeeFirstName'] == "") {
	} else if ($_POST['employeeLastName'] == "") {
	} else if ($_POST["employeeId"] != "") {
		$databaseConnector->update_employee($_POST["employeeId"], $_POST['employeeFirstName'], $_POST["employeeLastName"]);
		header('Location: personalArea.php');
		exit;
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
		<title>Edit Employee Page</title>
		<link href = "styles/createAndUpdatePageStyles.css" type = "text/css" rel = "stylesheet" media = "all" />
	</head>
	<body>
		<form name = "editEmployeer" action = "editEmployee.php" method = "POST">
			<input type = "hidden" name = "employeeId" value = "<?php echo $employee['id']; ?>">
			Имя: <input class = "st6" type = "text" name = "employeeFirstName" value = "<?php echo $employee['firstName']; ?>"/><br/>
			Фамилия: <input class = "st7" type = "text" name = "employeeLastName" value = "<?php echo $employee['lastName']; ?>"/><br/>
			<input class = "st8" type = "submit" name = "saveChanges" value = "СОХРАНИТЬ ИЗМЕНЕНИЯ"/><br/>
			<input class = "st8" type = "submit" name = "back" value = "ВЕРНУТЬСЯ НАЗАД"/>
		</form>
	</body>
</html>
