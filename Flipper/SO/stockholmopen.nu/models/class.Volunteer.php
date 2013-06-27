<?php
require_once("class.Model.php");

class Volunteer extends Model
{
	public function insert($a_sFirstName, $a_sLastName, $a_sEmail, $a_sPhoneMobile, $a_iTotalHours)
	{
		$sQuery = sprintf("INSERT INTO volunteers
						(vol_firstname, vol_lastname, vol_email, vol_phone_mobile, vol_hours) 
						VALUES ('%s', '%s', '%s', '%s', %d)",
						$this->oDB->escape($a_sFirstName),
						$this->oDB->escape($a_sLastName),
						$this->oDB->escape($a_sEmail),
						$this->oDB->escape($a_sPhoneMobile),
						$this->oDB->escape($a_iTotalHours));
		$this->oMDB2Wrapper->query("exec", $sQuery);	

		// get last insert id
		$sQuery = "SELECT LAST_INSERT_ID(id_vol) AS id_last
					FROM volunteers";
				
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		$iCount = count($aRes);
		return $aRes[$iCount-1]['id_last'];								
	}

	public function getDuties()
	{
		$sQuery = "SELECT * FROM volunteer_duties
					ORDER BY id_vol_duty ASC";
	
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes;			
	}
	
	public function getTimes()
	{
		$sQuery = "SELECT * FROM volunteer_times
					ORDER BY vol_time_start ASC";
	
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes;					
	}
	
	public function insertTimes($a_aTimeIDs, $a_iIDVolunteer)
	{
		foreach($a_aTimeIDs as $val)
		{
			$sQuery = sprintf("INSERT INTO volunteers_to_times
							(volunteers_id_vol, volunteer_times_id_vol_time) 
							VALUES (%d, %d)",
							$this->oDB->escape($a_iIDVolunteer),
							$this->oDB->escape($val));
			$this->oMDB2Wrapper->query("exec", $sQuery);				
		}
	}
	
	public function insertDuties($a_aDutyIDs, $a_iIDVolunteer)
	{
		foreach($a_aDutyIDs as $val)
		{
			$sQuery = sprintf("INSERT INTO volunteers_to_duties
							(volunteers_id_vol, volunteer_duties_id_vol_duty) 
							VALUES (%d, %d)",
							$this->oDB->escape($a_iIDVolunteer),
							$this->oDB->escape($val));
			$this->oMDB2Wrapper->query("exec", $sQuery);				
		}
	}
	
	public function getNumberForTime($a_iIDTime)
	{
		$sQuery = sprintf("SELECT COUNT(id_vtt) AS count
							FROM volunteers_to_times
							WHERE volunteer_times_id_vol_time = %d",
							$this->oDB->escape($a_iIDTime));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['count'];				
	}

	public function getSchedule()
	{
		$aSchedule = $this->getTimes();
		$i = 0;
		foreach($aSchedule as $val)
		{
			$aVolunteersAndDuties = $this->getVolunteersAndDutiesForTime($val['id_vol_time']);
			$aSchedule[$i]['volunteers'] = $aVolunteersAndDuties;
			$i++;
		}
		
		return $aSchedule;
	}
	
	public function getVolunteersAndDutiesForTime($a_iIDTime)
	{
		$aVolunteersForTime = $this->getVolunteersForTime($a_iIDTime);
		$i = 0;
		
		foreach($aVolunteersForTime as $val)
		{
			$aVolunteerDuties = $this->getDutiesForVolunteer($val['id_vol']);
			$aVolunteersForTime[$i]['duties'] = $aVolunteerDuties;
			
			$i++;			
		}
		
		return $aVolunteersForTime;
	}
	
	public function getVolunteersForTime($a_iIDTime)
	{
		$sQuery = sprintf("SELECT DISTINCT(volunteers.vol_firstname), volunteers.*
							FROM volunteers
							JOIN volunteers_to_times
							ON volunteers.id_vol = volunteers_to_times.volunteers_id_vol
							WHERE volunteers_to_times.volunteer_times_id_vol_time = %d",
							$this->oDB->escape($a_iIDTime));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;
	}
	
	public function getDutiesForVolunteer($a_iIDVolunteer)
	{
		$sQuery = sprintf("SELECT volunteer_duties.*
							FROM volunteer_duties
							JOIN volunteers_to_duties
							ON volunteer_duties.id_vol_duty = volunteers_to_duties.volunteer_duties_id_vol_duty
							WHERE volunteers_to_duties.volunteers_id_vol = %d",
							$this->oDB->escape($a_iIDVolunteer));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;		
	}
	
	public function getTopVolunteers($a_iNumber = 10)	
	{
		$sQuery = sprintf("SELECT *
							FROM volunteers
							ORDER BY vol_hours DESC",
							$this->oDB->escape($a_iNumber));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;		
	}
	
	public function getVolunteers()
	{
		$sQuery = sprintf("SELECT *
							FROM volunteers
							ORDER BY vol_firstname ASC");
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;
	}
}
?>