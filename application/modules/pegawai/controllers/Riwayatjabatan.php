<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class Riwayatjabatan extends Admin_Controller
{
    protected $permissionCreate = 'riwayatjabatan.Kepegawaian.Create';
    protected $permissionDelete = 'riwayatjabatan.Kepegawaian.Delete';
    protected $permissionEdit   = 'riwayatjabatan.Kepegawaian.Edit';
    protected $permissionView   = 'riwayatjabatan.Kepegawaian.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pegawai/riwayat_jabatan_model');
        $this->load->model('pegawai/pegawai_model');
        $this->load->model('pegawai/jenis_jabatan_model');
        $this->load->model('ref_jabatan/jabatan_model');
        $jenis_jabatans = $this->jenis_jabatan_model->find_all();
		Template::set('jenis_jabatans', $jenis_jabatans);
		
		$this->load->model('pegawai/unitkerja_model');
		
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
		$this->riwayat_jabatan_model->where("PNS_ID",$pegawai_data->ID);
		$total= $this->riwayat_jabatan_model->count_all();;
		$output=array();
		$output['draw']=$draw;

		
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();
        
		
        
		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->riwayat_jabatan_model->where('upper("NAMA_JABATAN") LIKE \''.strtoupper($search).'%\'');
		}
		$this->riwayat_jabatan_model->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
        
		$kolom = $iSortCol != "" ? $iSortCol : "NAMA_JABATAN";
		$sSortCol == "asc" ? "asc" : "desc";
		$this->riwayat_jabatan_model->order_by($iSortCol,$sSortCol);
        
        $this->riwayat_jabatan_model->where("PNS_ID",$pegawai_data->PNS_ID);  
		
        $records=$this->riwayat_jabatan_model->find_all();
            
		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->riwayat_jabatan_model->where('upper("NAMA_JABATAN") LIKE \''.strtoupper($search).'%\'');
			$jum	= $this->riwayat_jabatan_model->count_all();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}
		
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                $row []  = $record->NAMA_JABATAN;
                $row []  = $record->TMT_JABATAN;
                $btn_actions = array();
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."pegawai/riwayatjabatan/edit/".$PNS_ID."/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
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
    	Template::set('recsatker', $this->unitkerja_model->find_satker());
        if(empty($record_id)){
            $this->auth->restrict($this->permissionCreate);
            Template::set_view("kepegawaian/riwayat_jabatan_crud");
            
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Tambah Riwayat Jabatan");

            Template::render();
        }
        else {
            $this->auth->restrict($this->permissionEdit);
            Template::set_view("kepegawaian/riwayat_jabatan_crud");
            $datadetil = $this->riwayat_jabatan_model->find($record_id);
            Template::set('jabatans', $this->jabatan_model->find_select($datadetil->ID_JENIS_JABATAN));    
            Template::set('detail_riwayat', $datadetil);    
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Ubah Riwayat Jabatan");

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
        $this->form_validation->set_rules($this->riwayat_jabatan_model->get_validation_rules());
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
		
		if($this->input->post('IS_ACTIVE') == "1"){
			// update semua jadi inactive
			$dataupdate = array();
        	$dataupdate["IS_ACTIVE"] = '';
			$this->riwayat_jabatan_model->update_where("PNS_ID",$this->input->post("PNS_ID"), $dataupdate);
			// update jadi active yang terpilih
			$dataupdate = array();
			$rec_jenis = $this->jenis_jabatan_model->find($this->input->post("ID_JENIS_JABATAN"));
        	$dataupdate["JENIS_JABATAN_ID"] = $this->input->post("ID_JENIS_JABATAN");
			$dataupdate["JENIS_JABATAN_NAMA"] = $rec_jenis->NAMA;
			$dataupdate['JABATAN_INSTANSI_ID']	= $this->input->post('ID_JABATAN');
			$rec_jabatan = $this->jabatan_model->find_by("KODE_JABATAN",$this->input->post("ID_JABATAN"));
        	$dataupdate["JABATAN_INSTANSI_NAMA"] = $rec_jabatan->NAMA_JABATAN;
			$this->pegawai_model->update_where("PNS_ID",$this->input->post("PNS_ID"), $dataupdate);
			
			// update tabel unirkerja jika pilihan adalah pejabat struktural
			if($this->input->post("ID_JENIS_JABATAN") == "1"){
			 
			   $adata = array();
			   $this->pegawai_model->where("PNS_ID",$this->input->post("PNS_ID"));
			   $pegawai_data = $this->pegawai_model->find_first_row();  
			   $adata["NAMA_PEJABAT"] = $pegawai_data->NAMA;
			   $adata["PEMIMPIN_PNS_ID"] = trim($this->input->post("PNS_ID"));
			   $this->unitkerja_model->update_where("ID",TRIM($this->input->post("ID_UNOR")), $adata);
			   //die($this->input->post("ID_UNOR").$pegawai_data->NAMA."masuk");
			}
			// end
			
		}
        $data = $this->riwayat_jabatan_model->prep_data($this->input->post());
       
        $this->pegawai_model->where("PNS_ID",$this->input->post("PNS_ID"));
        $pegawai_data = $this->pegawai_model->find_first_row();  
        $data["PNS_NIP"] = $pegawai_data->NIP_BARU;
        $data["PNS_ID"] = $pegawai_data->PNS_ID;
        $data["PNS_NAMA"] = $pegawai_data->NAMA;
        
        $rec_jenis = $this->jenis_jabatan_model->find($this->input->post("ID_JENIS_JABATAN"));
        $data["ID_JENIS_JABATAN"] = $rec_jenis->ID;
        
        $rec_jabatan = $this->jabatan_model->find_by("KODE_JABATAN",$this->input->post("ID_JABATAN"));
        $data["NAMA_JABATAN"] = $rec_jabatan->NAMA_JABATAN;
		
        if(empty($data["TMT_JABATAN"])){
            unset($data["TMT_JABATAN"]);
        }
        if(empty($data["TANGGAL_SK"])){
            unset($data["SK_TANGTANGGAL_SKGAL"]);
        }
        if(empty($data["TMT_PELANTIKAN"])){
            unset($data["TMT_PELANTIKAN"]);
        }
        $id_data = $this->input->post("ID");
        if(isset($id_data) && !empty($id_data)){
            $this->riwayat_jabatan_model->update($id_data,$data);
        }
        else $this->riwayat_jabatan_model->insert($data);
        $response ['success']= true;
        $response ['msg']= "berhasil";
        echo json_encode($response);    

    }
    public function delete($record_id){
        $this->auth->restrict($this->permissionDelete);
		if ($this->riwayat_jabatan_model->delete($record_id)) {
			 log_activity($this->auth->user_id(), 'delete data Riwayat Jabatan : ' . $record_id . ' : ' . $this->input->ip_address(), 'pegawai');
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
