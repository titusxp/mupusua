<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

//  Copyright:  (C) 10.2008 joomla-best.com. All Rights Reserved.
//  License:	GNU/GPL 
//  Website: 	http://www.joomla-best.com

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
	
<head>
	<jdoc:include type="head" />
	
	<?php
	
	// ### USTAWIENIA STANDARDOWE ### //
		$numertemplatki = 'template4';
		$sciezkat = $this->baseurl.'/templates/'.$numertemplatki;
		$narzedzia_strony = $this->params->get("Pokaz_Narzedzia", "0"); 
		$default_width = $this->params->get("Rozmiar_Strony", "standard");
		$default_css = $this->params->get("Styl_Strony", "multi");
		$default_font  = $this->params->get("Rozmiar_Czcionki", "standard"); 
		$menu_name = $this->params->get("Nazwa_Menu", "mainmenu");
		$menustyle = $this->params->get("Rodzaj_Menu", "2");
		$tlo = $this->params->get("Tlo", "bg1");
		$slwidth = $this->params->get("Szerokosc_slajdow", 450);
		include ("templates/".$this->template ."/php/narzedzia.php");
	?>
	
	<?php 
		include ("templates/".$this->template ."/php/sekcjahead.php");
		include ("templates/".$this->template ."/php/tmplmenu.php");
		include ("templates/".$this->template ."/php/automoduly.php");
	?>

</head>
	
