<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_ultima_fecha() {
        $this->db->select_max("date_booking");
        $this->db->from("bookings");
        
        $query = $this->db->get();
        return $query->row_array();
    } 
    
    public function get_where($where) {
        $query = $this->db->get_where('bookings', $where);
        
        return $query->row_array();
    }
    
    public function set($datos) {
        $this->db->insert('bookings', $datos);
        return $this->db->insert_id();
    }
    
    public function set_client($datos) {
        $this->db->insert('client_data', $datos);
        return $this->db->insert_id();
    }
    
    public function set_ticket_type_count($datos) {
        $this->db->insert('ticket_type_count', $datos);
        return $this->db->insert_id();
    }
}

?>