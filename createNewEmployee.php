<?php
require_once("includes/db.php");
session_start();
$databaseConnector = new DatabaseConnector;
$idResult = $databaseConnector->get_employee_id_by_login($_SESSION['user']);
$result = $databaseConnector->is_chief($idResult);
$row = mysqli_fetch_array($result);
if ($row["id"] == NULL)
	header('Location: personalArea.php' );
$userLoginIsUnique = true;
$userLoginIsEmpty = false; 
$userFisrtNameIsEmpty = false; 
$userLastNameIsEmpty = false; 
$userPasswordIsEmpty = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
	if ($_POST['userLogin'] == "") {
		$userLoginIsEmpty = true;
	}
	if ($_POST['userFirstName']=="") {
		$userFisrtNameIsEmpty = true;
	}
	$employeeId = $databaseConnector->get_employee_id_by_login($_POST["userLogin"]);
	if ($employeeId != NULL) {
		$userLoginIsUnique = false;
	}
	if ($_POST['userLastName'] == "") {
		$userLastNameIsEmpty = true;
	}
	if ($_POST['userPassword'] == "") {
		$userPasswordIsEmpty = true;
	}
	if (!$userFisrtNameIsEmpty && !$userLoginIsEmpty && $userLoginIsUnique && ! $userLastNameIsEmpty && ! $userPasswordIsEmpty) {
		$departmentId = $databaseConnector->get_department_id_by_login($_SESSION["user"]);
		$databaseConnector->create_employee($_POST["userLogin"], $_POST["userFirstName"], $_POST["userLastName"], $departmentId, $_POST['userPassword']);
		header('Location: personalArea.php');
		exit;
	}
}
?>

<html>
	<head>
		<meta http-equiv = "content-type" content = "text/html; charset=UTF-8">
		<title>Create New Employee Page</title>
		<link href = "styles/createAndUpdatePageStyles.css" type = "text/css" rel = "stylesheet" media = "all"/>
	</head>
	<body>
		<form action = "createNewEmployee.php" method = "POST">
			Логин: <input class = "st1" type = "text" name = "userLogin" value = "<?php echo $_POST['userLogin']; ?>"/><br/>
			<?php
			if ($userLoginIsEmpty) {
				echo ("Пожалуйста, введите логин.");
				echo ("<br/>");
			}
			if (!$userLoginIsUnique) {
				echo ("Такое логин уже существует. Проверьте введенный текст и повторите ввод.");
				echo ("<br/>");
			}
			?>
			Имя: <input class = "st2" type = "text" name = "userFirstName" value = "<?php echo $_POST['userFirstName']; ?>"/><br/>
			<?php
			if ($userFisrtNameIsEmpty) {
				echo ("Пожалуйста, введите имя.");
				echo ("<br/>");
			}
			?>
			Фамилия: <input class = "st3" type = "text" name = "userLastName" value = "<?php echo $_POST['userLastName']; ?>"/><br/>
			<?php
			if ($userLastNameIsEmpty) {
				echo ("Пожалуйста, введите фамилию.");
				echo ("<br/>");
			} 
			?>
			Пароль: <input class = "st4" type = "password" name = "userPassword" value = "<?php echo $_POST['userPassword']; ?>"/><br/>
			<?php
			if ($userPasswordIsEmpty) {
				echo ("Пожалуйста, введите пароль.");
				echo ("<br/>"); 
			} 
			?>
			<input class = "st5" type = "submit" value = "ДОБАВИТЬ СОТРУДНИКА"/>
		</form>
	</body>
</html>
