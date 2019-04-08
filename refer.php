<?php

?>

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
	<!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	
	<script>
				$(document).ready(function(){
					
					$("button").click(function(){						
						var typ = $(this).attr('id');
						var getoffice = $("#getoffice"+typ).val();
						var value = $("#vid"+typ).val();
						if(getoffice!='' && value!=''){
							if((typ==1 && value>=60000) || (typ==2 && value>=200)){
								$("#fff").hide();
								$.post("alert.php", {getoffice:getoffice, vid:value, ptype:typ},function(response, status){ // Required Callback Function
									alert(response);//"response" receives - whatever written in echo of above PHP script.
									//alert(value);
									$("#fff").show(2000);
									location.reload(true);
								});
							}else{
								alert("ERROR! Transfering "+(typ==1?"#":"$")+value+"\n"+(typ==1?"You can not transfer bonus less than #60,000":"You can not transfer bonus less than $200"));
							}
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
					  <li><a href="office2.php">Get Alert</a></li>
					  <li><a href="">Referrals</a></li>
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
                      <a href="Settings.php">
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="help.php">Help</a></li>
                    <li><a href="../"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <?php $nummsg = mysqli_num_rows(mysqli_query($connection,"select * from messages where status=0 and member=".$_SESSION['uid'])); ?>
		<li role="presentation" class="dropdown">
                  <a href="message.php" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" title="You have <?php echo ($nummsg>0?$nummsg:'No'); ?> new messages">
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
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Referrals</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>		
			
			<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
                  <div class="x_title">
                    <h2 class="black">Referral Link<span class='small'> (Send your link to your friends and family)</span></h2>
                    <div class="clearfix"></div>
                  </div>
					<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="tile-stats alert-scd">				  
					  <h4 align='center'>https://www.get-alert.com/home?ref=<?php echo $_SESSION['acti']; ?></h4>
					</div>
					</div>	  
				</div>
			</div>
			</div>
			
			<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
                  <div class="x_title">
                    <h2 class="black">Invited People<span class='small'> (People you have invited)</span></h2>
                    <div class="clearfix"></div>
                  </div>
				  <?php
					$req3 = mysqli_query($connection,"select fullname,phone,signdate from members where refer=".$_SESSION['uid']);
					while($dx = mysqli_fetch_array($req3)){; 
				   ?>
					<div class="animated flipInY col-lg-2 col-md-2 col-sm-2 col-xs-12">
					<div class="tile-stats alert-info">		
					  <h5 align='center'><?php echo $dx['fullname'].'<br/>'.$dx['phone'].'<br/>Joined on '.date('D d/m/Y',$dx['signdate']); ?></h5>					
					</div>
					</div>
					<?php } ?>
				</div>
			</div>
			</div>
			
			<div class="row">
			<div class="col-md-6">
				<div class="x_panel">
                  <div class="x_title">
                    <h2 class="green">Referral Bonus &#8358;<span class='small'> (Click on the card if it is &#8358;60,000 or above)</span></h2>
                    <div class="clearfix"></div>
                  </div>
				  <?php
					$req1 = mysqli_query($connection,"select sum(value) as total from referrals where ptype=1 and paid=1 and gh=0 and member=".$_SESSION['uid']);
					$tnar = mysqli_fetch_array($req1)['total'];
				  ?>
				  <div class="modal fade bs1" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-sm">
					  <div class="modal-content">
						<div class="modal-header">
						  <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
						  </a>
						  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-money"></i> Bonus Alert</h4>
						</div>
						<div class="modal-body">					
						  <h5><b>Transfer Bonus Alert Card of &#8358; <?php echo ($tnar>0?$tnar:0); ?></b></h5>
						<form action="" method="post">
						  <p>Are you sure you want to transfer &#8358; <?php echo ($tnar>0?$tnar:0); ?> alert card? </p>	
						<input type="hidden" id="getoffice1" name="getoffice1" value="TRUE" />
						<input type="hidden" id="vid1" name="vid1" value="<?php echo ($tnar>0?$tnar:0); ?>" />
						<div class="modal-footer">
							<a class="btn btn-default" data-dismiss="modal">Cancel</a>
						  <button type="button" id="1" class="btn btn-primary" data-dismiss="modal" title='Clicking this means you agree to our terms'>Tranfer Alert Card</button>
						</div>
						</form>
					  </div>
					</div>
				  </div>
				  </div>
				  <a href="#" data-toggle="modal" data-target=".bs1" title='Click this card to transfer &#8358;<?php echo ($tnar>0?$tnar:0); ?> alert' id="nar">
					<div class="animated flipInY col-lg-6 col-lg-offset-2 col-md-6 col-sm-6 col-xs-12">
					<div class="tile-stats alert-success"><i class="fa "><b>&#8358;</b></i>
					  <div class="count1"> &nbsp;&#8358; <?php echo ($tnar>0?$tnar:0); ?></div>				  
					  <p>Click card to get alert</p>
					</div>
					</div>
				  </a>	  
				</div>
			</div>

			<div class="col-md-6">
				<div class="x_panel">
                  <div class="x_title">
                    <h2 class="green">Referral Bonus &#36;<span class='small'> (Click on the card if it is &#36;200 or above)</span></h2>
                    <div class="clearfix"></div>
                  </div>
				  <?php
					$req1 = mysqli_query($connection,"select sum(value) as total from referrals where ptype=2 and paid=1 and gh=0 and member=".$_SESSION['uid']);
					//$dn = mysqli_num_rows($req1);
					$tnar = mysqli_fetch_array($req1)['total'];
				  ?>
				 <div class="modal fade bs2" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-sm">
					  <div class="modal-content">
						<div class="modal-header">
						  <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
						  </a>
						  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-money"></i> Bonus Alert</h4>
						</div>
						<div class="modal-body">					
						  <h5><b>Transfer Bonus Alert Card of &#36; <?php echo ($tnar>0?$tnar:0); ?></b></h5>
						<form action="" method="post">
						  <p>Are you sure you want to transfer &#36; <?php echo ($tnar>0?$tnar:0); ?> alert card? </p>	
						<input type="hidden" id="getoffice2" name="getoffice2" value="TRUE" />
						<input type="hidden" id="vid2" name="vid2" value="<?php echo ($tnar>0?$tnar:0); ?>" />
						<div class="modal-footer">
							<a class="btn btn-default" data-dismiss="modal">Cancel</a>
						  <button type="button" id="2" class="btn btn-primary" data-dismiss="modal" title='Clicking this means you agree to our terms'>Tranfer Alert Card</button>
						</div>
						</form>
					  </div>
					</div>
				  </div>
				  </div>
				  <a href="#" data-toggle="modal" data-target=".bs2" title='Click this card to transfer &#36;<?php echo ($tnar>0?$tnar:0); ?> alert' id="nar">
					<div class="animated flipInY col-lg-6 col-lg-offset-2 col-md-6 col-sm-6 col-xs-12">
					<div class="tile-stats alert-success"><i class="fa fa-bitcoin"></i>
					  <div class="count1"> &nbsp;&nbsp;&nbsp;&#36; <?php echo ($tnar>0?$tnar:0); ?></div>				  
					  <p>Click card to get alert</p>
					</div>
					</div>
				  </a> 
				</div>
			</div>
			</div>
		
			<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Referral Transactions</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				
				<?php
					$req1 = mysqli_query($connection,"select * from referrals where member=".$_SESSION['uid']." order by id desc");					
				  ?>
				
                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 2%">#</th>
						  <th>Date</th>
						  <th>Member</th>
						  <th>Type</th>
                          <th>Amount Sent</th>
                          <th>Your Bonus</th>
						  <th>Available</th>
                          <th>status</th>
						  <th>Received</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
						$i = 0;
						while($dx = mysqli_fetch_array($req1)){ 
							$gmem = mysqli_fetch_array(mysqli_query($connection,"select * from members where id='".$dx['rmember']."'"));
							$i++;
					  ?>
                        <tr>
                          <td><?php echo $i; ?></td>
						  <td>
							<?php echo date('D d.m.Y ',$dx['day']); ?>
						  </td>
						  <td>
							<?php echo $gmem['fullname']; ?>
						  </td>
                          <td>
                            <a><?php echo($dx['ptype']==1?'<b>&#8358;</b> ':'<i class="fa fa-bitcoin"> </i>'); ?></a>
                          </td>
						  <td>
							<?php echo ($dx['ptype']==1?'&#8358; ':'$ ').$dx['amount']; ?>
						  </td>
						  <td>
							<?php echo ($dx['ptype']==1?'&#8358; ':'$ ').((int)str_replace(',','',$dx['amount'])*0.05); ?>
						  </td>
						  <td>
							<?php echo ($dx['ptype']==1?'&#8358; ':'$ ').$dx['value']; ?>
						  </td>
                          <td>
                            <button type="button" <?php echo($dx['paid']==0?'class="btn btn-warning btn-xs">Pending':'class="btn btn-success btn-xs">Completed'); ?></button>
                          </td>
                          <td><?php if($dx['gh']==0){ ?>
							<a class="btn btn-info btn-xs" title=""><i class="fa fa-money"></i> Pending <i class="fa fa-bolt"></i></a>
							<?php } else { ?>
							<a class="btn btn-danger btn-xs" title="You have received this"><i class="fa fa-money"></i> Withdrawn <i class="fa fa-check"></i></a>
							<?php } ?>
                          </td>
                        </tr>
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
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>