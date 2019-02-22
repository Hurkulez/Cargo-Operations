<h3>Cargo Data Form <?php echo $cargotype->name; ?></h3>

<form name="cargoops" action="<?php echo SITE_URL; ?>/admin/index.php/CargoOps/cargotypeaction" method="post">
<table width="100%" cellspacing="10px">
<tr></tr>
<tr>
<td valign="top" style="font-weight:bold">Cargo Title*:</td>
<td><input type="text" name="name" value="<?php echo $cargotype->name;?>" />
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Price per lb*:</td>
<td><input type="number" name="price" maxlength="6" value="<?php echo $cargotype->price;?>" />
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Cargo Size (to match aircraft dimensions):</td>
<td>
<select name="cargosize">
                         <?php 
                       
                         if($cargotype->cargosize == "1") { 
                         $sel1 = "selected";
                         }
                         elseif($cargotype->cargosize == "2") { 
                         $sel2 = "selected";
                         }
elseif($cargotype->cargosize == "3") { 
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
<input type="hidden" name="id" value="<?php echo $cargotype->id;?>" />
</td>
<td><input type="submit" value="Save Cargo"></td>
</tr>
</table>
</form>
























