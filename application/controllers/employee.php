<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class employee extends CI_Controller {
    function __construct(){
        parent:: __construct();
        $this->load->model('employee_model','model');
        $this->load->model('main_model','m');
    }

    public function index(){
        $this->load->view('layout/header');
        $this->load->view('employee/index');
        $this->load->view('layout/footer');
    }

    public function showAllEmployee(){
        $result = $this->model->showAllEmployee();
        echo json_encode($result);
    }

    public function addEmployee(){
        $result = $this->model->addEmployee();
        $msg['success'] = false;
        $msg['type'] = 'add';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function editEmployee(){
        $result = $this->model->editEmployee();
        echo json_encode($result);
    }

    public function updateEmployee(){
        $result = $this->model->updateEmployee();
        $msg['success'] = false;
        $msg['type'] = 'update';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function deleteEmployee(){
        $result = $this->model->deleteEmployee();
        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
}