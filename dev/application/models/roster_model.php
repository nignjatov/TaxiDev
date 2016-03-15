<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class Roster_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/RosterPayingEntity");
    }

    private function getUserID($rosterID) {
        $user_id = 0;
        $this->db->select('user_id');
        $this->db->from('wp_roster_paying');
        $this->db->where('ID', $rosterID);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $user_id = $result->user_id;
        }

        $query->free_result();

        return $user_id;
    }

    public function getRosterDetail($rosterID){
        $this->db->select("*");
        $this->db->where("ID", $rosterID);
        $this->db->from("wp_roster_paying");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        } else {
            return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
            return $this->returnData;
        }
    }

    public function getAllRoster($userID){
        $this->db->select('r.*, t.license_plate_no');
        $this->db->from('wp_roster_paying AS r');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('r.user_id', $userID);
        $this->db->where('r.taxi_id', 't.ID', false);
        $this->db->order_by('paying_date', 'DESC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allRoster = array();
        $count = 0;
        foreach ($result AS $rosterInfo) {
            $rosterInfo->paying_date = $rosterInfo->paying_date > 0 ? $this->timezone->convertMKTimeToDate($rosterInfo->paying_date) : '';
            $allRoster[$count++] = $rosterInfo;
        }

        return parent::returnData($allRoster);
    }

    public function getAllRosterWithDateRange($userID, $allTaxi, $start_date, $end_date){
        $dates = $this->timezone->getInBetweenDates($start_date, $end_date);
//        $this->util->echoObject($dates);
//        $this->util->echoObject($allTaxi);
        $this->db->select('r.*, t.license_plate_no');
        $this->db->from('wp_roster_paying AS r');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('r.user_id', $userID);
        $this->db->where('r.taxi_id', 't.ID', false);
        if (strcmp($start_date, '') != 0) {
            $this->db->where('r.paying_date >=', $start_date);
        }

        if (strcmp($end_date, '') != 0) {
            $this->db->where('r.paying_date <=', $end_date + (24 * 3600) - 1);
        }

        $this->db->order_by('license_plate_no', 'ASC');
        $this->db->order_by('paying_date', 'ASC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allRoster = array();
        $count = 0;
        foreach ($result AS $rosterInfo) {
            $rosterInfo->paying_date = $rosterInfo->paying_date > 0 ? $this->timezone->convertMKTimeToDate($rosterInfo->paying_date) : '';
            $allRoster[$count++] = $rosterInfo;
        }

//        $this->util->echoObject($allRoster);

        if(empty($allRoster)) {
            $fields = $this->db->list_fields('wp_roster_paying');
//            $this->util->echoObject($fields);

            $allRoster[0] = new stdClass();
            foreach ($fields AS $key) {
                $allRoster[0]->$key = '';
            }

            $allRoster[0]->license_plate_no = '';
        }

        $roster_info = array();
        $count = 0;
        $shifts = array('Morning', 'Evening');

        foreach($allTaxi AS $taxi) {
            foreach($dates AS $date) {
                foreach($shifts AS $shift) {
                    foreach($allRoster AS $roster) {
                        if (strcmp($taxi->ID, $roster->taxi_id) == 0 && strcmp($date, $roster->paying_date) == 0 && strcmp($shift, $roster->shift) == 0) {
                            $roster_info[$count++] = $roster;
                        } else {
                            foreach($roster AS $key => $value) {
                                switch($key) {
                                    case 'taxi_id':
                                        $roster_info[$count]->taxi_id = $taxi->ID;
                                        break;
                                    case 'user_id':
                                        $roster_info[$count]->user_id = $taxi->user_id;
                                        break;
                                    case 'license_plate_no':
                                        $roster_info[$count]->license_plate_no = $taxi->license_plate_no;
                                        break;
                                    case 'paying_date':
                                        $roster_info[$count]->paying_date = $date;
                                        break;
                                    case 'shift':
                                        $roster_info[$count]->shift = $shift;
                                        break;
                                    default:
                                        $roster_info[$count]->$key = '';
                                        break;
                                }
                            }
                            $count++;
                        }
                    }
                }
            }
        }

//        $this->util->echoObject($roster_info);

        return parent::returnData($roster_info);
    }

    public function getAllTaxiRoster($userID, $taxiID){
        $this->db->select('r.*, t.license_plate_no');
        $this->db->from('wp_roster_paying AS r');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('r.user_id', $userID);
        $this->db->where('r.taxi_id', 't.ID', false);
        $this->db->where('r.taxi_id', $taxiID);
        $this->db->order_by('paying_date', 'DESC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allRoster = array();
        $count = 0;
        foreach ($result AS $rosterInfo) {
            $rosterInfo->paying_date = $rosterInfo->paying_date > 0 ? $this->timezone->convertMKTimeToDate($rosterInfo->paying_date) : '';
            $allRoster[$count++] = $rosterInfo;
        }

        return parent::returnData($allRoster);
    }

    public function getLatestEntryForTaxi($taxiID){
        $this->db->select('r.*');
        $this->db->from('wp_roster_paying AS r');
        $this->db->where('r.taxi_id', $taxiID);
        $this->db->order_by('paying_date', 'DESC');
        $this->db->limit(1);

        $result = $this->db->get()->result();

        return parent::returnData($result);
    }

    public function addRoster($userID) {
        $newRosterEntity = new RosterPayingEntity();
        $newRosterEntity->user_id = $userID;
        $newRosterEntity->taxi_id = $this->input->post('taxi_id');
        $newRosterEntity->shift = $this->input->post('shift');
        $newRosterEntity->is_leased = $this->input->post('is_leased');
        $newRosterEntity->driver_name = $this->input->post('driver_name');
        $newRosterEntity->is_paid = $this->input->post('is_paid');
        $newRosterEntity->amount_paid = $this->input->post('amount_paid');
        $newRosterEntity->mf_amount = $this->input->post('mf_amount');
        $newRosterEntity->m7_amount = $this->input->post('m7_amount');
        $newRosterEntity->cash_amount = $this->input->post('cash_amount');
        $newRosterEntity->fine_toll_amount = $this->input->post('fine_toll_amount');
        $newRosterEntity->expenses = $this->input->post('expenses');

        $paying_date = $this->input->post('paying_date');
        if (!empty($paying_date)) {
            $newRosterEntity->paying_date = $this->timezone->convertDateToMKTime($paying_date);
        }

		/* Ensure that taxi can be rented only once specific shift in a day */
		$this->db->select('*');
        $this->db->from('wp_roster_paying');
        $this->db->where('paying_date', $newRosterEntity->paying_date);
		$this->db->where('shift', $newRosterEntity->shift);
		$this->db->where('taxi_id', $newRosterEntity->taxi_id);
		$is_already_rented = $this->db->get()->result();
        if (!empty($is_already_rented)) {
            return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
        }

        $newRosterEntity->comment = $this->input->post('comment');

//        echo $this->db->last_query().'<br>;
        if ($this->db->insert('wp_roster_paying', $newRosterEntity)) {
            return parent::returnData($this->db->insert_id());
        }

        return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
    }

    public function addRosterTemplate($userID,$taxiId,$shift,$mkTime) {
        $newRosterEntity = new RosterPayingEntity();

        $newRosterEntity->user_id = $userID;
        $newRosterEntity->taxi_id = $taxiId;
        $newRosterEntity->shift = $shift;
        $newRosterEntity->paying_date = $mkTime;


        //blank data
        $newRosterEntity->is_leased = '0';
        $newRosterEntity->driver_name = '';
        $newRosterEntity->is_paid = '0';
        $newRosterEntity->amount_paid = '';
        $newRosterEntity->mf_amount = '';
        $newRosterEntity->m7_amount = '';
        $newRosterEntity->cash_amount = '';
        $newRosterEntity->fine_toll_amount = '';
        $newRosterEntity->expenses = '';

        if ($this->db->insert('wp_roster_paying', $newRosterEntity)) {
            return parent::returnData($this->db->insert_id());
        }

        return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
    }

    public function updateRoster($userID, $rosterID) {
        if ($userID == $this->getUserID($rosterID)) {
            $newRosterEntity = new RosterPayingEntity();
            $newRosterEntity->user_id = $userID;
            $newRosterEntity->taxi_id = $this->input->post('taxi_id');
            $newRosterEntity->shift = $this->input->post('shift');
            $newRosterEntity->is_leased = $this->input->post('is_leased');
            $newRosterEntity->driver_name = $this->input->post('driver_name');
            $newRosterEntity->is_paid = $this->input->post('is_paid');
            $newRosterEntity->amount_paid = $this->input->post('amount_paid');
            $newRosterEntity->mf_amount = $this->input->post('mf_amount');
            $newRosterEntity->m7_amount = $this->input->post('m7_amount');
            $newRosterEntity->cash_amount = $this->input->post('cash_amount');
            $newRosterEntity->fine_toll_amount = $this->input->post('fine_toll_amount');
            $newRosterEntity->expenses = $this->input->post('expenses');

            $paying_date = $this->input->post('paying_date');
            if (!empty($paying_date)) {
                $newRosterEntity->paying_date = $this->timezone->convertDateToMKTime($paying_date);
            }

            $newRosterEntity->comment = $this->input->post('comment');

//        echo $this->db->last_query().'<br>;

            $this->db->where("ID", $rosterID, false);
            $this->db->where("user_id", $userID, false);

            if ($this->db->update('wp_roster_paying', $newRosterEntity)) {
                return parent::returnData($rosterID);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }

    public function removeRoster($userID, $rosterID) {
        if ($userID == $this->getUserID($rosterID)) {
            $this->db->where("ID", $rosterID, false);
            if ($this->db->delete('wp_roster_paying')) {
                return parent::returnData(true);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }
	
	/* Descriptin:
	* Optimized query with limits, sorts and filters
	* SELECT  * FROM wp_roster_paying AS t FORCE INDEX (PRIMARY) 
	* JOIN ( 
	* 	SELECT ID FROM wp_roster_paying 
	* 	WHERE ... (ALL FILTERS)
	* 	ORDER BY ... DESC/ASC
	* ) AS t_temp ON t.ID = t_temp.ID 
	* LIMIT 10
	* 
	* if sort taxi_id then join taxis table:
	* SELECT * FROM wp_roster_paying AS t  
	* JOIN ( 
	* 	SELECT r.ID FROM wp_roster_paying AS r 
	* 	JOIN wp_taxi_details AS r_temp ON r.taxi_id = r_temp.ID
	* 	WHERE ... (ALL FILTERS)
	* 	ORDER BY r_temp.license_plate_no DESC 
	* ) AS t_temp ON t.ID = t_temp.ID  
	* LIMIT 10
	*/
	public function getRosters( $userID, $taxiID, $num, $from, $dateFrom, $dateTo, $sortField, $sort, $search) {	
		$request = 'SELECT * FROM wp_roster_paying AS t ';
		
		$request = $request . ' JOIN ( SELECT r.ID FROM wp_roster_paying AS r ';
	
		if($sortField=='taxi_id' && $sort)
			$request = $request . ' JOIN wp_taxi_details AS r_temp ON r.taxi_id = r_temp.ID ';
	
		$request = $request . ' WHERE r.user_id=' . $userID;
  
		if($dateFrom)
			$request = $request . ' AND r.paying_date >= '. $dateFrom;
  
		if($dateTo)
			$request = $request . ' AND r.paying_date <= '. $dateTo;
  
		if($taxiID && !is_array($taxiID))
			$request = $request . ' AND r.taxi_id = '. $taxiID;
		
		if($search) {
			$requestTaxis = "";
			if($taxiID  && is_array($taxiID)) {
				$taxiIDCnt = 0;
			
				foreach ($taxiID as $value) {
					if($taxiIDCnt == 0)
						$requestTaxis = $requestTaxis . 'r.taxi_id IN ('. $value;
					else
						$requestTaxis = $requestTaxis . ','. $value;
					$taxiIDCnt = $taxiIDCnt + 1;
				}
				if($taxiIDCnt > 0)
					$requestTaxis = $requestTaxis . ') OR';
			}
		
			$yesNo = "";
			if($search == "Yes" || $search == "yes"){
				$yesNo = "OR r.is_leased=1 OR r.is_paid=1";
			} else if($search == "No" || $search == "no"){
				$yesNo = "OR r.is_leased=0 OR r.is_paid=0";
			}
			
			$request = $request . ' AND (' . $requestTaxis . ' r.driver_name LIKE \'%' . $search . '%\' OR r.amount_paid LIKE \'%' . $search . '%\' OR r.shift LIKE \'%' . $search . '%\' ' . $yesNo . ')';
		}
		
		if($sortField == "taxi_id" && $sort)
			$request = $request . ' ORDER BY r_temp.license_plate_no ' . $sort;
		else if($sortField && $sort)
			$request = $request . ' ORDER BY r.' . $sortField . ' ' . $sort;

		$request = $request . ' ) AS t_temp ON t.ID = t_temp.ID ';	
			
		if($from == 0 && $num)
			$request = $request . ' LIMIT '. $num;
		else if($from && $num)
			$request = $request . ' LIMIT ' . $from . ',' . $num;

		return $this->db->query($request)->result();
	}	
	
	/*
	* Description: Standard select where forcing index on sort
	* SELECT * FROM wp_roster_paying as t FORCE INDEX (PRIMARY) 
	* WHERE ... (ALL FILTERS)
	* ORDER BY ... DESC/ASC 
	* LIMIT 10
	*
	* if sort taxi_id then join taxis table:
	* SELECT * FROM wp_roster_paying as t FORCE INDEX (PRIMARY) 
	* JOIN wp_taxi_details AS temp ON t.taxi_id = temp.ID
	* WHERE ... (ALL FILTERS)
	* ORDER BY temp.license_plate_no DESC/ASC 
	* LIMIT 10
	*/
	public function getRosters_BACKUP( $userID, $taxiID, $num, $from, $dateFrom, $dateTo, $sortField, $sort, $search) {
		$forceIndex = "";
		if($sortField && $sort) {
			$forceIndex = "FORCE INDEX (PRIMARY)";
			
			/* sort by taxi plate -> join taxi table */
			if($sortField == "taxi_id")
				$forceIndex = $forceIndex . " JOIN wp_taxi_details AS temp ON t.taxi_id = temp.ID ";
		}	
		
		$request = 'SELECT * FROM wp_roster_paying AS t ' . $forceIndex . ' WHERE t.user_id=' . $userID;
  
		if($dateFrom)
			$request = $request . ' AND t.paying_date >='. $dateFrom;
  
		if($dateTo)
			$request = $request . ' AND t.paying_date <='. $dateTo;
  
		if($taxiID && !is_array($taxiID))
			$request = $request . ' AND t.taxi_id='. $taxiID;
		
		if($search) {
			$requestTaxis = "";
			if($taxiID  && is_array($taxiID)) {
				$taxiIDCnt = 0;
			
				foreach ($taxiID as $value) {
					if($taxiIDCnt == 0)
						$requestTaxis = $requestTaxis . 't.taxi_id IN ('. $value;
					else
						$requestTaxis = $requestTaxis . ','. $value;
					$taxiIDCnt = $taxiIDCnt + 1;
				}
				if($taxiIDCnt > 0)
					$requestTaxis = $requestTaxis . ') OR';
			}
		
			$yesNo = "";
			if($search == "Yes" || $search == "yes"){
				$yesNo = "OR t.is_leased=1 OR t.is_paid=1";
			} else if($search == "No" || $search == "no"){
				$yesNo = "OR t.is_leased=0 OR t.is_paid=0";
			}
			
			$request = $request . ' AND (' . $requestTaxis . ' t.driver_name LIKE \'%' . $search . '%\' OR t.amount_paid LIKE \'%' . $search . '%\' OR t.shift LIKE \'%' . $search . '%\' ' . $yesNo . ')';
		}
		
		if($sortField == "taxi_id" && $sort)
			$request = $request . ' ORDER BY temp.license_plate_no ' . $sort;
		else if($sortField && $sort)
			$request = $request . ' ORDER BY t.' . $sortField . ' ' . $sort;

		if($from == 0 && $num)
			$request = $request . ' LIMIT '. $num;
		else if($from && $num)
			$request = $request . ' LIMIT ' . $from . ',' . $num;

		return $this->db->query($request)->result();
	
		/*$this->db->select("*");
        $this->db->where("user_id", $userID);
        
		if($taxiID)
			$this->db->where('taxi_id', $taxiID);
		
		if($dateFrom)
			$this->db->where('paying_date >=', $dateFrom);
		
		if($dateTo)
			$this->db->where('paying_date <=', $dateTo);
		
		if($from == 0 && $num)
			$this->db->limit($num);
		else if($from && $num)
			$this->db->limit($num, $from);
		
		if($search && $searchField) 
			$this->db->like($searchField, $search);
		
		if($sortField && $sort)
			$this->db->order_by($sortField, $sort);
		
		$this->db->from("wp_roster_paying");
		
        return $this->db->get()->result();*/
    }
	
	public function getRostersCount( $userID, $taxiID, $dateFrom, $dateTo, $search ) {
		$request = 'SELECT COUNT(*) FROM wp_roster_paying WHERE user_id=' . $userID;
  
		if($dateFrom)
			$request = $request . ' AND paying_date >='. $dateFrom;
  
		if($dateTo)
			$request = $request . ' AND paying_date <='. $dateTo;
  
		if($taxiID && !is_array($taxiID))
			$request = $request . ' AND taxi_id='. $taxiID;
		
		if($search) {
			$requestTaxis = "";
			if($taxiID  && is_array($taxiID)) {
				$taxiIDCnt = 0;
			
				foreach ($taxiID as $value) {
					if($taxiIDCnt == 0)
						$requestTaxis = $requestTaxis . 'taxi_id IN ('. $value;
					else
						$requestTaxis = $requestTaxis . ','. $value;
					$taxiIDCnt = $taxiIDCnt + 1;
				}
				if($taxiIDCnt > 0)
					$requestTaxis = $requestTaxis . ') OR';
			}
		
			$yesNo = "";
			if($search == "Yes" || $search == "yes"){
				$yesNo = "OR is_leased=1 OR is_paid=1";
			} else if($search == "No" || $search == "no"){
				$yesNo = "OR is_leased=0 OR is_paid=0";
			}
			
			$request = $request . ' AND (' . $requestTaxis . ' driver_name LIKE \'%' . $search . '%\' OR amount_paid LIKE \'%' . $search . '%\' OR shift LIKE \'%' . $search . '%\' ' . $yesNo . ')';
		}
		
		$query = $this->db->query($request);
		foreach ($query->result_array() as $row) {
			return intval($row["COUNT(*)"]);
		}
		return null;
		
		/*$this->db->select("*");
        $this->db->where("user_id", $userID);
        
		if($taxiID)
			$this->db->where('taxi_id', $taxiID);
		
		if($dateFrom)
			$this->db->where('paying_date >=', $dateFrom);
		
		if($dateTo)
			$this->db->where('paying_date <=', $dateTo);

		if($search && $searchField) 
			$this->db->like($searchField, $search);
		
		$this->db->from("wp_roster_paying");
		
        return $this->db->count_all_results();*/
    }
	
	public function dummy($userID) {
	
		for ($i = 1; $i <= 50000; $i++) {
			$str = substr(sha1(rand()), 0, 5);
			
			$newRosterEntity = new RosterPayingEntity();
			$newRosterEntity->user_id = rand(666,999);
			$newRosterEntity->taxi_id = rand(666,999);
			$newRosterEntity->shift = (rand(0,1) == 0) ? "Evening" : "Morning";
			$newRosterEntity->is_leased = rand(0,1);
			$newRosterEntity->driver_name = $str."_".$i;
			$newRosterEntity->is_paid = rand(0,1);
			$newRosterEntity->amount_paid = rand(0,1000);
			$newRosterEntity->mf_amount = rand(0,1000);
			$newRosterEntity->m7_amount = rand(0,1000);
			$newRosterEntity->cash_amount = rand(0,1000);
			$newRosterEntity->fine_toll_amount = rand(0,1000);
			$newRosterEntity->expenses = rand(0,1000);
			$newRosterEntity->comment = $str."_comment".$i;
			$newRosterEntity->paying_date = time() ;
		
			$this->db->insert('wp_roster_paying', $newRosterEntity);
		}	
    }
}