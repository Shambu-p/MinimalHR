<?php

class EmployeeModel extends CI_Model {

	private string $table_name = 'Employee';

	/**
	 * @param $full_name string
	 *        includes employees name, father's name and grand father's name
	 * @param $email string
	 *        email address
	 * @param $profile_picture string
	 *        image file path on server
	 * @param $document string
	 *        file path on server
	 * @param $salary double
	 *        employee's salary
	 * @param $phone_number string
	 *        employee phone number it may include none number character '+'
	 * @param $education_level string
	 *        it should be one of the following
	 *          ('ba', 'bsc', 'beng', 'llb', 'marts', 'mbiol', 'mcomp', 'meng', 'mmath', 'mphys', 'msci', 'ma', 'msc', 'mba', 'mphil', 'mres', 'llm', 'phd')
	 * @param $department_id int
	 *        department's identifier number
	 * @param string $position
	 * 		  place the employee works on
	 * @param int $vacancy_id
	 *          if this method is called from application request
	 *          handler it needs to specify it vacancy id to which this employee data is created for
	 *          if it is called from register employee method then it should not specify vacancy id
	 * @return array
	 *           returns the inserted data in to the database
	 */
	function registerEmployee(string $full_name, string $email, string $profile_picture, string $document, float $salary, string $phone_number, string $education_level, int $department_id, string $position, int $vacancy_id = 0){

		$this->db->insert($this->table_name, [
			"full_name" => $full_name,
			"email" => $email,
			"profile_picture" => $profile_picture,
			"documents" => $document,
			"salary" => $salary,
			"phone_number" => $phone_number,
			"education_level" => $education_level,
			"employee_department" => $department_id,
			"position" => $position,
			"status" => "pending"
		]);

		$employee_id = $this->db->insert_id();
		$generated_application_number = $vacancy_id ? intval($vacancy_id . $employee_id) : intval($employee_id . $vacancy_id);

		$this->db->set("application_number", $generated_application_number);
		$this->db->update($this->table_name);

		return [
			"id" => $employee_id,
			"full_name" => $full_name,
			"email" => $email,
			"profile_picture" => $profile_picture,
			"documents" => $document,
			"salary" => $salary,
			"phone_number" => $phone_number,
			"education_level" => $education_level,
			"employee_department" => $department_id,
			"application_number" => $generated_application_number
		];

	}

}
