<?php

require_once("../config/site_func.php");
include('../config/config.php');
if(isset($_SESSION['isLog'])){
	
	
}else{
	header('Location: ../');
}
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
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
					
					$("#profile-tab2").hide();
					$("#poy").hide();
					$("button#btn1").click(function(){						
						var typ = $("input#ptype").val();
						if(typ != ''){
							$.post("alert.php", {check:true, typ:typ},function(response, status){ // Required Callback Function
								//alert(response);//"response" receives - whatever written in echo of above PHP script.
								//alert(response);
								if(response == 1){
									$("#profile-tab2").show();
									$("#poy").show(2000);
								}else{
									alert("ERROR! The pin or password you entered is wrong");
								}
							});
						}else{
							alert("ERROR! Please enter your password");
						}
					});	
						
					$("input#send").click(function(){
						var accname = $("input#accname").val();
						var accnumber = $("input#accnumber").val();
						var accbank = $("input#accbank").val();
						var wallet = $("input#wallet").val();
						var ptype1 = $("input#password").val();
						var ptype2 = $("input#password2").val();
						var pfour = $("input#pass").val();
						if((ptype1 == ptype2) && (ptype1.length > 5) && (pfour.length == 4) && (accnumber.length == 10)){
							var form_data = new FormData();
							form_data.append('account', true);
							form_data.append('accname',accname);
							form_data.append('accnumber',accnumber);
							form_data.append('accbank',accbank);
							form_data.append('wallet', wallet);
							form_data.append('ptype', ptype1);
							form_data.append('pfour', pfour);
							$.ajax({
								url: 'alert.php',
								dataType: 'text',
								cache: false,
								contentType: false,
								processData: false,
								data: form_data,
								type: 'post',
								success: function(response,status){
									alert(response);
									$("#poy").text(response);
									$("#poy").show(2000);
								}
							});
						}else{
							alert("ERROR! Check your pin length, password length or confirm the two password fields are the same\nAlso make sure your account number is 10 digits and your pin is 4 digits");
						}				
												
					});
										
				});
			</script>
  </head>

