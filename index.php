<?php
require_once("includes/db.php");
$logonSuccess = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $databaseConnector = new DatabaseConnector;
  $logonSuccess = ($databaseConnector->verify_employee_credentials($_POST['user'], $_POST['userpassword']));
  if ($logonSuccess == true) {
    session_start();
    $_SESSION['user'] = $_POST['user'];
    header('Location: personalArea.php');
    exit;
   }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
        <title>Work With DataBase</title>
        <link href = "styles/logonAndMainPageStyles.css" type = "text/css" rel = "stylesheet" media = "all" />
    </head>
    <body>
      <div id = "login">
        <form name = "logon" action = "index.php" method = "POST" style = "visibility:visible">
          <fieldset class = "clearfix">
            <p><span class = "fontawesome-user"></span><input type = "text" value = "Логин" name = "user" onBlur = "if(this.value == '') this.value = 'Логин'" onFocus = "if(this.value == 'Логин') this.value = ''" required></p>
            <p><span class = "fontawesome-lock"></span><input type = "password" name = "userpassword" value = "Пароль" onBlur = "if(this.value == '') this.value = 'Пароль'" onFocus = "if(this.value == 'Пароль') this.value = ''" required></p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") { 
              if (!$logonSuccess){
                echo "Неправильное имя и/или пароль";
              }
            }
            ?>
            <p><input type = "submit" value = "Войти"></p>
          </fieldset>
        </form>
      </div>
    </body>
</html>