<?php
class CargoOpsData extends CodonModule
{

	public static function getsettings()
	{
		$sql="SELECT * FROM cargosettings";
		return DB::get_row($sql);
	}

	public static function SaveSettings($id, $cargocode, $indextext, $contractnumber, $minexp, $maxexp, $prefaptA, $prefaptB, $prefaptC, $cronjobactive)
	    {
			
        $query = "UPDATE cargosettings SET cargocode='$cargocode', indextext='$indextext', contractnumber='$contractnumber', minexp='$minexp', maxexp='$maxexp', prefaptA='$prefaptA', prefaptB='$prefaptB', prefaptC='$prefaptC', cronjobactive='$cronjobactive' WHERE id='$id'";
		
        DB::query($query);
		
		$airline = 'CargoOps';
		$airlinecheck = self::CheckAirlineExist($airline);
		
		if(!$airlinecheck)
		{
			
		  $query13 = "INSERT INTO ".TABLE_PREFIX."airlines (code, name, enabled)
                        VALUES('$cargocode', '$airline', '1')";
					
						DB::query($query13);
		}
		else
		{
			$query27 = "UPDATE ".TABLE_PREFIX."airlines SET code = '$cargocode' WHERE code='$airline'";

        DB::query($query27);
		}
		
    }
	
	 public static function CheckAirlineExist($airline) {
        $query = "SELECT * FROM ".TABLE_PREFIX."airlines
		WHERE name = '$airline' LIMIT 1";
        return DB::get_row($query);
    }

	public static function countcontracts()
	{
		$sql="SELECT * FROM cargocontracts";
		return count(DB::get_results($sql));
	}

	public static function CheckContractExpiry()
	{
		$sql="DELETE FROM cargocontracts WHERE expiredate < NOW()";
		DB::query($sql);
	}

	public static function getavailablecontracts()
	{
 $ranklevel = Auth::$userinfo->ranklevel;
	$sql="SELECT c.*, a.name as aircraftname, a.icao as aircrafticao, a.ranklevel as aircraftlevel, dep.country as depcountry, arr.country as arrcountry, dep.name as depname, arr.name as arrname, dep.lat as deplat, dep.lng as deplng, arr.lat as arrlat, arr.lng as arrlng, t.name as cargoname, t.price as cargoprice FROM cargocontracts c
		LEFT JOIN ".TABLE_PREFIX."aircraft a ON c.aircraft = a.id
		LEFT JOIN ".TABLE_PREFIX."airports dep ON dep.icao = c.depicao
		LEFT JOIN ".TABLE_PREFIX."airports arr ON arr.icao = c.arricao
		LEFT JOIN cargotypes t ON t.id = c.freight
        WHERE a.ranklevel <= '$ranklevel'
		ORDER BY c.flightnum ASC";
		return DB::get_results($sql);
	}

public static function getallcontracts()
	{
		$sql="SELECT c.*, a.name as aircraftname, a.icao as aircrafticao, dep.country as depcountry, arr.country as arrcountry, dep.name as depname, arr.name as arrname, dep.lat as deplat, dep.lng as deplng, arr.lat as arrlat, arr.lng as arrlng, t.name as cargoname, t.price as cargoprice FROM cargocontracts c
		LEFT JOIN ".TABLE_PREFIX."aircraft a ON c.aircraft = a.id
		LEFT JOIN ".TABLE_PREFIX."airports dep ON dep.icao = c.depicao
		LEFT JOIN ".TABLE_PREFIX."airports arr ON arr.icao = c.arricao
		LEFT JOIN cargotypes t ON t.id = c.freight
		ORDER BY c.flightnum ASC";
		return DB::get_results($sql);
	}

	public static function getcontractdetails($id)
	{
		$sql="SELECT c.*, a.name as aircraftname, a.registration as aircraftreg, a.icao as aircrafticao, dep.country as depcountry, arr.country as arrcountry, dep.name as depname, arr.name as arrname, dep.lat as deplat, dep.lng as deplng, arr.lat as arrlat, arr.lng as arrlng, t.name as cargoname, t.price as cargoprice FROM cargocontracts c
		LEFT JOIN ".TABLE_PREFIX."aircraft a ON c.aircraft = a.id
		LEFT JOIN ".TABLE_PREFIX."airports dep ON dep.icao = c.depicao
		LEFT JOIN ".TABLE_PREFIX."airports arr ON arr.icao = c.arricao
		LEFT JOIN cargotypes t ON t.id = c.freight
		WHERE c.cid = '$id'";
		return DB::get_row($sql);
	}

