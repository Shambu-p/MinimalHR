<?php

class Auth extends CI_Controller {

    private String $SecretKey = "my_secret_key";

    function login($email, $password) {

        try {

            $this->load->model('UsersModel');
            $email_matched_users = $this->UsersModel->getUserByEmail($email);

            foreach ($email_matched_users as $user) {
                if (password_verify($password, $user["password"])) {
                    $user["token"] = $this->tokenStringGenerator($user);
                    unset($user["password"]);
                    Response::prepare($user);
                    break;
                }
            }

        } catch (Exception $ex) {
            Response::prepareError($ex->getMessage());
        }

    }

    function authorization($token) {

        try {

            $jwt = new JWT();
            Response::prepare($jwt->decode($token, $this->SecretKey, 'HS256'));
            
        } catch (Exception $error) {
            Response::prepareError($error->getMessage());
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
