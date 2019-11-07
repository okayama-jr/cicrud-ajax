<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class blog_model extends CI_Model {

    public function getBlog(){
        $this->db->order_by('created_at','desc');
        $query = $this->db->get('tbl_blogs');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function submit(){
        $field = array(
            'title' => $this->input->post('txt_title'),
            'description' => $this->input->post('txt_description'),
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tbl_blogs', $field);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getBlogById($id){
        $this->db->where('id',$id);
        $query = $this->db->get('tbl_blogs');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    public function update(){
        $field = array(
            'title' => $this->input->post('txt_title'),
            'description' => $this->input->post('txt_description')
        );
        $this->db->where('id',$this->input->post('txt_id'));
        $this->db->update('tbl_blogs',$field);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return  false;
        }
    }
    
    public function deleteBlogById($id){
        $this->db->where('id',$id);
        $this->db->delete('tbl_blogs');
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}