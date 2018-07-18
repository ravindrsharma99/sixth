<?php
class Admin_model extends CI_Model {

	function login($email, $password) {
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

    public function record_count() {
        return $this->db->count_all("tbl_login");
    }

    public function fetch_countries($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("tbl_login");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }



	public function user_list(){
		$data = $this->db->get_where('tbl_users', array('user_Type' => 1))->result();
		return $data;
	}
	public function driver_list(){
		$data = $this->db->get_where('tbl_users', array('user_Type' => 2))->result();
		return $data;
	}
	
	public function pending_booking_list(){

		$this->db->select('*,tbl_booking.id as booked_id,tbl_vechicleType.name as vehiclename');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_vechicleType', 'tbl_vechicleType.id = tbl_booking.vehicle_id');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_booking.user_id');
		$this->db->join('tbl_moveType', 'tbl_moveType.id = tbl_booking.moveType_id');
		$this->db->where('tbl_booking.is_accepted',0);
		$this->db->where('tbl_booking.is_started', 0);
		$this->db->where('tbl_booking.is_completed', 0);
		$this->db->where('tbl_booking.is_cancelled', 0);

		$data = $this->db->get()->result();
			// echo "<pre>";
			// print_r($data);die();
		return $data;
	}
	public function started_booking_list(){

		$this->db->select('*,tbl_booking.id as booked_id,tbl_vechicleType.name as vehiclename');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_vechicleType', 'tbl_vechicleType.id = tbl_booking.vehicle_id');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_booking.user_id');
		$this->db->join('tbl_moveType', 'tbl_moveType.id = tbl_booking.moveType_id');
		//$this->db->where('name !=', $name);
        //$this->db->or_where('id >', $id);
		$this->db->where('tbl_booking.is_accepted',1);
		$this->db->or_where('tbl_booking.is_started', 1);
		$this->db->where('tbl_booking.is_completed', 0);
		$this->db->where('tbl_booking.is_cancelled', 0);

