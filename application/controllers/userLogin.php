<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class userLogin extends CI_Controller {

	public function index()
	{
		$this->load->view('login_view');
	}

	function logout(){
	    session_destroy();
	    redirect('/userLogin');
    }

}
