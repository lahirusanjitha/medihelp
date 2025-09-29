<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboardinfo');
    }

    public function index() {
        $this->load->model('Commeninfo');
        $result['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
        $result['user'] = $this->Dashboardinfo->getUser();
        $result['monthly_summary'] = $this->getCurrentMonthFeedbackSummary();
        $this->load->view('dashboard', $result);  
    }

    public function getPostponedRecords() {
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $bdm = $this->input->post('bdm');
        $records = $this->Dashboardinfo->getPostponedRecords($year,$month,$bdm);
        echo json_encode($records);
    }

    public function getCanceledRecords() {
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $bdm = $this->input->post('bdm');
        $records = $this->Dashboardinfo->getCanceledRecords($year,$month,$bdm);
        echo json_encode($records);
    }

    public function getCompletedRecords() {
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $bdm = $this->input->post('bdm');
        $records = $this->Dashboardinfo->getCompletedRecords($year,$month,$bdm);
        echo json_encode($records);
    }

    public function getMissingRecords() {
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $bdm = $this->input->post('bdm');
        $records = $this->Dashboardinfo->getMissingRecords($year,$month,$bdm);
        echo json_encode($records);
    }

    public function getItineraryToApproveCount(){
        $count = $this->Dashboardinfo->getItineraryToApproveCount();
        echo json_encode($count);
    }

    public function getPosponedToApproveCount(){
        $count = $this->Dashboardinfo->getPosponedToApproveCount();
        echo json_encode($count);
    }

    public function getEditRequestToApproveCount(){
        $count = $this->Dashboardinfo->getEditRequestToApproveCount();
        echo json_encode($count);
    }

    public function getECancelApproveCount(){
        $count = $this->Dashboardinfo->getECancelApproveCount();
        echo json_encode($count);
    }
    
    public function getItinerarySubmissionStatus(){
        $this->load->model('Dashboardinfo');
        $data = $this->Dashboardinfo->getTodayItineraryStatus();
        echo json_encode($data);
    }

    public function getCurrentMonthFeedbackSummary() {
        $monthStart = date('Y-m-01');
        $monthEnd   = date('Y-m-t');

        $type    = $this->session->userdata('type');
        $userid = $this->session->userdata('userid'); // adjust field name if different

        $whereUser = "";
        if (!($type == 1 || $type == 2)) {
            // only their own records
            $whereUser = " AND j.tbl_med_user_id = " . $this->db->escape($userid);
        }

        $query = $this->db->query("
            SELECT 
                COUNT(j.idtbl_job_list) AS total_jobs,
                COUNT(f.tbl_joblist_idtbl_joblist) AS jobs_with_feedback
            FROM tbl_job_list j
            LEFT JOIN tbl_feedback f 
                ON j.idtbl_job_list = f.tbl_joblist_idtbl_joblist
            WHERE j.start_date BETWEEN '$monthStart' AND '$monthEnd'
            $whereUser
        ");

        $row = $query->row();
        $total = $row->total_jobs;
        $withFeedback = $row->jobs_with_feedback;
        $percentage = ($total > 0) ? round(($withFeedback / $total) * 100, 2) : 0;

        return [
            'total'         => $total,
            'with_feedback' => $withFeedback,
            'percentage'    => $percentage
        ];
    }

}