<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploader extends CI_Controller
{
    public function index()
    {
        $config['upload_path'] = './upload/temp/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '0';
        $config['max_width'] = '1920';
        $config['max_height'] = '1080';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        if ($this->upload->do_upload('file')) {
            $result = TRUE;
            $data = array(
                'result' => $result,
                'data'   => $this->upload->data(),
            );
        } else {
            $result = FALSE;
            $data = array(
                'result' => $result,
                'data'   => $this->upload->display_errors('', ''),
            );
        }

        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
}