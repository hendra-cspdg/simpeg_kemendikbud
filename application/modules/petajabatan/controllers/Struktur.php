<?php 
class Struktur extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('pegawai/unitkerja_model');
    }
    public function test(){
        Template::render();
    }
    public function load_tree($state='',$id=''){
        if($state==''){ //first tree
            $root =  $this->getRootNode(2);
            echo json_encode($root);
        }
        else if ($state=='children'){
            $children = $this->getChildren($id);
            echo json_encode(array(
                'children'=>$children
            ));
        }
        else if ($state=='siblings'){

        }
        else if ($state=='families'){

        }
    }
     public function getRootNode($id){
        $unors = $this->unitkerja_model->get_cache();
        $unor  = isset($unors[$id])?$unors[$id]:null;
        if($unor){
            $node = new stdClass;
            $node->id =  $unor->ID;
           if($unor->PEJABAT_NAMA){
              $node->name =  $unor->PEJABAT_NAMA;
            }
            else $node->name =  "-";
            $node->title = $unor->NAMA_UNOR;
            if($unor->TOTAL_CHILD>0){
                $node->relationship = '001';
            }
            else $node->relationship = '000';            

            return $node;
        }
        return null;
    }
    public function getChildren($id){
        $unors = $this->unitkerja_model->get_cache();
        $children = array();
        $parent_node = null;
        foreach($unors as $unor){
            if($unor->ID==$id){
                $parent_node = $unor;
            }
        }
        foreach($unors as $unor){
            if($unor->PARENT_ID==$id){
                $node = new stdClass;
                $node->id =  $unor->ID;
                if($unor->PEJABAT_NAMA){
                    $node->name =  $unor->PEJABAT_NAMA;
                }
                else $node->name =  "-";
                $node->title = $unor->NAMA_UNOR;
                $relationship_flag = array();
                $relationship_flag[]  = 1 ; //has parent
                 //has siblings
                if($parent_node->TOTAL_CHILD>1){
                    $relationship_flag[] = 1;
                }
                else {
                    $relationship_flag[] = 0;
                }
                //has child
                if($unor->TOTAL_CHILD>0){
                    $relationship_flag[] = 1;
                }
                else {
                    $relationship_flag[] = 0;
                }
                $node->relationship = implode("",$relationship_flag); 

                $children [] = $node;  
            }
        }
        return $children;
    }
}