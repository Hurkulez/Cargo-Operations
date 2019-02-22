<h3>Cargo Aircraft</h3>
<table width="100%">
<tr>
<td>Icao</td>
<td>Name</td>
<td>Registration</td>
<td>ServiceCeiling</td>
<td>Cruisespeed</td>
<td>Range</td>
<td>Cargo Capacity</td>
<td>Edit</td>
<td>Remove</td>
<tr>
<?php 
if(!$aircraft)
{
?>
<tr>
  <td colspan="7">No Aicraft assigned to Cargo Fleet!</td></tr>
<?php
}
else
{
foreach($aircraft as $ac)
{
?>
<tr>
<td>
<?php echo $ac->icao; ?>
</td>
<td>
<?php echo $ac->name; ?>
</td>
<td>
<?php echo $ac->registration; ?>
</td>
<td>
<?php echo $ac->serviceceiling; ?>ft
</td>
<td>
<?php echo $ac->cruisespeed; ?>kts
</td>
<td>
<?php echo $ac->range; ?>nm
</td>
<td>
<?php echo $ac->maxcargo; ?>lbs
</td>
<td>
<a href="<?php echo SITE_URL ?>/admin/index.php/CargoOps/editcargoaircraft/<?php echo $ac->fid ?>">Edit</a>
</td>
<td>
<a href="<?php echo SITE_URL ?>/admin/index.php/CargoOps/deletecargoaircraft/<?php echo $ac->fid ?>">Remove</a>
</td>
</tr>
<?php
} 
}
?>
</table>





















