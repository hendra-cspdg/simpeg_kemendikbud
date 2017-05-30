<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Masters controller
 */
class Masters extends Admin_Controller
{
    protected $permissionCreate = 'Unitkerja.Masters.Create';
    protected $permissionDelete = 'Unitkerja.Masters.Delete';
    protected $permissionEdit   = 'Unitkerja.Masters.Edit';
    protected $permissionView   = 'Unitkerja.Masters.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('agama/agama_model');
        $this->lang->load('agama');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'masters/_sub_nav');

        Assets::add_module_js('agama', 'agama.js');
    }

    /**
     * Display a list of Agama data.
     *
     * @return void
     */
   public function ajax(){
        $json = array();
        $limit = 10;
        $page = $this->input->get('page') ? $this->input->get('page') : "1";
        $q= $this->input->get('term');
        $start = ($page-1)*$limit;
		
		if(!empty($q)){
            $json = $this->data_model($q,$start,$limit);
		}
        echo json_encode($json);
    }
    public function ajaxall(){
        $json = array();
        $limit = 10;
        $page = $this->input->get('page') ? $this->input->get('page') : "1";
        $q= $this->input->get('term');
        $start = ($page-1)*$limit;
		
		if(!empty($q)){
            $json = $this->data_modelall($q,$start,$limit);
		}
        echo json_encode($json);
    }
	public function index(){
        die("masuk");
    }

    private function data_model($key,$start,$limit){
          
            $this->db->start_cache();
            $this->db->like('lower("NAMA_ESELON_II")', $key);
            $this->db->where('"ESELON" LIKE \'II.%\'');
            $this->db->from("hris.unitkerja");
            $this->db->stop_cache();
            $total = $this->db->get()->num_rows();
            $this->db->select('ID as id,NAMA_ESELON_II as text');
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
            return $o;
    }
    private function data_modelall($key,$start,$limit){
          
            $this->db->start_cache();
            $this->db->like('lower("NAMA_ESELON_IV")', $key);
            $this->db->from("hris.unitkerja");
            $this->db->stop_cache();
            $total = $this->db->get()->num_rows();
            $this->db->select('ID as id,CONCAT ("NAMA_ESELON_II",\' \',"NAMA_ESELON_III",\' \',"NAMA_ESELON_IV") as text');
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
                    "limitx"=>200
                )
            );   
            $this->db->flush_cache();
            return $o;
    }

    public function ajax_data(){
        $draw = $this->input->post('draw');
		$iSortCol = $this->input->post('iSortCol_1');
		$sSortCol = $this->input->post('sSortDir_1');
		
		$length= $this->input->post('length');
		$start= $this->input->post('start');

		$search = isset($_REQUEST['search']["value"]) ? $_REQUEST['search']["value"] : "";
		
		$this->agama_model->where("deleted ",null);
		$total= $this->agama_model->count_all();;
		$output=array();
		$output['draw']=$draw;

		
		$output['recordsTotal']= $output['recordsFiltered']=$total;
		$output['data']=array();


		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->agama_model->where('upper("NAMA") LIKE \''.strtoupper($search).'%\'');
		}
		$this->agama_model->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$kolom = $iSortCol != "" ? $iSortCol : "NAMA";
		$sSortCol == "asc" ? "asc" : "desc";
		$this->agama_model->order_by($iSortCol,$sSortCol);
        $this->agama_model->where("deleted ",null);
		$records=$this->agama_model->find_all();

		/*Ketika dalam mode pencarian, berarti kita harus
		'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != "")
		{
			$this->agama_model->where('upper("NAMA") LIKE \''.strtoupper($search).'%\'');
			$jum	= $this->agama_model->count_all();
			$output['recordsTotal']=$output['recordsFiltered']=$jum;
		}
		
		$nomor_urut=$start+1;
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) {
                $row = array();
                $row []  = $nomor_urut;
                $row []  = $record->NAMA;
                
                $btn_actions = array();
                $btn_actions  [] = "
                    <a href='".base_url()."admin/masters/agama/edit/".$record->ID."'  data-toggle='tooltip' title='Ubah Data'><span class='fa-stack'>
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
}