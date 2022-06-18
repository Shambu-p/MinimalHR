<?php

error_reporting(!E_DEPRECATED );

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller {

    private String $SecretKey = "my_secret_key";

    function __construct() {
    	parent::__construct();
    	$this->load->helper("jwt_helper");
	}

	function login_post() {

		if(!$this->form_validation->run()){
			$this->response([ "message" => validation_errors()], 500);
			return;
		}

        try {

            $this->load->model('AccountModel');
            $email_matched_user = $this->AccountModel->getAccountByEmail($this->input->post("email"));

            if(!sizeof($email_matched_user) || !password_verify($this->input->post("password"), $email_matched_user["password"])) {
				$this->response(["message" => "incorrect email or password"], 500);
				return;
			}

			$email_matched_user["token"] = $this->tokenStringGenerator($email_matched_user);
			unset($email_matched_user["password"]);
			$this->response($email_matched_user, 200);

        } catch (Exception $ex) {
            $this->response(["message" => $ex->getMessage()], 500);
        }

    }

    function authorization_get($token) {

        try {

            $jwt = new JWT();
			$this->response($jwt->decode($token, $this->SecretKey, 'HS256'), 200);

        } catch (Exception $error) {
			$this->response(["message" => $error->getMessage()], 500);
        }

    }

    function logout($token) {
        Response::prepare([]);
    }

    function tokenStringGenerator($data) {

        $jwt = new JWT();
        return $jwt->encode($data, $this->SecretKey, 'HS256');

    }
}
