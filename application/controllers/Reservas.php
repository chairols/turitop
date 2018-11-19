<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reservas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'pagination'
        ));
        $this->load->model(array(
            'preferencias_model',
            'bookings_model'
        ));

        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }

    public function listar($pagina = 0) {
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = 2;



        /*
         *  Obtengo short id y secret key
         */
        $where = array(
            'idpreferencia' => 1
        );
        $preferencias = $this->preferencias_model->get_where($where);

        if ($pagina == 0) {
            /*
             *  Obtengo de la API el access token
             */
            $datos_post = http_build_query(
                    array(
                        'short_id' => $preferencias['short_id'],
                        'secret_key' => $preferencias['secret_key']
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

            $resultado = json_decode(file_get_contents('https://api.turitop.com/v1/authorization/grant', false, $contexto));

            /*
             *  Guardo el access token en base de datos
             */
            $datos = array(
                'access_token' => $resultado->data->access_token
            );
            $where = array(
                'idpreferencia' => 1
            );
            $this->preferencias_model->update($datos, $where);

            /*
             *  Obtengo el access token de la base de datos
             */
            $where = array(
                'idpreferencia' => 1
            );
            $preferencias = $this->preferencias_model->get_where($where);

            /*
             *  Obtengo la ultima fecha de la última reserva
             */
            $ultima_fecha = $this->bookings_model->get_ultima_fecha();

            if ($ultima_fecha['date_booking'] == null) {
                $ultima_fecha['date_booking'] = 0;
            }


            $datos_post = http_build_query(
                    array(
                        'access_token' => $preferencias['access_token'],
                        'data' => array(
                            'filter' => array(
                                'bookings_date_from' => strtotime($ultima_fecha['date_booking']),
                                'bookings_date_to' => time(),
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


            $resultado = json_decode($data['resultado']);
            $resultado = $resultado->data->bookings;
            /*
             *  Guardo los nuevos bookings
             */
            foreach ($resultado as $book) {
                $where = array(
                    'short_id' => $book->short_id
                );
                $res = $this->bookings_model->get_where($where);

                if (!$res) {
                    $set = array(
                        'product_name' => $book->product_name,
                        'product_short_id' => $book->product_short_id,
                        'product_time_zone' => $book->product_time_zone,
                        'supplier_company_short_id' => $book->supplier_company_short_id,
                        'seller_company_name' => $book->seller_company_name,
                        'seller_company_short_id' => $book->seller_company_short_id,
                        'seller_company_name' => $book->seller_company_name,
                        'short_id' => $book->short_id,
                        'language_code' => $book->language_code,
                        'location' => $book->location,
                        'service_flow' => $book->service_flow,
                        'date_event' => date("Y-m-d H:i:s", $book->date_event),
                        'date_prebooking' => date("Y-m-d H:i:s", $book->date_prebooking),
                        'promo_code' => $book->promo_code,
                        'currency' => $book->currency,
                        'total_price' => $book->total_price,
                        'payment_partial' => $book->payment_partial,
                        'gateway_fee' => $book->gateway_fee,
                        'agent_fee' => $book->agent_fee,
                        'source' => $book->source,
                        'multi_client_hash' => $book->multi_client_hash,
                        'status' => $book->status,
                        'notes' => $book->notes,
                        'payment_gateway' => $book->payment_gateway,
                        'gift_certificate' => $book->gift_certificate,
                        'checked' => $book->checked,
                        'date_enjoyed' => $book->date_enjoyed
                    );

                    if (isset($book->date_modified)) {
                        $set['date_modified'] = date("Y-m-d H:i:s", $book->date_modified);
                    }
                    if (isset($book->date_booking)) {
                        $set['date_booking'] = date("Y-m-d H:i:s", $book->date_booking);
                    }

                    $this->bookings_model->set($set);

                    /*
                     *  Grabado de Client
                     */
                    $set = array(
                        'short_id' => $book->short_id,
                        'name' => $book->client_data->name,
                        'email' => $book->client_data->email,
                        'nationalid' => $book->client_data->nationalid,
                        'birthday' => $book->client_data->birthday,
                        'language' => $book->client_data->language,
                        'country' => $book->client_data->country,
                        'hotel' => $book->client_data->hotel
                    );

                    if (isset($book->client_data->phone)) {
                        $set['phone'] = $book->client_data->phone;
                    }
                    if (isset($book->client_data->customtext)) {
                        $set['customtext'] = $book->client_data->customtext;
                    }
                    if (isset($book->client_data->customtext2)) {
                        $set['customtext2'] = $book->client_data->customtext2;
                    }
                    if (isset($book->client_data->customtextarea)) {
                        $set['customtextarea'] = $book->client_data->customtextarea;
                    }

                    $this->bookings_model->set_client($set);

                    /*
                     *  Grabado de Ticket Type Count
                     */
                    foreach ($book->ticket_type_count as $count) {
                        $set = array(
                            'short_id' => $book->short_id,
                            'id' => $count->id,
                            'name' => $count->name,
                            'count' => $count->count
                        );

                        $this->bookings_model->set_ticket_type_count($set);
                    }
                }
            }
        }
        /*
         *  Obtengo los bookings de la base de datos
         */
        $per_page = 10;
        $where = $this->input->get();

        /*
         * inicio paginador
         */
        $total_rows = $this->bookings_model->get_cantidad_where($where);
        $config['reuse_query_string'] = TRUE;
        $config['base_url'] = '/reservas/listar/';
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $total_rows;
        /*
         * fin paginador
         */
        $data['resultado'] = $this->bookings_model->gets_where_limit($where, $per_page, $pagina);
        foreach ($data['resultado'] as $key => $value) {
            $where = array(
                'short_id' => $value['short_id']
            );
            $data['resultado'][$key]['client_data'] = $this->bookings_model->get_where_client_data($where);
        }

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('reservas/listar');
        $this->load->view('layout/footer');
    }

}

?>