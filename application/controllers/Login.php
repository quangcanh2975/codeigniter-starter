<?php

class Login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function load_form(){

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('login_view');
		}
		else {
			$this->optional_login();
			redirect('/news');
			// if( $this->verify_min_level(1) ){
			// echo 'You logged in';
			// redirect('/news');
			// }
			// else if($this->optional_login())
			// {
			// echo 'successfully';
			// redirect('/');
			// }
			// else {
			// echo 'No login';
			// }


		}
	}
}
