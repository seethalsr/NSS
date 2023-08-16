<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
		//$this->load->library('session');
		//$user	= $this->session->userdata('reconluser');
		//$this->load->helper('string');
		
		
    }
	function footer()
	{
		
		$w_page = isset($this->l['w_page']) ? $this->l['w_page'].' ' : '';
		//$this->Ln(.5);
		$timestamp = date("m/d/Y h:m:s");
			$this->Cell(0, 6, ' ©2019 Mahatma Gandhi University,Kottayam,Kerala  '.'        ' .$timestamp.'      ', 'T', 0, 'C');
		
		
		
		/*if (empty($this->pagegroups)) {
			$pagenumtxt ='©2017 Mahatma Gandhi University,Kottayam,Kerala  '.'        ' .$timestamp.'   '. $w_page.$this->getAliasNumPage().' / '.$this->getAliasNbPages();
		} else {
			$pagenumtxt ='©2017 Mahatma Gandhi University,Kottayam,Kerala  '. '   ' .$timestamp.'   '.$w_page.$this->getPageNumGroupAlias().' / '.$this->getPageGroupAlias();
		}*/
	}
	

}
