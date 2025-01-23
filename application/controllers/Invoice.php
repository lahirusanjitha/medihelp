<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Invoice extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Invoiceinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $data['wood_types'] = $this->Invoiceinfo->get_all_woodtypes();
        $data['customers'] = $this->Invoiceinfo->get_all_customers();
        $viewData = array_merge($result, $data);
		$this->load->view('Invoice', $viewData);
	}
    public function Invoiceinsertupdate(){
		$this->load->model('Invoiceinfo');
        $result=$this->Invoiceinfo->Invoiceinsertupdate();
	}
    public function Invoicestatus($x, $y){
		$this->load->model('Invoiceinfo');
        $result=$this->Invoiceinfo->Invoicestatus($x, $y);
	}
    public function Invoiceedit(){
		$this->load->model('Invoiceinfo');
        $result=$this->Invoiceinfo->Invoiceedit();
	}
}