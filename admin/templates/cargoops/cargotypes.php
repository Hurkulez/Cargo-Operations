<h3>Cargo Types</h3>
<table width="100%">
<tr>
<td>Cargo</td>
<td>Price per lb</td>
<td>Edit</td>
<td>Delete</td>
<tr>
<?php 
if(!$cargotypes)
{
?>
<tr>
  <td colspan="7">No CargoTypes Added!</td></tr>
<?php
}
else
{
foreach($cargotypes as $ac)
{
?>
<tr>
<td>
<?php echo $ac->name; ?>
</td>
<td>
<?php echo $ac->price; ?>
</td>
<td>
<a href="<?php echo SITE_URL ?>/admin/index.php/CargoOps/editcargotype/<?php echo $ac->id ?>">Edit</a>
</td>
<td>
<a href="<?php echo SITE_URL ?>/admin/index.php/CargoOps/deletecargotype/<?php echo $ac->id ?>">Remove</a>
</td>
</tr>
<?php
} 
}
?>
</table>





















