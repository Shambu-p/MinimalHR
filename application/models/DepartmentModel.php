<?php

class DepartmentModel extends CI_Model {

	private string $table_name = "Department";

	/**
	 * creating new department
	 * @param string $name
	 *          the department name or title
	 * @param int $department_head
	 *          employee id which exist in employee table
	 *          assigns department head for the department
	 * @return array
	 */
	function createDepartment(string $name, int $department_head = 0){

		if($department_head){
			$this->db->insert($this->table_name, [
				"name" => $name,
				"department_head" => $department_head
			]);
		}else{
			$this->db->insert($this->table_name, [
				"name" => $name
			]);
		}

		return [
			"name" => $name,
			"department_head" => $department_head
		];

	}

	/**
	 * changing department details
	 * @param int $department_id
	 *          department identifier number
	 * @param string $department_name
	 *          the new department title or name to be changed
	 *          in place of the previous name or title
	 * @param int $department_head
	 *          employee's identifier number which wanted to be assigned
	 *          for the department head position in place of the previous head
	 * @return array
	 */
	function updateDepartment(int $department_id, string $department_name, int $department_head){

		$this->db->set("id", $department_id);
		$this->db->set("name", $department_name);
		$this->db->set("department_head", $department_head);
		$this->db->update($this->table_name);

		return [
			"id" => $department_id,
			"name" => $department_name,
			"department_head" => $department_head
		];

	}

}