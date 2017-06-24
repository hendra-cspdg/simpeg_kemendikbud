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
	public function cetak($unit_id=null){
		
		$this->load->model("pegawai/unit_organisasi_model");
		if($unit_id == null || $unit_id == 'null'){
			$unor = $this->unit_organisasi_model->where("ID",2)->find_first_row();
			$unit_id = $unor->ID_BKN;
		}
		else {
			$unor = $this->unit_organisasi_model->where("ID_BKN",$unit_id)->find_first_row();
		}
		$satuan_kerja = "";
		if($unor){
			$satuan_kerja = $unor->NAMA_UNOR;
		}
		else {
			echo "unor tidak diketahui";
			die();
		}
		$this->load->library("tcpdf_lib");
		$pdf=  new DUK_Template($satuan_kerja,PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetMargins(5, 15, 5);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		$pdf->AddPage();
		$o = $this->pegawai_model->get_duk_list($unit_id,0,null);
		$index=1;
		
		//echo json_encode($o->data);
		$pdf->SetFont('times', 'R', 7);
		$html = <<<EOD
		<style type="text/css">
			table td {
				border : 0.1px solid black;	
			}
			table thead th {
				border : 0.1px solid black;	
			}
			table { page-break-inside:auto }
   			tr,td    { page-break-inside:avoid; page-break-after:auto }
           
		</style>
		<table  cellspacing=0 cellpadding="2">
			<thead>
				<tr class='header'>
					<td width="20">NO</td>
					<td width="100">PEGAWAI</td>
					<td width="40">TMT CPNS</td>
					<td width="100">JABATAN</td>
					<td width="40">GOL.</td>
					<td width="40">MASA KERJA</td>
					<td width="100">PENDIDIKAN</td>
					<td width="120">UNIT KERJA</td>
				</tr>
			</thead>
		<tbody>
EOD;
		$index = 1;
		foreach($o->data as $record){
			$html .= "<tr>";
				$html .= "<td style=\"text-align:center\" width=\"20\">"; 
						$html .= $index;
				$html .= "</td>";
				$html .= "<td width=\"100\">"; 
						$html .= $record->NIP_BARU; 
						$html .= "<br>".$record->NAMA;
				$html .= "</td>";
				$html .= "<td width=\"40\">"; 
						$html .= $record->TMT_CPNS; 
				$html .= "</td>";
				$html .= "<td width=\"100\">"; 
						$html .= $record->JABATAN_NAMA; 
						$html .= "<br>".$record->TMT_JABATAN; 
				$html .= "</td>";
				$html .= "<td width=\"40\">"; 
						$html .= $record->GOLONGAN; 
						$html .= "<br>".$record->TMT_GOLONGAN;
				$html .= "</td>";
				$html .= "<td width=\"40\">"; 
						$html .= $record->MK_TAHUN." T ".$record->MK_BULAN." B"; 
				$html .= "</td>";
				$html .= "<td  width=\"100\">"; 
						$html .= $record->PENDIDIKAN; 
				$html .= "</td>";
				$html .= "<td  width=\"120\">"; 
						$html .= $record->NAMA_UNOR; 
				$html .= "</td>";
			$html .= "</tr>";
			$index++;
		}
		$html .= "</tbody>";
		$html .= "</table>";

		//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
		$pdf->writeHTML($html, true, false, false, false, '');

		$pdf->Output('daftar_duk.pdf', 'I');
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
require_once(APPPATH.'libraries/tcpdf/tcpdf.php');
class DUK_Template extends TCPDF {
	public $unit_kerja = "AA";
	public function __construct($unit_kerja,$_PDF_PAGE_ORIENTATION, $_PDF_UNIT, $_PDF_PAGE_FORMAT, $_true, $_UTF, $_false){
		parent::__construct($_PDF_PAGE_ORIENTATION, $_PDF_UNIT, $_PDF_PAGE_FORMAT, $_true, $_UTF, $_false);
		$this->unit_kerja = strtoupper($unit_kerja);
	}
	public function Header() {
		$this->SetFont('times', 'BR', 8);
		$this->Cell(0, 2, 'DAFTAR URUTAN KEPANGKATAN', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln();
		$this->Cell(0, 2, $this->unit_kerja, 0, true, 'C', 0, '', 0, false, 'M', 'M');
	}
}