<?php 
	$settings = CargoOpsData::getsettings();
			$cargocode = $settings->cargocode; 
$aircraft = CargoOpsData::getcontractaircraft();
$mindistance = $aircraft->mindistance;
			$maxdistance = $aircraft->range - 200;
$freighttype = CargoOpsData::getrandomcargotype($aircraft->cargosize);
$depicao = CargoOpsData::getranddepicao($aircraft->runway);
$arricao = CargoOpsData::getsuitablearricao($depicao, $mindistance, $maxdistance, $aircraft->runway);
$distance = CargoOpsData::getdistance($depicao, $arricao);
$deptime = CargoOpsData::getdeptime($aircraft->range);
$flightminu = CargoOpsData::makeflightminu($distance, $aircraft->cruisespeed);
	$flighttime = CargoOpsData::makeflighttime($flightminu);
$arrtime = CargoOpsData::getarrtime($deptime, $flightminu).' UTC';
$maxdistance = $aircraft->range;
?>
Aircraft Range
<br />
<?php echo $maxdistance; ?>
<br />
<br />
Lastflightnum
<br />
<?php echo CargoOpsData::getlastcargoflight($cargocode); ?>
<br />
<br />
Newflightnum
<br />
<?php echo CargoOpsData::getlastcargoflight($cargocode) + 1; ?>
<br />
<br />
Get Random DEPICAO
<br />
<?php echo $depicao; ?>
<br />
<br />
Get Aircraft for Contract
<br />
<?php echo $aircraft->id.' - '.$aircraft->name; ?>
<br />
<br />
Get Suitable Arrival ICAO
<br />
<?php echo $arricao; ?>
<br />
<br />
Freighttype
<br />
<?php echo $freighttype->id.' - '.$freighttype->name; ?>
<br />
<br />
ExpireDate
<br />
<?php echo CargoOpsData::getcontractexpiry(); ?>
<br />
<br />
Distance
<br />
<?php echo $distance; ?>
<br />
<br />
Deptime
<br />
<?php echo $deptime; ?>
<br />
<br />
Flighttime
<br />
<?php echo $flighttime; ?>
<br />
<br />
Arrtime
<br />
<?php echo $arrtime; ?>
<br />
<br />
Altitude
<br />
<?php echo CargoOpsData::getaltitude($aircraft->serviceceiling, $flightminu); ?>
<br />
<br />
























