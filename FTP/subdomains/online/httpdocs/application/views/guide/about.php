
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/admin.css">

		<script src="<?=base_url()?>public/scripts/jquery-1.6.js" type="text/javascript"></script>
		<!-- tinyscrollbar -->
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>
	<!-- tinyscrollbar -->


<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT About_Us_En,About_Us_Th FROM shopping_guide";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>

		
		<!-- Body Section -->
		<div id="title_head">
		SHOPPING GUIDE
		</div>
		<div id="content" class="clearfix" >
		    <div id="leftcolum">
			<ul>
				<a href="about">About Us</a>
				<br><br><a href="payment">Payment & Delivery</a>
				<br><br><a href="exchange">Return & Exchange</a>
				<!--<br><br><a href="technology">Technology</a>
				<br><br><a href="faq">FAQ</a>-->
		   	</ul>
			</div>

			<div id="centercolum" >
						<h2><?=(LANG=='TH')?'เกี่ยวกับเรา':"About Us";?></h2>

						<div id="scrollbar1" class="clearfix" style="width:420px;">
					<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
						
				<?
				while ($data=mysql_fetch_array($result))
				{?><div class="viewport" style="width:400px">
							<div class="overview" >
					<?
					if(LANG=='TH')
						echo $data['About_Us_Th'];
					else
						echo $data['About_Us_En'];
					?></div>  <!-- overview -->
						</div>  <!-- viewport -->
				</div> <!-- scrollbar1 -->
				<?}?>
		    </div>
		
		        	
			<div id="rightcolum">
				<iframe width="345px" height="240px" src="http://www.youtube.com/embed/CTbivc87XKs" frameborder="0" allowfullscreen></iframe>
				<div id="blockContact">
					<h2>GET IN TOUCH</h2>
					<?=form_open('mail/get_in_touch')?>
	              		<table id="tblContact" width="360" border="0" cellspacing="0" cellpadding="2" style="border: none;">
	                  		<tbody>
	                  			<tr>
	                    			<td width="168">E-mail</td>
	                   				 <td width="178" style="padding-left: 10px;">Country</td>
	                  			</tr>
	                  			<tr>
	                    			<td><input name="email" type="text" id="email" maxlength="255"></td>
	                   				<td align="right"><input name="country" type="text" id="country" maxlength="50"></td>
	                  			</tr>	
								</tbody>
							</table>
									
	              		<table id="tblContact" width="360" border="0" cellspacing="0" cellpadding="2" style="border: none;">
							<tbody>
	                  			<tr>
	                    			<td colspan="2">Name - Last Name</td>
	                  			</tr>
	                  			<tr>
	                    			<td colspan="2"><input name="name" type="text" id="name" maxlength="255"></td>
	                  			</tr>
	                  			<tr>
	                    			<td colspan="2">Message</td>
	                  			</tr>
	                  			<tr>
	                    			<td colspan="2" style="width:340px"><textarea name="message" rows="5" id="message" ></textarea></td>
	                  			</tr>
	                  			<tr>
	                    			<td colspan="2"><input type="submit" name="btnSend" id="btnSend" value="SEND"></td>
	                  			</tr>
	                			</tbody>
	                	</table>
	                <?=form_close()?>
	            </div>

			</div>
		</div> <!-- End Content -->   	
