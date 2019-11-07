<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class blog extends CI_Controller {

    function __construct(){
        parent:: __construct();
        $this->load->model('blog_model','m');
    }

    public function index(){
        $data['result'] = $this->m->getBlog();
        
        $this->load->view('layout/header');
        $this->load->view('blog/index', $data);
        $this->load->view('layout/footer');
    }

    public function add(){
        $this->load->view('layout/header');
        $this->load->view('blog/add');
        $this->load->view('layout/footer');
    }

    public function submit(){
        $result = $this->m->submit();
        if($result){
            $this->session->set_flashdata('success_msg','Record added successfully');
        }else{
            $this->session->set_flashdata('error_msg','Failed to add record');
        }
        redirect(base_url('blog/index'));
    }

    public function edit($id){
        $data['result'] = $this->m->getBlogById($id);

        $this->load->view('layout/header');
        $this->load->view('blog/edit',$data);
        $this->load->view('layout/footer');
    }

    public function update(){
        $result = $this->m->update();
        if($result){
            $this->session->set_flashdata('success_msg','Record Edited Successfully');
        }else{
            $this->session->set_flashdata('error_msg','Failed to edit record');
        }
        redirect(base_url('blog/index'));
    }

    public function delete($id){
        $result = $this->m->deleteBlogById($id);
        if($result){
            $this->session->set_flashdata('success_msg','Record Deleted Successfully');
        }else{
            $this->session->set_flashdata('error_msg','Failed to delete record');
        }
        redirect(base_url('blog/index'));
    }
}