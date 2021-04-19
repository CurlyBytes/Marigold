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
// 	public function index()
// 	{ 

// 		echo 'jo';
// echo phpinfo();
// 	//	$region = new Region(new RegionName("region--name"));


// 		//$region->setRegionId(1);
// 	//	echo '<pre>'; print_r($region->properties()); echo '</pre>';
// 	//	echo json_encode($region->__toArray(),true);
// 	//	var_dump( json_decode(json_encode($region->__toArray()), true));
// 		//var_dump( $region->properties());
// // /var_dump($region);
// 	//	$this->load->view('welcome_message');


	
// 	}

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'layout'));
        $this->load->helper(array('url'));

        $this->layout->add_custom_meta('meta', array(
            'charset' => 'utf-8'
        ));
        
        $this->layout->add_custom_meta('meta', array(
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ));
        
        $this->layout->add_css_files(array('main.css','normalize.css'), base_url().'assets/css/');

        $css_text = <<<EOF
.text {
font-size: 12px;
background-color: #eeeeee;
}
EOF;

        $js_text = <<<EOT
alert('this is just a test');
EOT;

        // Load view into a variable for importing javascript
        $js_text_footer = $this->load->view('themes/demo/includes/footer_javascript', '', true);

        $this->layout->add_css_rawtext($css_text);
        $this->layout->add_js_rawtext($js_text);
        $this->layout->add_js_rawtext($js_text_footer, 'footer');

    }

    /**
     * index function.
     *
     * @access public
     * @param mixed $slug (default: false)
     * @return void
     */
    public function index()
    {
        $this->layout->set_title('Test! This is test title');
        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
        $data["dummy"]='test';
        // load views and send data
        $this->load->view('themes/demo/includes/header', $data);
        $this->load->view('themes/demo/includes/index', $data);
        $this->load->view('themes/demo/includes/footer', $data);
    }
}

//Compairson
// public function add(Money $money)
// {
// 	if (!$money->currency()->equals($this->currency())) {
// 		throw new \InvalidArgumentException();
// 	}
// 	return new self(
// 		$money->amount() + $this->amount(),
// 		$this->currency()
// 	);
// }
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


//https://programmer.group/php-implementation-of-domain-driven-design-value-object.html
// class MoneyTest extends FrameworkTestCase
// {
//     /**
//      * @test
//      */
//     public function copiedMoneyShouldRepresentSameValue()
//     {
//         $aMoney = new Money(100, new Currency('USD'));
//         $copiedMoney = Money::fromMoney($aMoney);
//         $this->assertTrue($aMoney->equals($copiedMoney));
//     }

//     /**
//      * @test
//      */
//     public function originalMoneyShouldNotBeModifiedOnAddition()
//     {
//         $aMoney = new Money(100, new Currency('USD'));
//         $aMoney->add(new Money(20, new Currency('USD')));
//         $this->assertEquals(100, $aMoney->amount());
//     }

//     /**
//      * @test
//      */
//     public function moniesShouldBeAdded()
//     {
//         $aMoney = new Money(100, new Currency('USD'));
//         $newMoney = $aMoney->add(new Money(20, new Currency('USD')));
//         $this->assertEquals(120, $newMoney->amount());
//     }
// // ...
// }