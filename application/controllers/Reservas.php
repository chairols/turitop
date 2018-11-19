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
            'preferencias_model',
            'bookings_model'
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

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('reservas/listar');
        $this->load->view('layout/footer');
    }

}

?>