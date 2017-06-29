<?php 
require APPPATH . '/libraries/LIPIAPI_REST_Controller.php';
class Pegawai extends  LIPIAPI_REST_Controller {
     protected $methods = [
			'index_get' => ['level' => 10, 'limit' => 10],
            'xlist_get' => ['level' => 0, 'limit' => 10],
			'sub_get' => ['level' => 10, 'limit' => 10]
    ];
	
	public function list_get(){
        $this->load->model("pegawai/unitkerja_model");
        $appKeyData = $this->getApplicationKey();
        $children = array();
        if($appKeyData->satker_auth){
            $satkers =  explode(",",$appKeyData->satker_auth);
            $this->unitkerja_model->getChildren($satkers ,$children,$onlyID = true,$include_sub=TRUE,$includeMe=true,$first=true);
        }
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
        $this->db->start_cache();
            $this->db->select("peg.*",false)->from("hris.pegawai peg")->
            join("hris.unitkerja uk","uk.ID_BKN=peg.UNOR_ID");
            if(sizeof($children)>0){
                $this->db->where_in("uk.ID",$children);
            }
        $this->db->stop_cache(); 
        $total = $this->db->get()->num_rows();   
        $data_pegawai = $this->db->get()->result();
         $output = array(
            'success' => true,
            'total'=>$total,
            'data'=>$data_pegawai
        );
        $this->db->flush_cache();
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