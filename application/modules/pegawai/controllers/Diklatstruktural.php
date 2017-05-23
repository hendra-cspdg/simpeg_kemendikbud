<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class Diklatstruktural extends Admin_Controller
{
    protected $permissionCreate = 'DiklatStruktural.Kepegawaian.Create';
    protected $permissionDelete = 'DiklatStruktural.Kepegawaian.Delete';
    protected $permissionEdit   = 'DiklatStruktural.Kepegawaian.Edit';
    protected $permissionView   = 'DiklatStruktural.Kepegawaian.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
         $this->load->model('pegawai/diklat_struktural_model');
    }
    public function ajax_list(){
        $draw = $this->input->post('draw');
		$iSortCol = $this->input->post('iSortCol_1');
		$sSortCol = $this->input->post('sSortDir_1');
        $PNS_ID = $this->input->post('PNS_ID');
		
		$length= $this->input->post('length');
		$start= $this->input->post('start');

		$search = isset($_REQUEST['search']["value"]) ? $_REQUEST['search']["value"] : "";
		$this->diklat_struktural_model->where("ID_PNS",$PNS_ID);
		$total= $this->diklat_struktural_model->count_all();;
		$output=array();
		$output['draw']=$draw;

		
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();


		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->diklat_struktural_model->where('upper("NAMA_DIKLAT") LIKE \''.strtoupper($search).'%\'');
		}
		$this->diklat_struktural_model->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$kolom = $iSortCol != "" ? $iSortCol : "Nama";
		$sSortCol == "asc" ? "asc" : "desc";
		$this->diklat_struktural_model->order_by($iSortCol,$sSortCol);
        $this->diklat_struktural_model->where("ID_PNS",$PNS_ID);    
		$records=$this->diklat_struktural_model->find_all();

		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->diklat_struktural_model->where('upper("NAMA_DIKLAT") LIKE \''.strtoupper($search).'%\'');
			$jum	= $this->diklat_struktural_model->count_all();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}
		
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                $row []  = $record->NAMA_DIKLAT;
                $row []  = $record->TANGGAL;
                $row []  = $record->TAHUN;
                
                $btn_actions = array();
                $btn_actions  [] = "
                    <a class='show-modal' href='".base_url()."pegawai/diklatstruktural/edit/".$PNS_ID."/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
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
		die();
    }
    public function show($PNS_ID,$record_id=''){
        if(empty($record_id)){
            $this->auth->restrict($this->permissionCreate);
            Template::set_view("kepegawaian/riwayat_diklat_struktural_add");
            
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Tambah Riwayat Diklat Struktural");

            Template::render();
        }
        else {
            $this->auth->restrict($this->permissionEdit);
            Template::set_view("kepegawaian/riwayat_diklat_struktural_add");
            Template::set('rwt_pendidikan', $this->diklat_struktural_model->find($record_id));
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Ubah Riwayat Diklat Struktural");

            Template::render();
        }
    }
    public function add($PNS_ID){
        $this->show($PNS_ID);
    }
    public function edit($PNS_ID,$record_id=''){
        $this->show($PNS_ID,$record_id);
    }
    public function save($record_id=''){

    }
    public function delete($record_id){
        $this->auth->restrict($this->permissionDelete);
		if ($this->diklat_struktural_model->delete($record_id)) {
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