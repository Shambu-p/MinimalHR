<?php
error_reporting(!E_DEPRECATED );

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Employees extends REST_Controller {

	/**
	 * creates new employee on employee table
	 * the requester will be authenticated using sent token
	 * parameters using post method
	 * @parameters using post method
	 * full_name
	 * email
	 * profile_picture
	 * documents
	 * salary
	 * phone_number
	 * education_level
	 * department_id
	 * address
	 * @address is json string containing array of address for example
	 *  [
	 * 		{
	 * 			"email": "the email",
	 * 			"phone_number": "+251983475985", //can be empty
	 * 			"city": "my city",
	 * 			"sub_city": "my sub city",
	 * 			"place_name": "place name can be empty",
	 * 			"street_name": "street name can be empty"
	 * 		},
	 *      {
	 * 			"email": "the email",
	 * 			"phone_number": "+251983475985", //can be empty
	 * 			"city": "my city",
	 * 			"sub_city": "my sub city",
	 * 			"place_name": "place name can be empty",
	 * 			"street_name": "street name can be empty"
	 * 		}
	 * 	]
	 *
	 */
	function register_user_post(){

//		$config = array(
//			array(
//				'field' => 'full_name',
//				'label' => 'full_name',
//				'rules' => 'required'
//			),
//			array(
//				'field' => 'password',
//				'label' => 'Password',
//				'rules' => 'required',
//				'errors' => array(
//					'required' => 'You must provide a %s.',
//				),
//			),
//			array(
//				'field' => 'passconf',
//				'label' => 'Password Confirmation',
//				'rules' => 'required'
//			),
//			array(
//				'field' => 'email',
//				'label' => 'Email',
//				'rules' => 'required'
//			)
//		);
//
//		$this->form_validation->set_rules($config);

		$this->load->model("EmployeeModel");

//		$this->response($this->EmployeeModel->registerEmployee($this->input->post()), 200);
		$this->response($this->EmployeeModel->registerEmployee(
				$this->input->post("full_name"),
				$this->input->post("email"),
				$this->input->post("profile_picture"),
				$this->input->post("documents"),
				$this->input->post("salary"),
				$this->input->post("phone_number"),
				$this->input->post("education_level"),
				$this->input->post("department_id"),
				$this->input->post("position")
			),
			200
		);

	}

	function change_password(){

	}

	function change_profile_picture(){

	}

	function suspend_user(){

	}

	function change_employee_status($user_id, $token){

	}

	function delete_user(){

	}

	/**
	 * returns specific employee detail which is identified by employee_id
	 * @param $employee_id string
	 * @param $token string
	 * this is  a php function
	 *
	 * parameters should be sent using get method
	 */
	function employee_detail(string $employee_id, string $token){

	}

	/**
	 * returns employees list after authenticating the requester
	 * using authentication token
	 * @param $token
	 * parameter token should be sent using get method
	 */
	function employee_list($token){

	}

	/**
	 * creates application on employee table without authentication
	 * parameters using post method
	 * @parameters using post method
	 * full_name
	 * email
	 * profile_picture
	 * documents
	 * salary
	 * phone_number
	 * education_level
	 * department_id
	 * address
	 * @address is json string containing array of address for example
	 *  [
	 * 		{
	 * 			"email": "the email",
	 * 			"phone_number": "+251983475985", //can be empty
	 * 			"city": "my city",
	 * 			"sub_city": "my sub city",
	 * 			"place_name": "place name can be empty",
	 * 			"street_name": "street name can be empty"
	 * 		},
	 *      {
	 * 			"email": "the email",
	 * 			"phone_number": "+251983475985", //can be empty
	 * 			"city": "my city",
	 * 			"sub_city": "my sub city",
	 * 			"place_name": "place name can be empty",
	 * 			"street_name": "street name can be empty"
	 * 		}
	 * 	]
	 *
	 */
	function apply(){
		echo json_encode(["hello"]);
	}

	/**
	 * change application status attribute at employee table
	 * after authenticating the requesting user using passed token
	 * @parameters using post method
	 * application_status
	 * token
	 * application_id
	 */
	function change_application_status(){

	}

	/**
	 * creates account and change application status to 'accepted'
	 * @parameters using post method
	 * application_status
	 * token
	 * application_id
	 */
	function accept_application(){

	}

	/**
	 * deletes application which is identified by application number
	 * @parameters using post method
	 *   application_number
	 * 	 token
	 */
	function delete_application(){

	}

	/**
	 * @param $application_id int
	 * @param $token
	 * returns the detail of application which will be identified by application id
	 */
	function application_detail(int $application_id, $token){

	}

	/**
	 * @param $application_status
	 * @param $department_id
	 * @param $vacancy_id
	 * returns all applicant list depending on
	 * application status, department id and vacancy id
	 */
	function application_list($application_status, $department_id, $vacancy_id){

	}

	/**
	 * @param $application_number
	 * checking application for applicant existance
	 * and returning detail of the application
	 */
	function check_application($application_number){

	}

}
