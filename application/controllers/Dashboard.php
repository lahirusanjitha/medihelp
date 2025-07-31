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
}