	public static function getflighthistory($pilotid)
	{
$settings = self::getsettings();
$carcode = $settings->cargocode;
		$sql="SELECT p.*, a.* FROM ".TABLE_PREFIX."pireps p
		LEFT JOIN ".TABLE_PREFIX."aircraft a ON a.id = p.aircraft
 WHERE p.code = '$carcode' AND p.pilotid = '$pilotid'
		ORDER BY p.pirepid DESC";
		return DB::get_results($sql);
	}

	public static function getcontractaircraft()
	{
		$sql="SELECT c.*, a.*, c.serviceceiling as serviceceiling FROM cargofleet c
		LEFT JOIN ".TABLE_PREFIX."aircraft a ON a.id = c.oid
		ORDER BY RAND() LIMIT 1";
		return DB::get_row($sql);
	}

	public static function getcargoaircraft($id)
	{
		$sql="SELECT c.*, a.*, c.serviceceiling as serviceceiling FROM cargofleet c
		LEFT JOIN ".TABLE_PREFIX."aircraft a ON a.id = c.oid
		WHERE c.fid = '$id'";
		return DB::get_row($sql);
	}

	public static function getcargofleet()
	{
		$sql="SELECT c.*, a.*, c.serviceceiling as serviceceiling FROM cargofleet c
		LEFT JOIN ".TABLE_PREFIX."aircraft a ON a.id = c.oid
		ORDER BY a.icao ASC";
		return DB::get_results($sql);
	}

public static function SaveFleetAircraft($oid, $serviceceiling, $runway, $mindistance, $cargosize, $cruisespeed)
	{
		$sql="INSERT INTO cargofleet (oid, serviceceiling, runway, mindistance, cargosize, cruisespeed)
                        VALUES('$oid', '$serviceceiling', '$runway', '$mindistance', '$cargosize', '$cruisespeed')";
		DB::query($sql);
	}

public static function EditFleetAircraft($fid, $oid, $serviceceiling, $runway, $mindistance, $cargosize, $cruisespeed)
	{
		$sql="UPDATE cargofleet SET oid='$oid', serviceceiling='$serviceceiling', runway='$runway', mindistance='$mindistance', cargosize='$cargosize', cruisespeed='$cruisespeed' WHERE fid='$fid'";
		DB::query($sql);
	}

	public static function getrandomcargotype($maxcargosize)
	{
		$sql="SELECT * FROM cargotypes WHERE cargosize <= '$maxcargosize' ORDER BY RAND() LIMIT 1";
		return DB::get_row($sql);
	}

public static function getallcargotypes()
	{
		$sql="SELECT * FROM cargotypes ORDER BY name DESC";
		return DB::get_results($sql);
	}

public static function getcargotype($id)
	{
		$sql="SELECT * FROM cargotypes WHERE id = $id";
		return DB::get_row($sql);
	}

public static function SaveFreightType($name, $price, $cargosize)
	{
		$sql="INSERT INTO cargotypes (name, price, cargosize)
                        VALUES('$name', '$price', '$cargosize')";
		DB::query($sql);
	}

public static function EditFreightType($id, $name, $price, $cargosize)
	{
		$sql="UPDATE cargotypes SET name='$name', price='$price', cargosize='$cargosize' WHERE id='$id'";
		DB::query($sql);
	}

public static function getairportdata()
	{
		$sql="SELECT a.*, r.* FROM ".TABLE_PREFIX."airports a
LEFT JOIN cargorunways r ON a.icao = r.airport_ident
 ORDER BY icao ASC";
		return DB::get_results($sql);
	}

public static function getairportinfo($icao)
	{
		$sql="SELECT a.*, r.* FROM ".TABLE_PREFIX."airports a
LEFT JOIN cargorunways r ON a.icao = r.airport_ident
WHERE a.icao = '$icao'";
		return DB::get_row($sql);
	}

public static function EditAirport($length_ft, $icao)
{
		$airportcheck = self::CheckAirportExist($icao);
		
		if(!$airportcheck)
		{
			
		  $query1 = "INSERT INTO cargorunways (airport_ident, length_ft)
                        VALUES('$icao', '$length_ft')";
					
						DB::query($query1);
		}
		else
		{
			$query2 = "UPDATE cargorunways SET length_ft = '$length_ft' WHERE airport_ident='$icao'";

        DB::query($query2);
		}
		
    }
	
