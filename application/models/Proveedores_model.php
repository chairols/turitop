<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function set($datos) {
        $this->db->insert('proveedores', $datos);
        return $this->db->insert_id();
    }
    
    public function gets_where($where) {
        $this->db->select('*');
        $this->db->from('proveedores');
        $this->db->where($where);
        $this->db->order_by('proveedor');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function update($datos, $where) {
        $this->db->update('proveedores', $datos, $where);
        return $this->db->affected_rows();
    }
}

?>