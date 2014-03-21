<script type="text/javascript" src="<?=base_url()?>public/js/files/login.js"></script>

<script>
function validate(){
	var ret = true;
	if(user.value == "")
	{
		warning1.style.display = "block";
		ret = false;
	}
	if(pass.value == "")
	{
		warning2.style.display = "block";
		ret = false;
	}
	return ret;
}
</script>

<?
if($this->session->userdata('logged_in'))
{
	$user = $this->session->userdata('user');
	$form_1 = 'login';
	$form_2 = 'recover';
	if(!empty($user->pic))
		$profile_pic = base_url($user->pic);
	else
		$profile_pic = base_url('public/images/users/userLogin2.png');
	$profile_name = $user->firstname." ".$user->lastname;
	$email_hide = "none";
	$email_value = $user->email;
	$error_msg = "password is missing!";
}
else
{
	$form_1 = 'recover';
	$form_2 = 'login';
	$profile_pic = base_url('public/images/users/userLogin2.png');
	$profile_name = "";
	$email_hide = "block";
	$email_value = "";
	$error_msg = "email or password is missing!";
}
?>

<!-- Login wrapper begins -->
<div class="loginWrapper">
	<!-- Current user form -->
	<?=form_open('auth/verify', 'id='.$form_1)?>
        <div class="loginPic">
			<a href="#" title=""><img src="<?=$profile_pic?>" alt="" style="width:108px;"/></a>
            <span><?=$profile_name?></span>
            <div class="loginActions">
                <div><a href="#" title="Change user" class="logleft flip"></a></div>
                <div><a href="#" title="Forgot password?" class="logright"></a></div>
            </div>
        </div>
        <table>
			<tr style="display:<?=$email_hide?>;">
				<td>
					<input type="text" name="username" placeholder="Confirm your email" class="loginUsername" value="<?=$email_value?>"/>
				</td>
			</tr>
			<tr>
				<td>
			        <input type="password" name="password" placeholder="Password" class="loginPassword" />
				<td>
			</tr>
			<?if(isset($error_login))
			{?>
				<tr>
					<td style="color:red; align:center">
						<?=$error_msg?>
					</td>
				</tr>
			<?}?>
        </table>
        <div class="logControl">
            <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember1" /><label for="remember1">Remember me</label></div>
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
            <div class="clear"></div>
        </div>
	<?=form_close()?>
    
    <!-- New user form -->
	<?=form_open('auth/verify', 'id='.$form_2)?>
        <div class="loginPic">
            <a href="#" title=""><img src="<?=base_url()?>public/images/users/userLogin2.png" alt="" style="width:108px;"/></a>
            <div class="loginActions">
                <div><a href="#" title="" class="logback flip"></a></div>
                <div><a href="#" title="Forgot password?" class="logright"></a></div>
            </div>
        </div>
            
        <input type="text" name="username" placeholder="Your email" class="loginUsername" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />
        
		<?if(isset($error_login))
		{?>
			<font style="color:red; align:center">
				<?=$error_login?>
			</font>
		<?}?>
        <div class="logControl">
            <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember2" /><label for="remember2">Remember me</label></div>
			<div><input type="submit" name="sign_in" value="Login" class="buttonM bBlue"/></div>
        </div>
	<?=form_close()?>
</div>