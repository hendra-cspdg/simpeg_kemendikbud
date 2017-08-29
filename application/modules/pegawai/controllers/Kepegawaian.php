<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class Kepegawaian extends Admin_Controller
{
    protected $permissionCreate = 'Pegawai.Kepegawaian.Create';
    protected $permissionDelete = 'Pegawai.Kepegawaian.Delete';
    protected $permissionEdit   = 'Pegawai.Kepegawaian.Edit';
    protected $permissionView   = 'Pegawai.Kepegawaian.View';
    protected $permissionAddpendidikan   = 'Pegawai.Kepegawaian.Addpendidikan';
    protected $permissionUbahfoto   = 'Pegawai.Kepegawaian.Ubahfoto';
	public $UNOR_ID = null;
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(); 
        
        $this->load->model('pegawai/pegawai_model');
        $this->load->model('pegawai/riwayat_pendidikan_model');
        $this->lang->load('pegawai');
        
            Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
            Assets::add_js('jquery-ui-1.8.13.min.js');
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'kepegawaian/_sub_nav');

        Assets::add_module_js('pegawai', 'pegawai.js');
        
        //load referensi
        $this->load->model('pegawai/JENIS_PEGAWAI_model');
        $JENIS_PEGAWAIs = $this->JENIS_PEGAWAI_model->find_all();
		Template::set('JENIS_PEGAWAIs', $JENIS_PEGAWAIs);
		
		$this->load->model('pegawai/KEDUDUKAN_HUKUM_model');
        $KEDUDUKAN_HUKUMs = $this->KEDUDUKAN_HUKUM_model->find_all();
		Template::set('KEDUDUKAN_HUKUMs', $KEDUDUKAN_HUKUMs);
		$this->load->model('pegawai/golongan_model');
        $golongans = $this->golongan_model->find_all();
		Template::set('golongans', $golongans);
		
		$this->load->model('pegawai/agama_model');
		
        $agamas = $this->agama_model->find_all();
		Template::set('agamas', $agamas);
		
		$this->load->model('pegawai/tingkatpendidikan_model');
        $tkpendidikans = $this->tingkatpendidikan_model->find_all();
		Template::set('tkpendidikans', $tkpendidikans);
		
		$this->load->model('pegawai/kpkn_model');
        $kpkns = $this->kpkn_model->find_all();
		Template::set('kpkns', $kpkns);
		$this->load->model('ref_jabatan/jabatan_model');
		/*
		$this->load->model('ref_jabatan/ref_jabatan_model');
        $jabatans = $this->ref_jabatan_model->find_all();
		Template::set('jabatans', $jabatans);
		
		
        $jabataninstansis = $this->jabatan_model->find_all();
		Template::set('jabataninstansis', $jabataninstansis);
		*/
        $this->load->model('pegawai/jenis_jabatan_model');
        $jenis_jabatans = $this->jenis_jabatan_model->find_all();
		Template::set('jenis_jabatans', $jenis_jabatans);
		$this->load->model('pegawai/jenis_kawin_model');
        $jenis_kawins = $this->jenis_kawin_model->find_all();
		Template::set('jenis_kawins', $jenis_kawins);

		$this->load->model('pegawai/pendidikan_model');
		
		$this->load->model('pegawai/lokasi_model');
		$this->load->model('pegawai/unitkerja_model');
		
		// filter untuk role executive
		if($this->auth->role_id() =="5"){
			$this->UNOR_ID = $this->pegawai_model->getunor_id($this->auth->username());
		}
		if($this->auth->role_id() =="6"){
			$this->UNOR_ID = $this->pegawai_model->getunor_induk($this->auth->username());
		}
    }

    /**
     * Display a list of pegawai data.
     *
     * @return void
     */
    public function index()
    {	

    	$this->auth->restrict($this->permissionView);
         
        
    Template::set('toolbar_title', lang('pegawai_manage'));
		
        Template::render();
    }
    public function uploadfoto()
	{
		$PNS_ID = $this->uri->segment(5);
		Template::set('PNS_ID', $PNS_ID);
		//echo $PNS_ID." PNS_ID";
		Template::render();
	}
	function savefoto(){
		$this->auth->restrict($this->permissionUbahfoto);
    	$this->load->helper('handle_upload');
		$uploadData = array();
		$upload = true;
		$id_log = $this->input->post('PNS_ID');
		 $id = "";
		 $namafile = "";
		 if (isset($_FILES['userfile']) && is_array($_FILES['userfile']) && $_FILES['userfile']['error'] != 4)
		 {
			$tmp_name = pathinfo($_FILES['userfile']['name'], PATHINFO_FILENAME);
			$uploadData = handle_upload('userfile',trim($this->settings_lib->item('site.urlphoto')));
			 if (isset($uploadData['error']) && !empty($uploadData['error']))
			 {
			 	$tipefile=$_FILES['userfile']['type'];
			 	//$tipefile = $_FILES['userfile']['name'];
				 $upload = false;
				//$uploadData = handle_upload('userfile',trim($this->settings_lib->item('site.urlphoto')));
				 log_activity($this->auth->user_id(), 'Gagal : '.$uploadData['error'].trim($this->settings_lib->item('site.pathphoto')).$tipefile.$this->input->ip_address(), 'pegawai');
			 }else{
			 	$namafile = $uploadData['data']['file_name'];
                log_activity($this->auth->user_id(), 'upload foto : ' . $id_log . ' : ' . $this->input->ip_address(), 'pegawai');
			 }
		 }else{
		 	die("File tidak ditemukan");
		 	log_activity($this->auth->user_id(), 'File tidak ditemukan : ' . $this->input->ip_address(), 'pegawai');
		 } 	
		if ($namafile != "")
		{
			$dataupdate = array(
			'PHOTO'	=> $namafile
			);
			$this->pegawai_model->update_where("PNS_ID",$id_log, $dataupdate);
		}
       echo '{"namafile":"'.$namafile.'"}';
       exit();
	}
	public function importdatapegawai()
	{
		Template::set('toolbar_title', "Import data");
		Template::render();
	}
	function runimport(){
    	 //$this->auth->restrict($this->permissionCreate);
    	 $this->load->helper('handle_upload');
		 $uploadData = array();
		 $upload = true;
		 $id = $this->input->post('id');
		 $message = "";
		 $index = 0;
		 if (isset($_FILES['userfile']) && is_array($_FILES['userfile']) && $_FILES['userfile']['error'] != 4)
		 {
			$tmp_name = pathinfo($_FILES['userfile']['name'], PATHINFO_FILENAME);
			$uploadData = handle_upload('userfile',trim($this->settings_lib->item('site.pathuploaded')),$tmp_name);
			 if (isset($uploadData['error']) && !empty($uploadData['error']))
			 {
			 	$tipefile=$_FILES['userfile']['type'];
				 $upload = false;
				 $message = "Gagal upload data".$uploadData['error'];
				 log_activity($this->auth->user_id(), 'Gagal : '.$uploadData['error'].$this->pegawai_model->error.$tipefile.$this->input->ip_address(), 'pegawai');
			 }else{
			 	
				if(isset($uploadData['data']['file_name']))
					$file = trim($this->settings_lib->item('site.pathuploaded')).$uploadData['data']['file_name'];
				else
					$file ="";
				$this->load->library('Excel');
				$objPHPExcel = PHPExcel_IOFactory::load($file);
				 //  Get worksheet dimensions
				$sheet = $objPHPExcel->getSheet(0); 
				$highestRow = $sheet->getHighestRow(); 
				$highestColumn = $sheet->getHighestColumn();
				$itemfield = $this->db->list_fields('pegawai');
   				for ($row = 2; $row <= $highestRow; $row++)
				{ 
					//  Read a row of data into an array
					$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
													  NULL,
													  TRUE,
													  FALSE);
					$data = array();
					$col = 0;
					foreach($itemfield as $field)
					{
						if(trim($rowData[0][$col]) != ''){
						   $data[$field] 	= trim($rowData[0][$col]); 
						}
						$col++;
					}
					if($rowData[0][1] != ""){
						if($this->pegawai_model->insert($data)){
							$index++;
						}
					}
				}
				$message = "Upload sukses :".$index." data";
			 	log_activity($this->auth->user_id(), 'Berhasil  : '.$this->pegawai_model->error.$this->input->ip_address(), 'pegawai');
			 	
			 }
		 }else{
		 	log_activity($this->auth->user_id(), 'File tidak ditemukan : ' . $this->input->ip_address(), 'pegawai');
		 } 
		 echo '{"message":"'.$message.'"}';
		 exit();
	}
	
    /**
     * Create a pegawai object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_pegawai()) {
                log_activity($this->auth->user_id(), lang('pegawai_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'pegawai');
                Template::set_message(lang('pegawai_create_success'), 'success');

                redirect(SITE_AREA . '/kepegawaian/pegawai');
            }

            // Not validation error
            if ( ! empty($this->pegawai_model->error)) {
                Template::set_message(lang('pegawai_create_failure') . $this->pegawai_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('pegawai_action_create'));

        Template::render();
    }
    // riwayat pendidikan
    public function addpendidikan($PNS_BKN_ID,$riwayat_pendidikan_id=NULL)
    {
        $this->auth->restrict($this->permissionAddpendidikan);
		Template::set('rwt_pendidikan', $this->riwayat_pendidikan_model->find($riwayat_pendidikan_id));
		
		Template::set('PNS_ID', $PNS_BKN_ID);
        Template::set('toolbar_title', "Tambah Riwayat Pendiikan");

        Template::render();
    }
    public function deletependidikan()
	{
		$this->auth->restrict($this->permissionAddpendidikan);
		$id 	= $this->input->post('kode');
		if ($this->riwayat_pendidikan_model->delete($id)) {
			 log_activity($this->auth->user_id(), 'delete data Riwayat Pendidikan : ' . $id . ' : ' . $this->input->ip_address(), 'pegawai');
			 Template::set_message("Sukses Hapus data", 'success');
			 echo "Sukses";
		}else{
			echo "Gagal";
		}

		exit();
	}
    public function savependidikan()
    {
    	$insert_id = 0;
        $this->auth->restrict($this->permissionAddpendidikan);
		$id = $this->input->post('id_data');
		if($id != ""){
			if($this->save_pendidikan("update",$id))
			{
				 echo "Sukses Update data";
			}else{
				 echo "Gagal simpan data";
			}
        }else{
        	
        	if($id = $this->save_pendidikan()){
        		log_activity($this->auth->user_id(), 'Save riwayat Pendidikan : ' . $id . ' : ' . $this->input->ip_address(), 'pegawai');
        		echo "Sukses simpan data";
        	}else{
        		log_activity($this->auth->user_id(), 'Save riwayat Pendidikan gagal, dari' .$this->riwayat_pendidikan_model->error. $this->input->ip_address(), 'pegawai');
        		echo "Gagal ".$this->riwayat_pendidikan_model->error;
        	}
        }
       
        exit();
    }
    private function save_pendidikan($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }
       
        // Make sure we only pass in the fields we want
        
        $data = $this->riwayat_pendidikan_model->prep_data($this->input->post());
		$data['PNS_ID'] 	= trim($this->input->post('PNS_ID'));
		$data['TINGKAT_PENDIDIKAN_ID'] 	= $this->input->post('TINGKAT_PENDIDIKAN_ID');
		$data['PENDIDIKAN_ID'] 	= $this->input->post('PENDIDIKAN_ID');
		$data['TANGGAL_LULUS'] 	= $this->input->post('TANGGAL_LULUS') ? $this->input->post('TANGGAL_LULUS') : null;
		$data['TAHUN_LULUS'] 	= $this->input->post('TAHUN_LULUS');
		$data['NOMOR_IJASAH'] 	= $this->input->post('NOMOR_IJASAH');
		$data['NAMA_SEKOLAH'] 	= $this->input->post('NAMA_SEKOLAH');
		$data['GELAR_DEPAN'] 	= $this->input->post('GELAR_DEPAN');
		$data['GELAR_BELAKANG'] 	= $this->input->post('GELAR_BELAKANG');
		$data['PENDIDIKAN_PERTAMA'] 	= $this->input->post('PENDIDIKAN_PERTAMA');
		$data['NEGARA_SEKOLAH'] 	= $this->input->post('NEGARA_SEKOLAH');
        // Additional handling for default values should be added below,
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->riwayat_pendidikan_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->riwayat_pendidikan_model->update($id, $data);
        }

        return $return;
    }
    /**
     * Allows editing of pegawai data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('pegawai_invalid_id'), 'error');

            redirect(SITE_AREA . '/kepegawaian/pegawai');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_pegawai('update', $id)) {
                log_activity($this->auth->user_id(), lang('pegawai_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'pegawai');
                Template::set_message(lang('pegawai_edit_success'), 'success');
                redirect(SITE_AREA . '/kepegawaian/pegawai');
            }

            // Not validation error
            if ( ! empty($this->pegawai_model->error)) {
                Template::set_message(lang('pegawai_edit_failure') . $this->pegawai_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->pegawai_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('pegawai_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'pegawai');
                Template::set_message(lang('pegawai_delete_success'), 'success');

                redirect(SITE_AREA . '/kepegawaian/pegawai');
            }

            Template::set_message(lang('pegawai_delete_failure') . $this->pegawai_model->error, 'error');
        }
        
        $pegawaiData = $this->pegawai_model->find($id);
        Template::set('pegawai', $pegawaiData);


        Template::set('selectedLokasiPegawai',$this->lokasi_model->find($pegawaiData->LOKASI_KERJA_ID));
        Template::set('selectedTempatLahirPegawai',$this->lokasi_model->find($pegawaiData->TEMPAT_LAHIR_ID));
        //Template::set('selectedPendidikan',$this->pendidikan_model->find($pegawaiData->PENDIDIKAN_ID));
        if(TRIM($pegawaiData->UNOR_ID) == TRIM($pegawaiData->UNOR_INDUK_ID)){
        	$unor = $this->unitkerja_model->find_by("ID",TRIM($pegawaiData->UNOR_ID));
        	Template::set('selectedUnorid',$unor);
        	Template::set('selectedUnorindukid',$unor);
        }else{
        	Template::set('selectedUnorid',$this->unitkerja_model->find_by("ID",TRIM($pegawaiData->UNOR_ID)));
        	Template::set('selectedUnorindukid',$this->unitkerja_model->find_by("ID",TRIM($pegawaiData->UNOR_INDUK_ID)));
        }
        $jabataninstansis = $this->jabatan_model->find_select(trim($pegawaiData->JENIS_JABATAN_ID));
		Template::set('jabataninstansis', $jabataninstansis);
        
        $pendidikans = $this->pendidikan_model->find_all(trim($pegawaiData->TK_PENDIDIKAN));
		Template::set('pendidikans', $pendidikans);
        
        Template::set('toolbar_title', lang('pegawai_edit_heading'));
        Template::render();
    }
    public function updatemandiri(){
         // Validate the data
        $response = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        $id_data = $this->input->post('ID');
        $data = $this->pegawai_model->prep_data($this->input->post()); 
        $data['TMT_PENSIUN']	= $this->input->post('TMT_PENSIUN') ? $this->input->post('TMT_PENSIUN') : null;
		$data['TGL_SURAT_DOKTER']	= $this->input->post('TGL_SURAT_DOKTER') ? $this->input->post('TGL_SURAT_DOKTER') : null;
		$data['TGL_BEBAS_NARKOBA']	= $this->input->post('TGL_BEBAS_NARKOBA') ? $this->input->post('TGL_BEBAS_NARKOBA') : null;
		$data['TGL_CATATAN_POLISI']	= $this->input->post('TGL_CATATAN_POLISI') ? $this->input->post('TGL_CATATAN_POLISI') : null;
		$data['TGL_MENINGGAL']	= $this->input->post('TGL_MENINGGAL') ? $this->input->post('TGL_MENINGGAL') : null;
		$data['TGL_NPWP']	= $this->input->post('TGL_NPWP') ? $this->input->post('TGL_NPWP') : null;
        $result = $this->pegawai_model->update($id_data,$data);
        if($result){
 	       	$response ['success']= true;
    		$response ['msg']= "Update berhasil";
    	}
        echo json_encode($response);    

    }
    
    public function profile($id='')
    {
    	
    	Template::set('collapse', true);
    	if($this->auth->role_id() == "2"){
    		$pegawai = $this->pegawai_model->find_by("NIP_BARU",trim($this->auth->username()));
    		$id = isset($pegawai->ID) ? $pegawai->ID : "";
    		//die($id." masuk");
    	}
    	 
        if (empty($id)) {
            $pegawai = $this->pegawai_model->find_by("NIP_BARU",trim($this->auth->username()));
    		$id = isset($pegawai->ID) ? $pegawai->ID : "";
    		if($id == ""){
	            Template::set_message(lang('pegawai_invalid_id'), 'error');
            	redirect(SITE_AREA . '/kepegawaian/pegawai');
            }
        }
        
        $this->load->library('convert');
 		
        $pegawai = $this->pegawai_model->find_detil($id);
        Template::set('pegawai', $pegawai);
        Template::set('PNS_ID', $pegawai->PNS_ID);
		// lokasi kerja
		// cek dari riwayat golongan terakhir
		// jika golongan riwayat lebih tinggi dengan golongan yang di pegawai maka pakai golongan yang di riwayat
		$this->load->model('pegawai/riwayat_kepangkatan_model');
		$this->riwayat_kepangkatan_model->order_by("TMT_GOLONGAN","desc");
        $this->riwayat_kepangkatan_model->where("PNS_ID",$pegawai->PNS_ID);  
        $recordrwtpangakats = $this->riwayat_kepangkatan_model->limit(1)->find_all();
        $golonganriwayat = isset($recordrwtpangakats[0]->ID_GOLONGAN) ? trim($recordrwtpangakats[0]->ID_GOLONGAN) : "";
        $gol_id = $pegawai->GOL_ID;
        if((int)$golonganriwayat > (int)$pegawai->GOL_ID){
        	$gol_id = $golonganriwayat;
        }
        // end riwayat golongan terakhir
        
		
		$recgolongan = $this->golongan_model->find(trim($gol_id));
		Template::set('GOLONGAN_AKHIR', $recgolongan->NAMA);
		
		$gol_awal_id = $pegawai->GOL_AWAL_ID;
		$recgolongan = $this->golongan_model->find($gol_awal_id);
		Template::set('GOLONGAN_AWAL', $recgolongan->NAMA);
		
		$jenis_jabatan = $pegawai->JENIS_JABATAN_ID;
		$recjenis_jabatan = $this->jenis_jabatan_model->find($jenis_jabatan);
		Template::set('JENIS_JABATAN', $recjenis_jabatan->NAMA);
		
		$JABATAN_ID = $pegawai->JABATAN_INSTANSI_ID;
		$recjabatan = $this->jabatan_model->find_by("KODE_JABATAN",TRIM($JABATAN_ID));
		Template::set('NAMA_JABATAN', $recjabatan->NAMA_JABATAN);
		 
		$unor = $this->unitkerja_model->find_by("ID",trim($pegawai->UNOR_ID));
		Template::set('nama_unor',$unor->NAMA_UNOR);
		$unor_induk = $this->unitkerja_model->find_by("ID",$unor->DIATASAN_ID);
		Template::set('unor_induk',$unor_induk->NAMA_UNOR);
		
		Template::set("parent_path_array_unor",$this->unitkerja_model->get_parent_path($unor->ID,true,true));
        Template::set('toolbar_title',"Lihat Profile");
		Template::set('view_back_button',true);
		Template::set('back_button_label',"<< Kembali ke Daftar Pegawai");
		Template::set('back_button_url',base_url("admin/kepegawaian/pegawai"));
        Template::render();
    }

    //--------------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------------

    /**
     * Save the data.
     *
     * @param string $type Either 'insert' or 'update'.
     * @param int    $id   The ID of the record to update, ignored on inserts.
     *
     * @return boolean|integer An ID for successful inserts, true for successful
     * updates, else false.
     */
    public function getdata(){
    	
		$draw = $this->input->post('draw');
		$iSortCol = $this->input->post('iSortCol_1');
		$sSortCol = $this->input->post('sSortDir_1');
		
		$length= $this->input->post('length') != "" ? $this->input->post('length') : 10;
		$start= $this->input->post('start') != "" ? $this->input->post('start') : 0;

		$search = isset($_REQUEST['search']["value"]) ? $_REQUEST['search']["value"] : "";
		$searchKey = isset($_REQUEST['search']["key"]) ? $_REQUEST['search']["key"] : "";

		$selectedUnors = array();
		$advanced_search_filters  = $this->input->post("search[advanced_search_filters]");
		if($advanced_search_filters){
			$filters = array();
			foreach($advanced_search_filters as  $filter){
				$filters[$filter['name']] = $filter["value"];
			}
			
		}

		$this->db->start_cache();
		
		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		$advanced_search_filters  = $this->input->post("search[advanced_search_filters]");
		if($advanced_search_filters){
			$filters = array();
			foreach($advanced_search_filters as  $filter){
				$filters[$filter['name']] = $filter["value"];
			}
			if($filters['nama_cb']){
				$this->pegawai_model->like('upper("NAMA")',strtoupper($filters['nama_key']),"BOTH");	
			}
			if($filters['unit_id_cb']){
				$this->db->group_start();
				$this->db->where('vw."ID"',$filters['unit_id_key']);	
				$this->db->or_where('vw."ESELON_1"',$filters['unit_id_key']);	
				$this->db->or_where('vw."ESELON_2"',$filters['unit_id_key']);	
				$this->db->or_where('vw."ESELON_3"',$filters['unit_id_key']);	
				$this->db->or_where('vw."ESELON_4"',$filters['unit_id_key']);	
				$this->db->group_end();
			}


			if($filters['nip_cb']){
				$this->pegawai_model->like('upper("NIP_BARU")',strtoupper($filters['nip_key']),"BOTH");	
			}
			if($filters['umur_cb']){
				if($filters['umur_operator']=="="){
					$this->pegawai_model->where('calc_age("TGL_LAHIR")',$filters['umur_key']*12);	
				}
				if($filters['umur_operator']==">="){
					$this->pegawai_model->where('calc_age("TGL_LAHIR") >=',$filters['umur_key']*12);	
				}
				if($filters['umur_operator']==">"){
					$this->pegawai_model->where('calc_age("TGL_LAHIR") >',$filters['umur_key']*12);	
				}
				if($filters['umur_operator']=="<="){
					$this->pegawai_model->where('calc_age("TGL_LAHIR") <=',$filters['umur_key']*12);	
				}
				if($filters['umur_operator']=="<"){
					$this->pegawai_model->where('calc_age("TGL_LAHIR")<',$filters['umur_key']*12);	
				}
				if($filters['umur_operator']=="!="){
					$this->pegawai_model->where('calc_age("TGL_LAHIR") !=',$filters['umur_key']*12);	
				}
			}
			if($filters['eselon_cb']){
				$this->pegawai_model->where('upper("NAMA") LIKE \''.strtoupper($filters['nip_key']).'%\'');	
			}
			if($filters['golongan_cb']){
				$this->pegawai_model->where('"GOL_ID"',strtoupper($filters['golongan_key']));	
			}
		}
		
		$this->db->stop_cache();
		$output=array();
		$output['draw']=$draw;
		$total= $this->pegawai_model->count_all($this->UNOR_ID);
		$orders = $this->input->post('order');
		foreach($orders as $order){
			if($order['column']==1){
				$this->pegawai_model->order_by("NIP_BARU",$order['dir']);
			}
			if($order['column']==2){
				$this->pegawai_model->order_by("NAMA",$order['dir']);
			}
			if($order['column']==3){
				$this->pegawai_model->order_by("NAMA_UNOR",$order['dir']);
			}
		}
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();
		
		$this->pegawai_model->limit($length,$start);
		$records=$this->pegawai_model->find_all($this->UNOR_ID);
		$this->db->flush_cache();
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut.".";
                $row []  = $record->NIP_BARU;
                $row []  = $record->NAMA;
                $row []  = $record->NAMA_UNOR_FULL;
                
                $btn_actions = array();
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."admin/kepegawaian/pegawai/profile/".$record->ID."'  data-toggle='tooltip' title='Lihat Profile'><span class='fa-stack'>
					   <i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-eye fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
				$btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."admin/kepegawaian/pegawai/cetak_drh/".$record->PNS_ID."'  data-toggle='tooltip' title='Cetak DRH'><span class='fa-stack'>
					   <i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-download fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                if($this->auth->has_permission("Pegawai.Kepegawaian.Edit")){
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."admin/kepegawaian/pegawai/edit/".$record->ID."' data-toggle='tooltip' title='Ubah data'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-pencil fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                }
                if($this->auth->has_permission("Pegawai.Kepegawaian.Delete")){
                $btn_actions  [] = "
                        <a href='#' kode='$record->ID' class='btn-hapus' data-toggle='tooltip' title='Hapus data' >
					   	<span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-trash-o fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                }
                $row[] = implode(" ",$btn_actions);
                

                $output['data'][] = $row;
				$nomor_urut++;
			}
		endif;
		echo json_encode($output);
		
	}
	public function cetak_drh($pns_id){
		$pegawai = $this->pegawai_model->get_drh($pns_id);
		$this->load->library('LibOpenTbs');
		$template_name = APPPATH."..".DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'template_drh.docx';
		$TBS = $this->libopentbs->TBS;
		
		$TBS->LoadTemplate($template_name, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
		
		$TBS->MergeField('a', array(
			'fullname'=>$pegawai->NAMA,
			'nip'=>$pegawai->NIP_BARU,
			'alamat'=>$pegawai->ALAMAT,
			'tempat_lahir'=>$pegawai->TEMPAT_LAHIR,
			'tanggal_lahir'=>$pegawai->TGL_LAHIR,
			'pangkat'=>$pegawai->PANGKAT_TEXT,
			'gol_ruang'=>$pegawai->GOL_TEXT,
			'sex'=>$pegawai->JENIS_KELAMIN=='M'?"Pria":"Wanita",
			'agama'=>$pegawai->AGAMA_TEXT,
			'status_kawin'=>$pegawai->KAWIN_TEXT,
		));
		$output_file_name = 'DRH.xlsx';
		$output_file_name = str_replace('.', '_'.date('Y-m-d').'.', $output_file_name);
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	}
	public function download()
	{
	  
		$advanced_search_filters  = $_GET;
		
		if($advanced_search_filters){
			$filters = $advanced_search_filters;
			
			if($filters['nama_cb']){
				$this->pegawai_model->like('upper("NAMA")',strtoupper($filters['nama_key']),"BOTH");	
				
			}
			if($filters['unit_id_cb']){
				$this->db->group_start();
				$this->db->where('vw."ID"',$filters['unit_id_key']);	
				$this->db->or_where('vw."ESELON_1"',$filters['unit_id_key']);	
				$this->db->or_where('vw."ESELON_2"',$filters['unit_id_key']);	
				$this->db->or_where('vw."ESELON_3"',$filters['unit_id_key']);	
				$this->db->or_where('vw."ESELON_4"',$filters['unit_id_key']);	
				$this->db->group_end();
			}


			if($filters['nip_cb']){
				$this->pegawai_model->like('upper("NIP_BARU")',strtoupper($filters['nip_key']),"BOTH");	
			}
			if($filters['umur_cb']){
				if($filters['umur_operator']=="="){
					$this->pegawai_model->where('calc_age("TGL_LAHIR")',$filters['umur_key']*12);	
				}
				if($filters['umur_operator']==">="){
					$this->pegawai_model->where('calc_age("TGL_LAHIR") >=',$filters['umur_key']*12);	
				}
				if($filters['umur_operator']==">"){
					$this->pegawai_model->where('calc_age("TGL_LAHIR") >',$filters['umur_key']*12);	
				}
				if($filters['umur_operator']=="<="){
					$this->pegawai_model->where('calc_age("TGL_LAHIR") <=',$filters['umur_key']*12);	
				}
				if($filters['umur_operator']=="<"){
					$this->pegawai_model->where('calc_age("TGL_LAHIR")<',$filters['umur_key']*12);	
				}
				if($filters['umur_operator']=="!="){
					$this->pegawai_model->where('calc_age("TGL_LAHIR") !=',$filters['umur_key']*12);	
				}
			}
			if($filters['eselon_cb']){
				$this->pegawai_model->where('upper("NAMA") LIKE \''.strtoupper($filters['nip_key']).'%\'');	
			}
			if($filters['golongan_cb']){
				$this->pegawai_model->where('"GOL_ID"',strtoupper($filters['golongan_key']));	
			}
		}
		
		$datapegwai=$this->pegawai_model->find_all($this->UNOR_ID);
		
		$this->load->library('Excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel = PHPExcel_IOFactory::load(trim($this->settings_lib->item('site.pathuploaded')).'template.xls');

		$objPHPExcel->setActiveSheetIndex(0);
		$col = 0;
		$itemfield = $this->db->list_fields('pegawai');
		foreach($itemfield as $field)
		{
			 
			   $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,1,$field);
			   $col++;
		}
		$row = 2;
		if (isset($datapegwai) && is_array($datapegwai) && count($datapegwai)) :
			foreach ($datapegwai as $record) :
				$col = 0;
				$type = PHPExcel_Cell_DataType::TYPE_STRING;
				foreach($itemfield as $field)
				{
					if($col == 3)
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$record->$field." ",PHPExcel_Cell_DataType::TYPE_STRING);
					else
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$record->$field);
					$col++;
				}
			   
			$row++;
			endforeach;
		endif;
		  
		$filename = "pegawai".mt_rand(1,100000).'.xls'; //just some random filename
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
		//$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
		$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
		exit; //done.. exiting!
		
	}
	public function getdatapensiun(){
		$draw = $this->input->post('draw');
		$iSortCol = $this->input->post('iSortCol_1');
		$sSortCol = $this->input->post('sSortDir_1');
		
		$length= $this->input->post('length');
		$start= $this->input->post('start');

		$search = isset($_REQUEST['search']["value"]) ? $_REQUEST['search']["value"] : "";
		 
		
		$output=array();
		

		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->pegawai_model->where('upper("NAMA") LIKE \''.strtoupper($search).'%\'');
			$this->pegawai_model->or_where('upper("NIP_BARU") LIKE \''.strtoupper($search).'%\'');
		}
		
		$this->pegawai_model->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$kolom = $iSortCol != "" ? $iSortCol : "NAMA";
		$sSortCol == "asc" ? "asc" : "desc";
		$this->pegawai_model->order_by($iSortCol,$sSortCol);
		$records=$this->pegawai_model->find_all_pensiun($this->UNOR_ID);

		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->pegawai_model->where('upper("NAMA") LIKE \''.strtoupper($search).'%\'');
			$this->pegawai_model->or_where('upper("NIP_BARU") LIKE \''.strtoupper($search).'%\'');
			//$this->pegawai_model->or_where('NIP_BARU',$search);
			$jum	= $this->pegawai_model->count_pensiun($this->UNOR_ID);
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}else{
			$total= $this->pegawai_model->count_pensiun($this->UNOR_ID);
			$output['draw']=$draw;
			$output['recordsTotal']= $output['recordsFiltered']=$total;
			$output['data']=array();

		}
		
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                $row []  = $record->NIP_BARU;
                $row []  = $record->NAMA;
                $row []  = $record->TGL_LAHIR;
                $row []  = $record->umur;
                $row []  = $record->NAMA_UNOR;
                
                $btn_actions = array();
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."admin/kepegawaian/pegawai/profile/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
					   <i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-eye fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                if($this->auth->has_permission("Pegawai.Kepegawaian.Edit")){
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."admin/kepegawaian/pegawai/edit/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-pencil fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
            	}
            	if($this->auth->has_permission("Pegawai.Kepegawaian.Delete")){
                $btn_actions  [] = "
                        <a href='#' kode='$record->ID' class='btn-hapus' data-toggle='tooltip' title='Hapus Pegawai' >
					   	<span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-trash-o fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                }
                $row[] = implode(" ",$btn_actions);
                

                $output['data'][] = $row;
				$nomor_urut++;
			}
		endif;
		echo json_encode($output);
		die();

	}
	public function deletedata()
	{
		$this->auth->restrict($this->permissionDelete);
		$id 	= $this->input->post('kode');
		if ($this->pegawai_model->delete($id)) {
			 log_activity($this->auth->user_id(),"Delete data" . ': ' . $id . ' : ' . $this->input->ip_address(), 'pegawai');
			 Template::set_message("Delete pegawai sukses", 'success');
			 echo "Sukses";
		}else{
			echo "Gagal";
		}

		exit();
	}
    private function save_pegawai($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->pegawai_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->pegawai_model->prep_data($this->input->post());
        
        $reclokasikerja = $this->lokasi_model->find($this->input->post('LOKASI_KERJA_ID'));
		$data['LOKASI_KERJA']	= $reclokasikerja->NAMA;
		$recpendidikan = $this->pendidikan_model->find($this->input->post('PENDIDIKAN_ID'));
		$data['PENDIDIKAN']	= $recpendidikan->NAMA;
		
		$rec_jenis = $this->jenis_jabatan_model->find($this->input->post("JENIS_JABATAN_ID"));
		$data["JENIS_JABATAN_NAMA"] = $rec_jenis->NAMA;

		$recjabatan = $this->jabatan_model->find_by("KODE_JABATAN",$this->input->post('JABATAN_INSTANSI_ID'));
		$data['JABATAN_INSTANSI_NAMA']	= $recjabatan->NAMA_JABATAN;
		
		$data['PNS_ID']	= $this->input->post('PNS_ID');
        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        
		$data['TGL_LAHIR']	= $this->input->post('TGL_LAHIR') ? $this->input->post('TGL_LAHIR') : null;
		$data['TGL_SK_CPNS']	= $this->input->post('TGL_SK_CPNS') ? $this->input->post('TGL_SK_CPNS') : null;
		$data['TMT_CPNS']	= $this->input->post('TMT_CPNS') ? $this->input->post('TMT_CPNS') : null;
		$data['TMT_PNS']	= $this->input->post('TMT_PNS') ? $this->input->post('TMT_PNS') : null;
		$data['TMT_GOLONGAN']	= $this->input->post('TMT_GOLONGAN') ? $this->input->post('TMT_GOLONGAN') : null;
		$data['TMT_JABATAN']	= $this->input->post('TMT_JABATAN') ? $this->input->post('TMT_JABATAN') : null;
		
		$data['TMT_PENSIUN']	= $this->input->post('TMT_PENSIUN') ? $this->input->post('TMT_PENSIUN') : null;
		$data['TGL_SURAT_DOKTER']	= $this->input->post('TGL_SURAT_DOKTER') ? $this->input->post('TGL_SURAT_DOKTER') : null;
		$data['TGL_BEBAS_NARKOBA']	= $this->input->post('TGL_BEBAS_NARKOBA') ? $this->input->post('TGL_BEBAS_NARKOBA') : null;
		$data['TGL_CATATAN_POLISI']	= $this->input->post('TGL_CATATAN_POLISI') ? $this->input->post('TGL_CATATAN_POLISI') : null;
		$data['TGL_MENINGGAL']	= $this->input->post('TGL_MENINGGAL') ? $this->input->post('TGL_MENINGGAL') : null;
		$data['TGL_NPWP']	= $this->input->post('TGL_NPWP') ? $this->input->post('TGL_NPWP') : null;
		

        $return = false;
        if ($type == 'insert') {
            $id = $this->pegawai_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->pegawai_model->update($id, $data);
        }

        return $return;
    }
    
    public function listpensiun()
    {	
    	$this->auth->restrict($this->permissionView);
        $records = $this->pegawai_model->find_all_pensiun($this->UNOR_ID);
        Template::set('records', $records);
    	Template::set('toolbar_title', "Estimasi Pegawai Pensiun");
		
        Template::render();
    }
	public function ajax_unit_list(){
		$length = 10;
		$term = $this->input->get('term');
		$page = $this->input->get('page');
		$this->db->flush_cache();
		//Jika ada role executive ?
		$UNOR_ID = '';
		$CI = &get_instance();
		
		if($CI->auth->role_id() =="5"){
			$UNOR_ID = $this->pegawai_model->getunor_id($CI->auth->username());
		}
		$data = $this->unitkerja_model->find_unit($term,$UNOR_ID);

		$output = array();
		$output['results'] = array();
		foreach($data as $row){
			$output['results'] [] = array(
				'id'=>$row->ID,
				'text'=>$row->NAMA_UNOR_FULL
			);
		}
		$output['pagination'] = array("more"=>false);
		
		echo json_encode($output);
	}

	public function ajax_satker_list(){
		$length = 10;
		$term = $this->input->get('term');
		$page = $this->input->get('page');
		$this->db->flush_cache();
		$this->db->like("lower(\"NAMA_UNOR\")",strtolower($term),"BOTH");
		$data = $this->unitkerja_model->find_satker();
		
		$output = array();
		$output['results'] = array();
		foreach($data as $row){
			$nama_unor = array();
			
			$output['results'] [] = array(
				'id'=>$row->ID,
				'text'=>$row->NAMA_UNOR
			);
		}
		$output['pagination'] = array("more"=>false);
		
		echo json_encode($output);
	}
}