	 public static function CheckAirportExist($icao) {
        $query = "SELECT * FROM cargorunways
		WHERE airport_ident = '$icao' LIMIT 1";
        return DB::get_row($query);
    }

		public static function CreateContracts()
		{
			$settings = self::getsettings();
			$cargocode = $settings->cargocode;
			$lastflightnum = self::getlastcargoflight($cargocode);
			$flightnum = $lastflightnum + 1;
			$aircraft = self::getcontractaircraft();
			$aircraftid = $aircraft->id;
			$depicao = self::getranddepicao($aircraft->runway);
			$mindistance = $aircraft->mindistance;
			$maxdistance = $aircraft->range - 400;
			$arricao = self::getsuitablearricao($depicao, $mindistance, $maxdistance, $aircraft->runway);
			$cargoload = round(($aircraft->maxcargo * rand(5,10)) / 10);
			$freighttype = self::getrandomcargotype($aircraft->cargosize);
			$cargotype = $freighttype->id;
			$freightprice = $freighttype->price;
			$expiry = self::getcontractexpiry();
			$notes = "Cargo: ".$cargoload."lbs - ".$freighttype->name;
			$distance =self::getdistance($depicao, $arricao);
			$deptime = self::getdeptime($aircraft->range);
			$findeptime = $deptime.' UTC';
			$flightminu = self::makeflightminu($distance, $aircraft->cruisespeed);
			$flighttime = self::makeflighttime($flightminu);
			$arrtime = self::getarrtime($deptime, $flightminu).' UTC';
			$altitude = self::getaltitude($aircraft->serviceceiling, $flightminu);
			$flighttype = 'C';

			
			self::CreateNewContract($cargocode, $flightnum, $aircraftid, $depicao, $arricao, $cargotype, $cargoload, $freightprice, $expiry, $notes, $findeptime, $arrtime, $flighttime, $altitude, $flighttype, $distance);
			
		}

public static function CreateNewContract($cargocode, $flightnum, $aircraftid, $depicao, $arricao, $cargotype, $cargoload, $freightprice, $expiry, $notes, $findeptime, $arrtime, $flighttime, $altitude, $flighttype, $distance)
	{
		$sql="INSERT INTO cargocontracts (code, flightnum, aircraft, depicao, arricao, freight, cload, price, expiredate, notes, deptime, arrtime, flighttime, altitude, flighttype, distance)
                        VALUES('$cargocode', '$flightnum', '$aircraftid', '$depicao', '$arricao', '$cargotype', '$cargoload', '$freightprice', '$expiry', '$notes', '$findeptime', '$arrtime', '$flighttime', '$altitude', '$flighttype', '$distance')";
		DB::query($sql);
	}

public static function processbid($cid, $altitude, $route)
{
$contract = self::getcontractdetails($cid);

if(!$contract)
{
return;
}
$code = $contract->code;
$flightnum = $contract->flightnum;
$depicao = $contract->depicao;
$arricao = $contract->arricao;
$aircraft = $contract->aircraft;
$distance = $contract->distance;
$deptime = $contract->deptime;
$arrtime = $contract->arrtime;
$flighttime = $contract->flighttime;
$price = $contract->price;
$flighttype = $contract->flighttype;
$notes = $contract->notes;

$sql="INSERT INTO ".TABLE_PREFIX."schedules (code, flightnum, depicao, arricao, route, aircraft, flightlevel, distance, deptime, arrtime, flighttime, daysofweek, price, flighttype, notes, enabled)
                        VALUES('$code', '$flightnum', '$depicao', '$arricao', '$route', '$aircraft', '$altitude', '$distance', '$deptime', '$arrtime', '$flighttime', '0123456', '$price', '$flighttype', '$notes', '1')";
		DB::query($sql);
return DB::$insert_id;
}
		
		public static function getlastcargoflight($cargocode)
		{
			 $sql="SELECT flightnum, code FROM ".TABLE_PREFIX."schedules WHERE code ='$cargocode'
 UNION ALL
 SELECT flightnum, code FROM cargocontracts
 WHERE code ='$cargocode'
 ORDER BY cast(flightnum as unsigned) DESC LIMIT 1
";

$flight = DB::get_row($sql);
return $flight->flightnum;
		} 
		
