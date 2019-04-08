<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Get Alert! | Office</title>

   <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">  
	<!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
	
	<script>
				$(document).ready(function(){
					
					$("button").click(function(){						
						var typ = $(this).attr('id');
						var getalert = $("#getalert"+typ).val();
						var value = $("#vid"+typ).val();
						var pfour = $("#pass"+typ).val();
						if(getalert!='' && value!=''){
							$.post("alert.php", {getalert:getalert, vid:value, oid:typ, pfour:pfour},function(response, status){ // Required Callback Function
								alert(response);//"response" receives - whatever written in echo of above PHP script.								
								location.reload(true);
							});
						}
					});			
					
					
				});
			</script>
	
  </head>

  <?php
require_once("../config/site_func.php");
include('../config/config.php');
if(isset($_SESSION['isLog'])){
	
	
}else{
	header('Location: ../');
}
?>
 
 <?php
 
 @$act = $_GET['act'];
	if(isset($act)){		
		$dtime = date('D d.m.Y h:i:s A',(time()+(1*24*60*60)));
		if($act==0){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('You have successfully extended your paired member time by 24hours.','success');
					}); </script>";
		}else if($act==1){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('You have successfully confirmed the payment.','success');
					}); </script>";
		}else if($act==2){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Sorry, there was an error during processing. Please try again or contact support.','failure');
					}); </script>";
		}
	}
 
 ?> 
  
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="" class="site_title"><i class="fa fa-usd"></i> <span>Get Alert! <i class="fa ">&#8358;</i></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="res/profile/<?php echo $_SESSION['pics']; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['name']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Office</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php">Dashboard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Accounts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="office.php">Send Alert</a></li>
					  <li><a href="">Get Alert</a></li>
					  <li><a href="refer.php">Referrals</a></li>
                      <li><a href="profile.php">Profile</a></li>
                      <li><a href="settings.php">Settings</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-phone"></i> Help <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					  <li><a href="dispute.php">Open Dipute</a></li>
                      <li><a href="message.php">Message</a></li>
                      <li><a href="support.php">Support</a></li>
                      <li><a href="help.php">Help</a></li>
                    </ul>
                  </li>
				  <li><a href="../"><i class="fa fa-sign-out"></i> Log Out</a>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings" href="settings.php">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="res/profile/<?php echo $_SESSION['pics']; ?>" alt=""><?php echo $_SESSION['name']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="profile.php"> Profile</a></li>
                    <li>
                      <a href="settings.php">
                        <span>settings</span>
                      </a>
                    </li>
                    <li><a href="help.php">Help</a></li>
                    <li><a href="../"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <?php $nummsg = mysqli_num_rows(mysqli_query($connection,"select * from messages where status=0 and member=".$_SESSION['uid'])); ?>
		<li role="presentation" class="dropdown">
                  <a href="message.php" class="dropdown-toggle info-number" aria-expanded="false" title="You have <?php echo ($nummsg>0?$nummsg:'No'); ?> unread messages">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green"><?php echo $nummsg; ?></span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

		        <!-- page content -->
        <div class="right_col" id="fff" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Alerts Office</h3>
              </div>
			  <div class="title_right green">
                <h3 id="sss"></h3>
              </div>
            </div>
            
            <div class="clearfix"></div>		
			
			<div class="row">
			<div class="col-md-6">
				<div class="x_panel">
                  <div class="x_title">
                    <h2 class="green">Get Alert &#8358;<span class='small'> (Click on preferred card to get naira alert)</span></h2>
                    <div class="clearfix"></div>
                  </div>
				  <?php
					//$req1 = mysqli_query($connection,"select * from plans where ptype=1 and id=(select ghid from office where member=".$_SESSION['uid'].")");
					$req1 = mysqli_query($connection,"select a.id as idx,a.ghid,a.member,b.gamount as gamount from office a, plans b where b.ptype=1 and a.ghid=b.id and a.member=".$_SESSION['uid']);
					while($dx1 = mysqli_fetch_array($req1)){
				  ?>
				  <div class="modal fade bs<?php echo $dx1['idx']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-sm">
					  <div class="modal-content">
						<div class="modal-header">
						  <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
						  </a>
						  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-money"></i> Confirmation</h4>
						</div>
						<div class="modal-body">					
						  <h4><b>Get Alert Card of &#8358; <?php echo $dx1['gamount']; ?></b></h4>
						<form action="" method="post">
						  <p>Are you sure you want to get &#8358; <?php echo $dx1['gamount']; ?> alert card? </p>					  
							
							You will be paired any time from (<?php echo date('D d.m.Y',(time()+(60*60*24))); ?>) 
							and you must confirm the payment on or before 3 days (<?php echo date('D d.m.Y h:i:s A',(time()+(4*60*60*24))); ?>) 
							after you have been paid or automatic confirmation will be issued. Ensure you confirm the payment with your bank or ATM before you confirm it.
							If you have been given a fake POP, open a dispute immediately.
						</div>
						Enter your 4-digit pin: <input type="password" name="pfour" id="pass<?php echo $dx1['idx']; ?>" />
						<input type="hidden" id="getalert<?php echo $dx1['idx']; ?>" name="getalert" value="TRUE" />
						<input type="hidden" id="vid<?php echo $dx1['idx']; ?>" name="vid" value="<?php echo $dx1['ghid']; ?>" />
						<div class="modal-footer">
							<a class="btn btn-default" data-dismiss="modal">Cancel</a>
						  <button type="button" id="<?php echo $dx1['idx']; ?>" class="btn btn-primary" data-dismiss="modal" title='Clicking this means you agree to our terms'>Get Alert Card</button>
						</div>
						</form>
					  </div>
					</div>
				  </div>
				  <a href="#" data-toggle="modal" data-target=".bs<?php echo $dx1['idx']; ?>" title='Click this card to get &#8358;<?php echo $dx1['gamount']; ?> alert' id="nar">
					<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="tile-stats alert-success"><i class="fa "><b>&#8358;</b></i>
					  <div class="count1"> &nbsp;&#8358;<?php echo $dx1['gamount']; ?></div>				  
					  <p>Click card to get alert</p>
					</div>
					</div>
				  </a>
					<?php } ?>	  
				</div>
			</div>

			<div class="col-md-6">
				<div class="x_panel">
                  <div class="x_title">
                    <h2 class="green">Get Alert &#36;<span class='small'> (Click on preferred card to get bitcoin alert)</span></h2>
                    <div class="clearfix"></div>
                  </div>
				  <?php
					$req1 = mysqli_query($connection,"select a.id as idx,a.ghid,a.member,b.gamount as gamount from office a, plans b where b.ptype=2 and a.ghid=b.id and a.member=".$_SESSION['uid']);
					while($dx1 = mysqli_fetch_array($req1)){
				  ?>
				  <div class="modal fade bs<?php echo $dx1['idx']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-sm">
					  <div class="modal-content">
						<div class="modal-header">
						  <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
						  </a>
						  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-money"></i> Confirmation</h4>
						</div>
						<div class="modal-body">					
						  <h4><b>Get Alert Card of &#36; <?php echo $dx1['gamount']; ?></b></h4>
						<form action="" method="post">
						  <p>Are you sure you want to get &#36; <?php echo $dx1['gamount']; ?> alert card? </p>					  
							
							You will be paired any time from (<?php echo date('D d.m.Y',(time()+(1*60*60*24))); ?>) 
							and you must confirm the payment on or before 3 days (<?php echo date('D d.m.Y h:i:s A',(time()+(4*60*60*24))); ?>) 
							after you have been paid or automatic confirmation will be issued. Ensure you have 3 confirmations of the payment transaction ID with blockchain  before you confirm it.
							If you have been given a fake POP, open a dispute immediately.
						</div>
						Enter your 4-digit pin: <br/><input type="password" id="pass<?php echo $dx1['idx']; ?>" />
						<input type="hidden" id="getalert<?php echo $dx1['idx']; ?>" name="getalert" value="TRUE" />
						<input type="hidden" id="vid<?php echo $dx1['idx']; ?>" name="vid" value="<?php echo $dx1['ghid']; ?>" />
						<div class="modal-footer">
							<a class="btn btn-default" data-dismiss="modal">Cancel</a>
						  <button type="button" id="<?php echo $dx1['idx']; ?>" class="btn btn-primary" data-dismiss="modal" title='Clicking this means you agree to our terms'>Get Alert Card</button>
						</div>
						</form>
					  </div>
					</div>
				  </div>
				  <a href="#" data-toggle="modal" data-target=".bs<?php echo $dx1['idx']; ?>" title='Click this card to get &#36;<?php echo $dx1['gamount']; ?> alert' id="dol">
					<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="tile-stats alert-success"><i class="fa fa-bitcoin"></i>
					  <div class="count1"> &nbsp;&nbsp;&nbsp;&#36; <?php echo $dx1['gamount']; ?></div>				  
					  <p>Click card to get alert</p>
					</div>
					</div>
				  </a>
				  <?php } ?>	 
				</div>
			</div>
			</div>
		
			<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Get Alert Transactions</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				
				<?php
					$req1 = mysqli_query($connection,"select * from gh where gmember=".$_SESSION['uid']." order by id desc");					
				  ?>
				
                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 2%">#</th>
						  <th>Details</th>
						  <th>Alert ID</th>
                          <th>Transactions</th>
                          <th style="width: 15%">Paired (Get From)</th>
                          <th>Status</th>
                          <th>Details</th>
						  <th>Received</th>
						  <th>Confirmation</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
						$i = 0;
						while($dx = mysqli_fetch_array($req1)){ 
						if($dx['pmember']!=0){
							$gmem = mysqli_fetch_array(mysqli_query($connection,"select * from members where id='".$dx['pmember']."'"));
							$pdxm = mysqli_fetch_array(mysqli_query($connection,"select id,pdate,confirm,status,exp,alert,dalert from ph where gdetails='".$dx['id']."'"));
							$paid = $pdxm['pdate'];
						}
						$mpay = mysqli_fetch_array(mysqli_query($connection,"select pamount, gamount, ptype from plans where id='".$dx['ghid']."'"));
						$i++;
					  ?>
                        <tr>
                          <td><?php echo $i; ?></td>
						  <td>
							<span class="green">Get Alert </span><br/><?php echo date('D d.m.Y ',$dx['gcreate']); ?>
						  </td>
						  <td>
							<?php echo $dx['details']; ?>
						  </td>
                          <td>
                            <a><?php echo($mpay['ptype']==1?'<b>&#8358;</b><br/><br/>&#8358; ':'<i class="fa fa-bitcoin"><br/><br/>$ ').$mpay['gamount'].'</i>'; ?></a>
                          </td>						  
                          <td><?php if($dx['pmember']!=0){ ?>
                            <img src="res/profile/<?php echo $gmem['photo']; ?>" class="avatar" alt="Avatar">&nbsp;<b>Exp:</b><?php echo($pdxm['pdate']==0?date('D d.m.Y', $pdxm['exp']):'Paid'); ?>
                            
                            <script>
                            	var timerx<?php echo $dx['id']; ?> = <?php echo ($pdxm['pdate']+(3*24*60*60)-time()); ?>;
                            	var h<?php echo $dx['id']; ?> = timerx<?php echo $dx['id']; ?>/3600;
                            	var m<?php echo $dx['id']; ?> = (timerx<?php echo $dx['id']; ?>%3600)/60;
                            	var s<?php echo $dx['id']; ?> = (timerx<?php echo $dx['id']; ?>%3600)%60;
                            	var timer2<?php echo $dx['id']; ?> = h<?php echo $dx['id']; ?>+":"+m<?php echo $dx['id']; ?>+":"+s<?php echo $dx['id']; ?>;
				var interval<?php echo $dx['id']; ?> = setInterval(function() {			
				  var timer<?php echo $dx['id']; ?> = timer2<?php echo $dx['id']; ?>.split(':');
				  //by parsing integer, I avoid all extra string processing
				  var hours<?php echo $dx['id']; ?> = parseInt(timer<?php echo $dx['id']; ?>[0], 10);
				  var minutes<?php echo $dx['id']; ?> = parseInt(timer<?php echo $dx['id']; ?>[1], 10);
				  var seconds<?php echo $dx['id']; ?> = parseInt(timer<?php echo $dx['id']; ?>[2], 10);
				  --seconds<?php echo $dx['id']; ?>;
				  minutes<?php echo $dx['id']; ?> = (seconds<?php echo $dx['id']; ?> < 0) ? --minutes<?php echo $dx['id']; ?> : minutes<?php echo $dx['id']; ?>;
				  hours<?php echo $dx['id']; ?> = (minutes<?php echo $dx['id']; ?> < 0) ? --hours<?php echo $dx['id']; ?> : hours<?php echo $dx['id']; ?>;
				  if (hours<?php echo $dx['id']; ?> < 0){hours<?php echo $dx['id']; ?>=0;minutes<?php echo $dx['id']; ?>=0;seconds<?php echo $dx['id']; ?>=0;}
				  seconds<?php echo $dx['id']; ?> = (seconds<?php echo $dx['id']; ?> < 0) ? 59 : seconds<?php echo $dx['id']; ?>;
				  seconds<?php echo $dx['id']; ?> = (seconds<?php echo $dx['id']; ?> < 10) ? '0' + seconds<?php echo $dx['id']; ?> : seconds<?php echo $dx['id']; ?>;
				  minutes<?php echo $dx['id']; ?> = (minutes<?php echo $dx['id']; ?> < 10) ? '0' + minutes<?php echo $dx['id']; ?> : minutes<?php echo $dx['id']; ?>;
				  $('.countdown<?php echo $dx['id']; ?>').html('('+ hours<?php echo $dx['id']; ?> + ':' + minutes<?php echo $dx['id']; ?> + ':' + seconds<?php echo $dx['id']; ?> + ') LEFT');
				  timer2<?php echo $dx['id']; ?> = hours<?php echo $dx['id']; ?> + ':' + minutes<?php echo $dx['id']; ?> + ':' + seconds<?php echo $dx['id']; ?>;
				}, 1000);
                            </script>
							<br/>
						  <?php echo $gmem['fullname']; }else{ ?>
						  Not yet paired	<?php } ?>
                          </td>
                          <td><?php if($dx['pmember']!=0){ ?>
                            <a <?php echo($pdxm['status']==0?($pdxm['confirm']==1?'class="btn btn-success btn-xs">Completed':($dx['disputed']==0?'class="btn btn-warning btn-xs">Pending':'class="btn btn-danger btn-xs">Disputed')):($pdxm['status']==1?'class="btn btn-success btn-xs">Completed':'class="btn btn-danger btn-xs">Cancelled')); ?></a> <?php }else{ ?>
                            <a <?php echo($pdxm['status']==0?'class="btn btn-warning btn-xs">Pending':($pdxm['status']==1?'class="btn btn-success btn-xs">Completed':'class="btn btn-danger btn-xs">Cancelled')); ?> </a> <?php } ?>
                          </td>
                          <td><?php if($dx['pmember']!=0){ if($paid !=0 ){ ?>
						  <b>PAID: </b><?php echo date('D d.m.Y',$paid).'<br/>'; }} ?>
						  <?php if($dx['pmember']!=0){ ?>
                            <a href="#"   data-toggle="modal" data-target=".bsd<?php echo $dx['id']; ?>" title='Click this to view the details of the paired member'
							class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
							<?php } else {echo 'Not Yet';} ?>
                          </td>
                          <td><?php if($dx['pmember']!=0){ ?>
						  <?php if($pdxm['confirm']==0){ ?>
							<a href="#"   data-toggle="modal" data-target=".bsp<?php echo $dx['id']; ?>" 
							class="btn btn-success btn-xs" title="Confirm you received this alert"><i class="fa fa-money"></i> Confirm <i class="fa fa-external-link"></i></a>
						  <?php }else{ ?>
							<a href="#"   data-toggle="modal" data-target=".bsp<?php echo $dx['id']; ?>" 
							class="btn btn-warning btn-xs" title="This payment has been confirmed"> Confirmed <i class="fa fa-check"></i></a>
						  <?php } if($dx['pdetails']==0 && $pdxm['pdate']==0){ ?>
							<a href="#"   data-toggle="modal" data-target=".bsd<?php echo $dx['id']; ?>" title='Click this to extend payment time by 24 hours'
							class="btn btn-info btn-xs"><i class="fa fa-calendar"></i> Extend <i class="fa fa-fighter-jet"></i></a>
							<?php } else{echo 'Extended';} } else {echo 'Not Yet';} ?>
                          </td>
						  <td>	<?php if($dx['pmember']!=0){ ?>
						  <?php echo (($pdxm['pdate']==0 || $dx['gdate']!=0)?'':'<div class="countdown'. $dx['id'] .'"></div>'.date('D d.m.Y h:i:s A',$pdxm['pdate']+(3*24*60*60))); ?>						
						<a <?php echo ($pdxm['confirm']==0?'class="btn btn-warning btn-xs" title="It will be automatically confirmed after the time elapsed"><i class="fa fa-thumbs-down"></i>'.($pdxm['pdate']==0?' pending':' Awaiting Confirmation') :'class="btn btn-success btn-xs"><i class="fa fa-thumbs-up"></i> Confirmed'); ?>
						</a>
						<?php }else{ ?>
						<a <?php echo($pdxm['confirm']==0?'class="btn btn-warning btn-xs"><i class="fa fa-thumbs-down"></i> Pending':'class="btn btn-success btn-xs"><i class="fa fa-thumbs-up"></i> Confirmed'); ?>
						</a>
						<?php } ?>
						  </td>
                        </tr>
						
						<div class="modal fade bsd<?php echo $dx['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-sm">
							  <div class="modal-content">
								<div class="modal-header">
								  <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
								  </a>
								  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-money"></i> Pairing Details</h4>
								</div>
								<?php 
									
								?>
								<div class="modal-body">					
								  <h4><b>Member that will send alert to you:<br/> <img src="res/profile/<?php echo $gmem['photo']; ?>" class="Avatar" alt="" style="max-width:200px;max-height:200px;">
								  <br/><?php echo $gmem['fullname']; ?></b></h4>
								  <p>Phone Number:  <?php echo $gmem['phone']; ?> <br/>
								  Account Name:  <?php echo $gmem['fullname'].' or '.$gmem['accname']; ?> <br/></p>
								  <?php if($pdxm['pdate']==0){ ?>
								<form name="extend<?php echo $dx['id']; ?>" action="alert.php" method="post">
									<p>Payment Proof Not found <span class="small">Teller, Printout or Screenshot of payment.</span></p>
									Please wait for payment by <?php echo $gmem['fullname']; ?>	you will be rematch after 
									<?php echo date('D d.m.Y h:i:s A',$pdxm['exp']); ?>. 
									You can extend payment time by 24 hours if you like to allow the other party to make payment.<br/>									
									<input type="hidden" id="extend<?php echo $dx['id'] ?>" name="extend" value="TRUE" />
									<input type="hidden" id="phid1<?php echo $dx['id'] ?>" name="phid" value="<?php echo $pdxm['id']; ?>" />
									<input type="hidden" id="ghid1<?php echo $dx['id'] ?>" name="ghid" value="<?php echo $dx['id']; ?>" />
									<span class="small">*Report a fake POP by opening a dispute. All POP will be verified.<span>					  
								</div>
								<div class="modal-footer">									
									<a class="btn btn-default" data-dismiss="modal">Cancel</a>
									<?php if($dx['pdetails']==0){ ?>
								    <input type="submit" name="submit" id="submit1<?php echo $dx['id'] ?>" class="btn btn-primary" title='Clicking this means you have agreed to extend time by 24 hours' value="Extend Time (24hrs)"/>
									<?php } ?>
								</div>
								</form>
								<?php }else{ ?>
								  <?php if($mpay['ptype']==1){ ?>
									<p> POP </p>
									<a href="./res/images/alert/<?php echo $pdxm['alert']; ?>" target="_blank"><img src="res/images/alert/<?php echo $pdxm['alert']; ?>" class="Avatar" alt=""></a>
									<?php }else{ ?>
									<p>Alert sent <?php echo $pdxm['alert']; ?> to <?php echo $_SESSION['wallet']; ?> Wallet Address</p>
									<a href="https://blockchain.info/tx/<?php echo $pdxm['dalert']; ?>" target="_blank" class="btn btn-success">
									<i class="fa fa-bitcoin"></i>Check Transaction</a>
									<?php } ?>	
									</div>
									<span class="small">*Open a dispute if it is a fake POP. Avoid fake POP<span>
								<div class="modal-footer">
									<a class="btn btn-default" data-dismiss="modal">OK</a>
								</div>
							<?php	}  ?>
								  </div>
								</div>
							</div>
							
							<div class="modal fade bsp<?php echo $dx['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-sm">
							  <div class="modal-content">
								<div class="modal-header">
								  <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
								  </a>
								  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-money"></i> Confirm Payment</h4>
								</div>
								<div class="modal-body">					
								  <h4><b>Payment Confirmation</b></h4>
								<?php if($pdxm['confirm']==0){ ?>
								<form name="confirm<?php echo $dx['id']; ?>" action="alert.php" method="post" enctype="multipart/form-data">
									<p>If you have received your alert, kindly confirm the payment by clicking on 'Confirm Payment' button.</p>
									<input type="hidden" id="confirm<?php echo $dx['id'] ?>" name="confirm" value="TRUE" /> 
									<input type="hidden" id="phid2<?php echo $dx['id'] ?>" name="phid" value="<?php echo $pdxm['id']; ?>" />
									<input type="hidden" id="ghid1<?php echo $dx['id'] ?>" name="ghid" value="<?php echo $dx['id']; ?>" />
									<span class="small">*Open a dispute if it is a fake POP. Avoid fake POP<span>					  
								</div>
								<div class="modal-footer">									
									<a class="btn btn-default" data-dismiss="modal">Cancel</a>
								    <input type="submit" name="submit" id="submit2<?php echo $dx['id'] ?>" class="btn btn-primary" title='Clicking this means you have received the alert' value="Confirm Payment" />
								</div>
								</form>
								<?php }else{ ?>
									<?php if($mpay['ptype']==1){ ?>
									<p> Payment already confimed </p>
									<a href="./res/images/alert/<?php echo $pdxm['alert']; ?>" target="_blank"><img src="res/images/alert/<?php echo $pdxm['alert']; ?>" class="Avatar" alt=""></a>
									<?php }else{ ?>
									<p>Confirmed: <?php echo $pdxm['alert']; ?> was sent to <?php echo $gmem['wallet']; ?> Wallet Address</p>
									<a href="https://blockchain.info/tx/<?php echo $pdxm['dalert']; ?>" target="_blank" class="btn btn-success">
									<i class="fa fa-bitcoin"></i>Check Transaction</a>
									<?php } ?>	
									</div>
									<span class="small">*This transaction has already been confirmed.<span>
								<div class="modal-footer">
									<a class="btn btn-default" data-dismiss="modal">OK</a>
								</div>
							<?php	}  ?>
								  </div>
								</div>
							</div>
						
						<?php } ?>
                      </tbody>
                    </table>
                    <!-- end project list -->

                  </div>
                </div>
              </div>
            </div>
			
			 </div>
        </div>
        <!-- /page content -->
		
		<!-- footer content -->
        <footer>
          <div class="pull-right">
            GetAlert &copy; 2017</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
	
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
	
	<script type="text/javascript">
	
		function showDetails(value){
			document.getElementByID("dup"+value).value="true";
		}
		function notifyUser(message,type){
			if(type=="success"){
				new PNotify({
                    title: 'Success',
				  type: 'success',
				  text: message,
				  nonblock: {
					  nonblock: true
				  },
				  styling: 'bootstrap3'
			    });
			}else if(type=="failure"){
				new PNotify({
                    title: 'Error Occured',
				  type: 'error',
				  text: message,
				  nonblock: {
					  nonblock: true
				  },
				  styling: 'bootstrap3'
			    });
			}else if(type=="wait"){
				new PNotify({
				  title: 'Information',
				  text: message,
				  type: 'info',
				  hide: false,
				  styling: 'bootstrap3',
				  addclass: 'dark'
				});
			}else{
				new PNotify({
                    title: 'Information',
				  type: 'info',
				  text: message,
				  nonblock: {
					  nonblock: true
				  },
				  styling: 'bootstrap3',
				  addclass: 'dark'
			    });
			}
		}
	</script>
  </body>
</html>