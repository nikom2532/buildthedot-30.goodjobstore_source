<div>MY INFO</div>

<div>
	<?=form_open('my/info_update')?>
		<input type="hidden" name="id" value="<?=set_value('id', '')?>"/>
		<table>
			<tr>
				<td>First Name</td>
				<td><input type="text" name="fname" id="fname" value="<?=set_value('fname', '')?>"/></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td><input type="text" name="lname" id="lname" value="<?=set_value('lname', '')?>"/></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" name="address" id="address" value="<?=set_value('address', '')?>"/></td>
			</tr>
			<tr>
				<td>City</td>
				<td><input type="text" name="city" id="city" value="<?=set_value('city', '')?>"/></td>
			</tr>
			<tr>
				<td>Country</td>
				<td>
					<select name="country_id" id="country_id">
						<option value=" ">------ Select Country -----</option>
						<?php foreach(get_select_country() as $value): ?>
							<option value="<?=$value->id?>" <?=set_select('country_id',$value->id)?>><?=$value->name?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Post Code</td>
				<td><input type="text" name="post_code" id="post_code" value="<?=set_value('post_code', '')?>"/></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td><input type="text" name="phone" id="phone" value="<?=set_value('phone', '')?>"/></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" name="email" id="email" value="<?=set_value('email', '')?>"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="checkbox" name="newsletter" value="1" <?=(set_value('newsletter', '')=='1')?'checked':'';?>/> Sign me up for newsletter.</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>New Password</td>
				<td><input type="password" name="password" id="password" value=""/></td>
			</tr>
			<tr>
				<td>Confirm New Password</td>
				<td><input type="password" name="password2" id="password2" value=""/></td>
			</tr>
		</table>
		
		<div><?=(!$success)?'':$success;?></div>
		<?if(isset($error))
		{
			echo "<font color={$error['color']}>";
			foreach ($error['data'] as $value)
			{
				echo "<p>{$value}</p>";
			}
			echo '</font>';
		}?>

		<div>
			<input type="submit" name ="update" value="UPDATE">
		</div>
	<?=form_close()?>
</div>