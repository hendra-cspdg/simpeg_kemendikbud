<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * reports controller
 */
class reports extends Admin_Controller
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
		
		$this->auth->restrict('Dashboard.Reports.View');
		$this->load->model('pegawai/pegawai_model', null, true);
		$this->load->model('golongan/golongan_model', null, true);
		//pangkat
		$jsonpangkat = array();
		$recordpangkat = $this->golongan_model->grupbygolongan(); 
		$dataprov = array();
		if (isset($recordpangkat) && is_array($recordpangkat) && count($recordpangkat)) :
			foreach ($recordpangkat as $record) :
				if($record->NAMA != "")
					$dataprov["NAMA"] = $record->NAMA;
				else
					$dataprov["NAMA"] = "Belum ditentukan";
				$dataprov["jumlah"] = $record->jumlah;
				$jsonpangkat[] 	= $dataprov;
			endforeach;
		endif;
		Template::set('jsonpangkat', json_encode($jsonpangkat));
		// agama
		$agamas = $this->pegawai_model->find_grupagama();
		Template::set('agamas', $agamas);
		// jenis kelamin
		$jks = $this->pegawai_model->grupbyjk();
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
		
		Template::render();
	}
	 
	public function userdash()
	{
		$this->auth->restrict('Dashboard.Reports.Viewuser');
		$this->load->model('sppd_jabodetabek/propinsi_model', null, true);
		$this->load->model('sppd_jabodetabek/sppd_jabodetabek_model', null, true);
		$this->load->model('e_realisasi/sasd_item_model', null, true);
		
		$nip = $this->current_user->nip;
		//die($nip);
		$propinsis = $this->sppd_jabodetabek_model->rekap_provinsi();
		Template::set('propinsis', $propinsis);
		
		$recspd = $this->sppd_jabodetabek_model->rekap_tahun(date("Y"));
		$adatasppd[] = array();
		if (isset($recspd) && is_array($recspd) && count($recspd)):
			foreach($recspd as $rec):
				$adatasppd[$rec->provinsi."-".$rec->pegawai] = $rec->jumlah;
			endforeach;
		endif;
		Template::set('adatasppd', $adatasppd);
		
		$pegawais = $this->sppd_jabodetabek_model->dispegawai(date("Y"));
		Template::set('pegawais', $pegawais);
		
		$jmlperjalanan = $this->sppd_jabodetabek_model->count_tahun_pegawai(date("Y"),$nip);
		Template::set('jmlperjalanan', $jmlperjalanan);
		
		$count_blmspj = $this->sppd_jabodetabek_model->count_blmspj_pegawai(date("Y"),$nip);
		Template::set('count_blmspj', $count_blmspj);
		
		$count_blmlaporan = $this->sppd_jabodetabek_model->count_blmlaporan_pegawai(date("Y"),$nip);
		Template::set('count_blmlaporan', $count_blmlaporan);
		
		$sumrealisasi_tahun = $this->sppd_jabodetabek_model->sumrealisasi_tahun(date("Y"));
		$jmlrealisasiperjalanan = isset($sumrealisasi_tahun[0]->jmlrealisasi) ? $sumrealisasi_tahun[0]->jmlrealisasi : "";
		Template::set('sumrealisasi_tahun', $jmlrealisasiperjalanan);
		
		$jmlpaguperjalanan = $this->sasd_item_model->sum_akun("524111",date("Y"));
		$jumlah_pagu = isset($jmlpaguperjalanan[0]->jumlah_pagu) ? $jmlpaguperjalanan[0]->jumlah_pagu : 0;
		$persentase = 0;
		if($jmlrealisasiperjalanan != "" and $jumlah_pagu !="0")
			$persentase = ($jmlrealisasiperjalanan/$jumlah_pagu)*100;
		
		
		Template::set('jumlah_pagu', round($jumlah_pagu,2));
		Template::set('jmlrealisasiperjalanan', round($jmlrealisasiperjalanan,2));
		Template::set('persentase', round($persentase,2));

		$sumrealisasi_tahun = $this->sppd_jabodetabek_model->perjalananperbulan_pegawai(date("Y"),$nip);
		//Template::set('sumrealisasi_tahun', $sumrealisasi_tahun);
		$adatasppdbulan = array();
		for($i=1;$i<13;$i++){
			$adatasppdbulan[$i] = 0;
		}
		if (isset($sumrealisasi_tahun) && is_array($sumrealisasi_tahun) && count($sumrealisasi_tahun)):
			foreach($sumrealisasi_tahun as $rec):
				$adatasppdbulan[$rec->month] = $rec->jumlah;
			endforeach;
		endif;
		$nilai = "[".$adatasppdbulan[1].",".$adatasppdbulan[2].",".$adatasppdbulan[3].",".$adatasppdbulan[4].",".$adatasppdbulan[5].",".$adatasppdbulan[6].",".$adatasppdbulan[7].",".$adatasppdbulan[8].",".$adatasppdbulan[9].",".$adatasppdbulan[10].",".$adatasppdbulan[11].",".$adatasppdbulan[12]."]";
		//die();
		Template::set('adatasppdbulan', $nilai);
		
		Template::render();
	}
	public function realisasi()
	{
	
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date("Y");
		$this->load->model('e_realisasi/sasd_item_model', null, true);
		 
		// pagu kegiatan
		$this->load->model('e_realisasi/kegiatan_model', null, true);
		$masterkegiatan = $this->kegiatan_model->getdistinctkegiatan("","","",$tahun);
		Template::set('masterkegiatan', $masterkegiatan);
		
		$this->load->model('e_realisasi/rkakl_model', null, true);
		$rekappermak = $this->rkakl_model->rekappermakkegiatan($tahun);
		$datapagu 		= array(); 
		//print_r($rekappermak);
		$no = 1;
		if (isset($rekappermak) && is_array($rekappermak) && count($rekappermak)) :
			foreach ($rekappermak as $record) :
					$datapagu[trim($record->kdgiat)."-".trim($record->kdoutput)."-".trim($record->kdsoutput)] = $record->pagu;
				$no++;
			endforeach;
		endif;
		Template::set('datapagu', $datapagu);
		
		$this->load->model('e_realisasi/Sasdd_spmmak_model', null, true);
		$this->load->model('e_realisasi/Sasmm_spmmak_model', null, true);
		
		$realisasils = $this->Sasmm_spmmak_model->getrealisasilsperkegiatan($tahun);
		$datarealisasilskegiatan		= array(); 
		$datarealisasikegiatan		= array();
		if (isset($realisasils) && is_array($realisasils) && count($realisasils)) :
			foreach ($realisasils as $record) :
				//echo trim($record->kdgiat)."-".trim($record->kdoutput)."-".trim($record->kdsoutput) . " = ".$record->jumlah."<br>";
				$datarealisasilskegiatan[trim($record->kdgiat)."-".trim($record->kdoutput)."-".trim($record->kdsoutput)] = $record->jumlah;
				$datarealisasikegiatan[trim($record->kdgiat)."-".trim($record->kdoutput)."-".trim($record->kdsoutput)] = $record->jumlah;
			endforeach;
		endif;
		//die();
		$realisasispm =  $this->Sasdd_spmmak_model->getrealisasikegiatan($tahun);
		
		if (isset($realisasispm) && is_array($realisasispm) && count($realisasispm)) :
			foreach ($realisasispm as $record) :
				if(isset($datarealisasilskegiatan[trim($record->kdgiat)."-".trim($record->kdoutput)."-".trim($record->kdsoutput)]))
				{
					//echo trim($record->kdgiat)."-".trim($record->kdoutput)."-".trim($record->kdsoutput) . " = ".$record->jumlah."<br>";
					$datarealisasikegiatan[trim($record->kdgiat)."-".trim($record->kdoutput)."-".trim($record->kdsoutput)]  = (double)$datarealisasilskegiatan[trim($record->kdgiat)."-".trim($record->kdoutput)."-".trim($record->kdsoutput)] + $record->jumlah;
				}else{
					$datarealisasikegiatan[trim($record->kdgiat)."-".trim($record->kdoutput)."-".trim($record->kdsoutput)] = $record->jumlah;
				}
			endforeach;
		endif;
		Template::set('datarealisasikegiatan', $datarealisasikegiatan);
		
		$this->load->model('e_realisasi/Sasdd_spmmak_model', null, true);
		$realisasispm =  $this->Sasdd_spmmak_model->getrealisasiperbulanall($tahun);
	//	print_r($realisasispm);
	//	die();
		// data realisasi yang sebelumnya dari drp sekarang dari SPM
		$datarealisasi 			= array(); 
		$datarealisasils		= array(); 
		
		for($i=1;$i<13;$i++){
			$datarealisasi[$i] = 0;
		}
		
		$jumlah = 0;
		if (isset($realisasispm) && is_array($realisasispm) && count($realisasispm)) :
			foreach ($realisasispm as $record) :
				$datarealisasi[trim($record->month)] = $record->jumlah;
			endforeach;
		endif;
		
		$this->load->model('e_realisasi/Sasmm_spmmak_model', null, true);
		$realisasils =  $this->Sasmm_spmmak_model->getrealisasiperbulanall($tahun);
		if (isset($realisasils) && is_array($realisasils) && count($realisasils)) :
			foreach ($realisasils as $record) :
				$datarealisasi[trim($record->month)] = $datarealisasi[trim($record->month)] + $record->jumlah; 
			endforeach;
		endif;
		
		$nilai = "[".$datarealisasi[1].",".$datarealisasi[2].",".$datarealisasi[3].",".$datarealisasi[4].",".$datarealisasi[5].",".$datarealisasi[6].",".$datarealisasi[7].",".$datarealisasi[8].",".$datarealisasi[9].",".$datarealisasi[10].",".$datarealisasi[11].",".$datarealisasi[12]."]";
		Template::set('datarealisasiperbulan', $nilai);
		
		// pagu per akun
		// akun 51 belanja pegawai
			$rekappermak = $this->rkakl_model->rekapperkdakun($tahun,"51");
			$jmlmak51 = isset($rekappermak[0]->pagu) ? $rekappermak[0]->pagu : 0;
			Template::set('jmlmak51', $jmlmak51);
			
		// akun 52
			$rekappermak = $this->rkakl_model->rekapperkdakun($tahun,"52");
			$jmlmak52 = isset($rekappermak[0]->pagu) ? $rekappermak[0]->pagu : 0;
			Template::set('jmlmak52', $jmlmak52);
		// akun 53
			$rekappermak = $this->rkakl_model->rekapperkdakun($tahun,"53");
			$jmlmak53 = isset($rekappermak[0]->pagu) ? $rekappermak[0]->pagu : 0;
			Template::set('jmlmak53', $jmlmak53);
		// realisasi per akun
		// akun 51
			$real = $this->Sasdd_spmmak_model->rekapperkdakun($tahun,"51");
			$realmak51 = isset($real[0]->jumlah) ? $real[0]->jumlah : 0;
		// akun 52
			$real = $this->Sasdd_spmmak_model->rekapperkdakun($tahun,"52");
			$realmak52 = isset($real[0]->jumlah) ? $real[0]->jumlah : 0;
		// akun 53
			$real = $this->Sasdd_spmmak_model->rekapperkdakun($tahun,"53");
			$realmak53 = isset($real[0]->jumlah) ? $real[0]->jumlah : 0;
			
		// akun 51 mm spm
			$real = $this->Sasmm_spmmak_model->rekapperkdakun($tahun,"51");
			$realmak51 = isset($real[0]->jumlah) ? $realmak51 + (double)$real[0]->jumlah : $realmak51;
			Template::set('realmak51', $realmak51);
		// akun 52
			$real = $this->Sasmm_spmmak_model->rekapperkdakun($tahun,"52");
			$realmak52 = isset($real[0]->jumlah) ? $realmak52 + (double)$real[0]->jumlah : $realmak52;
			Template::set('realmak52', $realmak52);
		// akun 53
			$real = $this->Sasmm_spmmak_model->rekapperkdakun($tahun,"53");
			$realmak53 = isset($real[0]->jumlah) ? $realmak53 + (double)$real[0]->jumlah : $realmak53;
			Template::set('realmak53', $realmak53);
			
		Template::set('toolbar_title', 'Realisasi Keuangan');
		Template::render();
	}

	//--------------------------------------------------------------------



}