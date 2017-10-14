<?php 
require APPPATH . '/libraries/LIPIAPI_REST_Controller.php';
class Pegawai extends  LIPIAPI_REST_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
       
    }
     protected $methods = [
			'index_get' => ['level' => 10, 'limit' => 10],
            'xlist_get' => ['level' => 0, 'limit' => 10],
			'sub_get' => ['level' => 10, 'limit' => 10],
            'add_riwayat_pendidikan_post' => ['level' => 0, 'limit' => 10],
            'add_riwayat_jabatan_post' => ['level' => 0, 'limit' => 10],
            'add_riwayat_pindah_unitkerja_post' => ['level' => 0, 'limit' => 10],
            'add_riwayat_kepangkatan_post' => ['level' => 0, 'limit' => 10],
            'add_riwayat_skp_post' => ['level' => 0, 'limit' => 10],
    ];
    public function add_riwayat_skp_post(){
        $this->load->model('pegawai/riwayat_prestasi_kerja_model');
        if(sizeof($_POST)==0){
            $this->form_validation->set_data(array('____check_____'=>1));
        }
        $this->form_validation->set_rules($this->riwayat_prestasi_kerja_model->get_validation_rules());
        
        $response = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        if ($this->form_validation->run() === false) {
            $response['msg'] = $this->form_validation->error_array();//validation_errors();
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST); // OK (200) being the HTTP response code
            die();
        }
       
        $data = $this->riwayat_prestasi_kerja_model->prep_data($this->input->post());

        $nilai_perilaku = $data['PERILAKU_DISIPLIN']+$data['PERILAKU_INTEGRITAS']+$data['PERILAKU_KERJASAMA']+$data['PERILAKU_KOMITMEN']+$data['PERILAKU_ORIENTASI_PELAYANAN'];
        if(isset($data['JABATAN_TIPE'])){
            if($data['JABATAN_TIPE'] ==1){
                $nilai_perilaku+= $data['PERILAKU_KEPEMIMPINAN'];
                $data['NILAI_PERILAKU'] = $nilai_perilaku/6;
            }
            else $data['NILAI_PERILAKU'] = $nilai_perilaku/5;
        }
        else $data['NILAI_PERILAKU'] = $nilai_perilaku/5;
        $data['NILAI_PROSENTASE_PERILAKU'] = 40;
        $data['NILAI_PERILAKU_AKHIR'] = $data['NILAI_PERILAKU']*$data['NILAI_PROSENTASE_PERILAKU']/100;

        $data['NILAI_PROSENTASE_SKP'] = 60;
        $data['NILAI_SKP_AKHIR'] = $data['NILAI_SKP']*$data['NILAI_PROSENTASE_SKP']/100;

        $data['NILAI_PPK'] = $data['NILAI_SKP_AKHIR']+$data['NILAI_PERILAKU_AKHIR'];


        $inserted_id = $this->riwayat_prestasi_kerja_model->insert($data);
        $response = array(
            'success'=>true,
            'id'=>$inserted_id
        );
        $this->response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    public function add_riwayat_kepangkatan_post(){
        $this->load->model('pegawai/riwayat_kepangkatan_model');
        if(sizeof($_POST)==0){
            $this->form_validation->set_data(array('____check_____'=>1));
        }
        $this->form_validation->set_rules($this->riwayat_kepangkatan_model->get_validation_rules());
        
        $response = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        if ($this->form_validation->run() === false) {
            $response['msg'] = $this->form_validation->error_array();//validation_errors();
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST); // OK (200) being the HTTP response code
            die();
        }
       
        $data = $this->riwayat_kepangkatan_model->prep_data($this->input->post());

        $inserted_id = $this->riwayat_kepangkatan_model->insert($data);
        $response = array(
            'success'=>true,
            'id'=>$inserted_id
        );
        $this->response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    public function add_riwayat_pindah_unitkerja_post(){
        $this->load->model('pegawai/riwayat_pindah_unit_kerja_model');
        if(sizeof($_POST)==0){
            $this->form_validation->set_data(array('____check_____'=>1));
        }
        $this->form_validation->set_rules($this->riwayat_pindah_unit_kerja_model->get_validation_rules());
        
        $response = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        if ($this->form_validation->run() === false) {
            $response['msg'] = $this->form_validation->error_array();//validation_errors();
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST); // OK (200) being the HTTP response code
            die();
        }
       
        $data = $this->riwayat_pindah_unit_kerja_model->prep_data($this->input->post());

        $inserted_id = $this->riwayat_pindah_unit_kerja_model->insert($data);
        $response = array(
            'success'=>true,
            'id'=>$inserted_id
        );
        $this->response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    public function add_riwayat_jabatan_post(){
        $this->load->model('pegawai/riwayat_jabatan_model');
        if(sizeof($_POST)==0){
            $this->form_validation->set_data(array('____check_____'=>1));
        }
        $this->form_validation->set_rules($this->riwayat_jabatan_model->get_validation_rules());
        
        $response = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        if ($this->form_validation->run() === false) {
            $response['msg'] = $this->form_validation->error_array();//validation_errors();
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST); // OK (200) being the HTTP response code
            die();
        }
       
        $data = $this->riwayat_jabatan_model->prep_data($this->input->post());

        $inserted_id = $this->riwayat_jabatan_model->insert($data);
        $response = array(
            'success'=>true,
            'id'=>$inserted_id
        );
        $this->response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    public function add_riwayat_pendidikan_post(){
        $this->load->model('pegawai/riwayat_pendidikan_model');
        if(sizeof($_POST)==0){
            $this->form_validation->set_data(array('____check_____'=>1));
        }
        $this->form_validation->set_rules($this->riwayat_pendidikan_model->get_validation_rules());
        
        $response = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        if ($this->form_validation->run() === false) {
            $response['msg'] = $this->form_validation->error_array();//validation_errors();
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST); // OK (200) being the HTTP response code
            die();
        }
       
        $data = $this->riwayat_pendidikan_model->prep_data($this->input->post());

        $inserted_id = $this->riwayat_pendidikan_model->insert($data);
        $response = array(
            'success'=>true,
            'id'=>$inserted_id
        );
        $this->response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
	
	public function list_get(){
        $this->load->model("pegawai/unitkerja_model");
        $appKeyData = $this->getApplicationKey();
        $satkers = array();
        if($appKeyData->satker_auth){
            $satkers = explode(',',$appKeyData->satker_auth);
        }
		
		$output = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        $unor_id = $this->get('unor_id');
        $start = (int)$this->get('start');
        $limit = $this->get('limit');
        if ($unor_id === NULL)
        {
            $output['msg'] = 'Parameter unor_id di butuhkan';
            $this->response($output, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        if ($start === NULL)
        {
           $start = 0;
        }
        else {
            if($start<0){
                $output['msg'] = 'Parameter start harus >=0 ';
                $this->response($output, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code 
            }
        }

        if ($limit === NULL)
        {
           $limit = 10;
        }
        else {
            if($limit==-1){
                // no problem
            }
            else if($limit>1000){
                $output['msg'] = 'Parameter limit maksimal 1000 ';
                $this->response($output, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code 
            }
            else if($limit<0){
                $output['msg'] = 'Parameter limit harus >=0 ';
                $this->response($output, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code 
            }

        }
        
        $this->load->model('pegawai/pegawai_model');
        if($limit==-1){

        }
        else {
            $this->db->limit($limit,$start);
        }
		
		$filter_satkers = array();
		if(sizeof($satkers)==0){ // has ALL PRIV
			$filter_satkers[] = $unor_id;
		}
		else {
			$found_priv = false;
			foreach($satkers as $satker){
				if($satker == $unor_id){
					$found_priv = true;
				}
			}
			if(!$found_priv){
				$output['msg'] = 'Parameter limit harus >=0 ';
                $this->response($output, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code 
				return;
			}	
			else {
				$filter_satkers[] = $unor_id;
			}
		}
        $total= $this->pegawai_model->count_list($filter_satkers,true);
        
        $pegawais = $this->pegawai_model->find_all($filter_satkers,true);
        $this->db->flush_cache();
         $output = array(
            'success' => true,
            'total'=>$total,
            'data'=>$pegawais
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
}