		 public static function getranddepicao($runwaylength)
		{ 
$depapt = new stdClass();
$randlor = rand(1,6);
$settings = self::getsettings();

if($randlor == '1' && trim($settings->prefaptA) != '')
{
$selectedapt = $settings->prefaptA;
$runwaycheck = self::checkrunwayforaircraft($selectedapt);
 if($runwaycheck->length_ft > $runwaylength)
 {
$depapt->icao = $selectedapt;
 }
 else
{
$sql="SELECT a.icao, r.length_ft FROM ".TABLE_PREFIX."airports a
LEFT JOIN cargorunways r ON a.icao = r.airport_ident
WHERE r.length_ft > '$runwaylength' ORDER BY RAND() LIMIT 1";
$depapt = DB::get_row($sql);
}
}
elseif($randlor == '2' && trim($settings->prefaptB) != '')
{
$selectedapt = $settings->prefaptB;
$runwaycheck = self::checkrunwayforaircraft($selectedapt);
 if($runwaycheck->length_ft > $runwaylength)
 {
$depapt->icao = $selectedapt;
 }
 else
{
$sql="SELECT a.icao, r.length_ft FROM ".TABLE_PREFIX."airports a
LEFT JOIN cargorunways r ON a.icao = r.airport_ident
WHERE r.length_ft > '$runwaylength' ORDER BY RAND() LIMIT 1";
$depapt = DB::get_row($sql);
}
}
elseif($randlor == '3' && trim($settings->prefaptC) != '')
{
$selectedapt = $settings->prefaptC;
$runwaycheck = self::checkrunwayforaircraft($selectedapt);
 if($runwaycheck->length_ft > $runwaylength)
 {
$depapt->icao = $selectedapt;
 }
 else
{
$sql="SELECT a.icao, r.length_ft FROM ".TABLE_PREFIX."airports a
LEFT JOIN cargorunways r ON a.icao = r.airport_ident
WHERE r.length_ft > '$runwaylength' ORDER BY RAND() LIMIT 1";
$depapt = DB::get_row($sql);
}
}
else
{
$sql="SELECT a.icao, r.length_ft FROM ".TABLE_PREFIX."airports a
LEFT JOIN cargorunways r ON a.icao = r.airport_ident
WHERE r.length_ft > '$runwaylength' ORDER BY RAND() LIMIT 1";
$depapt = DB::get_row($sql);
}
return $depapt->icao;
		}

  public static function checkrunwayforaircraft($icao)
{
$sql="SELECT length_ft FROM cargorunways
WHERE airport_ident = '$icao' LIMIT 1";
return DB::get_row($sql);
}
		
		 public static function getsuitablearricao($depicao, $mindistance, $maxdistance, $runwaylength)
		{
$depapt = self::getairportinfo($depicao);
$lat = $depapt->lat;
$lng =$depapt->lng;

$sql="SELECT a.icao, r.length_ft,
( 3443.92 * acos( cos( radians( '$lat' ) ) * 
cos( radians( a.lat ) ) * 
cos( radians( a.lng ) - 
radians( '$lng' ) ) + 
sin( radians( '$lat' ) ) * 
sin( radians( a.lat ) ) ) ) 
AS distance FROM ".TABLE_PREFIX."airports a
LEFT JOIN cargorunways r ON a.icao = r.airport_ident
WHERE a.icao != '$depapt->icao' AND r.length_ft > '$runwaylength'
HAVING distance < '$maxdistance' AND distance > '$mindistance' ORDER BY RAND() LIMIT 1";

$arrapt = DB::get_row($sql);
return $arrapt->icao;
		}
		
		 public static function getcontractexpiry()
		{
			$settings = self::getsettings();
			$randomdays = rand($settings->minexp, $settings->maxexp);
			
			$today = gmdate('Y-m-d H:i:s');
			$expiredate = date('Y-m-d H:i:s', strtotime($today. ' + '.$randomdays.' day'));
			
			return $expiredate;
		}
		
		 public static function getdistance($depicao, $arricao)
		{
		$depapt = self::getairportinfo($depicao);
		$arrapt = self::getairportinfo($arricao);
		
		$lat1 = $depapt->lat;
		$lng1 = $depapt->lng;
		
		$lat2 = $arrapt->lat;
		$lng2 = $arrapt->lng;
		
		$radius = 3443.92;
		
       $lat1 = deg2rad(floatval($lat1));
		$lat2 = deg2rad(floatval($lat2));
		$lng1 = deg2rad(floatval($lng1));
		$lng2 = deg2rad(floatval($lng2));
		
		$a = sin(($lat2 - $lat1)/2.0);
		$b = sin(($lng2 - $lng1)/2.0);
		$h = ($a*$a) + cos($lat1) * cos($lat2) * ($b*$b);
		$theta = 2 * asin(sqrt($h)); # distance in radians
		
		$distance = $theta * $radius;
		
		return round($distance);
		}
		
