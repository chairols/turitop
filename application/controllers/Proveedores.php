<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'form_validation'
        ));
        $this->load->model(array(
            'proveedores_model'
        ));

        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }

    public function administrar() {
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = 3;

        $data['javascript'] = array(
            '/assets/modulos/proveedores/js/administrar.js'
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('proveedores/administrar');
        $this->load->view('layout/footer');
    }

    public function agregar_ajax() {
        $session = $this->session->all_userdata();

        $this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $datos = array(
                'proveedor' => $this->input->post('proveedor'),
                'email' => $this->input->post('email')
            );
            $resultado = $this->proveedores_model->set($datos);
            if ($resultado) {
                $json = array(
                    'status' => 'ok',
                    'data' => 'Se agregó correctamente'
                );
                echo json_encode($json);
            } else {
                $json = array(
                    'status' => 'error',
                    'data' => 'Ocurrió un error inesperado'
                );
                echo json_encode($json);
            }
        }
    }

    public function gets_proveedores_tabla() {
        $where = array(
            'estado' => 'A'
        );
        $data['proveedores'] = $this->proveedores_model->gets_where($where);

        $this->load->view('proveedores/gets_proveedores_tabla', $data);
    }

    public function borrar_ajax() {
        $this->form_validation->set_rules('idproveedor', 'ID Proveedor', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $datos = array(
                'estado' => 'I'
            );
            $where = array(
                'idproveedor' => $this->input->post('idproveedor')
            );
            $resultado = $this->proveedores_model->update($datos, $where);
            if ($resultado) {
                $json = array(
                    'status' => 'ok',
                    'data' => 'El proveedor se eliminó con éxito'
                );
                echo json_encode($json);
            } else {
                $json = array(
                    'status' => 'error',
                    'data' => 'Ocurrió un error inesperado'
                );
                echo json_encode($json);
            }
        }
    }

    public function get_where_json() {
        $this->form_validation->set_rules('idproveedor', 'ID Proveedor', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $where = array(
                'idproveedor' => $this->input->post('idproveedor'),
                'estado' => 'A'
            );
            $proveedor = $this->proveedores_model->get_where($where);
            if ($proveedor) {
                $json = array(
                    'status' => 'ok',
                    'data' => $proveedor
                );
                echo json_encode($json);
            } else {
                $json = array(
                    'status' => 'error',
                    'data' => 'No se encontró el proveedor'
                );
                echo json_encode($json);
            }
        }
    }

}

?>