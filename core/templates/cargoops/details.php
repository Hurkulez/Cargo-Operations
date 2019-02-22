<h3>Contract Details <?php echo $contract->code.''.$contract->flightnum; ?></h3>


<form name="cargoops" action="<?php echo SITE_URL; ?>/index.php/CargoOps/addbid/<?php echo $contract->cid; ?>" method="post">
<table>
<tr>
<td>Flight:</td>
<td><?php echo $contract->code.''.$contract->flightnum; ?></td>
</tr>
<tr>
<td>Aircraft:</td>
<td><?php echo $contract->aircraftname.' ('.$contract->aircraftreg.')'; ?></td>
</tr>
<tr>
<td>From:</td>
<td><?php echo $contract->depicao.' ('.$contract->depcountry.')'; ?></td>
</tr>
<tr>
<td>Planned Departure:</td>
<td><?php echo $contract->deptime; ?></td>
</tr>
<tr>
<td>To:</td>
<td><?php echo $contract->arricao.' ('.$contract->arrcountry.')'; ?></td>
</tr>
<tr>
<td>Planned Arrival:</td>
<td><?php echo $contract->arrtime; ?></td>
</tr>
<tr>
<td>Planned Flighttime:</td>
<td><?php echo $contract->flighttime; ?></td>
</tr>
<tr>
<td>Planned GC Distance:</td>
<td><?php echo $contract->distance; ?>NM</td>
</tr>
<tr>
<td>Cargo (Estimated Amount):</td>
<td><?php echo $contract->cargoname; ?> (<?php echo $contract->cload; ?>lbs)</td>
</tr>
<tr>
<td>Contract Expires:</td>
<td><?php echo $contract->expiredate; ?></td>
</tr>
<tr>
<td>Altitude:</td>
<td><input type="number" style="text-transform:uppercase;" name="altitude" value="<?php echo $contract->altitude;?>" /></td>
</tr>
<tr>
<td>Route:</td>
<td><textarea name="flightroute" cols="50" rows="3"></textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Fly Now!"></td>
</tr>
</table>
</form>




