		$data = $this->db->get()->result();
		return $data;
	}
	public function completed_booking_list(){

		$this->db->select('*,tbl_booking.id as booked_id,tbl_vechicleType.name as vehiclename');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_vechicleType', 'tbl_vechicleType.id = tbl_booking.vehicle_id');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_booking.user_id');
		$this->db->join('tbl_moveType', 'tbl_moveType.id = tbl_booking.moveType_id');
		$this->db->where('tbl_booking.is_completed', 1);

		$data = $this->db->get()->result();
		return $data;
	}
	public function cancelled_booking_list(){

		$this->db->select('*,tbl_booking.id as booked_id,tbl_vechicleType.name as vehiclename');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_vechicleType', 'tbl_vechicleType.id = tbl_booking.vehicle_id');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_booking.user_id');
		$this->db->join('tbl_moveType', 'tbl_moveType.id = tbl_booking.moveType_id');
		$this->db->where('tbl_booking.is_cancelled', 1);

		$data = $this->db->get()->result();
		return $data;
	}
	public function booking_detail($id){
		$this->db->select('*, tbl_booking.id,tbl_vechicleType.icon as vehicleimage');
		$this->db->from('tbl_booking');
		$this->db->where('tbl_booking.id',$id);
		$this->db->join('tbl_vechicleType', 'tbl_vechicleType.id = tbl_booking.vehicle_id');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_booking.user_id');
		$this->db->join('tbl_moveType', 'tbl_moveType.id = tbl_booking.moveType_id');
		$data = $this->db->get()->result();
		return $data;
	}
	public function move_list(){
		$data=$this->db->get('tbl_moveType')->result();
		return $data;
	}
	public function vechicle_list(){
		$data=$this->db->get('tbl_vechicleType')->result();
		return $data;
	}
	public function transaction_list(){
		$this->db->select('*,tbl_transactions.id as deleteid');
		$this->db->from('tbl_transactions');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_transactions.user_id');
		$data = $this->db->get()->result();
		return $data;
	}
	public function wallet_customerlist(){
		$this->db->select('*');
		$this->db->from('tbl_wallet');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_wallet.user_id');
		$this->db->where('user_Type',1);
		$data = $this->db->get()->result();
		return $data;
	}
	public function wallet_driverlist(){
		$this->db->select('*,tbl_users.fb_signUp as outsandingAmount');
		$this->db->from('tbl_wallet');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_wallet.user_id',left);
		$this->db->join('tbl_driversFund','tbl_driversFund.driver_id=tbl_wallet.user_id');
		$this->db->where('tbl_users.user_Type',2);
		$data = $this->db->get()->result();
		// echo "<pre>"; print_r($data);die();
		foreach ($data as $key => $value) {
			$query=$this->db->query("SELECT * from tbl_booking where driver_id = $value->user_id")->result();
			$data12=array();
			foreach ($query as $key => $value12) {
				$data12[] = $value12->total_price;
			}
			$value->outsandingAmount=array_sum($data12);

		}
		// echo "<pre>";	print_r($data);die();
		return $data;
	}
	// wallet_list
	public function promocode_list(){
		$data=$this->db->get('tbl_promocode')->result();
		return $data;
	}
	public function setting_list(){
		$data=$this->db->get('tbl_setting')->result();
		// print_r($data);
		return $data;
	}
	public function delete($id,$table){
		$this->db->where('id', $id);
		$data= $this->db->delete($table);
		return $data;
	}

	public function countdata(){
		$data=$this->db->get('tbl_users')->result();
		return $data;
	}
	public function usercommercial($id){
		$this->db->set('is_commercial', '1');
		$this->db->where('id', $id);
		$data=$this->db->update('tbl_users');
		return $data;
	}
	public function usernormal($id){
		$this->db->set('is_commercial', '0');
		$this->db->where('id', $id);
		$data=$this->db->update('tbl_users');
		return $data;
	}
	public function update_data($tbl_name,$data,$where){                                 /* Update data */

		$this->db->where($where);
		$this->db->update($tbl_name,$data);
		return($this->db->affected_rows())?1:0;
	}
	public function select_data($selection,$tbl_name,$where=null,$order=null)                   /* Select data with condition*/
	{
		if (empty($where)&&empty($order)) {
			$data_response = $this->db->select($selection)
			->from($tbl_name)
			->get()->result();
		}
		elseif(empty($order)){
			$data_response =
			$this->db->select($selection)
			->from($tbl_name)
			->where($where)
			->get()->result();

		}else{
			$data_response =
			$this->db->select($selection)
			->from($tbl_name)
			->where($where)
			->order_by($order)
			->get()->result();
		}
		return $data_response;

	}
	public function bookmove($data){

		$gettime= $this->db->query("select buffer_time from tbl_setting")->row();
		$time=$gettime->buffer_time;
		$getdata= $this->db->query("SELECT a.id,a.email,b.token_id,b.device_id,(select buffer_time from tbl_setting) as timed, ( 3959 * acos( cos( radians(30.5455) ) * cos( radians( latitude ) ) * cos( radians(longitude) - radians(72.0554) ) + sin( radians(30.5455) ) * sin( radians( latitude ) ) ) ) as distance FROM`tbl_users` AS a JOIN tbl_login AS b ON a.id = b.user_id WHERE a.user_Type = 2 AND a.id NOT IN ( SELECT driver_id  FROM `tbl_booking`  WHERE CONCAT('".$data['booking_date']."', ' ', '".$data['booking_time']."') BETWEEN CONCAT(booking_date, ' ', booking_time) AND DATE_ADD(CONCAT(booking_date, ' ', booking_time) , INTERVAL ('".$data['time_duration']."' + (('".$time."')*2)) MINUTE) OR DATE_ADD(CONCAT('".$data['booking_date']."', ' ', '".$data['booking_time']."'), INTERVAL('".$data['time_duration']."' + (('".$time."')*2)) MINUTE) BETWEEN CONCAT(booking_date, ' ', booking_time) AND DATE_ADD(CONCAT(booking_date, ' ', booking_time) , INTERVAL ('".$data['time_duration']."' + (('".$time."')*2)) MINUTE))")->result();
			// print_r($getdata);die();
		return $getdata;
	}
	public function freeServiceProviders($minTime,$maxTime)
	{
		$list = $this->db->query("SELECT * FROM `tbl_users`
			where (user_type=2 or user_type=3) and (id not in (SELECT accepted_by FROM `tbl_bookingRequests`
			where accepted_by!=0 and (TIMESTAMP(booking_date,booking_time)<= '$minTime' and DATE_ADD(TIMESTAMP(booking_date,booking_time), INTERVAL `hours` HOUR)>= '$maxTime' )) or id not in (SELECT accepted_by FROM `tbl_bookingRequests`) )")->result();
		// print_r($this->db->last_query());
		return $list;
	}
	

}




