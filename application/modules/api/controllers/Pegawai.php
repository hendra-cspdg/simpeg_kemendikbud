<?php 
require APPPATH . '/libraries/LIPIAPI_REST_Controller.php';
class Pegawai extends  LIPIAPI_REST_Controller {
     protected $methods = [
			'index_get' => ['level' => 10, 'limit' => 10],
            'xlist_get' => ['level' => 0, 'limit' => 10],
			'sub_get' => ['level' => 10, 'limit' => 10]
    ];
	
	public function list_get(){
        
        
        $output = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        $unor_id = $this->get('unor_id');
        if ($unor_id === NULL)
        {
            $output['msg'] = 'Parameter unor_id di butuhkan';
            $this->response($output, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $data_pegawai = $this->db->from("hris.pegawai")->
        where("UNOR_ID",$unor_id)->
        get()->result();
         $output = array(
            'success' => true,
            'data'=>$data_pegawai
        );
        $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    public function detail_get(){
        $pegawai_nip = $this->input->post('nip');
        $output = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        $pegawai_nip = $this->get('pegawai_nip');
        if ($pegawai_nip === NULL)
        {
            $output['msg'] = 'Parameter pegawai_nip di butuhkan';
            $this->response($output, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $data_pegawai = $this->db->from("hris.pegawai")->where('NIP_BARU',$pegawai_nip)->get()->first_row();
        $output = array(
            'success' => true,
            'data'=>$data_pegawai
        );
        $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    public function xlist_get(){
        $data_pegawai = $this->db->from("hris.pegawai")->get()->result();
        $output = array(
            'successx' => true,
            'data'=>$data_pegawai
        );
        $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
}