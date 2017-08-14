<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class Riwayatpekerjaan extends Admin_Controller
{
    protected $permissionCreate = 'riwayatpekerjaan.Kepegawaian.Create';
    protected $permissionDelete = 'riwayatpekerjaan.Kepegawaian.Delete';
    protected $permissionEdit   = 'riwayatpekerjaan.Kepegawaian.Edit';
    protected $permissionView   = 'riwayatpekerjaan.Kepegawaian.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pegawai/riwayat_pekerjaan_model');
        $this->load->model('pegawai/pegawai_model');
        $this->load->model('pegawai/jenis_jabatan_model');
        $this->load->model('ref_jabatan/jabatan_model');
        $jenis_jabatans = $this->jenis_jabatan_model->find_all();
		Template::set('jenis_jabatans', $jenis_jabatans);
		
		$this->load->model('pegawai/unitkerja_model');
		
    }
    public function ajax_list(){
        $this->load->library('convert');
 		$convert = new convert();
        $draw = $this->input->post('draw');
		$iSortCol = $this->input->post('iSortCol_1');
		$sSortCol = $this->input->post('sSortDir_1');
        $PNS_ID = $this->input->post('PNS_ID');
        if(empty($PNS_ID)){
            ECHO "die";
            die();
        }
        $this->pegawai_model->where("PNS_ID",$PNS_ID);
        $pegawai_data = $this->pegawai_model->find_first_row();
       
		$length= $this->input->post('length');
		$start= $this->input->post('start');

		$search = isset($_REQUEST['search']["value"]) ? $_REQUEST['search']["value"] : "";
		//$this->riwayat_pekerjaan_model->where("PNS_ID",$pegawai_data->ID);
		$this->riwayat_pekerjaan_model->where("PNS_NIP",$pegawai_data->NIP_BARU);
		$total= $this->riwayat_pekerjaan_model->count_all();;
		$output=array();
		$output['draw']=$draw;

		
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();
        
		
        
		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->riwayat_pekerjaan_model->where('upper("SEBAGAI") LIKE \''.strtoupper($search).'%\'');
		}
		$this->riwayat_pekerjaan_model->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
        
		$kolom = $iSortCol != "" ? $iSortCol : "DARI_TANGGAL";
		$sSortCol == "desc" ? "desc" : "asc";
		$this->riwayat_pekerjaan_model->order_by($iSortCol,$sSortCol);
        
        //$this->riwayat_pekerjaan_model->where("PNS_ID",$pegawai_data->PNS_ID); 
        $this->riwayat_pekerjaan_model->where("PNS_NIP",$pegawai_data->NIP_BARU); 
		$this->riwayat_pekerjaan_model->ORDER_BY($kolom,$sSortCol);
        $records=$this->riwayat_pekerjaan_model->find_all();
            
		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->riwayat_pekerjaan_model->where('upper("SEBAGAI") LIKE \''.strtoupper($search).'%\'');
			$jum	= $this->riwayat_pekerjaan_model->count_all();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}
		
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                
                $row []  = $record->NAMA_PERUSAHAAN;
                $row []  = $record->SEBAGAI;
                $row []  = $convert->fmtDate($record->DARI_TANGGAL,"dd-mm-yyyy")." - ".$convert->fmtDate($record->SAMPAI_TANGGAL,"dd-mm-yyyy");
                $btn_actions = array();
                
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."pegawai/riwayatpekerjaan/detil/".$PNS_ID."/".$record->ID."'  data-toggle='modal' title='Lihat detil'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-eye fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                
                if($this->auth->has_permission("riwayatpekerjaan.Kepegawaian.Edit")){
                	$btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."pegawai/riwayatpekerjaan/edit/".$PNS_ID."/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-pencil fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                }
                if($this->auth->has_permission("riwayatpekerjaan.Kepegawaian.Delete")){
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
		die();
    }
    public function show($PNS_ID,$record_id=''){
        if(empty($record_id)){
            $this->auth->restrict($this->permissionCreate);
            Template::set_view("kepegawaian/riwayat_pekerjaan_crud");
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Tambah Riwayat ekerjaan");
            Template::render();
        }
        else {
    		$datadetil = $this->riwayat_pekerjaan_model->find($record_id); 
            $this->auth->restrict($this->permissionEdit);
            Template::set_view("kepegawaian/riwayat_pekerjaan_crud");
           
            Template::set('detail_riwayat', $datadetil);    
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Ubah Riwayat Pekerjaan");

            Template::render();
        }
    }
    public function add($PNS_ID){
        $this->show($PNS_ID);
    }
    public function edit($PNS_ID,$record_id=''){
        $this->show($PNS_ID,$record_id);
    }
    public function detil($PNS_ID,$record_id=''){
    	$datadetil = $this->riwayat_pekerjaan_model->find($record_id); 
            $this->auth->restrict($this->permissionEdit);
            Template::set_view("kepegawaian/riwayat_pekerjaan_detil");
           
            Template::set('detail_riwayat', $datadetil);    
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Riwayat Pekerjaan");

            Template::render();
		Template::render();
    }
    
    public function save(){
         // Validate the data
        $this->form_validation->set_rules($this->riwayat_pekerjaan_model->get_validation_rules());
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
		
		
        $data = $this->riwayat_pekerjaan_model->prep_data($this->input->post());
       	$this->pegawai_model->where("PNS_ID",$this->input->post("PNS_ID"));
        $pegawai_data = $this->pegawai_model->find_first_row();  
        $data["PNS_NIP"] = $pegawai_data->NIP_BARU;
        $data["PNS_ID"] = $pegawai_data->PNS_ID;
        
       
        if(empty($data["DARI_TANGGAL"])){
            unset($data["DARI_TANGGAL"]);
        }
        if(empty($data["SAMPAI_TANGGAL"])){
            unset($data["SAMPAI_TANGGAL"]);
        }
        $id_data = $this->input->post("ID");
        if(isset($id_data) && !empty($id_data)){
            $this->riwayat_pekerjaan_model->update($id_data,$data);
        }
        else $this->riwayat_pekerjaan_model->insert($data);
        $response ['success']= true;
        $response ['msg']= "berhasil";
        echo json_encode($response);    

    }
    public function delete($record_id){
        $this->auth->restrict($this->permissionDelete);
		if ($this->riwayat_pekerjaan_model->delete($record_id)) {
			 log_activity($this->auth->user_id(), 'delete data Riwayat pekerjaan : ' . $record_id . ' : ' . $this->input->ip_address(), 'pegawai');
			 Template::set_message("Sukses Hapus data", 'success');
			 echo "Sukses";
		}else{
			echo "Gagal";
		}

		exit();
    }
    public function index($PNS_ID='1552260645'){
        Template::set_view("kepegawaian/tab_pane_riwayat_jabatan");
        Template::set('PNS_ID', $PNS_ID);
        Template::set('TAB_ID', uniqid("TAB_CONTOH"));
        Template::render();
    }
}
