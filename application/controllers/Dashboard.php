<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
	/*	$this->load->model('Query_Db');
		$this->load->model('Lang_Model');
		$this->load->model('Lang_Menu');
		$this->load->library('email');  // เรียกใช้ email class*/
		
		
		$this->load->model('Query_Db');
		$this->load->model('Lang_Model');
		$this->load->model('Lang_Menu');
		$this->load->library('email');  // เรียกใช้ email class
		//$this->load->helper('language');
		$this->load->library('upload');
		$this->load->model('Sendmail');
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
	public function index()
	{
		
	/*	$tbl 	= $this->db->dbprefix.'banner';
	 	$where  = 'banner_id = '.$_GET['id'];
	 	$order  = 'banner_no ASC';
		$banner = $this->Lang_Menu->result($tbl ,$where,'0','',$order);
		$data['banner'] = $banner;	
		*/
		
		if(empty($this->session->userdata('username')) && ($this->session->userdata('type_st') != "T01")){
			
			 redirect('./', 'refresh');
			
			}else {
				
				
				
				$data['title']  = 'Register Vendor Information purchase Online';
				redirect('dashboard/wtc/', 'refresh');
				//$this->load->view('dashboard/toa/index',$data);
				
				}
	}
	
	public function wtc()
	{
		
		
		
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){
				
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','user_username =  "'.$this->session->userdata('username').'"');
				
				$format = 'Y-m-j'; 
				$d = date ( $format, strtotime ( '-30 days' ) );
				$d2 = date ( $format, strtotime ( '+30 days' ) );
				$data['getwallpaper'] = $this->Query_Db->result($this->db->dbprefix.'wallpaper','st != 2 AND bookdate BETWEEN "'.$d.'" AND "'.$d2.'"');
				
				//print_r($d2);
				
				$data['getuser'] = $getuser;
				$data['title']  = 'TOA Wallpaper Upload';
				$this->load->view('dashboard/wtc/index',$data);
			
			}else{
				
				redirect('./', 'refresh');
				
				}
				
		
	}
	
	
	public function template()
	{
		
		
		
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){
				
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','user_username =  "'.$this->session->userdata('username').'"');
				
				$format = 'Y-m-j'; 
				$d = date ( $format, strtotime ( '-30 days' ) );
				$d2 = date ( $format, strtotime ( '+30 days' ) );
				$data['getwallpaper'] = $this->Query_Db->result($this->db->dbprefix.'wallpaper','bookdate BETWEEN "'.$d.'" AND "'.$d2.'"');
				
				//print_r($d2);
				
				$data['getuser'] = $getuser;
				$data['title']  = 'TOA Wallpaper Upload';
				$this->load->view('dashboard/wtc/template',$data);
			
			}else{
				
				redirect('./', 'refresh');
				
				}
				
		
	}
	
	public function addwallpaper()
	{
		
		
		
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){
				
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','user_username =  "'.$this->session->userdata('username').'"');
				
				$format = 'Y-m-j'; 
				$d = date ( $format, strtotime ( '-30 days' ) );
				$d2 = date ( $format, strtotime ( '+30 days' ) );
				$data['getwallpaper'] = $this->Query_Db->result($this->db->dbprefix.'wallpaper','st !=2 AND bookdate BETWEEN "'.$d.'" AND "'.$d2.'"');
				
				//print_r($d2);
				
				$data['getuser'] = $getuser;
				$data['title']  = 'TOA Wallpaper Upload';
				$this->load->view('dashboard/wtc/addwallpaper',$data);
			
			}else{
				
				redirect('./', 'refresh');
				
				}
				
		
	}
	
	
	
	public function approvenow($id=NULL)
	{
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){

	
			if($id){
				//print_r($id);
				$wallpapernow = $this->Query_Db->record($this->db->dbprefix.'wallpaper','id='.$id.'');
				
			
				$jsdate = date("d",strtotime ($wallpapernow->bookdate));
				//$jsdate = date("d",strtotime ($_REQUEST['bookdate']));
				
				
				$file = './assets/wallpaper/'.$wallpapernow->imgname;
				$newfile = './assets/wallpaperapprove/'.$jsdate.'.jpg';
				
				 copy($file, $newfile);
				  chmod($newfile, 0777);
	
				
				
				$updatewallpaper  = $this->Query_Db->update2($this->db->dbprefix.'wallpaper','id = '.$id.'',array('st' => 1));
				
				
				
			$getthisimage  = $this->Query_Db->record($this->db->dbprefix.'wallpaper','id = '.$id.'' );
			
			$getowner  = $this->Query_Db->record($this->db->dbprefix.'user','user_username = "'.$getthisimage->upby.'"' );
							
							//print_r($getthisimage);
			$this->sendmailwallpaper($getowner->name,$getowner->email,$getthisimage->imgname,$getthisimage->bookdate,$getthisimage->st);
		
				
				redirect('dashboard/approvewallpaper/', 'refresh');
				
				
				}
				

		}else {
			redirect(base_url(), 'refresh');


		}
	
		
				
		
	}
	
	public function rejectnow($id=NULL)
	{
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){

			if($id){
				//print_r($id);
				//$data['getwallpaperdetail'] = $this->Query_Db->record($this->db->dbprefix.'wallpaper','id='.$id.'');
				
				
				
				$updatewallpaper  = $this->Query_Db->update2($this->db->dbprefix.'wallpaper','id = '.$id.'',array('st' => 2));
				
				$getthisimage  = $this->Query_Db->record($this->db->dbprefix.'wallpaper','id = '.$id.'' );
			
			$getowner  = $this->Query_Db->record($this->db->dbprefix.'user','user_username = "'.$getthisimage->upby.'"' );
							
							//print_r($getthisimage);
			$this->sendmailwallpaper($getowner->name,$getowner->email,$getthisimage->imgname,$getthisimage->bookdate,$getthisimage->st);
				
				
				redirect('dashboard/approvewallpaper/', 'refresh');
				
				
				
				
				
				}

		}else{
			redirect(base_url(), 'refresh');

		}

		
		
		
				
		
	}

	
	public function approvewallpaper()
	{
		
		$id = 3;
		if($id){
			//print_r($id);
			$data['getwallpaperdetail'] = $this->Query_Db->record($this->db->dbprefix.'wallpaper','id='.$id.'');
			}
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){
				
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','user_username =  "'.$this->session->userdata('username').'"');
				
				$format = 'Y-m-j'; 
				$d = date ( $format, strtotime ( '-30 days' ) );
				$d2 = date ( $format, strtotime ( '+30 days' ) );
				$data['getwallpaper'] = $this->Query_Db->result($this->db->dbprefix.'wallpaper','st =0 AND bookdate BETWEEN "'.$d.'" AND "'.$d2.'"');
				
				//print_r($d2);
				
				$data['getuser'] = $getuser;
				$data['title']  = 'TOA Wallpaper Upload';
				$this->load->view('dashboard/wtc/approvewallpaper',$data);
			
			}else{
				
				redirect('./', 'refresh');
				
				}
				
		
	}
	
	
	
	

			
	public function sendnotiwallpaper($name,$date,$tel,$title,$remark,$wallpapername,$wid){
		
			
					
			function notify_imate($image,$message,$linetoken){
	
	
	$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://notify-api.line.me/api/notify",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => 'message='.$message.'&imageThumbnail='.$image.'&imageFullsize='.$image.'',
  CURLOPT_HTTPHEADER => array(
    'authorization: Bearer '.$linetoken,
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "postman-token: e6236476-015b-435e-2978-7a9634519d90"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
//echo $curl;
curl_close($curl);
	
if ($err) {
	
  //echo "cURL Error #:" . $err;
} else {
	//$message_success = 'We have <strong>successfully</strong> received your Message and will get Back to you as soon as possible.';
	//echo '{ "alert": "success", "message": "' . $message_success . '" }';
  //echo '<span style="color:red;"> <strong>  Message Send to LINE : </strong> </span>';
}
	 
}
			
			function notify_message2($message,$linetoken){
	
	
	$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://notify-api.line.me/api/notify",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => 'message='.$message.'',
  CURLOPT_HTTPHEADER => array(
    'authorization: Bearer '.$linetoken,
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "postman-token: e6236476-015b-435e-2978-7a9634519d90"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
//echo $curl;
curl_close($curl);
	
if ($err) {
	
  //echo "cURL Error #:" . $err;
} else {
	//$message_success = 'We have <strong>successfully</strong> received your Message and will get Back to you as soon as possible.';
	//echo '{ "alert": "success", "message": "' . $message_success . '" }';
  //echo '<span style="color:red;"> <strong>  Message Send to LINE : </strong> </span>';
}
	 
}
//EMIcghtf4O0Xv5DcbPOxydHgrFw7G8BIqgAzOll8Lyc
//$res = notify_message2('test naja ','E8paE8JDbaNORQN1mMMm6CXueH4k2wTgesx6IGApAn2');

$messagetoline = '
เรียนนายท่านมีผู้ใช้อัพโหลด Wallpaper เข้ามาในระบบ
ผู้อัพ : '.$name.'
วันที่ต้องการ : '.$date.'
Tel: '.$tel.'
หัวข้อ : '.$title.'
หมายเหตุ : '.$remark.'
';

$messagetoline2 = '
หากนายท่านต้องการ Approve กด Link นี้เลย
URL Approve : '.base_url().'dashboard/approvenow/'.$wid.'
';

$messagetoline3 = '
หากนายท่านต้องการ Rejct กด Link นี้เลย
URL Rejct : '.base_url().'dashboard/rejectnow/'.$wid.'
';

$messagetoline4 = '
นายท่านมีรูปอัพโหลดเข้าระบบดังนี้
';

$imageurl = base_url().'assets/wallpaper/'.$wallpapername;

$token = '9wJikmLqJcrDgmmRb9XZnPAUZzBZsfgr70Y1uq5mMwJ';
//กลุ่ม WEB M
			
			
			
			
			$sendimage = notify_imate($imageurl,$messagetoline4,$token);
			
			
			$res = notify_message2($messagetoline,$token);
			
			$res2 = notify_message2($messagetoline2,$token);
			
			
			$res3 = notify_message2($messagetoline3,$token);
			
	
	

	}		
	

	public function sendmailwallpaper($name,$email,$image,$bookdate,$st){
	
	
	$newst = '';
if($st == 1){
	$newst = '<strong style="font-size:40px; color:#00ca08;">ผ่านการอนุมัติให้นำขึ้นระบบได้</strong>';
	
	}else{
		
		$newst = '<strong style="font-size:40px; color:#FF0004;">ไม่ผ่านการอนุมัติให้นำขึ้นระบบเนื่องจากผิดเงื่อนไขบางประการ หรือมีข้อมูลบางอย่างไม่ถูกต้องโปรดตรวจสอบ Wallpaper ของท่านอีกครั้ง</strong>';
		
		}
		

$imageurl = base_url().'assets/wallpaper/'.$image;	
$logo = base_url().'assets/images/logo_light.png';
    	//https://webapp.toagroup.com/wallpaper/assets/images/logo_light.png
$mail             = new PHPMailer();

$body             = '<div align="center"><img src="'.$logo.'" style="height: 90px; width: 340px"></div><br>
</div><table style="min-width:300px" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-bottom:4px"><strong style=" font-size:30px;">เรียน ท่าน '.$name.'</strong> </td></tr>
<tr>
  <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding:4px 0">
  '.$newst.'
  <br/>
  โดย Wallpaper ของท่านมีรายละเอียดดังนี้<br>
  วันที่ต้องการนำขึ้นระบบ : '.$bookdate.'<br>
<div align="center"><img src="'.$imageurl.'" style="height: 90px; width: 340px"></div>
</td></tr>
<tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-top:28px">	ขอแสดงความนับถือ</td></tr>
<tr height="16px"></tr>
<tr><td><table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12px;color:#b9b9b9;line-height:1.5"><tbody><tr><td>อีเมลนี้ไม่สามารถรับการตอบกลับได้ สำหรับข้อมูลเพิ่มเติม โปรดไปที่<a href="'.base_url().'" style="text-decoration:none;color:#4285f4" target="_blank" data-saferedirecturl="'.base_url().'">ศูนย์ช่วยเหลือของ TOA Wallpaper System </a></td></tr></tbody></table></td></tr>
 
</tbody></table>';
//$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp1.toagroup.com"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = false;                  // enable SMTP authentication
$mail->Host       = "smtp1.toagroup.com"; // sets the SMTP server
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = "Develop"; // SMTP account username
$mail->Password   = "@dev#it";        // SMTP account password

$mail->SetFrom('info@toagroup.com', 'TOA WALLPAPER DESKTOP SYSTEM ');

//$mail->AddReplyTo($temal,$temal);
//$mail->AddCC($temal, $temal);

$mail->Subject    = "แจ้งผลการตรวจสอบ WALLPAPER  ";

//$mail->AltBody    = "เรียนคู่ค้า"; // optional, comment out and test

$mail->MsgHTML($body);
$mail->CharSet = 'UTF-8';
$address = $email;
$mail->AddAddress($address,$address);

//$mail->AddAttachment($imageurl);      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

	

	}
	
	
	public function addwallpaperupload(){
		

				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','user_username =  "'.$this->session->userdata('username').'"');
				
				
								
				if($getuser){
					
				
	
					
							$data = array (
				
						'title' => $_REQUEST['title'],
						'upby' => $this->session->userdata('username'),
						'bookdate' => $_REQUEST['bookdate'],
						'contact' => $_REQUEST['contact'],
						'tel' => $_REQUEST['tel'],
						'remark' => $_REQUEST['remark'],
						
						'st' =>'0',
						
						
						
						);	
		
					
						if(!empty($_FILES["imgname"])){
									$config1['overwrite']	 = true;		
						$config1['upload_path']          = './assets/wallpaper/';
						$config1['allowed_types']        = 'jpg|jpeg';
						$config1['max_size']             = 20480;
						
						$jsdate = date("d",strtotime ($_REQUEST['bookdate']));
						$new_name1 = time().'.jpg';
						//$new_name1 = $jsdate.'.jpg';
						$config1['file_name'] = $new_name1;
						$data['imgname'] = $new_name1; 
						$this->upload->initialize( $config1);
						
							 if ( ! $this->upload->do_upload('imgname') )
                {
                    
					   
					  $error = array('error' => $this->upload->display_errors());
					  $resultapi = json_encode(array('upload_st' => 'fail'),true);
					  print_r($resultapi);
					  exit;
					  

                } 

						}
						
						
						
						
						$insertwallpaper  = $this->Query_Db->insert($this->db->dbprefix.'wallpaper',$data );
						
						$getthisimage  = $this->Query_Db->record($this->db->dbprefix.'wallpaper','contact = "'.$data['contact'].'" AND imgname = "'.$data['imgname'].'"' );
						
						//print_r($getthisimage);
						$this->sendnotiwallpaper($data['contact'],$data['bookdate'],$data['tel'],$data['title'],$data['remark'],$data['imgname'],$getthisimage->id);
							
								
						$resultapi = json_encode(array('upload_st' => 'true'),true);
						//print_r($vendor_datafile);
							print_r($resultapi);
						
				
				
				
					}
				
				
				

		
		}
		
	public function editwallpaperupload(){
		

				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','user_username =  "'.$this->session->userdata('username').'"');
				
				
								
				if($getuser){
					
				
	
					
							$data = array (
				
						'title' => $_REQUEST['title'],
						'upby' => $this->session->userdata('username'),
						'bookdate' => $_REQUEST['bookdate'],
						'contact' => $_REQUEST['contact'],
						'tel' => $_REQUEST['tel'],
						'remark' => $_REQUEST['remark'],
						
						'st' =>'0',
						
						
						
						);	
		
					//$_FILES['cover_image']['size'] == 0 && $_FILES['cover_image']['error'] == 0
						if($_FILES['imgname']['size'] != 0){
						$config1['overwrite']	 = true;
						$config1['upload_path']          = './assets/wallpaper/';
						$config1['allowed_types']        = 'jpg|jpeg';
						$config1['max_size']             = 20480;
						$jsdate = date("d",strtotime ($_REQUEST['bookdate']));
						$new_name1 = time().'.jpg';
						//$new_name1 = $jsdate.'.jpg';
						$config1['file_name'] = $new_name1;
						$data['imgname'] = $new_name1; 
						$this->upload->initialize( $config1);
						
							 if ( !$this->upload->do_upload('imgname') )
             			   {
                    
					   
					  $error = array('error' => $this->upload->display_errors());
					  $resultapi = json_encode(array('upload_st' => 'fail'),true);
					  print_r($resultapi);
					  exit;
					  

                } 

						}
						
	
						
						$insertwallpaper  = $this->Query_Db->update2($this->db->dbprefix.'wallpaper','id = '.$_REQUEST['id'].'',$data );
						
						
						$getthisimage  = $this->Query_Db->record($this->db->dbprefix.'wallpaper','id = '.$_REQUEST['id'].'' );
						
						//print_r($getthisimage);
						$this->sendnotiwallpaper($getthisimage->contact,$getthisimage->bookdate,$getthisimage->tel,$getthisimage->title,$getthisimage->remark,$getthisimage->imgname,$getthisimage->id);
							
								
						$resultapi = json_encode(array('upload_st' => 'true'),true);
						//print_r($vendor_datafile);
							print_r($resultapi);
						
				
				
				
					}
				
				
				

		
		}
	
	public function wallpaperdetail($id=NULL)
	{
		
		
		if($id){
			//print_r($id);
			$data['getwallpaperdetail'] = $this->Query_Db->record($this->db->dbprefix.'wallpaper','id='.$id.'');
			}
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){
				
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','user_username =  "'.$this->session->userdata('username').'"');
				
				$format = 'Y-m-j'; 
				$d = date ( $format, strtotime ( '-30 days' ) );
				$d2 = date ( $format, strtotime ( '+30 days' ) );
				$data['getwallpaper'] = $this->Query_Db->result($this->db->dbprefix.'wallpaper','bookdate BETWEEN "'.$d.'" AND "'.$d2.'"');
				
				//print_r($d2);
				
				$data['getuser'] = $getuser;
				$data['title']  = 'TOA Wallpaper Upload';
				$this->load->view('dashboard/wtc/wallpaperdetail',$data);
			
			}else{
				
				redirect('./', 'refresh');
				
				}
				
		
	}
	
	
	public function waranty()
	{
		
		
		
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){
				
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','user_username =  "'.$this->session->userdata('username').'"');
				
				$data['getuser'] = $getuser;
				
				
				$getvendorapprove = $this->Query_Db->result($this->db->dbprefix.'po');
				
				$data['getvendorapprove']  = $getvendorapprove;
				
				
				$data['title']  = 'WTC';
				$this->load->view('dashboard/wtc/waranty',$data);
			
			}else{
				
				redirect('./', 'refresh');
				
				}
				
		
	}
	
	public function customer()
	{
		
		
		
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){
				
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','user_username =  "'.$this->session->userdata('username').'"');
				
				$data['getuser'] = $getuser;
				
				
				$data['get_customer'] = $this->Query_Db->result($this->db->dbprefix.'customer','Status = 1');
				
				//$data['get_customer']  = $get_customer;
				
				
				$data['title']  = 'WTC';
				$this->load->view('dashboard/wtc/customer',$data);
			
			}else{
				
				redirect('./', 'refresh');
				
				}
				
		
	}
	
	
	public function pomanage()
	{
		
		
		
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){
				
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','username =  "'.$this->session->userdata('username').'"');
				
				$data['getuser'] = $getuser;
				
				
				$data['get_po'] = $this->Query_Db->result($this->db->dbprefix.'v_po_list');
				
				$data['get_customer'] = $this->Query_Db->result($this->db->dbprefix.'customer');
				
				//$data['get_customer']  = $get_customer;
				
				
				$data['title']  = 'PO MANAGEMENT WTC';
				$this->load->view('dashboard/wtc/pomanage',$data);
			
			}else{
				
				redirect('./', 'refresh');
				
				}
				
		
	}
	
	
	
	public function createpo(){
		

	if(empty($this->session->userdata('username'))){
		
		echo 'fail';
				exit;
				}
				else {
					
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','username =  "'.$this->session->userdata('username').'"');
												
				if($getuser){
					
				
				$get_enduser = $this->Query_Db->record($this->db->dbprefix.'customer_enduser','id ='.$_REQUEST['customer_enduser_id'].'');
				
				$get_customer = $this->Query_Db->record($this->db->dbprefix.'customer','id ="'.$get_enduser->customer_id.'"');
				
				

				$data_put_po = array (
				
						
						'PONumber' => $_REQUEST['PONumber'],
						'customer_enduser_id' => $_REQUEST['customer_enduser_id'],
						'CustomerId' => $get_customer->id,
						
						
						'TotalValue' => $_REQUEST['TotalValue'],
						'VATRate' => $_REQUEST['VATRate'],
						'IssuedDate' => $_REQUEST['IssuedDate'],
						'SlNumber' => $_REQUEST['SlNumber'],
						'Status' => '1',
					
						
						
						
						);
						
						
						
						
						
						$put_po  = $this->Query_Db->insert($this->db->dbprefix.'po',$data_put_po );
						
						$get_po = $this->Query_Db->record($this->db->dbprefix.'po','PONumber ="'.$_REQUEST['PONumber'].'"');
						//$_REQUEST['PONumber']
							
								
						$resultapi = json_encode(array('upload_st' => 'true',
						'po_id' => $get_po->ID
						
						),true);
				print_r($resultapi);
				
			
			
				
			
				
               
				

				
				
					}
						
					
					}
				
				
				

		
		}
	public function deletepo(){
		

		if(empty($this->session->userdata('username'))){
				exit;
				}else {
					
					
					$data_put_po_item = array(
					
					'Status' => 0
					
					);
					
						
						$deletepo = $this->Query_Db->update2($this->db->dbprefix.'po','ID='.$_REQUEST['fileid'].'',$data_put_po_item);
					
					
					}
				
				

		
		}	
	
	public function createpoitem(){
		

	if(empty($this->session->userdata('username'))){
		
		echo 'fail';
				exit;
				}
				else {
					
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','username =  "'.$this->session->userdata('username').'"');
												
				if($getuser){
					
				
				$get_model = $this->Query_Db->record($this->db->dbprefix.'product_model','id =  "'.$_REQUEST['ModelID'].'"');
				
				$get_brand = $this->Query_Db->record($this->db->dbprefix.'brand','id ="'.$get_model->brand_id.'"');
				
				

				$data_put_po_item = array (
				
						
						'SLNumber' => $_REQUEST['SLNumber'],
						'CustomerBranchID' => '1',
						
						
						'POID' => $_REQUEST['POID'],
						'ProductCategoryId' => $_REQUEST['ProductCategoryId'],
						'BrandID' => $get_brand->id,
						'ModelID' => $_REQUEST['ModelID'],
						'PartNumber' => $_REQUEST['PartNumber'],
						'SerialNumber' => $_REQUEST['SerialNumber'],
						'Tag' => $_REQUEST['Tag'],
						'Description' => '1',
						
						
						'Cost' => $_REQUEST['Cost'],
						'VendorID' => '1',
						
						'WarrantyStart' => $_REQUEST['WarrantyStart'],
						'WarrantyMonth' => $_REQUEST['WarrantyMonth'],
						'DONumber' => $_REQUEST['DONumber'],
						'DODate' => $_REQUEST['DODate'],
						'INVNumber' => $_REQUEST['INVNumber'],
						'INVDate' => $_REQUEST['INVDate'],
						
						
						
						
						);
						
						
						
						
						
						$put_po_item  = $this->Query_Db->insert($this->db->dbprefix.'po_item',$data_put_po_item );
							
								
						$resultapi = json_encode(array('upload_st' => 'true'),true);
				print_r($resultapi);
				
			
			
				
			
				
               
				

				
				
					}
						
					
					}
				
				
				

		
		}
	
	
	
	public function editpoitem(){
		

	if(empty($this->session->userdata('username'))){
		
		
				exit;
				}
				else {
					
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','username =  "'.$this->session->userdata('username').'"');
												
				if($getuser){
					
				
				$get_model = $this->Query_Db->record($this->db->dbprefix.'product_model','id =  "'.$_REQUEST['ModelID'].'"');
				
				$get_brand = $this->Query_Db->record($this->db->dbprefix.'brand','id ="'.$get_model->brand_id.'"');
				
				

				$data_put_po_item = array (
				
						
						'SLNumber' => $_REQUEST['SLNumber'],
						'CustomerBranchID' => '1',
						
						
						'POID' => $_REQUEST['POID'],
						'ProductCategoryId' => $_REQUEST['ProductCategoryId'],
						'BrandID' => $get_brand->id,
						'ModelID' => $_REQUEST['ModelID'],
						'PartNumber' => $_REQUEST['PartNumber'],
						'SerialNumber' => $_REQUEST['SerialNumber'],
						'Tag' => $_REQUEST['Tag'],
						'Description' => '1',
						
						
						'Cost' => $_REQUEST['Cost'],
						'VendorID' => '1',
						
						'WarrantyStart' => $_REQUEST['WarrantyStart'],
						'WarrantyMonth' => $_REQUEST['WarrantyMonth'],
						'DONumber' => $_REQUEST['DONumber'],
						'DODate' => $_REQUEST['DODate'],
						'INVNumber' => $_REQUEST['INVNumber'],
						'INVDate' => $_REQUEST['INVDate'],
						
						
						
						
						);
						
						
						//$updatepodetail  = $this->Query_Db->update2($this->db->dbprefix.'po','ID="'.$_REQUEST['flow_id'].'"',$flow_data);
		
						
						
						$update_po_item  = $this->Query_Db->update2($this->db->dbprefix.'po_item','ID ='.$_REQUEST['ID'].' ',$data_put_po_item );
							
								
						$resultapi = json_encode(array('upload_st' => 'true'),true);
				print_r($resultapi);
				
			
			
				
			
				
               
				

				
				
					}
						
					
					}
				
				
				

		
		}
	
	
	public function deletepoitem(){
		

		if(empty($this->session->userdata('username'))){
				exit;
				}else {
					
					
					
					
			

						
						
						$deletepoitem  = $this->Query_Db->delete2($this->db->dbprefix.'po_item','ID='.$_REQUEST['fileid'].'');
					
					
					}
				
				

		
		}
	
	
	
	
	public function podetail($id=NULL)
	{
		//echo 'xxxxxxxx';
	//	print_r($id);
	
	if(!is_numeric($id)){
		
		redirect('./', 'refresh');
		
			}
		
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){
				
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','username =  "'.$this->session->userdata('username').'"');
				
				$data['getuser'] = $getuser;
				
				
				$data['get_podetail'] = $this->Query_Db->record($this->db->dbprefix.'po','ID ='.$id.'');
				
				//echo $row = count($data['get_podetail']);
				if($data['get_podetail']){
					
					$data['get_customer'] = $this->Query_Db->record($this->db->dbprefix.'customer','id ='.$data['get_podetail']->CustomerId.'');
					
					$data['get_po_item'] = $this->Query_Db->result($this->db->dbprefix.'v_po_item_detail','po_id ='.$data['get_podetail']->ID.'');
					
					$data['get_categoty'] = $this->Query_Db->result($this->db->dbprefix.'product_category');
					
					//$data['get_model'] = $this->Query_Db->result($this->db->dbprefix.'product_model');
					
					$data['get_brand'] = $this->Query_Db->result($this->db->dbprefix.'brand');

					
					$data['title']  = 'PO Detail : WTC';
				$this->load->view('dashboard/wtc/podetail',$data);
					
					}else{
						redirect('./', 'refresh');
						
						//redirect();
						}
				
				//$data['get_customer']  = $get_customer;
				
				
				
			
			}else{
				
				redirect('./', 'refresh');
				
				}
				
		
	}
	
	
	public function podetailview($id=NULL)
	{
		//echo 'xxxxxxxx';
	//	print_r($id);
	
	if(!is_numeric($id)){
		
		redirect('./', 'refresh');
		
			}
		
		if(!empty($this->session->userdata('username')) && ($this->session->userdata('type_st') == "T01")){
				
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'user','username =  "'.$this->session->userdata('username').'"');
				
				$data['getuser'] = $getuser;
				
				
				$data['get_podetail'] = $this->Query_Db->record($this->db->dbprefix.'po','ID ='.$id.'');
				
				//echo $row = count($data['get_podetail']);
				if($data['get_podetail']){
					
					$data['get_customer'] = $this->Query_Db->record($this->db->dbprefix.'customer','id ='.$data['get_podetail']->CustomerId.'');
					
					$data['get_po_item'] = $this->Query_Db->result($this->db->dbprefix.'v_po_item_detail','po_id ='.$data['get_podetail']->ID.'');
					
					$data['get_categoty'] = $this->Query_Db->result($this->db->dbprefix.'product_category');
					
					//$data['get_model'] = $this->Query_Db->result($this->db->dbprefix.'product_model');
					
					$data['get_brand'] = $this->Query_Db->result($this->db->dbprefix.'brand');

					
					$data['title']  = 'PO Detail View : WTC';
				$this->load->view('dashboard/wtc/podetailview',$data);
					
					}else{
						redirect('./', 'refresh');
						
						//redirect();
						}
				
				//$data['get_customer']  = $get_customer;
				
				
				
			
			}else{
				
				redirect('./', 'refresh');
				
				}
				
		
	}
	
	public function updatepodetail()
	{
					
					
					
				
					
					if(!empty($_REQUEST)){
						
					
						
						$flow_data = array (
						$_REQUEST['flow_name'] => $_REQUEST['flow_val']
						);	
						
						
						$updatepodetail  = $this->Query_Db->update2($this->db->dbprefix.'po','ID="'.$_REQUEST['flow_id'].'"',$flow_data);
		
		
						//print_r($this->session->userdata());
						//print_r($_REQUEST);
						
						}
					
		
		
	}
	
	
	
	public function toa_register()
				{
					
					
					
					
					
					if($this->session->userdata('type_st') == "T01"){
						
						//$data['title']  = 'Register Vendor Information purchase Online';
						 redirect('dashboard', 'refresh');
						
						}
					
		
		if(empty($this->session->userdata('username')) && ($this->session->userdata('type_st') != "T02")){
			
			 redirect('./', 'refresh');
			
			}else {
				
				
				
				
				$data['title']  = 'Register Vendor Information purchase Online';
				$this->load->view('dashboard/toa/register',$data);
				
				}
		
	}
	
	public function toa_updaterole()
				{
					
					
					echo 'successsss';
					if(!empty($_REQUEST)){
						
	
						
						
	
	$check_user = $this->Query_Db->record($this->db->dbprefix.'users','username = "'.$this->session->userdata('username').'"');
	
	//print_r($check_user);
	
	if($check_user){
		
		
		$urole_data = array (
	'role_ref_id' => $check_user->id,
	'role_role' => $_REQUEST['role'],
	'role_permission' => $_REQUEST['parameter'],
	'role_st' => $_REQUEST['value']
	);	
		
		
		$check_urole = $this->Query_Db->record($this->db->dbprefix.'users_role','role_ref_id = '.$check_user->id.' and (role_role = "'.$_REQUEST['role'].'" and role_permission = "'.$_REQUEST['parameter'].'")');
		if(!empty($check_urole)){
			
			
			$update_urole  = $this->Query_Db->update2($this->db->dbprefix.'users_role','role_ref_id='.$check_user->id.' and (role_role = "'.$_REQUEST['role'].'" and role_permission = "'.$_REQUEST['parameter'].'" )',$urole_data);
	
	//$this->db->where('inspiration_id',$inspirationdetail->inspiration_id);
	//$this->db->update($this->db->dbprefix.'inspiration',$newviewdata);
			
			
			
			} else {
			
			
	
				
	$insert_urole  = $this->Query_Db->insert($this->db->dbprefix.'users_role',$urole_data );
	
	
//	$this->db->where('inspiration_id',$inspirationdetail->inspiration_id);
//	$this->db->update($this->db->dbprefix.'inspiration',$newviewdata);
				
				
				}
		
			
		//print_r($check_urole);
		
		
		}	
	
		
						
	/*$check_urole = $this->Query_Db->record($this->db->dbprefix.'users_role','users_ref_id =1 and  (inspiration_seo_en = "'.$productid.'" or inspiration_seo_lo = "'.$productid.'" )');	
	
	
					
	$lview = $inspirationdetail->inspiration_view;
	$newview = $lview+1;
	//echo $newview;
	$newviewdata = array (
	'inspiration_view' => $newview
	);
	//$inspirationview  = $this->Query_Db->update2($this->db->dbprefix.'inspiration','inspiration_id,'.$inspirationdetail->inspiration_id.'','inspiration_view = '.$newview);
	
	$this->db->where('inspiration_id',$inspirationdetail->inspiration_id);
	$this->db->update($this->db->dbprefix.'inspiration',$newviewdata);*/
						
						
						
		
						print_r($this->session->userdata());
						print_r($_REQUEST);
						
						}
					
		
		
	}
	
	public function toa_updatest()
				{
					
					
					echo 'successsss';
					if(!empty($_REQUEST)){
					
					
						 $sessionuserdata = array(
				'type_st' => "T01",
				
				);
				
				$this->session->set_userdata($sessionuserdata);
					}
					
		
		
	}
	
	
	public function toa_updateflow()
				{
					
					print_r($_REQUEST);
				
				if(!empty($_REQUEST)){
					
						if($_REQUEST['flow_mode'] == "addflow")	{
					
						$flow_data = array (
						'flow_name' => $_REQUEST['flow_name'],
						'flow_type_job' => $_REQUEST['flow_type_job'],
						'flow_type_vendor' => $_REQUEST['flow_type_vendor'],
						'flow_avp_id' => $_REQUEST['flow_select_avp'],
						//'flow_avp_name' => $_REQUEST['flow_name'],
						'flow_avp_st' => 1,
						'flow_mpr_id' => $_REQUEST['flow_select_mpr'],
						//'flow_mpr_name' => $_REQUEST['flow_name'],
						'flow_mpr_st' => 1,
						'flow_acc_id' => $_REQUEST['flow_select_acc'],
						//'flow_acc_name' => $_REQUEST['flow_name'],
						'flow_acc_st' => $_REQUEST['flow_approve_acc'],
						'flow_pr_id' => $_REQUEST['flow_select_pr'],
						//'flow_pr_name' => $_REQUEST['flow_name'],
						'flow_pr_st' => 1,
						'flow_st' => 1,
						'flow_use' => 0,
						
						
						);	
											
							$insert_flow  = $this->Query_Db->insert($this->db->dbprefix.'flow',$flow_data );
							
						//	print_r($insert_flow);
							
							}
							
							
					
					
					}
				
				
				//echo 'successsss';	
		
		
	}
	
	public function toa_editprofile()
				{
					
					
					
				
					
					if(!empty($_REQUEST)){
						
						echo 'successsss';
						
	$flow_data = array (
						$_REQUEST['flow_name'] => $_REQUEST['flow_val']
						);	
						
						
						$update_flow  = $this->Query_Db->update2($this->db->dbprefix.'users','username="'.$_REQUEST['flow_id'].'"',$flow_data);
		
		
						//print_r($this->session->userdata());
						//print_r($_REQUEST);
						
						}
					
		
		
	}
	
	
	public function toa_editflow()
				{
					
					
					
				
					
					if(!empty($_REQUEST)){
						
						echo 'successsss';
						
	$flow_data = array (
						$_REQUEST['flow_name'] => $_REQUEST['flow_val']
						);	
						
						
						$update_flow  = $this->Query_Db->update2($this->db->dbprefix.'flow','flow_id='.$_REQUEST['flow_id'].' and (flow_st = 1)',$flow_data);
		
		
						//print_r($this->session->userdata());
						//print_r($_REQUEST);
						
						}
					
		
		
	}
	
	
	
	
	public function gentoken()
	{
		
	/*	$tbl 	= $this->db->dbprefix.'banner';
	 	$where  = 'banner_id = '.$_GET['id'];
	 	$order  = 'banner_no ASC';
		$banner = $this->Lang_Menu->result($tbl ,$where,'0','',$order);
		$data['banner'] = $banner;	
		*/
		
		
		
		if(!empty($this->session->userdata('role_PR'))){
			
			$getuser = $this->Query_Db->record($this->db->dbprefix.'users','username =  "'.$this->session->userdata('username').'"');
			
			
			
			$getrole = $this->Query_Db->result($this->db->dbprefix.'users_role','role_ref_id="'.$getuser->id.'" AND   role_role ="'.$this->session->userdata('role_PR').'" and role_st = 1');
			
			$role_permission = 'flow_type_vendor = "';
			
			$q_type_vendor = 'q_type_vendor = "';
		
			
			//print_r(end($getrole));
			end($getrole);
			$sumpermission =  key($getrole);

			
	
			//print_r($sumpermission);
			
			if($getrole){
				$i = 0;
				foreach($getrole as $getroles){
					
				
				//echo key($getrole);
					if( $i == $sumpermission){
						$role_permission .= $getroles->role_permission.'" ';
						$q_type_vendor .= $getroles->role_permission.'" ';
						
						}else{
							$role_permission .= ''.$getroles->role_permission.'" or flow_type_vendor ="';
							$q_type_vendor .= ''.$getroles->role_permission.'" or q_type_vendor ="';
					
					
							}
					
					$i = $i+1;
					}
				}
			
			//print_r($queryflow );
				
				$queryflow = $this->Query_Db->result($this->db->dbprefix.'flow','flow_st = 1 and ('.$role_permission.')');
				
				
				$querytype_question = $this->Query_Db->result($this->db->dbprefix.'type_question','q_st = 1 and ('.$q_type_vendor.')');
				
				
				$showflowtoken = $this->Query_Db->result($this->db->dbprefix.'token','tk_st = 1 ');
				
				
			
				//print_r($querytype_question );
				
				$data['showflowtoken'] = $showflowtoken;
				$data['queryflow'] = $queryflow;
				$data['querytype_question'] = $querytype_question;
				$data['getuser'] = $getuser;
			
			 	$data['title']  = 'Generate Token | RVIPO';
				//redirect('dashboard/gen/', 'refresh');
				//print_r($this->session->userdata());
				
				$this->load->view('dashboard/toa/gentoken',$data);
			
			}else {
				 redirect('./', 'refresh');
				}
		
		
	
	}
	
	public function toa_sendmail($token,$vemail,$temal,$comname){
		
			
    	
$mail             = new PHPMailer();

$body             = '<body style="margin: 10px;">
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
<div align="center"><img src="http://202.142.195.173/webapp.toagroup.com/public_html/rvipo/assets/images/mail/rvipo_mail_logo.gif" style="height: 90px; width: 340px"></div><br>




<table style="min-width:300px" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-bottom:4px"><strong style=" font-size:30px;">เรียน บริษัท '.$comname.'</strong> </td></tr><tr>
  <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding:4px 0">
  <strong>รหัสผ่านชั่วคราวของท่านคือ</strong> : <strong style="font-size:40px; color:#FF0004;">'.$token.'</strong>
  <br/>
  บริษัทได้ดำเนินการสร้างรหัสผ่านชั่วคราว เพื่อให้ท่านเข้าสู่ระบบลงทะเบียนของเรา <wbr> โดยท่านสามารถกด <a href="http://webapp.toagroup.com/rvipo/vendortoken?t='.$token.'" style="text-decoration:none;color:#4285f4;font-size:40px;" target="_blank" data-saferedirecturl="http://webapp.toagroup.com/rvipo/vendortoken?t='.$token.'"> ที่นี่</a> เพื่อเข้าสู่ระบบลงทะเบียน หรือ เข้าสู่ระบบ ได้จาก URL : นี้ <a href="http://webapp.toagroup.com/rvipo/vendortoken" target="_blank">http://webapp.toagroup.com/rvipo/vendortoken</a> หากไม่สามารถเข้าระบบได้ โปรด ติดต่อ เจ้าหน้าที่ที่ท่านดำเนินการติดต่ออยู่</b></td></tr><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-top:28px">	ขอแสดงความนับถือ</td></tr><tr height="16px"></tr><tr><td><table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12px;color:#b9b9b9;line-height:1.5"><tbody><tr><td>อีเมลนี้ไม่สามารถรับการตอบกลั<wbr>บได้ สำหรับข้อมูลเพิ่มเติม โปรดไปที่<a href="http://webapp.toagroup.com/rvipo/" style="text-decoration:none;color:#4285f4" target="_blank" data-saferedirecturl="http://webapp.toagroup.com/rvipo/">ศูนย์ช่วยเหลือของ TOA RVIPO SYSTEM</a></td></tr></tbody></table></td></tr></tbody></table>



</div>
</body>';
//$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp1.toagroup.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = false;                  // enable SMTP authentication
$mail->Host       = "smtp1.toagroup.com"; // sets the SMTP server
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = "Develop"; // SMTP account username
$mail->Password   = "@dev#it";        // SMTP account password

$mail->SetFrom('info@toagroup.com', 'TOA RVIPO SYSTEM ');

//$mail->AddReplyTo($temal,$temal);
$mail->AddCC($temal, $temal);

$mail->Subject    = "แจ้งรหัสผ่านชั่วคราวเพื่อใช้ในการลงทะเบียนคู่ค้ากับ บริษัท ทีโอเอ เพ้นท์ (ประเทศไทย) จำกัด (มหาชน)";

//$mail->AltBody    = "เรียนคู่ค้า"; // optional, comment out and test

$mail->MsgHTML($body );
$mail->CharSet = 'UTF-8';
$address = $vemail;
$mail->AddAddress($address,$address);

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

	

	} // end function send_email_product
	
	
	public function toa_gentoken()
				{
					
			//		print_r($_REQUEST);
				
			
					
			if(!empty($_REQUEST)){
					
						if($_REQUEST['tk_mode'] == "gentoken")	{
					
						$flow_data = array (
						'tk_flow_id' => $_REQUEST['tk_flow_id'],
						'tk_q_id' => $_REQUEST['tk_q_id'],
						'tk_token' => $_REQUEST['tk_token'],
						'tk_company' => $_REQUEST['tk_company'],
						'tk_email' => $_REQUEST['tk_email'],
						'tk_user_create' => $_REQUEST['tk_user_create'],
						'tk_st' => 1,
						
						
						);	
						
						$flow_data2 = array (
				
						'flow_use' => 1,
						
						
						);	
						
						
											
							$insert_flow  = $this->Query_Db->insert($this->db->dbprefix.'token',$flow_data );
							
							$update_flow  = $this->Query_Db->update2($this->db->dbprefix.'flow','flow_id='.$_REQUEST['tk_flow_id'].' and (flow_st = 1)',$flow_data2);
		
							
							
						//flow_pr_id
						
						$getuser = $this->Query_Db->record($this->db->dbprefix.'users','username =  "'.$_REQUEST['tk_user_create'].'"');
						
						$this->toa_sendmail($_REQUEST['tk_token'],$_REQUEST['tk_email'],$getuser->email,$_REQUEST['tk_company']);
						
						
						
						
							
							}
							
							
					
					
					
					
					
					}		
					
			
			//	echo 'successsss';	
		
		
	}
	
	public function approveflow()
	{
		
		
		
	/*	$tbl 	= $this->db->dbprefix.'banner';
	 	$where  = 'banner_id = '.$_GET['id'];
	 	$order  = 'banner_no ASC';
		$banner = $this->Lang_Menu->result($tbl ,$where,'0','',$order);
		$data['banner'] = $banner;	
		*/
		
		if(!empty($this->session->userdata('role_PR'))){
			
			 	$data['title']  = 'Approve Flow | RVIPO';
				//redirect('dashboard/gen/', 'refresh');
				
				
	
	
	$getuser = $this->Query_Db->record($this->db->dbprefix.'users','username =  "'.$this->session->userdata('username').'"');
				
				$data['getuser'] = $getuser;
	
	$getrole = $this->Query_Db->result($this->db->dbprefix.'users_role','role_ref_id="'.$getuser->id.'" AND   role_role ="'.$this->session->userdata('role_PR').'" and role_st = 1');
	
	//print_r($getuser);
	
	if($getrole){
		$i = 0;
		$i2 = 0;
		foreach($getrole as $getroles){
			
				$data['permission'][$i2] = $getroles->role_permission;
				
				$permissin[$i2] = $getroles->role_permission;
			//echo 'xxxxxx'.$i2.$getroles->role_permission.'<br/>';
			
			
				/*$this->session->set_userdata(array(
				'permission_'.$getroles->role_permission => $getroles->role_permission
				));*/
	
			
			//$data['flowshow'][$getroles->role_id] = $this->Query_Db->result($this->db->dbprefix.'flow','flow_st != 0 and flow_type_vendor ="'.$getroles->role_permission.'"');
			
			
			$newquery = $this->Query_Db->result($this->db->dbprefix.'flow','flow_st != 0 and flow_type_vendor ="'.$getroles->role_permission.'"');
			
			if(!empty($newquery)){
				
				$data['flowshow'][$getroles->role_permission] = $newquery ;
				$i = $i++;
				}
				
			$i2 = $i2+1;
			//echo $i;
			
			}
		
		}
		
	//print_r($getrole);
		
	
	
	
			
	
//	print_r($getuser);
				
				
				$data['getrole']  = $getrole;
				$data['getuser']  = $getuser;
				
			//	print_r($this->session->userdata());
				
				$this->load->view('dashboard/toa/approveflow',$data);
			
			}else {
				 redirect('./', 'refresh');
				}
		
		
	
	}
	
	public function approvevendor(){
		
		
		if(!empty($this->session->userdata('role_PR'))){
			
			 	$data['title']  = 'Approve Vendor List | RVIPO';
				
				$getuser = $this->Query_Db->record($this->db->dbprefix.'users','username =  "'.$this->session->userdata('username').'"');
				
	
				$data['getuser']  = $getuser;
				
				
				$getvendorapprove = $this->Query_Db->result($this->db->dbprefix.'vendor','vendor_st = "S2" AND   tk_user_create ="'.$this->session->userdata('username').'"');
				
				$data['getvendorapprove']  = $getvendorapprove;
				
			//	$getvendor = $this->Query_Db->result($this->db->dbprefix.'vendor','tk_user_create ="'.$getuser->username.'" AND   vendor_st ="'.$this->session->userdata('role_PR').'" and role_st = 1');
				
				
			//	$data['getvendor']  = $getvendor;
				
				$this->load->view('dashboard/toa/approvevendor',$data);
			
			}else {
				 redirect('./', 'refresh');
				}		
		
		
		//$data['title']  = 'Register Vendor Information purchase Online';
				//redirect('dashboard/toa/approvevendor/', 'refresh');
				
			//	$data['title'] = 'RVIPO Register Vendor';
		//$this->load->view('dashboard/toa/approvevendor',$data);

		
		
		
		
		
		}
		
	
	public function approvevendordetail(){
		
		if(!empty($_GET['vid'])){
			
			
			$getvendor = $this->Query_Db->record($this->db->dbprefix.'vendor','vendor_id="'.$_GET['vid'].'" and vendor_st !="S1" ');
			
			if($getvendor){
				
				//print_r($getvendor);
				$getvendorprofile = $this->Query_Db->record($this->db->dbprefix.'vp_approve','vp_flow_id ='.$getvendor->vendor_flow_id.' and vp_ref_id ='.$getvendor->vendor_id.' ');
				
				if($getvendorprofile){
					
					//print_r($getvendorprofile);
					$data['getvendorprofile'] = $getvendorprofile;
					
						if(!empty($this->session->userdata('role_PR'))){
			
			 	$data['title']  = 'Approve Vendor List | RVIPO';
				
	$getuser = $this->Query_Db->record($this->db->dbprefix.'users','username =  "'.$this->session->userdata('username').'"');
				
				$data['getuser'] = $getuser;
	
	$getrole = $this->Query_Db->result($this->db->dbprefix.'users_role','role_ref_id="'.$getuser->id.'" AND   role_role ="'.$this->session->userdata('role_PR').'" and role_st = 1');
	
		
	if($getrole){
		$i = 0;
		$i2 = 0;
		foreach($getrole as $getroles){
			
				$data['permission'][$i2] = $getroles->role_permission;
				
				$permissin[$i2] = $getroles->role_permission;
				$i2 = $i2+1;
			
			
			}
		
		}
		
	
				
				
				$data['getrole']  = $getrole;
				$data['getuser']  = $getuser;
				
				
				$getvendorapprove = $this->Query_Db->result($this->db->dbprefix.'vendor','vendor_st = "S2" AND   tk_user_create ="'.$this->session->userdata('username').'"');
				
				$data['getvendorapprove']  = $getvendorapprove;
				
			//	$getvendor = $this->Query_Db->result($this->db->dbprefix.'vendor','tk_user_create ="'.$getuser->username.'" AND   vendor_st ="'.$this->session->userdata('role_PR').'" and role_st = 1');
				
				
			//	$data['getvendor']  = $getvendor;
				
				$this->load->view('dashboard/toa/approvevendordetail',$data);
			
			}else {
				 redirect();
				}		
					
					
					}
				
				}else{
					redirect();
					}
			
			
			
		
			
			
			
			} else {
				redirect();
				}
		
		
		
		//$data['title']  = 'Register Vendor Information purchase Online';
				//redirect('dashboard/toa/approvevendor/', 'refresh');
				
			//	$data['title'] = 'RVIPO Register Vendor';
		//$this->load->view('dashboard/toa/approvevendor',$data);

		
		
		
		
		
		}	
		
	public function redirect(){
		
		redirect('./', 'refresh');
		
		}
		
		public function checkstep($step,$id){
			
			
		
		//redirect('./', 'refresh');
		
		}
	
}
