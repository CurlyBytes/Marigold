<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Marigold\Domain\SharedKernel\OktaApiService as Okta;

class User extends CI_Controller
{
    protected $okta;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('MUser');
        $this->okta = new Okta;
    }

    public function login()
    {
        if (! isset($this->session->username)) {
            $state = bin2hex(random_bytes(5));
            $authorizeUrl = $this->okta->buildAuthorizeUrl($state);
            $this->session->state = $state;
            redirect($authorizeUrl, 'refresh');
        }

        redirect('/');
    }

    public function callback()
    {
        if (isset($_GET['code'])) {
            $result = $this->okta->authorizeUser($this->session->state);
            if (isset($result['error'])) {
                echo $result['errorMessage'];
                die();
            }
        }

        $userId = $this->MUser->find_or_create($result['username']);

        $this->session->userId = $userId;
        $this->session->username = $result['username'];
        redirect('/');
    }

    public function logout()
    {
        session_destroy();
        $this->session->userId = null;
        $this->session->username = null;
        redirect('login');
    }
}