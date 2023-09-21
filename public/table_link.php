<!-------- results table output ------------>
<?php
	// variables used for the EDIT and AO function
	$mae_link = "http://testamigasource.com/ata/maestrotest/t_links.php?operation=edit&pk0=";
	$ao = "https://web.archive.org/web/2020*/";

?>
<center>
	<table cellpadding="1" cellspacing="0" width="95%"  bgcolor="#575748">
		<tr><td>
			<table width="100%" cellpadding="0"  cellspacing="0" bgcolor="#FFFFFF">
				<tr><td>
					<table width="100%"  cellspacing="0" cellpadding="0">
							<tr>
									<td align="left" valign="top" bgcolor="#FFFFFF">

									<!----------results icon pic (row 1: !C-2A) --------->
										<table width=100%>
											<TR>
												<TD rowspan="2" width="5%" align="center">
												
													<!----- NEW ICON: if date later than 2015-01-25 ----->
														<?php
															if ($line2['links_date_added']>'2015-01-25') { 
														?>
															<img src="/web_images/static/sm_new.gif" width=26 height=26> 

													<!----- DEAD ICON: if there is NO url ----->								
														<?php
															} elseif ($line2['links_url'] and $line2['links_archived_url']==='') {
															
														?>
															<img src="/web_images/static/sm_dead.gif" width=26 height=26> 
													
													<!----- ARCHIVED ICON: if there is NO url ----->							
														<?php
														
															} elseif ($line2['links_archived_url']<>'') { 
															
														?>
															<img src="/web_images/static/sm_archived.jpg" width=26 height=26>

													<!----- BOING BALL: else display boing ball ----->
														<?php
															} else {				
														?>
															<img src="/web_images/static/sm_boing.jpg" width=26 height=26>
														<?php
															}
														?>
												</TD>

									<!----------results site name as a link output (row 1: !C-2B) --------->
												<TD colspan="2" width=100% bgcolor=#FF2626>&nbsp;
													<a target=new href="
													<?php
														if ($line2['links_archived_url']<>null and $line2['links_active']="1") { ?>
															<font face="Verdana, sans-serif" size=1>
															<a target=new href="<?php echo $line2['links_archived_url'] ?>">
															
													<?php
														} else { ?>
															<font face="Verdana, sans-serif" size=1>
															<a target=new href="<?php echo $line2['links_url'] ;?>">
															
							<!----- use to add a link back to as
							<a target=new href=" <?php // echo $line2['links_url']."?utm-source=amigasource.com";?>"   -->

															<font face="Verdana, sans-serif" size=3 color=#ffffff> <b>
													<?php
														}
													?>	
															<font face="Verdana, sans-serif" size=3 color=#ffffff> <b>
																<?php 
																	$str=$line2['links_name'];
																	if(!isset($search_f)){
																	echo $str;
																	} else {
																	$str2=preg_replace("#(${'search_f'})#i", '<font size=5><b>$1</b><font size=2>', $str);
																	echo $str2;
															}
																?>
															</b></a>
												</TD>
											</TR>
										</table>
									<!----------results author & date added output (row 2: !C-2C) --------->
										 <table width=100%>
											<TR>
											<!----- if ARCHIVED then date archived and verified ----->					
												<?php
													if ($line2['links_archived_url']<>'') { 
												?>
														<TD width=40% bgcolor=#DDDDDD>&nbsp;
														<font face="Verdana, sans-serif" size=2><b> Author:</>
														<a href="<?php echo $line2['links_email'];?>">
															<?php 
																$str=$line2['links_author'];
																if(!isset($search_f)){
																echo $str;
																} else {
																$str2=preg_replace("#(${'search_f'})#i", '<font size=5><b>$1</b><font size=2>', $str);
																echo $str2;
																}
															?></a>
														</TD>
														<TD width=30% bgcolor=#DDDDDD>&nbsp;
														<font face="Verdana, sans-serif" size=2><b>Archived:</b>
														<?php echo $line2['links_archived_date'];?>
														</TD>
														<TD  bgcolor=#DDDDDD>&nbsp;
														<?php 
															if ($line2['links_date_verified']>'2021-12-21') { 
														?>	
															<font face="Verdana, sans-serif" size=2><b>Verified:</b>
															<font face="Verdana, sans-serif" size=5>
														<?php 	} else { 
														?>
															<font face="Verdana, sans-serif" size=2><b>Verified:</b>
														<?php 
														}
														?>
														<?php echo $line2['links_date_verified']; ?>
														<font face="Verdana, sans-serif" size=2>							
														</TD>		
													<?php
														} else {
													?>	
													<!----- AUTHOR ----->	
													<TD width=70% bgcolor=#DDDDDD>&nbsp;
														<font face="Verdana, sans-serif" size=2><b> Author:</>
														<a href="<?php echo $line2['links_email'];?>">
															<?php 
																$str=$line2['links_author'];
																if(!isset($search_f)){
																echo $str;
																} else {
																$str2=preg_replace("#(${'search_f'})#i", '<font size=5><b>$1</b><font size=2>', $str);
																echo $str2;
																}
															?></a>
													</TD>
														<!----- just date verified ----->	
															<TD  bgcolor=#DDDDDD>&nbsp;
															<?php 
																if ($line2['links_date_verified']>'2021-12-21') { 
															?>	
																<font face="Verdana, sans-serif" size=2><b>Verified:</b>
																<font face="Verdana, sans-serif" size=5>
															<?php 	} else { 
															?>
																<font face="Verdana, sans-serif" size=2><b>Verified:</b>
															<?php 
															}
															?>
															<?php echo $line2['links_date_verified']; ?>
															<font face="Verdana, sans-serif" size=2>	
															</TD>		
														<?php	
														}
														?>
											</TR>
										</table>
									<!----------results description output (row 3): !c-2E)  ---------> 
										<table width=100%>
											<TR>
												<TD colspan="3" bgcolor=#FFFFFF>&nbsp;
													<font face="Verdana, sans-serif" size=2>
														<?php 
															$str=$line2['links_desc'];
																														
															if ($line2['links_archived_url']<>'') { 
															echo "<b> {{ARCHIVED}} </b>";
															}
																if(!isset($search_f)){
																echo $str;
																} else {
																$str2=preg_replace("#(${'search_f'})#i", '<font size=5><b>$1</b><font size=2>', $str);
																echo $str2;
																}
														 ?>
												</TD>	
											</TR>
										</table>
									<!----------extras bar & archived stuff (row 4) --------->
										<table width=100%>
											<TR>
												<!----------results EDITOR (row 4: !C-2f) --------->
												<TD  bgcolor=#DDDDDD width=10%>&nbsp;
													<font face="Verdana, sans-serif" size=2>
													<?php
														echo "<a target=\"_blank\" href=$mae_link".$line2['id'].">edit</a>";
													?>
												</TD>
												<!----------results category numbers (row 4: !C-2g) --------->
												<TD  bgcolor=#DDDDDD width=15%>&nbsp;
													<font face="Verdana, sans-serif" size=2>
													<?php
														echo "<a target=\"_blank\" href=$ao".$line2['links_url'].">archive.org</a> {temp}";
													?>
												</TD>
												<!----------results category numbers (row 4: !C-2h) --------->
												<TD  bgcolor=#DDDDDD>&nbsp;
													<font face="Verdana, sans-serif" size=1> 
													<b> cat #: </b>
													<?php 
														echo $line2['links_cat_1'];echo '  ';
														echo $line2['links_cat_2'];echo '  ';
														echo $line2['links_cat_3'];echo '  ';
														echo $line2['links_cat_4'];echo '  ';
														echo $line2['links_cat_5'];echo '  ';
														echo $line2['links_cat_6'];echo '  ';
														echo $line2['links_cat_7'];echo '  ';
														echo $line2['links_cat_8'];echo '  ';
														echo $line2['links_cat_9'];echo '  ';
														echo $line2['links_cat_10'];echo '  ';
													?>
												</TD>
												<!----------results id #### (row 4: !C-2i) --------->
												<TD  bgcolor=#DDDDDD>&nbsp;
													<font face="Verdana, sans-serif" size=2> 
													<b> id: </b>
													<?php echo $line2['id'];?>
												</TD>
											</TR>
										</table>
										
			</td></tr></table>
			</td></tr></table>
			</td></tr></table>
	<table>
		<tr>
			<font size=1>
			&nbsp;  
		</tr>
	</table>
</center>