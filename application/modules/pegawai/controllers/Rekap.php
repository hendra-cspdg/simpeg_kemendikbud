<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * reports controller
 */
class rekap extends Admin_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->lang->load('dashboard');
		Template::set_block('sub_nav', 'reports/_sub_nav');
		Assets::add_module_js('dashboard', 'dashboard.js');
	}
	//--------------------------------------------------------------------
	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$unit_id = $this->input->get("unit_id");
		$this->auth->restrict('Dashboard.Reports.View');
		$this->load->model('pegawai/pegawai_model', null, true);
		$this->load->model('golongan/golongan_model', null, true);
		$this->load->model('pegawai/unitkerja_model');
		
		$satker_id = null;
		if($unit_id){
			$this->unitkerja_model->where("ID",$unit_id);
			$satker = $this->unitkerja_model->find_first_row();
			$satker_id = $satker->ID;
			Template::set('selectedSatker', $satker);
		}
		
		$data_bup_per_range_umur = $this->pegawai_model->get_bup_per_range_umur($satker_id); 
		$index = 0;
		foreach($data_bup_per_range_umur as &$row){
			$row->color = $colors[$index];
			$index++;
		}
		Template::set('data_bup_per_range_umur', $data_bup_per_range_umur);
		

		$data_rekap_golongan_per_usia = $this->pegawai_model->get_rekap_golongan_per_usia($satker_id);
		Template::set('data_rekap_golongan_per_usia', $data_rekap_golongan_per_usia);

		$data_rekap_jenis_kelamin_per_usia = $this->pegawai_model->get_rekap_jenis_kelamin_per_usia($satker_id);
		Template::set('data_rekap_jenis_kelamin_per_usia', $data_rekap_jenis_kelamin_per_usia);
		
		$data_rekap_pendidikan_per_usia = $this->pegawai_model->get_rekap_pendidikan_per_usia($satker_id);
		Template::set('data_rekap_pendidikan_per_usia', $data_rekap_pendidikan_per_usia);

		$data_rekap_golongan_per_jenis_kelamin = $this->pegawai_model->get_rekap_golongan_per_jenis_kelamin($satker_id);
		Template::set('data_rekap_golongan_per_jenis_kelamin', $data_rekap_golongan_per_jenis_kelamin);

		$data_rekap_golongan_per_pendidikan = $this->pegawai_model->get_rekap_golongan_per_pendidikan($satker_id);
		Template::set('data_rekap_golongan_per_pendidikan', $data_rekap_golongan_per_pendidikan);
		
		$data_rekap_pendidikan_per_jenis_kelamin = $this->pegawai_model->get_rekap_pendidikan_per_jenis_kelamin($satker_id);
		Template::set('data_rekap_pendidikan_per_jenis_kelamin', $data_rekap_pendidikan_per_jenis_kelamin);

		$data_jumlah_pegawai_per_agama_jeniskelamin = $this->pegawai_model->get_jumlah_pegawai_per_agama_jeniskelamin($satker_id);
		Template::set('data_jumlah_pegawai_per_agama_jeniskelamin', $data_jumlah_pegawai_per_agama_jeniskelamin);

		Template::render();
	}
	 
}