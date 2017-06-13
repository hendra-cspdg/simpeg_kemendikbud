<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Reports controller
 */
class Reports extends Admin_Controller
{
    protected $permissionCreate = 'Petajabatan.Reports.Create';
    protected $permissionDelete = 'Petajabatan.Reports.Delete';
    protected $permissionEdit   = 'Petajabatan.Reports.Edit';
    protected $permissionView   = 'Petajabatan.Reports.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('petajabatan/kuotajabatan_model');
        $this->auth->restrict($this->permissionView);
        $this->lang->load('petajabatan');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'reports/_sub_nav');

        Assets::add_module_js('petajabatan', 'petajabatan.js');

    }

    /**
     * Display a list of petajabatan data.
     *
     * @return void
     */
    public function index()
    {

    	Template::set('toolbar_title', "Peta Jabatan");
		Template::set("collapse",true);
        Template::render();
    }
    public function viewdata()
    {
    	$unitkerja = $this->input->get('unitkerja');
    	$this->load->model('pegawai/pegawai_model');
    	$this->load->model('unitkerja/unitkerja_model');
    	$datadetil = $this->unitkerja_model->find_by("KODE_INTERNAL",$unitkerja);
    	$ideselon2 = isset($datadetil->KODE_INTERNAL) ? substr($datadetil->KODE_INTERNAL,0,5) : "";
    	$idsatker = isset($datadetil->ID) ? $datadetil->ID : "";
    	// eselon III
    	//$eselon3 = $this->unitkerja_model->find_by("PARENT_ID",$idsatker);
    	$eselon3[] = array(); 
    	$aeselon4[] = array(); 
    	$satker = $this->unitkerja_model->find_eselon3($ideselon2);
    	
    	if (isset($satker) && is_array($satker) && count($satker)):
			foreach($satker as $record):
				//if(substr($datadetil->KODE_INTERNAL,6,2) == "00"){}
				if($record->PARENT_ID == $idsatker){
					$eselon3["ID"][] = $record->ID;
					$eselon3["NAMA_UNOR"][] 	= $record->NAMA_UNOR;
				}else{
					$aeselon4[$record->PARENT_ID][] = $record->NAMA_UNOR;
					$aeselon4[$record->PARENT_ID."-ID"][] = $record->KODE_INTERNAL;
				}
			endforeach;
		endif;
		//print_r($eselon3);
		//die();
    	/*
    	$eselon4 = $this->unitkerja_model->find_eselon4($ideselon2);
    	//print_r($eselon3);
    	if (isset($eselon4) && is_array($eselon4) && count($eselon4)):
			foreach($eselon4 as $record):
				$ideselon3 = isset($record->KODE_UNIT_KERJA) ? substr($record->KODE_UNIT_KERJA,0,8) : "";
				$aeselon4[$ideselon3][] = $record->NAMA_ESELON_IV;
				$aeselon4[$ideselon3."-ID"][] = $record->KODE_UNIT_KERJA;
				//echo $record->NAMA_ESELON_IV;
			endforeach;
		endif;
		*/
		// Mulai kuota jabatan 
		$kuotajabatan = $this->kuotajabatan_model->find_all($ideselon2);
		$akuota[] = array(); 
		if (isset($kuotajabatan) && is_array($kuotajabatan) && count($kuotajabatan)):
			foreach($kuotajabatan as $record):
				//echo $record->ID_JABATAN;
				$akuota[trim($record->KODE_UNIT_KERJA)."-ID_JABATAN"][] 	= trim($record->ID_JABATAN);
				$akuota[trim($record->KODE_UNIT_KERJA)."-NAMA_Jabatan"][] 	= trim($record->NAMA_JABATAN);
				$akuota[trim($record->KODE_UNIT_KERJA)."-JML"][] = trim($record->JUMLAH_PEMANGKU_JABATAN);
			endforeach;
		endif;
		$pegawaijabatan = $this->pegawai_model->find_grupjabatan($ideselon2);
		$apegawai = array(); 
		if (isset($pegawaijabatan) && is_array($pegawaijabatan) && count($pegawaijabatan)):
			foreach($pegawaijabatan as $record):
				$apegawai[trim($record->UNOR_ID)."-jml-".trim($record->JABATAN_ID)] = trim($record->jumlah);
			endforeach;
		endif;
		//print_r($apegawai);
    	$output = $this->load->view('reports/content',array('datadetil'=>$datadetil,"eselon3"=>$eselon3,"aeselon4"=>$aeselon4,"akuota"=>$akuota,"apegawai"=>$apegawai),true);	
		 
		echo $output;
        die();
    }
	public function addkuota()
    {
    	$this->auth->restrict($this->permissionCreate);
        $kode_satker = $this->uri->segment(5);
        $this->load->model('ref_jabatan/ref_jabatan_model');
        $jabatans = $this->ref_jabatan_model->find_all();
		Template::set('kode_satker', $kode_satker);
		Template::set('jabatans', $jabatans);
        Template::set('toolbar_title', "Tambah Kuota Jabatan");
		
        Template::render();
    }
    public function editkuota()
    {
        $this->auth->restrict($this->permissionEdit);
        $kode_satker = $this->uri->segment(5);
        $kode_jabatan = $this->uri->segment(6);
        $this->kuotajabatan_model->where("kuota_jabatan.KODE_UNIT_KERJA",$kode_satker);
        $this->kuotajabatan_model->where("kuota_jabatan.ID_JABATAN",(int)$kode_jabatan);
        $kuota_jabatan = $this->kuotajabatan_model->find_det();
        //print_r($kuota_jabatan);
        //die($kuota_jabatan[0]->ID);
        Template::set('kuota_jabatan', $kuota_jabatan);
        
        $this->load->model('ref_jabatan/ref_jabatan_model');
        $jabatans = $this->ref_jabatan_model->find_all();
		Template::set('kode_satker', $kode_satker);
		Template::set('jabatans', $jabatans);
        Template::set('toolbar_title', "Tambah Kuota Jabatan");
        Template::render();
    }
    
    public function savekuota(){
         // Validate the data
		
        $this->form_validation->set_rules($this->kuotajabatan_model->get_validation_rules());
        $response = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        if ($this->form_validation->run() === false) {
            $response['msg'] = "
            <div class='alert alert-block alert-error fade in'>
                <a class='close' data-dismiss='alert'>&times;</a>
                <h4 class='alert-heading'>
                    Error
                </h4>
                ".validation_errors()."
            </div>
            ";
            echo json_encode($response);
            exit();
        }

        $data = $this->kuotajabatan_model->prep_data($this->input->post());
        $id_data = $this->input->post("ID");
        if(isset($id_data) && !empty($id_data)){
            $this->kuotajabatan_model->update($id_data,$data);
        }
        else $this->kuotajabatan_model->insert($data);
        $response ['success']= true;
        $response ['msg']= "Transaksi berhasil";
        echo json_encode($response);    

    }
    public function deletekuota()
	{
		$this->auth->restrict($this->permissionDelete);
		$id 	= $this->input->post('kode');
		if ($this->kuotajabatan_model->delete($id)) {
			 log_activity($this->auth->user_id(),"Delete data" . ': ' . $id . ' : ' . $this->input->ip_address(), 'kuota_jabatan');
			 Template::set_message("Delete kuota jabatan sukses", 'success');
			 echo "Sukses";
		}else{
			echo "Gagal";
		}

		exit();
	}
}