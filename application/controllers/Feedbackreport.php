<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Feedbackreport extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Dashboardinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['user'] = $this->Dashboardinfo->getUser();
		$this->load->view('feedbackreport', $result);
	}
}