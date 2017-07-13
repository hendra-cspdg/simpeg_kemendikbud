<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class Riwayatkepangkatan extends Admin_Controller
{
    protected $permissionCreate = 'RiwayatKepangkatan.Kepegawaian.Create';
    protected $permissionDelete = 'RiwayatKepangkatan.Kepegawaian.Delete';
    protected $permissionEdit   = 'RiwayatKepangkatan.Kepegawaian.Edit';
    protected $permissionView   = 'RiwayatKepangkatan.Kepegawaian.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pegawai/riwayat_kepangkatan_model');
        $this->load->model('pegawai/jenis_kp_model');
        $this->load->model('pegawai/pegawai_model');
        $this->load->model('pegawai/golongan_model');
    }
    public function ajax_list(){
        
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
		$this->riwayat_kepangkatan_model->where("PNS_ID",$pegawai_data->ID);
		$total= $this->riwayat_kepangkatan_model->count_all();;
		$output=array();
		$output['draw']=$draw;

		
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();
        
		
        
		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->riwayat_kepangkatan_model->where('upper("PANGKAT") LIKE \''.strtoupper($search).'%\'');
		}
		$this->riwayat_kepangkatan_model->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
        
		$kolom = $iSortCol != "" ? $iSortCol : "NAMA";
		$sSortCol == "asc" ? "asc" : "desc";
		$this->riwayat_kepangkatan_model->order_by($iSortCol,$sSortCol);
         $this->riwayat_kepangkatan_model->order_by("TMT_GOLONGAN","asc");
        $this->riwayat_kepangkatan_model->where("PNS_ID",$pegawai_data->PNS_ID);  
		
        $records=$this->riwayat_kepangkatan_model->find_all();
            
		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->riwayat_kepangkatan_model->where('upper("PANGKAT") LIKE \''.strtoupper($search).'%\'');
			$jum	= $this->riwayat_kepangkatan_model->count_all();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}
		
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                $row []  = $record->PANGKAT;
                $row []  = $record->GOLONGAN;
                $row []  = $record->TMT_GOLONGAN;
                $row []  = $record->MK_GOLONGAN_TAHUN." tahun/".$record->MK_GOLONGAN_BULAN." bulan";
                
                $btn_actions = array();
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."pegawai/riwayatkepangkatan/detil/".$PNS_ID."/".$record->ID."'  data-toggle='modal' title='Lihat detil'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-eye fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                if($this->auth->has_permission("RiwayatKepangkatan.Kepegawaian.Edit")){
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."pegawai/riwayatkepangkatan/edit/".$PNS_ID."/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-pencil fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                }
                if($this->auth->has_permission("RiwayatKepangkatan.Kepegawaian.Edit")){
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
        
        Template::set('golongans', $this->golongan_model->find_all());
        Template::set('jenis_kps', $this->jenis_kp_model->find_all());
        if(empty($record_id)){
            $this->auth->restrict($this->permissionCreate);
            Template::set_view("kepegawaian/riwayat_kepangkatan_crud");
            
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Tambah Riwayat Diklat Kepangkatan");

            Template::render();
        }
        else {
            $this->auth->restrict($this->permissionEdit);
            Template::set_view("kepegawaian/riwayat_kepangkatan_crud");
            Template::set('detail_riwayat', $this->riwayat_kepangkatan_model->find($record_id));    
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Ubah Riwayat Diklat Kepangkatan");

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
        Template::set('golongans', $this->golongan_model->find_all());
        Template::set('jenis_kps', $this->jenis_kp_model->find_all());
		Template::set_view("kepegawaian/detilkepangkatan");
		Template::set('detail_riwayat', $this->riwayat_kepangkatan_model->find($record_id));    
		Template::set('PNS_ID', $PNS_ID);
		Template::set('toolbar_title', "Detil Riwayat Diklat Kepangkatan");

		Template::render();
    }
    public function save(){
         // Validate the data
        $this->form_validation->set_rules($this->riwayat_kepangkatan_model->get_validation_rules());
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

        $data = $this->riwayat_kepangkatan_model->prep_data($this->input->post());
       
        $this->pegawai_model->where("PNS_ID",$this->input->post("PNS_ID"));
        $pegawai_data = $this->pegawai_model->find_first_row();  
        $data["PNS_NIP"] = $pegawai_data->NIP_BARU;
        $data["PNS_ID"] = $pegawai_data->PNS_ID;
        $data["PNS_NAMA"] = $pegawai_data->NAMA;
        
        $jenis_kp_data = $this->jenis_kp_model->find($data['KODE_JENIS_KP']);
        $data["JENIS_KP"] = $jenis_kp_data->NAMA;
        
        $this->golongan_model->where("ID",$data['ID_GOLONGAN']);
        $golongan_data = $this->golongan_model->find_first_row();
        $data["GOLONGAN"] = $golongan_data->NAMA;
        $data["PANGKAT"] = $golongan_data->NAMA_PANGKAT;
        
        if(empty($data["TMT_GOLONGAN"])){
            unset($data["TMT_GOLONGAN"]);
        }
        if(empty($data["SK_TANGGAL"])){
            unset($data["SK_TANGGAL"]);
        }
        $id_data = $this->input->post("ID");
        if(isset($id_data) && !empty($id_data)){
            $this->riwayat_kepangkatan_model->update($id_data,$data);
        }
        else $this->riwayat_kepangkatan_model->insert($data);
        $response ['success']= true;
        $response ['msg']= "Transaksi berhasil";
        echo json_encode($response);    

    }
    public function delete($record_id){
        $this->auth->restrict($this->permissionDelete);
		if ($this->riwayat_kepangkatan_model->delete($record_id)) {
			 log_activity($this->auth->user_id(), 'delete data Riwayat Diklat Kepangkatan : ' . $record_id . ' : ' . $this->input->ip_address(), 'pegawai');
			 Template::set_message("Sukses Hapus data", 'success');
			 echo "Sukses";
		}else{
			echo "Gagal";
		}

		exit();
    }
    public function index($PNS_ID='1552260645'){
        Template::set_view("kepegawaian/tab_pane_riwayat_kepangkatan");
        Template::set('PNS_ID', $PNS_ID);
        Template::set('TAB_ID', uniqid("TAB_CONTOH"));
        Template::render();
    }
}
