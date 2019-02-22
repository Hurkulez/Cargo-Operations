<?php $contractcount = count($contracts); ?>
<h3>Current Contracts (<?php echo $contractcount; ?>)</h3>
<?php if($contractcount == '0')
{
echo "No Cargo Contracts created!";
return;
} ?>


<table cellspacing="0" cellpadding="0" border="0" class="cargoopstable">
<tr>
<td>From</td>
<td>City</td>
<td>To</td>
<td>City</td>
<td>Aircraft</td>
<td>Cargo</td>
<td>Weight</td>
<td>Fee</td>
<td>Expires</td>
<td>Delete</td>
</tr>
<?php foreach($contracts as $contract)
{
?>
<tr>
<td><?php echo $contract->depicao; ?></td>
<td><?php echo $contract->depname; ?></td>
<td><?php echo $contract->arricao; ?></td>
<td><?php echo $contract->arrname; ?></td>
<td><?php echo $contract->aircraftname; ?></td>
<td><?php echo $contract->cargoname; ?></td>
<td><?php echo $contract->cload; ?></td>
<td><?php echo round($contract->cload * $contract->price); ?></td>
<td><?php echo $contract->expiredate; ?></td>
<td><a href="<?php echo SITE_URL ?>/admin/index.php/CargoOps/deletecontract/<?php echo $contract->cid; ?>">Delete</a></td>
</tr>
<?php } ?>
</table>