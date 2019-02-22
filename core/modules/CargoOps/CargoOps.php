<?php
	class CargoOps extends CodonModule
	{

		public function index()
		{
			/** Check Contract Expiry**/
			CargoOpsData::CheckContractExpiry();
			 
			$settings = CargoOpsData::getsettings();
		 

if($settings->cronjobactive == '0')
{

			 /**Create Contracts**/
			$contractcount = CargoOpsData::countcontracts();
			$missingcontracts = ($settings->contractnumber - $contractcount);
		
			if($missingcontracts > 0)
			{
			CargoOpsData::CreateContracts();
			return self::index();
			}
			 }


			$this->set('settings', $settings);
  if(Config::Get('RESTRICT_AIRCRAFT_RANKS') === true && Auth::LoggedIn())
        {
			$this->set('contracts', CargoOpsData::getavailablecontracts());
			}
else
{
$this->set('contracts', CargoOpsData::getallcontracts());
}
 	$this->render('cargoops/index.tpl');
			$this->render('cargoops/menu.tpl');
			$this->render('cargoops/contracts.tpl');
		}

public function contractdetails($cid)
		{
			$this->set('settings', CargoOpsData::getsettings());
			$this->set('contract', CargoOpsData::getcontractdetails($cid));
		
 	$this->render('cargoops/index.tpl');
			$this->render('cargoops/menu.tpl');
			$this->render('cargoops/details.tpl');
		}
		
		public function fleet()
		{
			$this->set('settings', CargoOpsData::getsettings());
			$this->set('aircraft', CargoOpsData::getcargofleet());
		
	$this->render('cargoops/index.tpl');
			$this->render('cargoops/menu.tpl');
			$this->render('cargoops/fleet.tpl');
		}
		
		 public function history()
		{
			$this->set('settings', CargoOpsData::getsettings());
			$this->set('pireps', CargoOpsData::getflighthistory(Auth::$userinfo->pilotid));

				$this->render('cargoops/index.tpl');
			$this->render('cargoops/menu.tpl');
			$this->render('cargoops/history.tpl');
		}

public function addbid($cid)
	{
		if(!Auth::LoggedIn()) return;
				
		$routeid = $cid;
		
		if($routeid == '')
		{
			echo 'No route passed';
			return;
		}

$altitude = DB::escape($this->post->altitude);
$flightroute = DB::escape($this->post->flightroute);

$routeid = CargoOpsData::processbid($cid, $altitude, $flightroute);

CargoOpsData::deletecontract($cid);
		
		// See if this is a valid route
		$route = SchedulesData::findSchedules(array('s.id' => $routeid));
		
		if(!is_array($route) && !isset($route[0]))
		{
			echo 'Invalid Route';
			return;
		}
		
		CodonEvent::Dispatch('bid_preadd', 'Schedules', $routeid);
		
		/* Block any other bids if they've already made a bid
		 */
		if(Config::Get('DISABLE_BIDS_ON_BID') == true)
		{
			$bids = SchedulesData::getBids(Auth::$userinfo->pilotid);
			
			# They've got somethin goin on
			if(count($bids) > 0)
			{
				echo 'Bid exists!';
				return;
			}
		}
		
		$ret = SchedulesData::AddBid(Auth::$userinfo->pilotid, $routeid);
		CodonEvent::Dispatch('bid_added', 'Schedules', $routeid);
		
		if($ret == true)
		{
			$this->render('cargoops/bidadded.tpl');
		}
		else
		{
			$this->render('cargoops/biderror.tpl');
		}
	}



public function __construct()
{
 CodonEvent::addListener('CargoOps', array('pirep_filed'));
}

public function EventListener($eventinfo)
{
 $eventname = $eventinfo[0]; // Event name
 $eventmodule = $eventinfo[1]; // Class calling it
 	$settings = CargoOpsData::getsettings();
if($eventinfo[0] == 'pirep_filed')
 { 
$query0 = "SELECT * FROM ".TABLE_PREFIX."pireps ORDER BY submitdate DESC LIMIT 1";
					
					$pirep =	DB::get_row($query0);

if($pirep->code == $settings->cargocode)
{
$pcode = $settings->cargocode;
$flightnum = $pirep->flightnum;
$query1 = "DELETE FROM ".TABLE_PREFIX."schedules WHERE code = '$pcode' AND flightnum = '$flightnum'";
					
						DB::query($query1);

}
}
}

public function createnewcontracts()
{
$target = CargoOpsData::getsettings();
$curcontracts = CargoOpsData::countcontracts();
if($target->contractnumber > $curcontracts)
{
CargoOpsData::CreateContracts();
			return self::createnewcontracts();
}
}
























	
	}
 ?>