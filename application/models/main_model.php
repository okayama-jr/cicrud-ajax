<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model
{
    public $default = '';
    public function __construct()
    {
        parent::__construct();
        $this->default = $this->load->database("default", TRUE);
    }
    public function queryData($data){
        $database = $this->default;
        if(!empty($data['database'])){
            $database = $this->$data['database'];
        }
        return $database->query($data['query']);
    }

    public function loadData($data){
        $database = $this->default;
        if(!empty($data['database'])){
            $database = $this->$data['database'];
        }
        $database->from($data['table']);
        if(!empty($data['join'])){
            foreach($data['join'] as $join){
                if(!empty($join['specific'])){
                    $database->join($join['table'], $join['on'], $join['specific']);
                }else{
                    $database->join($join['table'], $join['on']);
                }
            }
        }
        if(!empty($data['select'])){
            $database->select($data['select']);
        }
        if(!empty($data['where'])){
            $database->where($data['where']);
        }
        if(!empty($data['orWhere'])){
            $database->or_where($data['orWhere']);
        }
        if(!empty($data['like'])){
            $database->like($data['like']);
        }
        if(!empty($data['notLike'])){
            $database->not_like($data['notLike']);
        }
        if(!empty($data['or_like']['like'])){
            $database->group_start();
            $database->or_like('title',$data['or_like']['like']);
            $database->group_end();
        }
        if(!empty($data['limit'])){
            if(!empty($data['start'])){
                $database->limit($data['limit'],$data['start']);
            }else{
                $database->limit($data['limit']);
            }
        }
        if(!empty($data['group'])){
            $database->group_by($data['group']);
        }
        if(!empty($data['order'])){
            $database->order_by($data['order'],@$data['action']);
        }
        $get = $database->get();
        return $get;
    }

    public function updateData($data){
        $database = $this->default;
        if(!empty($data['database'])){
            $database = $this->$data['database'];
        }
        $database->where($data['where']);
        return $database->update($data['table'],$data['update']);
    }

    public function deleteData($data){
        $database = $this->default;
        if(!empty($data['database'])){
            $database = $this->$data['database'];
        }
        $database->where($data['where']);
        return $database->delete($data['table']);
    }

    public function insertData($data){
        $database = $this->default;
        if(!empty($data['database'])){
            $database = $this->$data['database'];
        }
        return $database->insert($data['table'],$data['insert']);
    }

    public function trans_begin(){
        $database = $this->default;
        $database->trans_begin();
    }

    public function trans_status(){
        $database = $this->default;
        $database->trans_status();
    }

    public function trans_rollback(){
        $database = $this->default;
        $database->trans_rollback();
    }

    public function trans_commit(){
        $database = $this->default;
        $database->trans_commit();
    }

    public function transactios(){

        $database = $this->default;

        $database->trans_begin();
        $database->query("UPDATE user SET ip = '5' WHERE user_id = 1");
        $database->query("UPDATE user SET ip = '5' WHERE user_id = 2");
        $database->query("UPDATE user SET ip = '5' WHERE xx = 3");

        if ($database->trans_status() === FALSE) {
            echo 1;
            $database->trans_rollback();
        }
        else {
            echo 2;
            $database->trans_commit();
        }
    }
    

}