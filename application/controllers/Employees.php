<?php


class Employees extends CI_Controller {

	function register_user(){

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

	function employee_detail($employee_id, $token){

	}

	function employee_list($token){

	}

	/**
	 * creates application on employee table without authentication
	 * parameters using post method
	 * @parameters using post method
	 * full_name
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
	 * @param $application_id
	 * @param $token
	 * returns the detail of application which will be identified by application id
	 */
	function application_detail($application_id, $token){

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
