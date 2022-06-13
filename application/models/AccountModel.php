<?php

class AccountModel extends CI_Model {

	private string $table_name = "Account";

	public function __construct() {
		parent::__construct();
	}

	/**
	 * @param $employee_id
	 *            employee's identifier number
	 * @param $old_password
	 *            the password to be changed or replaced
	 * @param $new_password
	 *            the password to be set in place of the previous
	 * @return array
	 * @throws Exception
	 */
	function changePassword($employee_id, $old_password, $new_password){

		$employee = $this->db->get_where($this->table_name, ["employee_id" => $employee_id])->result();
		if(sizeof($employee) < 1){
			throw new Exception("account not found");
		}

		$account = $employee[0];
		if(!password_verify($old_password, $account["password"])){
			throw new Exception("incorrect password");
		}

		$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
		$this->db->set("password", $hashed_password);
		$this->db->where("employee_id", $employee_id);
		$this->db->update($this->table_name);

		$account["password"] = $hashed_password;

		return $account;

	}

}
