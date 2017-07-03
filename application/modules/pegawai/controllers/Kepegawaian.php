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
		$this->load->model('pegawai/unitkerja_model');
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
			$uploadData = handle_upload('userfile',trim($this->settings_lib->item('site.urlphoto')));
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
        	$unor = $this->unitkerja_model->find_by("ID_BKN",TRIM($pegawaiData->UNOR_ID));
        	Template::set('selectedUnorid',$unor);
        	Template::set('selectedUnorindukid',$unor);
        }else{
        	Template::set('selectedUnorid',$this->unitkerja_model->find_by("ID_BKN",TRIM($pegawaiData->UNOR_ID)));
        	Template::set('selectedUnorindukid',$this->unitkerja_model->find_by("ID_BKN",TRIM($pegawaiData->UNOR_INDUK_ID)));
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
            Template::set_message(lang('pegawai_invalid_id'), 'error');

            redirect(SITE_AREA . '/kepegawaian/pegawai');
        }
        
        $this->load->library('convert');
 		
        $pegawai = $this->pegawai_model->find_detil($id);
        Template::set('pegawai', $pegawai);
        Template::set('PNS_ID', $pegawai->PNS_ID);
		// lokasi kerja
		$gol_id = $pegawai->GOL_ID;
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
		Template::set('NAMA_JABATAN', $recjabatan->NAMA_JABATAN_FULL);
		 
		$unor = $this->unitkerja_model->find_by("ID_BKN",trim($pegawai->UNOR_ID));
		Template::set('nama_unor',$unor->NAMA_UNOR);
		$unor_induk = $this->unitkerja_model->find_by("ID",$unor->PARENT_ID);
		Template::set('unor_induk',$unor_induk->NAMA_UNOR);
		
		Template::set("parent_path_array_unor",$this->unitkerja_model->get_parent_path($unor->ID,true,true));
        Template::set('toolbar_title',"View Profile");
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
		
		$length= $this->input->post('length');
		$start= $this->input->post('start');

		$search = isset($_REQUEST['search']["value"]) ? $_REQUEST['search']["value"] : "";
		$searchKey = isset($_REQUEST['search']["key"]) ? $_REQUEST['search']["key"] : "";
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
				$this->pegawai_model->where('upper("NAMA") LIKE \''.strtoupper($filters['nama_key']).'%\'');	
			}
			if($filters['nip_cb']){
				$this->pegawai_model->where('upper("NIP_BARU") LIKE \''.strtoupper($filters['nip_key']).'%\'');	
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
		$total= $this->pegawai_model->count_all();
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();
		$this->pegawai_model->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$kolom = $iSortCol != "" ? $iSortCol : "NAMA";
		$sSortCol == "asc" ? "asc" : "desc";
		$this->pegawai_model->order_by($iSortCol,$sSortCol);
		$records=$this->pegawai_model->find_all();

		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		
		if($search!=""){
			if($searchKey=='nip_baru'){
				$this->pegawai_model->where('upper("NIP_BARU") LIKE \''.strtoupper($search).'%\'');
			}
			else if($searchKey=='nip_lama'){
				$this->pegawai_model->where('upper("NIP_LAMA") LIKE \''.strtoupper($search).'%\'');
			}
			else if($searchKey=='nama_pegawai'){
				$this->pegawai_model->where('upper("NAMA") LIKE \''.strtoupper($search).'%\'');	
			}
			else if($searchKey=='nama_unit'){
				//$this->pegawai_model->where('unitkerja."NAMA_UNOR" LIKE \''.strtoupper($search).'%\'');	
			}
			$jum	= $this->pegawai_model->count_all();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                $row []  = $record->NIP_BARU;
                $row []  = $record->NAMA;
                $row []  = $this->unitkerja_model->get_parent_path($record->UNIT_ID,true,false);
                
                $btn_actions = array();
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."admin/kepegawaian/pegawai/profile/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
					   <i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-eye fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."admin/kepegawaian/pegawai/edit/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-pencil fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                $btn_actions  [] = "
                        <a href='#' kode='$record->ID' class='btn-hapus' data-toggle='tooltip' title='Hapus data' >
					   	<span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-trash-o fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                
                $row[] = implode(" ",$btn_actions);
                

                $output['data'][] = $row;
				$nomor_urut++;
			}
		endif;
		echo json_encode($output);
		$this->db->flush_cache();
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
		$records=$this->pegawai_model->find_all_pensiun();

		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->pegawai_model->where('upper("NAMA") LIKE \''.strtoupper($search).'%\'');
			$this->pegawai_model->or_where('upper("NIP_BARU") LIKE \''.strtoupper($search).'%\'');
			//$this->pegawai_model->or_where('NIP_BARU',$search);
			$jum	= $this->pegawai_model->count_pensiun();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}else{
			$total= $this->pegawai_model->count_pensiun();
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
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."admin/kepegawaian/pegawai/edit/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-pencil fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                $btn_actions  [] = "
                        <a href='#' kode='$record->ID' class='btn-hapus' data-toggle='tooltip' title='Hapus Pegawai' >
					   	<span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-trash-o fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                
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
        $records = $this->pegawai_model->find_all_pensiun();
        Template::set('records', $records);
    	Template::set('toolbar_title', "Estimasi Pegawai Pensiun");
		
        Template::render();
    }
}