<body>
	<div id="cient">
		<div id="stronad">
			<div id="stronag">	
				<div id="cienp">
					<div id="cienl">
						<div id="rozmiary2" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">
							
							<?php if ($this->countModules( 'tpanel' )) { ?>
								<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template?>/js/warstwag.js"></script>
								<div id="paneltop">
									<div id="panela">
										<div id="paneltlo">
											<div id="panelmodul">
												<jdoc:include type="modules" name="tpanel" style="raw" />
											</div>
										</div>
										<div id="panelnapist">
											<a><span id="panelnapis">&nbsp;</span></a>
										</div>
									</div>
								</div>
							<?php } ?>
							
							<div id="rozmiary4" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">
								<div id="naglowek1" class="clearfix">
									<div id="naglowek2">
										<jdoc:include type="modules" name="slogan" style="xhtml"/>
									</div>
									<div id="naglowek3">
										<jdoc:include type="modules" name="topmenu" style="xhtml"/>
									</div>
								</div>
							</div>
							
							<div class="clr"></div>
						</div>
										
						<div id="stronaa" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">
							<div id="stronagora" class="clearfix">
								<div id="stronagoraw">
									<div id="centrumtop">
										<div>	
											<div id="logo">
												<a href="<?php echo $this->baseurl ?>">
															<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo.png" alt="Logo" width="300" height="80" border="0"  />
												</a>
											</div>
											<?php if ($this->countModules( 'cpanel' )) { ?>
												<div id="mtloginpanel" style="width: 468px; height: 68px;">
													<jdoc:include type="modules" name="cpanel" style="none" />
												</div>
											<?php } ?>
											<?php if ($bannerjest == 1) { ?>	
												<div id="reklama1" style="width: 468px; height: 68px;">
													<jdoc:include type="modules" name="banner" style="none" />
												</div>
											<?php } ?>
										</div> 
									</div>
								</div>
							</div>							
						</div>
							
						<div id="stronac">
							<div id="dol" class="dol clearfix"></div>		
								<div id="cen4" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">
										
									<!--narzedzia-->	
									<div id="mtpasek" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">
										<div id="mtnarzedzia" style="height: 16px;">
												
											<?php
												if ( $narzedzia_strony == 0 || $narzedzia_strony == 2 || $narzedzia_strony == 4 || $narzedzia_strony == 6 )
													{		
														echo "<a href='".$sciezka."zmien_width=waska"."'><img src='".$sciezkat."/images/narzedzia/waska.png' alt='waska' /></a>";
														echo "<a href='".$sciezka."zmien_width=standard"."'><img src='".$sciezkat."/images/narzedzia/standard.png' alt='standard' /></a>";
														echo "<a href='".$sciezka."zmien_width=szeroka"."'><img src='".$sciezkat."/images/narzedzia/szeroka.png' alt='szeroka' /></a>";
														
													}
											?>	
											<?php
												if ( $narzedzia_strony == 0 || $narzedzia_strony == 3 || $narzedzia_strony == 5 || $narzedzia_strony == 6 )
													{
														echo "<a href='".$sciezka."zmien_font=mala"."'><img src='".$sciezkat."/images/narzedzia/mala.png' alt='mala' /></a>";
														echo "<a href='".$sciezka."zmien_font=standard"."'><img src='".$sciezkat."/images/narzedzia/srednia.png' alt='standard' /></a>";
														echo "<a href='".$sciezka."zmien_font=duza"."'><img src='".$sciezkat."/images/narzedzia/duza.png' alt='duza' /></a>";
													}
											?>
											<?php
												if ( $narzedzia_strony == 0 || $narzedzia_strony == 1 || $narzedzia_strony == 4 || $narzedzia_strony == 5 )
													{
														echo "<a href='".$sciezka."zmien_css=multi"."'><img src='".$sciezkat."/images/narzedzia/multi.png' alt='multi' /></a>";
														echo "<a href='".$sciezka."zmien_css=grey"."'><img src='".$sciezkat."/images/narzedzia/grey.png' alt='grey' /></a>";
														echo "<a href='".$sciezka."zmien_css=blue"."'><img src='".$sciezkat."/images/narzedzia/blue.png' alt='blue' /></a>";
														echo "<a href='".$sciezka."zmien_css=green"."'><img src='".$sciezkat."/images/narzedzia/green.png' alt='green' /></a>";
														echo "<a href='".$sciezka."zmien_css=red"."'><img src='".$sciezkat."/images/narzedzia/red.png' alt='red' /></a>";														
													}
											?>
												
										</div>
									</div>
									<div class="clr"></div>	
									<!--/narzedzia-->
										
									<div id="cen0" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $top5_width; ?>;">
										<div id="centrum6-s">
											<div id="centrum6-r">
												<div id="centrum6-l">
												<div id="odstep1"></div>
													<div id="cen5" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $top5_width; ?>;">				
														<?php if (($menustyle == 1) || ($menustyle == 2) || ($menustyle == 3)) { ?>		
															<div id="mtmenu" class="nav">
																<?php echo $main_menu; ?>
															</div>
															<?php if ($menustyle  == 2) { ?>
																<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template?>/js/slajd.js"></script>
															<?php } ?>
															<?php if ($menustyle  == 3) { ?>
																<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template?>/js/slajds.js"></script>
															<?php } ?>
																	
														<?php } ?>			
													</div>
													<div class="clr"></div>
												</div>
											</div>
										</div>
										<div class="clr"></div>
									</div>
									<div class="odstep10"></div>
											
									<!--header-->
									<?php if ($headerjest) { ?>
										<div id="cen1" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">
											<div id="cen2">										
												<?php if ($top1module) { ?>
													<div id="rozmiary1" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $top5_width; ?>;">
														<?php if ($top1module) { ?>
															<?php if ( $this->countModules('header') ) { ?>
																<div class="dlbox" style="width: <?php echo $top1width ?>;">
																	<jdoc:include type="modules" name="header" style="rounded"/>
																</div>
															<?php } ?>	
															<!--pokaz-->
															<?php if ($slajdjest) { ?>
																<div class="dlbox" style="width: <?php echo $top11width ?>;">					
																	<?php if ($slajdjest) { ?>
																		<div id="smodul">
																			<div id="rozmiar">
																				<div id="sli" class="sli">
																					<div>
																						<?php if ( $this->countModules('slide1') ) { ?>
																							<div style="width: <?php echo $top12width ?>;">
																								<jdoc:include type="modules" name="slide1" style="xhtml"/>
																							</div>
																						<?php } ?>
			
																						<?php if ( $this->countModules('slide2') ) { ?>
																							<div style="width: <?php echo $top12width ?>;">
																								<jdoc:include type="modules" name="slide2" style="xhtml"/>
																							</div>
																						<?php } ?>
				
																						<?php if ( $this->countModules('slide3') ) { ?>
																							<div style="width: <?php echo $top12width ?>;">
																								<jdoc:include type="modules" name="slide3" style="xhtml"/>
																							</div>
																						<?php } ?>
			
																						<?php if ( $this->countModules('slide4') ) { ?>
																							<div style="width: <?php echo $top12width ?>;">
																								<jdoc:include type="modules" name="slide" style="xhtml"/>
																							</div>
																						<?php } ?>
			
																						<?php if ( $this->countModules('slide5') ) { ?>
																							<div style="width: <?php echo $top12width ?>;">
																								<jdoc:include type="modules" name="slide5" style="xhtml"/>
																							</div>
																						<?php } ?>
																					</div>
																					<script type='text/javascript'>
																						var  pokaz = new SimpleSlide("sli",{type: "scroll", direction: "forward", auto: "loop", time: 5000, duration: 500});
																							$('sli').addEvent('mouseenter', function(){pokaz.stop();});
																							$('sli').addEvent('mouseleave', function(){pokaz.start();});
																					</script>
																				</div>	
																				<div class="sguzik">
																					<?php if ( $liczba > 0 ) { ?>
																						<a  class="sgoto" onclick='javascript: pokaz.stop(); new SimpleSlide($("sli"),{type: "scroll", goTo: 1, duration: 600});'>
																							<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/pokaz/s1.png" width = "24" height = "24" alt="1" />
																						</a>
																					<?php } ?>
																					<?php if ( $liczba > 1 ) { ?>
																						<a  class="sgoto" onclick='javascript: pokaz.stop(); new SimpleSlide($("sli"),{type: "scroll", goTo: 2, duration: 600});'>
																							<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/pokaz/s2.png" width = "24" height = "24" alt="2" />
																						</a>
																					<?php } ?>
																					<?php if ( $liczba > 2 ) { ?>
																						<a  class="sgoto" onclick='javascript: pokaz.stop(); new SimpleSlide($("sli"),{type: "scroll", goTo: 3, duration: 600});'>
																							<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/pokaz/s3.png" width = "24" height = "24" alt="3" />
																						</a>
																					<?php } ?>
																					<?php if ( $liczba > 3 ) { ?>
																						<a  class="sgoto" onclick='javascript: pokaz.stop(); new SimpleSlide($("sli"),{type: "scroll", goTo: 4, duration: 600});'>
																							<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/pokaz/s4.png" width = "24" height = "24" alt="4" />
																						</a>
																					<?php } ?>
																					<?php if ( $liczba > 4 ) { ?>
																						<a  class="sgoto" onclick='javascript: pokaz.stop(); new SimpleSlide($("sli"),{type: "scroll", goTo: 5, duration: 600});'>
																							<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/pokaz/s5.png" width = "24" height = "24" alt="5" />
																						</a>
																					<?php } ?>
																									
																						<a class="sgoto" onclick='javascript: pokaz.stop(); new SimpleSlide("sli",{type: "scroll", direction: "back", duration: 600});'>
																							<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/pokaz/pop.png" width = "24" height = "24" alt="back" />
																						</a>
																						<a class="sgoto" onclick='javascript: pokaz.stop(); new SimpleSlide("sli",{type: "scroll", direction: "forward", duration: 600});'>
																							<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/pokaz/nas.png" width = "24" height = "24" alt="forward" />
																						</a>
																						<a  class="sgoto" onclick='javascript: pokaz.start();'>
																							<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/pokaz/sta.png" width = "24" height = "24" alt="start" />
																						</a>
																						<a  class="sgoto" onclick='javascript: pokaz.stop();'>
																							<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/pokaz/sto.png" width = "24" height = "24" alt="stop" />
																						</a>
																				</div>
																			</div> 
																		</div>
																	<?php } ?>
																</div>
															<?php } ?>
															<!--pokaz-->
																
															<?php if ( $this->countModules('header1') ) { ?>
																<div class="dlbox" style="width: <?php echo $top1width ?>;">
																	<jdoc:include type="modules" name="header1" style="rounded"/>
																</div>
															<?php } ?>
														<?php } ?>		
													</div>	
												<?php } ?>		
											</div>
											<div class="clr"></div>			
										</div>
									<?php } ?>
									<!--/header-->
									<div class="odstep5"></div>
										
									<div id="cen9" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">
										<div id="pozycja">
											<div id="droga">
												<?php if ($mainmodule) { ?>
													<jdoc:include type="modules" name="breadcrumb" style="raw" />
												<?php } ?>
											</div>
												
											<?php if($this->countModules('search')) { ?>
												<div id="szukajka">
													<jdoc:include type="modules" name="search" style="raw" />
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="odstep10"></div>
										
									<!--srodek-->
									<div id="cen" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">
										<?php if ($centrummodule) { ?>
											<div id="dol1" class="dol1 clearfix">
												
												<!--lewa-->
												<?php if ($centrummodule) { ?>
													<div class="dlbox1" style="width: <?php echo $top1_width ?>;">
														<!--top5-->
														<?php if ($top5module) { ?>
															<div class="rozmiary" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $top5_width; ?>;">
																<?php if ($top5module) { ?>
																	<div id="dol2" class="dol2 clearfix">
								
																		<?php if ( $this->countModules('content1') ) { ?>
																			<div class="dlbox" style="width: <?php echo $top5width ?>;">
																				<jdoc:include type="modules" name="content1" style="xhtml"/>
																			</div>
																		<?php } ?>
			
																		<?php if ( $this->countModules('content2') ) { ?>
																			<div class="dlbox" style="width: <?php echo $top5width ?>;">
																				<jdoc:include type="modules" name="content2" style="xhtml"/>
																			</div>
																		<?php } ?>
									
																		<?php if ( $this->countModules('content3') ) { ?>
																			<div class="dlbox" style="width: <?php echo $top5width ?>;">
																				<jdoc:include type="modules" name="content3" style="xhtml"/>
																			</div>
																		<?php } ?>
			
																		<?php if ( $this->countModules('content4') ) { ?>
																			<div class="dlbox" style="width: <?php echo $top5width ?>;">
																				<jdoc:include type="modules" name="content4" style="xhtml"/>
																			</div>
																		<?php } ?>	
								
																		<?php if ( $this->countModules('content5') ) { ?>
																			<div class="dlbox" style="width: <?php echo $top5width ?>;">
																				<jdoc:include type="modules" name="content5" style="xhtml"/>
																			</div>
																		<?php } ?>	
																	</div>
																<?php } ?>		
															</div>	
														<?php } ?>		
														<!--/top5-->
															
														<?php if ($mainmodule) { ?>
														<!--centrum-->
															
															<div id="cen3" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $top5_width; ?>;">
																<div id="centrum2-t">
																	<div id="centrum2-tl">
																		<div id="centrum2-tr"></div>	
																	</div>
																	<div class="clr"></div>
																</div>
																<div id="centrum2-r">
																	<div id="centrum2-l" >
																		<div id="cen6" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $top4_width; ?>;">
																			<?php if ($this->countModules('left') || $this->countModules('ad')) { ?>
																				<div class="dl5box" style="width: <?php echo $leftwidth ?>;">
																					<jdoc:include type="modules" name="left" style="rounded"/>
																					<jdoc:include type="modules" name="ad" style="rounded"/>
																				</div>
																			<?php } ?>
																			<?php if ($this->countModules('top') || $this->countModules('bottom') || $mainmodule) { ?>
																				<div class="dl5box" style="width: <?php echo $mainwidth ?>;">												
																					<?php if ($this->countModules('top')) { ?>
																						<jdoc:include type="modules" name="top" style="rounded" />
																					<?php } ?>
																					<div id="main" style="width: 98%">
																						<jdoc:include type="message" />	
																						<jdoc:include type="component" />
																					</div>	
																					<?php if ($this->countModules('bottom')) { ?>
																						<jdoc:include type="modules" name="bottom" style="rounded" />
																					<?php } ?>		
																				</div>
																			<?php } ?>
														
																			<?php if ($this->countModules('right') || $this->countModules('ad1')) { ?>
																				<div class="dl5box" style="width: <?php echo $rightwidth ?>;">
																					<jdoc:include type="modules" name="right" style="rounded"/>
																					<jdoc:include type="modules" name="ad1" style="rounded"/>
																				</div>
																			<?php } ?>
																		</div>
																		<div class="clr"></div>
																	</div>
																</div>
																<div class="clr"></div>	
																<div class="rozmiary" style="font-size:<?php echo $tpl_font; ?>;">
																	<div id="centrum2-b">
																		<div id="centrum2-bl">
																			<div id="centrum2-br"></div>
																		</div>
																	</div>
																</div>
																<div class="clr"></div>
															</div>	
														<?php } ?>
														<!--/centrum-->	
													</div>
												<?php } ?>
												<!--/lewa-->
												
												<!--prawa-->
												<?php if ($reklamajest) { ?>
													<div class="dlbox" style="width: <?php echo $top2_width ?>;">	
														<?php if ($this->countModules('gallery')) { ?>
															<div id="rek1" style="font-size:<?php echo $tpl_font; ?>;">
																<div id="rek11">
																	<div id="rek111">
																		<div class="dl3box" style="width: <?php echo $top4_width ?>;">
																			<div id="rek124">
																				<jdoc:include type="modules" name="gallery" style="xhtml"/>
																			</div>
																		</div>
																	<div class="clr"></div>
																	</div>
																</div>
															</div>	
														<?php } ?>
														<?php if ($this->countModules('advert')) { ?>
															<div id="rek5" style="font-size:<?php echo $tpl_font; ?>;">
																<div class="dl4box" style="width: <?php echo $top4_width ?>;">
																	<div id="rek122">
																		<jdoc:include type="modules" name="advert" style="rounded"/>
																	</div>
																</div>
																<div class="clr"></div>
															</div>
															<div class="odstep5"></div>	
														<?php } ?>	
													</div>
												<?php } ?>
												<!--/prawa-->
														
											</div>
										<?php } ?>	
									</div>
									<!--srodek-->
										
									<!--bottom3-->		
									<div id="cen7" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">	
										
											<?php if ($bottom3module) { ?>
												<div class="odstep10"></div>
												<div class="rozmiary" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">
													<?php if ($bottom3module) { ?>
														<div id="dol3" class="dol3 clearfix">
															<?php if ( $this->countModules('user1') ) { ?>
																<div class="dlbox" style="width: <?php echo $bottom3width ?>;">
																	<jdoc:include type="modules" name="user1" style="xhtml"/>
																</div>
															<?php } ?>
			
															<?php if ( $this->countModules('user2') ) { ?>
																<div class="dlbox" style="width: <?php echo $bottom3width ?>;">
																	<jdoc:include type="modules" name="user2" style="xhtml"/>
																</div>
															<?php } ?>
									
															<?php if ( $this->countModules('user3') ) { ?>
																<div class="dlbox" style="width: <?php echo $bottom3width ?>;">
																	<jdoc:include type="modules" name="user3" style="xhtml"/>
																</div>
															<?php } ?>
			
															<?php if ( $this->countModules('user4') ) { ?>
																<div class="dlbox" style="width: <?php echo $bottom3width ?>;">
																	<jdoc:include type="modules" name="user4" style="xhtml"/>
																</div>
															<?php } ?>
								
															<?php if ( $this->countModules('user5') ) { ?>
																<div class="dlbox" style="width: <?php echo $bottom3width ?>;">
																	<jdoc:include type="modules" name="user5" style="xhtml"/>
																</div>
															<?php } ?>
														</div>
													<?php } ?>		
												</div>
													
											<?php } ?>	
											
									</div>
									<!--/bottom3-->
								
									<!--bottom2-->		
									<div id="roz2" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">	
										
											<?php if ($bottom2module) { ?>
												
												<div class="rozmiary" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">
													<?php if ($bottom2module) { ?>
														<div id="dol4" class="dol4 clearfix">
															<?php if ( $this->countModules('advert1') ) { ?>
																<div class="dlbox" style="width: <?php echo $bottom2width ?>;">
																	<jdoc:include type="modules" name="advert1" style="rounded"/>
																</div>
															<?php } ?>
			
															<?php if ( $this->countModules('advert2') ) { ?>
																<div class="dlbox" style="width: <?php echo $bottom2width ?>;">
																	<jdoc:include type="modules" name="advert2" style="rounded"/>
																</div>
															<?php } ?>
									
															<?php if ( $this->countModules('advert3') ) { ?>
																<div class="dlbox" style="width: <?php echo $bottom2width ?>;">
																	<jdoc:include type="modules" name="advert3" style="rounded"/>
																</div>
															<?php } ?>
			
															<?php if ( $this->countModules('advert4') ) { ?>
																<div class="dlbox" style="width: <?php echo $bottom2width ?>;">
																	<jdoc:include type="modules" name="advert4" style="rounded"/>
																</div>
															<?php } ?>
								
															
														</div>
													<?php } ?>		
												</div>
														
											<?php } ?>	
										
									</div>
									<div class="odstep20"></div>
									<!--/bottom2-->
												
									<div id="rozmiary3" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width; ?>;">
										<div id="stopka">
											<div id="stopka1" class="clearfix">
												<jdoc:include type="modules" name="footer1" style="none"/>
												<div id="stopka2">
													<jdoc:include type="modules" name="footer" style="xhtml"/>
												</div>
												<div id="design">
													Design <a href="http://www.joomla-best.com"> JOOMLA-BEST</a>
												</div>
											</div>
										</div>
									</div>
								<div class="clr"></div>
							</div>	
						</div>	
						<div class="clr"></div>
						<!--/stronac-->
							
						<div class="odstep5"></div>
						<div id="odb1" style="font-size:<?php echo $tpl_font; ?>; width:<?php echo $tpl_width2; ?>;">		
							<div id="skoktop" align="center">
								<a href="#stronag" title="Top" >
									<img src="<?php echo $this->baseurl;?>/templates/<?php echo $this->template; ?>/images/top.png" border="0" alt="Top" title="Top" width="30" height="30" />
								</a>
							</div>
							<div class="clr"></div>
						</div>
						<jdoc:include type="modules" name="debug" />		
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>