<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2014, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

/**
 * Home controller
 *
 * The base controller which displays the homepage of the Bonfire site.
 *
 * @package    Bonfire
 * @subpackage Controllers
 * @category   Controllers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Home extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('application');
		$this->load->library('Template');
		$this->load->library('Assets');
		$this->lang->load('application');
		$this->load->library('events');

        $this->load->library('installer_lib');
        if (! $this->installer_lib->is_installed()) {
            $ci =& get_instance();
            $ci->hooks->enabled = false;
            redirect('install');
        }

        // Make the requested page var available, since
        // we're not extending from a Bonfire controller
        // and it's not done for us.
        $this->requested_page = isset($_SESSION['requested_page']) ? $_SESSION['requested_page'] : null;
	}

	//--------------------------------------------------------------------

	/**
	 * Displays the homepage of the Bonfire app
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->library('users/auth');
		$this->set_current_user();

		Template::render();
	}//end index()
	public function cektwoday()
	{
		$this->load->library('users/auth');
		$this->set_current_user();
		
		$this->load->model('pegawai/pegawai_model', null, true);
		$this->load->model('sppd_jabodetabek/sppd_jabodetabek_model', null, true);
		$records = $this->sppd_jabodetabek_model->find_twoday();
		$has_records	= isset($records) && is_array($records) && count($records);
		if ($has_records) :
			foreach ($records as $record) :
				$pid = $record->id;
				
				$data_sppd = $this->sppd_jabodetabek_model->find_kegiatan($pid);
				$id_pegawai = isset($data_sppd->pegawai) ? $data_sppd->pegawai : "";
				$ppk = isset($data_sppd->ppk) ? $data_sppd->ppk : "";
				$datadetil = $this->pegawai_model->find_by("nip",$id_pegawai);
				$nama_pegawai = isset($datadetil->nama) ? $datadetil->nama : "";
				if($data_sppd->sppd_parent == ""){
					$dataupdate = array(
					'status_atasan'     => "1"
					);
					//echo $ppk;
					$this->sppd_jabodetabek_model->update_where('id', $pid, $dataupdate);
					$resultmail = $this->sendmail($ppk,"Telah disetujui permintaan SPPD dari ".$nama_pegawai." oleh ".$this->current_user->display_name."<br/>Klik <a href='".base_url()."admin/kepegawaian/sppd_jabodetabek/periksappk/".$pid."'>link</a>");
				}
			endforeach;
		endif;
		die();
	}
	private function sendmail($atasan,$tambahan="",$langsung = false)
	{
		$this->load->model('user/user_model', null, true);
		if(!$langsung){
			$user = $this->user_model->find_by("nip",$atasan);
			$email = "";
			if (isset($user))
			{
				$email = isset($user->email) ? $user->email : "";
			}
		}else{
			$email = $atasan;
		}
		//sending mail
		$subjek       		= "Notifikasi Permintaan SPD ";
		$isi        	= "Anda Perlu memeriksa Permintaan SPD, ".$tambahan;
		$this->load->library('emailer/emailer');
		$dataemail = array (
			'subject'	=> $subjek,
			'message'	=> $isi,
		);
		$success_count = 0;
		$resultmail = FALSE;
		 
		$dataemail['to'] = $email;
		$resultmail = $this->emailer->send($dataemail,false);// di set false supaya langsung mengirimkan email dan tidak masuk antrian dulu
		if(!$resultmail){
			//echo $email."mail false";
			$resultmail = $this->emailer->send($dataemail,true);
		}
		
			 	 
		return $resultmail;
	}
	
	//--------------------------------------------------------------------

	/**
	 * If the Auth lib is loaded, it will set the current user, since users
	 * will never be needed if the Auth library is not loaded. By not requiring
	 * this to be executed and loaded for every command, we can speed up calls
	 * that don't need users at all, or rely on a different type of auth, like
	 * an API or cronjob.
	 *
	 * Copied from Base_Controller
	 */
	protected function set_current_user()
	{
        if (class_exists('Auth')) {
			// Load our current logged in user for convenience
            if ($this->auth->is_logged_in()) {
				$this->current_user = clone $this->auth->user();

				$this->current_user->user_img = gravatar_link($this->current_user->email, 22, $this->current_user->email, "{$this->current_user->email} Profile");

				// if the user has a language setting then use it
                if (isset($this->current_user->language)) {
					$this->config->set_item('language', $this->current_user->language);
				}
            } else {
				$this->current_user = null;
			}

			// Make the current user available in the views
            if (! class_exists('Template')) {
				$this->load->library('Template');
			}
			Template::set('current_user', $this->current_user);
		}
	}
}
/* end ./application/controllers/home.php */
