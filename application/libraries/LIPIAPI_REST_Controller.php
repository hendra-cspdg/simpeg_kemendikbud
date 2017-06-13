<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Rest Controller
 * A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 * @version         3.0.0
 */
require "REST_Controller.php";
class LIPIAPI_REST_Controller extends REST_Controller {
	/**
     * Check to see if the API key has access to the controller and methods
     *
     * @access protected
     * @return bool TRUE the API key has access; otherwise, FALSE
     */
    protected function _check_access()
    {
        // If we don't want to check access, just return TRUE
        if ($this->config->item('rest_enable_access') === FALSE)
        {
            return TRUE;
        }

        // Fetch controller based on path and controller name
        $controller = implode(
            '/', [
            $this->router->module,
            $this->router->class,
			$this->router->method,
        ]);
        // Remove any double slashes for safety
        $controller = str_replace('//', '/', $controller);
        
        
        // Query the access table and get the number of results
        return $this->rest->db
			->group_start()
            ->where('key', $this->rest->key)
            ->where('controller', $controller)
			->group_end()
			->or_group_start()
			->where('key is null')
            ->where('controller', $controller)
			->group_end()
            ->get($this->config->item('rest_access_table'))
            ->num_rows() > 0;
    }
}
