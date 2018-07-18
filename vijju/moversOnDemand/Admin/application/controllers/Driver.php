<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller {
	function __construct(){
		parent::__construct();
		// $this->load->model('Driver_model','',TRUE);
	
	}

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

	/*home page view*/
	public function index()
	{
		// echo "fkljfdlkj";die();
		$this->template();
		$this->load->view('driversignup');
	}
		/*sidebar,header,headerpage loaded for all view common*/
	public function template($data=null)
	{
		$this->load->view('templete/header');

		// $this->load->view('templete/headerpage',$data);
        // Footer is loaded in view for js flexibility
	}
	public function DriverSignup(){
			if (isset($_POST)) {
				
			
			


			// print_r($number);die();			
				$upload_path='public/driverdetail/license_image';
				$abc=($_FILES['licencefront']['name']);
				$arra=explode('.', $abc);
				$number=mt_rand(1000,10000);
				$p = pathinfo($_FILES['licencefront']['name']);
				$imgname = $arra[0].$number. "." . $p['extension'];
				$image='licencefront';
				$data['licencefront']=$this->file_upload($upload_path,$image,$imgname);



				$upload_path='public/driverdetail/license_image';
				$abc=($_FILES['licenceback']['name']);
				$arra=explode('.', $abc);
				$number=mt_rand(1000,10000);
				$p = pathinfo($_FILES['licenceback']['name']);
				$imgname = $arra[0].$number. "." . $p['extension'];
				$image='licenceback';
				$data['licenceback']=$this->file_upload($upload_path,$image,$imgname);


				$upload_path='public/driverdetail/rc_image';
				$abc=($_FILES['rcfront']['name']);
				$arra=explode('.', $abc);
				$number=mt_rand(1000,10000);
				$p = pathinfo($_FILES['rcfront']['name']);
				$imgname = $arra[0].$number. "." . $p['extension'];
				$image='rcfront';
				$data['rcfront']=$this->file_upload($upload_path,$image,$imgname);



				$upload_path='public/driverdetail/rc_image';
				$abc=($_FILES['rcback']['name']);
				$arra=explode('.', $abc);
				$number=mt_rand(1000,10000);
				$p = pathinfo($_FILES['rcback']['name']);
				$imgname = $arra[0].$number. "." . $p['extension'];
				$image='rcback';
				$data['rcback']=$this->file_upload($upload_path,$image,$imgname);


				$upload_path='public/driverdetail/vehicle_image';
				$abc=($_FILES['vehiclefront']['name']);
				$arra=explode('.', $abc);
				$number=mt_rand(1000,10000);
				$p = pathinfo($_FILES['vehiclefront']['name']);
				$imgname = $arra[0].$number. "." . $p['extension'];
				$image='vehiclefront';
				$data['vehiclefront']=$this->file_upload($upload_path,$image,$imgname);


				$upload_path='public/driverdetail/vehicle_image';
				$abc=($_FILES['vehicleside']['name']);
				$arra=explode('.', $abc);
				$number=mt_rand(1000,10000);
				$p = pathinfo($_FILES['vehicleside']['name']);
				$imgname = $arra[0].$number. "." . $p['extension'];
				$image='vehicleside';
				$data['vehicleside']=$this->file_upload($upload_path,$image,$imgname);



				$upload_path='public/driverdetail/insurance_image';
				$abc=($_FILES['insurancefront']['name']);
				$arra=explode('.', $abc);
				$number=mt_rand(1000,10000);
				$p = pathinfo($_FILES['insurancefront']['name']);
				$imgname = $arra[0].$number. "." . $p['extension'];
				$image='insurancefront';
				$data['insurancefront']=$this->file_upload($upload_path,$image,$imgname);



				$upload_path='public/driverdetail/insurance_image';
				$abc=($_FILES['insuranceback']['name']);
				$arra=explode('.', $abc);
				$number=mt_rand(1000,10000);
				$p = pathinfo($_FILES['insuranceback']['name']);
				$imgname = $arra[0].$number. "." . $p['extension'];
				$image='insuranceback';
				$data['insuranceback']=$this->file_upload($upload_path,$image,$imgname);




				  $addtransArray = array(
                      'fname'=>$_POST['fname'],
                      'lname'=>$_POST['lname'],
                      'email'=>'fromReferrel',
                      'country_code'=>"from referal",
                      'phone'=>"",
                      'user_Type'=>2
                      );
                      $addtrans = $this->User_model->insert_data('tbl_bankDetail',$addtransArray);

				

					






}

				// print_r($data['licencefront']);die();
	}
		/*common upload function*/
	Public function file_upload($upload_path,$image,$imgname) {                                  /* File upload function */
		$baseurl = base_url();
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '5000';
		$config['file_name'] = $name;
		$config['max_width'] = '5024';
		$config['max_height'] = '5068';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($image))
		{
			$error = array(
				'error' => $this->upload->display_errors()
				);
			print_r($error);
          
			return $imagename = "";
		}
		else
		{
			$this->upload->data();
			return $imagename = $baseurl . $upload_path .'/'.$imgname;
		}
	}

}
