<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kepegawaian controller
 */
class DiklatFungsional extends Admin_Controller
{
    protected $permissionCreate = 'DiklatFungsional.Kepegawaian.Create';
    protected $permissionDelete = 'DiklatFungsional.Kepegawaian.Delete';
    protected $permissionEdit   = 'DiklatFungsional.Kepegawaian.Edit';
    protected $permissionView   = 'DiklatFungsional.Kepegawaian.View';
    protected $permissionAddDiklatFungsional   = 'DiklatFungsional.Kepegawaian.AddDiklatFungsional';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function ajax_list(){
        
    }
    public function index($PNS_ID){
        
    }
    public function show($PNS_ID,$record_id=''){

    }
    public function save($record_id=''){

    }
    public function remove($record_id){

    }
}