<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Actionreport extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('ItinaryCompletioninfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('actionreport', $result);
	}

    public function ItinaryCmpletionStatus($x, $y){
		$this->load->model('ItinaryCompletioninfo');
        $result=$this->ItinaryCompletioninfo->ItinaryCmpletionStatus($x, $y);


}
}