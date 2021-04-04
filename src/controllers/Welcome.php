<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Marigold\Domain\BranchLocation\Region;
use Marigold\Domain\BranchLocation\ValueObjects\RegionName;

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{ 
		$region = new Region(1 ,new RegionName("region--name"));
		echo '<pre>'; print_r($region->__toArray()); echo '</pre>';
	//	echo json_encode($region->__toArray(),true);
	//	var_dump( json_decode(json_encode($region->__toArray()), true));
		var_dump( $region->__toArray());
// /var_dump($region);
	//	$this->load->view('welcome_message');
	}
}


/**
 * 
 * PrimaryID
 * RecordType
 * Recordname
 * RecordDescrption
 * ParentId
 * 
 * 
 */