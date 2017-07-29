<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class MasterPendidikan extends Admin_Controller
{
    protected $permissionCreate = 'MasterPendidikan.Kepegawaian.Create';
    protected $permissionDelete = 'MasterPendidikan.Kepegawaian.Delete';
    protected $permissionEdit   = 'MasterPendidikan.Kepegawaian.Edit';
    protected $permissionView   = 'MasterPendidikan.Kepegawaian.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pegawai/pendidikan_model');
        $this->load->model('pegawai/tingkatpendidikan_model');
        
        $tk_pendididikan_all = $this->tingkatpendidikan_model->find_all();
		Template::set('tk_pendididikan_all', $tk_pendididikan_all);
		
		
    }
    public function ajax_list(){
        
        $draw = $this->input->post('draw');
		$iSortCol = $this->input->post('iSortCol_1');
		$sSortCol = $this->input->post('sSortDir_1');
		
		$length= $this->input->post('length');
		$start= $this->input->post('start');

		$search = isset($_REQUEST['search']["value"]) ? $_REQUEST['search']["value"] : "";
		
		//$this->ref_jabatan_model->where("deleted ",null);
		$total= $this->pendidikan_model->count_all();;
		$output=array();
		$output['draw']=$draw;

		
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();


		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->pendidikan_model->where('upper("NAMA") LIKE \'%'.strtoupper($search).'%\'');
			$this->pendidikan_model->or_where('upper("JENIS_JABATAN") LIKE \'%'.strtoupper($search).'%\'');
		}
		$this->pendidikan_model->limit($length,$start);
		
		$kolom = $iSortCol != "" ? $iSortCol : "NAMA";
		$sSortCol == "asc" ? "asc" : "desc";
		$this->pendidikan_model->order_by($iSortCol,$sSortCol);
		$records=$this->pendidikan_model->find_all();

		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->pendidikan_model->where('upper("NAMA") LIKE \'%'.strtoupper($search).'%\'');
			$this->pendidikan_model->or_where('upper("JENIS_JABATAN") LIKE \'%'.strtoupper($search).'%\'');
			$jum	= $this->pendidikan_model->count_all();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}
		
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                $row []  = $record->TK_TEXT;
                $row []  = $record->NAMA;
                $btn_actions = array();
                $btn_actions  [] = "
                    <a href='".base_url()."pegawai/masterpendidikan/edit/".$record->ID."'  data-toggle='tooltip' title='Ubah Data'><span class='fa-stack'>
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
    public function index(){
        Template::set('PNS_ID', $PNS_ID);
        Template::set('TAB_ID', uniqid("TAB_CONTOH"));
        Template::render();
    }
	/**
     * Create a Agama object.
     *
     * @return void
     */
    public function create()
    {
		//$this->auth->restrict($this->permissionCreate); 
		Template::set('toolbar_title', "Tambah Jurusan Pendidikan");

		Template::render();
    }
	public function edit($ID)
    {
		//$this->auth->restrict($this->permissionCreate); 
		Template::set('toolbar_title', "Ubah Jurusan Pendidikan");

		Template::render();
    }
	public function save(){
         // Validate the data
        $this->form_validation->set_rules($this->pendidikan_model->get_validation_rules());
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

        $data = $this->pendidikan_model->prep_data($this->input->post());
       
		$id_data = $this->INPUT->POST("ID");
        if(isset($id_data) && !empty($id_data)){
            $this->diklat_struktural_model->update($id_data,$data);
        }
        else $this->diklat_struktural_model->insert($data);
        $response ['success']= true;
        $response ['msg']= "Transaksi berhasil";
        echo json_encode($response);    

    }
}
