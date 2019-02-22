<?php
////////////////////////////////////////////////////////////////////////////
//Crazycreatives CargoOps module for phpVMS virtual airline system//
//@author Manuel Seiwald                                                  //
//@copyright Copyright (c) 2014, Manuel Seiwald, All Rights Reserved      //
////////////////////////////////////////////////////////////////////////////




class CargoOps extends CodonModule {
	
	  public function HTMLHead()
    {
        $this->set('sidebar', 'cargoops/sidebar.php');
    }

    public function NavBar()
    {
        echo '<li><a href="'.SITE_URL.'/admin/index.php/CargoOps">CargoOps</a></li>';
    }

    public function index() {
		
		  $this->set('contracts', CargoOpsData::getallcontracts());
          $this->show('cargoops/index.tpl');
    }

public function deletecontract($id){
 CargoOpsData::deletecontract($id);
		$this->set('message', 'Contract Removed!');
	    $this->show('core_success.tpl');
 $this->index();
}

public function settings() {
		  $this->set('setting', CargoOpsData::getsettings());
          $this->show('cargoops/settings.tpl');
    }

	
	public function fleet() {
		  $this->set('aircraft', CargoOpsData::getcargofleet());
          $this->show('cargoops/fleet.tpl');
    }

public function addcargoaircraft() {
		   
		     $this->set('action', 'addcargoaircraft');
   $this->set('allaircraft', OperationsData::getAllAircraft());
      $this->show('cargoops/aircraftform.tpl');
    }
	
	
	public function editcargoaircraft($id) {
		   
		  $this->set('action', 'editcargoaircraft');
   $this->set('allaircraft', OperationsData::getAllAircraft());
   $this->set('caircraft', CargoOpsData::getcargoaircraft($id));
          $this->show('cargoops/aircraftform.tpl');
    }
	
	
	
	public function cargoaircraftaction()
	{
		if(isset($this->post->action))
		{
			if($this->post->action == 'addcargoaircraft')
			{
				$this->submitfleetaircraft();
			}
			elseif($this->post->action == 'editcargoaircraft')
			{
				$this->editfleetaircraft();
			}
		}
	}
	
	
	protected function submitfleetaircraft() {

        $oid = trim(DB::escape($this->post->oid));
		$serviceceiling = trim(DB::escape($this->post->serviceceiling));
		$runway = trim(DB::escape($this->post->runway));
		$mindistance = trim(DB::escape($this->post->mindistance));
		$cargosize = trim(DB::escape($this->post->cargosize));
		$cruisespeed = trim(DB::escape($this->post->cruisespeed));
		
		
        CargoOpsData::SaveFleetAircraft($oid, $serviceceiling, $runway, $mindistance, $cargosize, $cruisespeed);
        
		$this->set('message', 'Aircraft Added!');
	    $this->show('core_success.tpl');
        $this->fleet();
    }
	
	
	protected function editfleetaircraft() {

 $fid = DB::escape($this->post->fid);
 $oid = trim(DB::escape($this->post->oid));
		$serviceceiling = trim(DB::escape($this->post->serviceceiling));
		$runway = trim(DB::escape($this->post->runway));
		$mindistance = trim(DB::escape($this->post->mindistance));
		$cargosize = trim(DB::escape($this->post->cargosize));
		$cruisespeed = trim(DB::escape($this->post->cruisespeed));
		
		
		
        CargoOpsData::EditFleetAircraft($fid, $oid, $serviceceiling, $runway, $mindistance, $cargosize, $cruisespeed);
        
		$this->set('message', 'Aircraft Edited!');
	    $this->show('core_success.tpl');
        $this->fleet();
    }


public function deletecargoaircraft($id){
 CargoOpsData::deletecargoaircraft($id);
		$this->set('message', 'Aircraft Removed!');
	    $this->show('core_success.tpl');
 $this->fleet();
}

public function airportdata()
{
$this->set('airports', CargoOpsData::getairportdata());
          $this->show('cargoops/airportdata.tpl');
}

public function editairport($icao) {
	
   $this->set('airport', CargoOpsData::getairportinfo($icao));
          $this->show('cargoops/airportform.tpl');
    }

public function editcargoairport() {

 $length_ft = trim(DB::escape($this->post->length_ft));
 $icao = trim(DB::escape($this->post->icao));
		
        CargoOpsData::EditAirport($length_ft, $icao);
        
		$this->set('message', 'Airport Edited!');
	    $this->show('core_success.tpl');
        $this->airportdata();
    }


public function cargotypes() {
		  $this->set('cargotypes', CargoOpsData::getallcargotypes());
          $this->show('cargoops/cargotypes.tpl');
    }

public function addcargotype() {
		   
		     $this->set('action', 'addcargotype');
      $this->show('cargoops/typesform.tpl');
    }
	
	
	public function editcargotype($id) {
		   
		  $this->set('action', 'editcargotype');
   $this->set('cargotype', CargoOpsData::getcargotype($id));
          $this->show('cargoops/typesform.tpl');
    }
	
	
	
