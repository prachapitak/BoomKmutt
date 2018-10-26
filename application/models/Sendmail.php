<?php
defined('BASEPATH') OR exit('No direct script access allowed');




class Sendmail extends CI_Model {

	private $table_name = 'wtc_cdaily_model'; 
	private $joined_table_name_1 = ''; 
	private $joined_on_1 = ''; 
	private $default_order_by = ''; 
	private $default_limit_start = 0; 
	private $default_limit_end = 100; 

	public function __construct()
	{
		parent::__construct();
	}
	
	

	/*public function insert($data = NULL)
	{
		$this->db->insert($this->table_name, $data);
	}*/
	
	
	
	public function toa_sendmail_staff($staffname,$vemail,$temal,$comname){
		
			
    	
$mail             = new PHPMailer();

$body             = '<body style="margin: 10px;">
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
<div align="center"><img src="http://webapp.toagroup.com/rvipo/assets/images/mail/rvipo_mail_logo.gif" style="height: 90px; width: 340px"></div><br>




<table style="min-width:300px" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-bottom:4px"><strong style=" font-size:30px;">เรียน คุณ '.$staffname.'</strong> </td></tr><tr>
  <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding:4px 0">
  <strong>ขณะนี้บริษัท  '.$comname.' รอการตรวจสอบข้อมูลจากท่าน </strong> 
  <br/>
  บริษัท  '.$comname.' ได้ดำเนินการบันทึกข้อมูลเข้าระบบเรียบร้อยแล้ว ท่านสามารถเข้าสู่ระบบเพื่อทำการตรวจสอบข้อมูลดังกล่าวและ  เพื่อให้ท่านเข้าสู่ระบบลงทะเบียนของเรา <wbr> โดยท่านสามารถกด <a href="http://webapp.toagroup.com/rvipo/" style="text-decoration:none;color:#4285f4;font-size:40px;" target="_blank" data-saferedirecturl="http://webapp.toagroup.com/rvipo/"> ที่นี่</a> เพื่อเข้าสู่ระบบ หรือ เข้าสู่ระบบ ได้จาก URL : นี้ <a href="http://webapp.toagroup.com/rvipo/" target="_blank">http://webapp.toagroup.com/rvipo/</a> หากไม่สามารถเข้าระบบได้ โปรด ติดต่อ ส่วนงาน พัฒนาแอพพลิเคชั่น </b></td></tr><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-top:28px">	ขอแสดงความนับถือ</td></tr><tr height="16px"></tr><tr><td><table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12px;color:#b9b9b9;line-height:1.5"><tbody><tr><td>อีเมลนี้ไม่สามารถรับการตอบกลับได้ สำหรับข้อมูลเพิ่มเติม โปรดไปที่<a href="http://webapp.toagroup.com/rvipo/" style="text-decoration:none;color:#4285f4" target="_blank" data-saferedirecturl="http://webapp.toagroup.com/rvipo/">ศูนย์ช่วยเหลือของ TOA RVIPO SYSTEM</a></td></tr></tbody></table></td></tr></tbody></table>



</div>
</body>';
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

$mail->SetFrom('info@toagroup.com', 'TOA RVIPO SYSTEM ');

//$mail->AddReplyTo($temal,$temal);
//$mail->AddCC($temal, $temal);

$mail->Subject    = 'ขณะนี้มี บริษัท  '.$comname.' รอการตรวจสอบข้อมูลจากท่าน';

//$mail->AltBody    = "เรียนคู่ค้า"; // optional, comment out and test

$mail->MsgHTML($body );
$mail->CharSet = 'UTF-8';
$address = $temal;
$mail->AddAddress($address,$address);

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  //echo "Message sent!";
}

	

	} 
	
	public function toa_sendmail_vendor($staffname,$vemail,$temal,$comname){
		
			
    	
$mail             = new PHPMailer();

$body             = '<body style="margin: 10px;">
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
<div align="center"><img src="http://webapp.toagroup.com/rvipo/assets/images/mail/rvipo_mail_logo.gif" style="height: 90px; width: 340px"></div><br>




<table style="min-width:300px" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-bottom:4px"><strong style=" font-size:30px;">เรียน บริษัท '.$comname.'</strong> </td></tr><tr>
  <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding:4px 0">
  <strong>ขณะนี้ข้อมูลของบริษัทท่านอยู่ระหว่างการตรวจสอบข้อมูลจาก บริษัท ทีโอเอ เพ้นท์ (ประเทศไทย) จำกัด (มหาชน)  </strong> 
  <br/>
  บริษัท ได้ดำเนินการบันทึกข้อมูลของท่านเข้าระบบเรียบร้อยแล้ว ขณะนี้เจ้าหน้าที่ของเรากำลังตรวจสอบความถูกต้องข้อมูล บริษัทขอสงวนสิทธิ์ สำหรับบริษัทที่บันทึกข้อมูลไม่ถูกต้อง หากบริษัทของท่านผ่านการอนุมัติจากบริษัท ระบบจะส่ง E-mail แจ้งท่านอีกครั้ง   <wbr>   หากไม่สามารถเข้าระบบได้ โปรด ติดต่อ เจ้าหน้าที่ที่ท่านดำเนินการติดต่ออยู่ </b></td></tr><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-top:28px">	ขอแสดงความนับถือ</td></tr><tr height="16px"></tr><tr><td><table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12px;color:#b9b9b9;line-height:1.5"><tbody><tr><td>อีเมลนี้ไม่สามารถรับการตอบกลับได้ สำหรับข้อมูลเพิ่มเติม โปรดไปที่<a href="http://webapp.toagroup.com/rvipo/" style="text-decoration:none;color:#4285f4" target="_blank" data-saferedirecturl="http://webapp.toagroup.com/rvipo/">ศูนย์ช่วยเหลือของ TOA RVIPO SYSTEM</a></td></tr></tbody></table></td></tr></tbody></table>



</div>
</body>';
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

$mail->SetFrom('info@toagroup.com', 'TOA RVIPO SYSTEM ');

//$mail->AddReplyTo($temal,$temal);
//$mail->AddCC($temal, $temal);

$mail->Subject    = 'ขณะนี้ข้อมูลของท่านอยู่ระหว่างตรวจสอบจากเจ้าหน้าที่ของบริษัท';

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
  //echo "Message sent!";
}

	

	}

	
	
	
	

	public function update($where = NULL, $data = NULL)
	{
		if($where !== NULL)
			$this->db->where($where);
		$this->db->update($this->table_name, $data);
	}
	
	
	public function update2($table,$where = NULL, $data = NULL)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
			
	}

	public function delete($where = NULL)
	{
		if($where !== NULL)
			$this->db->where($where);
		$this->db->delete($this->table_name);
	}

	public function existing($where = NULL){
		$this->db->select('id');
		$this->db->from($this->table_name);
		
		if($where !== NULL)
			$this->db->where($where);
		else 
			return FALSE;

		$this->db->limit(1);
		
		$record = $this->db->get();

		if($record->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function all($start = NULL, $end = NULL, $order_by = NULL)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		
		if($order_by !== NULL)
			$this->db->order_by($order_by);
		else
			$this->db->order_by($this->default_order_by);

		if($start !== NULL && $end !== NULL)
			$this->db->limit($end, $start);
		else
			$this->db->limit($this->default_limit_end, $this->default_limit_start);
		
		$records = $this->db->get();

		if($records->num_rows() > 0){
			return $records->result();
		}else{
			return NULL;
		}
	}

	public function find($where = NULL, $start = NULL, $end = NULL, $order_by = NULL)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		
		if($where !== NULL)
			$this->db->where($where);

		if($order_by !== NULL)
			$this->db->order_by($order_by);
		else
			$this->db->order_by($this->default_order_by);

		if($start !== NULL && $end !== NULL)
			$this->db->limit($end, $start);
		else
			$this->db->limit($this->default_limit_end, $this->default_limit_start);
		
		$records = $this->db->get();

		if($records->num_rows() > 0){
			return $records->result();
		}else{
			return NULL;
		}
	}
	
	
	public function result($table= NULL, $where = NULL, $start = NULL, $end = NULL, $order_by = NULL)
	{
		$this->db->select('*');
		$this->db->from($table);
		
		if($where !== NULL)
			$this->db->where($where);

		if($order_by !== NULL)
			$this->db->order_by($order_by);
		else
			$this->db->order_by($this->default_order_by);

		if($start !== NULL && $end !== NULL)
			$this->db->limit($end, $start);
		else
			$this->db->limit($this->default_limit_end, $this->default_limit_start);
		
		$records = $this->db->get();

		if($records->num_rows() > 0){
			return $records->result();
		}else{
			return NULL;
		}
	}
	


}