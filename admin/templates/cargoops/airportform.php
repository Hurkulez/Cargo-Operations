<h3>Edit Runway Data for <?php echo $airport->icao; ?></h3>

<form name="cargoops" action="<?php echo SITE_URL; ?>/admin/index.php/CargoOps/editcargoairport" method="post">
<table width="100%" cellspacing="10px">
<tr></tr>
<tr>
<td valign="top" style="font-weight:bold">Runway Length in ft*:</td>
<td><input type="number" name="length_ft" maxlength="5" value="<?php echo $airport->length_ft;?>" />
<br />
Only the length of the longest runway is required.
</td>
</tr>

<tr>
<td><input type="hidden" name="icao" value="<?php echo $airport->icao;?>" /></td>
<td><input type="submit" value="Save Data"></td>
</tr>
</table>
</form>
























