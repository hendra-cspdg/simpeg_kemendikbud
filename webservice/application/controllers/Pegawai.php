<?php 
require APPPATH . '/libraries/LIPIAPI_REST_Controller.php';
class Pegawai extends  LIPIAPI_REST_Controller {
     protected $methods = [
			'index_get' => ['level' => 10, 'limit' => 10],
			'sub_get' => ['level' => 10, 'limit' => 10]
    ];
	
	public function list_get(){
        $data_pegawai = $this->db->from("hris.pegawai")->get()->result();
        $output = array(
            'success' => true,
            'data'=>$data_pegawai
        );
        $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
}