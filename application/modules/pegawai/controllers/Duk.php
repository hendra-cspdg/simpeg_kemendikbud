<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class Duk extends Admin_Controller
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
        $this->load->model('pegawai/pegawai_model');
    }
    public function ajax_list(){
        $draw= $this->input->post('draw');
		$length= $this->input->post('length');
		$start= $this->input->post('start');
		$unit_id = $this->input->post('unit_id');
		$o = $this->pegawai_model->get_duk_list($unit_id,$start,$length);
		
		$nomor_urut=$start+1;
		$records = array();
		foreach ($o->data as $record) {
			$row = array();
			$nama_full = array();
			if($record->GELAR_DEPAN)$nama_full[] = $record->GELAR_DEPAN;
			$nama_full[] = $record->NAMA;
			$temp = implode(" ",$nama_full);
			$nama_full = array();
			$nama_full[] = $temp;
			if($record->GELAR_BELAKANG)$nama_full[] = $record->GELAR_BELAKANG;
			$temp = implode(", ",$nama_full);
			$usia_tahun = (int)($record->bulan_usia/12);
			$usia_bulan = (int)$record->bulan_usia%12;
			$row[]  = $nomor_urut;			
			$row[] = $temp;
			$row[] = $record->golongan_text;
			$row[] = $record->JABATAN_NAMA;
			$row[] = $record->MK_TAHUN." Thn ".$record->MK_BLN." Bln";
			$row[] = $record->TMT_CPNS;
			$row[] = $record->TMT_GOLONGAN;
			$row[] = $record->PENDIDIKAN;
			$row[] = $usia_tahun." Thn ".$usia_bulan." Bln";
			$row[] = $record->NAMA_UNOR;
			
			$records[] = $row;
			$nomor_urut++;
		}
	
		$output = array(
			'draw'=>$draw,
			'recordsFiltered'=>$o->total,
			'recordsTotal'=>$o->total,
			'data'=>$records
		);
		echo json_encode($output);
		die();
    }
    
    public function index(){
        Template::render();
    }
	public function cetak($unit_id){
		$o = $this->pegawai_model->get_duk_list($unit_id,0,null);
		$index=1;
		foreach($o->data as $record){
			echo $index."#".$record->NAMA." ".$record->TMT_GOLONGAN."<BR>";
			$index++;
		}
	}
	public function ajax_unit_list(){
		$length = 10;
		$term = $this->input->get('term');
		$page = $this->input->get('page');
		$this->db->flush_cache();
		$data = $this->db->query("
			select 
			uk.*,
			parent.\"NAMA_UNOR\" as parent_name,
			grand.\"NAMA_UNOR\" as grand_name
			from 
			hris.unitkerja uk
			left join hris.unitkerja parent on parent.\"ID\" = uk.\"PARENT_ID\"
			left join hris.unitkerja grand on grand.\"ID\" = parent.\"PARENT_ID\"
			where lower(uk.\"NAMA_UNOR\") like ?
			",array("%".strtolower($term)."%"))->result();
		
		$output = array();
		$output['results'] = array();
		foreach($data as $row){
			$nama_unor = array();
			if($row->grand_name){
				$nama_unor[] = $row->grand_name;
			}
			if($row->parent_name){
				$nama_unor[] = $row->parent_name;
			}
			if($row->NAMA_UNOR){
				$nama_unor[] = $row->NAMA_UNOR;
			}
			$output['results'] [] = array(
				'id'=>$row->ID_BKN,
				'text'=>implode(" - ",$nama_unor)
			);
		}
		$output['pagination'] = array("more"=>false);
		
		echo json_encode($output);
	}
}
