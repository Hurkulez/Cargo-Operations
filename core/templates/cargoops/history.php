<h3>My Cargo Flight History</h3>
<table width="100%" border="1">
<tr>
<th>Flight</th>
<th>From</th>
<th>To</th>
<th>Aircraft</th>
<th>Time</th>
<th>Landingrate</th>
<th>Date</th>
</tr>
<?php 
if(!$pireps)
{
?>
<tr><td colspan="7">No Cargo Flights found!</td></tr>
<?php
}
else
{
foreach($pireps as $pirep)
{
?>
<tr>
<td><?php echo $pirep->code; ?><?php echo $pirep->flightnum; ?></td>
<td><?php echo $pirep->depicao; ?></td>
<td><?php echo $pirep->arricao; ?></td>
<td><?php echo $pirep->name; ?> (<?php echo $pirep->registration; ?>)</td>
<td><?php echo $pirep->flighttime; ?></td>
<td><?php echo $pirep->landingrate; ?></td>
<td><?php echo $pirep->submitdate; ?></td>
</tr>
<?php
}
}
?>
</table>