<h3>Cargo Fleet Aircraft Data Form <?php echo $caircraft->fullname; ?> <?php echo $caircraft->registration; ?></h3>

<form name="cargoops" action="<?php echo SITE_URL; ?>/admin/index.php/CargoOps/cargoaircraftaction" method="post">
<table width="100%" cellspacing="10px">
<tr></tr>
<tr>
                <td style="font-weight:bold">Select Aircraft(*):</td><td>
		<select name="oid">
        <option value="">Select Aicraft</option>
		<?php
		
		if(!$allaircraft) $allaircraft = array();
		foreach($allaircraft as $ac)
        
		{
  if($caircraft->oid == $ac->id)
$sel = 'selected="selected"';
			else
				$sel = '';

			?><option value="<?php echo $ac->id; ?>" <?php echo $sel; ?>><?php echo $ac->name; ?>&nbsp;(<?php echo $ac->registration; ?>)</option>';
		<?php
        
        }
		
		?>
		</select></td></tr>
<tr>
<td valign="top" style="font-weight:bold">Service Ceiling in ft*:</td>
<td><input type="number" name="serviceceiling" maxlength="5" value="<?php echo $caircraft->serviceceiling;?>" />
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Average Groundspeed (GS) during cruise in kts*:</td>
<td><input type="number" name="cruisespeed" maxlength="4" value="<?php echo $caircraft->cruisespeed;?>" />
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Minimum Runway length for Cargo Ops in ft*:</td>
<td><input type="number" name="runway" maxlength="5" value="<?php echo $caircraft->runway;?>" />
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">MINIMUM Flight Distance for Contract creation in NM*:</td>
<td><input type="number" name="mindistance" maxlength="5" value="<?php echo $caircraft->mindistance;?>" />
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Cargo Size (capable of loading .... items):</td>
<td>
<select name="cargosize">
                         <?php 
                       
                         if($caircraft->cargosize == "1") { 
                         $sel1 = "selected";
                         }
                         elseif($caircraft->cargosize == "2") { 
                         $sel2 = "selected";
                         }
elseif($caircraft->cargosize == "3") { 
                         $sel3 = "selected";
                         }
                         ;?>
                         
                         
				               <option value="1" <?php echo $sel1 ?>>Small</option>
                 <option value="2" <?php echo $sel2 ?>>Medium</option>
                 <option value="3" <?php echo $sel3 ?>>Big</option>
                
 </select>
 </td>
</tr>
<tr>
<td><input type="hidden" name="action" value="<?php echo $action;?>" />
<input type="hidden" name="fid" value="<?php echo $caircraft->fid;?>" />
</td>
<td><input type="submit" value="Save Aircraft"></td>
</tr>
</table>
</form>
























