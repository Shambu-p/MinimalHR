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
	function registerEmployee(array $request){

		$this->db->insert($this->table_name, [
			"full_name" => $request["full_name"],
			"email" => $request["email"],
			"profile_picture" => $request["profile_picture"],
			"documents" => $request["documents"],
			"salary" => $request["salary"],
			"phone_number" => $request["phone_number"],
			"education_level" => $request["education_level"],
			"employee_department" => $request["department_id"],
			"position" => $request["position"],
			"status" => isset($request["vacancy"]) ? "pending" : "accepted"
		]);

		$employee_id = $this->db->insert_id();
		$generated_application_number = isset($request["vacancy"]) ? intval($request["vacancy"] . $employee_id) : intval($employee_id . $request["vacancy"]);

		$this->db->set("application_number", $generated_application_number);
		$this->db->where("id", $employee_id);
		$this->db->update($this->table_name);

		$address = (array) json_decode($request["address"]);
		$address_array = [];

		foreach($address as $single_address){

			$single_address->employee_id = $employee_id;
			$this->db->insert("address", (array) $single_address);
			$address_array[] = (array) $single_address;

		}

		return [
			"employee" => [
				"id" => $employee_id,
				"full_name" => $request["full_name"],
				"email" => $request["email"],
				"profile_picture" => $request["profile_picture"],
				"documents" => $request["documents"],
				"salary" => $request["salary"],
				"phone_number" => $request["phone_number"],
				"education_level" => $request["education_level"],
				"employee_department" => $request["employee_department"],
				"position" => $request["position"],
				"status" => isset($request["vacancy"]) ? "pending" : "accepted",
				"application_number" => $generated_application_number
			],
			"address" => $address_array
		];

	}

}
