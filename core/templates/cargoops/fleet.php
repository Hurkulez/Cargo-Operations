<h3>Our Cargo Fleet</h3>
<?php
if(!$aircraft)
{
return;
}
 foreach($aircraft as $ac)
{
?>
<table border="1" cellpadding="5px">
<tr><td><strong>Type:</strong></td><td><?php echo $ac->fullname; ?></td><td rowspan="3"><?php if(!$ac->imagelink) echo "No Image"; ?><img src="<?php echo $ac->imagelink; ?>" style="max-width:200px;" /></td></tr>
<tr><td><strong>Registration:</strong></td><td><?php echo $ac->registration; ?></td></tr>
<tr><td><strong>Cargo Capacity</strong>:</td><td><?php echo $ac->maxcargo; ?></td></tr>
 </table>
 <br />
 -----------------------------------
 <br />
 <?php
 }
 ?>