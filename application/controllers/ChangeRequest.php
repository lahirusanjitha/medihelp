<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class ChangeRequest extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('ChangeRequestinfo');
        $this->load->model('Dashboardinfo');
        $this->load->model('RejectReasoninfo');
        $this->load->model('Itenarycategoryinfo');
        $this->load->model('Itenarygroupinfo');
        $this->load->model('Itenarytypeinfo');
        $this->load->model('Locationinfo');
        $this->load->model('Jobinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['itenarycategory']=$this->Itenarycategoryinfo->Getcategory(); 
        $result['Itenarygroup']=$this->Itenarygroupinfo->getGroup();
        $result['iternarytype'] = $this->Itenarytypeinfo->GetIternarytype();  
        $result['locationdetails'] = $this->Locationinfo->getLocation(); 
        $result['user'] = $this->Dashboardinfo->getUser();
        $result['RejectReason'] = $this->RejectReasoninfo->getRejectReason();
        $result['time'] = $this->Jobinfo->generateFullDayTimeOptions(); 
		$this->load->view('changerequest', $result);
	}

    public function Jobstatus($x, $y){
		$this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->Jobstatus($x, $y);
	}
    public function Jobconfirmstatus($x, $y){
		$this->load->model('ChangeRequestinfo');
        $result=$this->Confirmjobinfo->Jobconfirmstatus($x, $y);
	}
    // public function Editrequest($x, $y){
    //     $this->load->model('ChangeRequestinfo');
    //     $result=$this->ChangeRequestinfo->Editrequest($x, $y);
    // }
    public function editRequest(){
        $this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->editRequest();
    }
    public function ApproveAllJob(){
        $this->load->model('ChangeRequestinfo');
        $result=$this->Confirmjobinfo->ApproveAllJob();
    }
    public function CancelRecord(){
        $this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->CancelRecord();
    }
    public function pospondRecord(){
        $this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->pospondRecord();
    }
    public function getPostponedData(){
        $jobId = $this->input->post('job_id');

        $this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->getPostponedData($jobId);

        echo json_encode($result);
    }
    public function getEditData(){
        $jobId = $this->input->post('job_id');

        $this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->getEditData($jobId);

        echo json_encode($result);
    }
    public function approvePostponedRequest(){
        $jobId = $this->input->post('job_id');

        $this->load->model('ChangeRequestinfo');

        $success = $this->ChangeRequestinfo->approvePostponed($jobId);

        if ($success) {
            echo 'success';
        } else {
            echo 'error';
        }

    }
        public function getCancelData(){
        $jobId = $this->input->post('job_id');

        $this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->getCancelData($jobId);

        echo json_encode($result);
    }

        public function approveCancelRequest(){
        $jobId = $this->input->post('job_id');

        $this->load->model('ChangeRequestinfo');

        $success = $this->ChangeRequestinfo->approveCancelRequest($jobId);

        if ($success) {
            echo 'success';
        } else {
            echo 'error';
        }

    }

        public function approveEditRequest(){
        $jobId = $this->input->post('job_id');

        $this->load->model('ChangeRequestinfo');

        $success = $this->ChangeRequestinfo->approveEditRequest($jobId);

        if ($success) {
            echo 'success';
        } else {
            echo 'error';
        }

    }

    public function rejectCancelRequest(){
        $jobId = $this->input->post('job_id');

        $this->load->model('ChangeRequestinfo');

        $success = $this->ChangeRequestinfo->rejectCancelRequest($jobId);

        if ($success) {
            echo 'success';
        } else {
            echo 'error';
        }

    }
    public function rejectPostponedRequest(){
        $jobId = $this->input->post('job_id');

        $this->load->model('ChangeRequestinfo');

        $success = $this->ChangeRequestinfo->rejectPostponedRequest($jobId);

        if ($success) {
            echo 'success';
        } else {
            echo 'error';
        }

    }

        public function rejectEditRequest() {
        $jobId = $this->input->post('job_id');

        $this->load->model('ChangeRequestinfo');
        $result = $this->ChangeRequestinfo->rejectEdit($jobId);

        if ($result) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

}