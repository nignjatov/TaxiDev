<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 5/10/15
 * Time: 12:35
 */

class Dompdf_lib {

    private $_dompdf = NULL;

    function __construct()
    {
        require_once(APPPATH.'libraries/dompdf/dompdf_config.inc.php');
        if(is_null($this->_dompdf)){
            $this->_dompdf = new DOMPDF();
        }
    }

    function convert_html_to_pdf($html, $filename ='', $stream = false)
    {
        $this->_dompdf->load_html($html);
        $this->_dompdf->render();
        if ($stream) {
            $this->_dompdf->stream($filename);
        } else {
            return $this->_dompdf->output();
        }
    }

}
?>