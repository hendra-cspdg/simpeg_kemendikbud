<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class Riwayatpendidikan extends Admin_Controller
{
    protected $permissionCreate = 'RiwayatPendidikan.Kepegawaian.Create';
    protected $permissionDelete = 'RiwayatPendidikan.Kepegawaian.Delete';
    protected $permissionEdit   = 'RiwayatPendidikan.Kepegawaian.Edit';
    protected $permissionView   = 'RiwayatPendidikan.Kepegawaian.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pegawai/riwayat_pendidikan_model');
        $this->load->model('pegawai/pegawai_model');
        $this->load->model('pegawai/tingkatpendidikan_model');
        
    }
    public function ajax_list(){
        $draw = $this->input->post('draw');
		$iSortCol = $this->input->post('iSortCol_1');
		$sSortCol = $this->input->post('sSortDir_1');
        $PNS_ID = $this->input->post('PNS_ID');
		
		$length= $this->input->post('length');
		$start= $this->input->post('start');

		$search = isset($_REQUEST['search']["value"]) ? $_REQUEST['search']["value"] : "";
		$this->riwayat_pendidikan_model->where("PNS_ID",$PNS_ID);
		$total= $this->riwayat_pendidikan_model->count_all();;
		$output=array();
		$output['draw']=$draw;

		
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();


		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->riwayat_pendidikan_model->where('upper("NAMA_DIKLAT") LIKE \''.strtoupper($search).'%\'');
		}
		$this->riwayat_pendidikan_model->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$kolom = $iSortCol != "" ? $iSortCol : "NAMA";
		$sSortCol == "asc" ? "asc" : "desc";
		$this->riwayat_pendidikan_model->order_by($iSortCol,$sSortCol);
        $this->riwayat_pendidikan_model->order_by("TAHUN_LULUS","asc");
        $this->riwayat_pendidikan_model->where("PNS_ID",$PNS_ID);    
		$records=$this->riwayat_pendidikan_model->find_all();

		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->riwayat_pendidikan_model->where('upper("NAMA_DIKLAT") LIKE \''.strtoupper($search).'%\'');
			$jum	= $this->riwayat_pendidikan_model->count_all();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}
		
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                $row []  = $record->tk_pendidikan_text;
                $row []  = $record->NAMA_SEKOLAH;
                $row []  = $record->TAHUN_LULUS;
                $row []  = $record->NOMOR_IJASAH;
                
                $btn_actions = array();
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."pegawai/riwayatpendidikan/detil/".$PNS_ID."/".$record->ID."'  data-toggle='modal' title='Lihat detil'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-eye fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                
                if($this->auth->has_permission("RiwayatPendidikan.Kepegawaian.Edit")){
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."pegawai/riwayatpendidikan/edit/".$PNS_ID."/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
					   	<i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-pencil fa-stack-1x fa-inverse'></i>
					   	</span>
					   	</a>
                ";
                }
                if($this->auth->has_permission("RiwayatPendidikan.Kepegawaian.Edit")){
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
        $tingkatpendidikans = $this->tingkatpendidikan_model->find_all();
		Template::set('tk_pendidikans', $tingkatpendidikans);
        if(empty($record_id)){
            $this->auth->restrict($this->permissionCreate);
            Template::set_view("kepegawaian/riwayat_pendidikan_add");
            
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Tambah Riwayat Pendidikan");

            Template::render();
        }
        else {
            $this->auth->restrict($this->permissionEdit);
            Template::set_view("kepegawaian/riwayat_pendidikan_add");
            Template::set('detail_riwayat', $this->riwayat_pendidikan_model->find($record_id));    
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Ubah Riwayat Pendidikan");

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
        $tingkatpendidikans = $this->tingkatpendidikan_model->find_all();
		Template::set('tk_pendidikans', $tingkatpendidikans);
		Template::set_view("kepegawaian/detilpendidikan");
		Template::set('detail_riwayat', $this->riwayat_pendidikan_model->find($record_id));    
		Template::set('PNS_ID', $PNS_ID);
		Template::set('toolbar_title', "Detil Riwayat Pendidikan");

		Template::render();
    }
    public function save(){
         // Validate the data
        $this->form_validation->set_rules($this->riwayat_pendidikan_model->get_validation_rules());
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

        $data = $this->riwayat_pendidikan_model->prep_data($this->input->post());
       if(empty($data['TANGGAL_LULUS'])){
            unset($data['TANGGAL_LULUS']);
       }
        $id_data = $this->input->post("id_data");
        if(isset($id_data) && !empty($id_data)){
            $this->riwayat_pendidikan_model->update($id_data,$data);
        }
        else $this->riwayat_pendidikan_model->insert($data);
        $response ['success']= true;
        $response ['msg']= "Transaksi berhasil";
        echo json_encode($response);    

    }
    public function delete($record_id){
        $this->auth->restrict($this->permissionDelete);
		if ($this->riwayat_pendidikan_model->delete($record_id)) {
			 log_activity($this->auth->user_id(), 'delete data Riwayat Diklat Struktural : ' . $record_id . ' : ' . $this->input->ip_address(), 'pegawai');
			 Template::set_message("Sukses Hapus data", 'success');
			 echo "Sukses";
		}else{
			echo "Gagal";
		}

		exit();
    }
    public function index($PNS_ID=8){
        Template::set_view("kepegawaian/tab_pane_riwayat_diklat_struktural");
        Template::set('PNS_ID', $PNS_ID);
        Template::set('TAB_ID', uniqid("TAB_CONTOH"));
        Template::render();
    }
}
