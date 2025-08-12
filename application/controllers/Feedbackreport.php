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

    public function feedback_pdf() {
        $year      = $this->input->get('year');
        $month     = $this->input->get('month');
        $bdm       = $this->input->get('bdm');
        $fromDate  = $this->input->get('fromDate');
        $toDate    = $this->input->get('toDate');

        $this->load->model('PdfFeedbackReport');
        
        $bdmUsername = '';
        if (!empty($bdm)) {
            $this->db->select('name');
            $this->db->from('tbl_res_user'); 
            $this->db->where('idtbl_res_user', $bdm);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                $user = $query->row();
                $bdmUsername = $user->name;
            }
        }
        
        $this->PdfFeedbackReport->generatePdf($year, $month, $bdm, $fromDate, $toDate, $bdmUsername);
    }
    

}