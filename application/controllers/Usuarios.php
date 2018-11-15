<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'form_validation',
            'session'
        ));
        $this->load->model(array(
            'usuarios_model',
            'preferencias_model'
        ));
        $this->load->helper(array(
            'url'
        ));
    }

    public function login() {
        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $usuario = $this->usuarios_model->get_usuario($this->input->post('usuario'), sha1($this->input->post('password')));
            if (!empty($usuario)) {

                $datos = array(
                    'SID' => $usuario['idusuario'],
                    'usuario' => $usuario['usuario'],
                    'nombre' => $usuario['nombre'],
                    'apellido' => $usuario['apellido']
                );
                $this->session->set_userdata($datos);

                $datos = array(
                    'ultimo_acceso' => date("Y-m-d H:i:s")
                );
                $this->usuarios_model->update($datos, $usuario['idusuario']);

                $where = array(
                    'idpreferencia' => 1
                );
                $preferencias = $this->preferencias_model->get_where($where);

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

                $datos = array(
                    'access_token' => $resultado->data->access_token
                );
                $where = array(
                    'idpreferencia' => 1
                );
                $this->preferencias_model->update($datos, $where);

                redirect('/dashboard/', 'refresh');
            }
        }

        $data['title'] = "Login de Usuarios";
        $session = $this->session->all_userdata();
        if (!empty($session['SID'])) {
            redirect('/dashboard/', 'refresh');
        } else {
            $this->load->view('usuarios/login', $data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/usuarios/login/', 'refresh');
    }

}

?>