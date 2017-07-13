<?php 
/** Class for connecting and working with  Database tables. */
class DatabaseConnector extends mysqli {
	/** Database host. */
	private $dbHost = "localhost";
	/** Database username. */
	private $user = "root";
	/** Database  user password. */
	private $pass = "1608";
	/** Database name. */
	private $dbName = "pp";

	/** Class constructor. */
	public function __construct() {
		parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
		if (mysqli_connect_error()) {
			exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		}
		parent::set_charset('utf8');
		parent::query("SET lc_time_names = 'ru_RU'");
	}

	/** Return employee id by his login. */
	public function get_employee_id_by_login($login) {
		$worker = $this->query("SELECT id FROM Employee_Strelnikov WHERE login = '" . $login . "'");
		if ($worker->num_rows > 0) {
			$row = $worker->fetch_row();
			return $row[0];
		} else return null;
	}

	/** Return department id by his login. */
	public function get_department_id_by_login($login) {
		$worker = $this->query("SELECT department_id FROM Employee_Strelnikov WHERE login = '" . $login . "'");
		if ($worker->num_rows > 0) {
			$row = $worker->fetch_row();
			return $row[0];
		} else return null;
	}

	/** Return employee first name by his id. */
	public function get_first_name_by_id($employeeId) {
		$worker = $this->query("SELECT first_name FROM Employee_Strelnikov WHERE id = '" . $employeeId. "'");
		if ($worker->num_rows > 0) {
			$row = $worker->fetch_row();
			return $row[0];
		} else return null;
	}

	/** Return employee last name by his id. */
	public function get_last_name_by_id($employeeId) {
		$worker = $this->query("SELECT last_name FROM Employee_Strelnikov WHERE id = '" . $employeeId. "'");
		if ($worker->num_rows > 0) {
			$row = $worker->fetch_row();
			return $row[0];
		} else return null;
	}

	/** Return employees by department id. */
	public function get_employees_by_department_id($departmentId) {
		return $this->query("SELECT id, first_name, last_name, experience FROM Employee_Strelnikov WHERE department_id = " . $departmentId);
	}

	/** Return  all departments. */
	public function get_department_list($name) {
		return $this->query("SELECT id, name FROM Department_Strelnikov");
	}

	/** Return all chiefs of departments. */
	public function get_chief_list($name) {
		return $this->query("SELECT worker_id, department_id FROM ChiefOfDepartment_Strelnikov");
	}

	/** Check on department chief by employee id. */
	public function is_chief($employeeId) {
		return $this->query("SELECT id FROM ChiefOfDepartment_Strelnikov WHERE worker_id = " . $employeeId);
	}

	/** Creating new employee. */
	public function create_employee($login, $firstName, $lastName, $departmentId, $password) {
		$experience = 0;
		$this->query("INSERT INTO Employee_Strelnikov (login, first_name, last_name, department_id, experience) 
			VALUES ('" . $login . "', '" . $firstName . "', '" . $lastName . "', " . $departmentId . ", " . $experience . ")");
		$employeeId = $this->get_employee_id_by_login($login);
		$this->query("INSERT INTO Authorization_Strelnikov (worker_id, worker_login, password) VALUES (" . $employeeId . ", '" . $login . "', '" . $password . "')");
	}

	/** Verifying employee on login. */
	public function verify_employee_credentials($name, $password) {
		$result = $this->query("SELECT 1 FROM Authorization_Strelnikov WHERE worker_login = '" . $name . "' AND password = '" . $password . "'");
		return $result->data_seek(0);
	}

	/** Change employee experience. */
	public function change_experience($employeeId) {
		$this->query("UPDATE Employee_Strelnikov SET experience = experience + 1 WHERE id = " . $employeeId);
	}

	/** CUpdate employee information. */
	public function update_employee($employeeId, $firstName, $lastName) {
		$this->query("UPDATE Employee_Strelnikov SET first_name = '" . $firstName . "', last_name = '" . $lastName . "' WHERE id = " . $employeeId);
	}

	/** Delete employee. */
	public function delete_employee($employeeId) {
		$this->query("DELETE FROM ChiefOfDepartment_Strelnikov WHERE worker_id = " . $employeeId);
		$this->query("DELETE FROM Authorization_Strelnikov WHERE worker_id = " . $employeeId);
		$this->query("DELETE FROM Employee_Strelnikov WHERE id = " . $employeeId);
	}
} 
?>