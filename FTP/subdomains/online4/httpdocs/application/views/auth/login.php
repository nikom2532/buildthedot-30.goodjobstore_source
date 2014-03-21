<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/login.css">

<!-- START jqueryPopUp -->
<script language="javascript" src="<?=base_url()?>public/scripts/modal.popup.js"></script>
<script language="javascript">
    $(document).ready(function() {
            
		//Change these values to style your modal popup
		var align = 'center';									//Valid values; left, right, center
		var top = 100; 											//Use an integer (in pixels)
		var width = 350; 										//Use an integer (in pixels)
		var padding = 10;										//Use an integer (in pixels)
		var backgroundColor = '#FFFFFF'; 						//Use any hex code
		var source = '<?=site_url()?>auth/forget'; 	//Refer to any page on your server, external pages are not valid e.g. http://www.google.co.uk
		var borderColor = '#333333'; 							//Use any hex code
		var borderWeight = 4; 									//Use an integer (in pixels)
		var borderRadius = 5; 									//Use an integer (in pixels)
		var fadeOutTime = 300; 									//Use any integer, 0 = no fade
		var disableColor = '#666666'; 							//Use any hex code
		var disableOpacity = 40; 								//Valid range 0-100
		var loadingImage = '<?=base_url()?>public/images/popupLoading.gif';		//Use relative path from this page
			
		//This method initialises the modal popup
        $(".modal").click(function() {
            modalPopup(align, top, width, padding, disableColor, disableOpacity, backgroundColor, borderColor, borderWeight, borderRadius, fadeOutTime, source, loadingImage);
        });
		
		//This method hides the popup when the escape key is pressed
		$(document).keyup(function(e) 
		{
			if (e.keyCode == 27) 
			{
				closePopup(fadeOutTime);
			}
		});
		
    });
</script>
<!-- END jqueryPopUp -->

		<!-- Welcom Section-->
		<div id="welcome">
			Welcome to Goodjob
		</div>
		<!-- Body Section -->
		<div id="content">
			<div id="signin">
				<span class="headerblock">
					Sign in
					<div class="smalltext">Please sign in to view or updates your Shopping Bag and Wishlist</div>
						<?php  
							if(isset($error_login))
							{
								echo "<font color={$error_login['color']}>";
								foreach ($error_login['data'] as $key => $value) 
								{
									echo "<p style='line-height:115%;'>{$value}</p>";
								}
								echo '</font>';
							}
						?>
					<?=form_open('auth/verify')?>
						<div id="textbox_name">Email</div>
						<input type="text" name="email" />
						<div id="textbox_name">Password</div>
						<input type="password" name="password" />
						<div class="forgetpassword"><a class="modal" href="javascript:void(0);">Forget your password?</a></div>
						<input type="submit" name="sign_in" value="SIGN IN" class="button"/>
					<?=form_close()?>
				</span>
			</div>
			<div id="signup">
				<span class="headerblock">
					Create an account
					<div class="smalltext">Register here to create your personal Shopping Bag and Wishlist</div>
						<?php  
							if(isset($error))
							{
								echo "<font color={$error['color']}>";
								foreach ($error['data'] as $key => $value) 
								{
									echo "<p style='line-height:115%;'>{$value}</p>";
								}
								echo '</font>';
							}
						?>
					<?=form_open('auth/registration')?>
						<div id="textbox_name">Email</div>
						<input type="text" name="Email" />
						<div id="textbox_name">Password</div>
						<input type="password" name="Password" /> 
						<div class="notice">(Must be at least 4 characters long)</div>
						<div id="textbox_name">Confirm Password</div>
						<input type="password" name="Password2" /> 

						<div class="newsletter">
							<input type="checkbox" name="newsletter" value="1" /> Sign me up for newsletter.
							<div class="register_button"><input type="submit" name="sign_up" value="Register Now" class="button"/></div>
						</div>
					<?=form_close()?>
				</span>
			</div>
		</div>