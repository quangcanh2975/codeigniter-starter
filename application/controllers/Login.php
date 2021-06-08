<?php

class Login extends CI_Controller
{
	public function load_form(){
		// pass data through view
		// $data = array('title'=>'test', 'message'=> 'Test pass data');
		// $this->load->view('login_view', $data);
		$this->load->view('login_view');
		$this->load->database();
	}
}
