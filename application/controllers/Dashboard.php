<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session'
        ));
        $this->load->model(array(
            'preferencias_model'
        ));

        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }

    public function index() {
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = 1;
        
        $where = array(
            'idpreferencia' => 1
        );
        $data['preferencias'] = $this->preferencias_model->get_where($where);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('dashboard/index');
        $this->load->view('layout/footer');
    }

}

?>