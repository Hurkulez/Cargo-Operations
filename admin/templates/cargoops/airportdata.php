<h3>Longest Airport Runway Data</h3>
Airports without runway data won't be used for route generation. Click Edit to add runway data.
<?php if(!$airports)
{
echo "No Runway Data!";
return;
} ?>


<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td>Icao</td>
<td>Name</td>
<td>Country</td>
<td>Runway</td>
<td>Edit</td>
</tr>
<?php foreach($airports as $apt)
{
?>
<tr>
<td><?php echo $apt->icao; ?></td>
<td><?php echo $apt->name; ?></td>
<td><?php echo $apt->country; ?></td>
<td><?php echo $apt->length_ft; ?><?php if(trim($apt->length_ft) == '') { echo "NO DATA";} else { echo "ft";} ?></td>
<td><a href="<?php echo SITE_URL ?>/admin/index.php/CargoOps/editairport/<?php echo $apt->icao; ?>">Edit</a></td>
</tr>
<?php } ?>
</table>