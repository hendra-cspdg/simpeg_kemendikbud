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
    	$this->load->model('unitkerja/unitkerja_model');
    	$this->load->model('petajabatan/kuotajabatan_model');
    	$datadetil = $this->unitkerja_model->find($unitkerja);
    	$ideselon2 = isset($datadetil->ID) ? substr($datadetil->ID,0,5) : "";
    	
    	// eselon III
    	$eselon3 = $this->unitkerja_model->find_eselon3($ideselon2);
    	//eselon2
    	$aeselon4[] = array(); 
    	$eselon4 = $this->unitkerja_model->find_eselon4($ideselon2);
    	if (isset($eselon4) && is_array($eselon4) && count($eselon4)):
			foreach($eselon4 as $record):
				$ideselon3 = isset($record->ID) ? substr($record->ID,0,8) : "";
				$aeselon4[$ideselon3][] = $record->NAMA_ESELON_IV;
				$aeselon4[$ideselon3."-ID"][] = $record->ID;
				//echo $record->NAMA_ESELON_IV;
			endforeach;
		endif;
		// kuota jabatan
		$kuotajabatan = $this->kuotajabatan_model->find_all($ideselon2);
		$akuota[] = array(); 
		if (isset($kuotajabatan) && is_array($kuotajabatan) && count($kuotajabatan)):
			foreach($kuotajabatan as $record):
				$akuota[$record->KODE_UNIT_KERJA."-ID_JABATAN"][] = $record->ID_JABATAN;
				$akuota[$record->KODE_UNIT_KERJA."-Nama_Jabatan"][] = $record->Nama_Jabatan;
				
				$akuota[$record->KODE_UNIT_KERJA."-JML"][] = $record->JUMLAH_PEMANGKU_JABATAN;
			endforeach;
		endif;
		//print_r($akuota);
    	$output = $this->load->view('reports/content',array('datadetil'=>$datadetil,"eselon3"=>$eselon3,"aeselon4"=>$aeselon4,"akuota"=>$akuota),true);	
		 
		echo $output;
        die();
    }
    
}