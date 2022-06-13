<?php
error_reporting(!E_DEPRECATED );

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Employees extends REST_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("EmployeeModel");
	}

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
	function register_employee_post(){

		if(!$this->form_validation->run()){
			$this->response([
				"message" => validation_errors()
			], 500);
			return;
		}

		$this->load->library('upload', [
			'upload_path' => './uploads/profile_pictures',
			'file_name' => 'profile_pic_' . $this->input->post("email") . '.png',
			'allowed_types' => ['jpg', 'png', 'ico', 'jpeg'],
			'max_size' => 1000
		]);

		if(!$this->upload->do_upload('profile_picture')){
			$this->response(
				["message" => "image file: " . $this->upload->display_errors()],
				500
			);
			return;
		}else{
			$profile_upload = $this->upload->data();
		}

		$this->upload = null;
		$this->load->library('upload', [
			'upload_path' => './uploads/documents',
			'file_name' => 'application_doc_'.$this->input->post("email").'.zip',
			'allowed_types' => ['zip'],
			'max_size' => 1000
		]);

		if(!$this->upload->do_upload('documents')){
			$this->response(
				["message" => "document file: " . $this->upload->display_errors()],
				500
			);
			return;
		}else{
			$document_upload = $this->upload->data();
		}

		$this->response(
			[
				"profile_picture" => $profile_upload,
				"document" => $document_upload
			],
			500
		);

		$requests = $this->input->post();
		$requests["profile_picture"] = $profile_upload["file_name"];
		$requests["documents"] = $document_upload["file_name"];

		$this->response($this->EmployeeModel->registerEmployee($requests), 200);

	}

	/**
	 * changes employee password identified by employee id
	 */
	function change_password_post(){

		if(!$this->form_validation->run()){
			$this->response([
				"message" => validation_errors()
			], 500);
			return;
		}

		if($this->input->post("new_password") != $this->input->post("confirm_password")){
			$this->response([
				"message" => "password confirmation doesn't match with the new password"
			], 500);
		}

		$this->load->model("AccountModel");

		try{

			$this->response(
				$this->AccountModel->changePassword(
					$this->input->post("employee_id"),
					$this->input->post("old_password"),
					$this->input->post("new_password")
				),
				200
			);

		} catch(Exception $exception) {
			$this->response(
				["message" => $exception->getMessage()],
				500
			);
		}

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
