<?php

error_reporting(!E_DEPRECATED );
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Department extends REST_Controller {


	function __construct() {

		parent::__construct();
		$this->load->database();
		$this->load->model("DepartmentModel");

	}

	/**
	 * create new department using department model
	 * parameters needed are
	 * name
	 * department_head
	 *
	 * department head is not needed
	 * but if department head needs to be assigned then it can be specified here
	 * or it can be assigned in assign_department_head request
	 */
	function create_department_post(){

		if(isset($_POST["department_head"])){

			return $this->response(
				$this->DepartmentModel->createDepartment(
					$this->input->post("name"),
					$this->input->post("department_head")
				),
				200
			);

		}else{
			return $this->response(
				$this->DepartmentModel->createDepartment(
					$this->input->post("name")
				),
				200
			);
		}

	}

	/**
	 *
	 */
	function assign_department_head_post(){
//		$this->load->model("")

		return $this->response(
			$this->DepartmentModel->updateDepartment(
				$this->input->post("name"),
				$this->input->post("department_name"),
				$this->input->post("department_head")
			),
			200
		);

	}

}
