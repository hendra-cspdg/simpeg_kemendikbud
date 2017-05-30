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

    	Template::set('toolbar_title', lang('petajabatan_manage'));
		Template::set("collapse",true);
        Template::render();
    }
    public function viewdata()
    {
    	$unitkerja = $this->input->post('unitkerja');
    	$this->load->model('pegawai/pegawai_model');
    	$this->load->model('unitkerja/unitkerja_model');
    	$this->load->model('petajabatan/kuotajabatan_model');
    	$datadetil = $this->unitkerja_model->find($unitkerja);
    	$ideselon2 = isset($datadetil->KODE_UNIT_KERJA) ? substr($datadetil->KODE_UNIT_KERJA,0,5) : "";

    	// eselon III
    	$eselon3 = $this->unitkerja_model->find_eselon3($ideselon2);
    	//eselon2
    	$aeselon4[] = array(); 
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
		// kuota jabatan
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
    
}