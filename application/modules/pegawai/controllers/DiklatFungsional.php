<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class Diklatfungsional extends Admin_Controller
{
    protected $permissionCreate = 'DiklatFungsional.Kepegawaian.Create';
    protected $permissionDelete = 'DiklatFungsional.Kepegawaian.Delete';
    protected $permissionEdit   = 'DiklatFungsional.Kepegawaian.Edit';
    protected $permissionView   = 'DiklatFungsional.Kepegawaian.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
         $this->load->model('pegawai/diklat_fungsional_model');
         $this->load->model('pegawai/jenis_diklat_fungsional_model');
        $this->load->model('pegawai/pegawai_model');
    }
    public function ajax_list(){
        
        $draw = $this->input->post('draw');
		$iSortCol = $this->input->post('iSortCol_1');
		$sSortCol = $this->input->post('sSortDir_1');
        $PNS_ID = $this->input->post('PNS_ID');
        $this->pegawai_model->where("PNS_ID",$PNS_ID);
        $pegawai_data = $this->pegawai_model->find_first_row();
       
		$length= $this->input->post('length');
		$start= $this->input->post('start');

		$search = isset($_REQUEST['search']["value"]) ? $_REQUEST['search']["value"] : "";
		$this->diklat_fungsional_model->where("NIP_BARU",$pegawai_data->NIP_BARU);
		$total= $this->diklat_fungsional_model->count_all();;
		$output=array();
		$output['draw']=$draw;

		
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();
        
		
        
		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->diklat_fungsional_model->where('upper("NAMA_KURSUS") LIKE \''.strtoupper($search).'%\'');
		}
		$this->diklat_fungsional_model->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
        
		$kolom = $iSortCol != "" ? $iSortCol : "NAMA";
		$sSortCol == "asc" ? "asc" : "desc";
		$this->diklat_fungsional_model->order_by($iSortCol,$sSortCol);
        
        $this->diklat_fungsional_model->where("NIP_BARU",$pegawai_data->NIP_BARU);  
		
        $records=$this->diklat_fungsional_model->find_all();
            
		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->diklat_fungsional_model->where('upper("NAMA_KURSUS") LIKE \''.strtoupper($search).'%\'');
			$jum	= $this->diklat_fungsional_model->count_all();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}
		
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                $row []  = $record->NAMA_KURSUS;
                $row []  = $record->TANGGAL_KURSUS;
                $row []  = $record->TAHUN;
                
                $btn_actions = array();
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."pegawai/diklatfungsional/edit/".$PNS_ID."/".$record->DIKLAT_FUNGSIONAL_ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-pencil fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                $btn_actions  [] = "
                        <a href='#' kode='$record->DIKLAT_FUNGSIONAL_ID' class='btn-hapus' data-toggle='tooltip' title='Hapus data' >
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
    public function show($PNS_ID,$record_id=''){
        $this->load->model('pegawai/Jenis_diklat_fungsional_model');
        Template::set('jenis_diklats', $this->Jenis_diklat_fungsional_model->find_all());
        if(empty($record_id)){
            $this->auth->restrict($this->permissionCreate);
            Template::set_view("kepegawaian/riwayat_diklat_fungsional_add");
            
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Tambah Riwayat Diklat Fungsional");

            Template::render();
        }
        else {
            $this->auth->restrict($this->permissionEdit);
            Template::set_view("kepegawaian/riwayat_diklat_fungsional_add");
            Template::set('detail_riwayat', $this->diklat_fungsional_model->find($record_id));    
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Ubah Riwayat Diklat Fungsional");

            Template::render();
        }
    }
    public function add($PNS_ID){
        $this->show($PNS_ID);
    }
    public function edit($PNS_ID,$record_id=''){
        $this->show($PNS_ID,$record_id);
    }
    public function save(){
         // Validate the data
        $this->form_validation->set_rules($this->diklat_fungsional_model->get_validation_rules());
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

        $data = $this->diklat_fungsional_model->prep_data($this->input->post());
       
        $this->pegawai_model->where("PNS_ID",$this->input->post("PNS_ID"));
        $pegawai_data = $this->pegawai_model->find_first_row();  
        $data["NIP_BARU"] = $pegawai_data->NIP_BARU;
        $data["NIP_LAMA"] = $pegawai_data->NIP_LAMA;
      
          if(empty($data["TANGGAL_KURSUS"])){
            unset($data["TANGGAL_KURSUS"]);
        }
        $id_data = $this->input->post("DIKLAT_FUNGSIONAL_ID");
        if(isset($id_data) && !empty($id_data)){
            $this->diklat_fungsional_model->update($id_data,$data);
        }
        else $this->diklat_fungsional_model->insert($data);
        $response ['success']= true;
        $response ['msg']= "Transaksi berhasil";
        echo json_encode($response);    

    }
    public function delete($record_id){
        $this->auth->restrict($this->permissionDelete);
		if ($this->diklat_fungsional_model->delete($record_id)) {
			 log_activity($this->auth->user_id(), 'delete data Riwayat Diklat Fungsional : ' . $record_id . ' : ' . $this->input->ip_address(), 'pegawai');
			 Template::set_message("Sukses Hapus data", 'success');
			 echo "Sukses";
		}else{
			echo "Gagal";
		}

		exit();
    }
    public function index($PNS_ID='1552260645'){
        Template::set_view("kepegawaian/tab_pane_riwayat_diklat_fungsional");
        Template::set('PNS_ID', $PNS_ID);
        Template::set('TAB_ID', uniqid("TAB_CONTOH"));
        Template::render();
    }
}
