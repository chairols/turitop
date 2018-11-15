<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Preferencias_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_where($where) {
        $this->db->select('*');
        $this->db->from('preferencias');
        $this->db->where($where);
        
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function update($datos, $where) {
        $this->db->update('preferencias', $datos, $where);
        return $this->db->affected_rows();
    }
}

?>