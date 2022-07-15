<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/PHPExcel/PHPExcel.php';
class Excel extends PHPExcel
{
    function construct()
    {
        parent::__construct();
    }
} /* End of file Excel.php / / Location: ./application/libraries/Excel.php */