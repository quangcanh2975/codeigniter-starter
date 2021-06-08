<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller{
	function news_list(){
		$this->load->model('news_model');
		$newList = $this->news_model->getList();
	}
}