<?php 
  @$act = $_GET['act'];
	if(isset($act)){
	if($act==1 || $act==2){
		$req = mysqli_query($connection,"select * from members where id=".$_SESSION['uid']);
		$dn = mysqli_fetch_array($req);
		//session_start();
		$_SESSION['pin4'] = $dn['pin'];
		$_SESSION['accname'] = $dn['accname'];
		$_SESSION['accnumber'] = $dn['accnumber'];
		$_SESSION['accbank'] = $dn['accbank'];
		$_SESSION['wallet'] = $dn['wallet'];
	}
		if($act == 1){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Your account information has been saved successfully.','success');
					}); </script>";}else if($act == 2){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Your other account information as been saved. Bitcoin wallet address is not found or correct and can not be saved.','success');
					});
				</script>";//Error! The file you upload is more than 100kb.
		}else if($act == 3){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Please enter 4-digit pin that is required. Only digits are allowed.','failure');
					});
				</script>";
		}else if($act == 4){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('The password must be more than six characters','failure');
					});
				</script>";
		}else if($act == 5){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Password and password confirmation must be the same','failure');
					});
				</script>";
		}else if($act == 6){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Your pin should be 4 digits. Please enter only four numbers you will remember.','failure');
					});
				</script>";
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
					  <li><a href="office2.php">Get Alert</a></li>
					  <li><a href="refer.php">Referrals</a></li>
                      <li><a href="profile.php">Profile</a></li>
                      <li><a href="">Settings</a></li>
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
                <h3>Profile Settings</h3>
              </div>
				
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Profile <span class='small red'>*After updating your profile, please logout and re-login for it to take effect</span></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="res/profile/<?php echo $_SESSION['pics']; ?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?php echo $_SESSION['name']; ?></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $_SESSION['state']; ?>, <?php echo $_SESSION['country']; ?>
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> Registered Member
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-phone user-profile-icon"></i>
                          <?php echo $_SESSION['phone']; ?>
                        </li>
                      </ul>

                      <a class="btn btn-success" data-toggle="modal" data-target=".bs10-example-modal-sm"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
					<br/><span class='red'>*After updating your profile, please logout and re-login for it to take effect</span>					
					  <div class="modal fade bs10-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-sm">
									  <div class="modal-content">

										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
										  </button>
										  <h4 class="modal-title" id="myModalLabel2">Edit Profile</h4>
										</div>
										<div class="modal-body">
										
										  <h4><b>User <?php echo($_SESSION['pin4']==0?"Password":"4-digit pin"); ?></b></h4>
										  <form action="" method="post">
										  <p>Please enter your <?php echo($_SESSION['pin4']==0?"password":"4-digit pin"); ?> in the box below:</p>
										  
											<br/>
											<input type="password" id="ptype" class="form-control" name="ptype" placeholder="<?php echo($_SESSION['pin4']==0?"Password":"4-digit pin"); ?>"><br/>
											If you forget your pin or password, please contact support.
										  
										</div>
										<div class="modal-footer">
										  <button type="button" id="btn1" class="btn btn-primary" data-dismiss="modal">Continue</button>
										</div>
										</form>
									  </div>
									</div>
								  </div>
                      <br />                      
                    </div>
					
                    <div class="col-md-9 col-sm-9 col-xs-12">                      
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Account Information</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Edit Account Details</a>
                          </li>
			
                        </ul>
                        <div id="myTabContent" class="tab-content">

                            <!-- start recent activity -->
							
                            <!-- end recent activity -->
							
					
                          
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
						  <p>&nbsp;</p>
                            <form class="form-horizontal form-label-left" novalidate>
							<span class="section">Account Info</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">User Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="number" readonly="readonly" value="**********" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Account Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="number" readonly="readonly" value="<?php echo $_SESSION['accname']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Account Number</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="number" readonly="readonly" value="<?php echo $_SESSION['accnumber']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Account Bank</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="number" readonly="readonly" value="<?php echo $_SESSION['accbank']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Widthdrawal Wallet Address</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="number" readonly="readonly" value="<?php echo $_SESSION['wallet']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  </form>
					  <p id="poy" class="red"><b>*Click on Edit Account Details to edit your information</b></p>
                          </div>
						  
						  
						  
					<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
					<p>&nbsp;</p>
						<form class="form-horizontal form-label-left" method="post" action="alert.php" novalidate>
                      
                      <span class="section">Account Info </span>				  
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="accname">Account Name <small class="red">Full name (Bank Account)</small><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="accname" name="accname" value="<?php echo $_SESSION['accname']; ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="accnumber">Account Number <small class="red">10 digits</small><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="accnumber" name="accnumber" value="<?php echo $_SESSION['accnumber']; ?>" required="required" data-validate-length="10" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="accbank">Account Bank <small class="red">Bank Name</small><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="accbank" name="accbank" value="<?php echo $_SESSION['accbank']; ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="wallet">Bitcoin Wallet Address <small class="blue">optional</small>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="wallet" name="wallet"  value="<?php echo $_SESSION['wallet']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pin">4-digit PIN <small class="rex">4 digits</small>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="pass" name="pfour"  <?php if($_SESSION['pin4']!=0){ ?> value="<?php echo $_SESSION['pin4']; ?>" readonly="readonly" <?php }else{ ?> required="required" <?php } ?> class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password <small class="red">min.6 & max.20 characters</small></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" type="password" name="ptype" class="form-control col-md-7 col-xs-12" required="required" data-validate-length-range="6,20">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password2" type="password" name="ptype2" data-validate-linked="ptype" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <input type="hidden" name="account" value="TRUE" />
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <input type="reset" class="btn btn-primary" value='Reset' />
                          <input id="send123" type="submit" class="btn btn-success" value="submit" />
                        </div>
                      </div>
                    </form>
						  </div>
						  
						  
						  
						  
                        </div>
                      </div>
                    </div>
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
    <!-- morris.js -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
    
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
	
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
	
	<script type="text/javascript">
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