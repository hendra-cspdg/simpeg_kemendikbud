<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class Riwayatpindahunitkerja extends Admin_Controller
{
    protected $permissionCreate = 'RiwayatPindahUnitKerja.Kepegawaian.Create';
    protected $permissionDelete = 'RiwayatPindahUnitKerja.Kepegawaian.Delete';
    protected $permissionEdit   = 'RiwayatPindahUnitKerja.Kepegawaian.Edit';
    protected $permissionView   = 'RiwayatPindahUnitKerja.Kepegawaian.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pegawai/riwayat_pindah_unit_kerja_model');
        $this->load->model('pegawai/jenis_kp_model');
        $this->load->model('pegawai/pegawai_model');
        $this->load->model('pegawai/instansi_model');
        $this->load->model('pegawai/unit_organisasi_model');
    }
    public function get_unor_ajax(){
        $json = array();
        $limit = 10;
        $page = $this->input->get('page') ? $this->input->get('page') : "1";
        $q= $this->input->get('term');
        $start = ($page-1)*$limit;
        
        if(!empty($q)){
            $this->db->start_cache();
            $this->db->like('lower("NAMA")', strtolower($key));
            $this->db->from("hris.unit_organisasi");
            $this->db->stop_cache();
            $total = $this->db->get()->num_rows();
            $this->db->select('ID as id,NAMA as text');
            $this->db->limit($limit,$start);

            $data = $this->db->get()->result();

            $endCount = $start + $limit;
            $morePages = $endCount > $total;
            $o = array(
            "results" => $data,
                "pagination" => array(
                    "more" =>$morePages,
                    "totalx"=>$total,
                    "startx"=>$start,
                    "limitx"=>$limit
                )
            );   
            $this->db->flush_cache();
            $json = $o;
        }
            echo json_encode($json);
    }
    public function get_instansi_ajax(){
        $json = array();
        $limit = 10;
        $page = $this->input->get('page') ? $this->input->get('page') : "1";
        $q= $this->input->get('term');
        $start = ($page-1)*$limit;
        
        if(!empty($q)){
            $this->db->start_cache();
            $this->db->like('lower("NAMA")', strtolower($key));
            $this->db->from("hris.instansi");
            $this->db->stop_cache();
            $total = $this->db->get()->num_rows();
            $this->db->select('ID as id,NAMA as text');
            $this->db->limit($limit,$start);

            $data = $this->db->get()->result();

            $endCount = $start + $limit;
            $morePages = $endCount > $total;
            $o = array(
            "results" => $data,
                "pagination" => array(
                    "more" =>$morePages,
                    "totalx"=>$total,
                    "startx"=>$start,
                    "limitx"=>$limit
                )
            );   
            $this->db->flush_cache();
            $json = $o;
        }
            echo json_encode($json);
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
		$this->riwayat_pindah_unit_kerja_model->where("ID_PNS",$pegawai_data->ID);
		$total= $this->riwayat_pindah_unit_kerja_model->count_all();;
		$output=array();
		$output['draw']=$draw;

		
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();
        
		
        
		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->riwayat_pindah_unit_kerja_model->where('upper("NAMA_UNOR_BARU") LIKE \''.strtoupper($search).'%\'');
		}
		$this->riwayat_pindah_unit_kerja_model->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
        
		$kolom = $iSortCol != "" ? $iSortCol : "Nama";
		$sSortCol == "asc" ? "asc" : "desc";
		$this->riwayat_pindah_unit_kerja_model->order_by($iSortCol,$sSortCol);
        
        $this->riwayat_pindah_unit_kerja_model->where("ID_PNS",$pegawai_data->PNS_ID);  
		
        $records=$this->riwayat_pindah_unit_kerja_model->find_all();
            
		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->riwayat_pindah_unit_kerja_model->where('upper("NAMA_UNOR_BARU") LIKE \''.strtoupper($search).'%\'');
			$jum	= $this->riwayat_pindah_unit_kerja_model->count_all();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}
		
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                $row []  = $record->NAMA_UNOR_BARU;
                $row []  = $record->NAMA_INSTANSI;
                $row []  = $record->SK_NOMOR;
                $row []  = $record->SK_TANGGAL;

                $btn_actions = array();
                $btn_actions  [] = "
                    <a class='show-modal-custom' href='".base_url()."pegawai/riwayatpindahunitkerja/edit/".$PNS_ID."/".$record->ID."'  data-toggle='modal' title='Ubah Data'><span class='fa-stack'>
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
        
        Template::set('jenis_kps', $this->jenis_kp_model->find_all());
        Template::set('unit_organisasis', $this->unit_organisasi_model->find_all());
      
        if(empty($record_id)){
            $this->auth->restrict($this->permissionCreate);
            Template::set_view("kepegawaian/riwayat_pindah_unit_kerja_crud");
            
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Tambah Riwayat Pindah Unit Kerja");

            Template::render();
        }
        else {
            $this->auth->restrict($this->permissionEdit);
           
            Template::set_view("kepegawaian/riwayat_pindah_unit_kerja_crud");
            $detailRiwayat = $this->riwayat_pindah_unit_kerja_model->find($record_id);
            
            Template::set('detail_riwayat',$detailRiwayat );    
            Template::set('selectedUnorBaru',$this->unit_organisasi_model->find($detailRiwayat->ID_UNOR_BARU));
            Template::set('selectedInstansiBaru',$this->instansi_model->find($detailRiwayat->ID_INSTANSI));
            Template::set('PNS_ID', $PNS_ID);
            Template::set('toolbar_title', "Ubah Riwayat Pindah Unit Kerja");

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
        $this->form_validation->set_rules($this->riwayat_pindah_unit_kerja_model->get_validation_rules());
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

        $data = $this->riwayat_pindah_unit_kerja_model->prep_data($this->input->post());
       
        $this->pegawai_model->where("PNS_ID",$this->input->post("PNS_ID"));
        $pegawai_data = $this->pegawai_model->find_first_row();  
        $data["ID_PNS"] = $pegawai_data->PNS_ID;
        $data["NAMA_PNS"] = $pegawai_data->NAMA;
        $data["NIP_PNS"] = $pegawai_data->NIP_BARU;
       
        $unor_baru_data = $this->unit_organisasi_model->find($data['ID_UNOR_BARU']);
        $data["NAMA_UNOR_BARU"] = $unor_baru_data->NAMA;
        
        $instansi_baru_data = $this->instansi_model->find($data['ID_INSTANSI']);
        $data["NAMA_INSTANSI"] = $instansi_baru_data->NAMA;


        if(empty($data["SK_TANGGAL"])){
            unset($data["SK_TANGGAL"]);
        }
        $id_data = $this->input->post("ID");
        if(isset($id_data) && !empty($id_data)){
            $this->riwayat_pindah_unit_kerja_model->update($id_data,$data);
        }
        else $this->riwayat_pindah_unit_kerja_model->insert($data);
        $response ['success']= true;
        $response ['msg']= "Transaksi berhasil";
        echo json_encode($response);    

    }
    public function delete($record_id){
        $this->auth->restrict($this->permissionDelete);
		if ($this->riwayat_pindah_unit_kerja_model->delete($record_id)) {
			 log_activity($this->auth->user_id(), 'delete data Riwayat Diklat Kepangkatan : ' . $record_id . ' : ' . $this->input->ip_address(), 'pegawai');
			 Template::set_message("Sukses Hapus data", 'success');
			 echo "Sukses";
		}else{
			echo "Gagal";
		}

		exit();
    }
    public function index($PNS_ID='1552260645'){
        Template::set_view("kepegawaian/tab_pane_riwayat_pindah_unit_kerja");
        Template::set('PNS_ID', $PNS_ID);
        Template::set('TAB_ID', uniqid("TAB_CONTOH"));
        Template::render();
    }
}
