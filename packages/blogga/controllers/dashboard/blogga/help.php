<?php 
//Loader::model('page_list');
class DashboardBloggaHelpController extends Controller {

    public function on_start(){
        $html = Loader::helper('html/v2');
        $this->addHeaderItem($html->css('blogga.css','blogga'));
        $this->addHeaderItem($html->javascript('blogga.lib.js','blogga'));
        $this->set('html',$html);

        $this->set('imgs',BLOGGA_DIR.'/images/');
    }

}

?>