<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reservas extends CI_Controller {

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

    public function listar() {
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = 2;

        $where = array(
            'idpreferencia' => 1
        );
        $preferencias = $this->preferencias_model->get_where($where);

        $datos_post = http_build_query(
                array(
                    'access_token' => $preferencias['access_token'],
                    'data' => array(
                        'filter' => array(
                            'bookings_date_from' => "1516060800",
                            'bookings_date_to' => "1533035968",
                            'show_deleted' => 1,
                            'checked_in' => 1
                        )
                    )
                )
        );

        $opciones = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $datos_post
            )
        );

        $contexto = stream_context_create($opciones);

        $data['resultado'] = file_get_contents('https://api.turitop.com/v1/booking/getbookings', false, $contexto);


        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('reservas/listar');
        $this->load->view('layout/footer');
    }

}

?>