		 public static function getdeptime($range)
		{
			if($range < '800'){
				$dephour = rand(7,20);
			}
			else
			{
				 $dephour = rand(1,23);
			}
			
			if($dephour < 10)
			{
				$dephour = '0'.$dephour;
			}
				
				$depminrand = rand(1,4);
				
			if($depminrand == '1')
			{
				$depmin = '00';
			}
			 elseif($depminrand == '2')
			{
				$depmin = '15';
			}
			 elseif($depminrand == '3')
			{
				$depmin = '30';
			}
			 elseif($depminrand == '4')
			{
				$depmin = '45';
			}
			
			$deptime = $dephour.':'.$depmin;
			
			return $deptime;
		} 
		
		 public static function makeflightminu($distance, $cruisespeed)
		{
			$taxitime = 15;
			
			$basictime = $distance / $cruisespeed;
			
			$calcflighttime = round($basictime * 60);
			
			$extratime = round($calcflighttime * 0,1);
			
			$flightminu = (($calcflighttime + $taxitime) + $extratime);
			
			return $flightminu;
		} 
		
		 public static function makeflighttime($flightminu)
		{
			
			$hours = floor($flightminu / 60);
			$minutes = ($flightminu % 60);

if($hours < 10)
{
$hours = "0".$hours;
}
if($minutes < 10)
{
$minutes = "0".$minutes;
}
			
			$flighttime = $hours.':'.$minutes;
			
			return $flighttime;
		} 
		
		 public static function getarrtime($deptime, $flightminu)
		{
			$depart = explode(":", $deptime);
			$depminu1 = $depart[0] * 60;
			$depminu = $depart[1] + $depminu1;
			$arrminu = $depminu + $flightminu;
			
			$prehours = floor($arrminu / 60);
			$minutes = ($arrminu % 60);
			
			if($prehours > 23)
			{
				$hours = $prehours - 24;
			}
			else
			{
				$hours = $prehours;
			}
if($hours < 10)
{
$hours = "0".$hours;
}
if($minutes < 10)
{
$minutes = "0".$minutes;
}
			
			 $arrtime = $hours.':'.$minutes;
			
			return $arrtime;			
		} 
		
		
		 public static function getaltitude($serviceceiling, $flightminu)
		{
			if($flightminu < '60' && $serviceceiling > '25000')
			{
				$altitude = 25000;
			}
			 elseif($flightminu < '60' && $serviceceiling >= '17000')
			{
				$altitude = 17000;
			}
			 elseif($flightminu < '60' && $serviceceiling < '17000' )
			{
				$altitude = 9000;
			}
			 elseif($flightminu >= '60' && $serviceceiling > '38000')
			{
				$altitude = 37000;
			}
			 elseif($flightminu >= '60' && $serviceceiling > '40000')
			{
				$altitude = 39000;
			}
			 elseif($flightminu >= '60' && $serviceceiling > '37000')
			{
				$altitude = 37000;
			}
		 elseif($flightminu >= '60' && $serviceceiling > '33000')
			{
				$altitude = 33000;
			}
			 elseif($flightminu >= '60' && $serviceceiling > '31000')
			{
				$altitude = 31000;
			}
			 elseif($flightminu >= '60' && $serviceceiling > '27000')
			{
				$altitude = 27000;
			}
			 elseif($flightminu >= '60' && $serviceceiling > '23000')
			{
				$altitude = 23000;
			}
			 elseif($flightminu >= '60' && $serviceceiling > '17000')
			{
				$altitude = 17000;
			}
			 elseif($flightminu >= '60' && $serviceceiling > '11000')
			{
				$altitude = 11000;
			}
			 elseif($flightminu >= '60' && $serviceceiling < '10000')
			{
				$altitude = 9000;
			}
			
			return $altitude;
		} 

public static function deletecontract($id)
	{
		$sql="DELETE FROM cargocontracts WHERE cid = '$id'";
		DB::query($sql);
	}

public static function deleteallcontracts()
	{
		$sql="DELETE FROM cargocontracts";
		DB::query($sql);
	}

public static function deletecargotype($id)
	{
		$sql="DELETE FROM cargotypes WHERE id = '$id'";
		DB::query($sql);
	}

public static function deletecargoaircraft($id)
	{
		$sql="DELETE FROM cargofleet WHERE fid = '$id'";
		DB::query($sql);
	}






















}
	
 ?>