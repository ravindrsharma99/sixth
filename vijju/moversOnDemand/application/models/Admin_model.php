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
	public function math($f) {
        $c = (int) (($f) + 0.5*$f);
        $n = $f + 0.5*$f;
        return ($n - $c) % 2 == 0 ? (int) $f : $c;
    		}
	public function secondsToTime($est_time) {
	$minutes = $this->math($est_time / 60);
        $hours = $this->math($minutes / 60);
        $days = $this->math($hours % 24);
        $month = $days % 31;
        $years = $month % 12;
	$strTime = "";
        if ($est_time > 0) {
            if ($est_time < 60) {
                $strTime = "1 Minutes";
            } else {
                if ($minutes < 60) {
	            $strTime = $minutes . " Minutes";
                } else {
                    if ($hours < 24) {
                        $strTime = $hours . " Hours";
                    } else {
                        if ($hours == 24) {
                            $strTime = "1 Day";
                        } else if ($hours > 24) {
                            $strTime = ($days > 1 && $days < 30) ? $days + " Days"
                                    : ($days == 30 || $days == 31) ? "1 Month"
                                    : ($days > 30) ? ($month > 12) ? (($years > 1) ? $years . " Years" : "1 Year")
                                    : $month ." Month"
                                    : "1 Day";
                        }
                    }
                }
            }
        } else {
            $strTime = "0 Minutes";
        }
	 

	    return $strTime;
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
	public function commomlog($select,$table,$where){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$sel = $this->db->get()->result();
		return $sel;
	}
	

}




