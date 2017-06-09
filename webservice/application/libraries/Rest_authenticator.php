<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_authenticator {

    public function auth($username,$password){
		$ci = &get_instance();
		$rs = $ci->db->query("select * from cms_main_user where user_name = ? and password = md5(?)",array($username,$password))->result('array');
		return sizeof($rs)>0;
	}

}
