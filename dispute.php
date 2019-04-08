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
    <!-- Dropzone.js -->
    <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	<!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
	
	<script>
				$(document).ready(function(){
											
					$("input#send").click(function(){
						var alertid = $("input#alertid").val();
						var cat = $("select#cat").val();
						var msg = $("textarea#msg").val();
						var det = $("#photo").prop('files')[0];
						var pty = $("#disform").val();
						if(cat != -1){
							var form_data = new FormData();
							form_data.append('alertid',alertid);
							form_data.append('cat',cat);
							form_data.append('msg',msg);
							form_data.append('file', det);
							form_data.append('dispute', pty);
							$.ajax({
								url: 'alert.php',
								dataType: 'text',
								cache: false,
								contentType: false,
								processData: false,
								data: form_data,
								type: 'post',
								success: function(response){
									alert(response);
								}
							});
						}else{
							$("#mmsg").text("Please select a category");
						}				
												
					});
										
				});
			</script>
  </head>

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
                      <li><a href="settings.php">Settings</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-phone"></i> Help <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					  <li><a href="">Open Dipute</a></li>
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
                <h3>Dispute</h3>
              </div>
            </div>
			<div class="clearfix"></div>
			
			
			<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Dispute History <small><a href="#newdispute">Open a New Dispute</a></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<?php
					$req1 = mysqli_query($connection,"select * from dispute where member=".$_SESSION['uid']." order by id desc");					
				  ?>
                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 5%">#</th>
						  <th>Details</th>
						  <th>Alert ID</th>
                          <th>Transactions</th>
						  <th>Picture</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
						$i = 0;
						while($dx = mysqli_fetch_array($req1)){ 												
							//$mpay = mysqli_fetch_array(mysqli_query($connection,"select pamount, gamount, ptype from plans where id='".$dx['phid']."'"));
						$i++;
					  ?>
                        <tr>
                          <td><?php echo $i; ?></td>
						  <td>
							<?php echo $dx['did']; ?>
						  </td>
						  <td>
							<?php echo $dx['alertid']; ?>
						  </td>					  
                          <td>
                            <?php echo $dx['details']; ?>                           
                          </td>
						  <td><?php echo ($dx['photo']==''?'NO':'YES'); ?></td>
                          <td><?php if($dx['status']==0){ ?>
                            <a class="btn btn-warning btn-xs">Pending</a>
						  <?php }else{ ?>
							<a class="btn btn-success btn-xs">Completed</a>
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
			
			
			<div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 id="newdispute">Open a Dispute</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">                    
					<p align="center" id="mmsg">Fill the form: Get the 'Alert ID' from Get Alert page.</p><br />
                    <form class="form-horizontal form-label-left input_mask" method="post" action="" enctype="multipart/form-data">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="alertid" required="required" class="form-control has-feedback-left" id="alertid" placeholder="Alert ID from GetAlert transaction page">
                        <span class="fa fa-signal form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<select name="cat" id="cat" required="required" class="form-control has-feedback-left">
							<option value="-1">Select Category</option>
							<option value="I have not get alert the other participant upload a fake POP">I have not get alert the other participant uploaded a fake POP</option>
							<option value="I have send alert but the other participant failed to confirm the payment">I have send alert but the other participant failed to confirm the payment</option>
							
							<option value="-1">-----------------------------------------------------------------------------------</option>
							<option value="Other">Other Category</option>
						</select>
                     <!--   <input type="text" class="form-control" id="inputSuccess3" placeholder="Category">  -->
                        <span class="fa fa-location-arrow form-control-feedback left" aria-hidden="true"></span>
                      </div>

					  <div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<textarea id="msg"  required="required" class="col-md-12 col-sm-12 col-xs-12" rows="5" placeholder="Type the issue here"></textarea>
						</div>
					  </div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<input type='file' id="photo"  class="form-control has-feedback-left"> &nbsp;<i class="red">Max. size is 100kb</i>
							<span class="fa fa-file-image-o form-control-feedback left" aria-hidden="true"></span>
						</div>
					  <input type="hidden" id="disform" value="TRUE" />
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                          <input type="submit" id="send" class="btn btn-success" value="Open Dispute" />
                        </div>
                      </div>

                    </form>
                  </div>
                </div>		
				
				</div>
				
								
				</div>
						
			</div>
		</div>
		
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
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>