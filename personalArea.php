<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
        <title>Main Page</title>
        <link href = "styles/logonAndMainPageStyles.css" type = "text/css" rel = "stylesheet" media = "all" />
    </head>
    <body>
        <?php
        session_start();
        $welcomeMessage = "Добро пожаловать в отдел, " . $_SESSION['user'] . "!";
        if (array_key_exists("user", $_SESSION)) {
            echo "<div>" . $welcomeMessage . "</div>";
        } else {
            header('Location: index.php');
            exit;
        }
        ?>
        <table cellspacing = "0" >
            <tr><th>ID сотрудника</th><th>Имя</th><th>Фамилия</th><th>Стаж</th>
                <td>
                    <form name = "addNewEmployee" action = "createNewEmployee.php"> 
                        <input class = "button7" type = "submit" value = "ДОБАВИТЬ">
                    </form>
                </td>
                <td>
                    <form name = "backToLogonPage" action = "index.php">
                        <input class = "button7" type = "submit" value = "ВЫХОД"/>
                    </form>
                </td>
            </tr>
            <?php
            require_once("includes/db.php");
            $databaseConnector = new DatabaseConnector;
            $employeeId = $databaseConnector->get_department_id_by_login($_SESSION["user"]);
            $result = $databaseConnector->get_employees_by_department_id($employeeId);
            while($row = mysqli_fetch_array($result)) {
                echo "<tr><td>" . $row["id"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["experience"] . "</td>";
            ?>
            <td>
                <form name = "editEmployeeExperience" action = "changeEmployeeExperience.php" method = "POST">
                    <input type = "hidden" name = "id" value = "<?php echo $row["id"]; ?>">
                    <input class = "button7" type = "submit" name = "employeeId" value = "ПОВЫСИТЬ">
                </form>
            </td>
            <td>
                <form name = "deleteEmployee" action = "deleteEmployee.php" method = "POST">
                    <input type = "hidden" name = "id" value = "<?php echo $row["id"]; ?>">
                    <input class = "button7" type = "submit" name = "deleteEmployee" value = "УВОЛИТЬ">
                </form>
                <form name = "editEmployee" action = "editEmployee.php" method = "POST">
                    <input type = "hidden" name = "id" value = "<?php echo $row["id"]; ?>">
                    <input class = "button7" type = "submit" name = "editEmployee" value = "РЕДАКТИРОВАТЬ">
                </form>
            </td></tr>
            <?php
            }
            mysqli_free_result($result);
            ?>
        </table>
        <div>
            <input class = "button7" name = "departmentList"  type = "submit" value = "ОТДЕЛЫ >>" onclick = "javascript: showHideDepartmentTable()"/>
            <input class = "button7" name = "chiefList"  type = "submit" value = "НАЧАЛЬНИКИ >>" onclick = "javascript: showHideChiefTable()"/>
        </div>
        <form form name = "departmentTable" style = "visibility:hidden">
            <table cellspacing = "0">
                <tr><th>ID отдела</th><th>Наименование</th><td>Таблица отделов</td></tr>
                <?php
                require_once("includes/db.php");
                $databaseConnector = new DatabaseConnector;
                $employeeId = $databaseConnector->get_department_id_by_login($_SESSION["user"]);
                $result = $databaseConnector->get_department_list($employeeId);
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>" . $row["id"] . "</td>";
                    echo "<td>". $row["name"] . "</td>";
                ?>
                </tr>
                <?php
                }
                mysqli_free_result($result);
                ?>
            </table>
        </form>
        <form form name = "chiefTable" style = "visibility:hidden">
            <table cellspacing = "0">
                <tr><th>ID сотрудника</th><th>ID отдела</th><td>Таблица начальников</td></tr>
                <?php
                require_once("includes/db.php");
                $databaseConnector = new DatabaseConnector;
                $employeeId = $databaseConnector->get_department_id_by_login($_SESSION["user"]);
                $result = $databaseConnector->get_chief_list($employeeId);
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>" . $row["worker_id"] . "</td>";
                    echo "<td>" . $row["department_id"] . "</td>";
                ?>
                </tr>
                <?php
                }
                mysqli_free_result($result);
                ?>
            </table>
        </form>
        <script>
        function showHideDepartmentTable() {
            if (document.all.departmentTable.style.visibility == "visible"){
                document.all.departmentTable.style.visibility = "hidden";
                document.all.departmentList.value = "ОТДЕЛЫ >>";
            } else {
                document.all.departmentTable.style.visibility = "visible";
                document.all.departmentList.value = "<< ОТДЕЛЫ";
            }
        }

        function showHideChiefTable() {
            if (document.all.chiefTable.style.visibility == "visible"){
                document.all.chiefTable.style.visibility = "hidden";
                document.all.chiefList.value = "НАЧАЛЬНИКИ >>";
            } else {
                document.all.chiefTable.style.visibility = "visible";
                document.all.chiefList.value = "<< НАЧАЛЬНИКИ";
            }
        }  
        </script>
    </body>
</html>