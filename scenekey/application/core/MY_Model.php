<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function customInsert($options) {
        $table = false;
        $data = false;

        extract($options);

        if ($data) {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }

    public function customInsertBatch($options) {
        $table = false;
        $data = false;

        extract($options);

        if ($data) {
            $this->db->insert_batch($table, $data);
            return $this->db->insert_id();
        }
    }

    public function customDelete($options) {
        $table = false;
        $where = false;

        extract($options);

        if ($where) {
            $this->db->where($where);
            $this->db->delete($table);
            return $this->db->affected_rows();
        }
    }
   
    public function customUpdate($options) {
        $table = false;
        $where = false;
        $data = false;

        extract($options);

        if (!empty($where))
            $this->db->where($where);

        $this->db->update($table, $data);

        return $this->db->affected_rows();
    }

    public function updateBatch($options) {
        $table = false;
        $where = false;
        $data = false;
        $where_column = false;

        if (!empty($where))
            $this->db->where($where);

        $this->db->update_batch($table, $data, $where_column);

        $this->db->affected_rows();
    }

    public function customGet($options) {
        
        $select = false;
        $table = false;
        $join = false;
        $order = false;
        $limit = false;
        $offset = false;
        $where = false;
        $or_where = false;
        $single = false;
        $group = false;

        extract($options);

        if ($select != false)
            $this->db->select($select);

        if ($table != false)
            $this->db->from($table);

        if ($where != false)
            $this->db->where($where);

        if ($or_where != false)
            $this->db->or_where($or_where);
        
        if ($group != false) 
            $this->db->group_by($group);

        if ($limit != false) {

            if (!is_array($limit)) {
                $this->db->limit($limit);
            } else {
                foreach ($limit as $limitval => $offset) {
                    $this->db->limit($limitval, $offset);
                }
            }
        }

        if ($order != false) {

            foreach ($order as $key => $value) {

                if (is_array($value)) {
                    foreach ($order as $orderby => $orderval) {
                        $this->db->order_by($orderby, $orderval);
                    }
                } else {
                    $this->db->order_by($key, $value);
                }
            }
        }

        if ($join != false) {

            foreach ($join as $key => $value) {

                if (is_array($value)) {
                    if (count($value) == 3) {
                        $this->db->join($value[0], $value[1], $value[2]);
                    } else {
                        foreach ($value as $key1 => $value1) {
                            $this->db->join($key1, $value1);
                        }
                    }
                } else {
                    $this->db->join($key, $value);
                }
            }
        }

        $query = $this->db->get();
        // echo $this->db->query_last();die;

        if ($single) {
            return $query->row();
        }

        return $query->result();
       
    }

    public function customQuery($query, $single = false, $updDelete = false) {
        $query = $this->db->query($query);

        if ($single) {
            return $query->row();
        }

        if ($updDelete) {
            return $this->db->affected_rows();
        }

        return $query->result();
    }

    public function customQueryCount($query) {
        return $this->db->query($query)->num_rows();
    }

    public function idEncrypt($id) {
        $str = $id * 55;
        return $str;
    }

    public function idDecrypt($id) {
        $str = $id / 55;
        return $str;
    }
    /* ID encryption for Front end start */
    public function idFrontEncrypt($id) {
        $str = ($id + 33)+2;
        return $str;
    }

    public function idFrontDecrypt($id) {
        $str = ($id - 33)-2;
        return $str;
    }
   /* ID encryption for Front end End */
}
