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
						var sendalert = $("#sendalert"+typ).val();
						var value = $("#vid"+typ).val();
						if(sendalert!='' && value!=''){
							$("#fff").hide();
							$.post("alert.php", { sendalert:sendalert,	vid:value},function(response,status){ // Required Callback Function
							alert(response);//"response" receives - whatever written in echo of above PHP script.
							//$("#fff").show(2000);
							location.reload(true);
							});
						}
					});					
					
				});
				
 function readURL(input) {
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
    	if (typeof (FileReader) != "undefined") {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#popu').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        }else{
          $('#popu').attr('src', '/res/images/alert/pop.png');
        }
    }else{
    	alert("Please select only image png, jpeg or jpg");
         $('#popu').attr('src', '/res/images/alert/pop.png');
    }
 }
				
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
		$dtime = date('D d.m.Y h:i:s A',(time()+(3*24*60*60)));
		if($act==0){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Your payment (POP) file  has been uploaded. It will be confirmed on or before ".$dtime."','success');
					}); </script>";
		}else if($act==8){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Your payment transaction ID  has been uploaded. It will be confirmed on or before ".$dtime."','success');
					}); </script>";
		}else if($act==7){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Sorry, there was an error saving the POP. File not found. Please try again or contact support.','failure');
					}); </script>";
		}else if($act==6){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Missing Tx ID please enter the bitcoin transaction ID.','failure');
					}); </script>";
		}else if($act==5){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('The transaction ID you entered is incorrect and does not tally with member wallet.\nCheck and type it again. ','failure');
					}); </script>";
		}else if($act==3){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Error! Only JPG, JPEG, & PNG files are allowed.','failure');
					}); </script>";
		}else if($act==2){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Error! The file you upload is more than 100kb. Reduce the file size','failure');
					}); </script>";
		}else if($act==1){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Error! The file you upload is not an image and cannot be uploaded','failure');
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
                      <li><a href="">Send Alert</a></li>
					  <li><a href="office2.php">Get Alert</a></li>
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
                        <span>Settings</span>
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
			
		
			<?php
				$mon = ["10,000","20,000","40,000","50,000","100,000","200,000","20","50","100","200","500","1000"];
				$pid = [7,8,9,1,2,3,10,4,5,6,11,12];
				
			?>
			<div class="row">
			<div class="col-md-6">
				<div class="x_panel">
                  <div class="x_title">
                    <h2 class="red">Send Alert &#8358; <?php if(isset($val)){echo $val;} ?><span class='small'> (Click on preferred card to send naira alert)</span></h2>
                    <div class="clearfix"></div>
                  </div>
					<?php
						for($i=0;$i<6;$i=$i+1){
					?>
						<div class="modal fade bs<?php echo $i+1; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-sm">
							  <div class="modal-content">
								<div class="modal-header">
								  <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
								  </a>
								  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-money"></i> Confirmation</h4>
								</div>
								<div class="modal-body">					
								  <h4><b>Send Alert Card &#8358; <?php echo $mon[$i]; ?></b></h4>
								<form action="" method="post">
								  <p>Are you sure you want to send &#8358; <?php echo $mon[$i]; ?> alert card? You get back 
								  &#8358;<?php echo ($mon[$i]+$mon[$i]*0.5).',000'; ?> alert after 30 days.</p>					  
									
									You will be paired any day after 8 days (<?php echo date('D d.m.Y',(time()+(8*60*60*24))); ?>) 
									and you must make payment before 3 days after you have been paired. Ensure you have your money readily available.					  
								</div>
								<input type="hidden" id="sendalert<?php echo $i; ?>" name="sendalert" value="TRUE" />
								<input type="hidden" id="vid<?php echo $i; ?>" name="vid" value="<?php echo $pid[$i]; ?>" />
								<div class="modal-footer">
									<a class="btn btn-default" data-dismiss="modal">Cancel</a>
								  <button type="button" id="<?php echo $i; ?>" class="btn btn-primary" data-dismiss="modal" title='Clicking this means you agree to our terms'>Send Alert Card</button>
								</div>
								</form>
							  </div>
							</div>
						</div>
			
			
						  <a  href="#" data-toggle="modal" data-target=".bs<?php echo $i+1; ?>" title='Click this card to send &#8358;<?php echo $mon[$i]; ?> alert' id="nar">
							<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="tile-stats alert-warning"><i class="fa "><b>&#8358;</b></i>
							  <div class="count1"> &nbsp;&#8358;<?php echo $mon[$i]; ?></div>				  
							  <p>150% After 30 days (&#8358;<?php echo ($mon[$i]+$mon[$i]*0.5).',000'; ?>)</p>
							</div>
							</div>
						 </a>
					<?php } ?>
					
					</div> 
					</div>

				<div class="col-md-6">
				<div class="x_panel">
                  <div class="x_title">
                    <h2 class="red">Send Alert &#36;<span class='small'> (Click on preferred card to send bitcoin alert)</span></h2>
                    <div class="clearfix"></div>
                  </div>
				  
				  <?php
						for($i=6;$i<12;$i=$i+1){
					?>
						<div class="modal fade bs<?php echo $i+1; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-sm">
							  <div class="modal-content">
								<div class="modal-header">
								  <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
								  </a>
								  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-money"></i> Confirmation</h4>
								</div>
								<div class="modal-body">					
								  <h4><b>Send Alert Card &#36; <?php echo $mon[$i]; ?></b></h4>
								  <form action="" method="post">
								  <p>Are you sure you want to send &#36; <?php echo $mon[$i]; ?> alert card? You get back 
								  &#36;<?php echo ($mon[$i]*2); ?> alert after 30 days.</p>					  
									
									You will be paired any day after 8 days (<?php echo date('D d.m.Y',(time()+(8*60*60*24))); ?>) 
									and you must make payment before 3 days after you have been paired. Ensure you have your money readily available.					  
								</div>
								<input type="hidden" id="sendalert<?php echo $i; ?>" name="sendalert" value="TRUE" />
								<input type="hidden" id="vid<?php echo $i; ?>" name="vid" value="<?php echo $pid[$i]; ?>" />
								<div class="modal-footer">
									<a class="btn btn-default" data-dismiss="modal">Cancel</a>
								  <button type="button" id="<?php echo $i; ?>" class="btn btn-primary" data-dismiss="modal" title='Clicking this means you agree to our terms'>Send Alert Card</button>
								</div>
								</form>
							  </div>
							</div>
						</div>
			
			
						  <a  href="#" data-toggle="modal" data-target=".bs<?php echo $i+1; ?>" title='Click this card to send &#36;<?php echo $mon[$i]; ?> alert'>
							<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
							  <div class="tile-stats alert-info"><i class="fa fa-bitcoin"></i>
							  <div class="count1"> &nbsp;&#36;<?php echo $mon[$i]; ?></div>				  
							  <p>200% After 30 days (&#36;<?php echo ($mon[$i]*2); ?>)</p>
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
                    <h2>Sent Alert Transactions</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  
				  <?php
					$req1 = mysqli_query($connection,"select * from ph where pmember=".$_SESSION['uid']." order by id desc");					
				  ?>

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 2%">#</th>
						  <th>Details</th>
						  <th>Alert ID</th>
                          <th>Transactions</th>
                          <th style="width: 15%">Paired (Send To)</th>
                          <th>Progress</th>
                          <th>Status</th>
                          <th>Details</th>
						  <th>Paid</th>
						  <th>Confirmation</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
						$i = 0;
						while($dx = mysqli_fetch_array($req1)){ 
						if($dx['gmember']!=0){
							$gmem = mysqli_fetch_array(mysqli_query($connection,"select * from members where id='".$dx['gmember']."'"));
						}						
						$mpay = mysqli_fetch_array(mysqli_query($connection,"select pamount, gamount, ptype from plans where id='".$dx['phid']."'"));
						$i++;
					  ?>
                        <tr>
                          <td><?php echo $i; ?></td>
						  <td>
							<a class="red">Sent Alert </a><br/><?php echo date('D d.m.Y ',$dx['pcreate']); ?>
						  </td>
						  <td>
							<?php echo $dx['details']; ?><br/><b>M:</b> <?php echo date('D d.m.Y',$dx['pcreate']+(30*60*60*24)); ?>
						  </td>
                          <td>
                            <a><?php $value = ((int)str_replace(',','',$mpay['pamount']));
								echo($mpay['ptype']==1?'<b>&#8358;</b>&nbsp; &#8358; ':'<i class="fa fa-bitcoin">&nbsp; $ ').number_format($value,2).'</i>'; ?>
							<br/>
							<?php $ch = (time()-$dx['pcreate'])/(30*60*60*24); if($ch >= 1){$ch = 1;} ?>
							<?php echo($mpay['ptype']==1?'<b>&#8358;</b>&nbsp; &#8358; '.number_format((($value/2*$ch)+$value),2):
							'<i class="fa fa-bitcoin"></i>&nbsp; $ '.number_format(($value*$ch)+$value,2));
								
							?>
							</a>
                          </td>						  
                          <td><?php if($dx['gmember']!=0){ ?>
                            <img src="res/profile/<?php echo $gmem['photo']; ?>" class="avatar" alt="Avatar">&nbsp;<b>Exp: </b><?php echo($dx['pdate']==0?'<div class="countdown'.$dx['id'].'"></div> '.date('D d.m.Y',$dx['exp']):'Paid on '.date('d.m.Y',$dx['pdate'])); ?>
                            <script>
                            	var timerx<?php echo $dx['id']; ?> = <?php echo ($dx['exp']-time()); ?>;
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
				  $('.countdown<?php echo $dx['id']; ?>').html('('+ hours<?php echo $dx['id']; ?> + ':' + minutes<?php echo $dx['id']; ?> + ':' + seconds<?php echo $dx['id']; ?> + ')');
				  timer2<?php echo $dx['id']; ?> = hours<?php echo $dx['id']; ?> + ':' + minutes<?php echo $dx['id']; ?> + ':' + seconds<?php echo $dx['id']; ?>;
				}, 1000);
                            </script>
							<br/>
						  <?php echo $gmem['fullname']; }else{ ?>
						  Not yet paired	<?php } ?>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress_sm">
								<?php $com = (int)(100 * $ch); ?>
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $com; ?>"></div>
                            </div>
                            <small><?php echo $com; ?>% Complete</small>
                          </td>
                          <td>
                            <a <?php echo($dx['status']==0?($dx['disputed']==0?'class="btn btn-warning btn-xs">Pending':'class="btn btn-danger btn-xs">disputed'):($dx['status']==1?'class="btn btn-success btn-xs">Completed':'class="btn btn-danger btn-xs">Cancelled')); ?>
							</a>
                          </td>
                          <td><?php if($dx['gmember']!=0){ ?>
                            <a href="#"  data-toggle="modal" data-target=".bsd<?php echo $dx['id']; ?>" title='Click this to view the details of the paired member'
							class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a> 
							<?php } else {echo 'Not Yet';} ?>
                          </td>
                          <td><?php if($dx['gmember']!=0){ ?>
							<a href="#"  data-toggle="modal" data-target=".bsp<?php echo $dx['id']; ?>" title='Click this to upload payment details'
							class="btn <?php echo($dx['pdate']==0?'btn-primary':'btn-success'); ?> btn-xs"><i class="fa fa-money"></i> <?php echo($dx['pdate']==0?'Upload POP':'Have Paid'); ?> </a>
							<?php } else {echo 'Not Yet';} ?>
                          </td>
						  <td>							
						<a <?php echo($dx['confirm']==0?'class="btn btn-warning btn-xs"><i class="fa fa-thumbs-down"></i>'.($dx['pdate']==0?' pending':' Awaiting Confirmation') : 'class="btn btn-success btn-xs"><i class="fa fa-thumbs-up"></i> confirmed'); ?>
						</a>
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
								  <h4><b>Member: <img src="res/profile/<?php echo $gmem['photo']; ?>" class="Avatar" alt=""  style="max-width:200px;max-height:200px;">
								  <?php echo $gmem['fullname']; ?></b></h4>
								  <p>Phone Number:  <?php echo $gmem['phone']; ?> <br/>
								  Account Name:  <?php echo $gmem['accname']; ?> <br/>
								  Account Number:  <?php echo $gmem['accnumber']; ?> <br/>
								  Bank Name:  <?php echo $gmem['accbank']; ?> <br/>
								  Wallet Address <i class="fa fa-bitcoin"></i>:  <?php echo $gmem['wallet']; ?> </p>
								  <p>You must send alert on or before <?php echo date('D d.m.Y h:i:s A',$dx['exp']); ?> </p>
								</div>
								<div class="modal-footer">
									<a class="btn btn-default" data-dismiss="modal">OK</a>
								</div>
								  </div>
								</div>
							</div>
							
							<div class="modal fade bsp<?php echo $dx['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-sm">
							  <div class="modal-content">
								<div class="modal-header">
								  <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
								  </a>
								  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-money"></i> Payment Uploads</h4>
								</div>
								<div class="modal-body">					
								  <h4><b>Proof of Payment (POP)</b></h4>
								<?php if($dx['pdate']==0){ ?>
								<form name="pop<?php echo $dx['id']; ?>" action="alert.php" method="post" enctype="multipart/form-data">
									<?php if($mpay['ptype']==1){ ?>
										<p>Upload the payment details <span class="small">Teller, Printout or Screenshot of payment.</span></p>
										<p>Select image to upload: <span class="small red">*Max file size <b>100kb</b> </span></p>
										<img class="img-responsive avatar-view" id="popu" src="res/images/alert/pop.png" alt="Avatar" title="Upload POP" style="max-width:200px;max-height:200px;">&nbsp;
											&nbsp;<input type="file" id="file" name="file" onchange="readURL(this)">
									<?php }else{ ?>									
										<input type="text" size="35" id="details<?php echo $dx['id']; ?>" name="details" placeholder="Paste Blockchain Transaction ID Here" required="required" />
									<?php } ?>									
									<input type="hidden" id="dup<?php echo $dx['id']; ?>" name="dup" />
									<input type="hidden" id="ptype<?php echo $dx['id']; ?>" name="ptype" value="<?php echo $mpay['ptype']; ?>" /> 
									<input type="hidden" id="phid<?php echo $dx['id']; ?>" name="phid" value="<?php echo $dx['id']; ?>" />
									<span class="small">*uploading a fake POP will terminate your account as all POP will be verified.<span>					  
								</div>
								<div class="modal-footer">									
									<a class="btn btn-default" data-dismiss="modal">Cancel</a>
								    <input type="submit" id="submit<?php echo $dx['id']; ?>" class="btn btn-primary" title='Clicking this means you have paid' value="Save Details" onclick="showDetails(<?php echo $dx['id']; ?>);"/>
								</div>
								</form>
								<?php }else{ ?>
									<?php if($mpay['ptype']==1){ ?>
									<p> Your upload </p>
									<a href="./res/images/alert/<?php echo $dx['alert']; ?>" target="_blank"><img src="res/images/alert/<?php echo $dx['alert']; ?>" class="Avatar" alt=""  style="max-width:200px;max-height:200px;"></a>
									<?php }else{ ?>
									<p>You sent <?php echo $dx['alert']; ?> to <?php echo $gmem['wallet']; ?> Wallet Address</p>
									<a href="https://blockchain.info/tx/<?php echo $dx['dalert']; ?>" target="_blank" class="btn btn-success">
									<i class="fa fa-bitcoin"></i>Check Transaction</a>
									<?php } ?>	
									</div>
									<span class="small">*Contact support if there is need to change your POP. Avoid fake POP<span>
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