<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * reports controller
 */
class reports extends Admin_Controller
{

	//--------------------------------------------------------------------
	public $UNOR_ID = null;
	protected $CI;
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->CI = &get_instance();
		$this->lang->load('dashboard');
		Template::set_block('sub_nav', 'reports/_sub_nav');
		Assets::add_module_js('dashboard', 'dashboard.js');
		$this->load->model('pegawai/unitkerja_model');
		$this->load->model('pegawai/pegawai_model', null, true);

		//CEK DARI INPUTAN FILTER UNOR
		$unit_id = $this->input->get("unit_id");
		if($unit_id){
			$satker = $this->unitkerja_model->find_by_id($unit_id);
			
			$nama_unor = array();
			$this->UNOR_ID= $satker->ID;
			
			Template::set('selectedSatker', $satker);
			
		}
		//Jika ada role executive ?
		if($this->CI->auth->role_id() =="5"){
			//???
			$this->UNOR_ID = $this->pegawai_model->getunor_id($this->CI->auth->username());
		}
		if($this->auth->role_id() =="6"){
			$this->UNOR_ID = $this->pegawai_model->getunor_induk($this->auth->username());
		}
	}
	//--------------------------------------------------------------------
	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->auth->restrict('Dashboard.Reports.View');
		
		$recsatker = $this->unitkerja_model->count_satker($this->UNOR_ID);
		Template::set('jmlsatker', $recsatker[0]->jumlah ? $recsatker[0]->jumlah : 0);
		// jml pegawai
		$total= $this->pegawai_model->count_all($this->UNOR_ID);
		Template::set('totalpegawai', $total);
		$jmlpensiun = $this->pegawai_model->count_pensiun($this->UNOR_ID); 
		Template::set('jmlpensiun', $jmlpensiun);

		
		
		$jsonpendidikan = array();
		$recordpendidikan = $this->pegawai_model->grupbypendidikan($this->UNOR_ID); 
		$dataprov = array();
		if (isset($recordpendidikan) && is_array($recordpendidikan) && count($recordpendidikan)) :
			foreach ($recordpendidikan as $record) :
				if($record->NAMA_PENDIDIKAN != "")
					$dataprov["NAMA"] = $record->NAMA_PENDIDIKAN;
				else
					$dataprov["NAMA"] = "-";
				$dataprov["jumlah"] = $record->jumlah;
				$jsonpendidikan[] 	= $dataprov;
			endforeach;
		endif;
		Template::set('jsonpendidikan', json_encode($jsonpendidikan));
		
		$recordumur = $this->pegawai_model->group_by_range_umur($this->UNOR_ID);
		
		$colors=    array('#FCD202', '#B0DE09','#FF6600', '#0D8ECF', '#2A0CD0', '#CD0D74', '#CC0000', '#00CC00', '#0000CC', '#DDDDDD', '#999999', '#333333', '#990000');
		$ajsonumur = array();
		$index = 0 ;
		foreach(array_keys($recordumur[0]) as $key){
			$jsonumur = array("color"=>$colors[$index],"label"=>$key,"jumlah"=>isset($recordumur[0][$key]) ? $recordumur[0][$key] : 0);
			$ajsonumur[] 	= $jsonumur;
			$index++;
		}
		
		Template::set('jsonumur', json_encode($ajsonumur));
		
		// agama
		$agamas = $this->pegawai_model->find_grupagama($this->UNOR_ID);
		Template::set('agamas', $agamas);
		
		// jenis kelamin
		$jks = $this->pegawai_model->grupbyjk($this->UNOR_ID);
		$jsonjk = array();
		$datajk = array();
		if (isset($jks) && is_array($jks) && count($jks)) :
			foreach ($jks as $record) :
				if($record->JENIS_KELAMIN != "")
					$datajk["Jenis_Kelamin"] = $record->JENIS_KELAMIN;
				else
					$datajk["Jenis_Kelamin"] = "Belum ditentukan";
				$datajk["jumlah"] = $record->jumlah;
				$jsonjk[] 	= $datajk;
			endforeach;
		endif;
		Template::set('jsonjk', json_encode($jsonjk));
		// pensiun pertahun
		// belum di kasih filter buat role executive
		$pensiuntahun = $this->pegawai_model->stats_pensiun_pertahun($this->UNOR_ID);
		
		$index = 0;
		foreach($pensiuntahun as &$row){
			$row['color'] = $colors[$index];
			$index++;
		}
		Template::set('jsonpensiuntahun', json_encode($pensiuntahun));
		
		// rekap_pangkat_golongan
		$data_jumlah_pegawai_per_golongan = $this->pegawai_model->get_jumlah_pegawai_per_golongan($this->UNOR_ID);
		
		$index = 0;
		foreach($data_jumlah_pegawai_per_golongan as &$row){
			$row['color'] = $colors[$index];
			$index++;
		}
		Template::set('data_jumlah_pegawai_per_golongan', json_encode($data_jumlah_pegawai_per_golongan));
		
		

		$action = $this->input->get("action");
		if($action=="download"){
			$data = $this->input->get("data");
			if($data =='golongan'){
				$o = json_decode(Template::get('data_jumlah_pegawai_per_golongan'));
				$this->load->library('Excel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel = PHPExcel_IOFactory::load(FCPATH.DIRECTORY_SEPARATOR.'/templates/template_data_dashboard_golongan.xlsx');

				$objPHPExcel->setActiveSheetIndex(0);
				$start_row = 5;
				foreach($o as $row){
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$start_row, $row->nama);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$start_row, $row->total);
					$start_row++;			
				}
				$filename = 'DASHBOARD_GOLONGAN';
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0');

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
				//$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
				$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
				exit; //done.. exiting!

			}
			else if($data =='proyeksi_pensiun'){
				$o = json_decode(Template::get('jsonpensiuntahun'));
				$this->load->library('Excel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel = PHPExcel_IOFactory::load(FCPATH.DIRECTORY_SEPARATOR.'/templates/template_data_dashboard_proyeksi_pensiun.xlsx');

				$objPHPExcel->setActiveSheetIndex(0);
				$start_row = 5;
				foreach($o as $row){
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$start_row, $row->tahun);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$start_row, $row->jumlah);
					$start_row++;			
				}
				$filename = 'DASHBOARD_PROYEKSI_PENSIUN';
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0');

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
				//$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
				$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
				exit; //done.. exiting!
			}
			else if($data =='pendidikan'){				
				$o = json_decode(Template::get('jsonpendidikan'));
				$this->load->library('Excel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel = PHPExcel_IOFactory::load(FCPATH.DIRECTORY_SEPARATOR.'/templates/template_data_dashboard_pendidikan.xlsx');

				$objPHPExcel->setActiveSheetIndex(0);
				$start_row = 5;
				foreach($o as $row){
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$start_row, $row->NAMA);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$start_row, $row->jumlah);
					$start_row++;			
				}
				$filename = 'DASHBOARD_PENDIDIKAN';
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0');

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
				//$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
				$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
				exit; //done.. exiting!
			}
			else if($data =='agama'){
				$o = Template::get('agamas');
				$this->load->library('Excel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel = PHPExcel_IOFactory::load(FCPATH.DIRECTORY_SEPARATOR.'/templates/template_data_dashboard_agama.xlsx');

				$objPHPExcel->setActiveSheetIndex(0);
				$start_row = 5;
				foreach($o as $row){
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$start_row, $row->label);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$start_row, $row->value);
					$start_row++;			
				}
				$filename = 'DASHBOARD_AGAMA';
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0');

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
				//$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
				$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
				exit; //done.. exiting!
			}
			else if($data =='umur'){
				
				$o = json_decode(Template::get('jsonumur'));
				$this->load->library('Excel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel = PHPExcel_IOFactory::load(FCPATH.DIRECTORY_SEPARATOR.'/templates/template_data_dashboard_umur.xlsx');

				$objPHPExcel->setActiveSheetIndex(0);
				$start_row = 5;
				foreach($o as $row){
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$start_row, $row->label);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$start_row, $row->jumlah);
					$start_row++;			
				}
				$filename = 'DASHBOARD_UMUR';
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0');

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
				//$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
				$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
				exit; //done.. exiting!
			}
			else if($data =='jenis_kelamin'){
				$o = json_decode(Template::get('jsonjk'));
				$this->load->library('Excel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel = PHPExcel_IOFactory::load(FCPATH.DIRECTORY_SEPARATOR.'/templates/template_data_dashboard_jenis_kelamin.xlsx');

				$objPHPExcel->setActiveSheetIndex(0);
				$start_row = 5;
				foreach($o as $row){
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$start_row, $row->Jenis_Kelamin);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$start_row, $row->jumlah);
					$start_row++;			
				}
				$filename = 'DASHBOARD_JENISKELAMIN';
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0');

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
				//$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
				$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
				exit; //done.. exiting!
			}
			return;
		}
		Template::render();
	}
	 
}