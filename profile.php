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
					
					$("#profile-tab3").hide();
					$("#poy").hide();
					$("button#btn1").click(function(){						
						var typ = $("input#ptype").val();
						if(typ != ''){
							$.post("alert.php", {check:true, typ:typ},function(response, status){ // Required Callback Function
								//alert(response);//"response" receives - whatever written in echo of above PHP script.
								//alert(response);
								if(response == 1){
									$("#profile-tab3").show();
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
						var country = $("input#country").val();
						var state = $("input#state").val();
						var phone = $("input#phone").val();
						var det = $("#file").prop('files')[0];
						var form_data = new FormData();
						form_data.append('info', true);
						form_data.append('phone',phone);
						form_data.append('state',state);
						form_data.append('country',country);
						form_data.append('file', det);
						
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
					});
										
				});
				
function readURL(input) {
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
    	if (typeof (FileReader) != "undefined") {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profilepics').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        }else{
          $('#profilepics').attr('src', '/res/profile/<?php echo $_SESSION['pics']; ?>');
        }
    }else{
    	alert("Please select only image png, jpeg or jpg");
         $('#profilepics').attr('src', '/res/profile/<?php echo $_SESSION['pics']; ?>');
    }
}
				
			</script>
  </head>
 <?php 
  @$act = $_GET['act'];
	if(isset($act)){
	if($act==2 || $act==3){
		$req = mysqli_query($connection,"select * from members where id=".$_SESSION['uid']);
		$dn = mysqli_fetch_array($req);
		//session_start();
		$_SESSION['phone'] = $dn['phone'];
		$_SESSION['pics'] = $dn['photo'];
		$_SESSION['state'] = $dn['state'];
		$_SESSION['country'] = $dn['country'];
	}
		if($act == 2){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Your profile has been saved successfully.','success');
					}); </script>";}else if($act == 3){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Your profile has been saved. No image or picture was saved.','success');
					});
				</script>";//Error! The file you upload is more than 100kb.
		}else if($act == 1){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Sorry, there was an error updating your profile. Please try again later or contact support.','failure');
					});
				</script>";
		}else if($act == 0){
			echo "<script type='text/javascript'>
					$(document).ready(function(e){
						notifyUser('Sorry, your profile was not uploaded. Your picture file is more than 100kb','failure');
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
                      <li><a href="">Profile</a></li>
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
                    <h2>User Profile <span class="small blue">After updating your profile, please logout and re-login</span></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" id="profilepics" src="res/profile/<?php echo $_SESSION['pics']; ?>" alt="Avatar" title="Change the avatar">
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
						  <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false"><b>Edit Information</b></a>
                          </li>
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Basic Information</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">User Details</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Account Information</a>
                          </li>
				
						  
				
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
							
                            <!-- end recent activity -->
							
					<form class="form-horizontal form-label-left" novalidate>
					
					<p>&nbsp;</p>
					<span class="section">Profile Info</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" name="name" value="<?php echo $_SESSION['name']; ?>" readonly="readonly" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Username</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" name="email" readonly="readonly" value="<?php echo $_SESSION['email']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" name="confirm_email" readonly="readonly" value="<?php echo $_SESSION['email']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Registered Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="website" readonly="readonly" value="<?php echo date('D M d, Y h:i:s A',$_SESSION['regdate']); ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					 </form>
					
						<p id="poy" class="red"><b>*Click on Edit Information to edit your information</b></p>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <form class="form-horizontal form-label-left" novalidate>
					
					<p>&nbsp;</p>
					<span class="section">Profile Info</span>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="state">County/State</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="state" readonly="readonly" value="<?php echo $_SESSION['state']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="country" readonly="readonly" value="<?php echo $_SESSION['country']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Phone Number</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="number" readonly="readonly" value="<?php echo $_SESSION['phone']; ?>" data-validate-minmax="7,11" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					 </form>
                            <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <form class="form-horizontal form-label-left" novalidate>
							<span class="section">Profile Info</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">User Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="number" readonly="readonly" value="**********" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Account Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="number" readonly="readonly" value="<?php echo $_SESSION['accname']; ?>" class="form-control col-md-7 col-xs-12">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Bitcoin Wallet Address</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="number" readonly="readonly" value="<?php echo $_SESSION['wallet']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  </form>
                          </div>
						  
						  
						  
					<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="edit-tab">
						<form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="alert.php" novalidate>
                      
                      <span class="section">Edit Personal Info </span></span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="name" value="<?php echo $_SESSION['name']; ?>" readonly="readonly" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" readonly="readonly" value="<?php echo $_SESSION['email']; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="state">County/State <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="state" name="state" value="<?php echo $_SESSION['state']; ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="country" name="country" value="<?php echo $_SESSION['country']; ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="phone" name="phone" value="<?php echo $_SESSION['phone']; ?>" required="required"  data-validate-length-range="7,11" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">Photo Upload
							<small>Optional 100kb max</small>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type='file' id="file" accept="image/jpeg, image/png, image/jpg" name="file"  onchange="readURL(this)">
						</div>
					</div>
					<div>
					<p>Please go to Account Settings under Settings Menu to change your password and bank details</p>
					</div>
                      <input type="hidden" name="info" value="TRUE" />
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <input id="send123" type="submit" class="btn btn-success" value="Submit" />
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
	
	<!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
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