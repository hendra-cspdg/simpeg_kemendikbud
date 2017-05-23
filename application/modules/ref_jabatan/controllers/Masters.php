<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Masters controller
 */
class Masters extends Admin_Controller
{
    protected $permissionCreate = 'Ref_jabatan.Masters.Create';
    protected $permissionDelete = 'Ref_jabatan.Masters.Delete';
    protected $permissionEdit   = 'Ref_jabatan.Masters.Edit';
    protected $permissionView   = 'Ref_jabatan.Masters.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->lang->load('ref_jabatan');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'masters/_sub_nav');

        Assets::add_module_js('ref_jabatan', 'ref_jabatan.js');
    }

    /**
     * Display a list of ref jabatan data.
     *
     * @return void
     */
    public function index()
    {
        
        
        
        
        
    Template::set('toolbar_title', lang('ref_jabatan_manage'));

        Template::render();
    }
    
    /**
     * Create a ref jabatan object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        

        Template::set('toolbar_title', lang('ref_jabatan_action_create'));

        Template::render();
    }
    /**
     * Allows editing of ref jabatan data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('ref_jabatan_invalid_id'), 'error');

            redirect(SITE_AREA . '/masters/ref_jabatan');
        }
        
        
        

        Template::set('toolbar_title', lang('ref_jabatan_edit_heading'));
        Template::render();
    }
}