	public function cargotypeaction()
	{
		if(isset($this->post->action))
		{
			if($this->post->action == 'addcargotype')
			{
				$this->submitfreighttype();
			}
			elseif($this->post->action == 'editcargotype')
			{
				$this->editfreighttype();
			}
		}
	}
	
	
	protected function submitfreighttype() {

        $name = DB::escape($this->post->name);
		$price = trim(DB::escape($this->post->price));
		$cargosize = trim(DB::escape($this->post->cargosize));
		
        CargoOpsData::SaveFreightType($name, $price, $cargosize);
        
		$this->set('message', 'Cargotype Added!');
	    $this->show('core_success.tpl');
        $this->cargotypes();
    }
	
	
	protected function editfreighttype() {

        $id = DB::escape($this->post->id);
 $name = DB::escape($this->post->name);
		$price = trim(DB::escape($this->post->price));
		$cargosize = trim(DB::escape($this->post->cargosize));
		
		
        CargoOpsData::EditFreightType($id, $name, $price, $cargosize);
        
		$this->set('message', 'Cargotype Edited!');
	    $this->show('core_success.tpl');
        $this->cargotypes();
    }


public function deletecargotype($id){
 CargoOpsData::deletecargotype($id);
		$this->set('message', 'Cargo Deleted!');
	    $this->show('core_success.tpl');
 $this->cargotypes();
}

public function savesettings($id) {

        $cargocode = trim(DB::escape($this->post->cargocode));
		$indextext = DB::escape($this->post->indextext);
		$contractnumber = trim(DB::escape($this->post->contractnumber));
		$minexp = trim(DB::escape($this->post->minexp));
		$maxexp = trim(DB::escape($this->post->maxexp));
		$prefaptA = trim(DB::escape($this->post->prefaptA));
 $prefaptB = trim(DB::escape($this->post->prefaptB));
 $prefaptC = trim(DB::escape($this->post->prefaptC));
	 $cronjobactive = trim(DB::escape($this->post->cronjobactive));
		
        CargoOpsData::SaveSettings($id, $cargocode, $indextext, $contractnumber, $minexp, $maxexp, $prefaptA, $prefaptB, $prefaptC, $cronjobactive);
        
		$this->set('message', 'Settings Saved!');
	    $this->show('core_success.tpl');
        $this->index();
    }



public function resetcontracts() {

CargoOpsData::deleteallcontracts();
self::createnewcontracts();
		$this->set('message', 'New Contracts Created!');
	    $this->show('core_success.tpl');
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

public function creco()
{
$target = CargoOpsData::getsettings();
$curcontracts = CargoOpsData::countcontracts();
if($target->contractnumber > $curcontracts)
{
CargoOpsData::CreateContracts();
}

}
public function test()
{
$this->show('cargoops/test.tpl');
}

























	
}
	