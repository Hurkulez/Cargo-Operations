<h3>CargoOps Settings</h3>

<form name="cargoops" action="<?php echo SITE_URL; ?>/admin/index.php/CargoOps/savesettings/1" method="post">
<table width="100%" cellspacing="10px">
<tr></tr>
<tr>
<td valign="top" width="200px" style="font-weight:bold">Cargo 3 Letter Code*:</td>
<td><input type="text" name="cargocode" maxlength="3" style="text-transform:uppercase;" value="<?php echo $setting->cargocode;?>" required />
<br />
The 3 Letter Airline Code used for Cargo Flights! MUST BE UNIQUE (You can not use the code of your regular VA!)
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Number of Contracts*:</td>
<td><input type="number" name="contractnumber" maxlength="2" min="1" max="50" value="<?php echo $setting->contractnumber;?>" required />
<br />
MAX Amount of automatic generated contracts per CronJob execution. (It is recommended to keep the amount low since the calculations to find suitable routes may take several minutes.) DEFAULT: 25 | MAX: 50
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Min Expire Days*:</td>
<td><input type="number" name="minexp" maxlength="3" min="1" value="<?php echo $setting->minexp;?>" required />
<br />
Minimum amount of days a contract is available before it gets replaced (if nobody books the flight) DEFAULT: 7
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Max Expire Days*:</td>
<td><input type="number" name="maxexp" maxlength="3" min="1" value="<?php echo $setting->maxexp;?>" required />
<br />
Maximum amount of days a contract is available before it gets replaced (if nobody books the flight) DEFAULT: 31
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Prefered Airport 1 (ICAO):</td>
<td><input type="text" name="prefaptA" maxlength="4" style="text-transform:uppercase;" value="<?php echo $setting->prefaptA;?>" />
<br />
You may choose up to 3 prefered airports. There is a 50% chance that a newly created contract departs at one of them. OPTIONAL
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Prefered Airport 2 (ICAO):</td>
<td><input type="text" name="prefaptB" maxlength="4" style="text-transform:uppercase;" value="<?php echo $setting->prefaptB;?>" />
<br />
You may choose up to 3 prefered airports. There is a 50% chance that a newly created contract departs at one of them. OPTIONAL
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">Prefered Airport 3 (ICAO):</td>
<td><input type="text" name="prefaptC" maxlength="4" style="text-transform:uppercase;" value="<?php echo $setting->prefaptC;?>" />
<br />
You may choose up to 3 prefered airports. There is a 50% chance that a newly created contract departs at one of them. OPTIONAL
</td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">CargoPage Content:</td>
<td><textarea id="editor" name="indextext" cols="110" rows="8"><?php echo $setting->indextext; ?></textarea></td>
</tr>
<tr>
<td valign="top" style="font-weight:bold">CronJob Active:</td>
<td>
<select name="cronjobactive">
                         <?php 
                       
                         if($setting->cronjobactive == "0") { 
                         $sel1 = "selected";
                         }
                         elseif($setting->cronjobactive == "1") { 
                         $sel2 = "selected";
                         }
                         ;?>
                         
                         
				      <option value="0" <?php echo $sel1 ?>>No</option>
                 <option value="1" <?php echo $sel2 ?>>Yes</option>
                
 </select>
<br />
Please only set this to YES if you run the Cron Job! (See Link Below) RECOMMENDED
 </td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
<br />
<br />

<h3>CronJob</h3>
It his highly recommended to setup a Cron Job to execute the following URL. If you do so please select YES in the Cron Job Active field above. (This reduces loading times since it stops the onload contract calculations):
<br />
<br />
<?php echo SITE_URL?>/action.php/CargoOps/createnewcontracts
<br />
<br />
<br />
<br />

























