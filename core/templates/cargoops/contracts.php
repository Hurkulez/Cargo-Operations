<?php $contractcount = count($contracts); ?>
<h3>Available Contracts (<?php echo $contractcount; ?>)</h3>
<?php if($contractcount == '0')
{
echo "Unfortunately there currently are no Cargo Contracts available for your ranklevel!";
return;
} ?>


<table cellspacing="0" cellpadding="5px" border="1" class="cargoopstable">
<tr>
<td>From</td>
<td>To</td>
<td>Aircraft</td>
<td>Flighttime</td>
<td>Cargo</td>
<td>Weight</td>
<td>Est. Fee</td>

<?php if(Auth::LoggedIn())
{ ?>
<td>Bid</td>
<?php } ?>
</tr>
<?php foreach($contracts as $contract)
{
?>
<tr>
<td valign="top"><strong><?php echo $contract->depicao; ?></strong>
<br/>
<?php echo $contract->depname; ?>
</td>
<td valign="top"><strong><?php echo $contract->arricao; ?></strong>
<br/>
<?php echo $contract->arrname; ?>
</td>
<td valign="top"><?php echo $contract->aircraftname; ?></td>
<td valign="top"><?php echo $contract->flighttime; ?></td>
<td valign="top"><?php echo $contract->cargoname; ?></td>
<td valign="top"><?php echo $contract->cload; ?>lbs</td>
<td valign="top"><?php echo round($contract->cload * $contract->price); ?>$</td>
<?php if(Auth::LoggedIn())
{ ?>
<td valign="top"><a href="<?php echo SITE_URL ?>/index.php/CargoOps/contractdetails/<?php echo $contract->cid; ?>">Details</a></td>
<?php } ?>
</tr>
<?php } ?>
</table>