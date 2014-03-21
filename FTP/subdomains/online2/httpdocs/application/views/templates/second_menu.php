	<div class="secNav">
        <div class="secWrapper">
            <div class="secTop">
                <div class="balance">
                    <div class="balInfo">Balance:<span>Apr 21 2012</span></div>
                    <div class="balAmount"><span class="balBars"><!--5,10,15,20,18,16,14,20,15,16,12,10--></span><span>$58,990</span></div>
                </div>
            </div>
            
            <!-- Tabs container -->
            <div id="tab-container" class="tab-container">
                  <ul class="iconsLine ic2 etabs">
                    <li><a href="#tabs1" title=""><span class="icos-dcalendar"></span></a></li>
                  <li><a href="#tabs2" title=""><!--<span class="icos-user"></span>--></a></li>
                </ul> 
                <div class="divider"><span></span></div>
                
                <!-- tabs1 container -->
                <div id="tabs1">
                	<!-- create new order button -->
					<?if(isset($sec_menu))
					{?>
                		<div class="sidePad">
							<?foreach ($sec_menu['btn_menu'] as $key => $value) 
							{
								echo '<a href="'.$value['link_menu'].'" class="sideB bBlue mt10"';
								if(isset($value['btn_id']))
									echo 'id="'.$value['btn_id'].'"';
								if(isset($value['btn_style']))
									echo 'style="'.$value['btn_style'].'"';
								echo '>';
								if(isset($value['icon']))
									echo '<span class="icon-plus-2"></span>';
								echo $value['btn_menu'].'</a>';
							}?>
						</div>
                    <div class="divider"><span></span></div>
					<?}?>
                
					<!-- Sidebar datepicker -->
            		<div class="sideWidget">
                		<div class="inlinedate"></div>
            		</div>
					<div class="divider"><span></span></div>
            		
                    <!-- Userlist -->
                    <!--<ul class="userList">
                        <li>
                            <a href="#" title="">
                                <img src="<?=base_url('public/images/live/face1.png')?>" alt="" />
                                <span class="contactName">
                                    <strong>Eugene Kopyov <span>(5)</span></strong>
                                    <i>web &amp; ui designer</i>
                                </span>
                                <span class="status_away"></span>
                                <span class="clear"></span>
                            </a>
                        </li>
                    </ul>-->
                    <div class="clear"></div>
                </div>
                
                <!-- tabs2 container-->
                <!--<div id="tabs2">
                
                	<!-- Sidebar forms -->
                   <!-- <div class="sideWidget">
                        <div class="formRow">
                            <label>Usual input field:</label>
                            <input type="text" name="regular" placeholder="Your name" />
                        </div>
                        <div class="formRow">
                           <label>Usual password field:</label>
                            <input type="password" name="regular" placeholder="Your password" /> 
                        </div>
                        <div class="formRow">
                            <label>Single file uploader:</label>
                            <input type="file" class="fileInput" id="fileInput" />
                        </div>
                        <div class="formRow">
                            <label>Dropdown menu:</label>
                            <select name="select2" >
                                <option value="opt1">Usual select box</option>
                                <option value="opt2">Option 2</option>
                                <option value="opt3">Option 3</option>
                                <option value="opt4">Option 4</option>
                                <option value="opt5">Option 5</option>
                                <option value="opt6">Option 6</option>
                                <option value="opt7">Option 7</option>
                                <option value="opt8">Option 8</option>
                            </select>
                        </div>
                        
                        <div class="formRow searchDrop">
                            <label>Dropdown with search:</label>
                            <select data-placeholder="Choose a Country..." class="select" tabindex="2">
                                <option value=""></option> 
                                <option value="Cambodia">Cambodia</option> 
                                <option value="Cameroon">Cameroon</option> 
                                <option value="Canada">Canada</option> 
                                <option value="Cape Verde">Cape Verde</option> 
                                <option value="Cayman Islands">Cayman Islands</option> 
                                <option value="Central African Republic">Central African Republic</option> 
                                <option value="Chad">Chad</option> 
                                <option value="Chile">Chile</option> 
                                <option value="China">China</option> 
                                <option value="Christmas Island">Christmas Island</option> 
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
                                <option value="Colombia">Colombia</option> 
                                <option value="Comoros">Comoros</option> 
                                <option value="Congo">Congo</option> 
                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
                                <option value="Cook Islands">Cook Islands</option> 
                                <option value="Costa Rica">Costa Rica</option> 
                                <option value="Cote D'ivoire">Cote D'ivoire</option> 
                                <option value="Croatia">Croatia</option> 
                                <option value="Cuba">Cuba</option> 
                                <option value="Cyprus">Cyprus</option> 
                                <option value="Czech Republic">Czech Republic</option> 
                                <option value="Denmark">Denmark</option> 
                                <option value="Djibouti">Djibouti</option> 
                                <option value="Dominica">Dominica</option> 
                                <option value="Dominican Republic">Dominican Republic</option> 
                                <option value="Ecuador">Ecuador</option> 
                                <option value="Egypt">Egypt</option> 
                                <option value="El Salvador">El Salvador</option> 
                                <option value="Equatorial Guinea">Equatorial Guinea</option> 
                                <option value="Eritrea">Eritrea</option> 
                                <option value="Estonia">Estonia</option> 
                                <option value="Ethiopia">Ethiopia</option> 
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
                                <option value="Faroe Islands">Faroe Islands</option> 
                                <option value="Fiji">Fiji</option> 
                                <option value="Finland">Finland</option> 
                                <option value="France">France</option> 
                                <option value="French Guiana">French Guiana</option> 
                                <option value="French Polynesia">French Polynesia</option> 
                                <option value="French Southern Territories">French Southern Territories</option> 
                                <option value="Gabon">Gabon</option> 
                                <option value="Gambia">Gambia</option> 
                                <option value="Georgia">Georgia</option> 
                                <option value="Germany">Germany</option> 
                                <option value="Ghana">Ghana</option> 
                                <option value="Gibraltar">Gibraltar</option> 
                                <option value="Greece">Greece</option> 
                            </select>
                        </div>
                    
                        <div class="formRow">
                            <input type="checkbox" id="check2" name="chbox1" checked="checked" class="check" />
                            <label for="check2"  class="nopadding">Checkbox checked</label>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <input type="radio" id="radio1" name="question1" checked="checked" />
                            <label for="radio1"  class="nopadding">Usual radio button</label>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Usual textarea:</label>
                            <textarea rows="8" cols="" name="textarea" placeholder="Your message"></textarea>
                        </div>
                        <div class="formRow">
                            <input type="submit" class="buttonS bLightBlue" value="Submit button" />
                        </div>
                    </div>
                </div>-->
               
            </div>
           <!-- <div class="divider"><span></span></div>-->
        
       </div> 
       <div class="clear"></div>
   </div>