<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
# defined('BASEPATH') OR exit('No direct script access allowed');

class Hello extends CI_Controller {
	function __construct() {
        // Gọi đến hàm khởi tạo của cha
        parent::__construct();
    }
	public function index($id = 0, $message = '')
	{
		echo 'Hello CodeIgniter ID = ' .$id. ' AND message = '.$message;
	}
	public function other()
	{
		echo 'Other';
	}
}
