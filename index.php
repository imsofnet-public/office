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
  </head>

  <?php
require_once("../config/site_func.php");
include('../config/config.php');
if(isset($_SESSION['isLog'])){
	echo "<script type='text/javascript'>
			$(document).ready(function(e){
				notifyUser('Your have successfully logon to your office.','success');
			});
		  </script>";
	
	if($_SESSION['state']==''){$note .= 'State,';}
	if($_SESSION['country']==''){$note .= ' Country,';}
	if($_SESSION['accname']==''){
		if($_SESSION['accnumber']==''){
			if($_SESSION['accbank']==''){$note .= ' Accounts Information';}}}
	
	if(isset($note)){
		$note = 'Please complete your profile to be able to get alert. The following need to be completed: '.$note;
		$_SESSION['info'] = 'incomplete';
		echo "<script type='text/javascript'>
			$(document).ready(function(e){
				notifyUser('$note','wait');
			});
		  </script>";
	}else{
		$_SESSION['info'] = 'complete';
	}
	if($_SESSION['wallet']==''){
		$_SESSION['btc'] = 'incomplete';
	}else{
		$_SESSION['btc'] = 'complete';
	}
}else{
	header('Location: ../');
}
?>
  
  <body class="nav-md">
  	
  	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
		  fjs.parentNode.insertBefore(js, fjs);
		 }(document, 'script', 'facebook-jssdk'));
	</script>
  	
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
                      <li><a href="">Dashboard</a></li>
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
					  <li><a href="dispute.php">Open Dipute</a></li>
                      <li><a href="message.php">Message</a></li>
                      <li><a href="support.php">Support</a></li>
                      <li><a href="help.php">Help</a></li>
                    </ul>
                  </li>
				  <li><a href="../home?nav=2"><i class="fa fa-sign-out"></i> Log Out</a>
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

		
		<?php
			$req1 = mysqli_query($connection,"select * from ph where pmember=".$_SESSION['uid']);
			$req2 = mysqli_query($connection,"select * from gh where gmember=".$_SESSION['uid']);
			$req3 = mysqli_query($connection,"select * from referrals where gh=0 and member=".$_SESSION['uid']);
			$req4 = mysqli_query($connection,"select * from members where refer=".$_SESSION['uid']);
			$num1 = mysqli_num_rows($req1);
			$num2 = mysqli_num_rows($req2);
			$num3 = mysqli_num_rows($req3);
			$num4 = mysqli_num_rows($req4);
		?>
		
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12"> 
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="blue">INFORMATION</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <?php
                  	$asd = mysqli_fetch_array(mysqli_query($connection,"select * from info where status=1"));
                  	echo "<h4><u>".$asd['topic']."</u></h4>";
                  	echo "<p class='blue' style='text-align:justify;font-size:16px;font-family:Goudy Old Style;line-height:25px;'>".$asd['message']."</p>";
                  	echo "<div class='fb-like' data-href='https://www.facebook.com/getalertcom' data-width='800' data-layout='standard' data-action='like' data-size='large' data-show-faces='false' data-share='true'></div>";
                  ?>
                  
                  </div>
                 </div>
                </div>
              </div>
          
            <div class="row top_tiles">
            <a href="office2.php">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon green"><i class="green fa fa-sort-amount-desc"></i></div>
                  <div class="count"><?php echo $num2; ?></div>
                  <h3 class="black">Alerts Received</h3>
                  <p>You have <?php echo $num2; ?> get alerts.</p>
                </div>
              </div></a>
              <a href="office.php">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon red"><i class="red fa fa-sort-amount-asc"></i></div>
                  <div class="count"><?php echo $num1; ?></div>
                  <h3 class="black">Alerts Sent</h3>
                  <p>You have sent <?php echo $num1; ?> alerts.</p>
                </div>
              </div></a>
              <a href="refer.php">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon blue"><i class="fa fa-users"></i></div>
                  <div class="count"><?php echo $num4; ?></div>
                  <h3 class="black">Referrals</h3>
                  <p>Members you invited</p>
                </div>
              </div></a>
              <a href="refer.php">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon green"><i class="fa fa-thumbs-up"></i></div>
                  <div class="count"><?php echo $num3; ?></div>
                  <h3 class="black">Active Referrals</h3>
                  <p>Number active referral bonus</p>
                </div>
              </div></a>
            </div>

			<?php
				$months = ["Jan","Feb","March","April","May","June","July","Aug","Sep","Oct","Nov","Dec"];
				$req1 = mysqli_query($connection,"select * from ph where pmember=".$_SESSION['uid']." order by id desc");
				$req2 = mysqli_query($connection,"select * from gh where gmember=".$_SESSION['uid']." order by id desc");
			?>
            

            
            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="red">Completed Sent Alerts<span class='small'> Dashboard</span></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<?php
						while($dx1 = mysqli_fetch_array($req1)){
							if($dx1['gmember']!=0){
							$gmem = mysqli_fetch_array(mysqli_query($connection,"select fullname from members where id='".$dx1['gmember']."'"))['fullname'];}
							$mpay = mysqli_fetch_array(mysqli_query($connection,"select pamount,gamount,ptype from plans where id='".$dx1['phid']."'"));
					?>
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month"><?php echo $months[(int)(date('m',$dx1['pcreate']))-1]; ?> </p>
                        <p class="day"><?php echo date('d',$dx1['pcreate']); ?></p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="office.php"><?php echo $dx1['details'].'  &rarr; '.($dx1['pdate']==0?"Not Paid":"Paid on ".date('d-m-Y',$dx1['pdate'])); ?></a>
                        <p>You send <?php echo($mpay['ptype']==1?'money &#8358;':'bitcoin $').$mpay['pamount']; ?>  alert to <?php echo ($dx1['gmember']!=0? $gmem:'(Not Yet Paired)'); ?></p><p><a 
                        <?php echo($dx1['gdetails']!=0?($dx1['status']==0?'class="btn btn-warning btn-xs">Pending':($dx1['status']==1?'class="btn btn-success btn-xs">Completed':'class="btn btn-danger btn-xs">Cancelled')):"class='btn btn-info btn-xs'>Not Paired"); ?></a><a <?php echo($dx1['confirm']==0?'class="btn btn-warning btn-xs"><i class="fa fa-thumbs-down"></i>'.($dx1['pdate']==0?'Not Paid':'Awaiting confirmation'):'class="btn btn-success btn-xs"><i class="fa fa-thumbs-up"></i>confirmed'); ?>
						</a></p>
                      </div>
                    </article>
					<?php } if($num1 == 0){ ?>
                    
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">Sent</p>
                        <p class="day">0</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">No Sent Alert History</a>
                        <p>You have not sent any alert.</p>
                      </div>
                    </article>
					<?php } ?>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="green">Completed Received Alerts<span class='small'> Dashboard</span></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php
						while($dx1 = mysqli_fetch_array($req2)){
							if($dx1['pmember']!=0){
							$gmem = mysqli_fetch_array(mysqli_query($connection,"select fullname from members where id='".$dx1['pmember']."'"))['fullname'];
							$mphd = mysqli_fetch_array(mysqli_query($connection,"select * from ph where id='".$dx1['ph']."'"));
							 }
							$mpay = mysqli_fetch_array(mysqli_query($connection,"select pamount,gamount,ptype from plans where id='".$dx1['ghid']."'"));
					?>
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month"><?php echo $months[(int)(date('m',$dx1['gcreate']))-1]; ?> </p>
                        <p class="day"><?php echo date('d',$dx1['gcreate']); ?></p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="office2.php"><?php echo $dx1['details'].' &rarr; '.($dx1['ph']!=0?($mphd['pdate']==0?"Not Paid":"Paid on ".date('d-m-Y',$mphd['pdate'])):"Not Paired"); ?></a>
                        <p>You get <?php echo($mpay['ptype']==1?'money &#8358;':'bitcoin $').$mpay['gamount']; ?>  alert from <?php echo ($dx1['pmember']!=0? $gmem:'(Not Yet Paired)'); ?></p><p><a <?php echo($dx1['ph']!=0?($mphd['confirm']==0?'class="btn btn-warning btn-xs">Pending':($mphd['confirm']==1?'class="btn btn-success btn-xs">Completed':'class="btn btn-danger btn-xs">Cancelled')):"class='btn btn-info btn-xs'>Not Paired"); ?>
							</a><a <?php echo($dx1['ph']!=0?($mphd['confirm']==0?'class="btn btn-warning btn-xs"><i class="fa fa-thumbs-down"></i>'.($mphd['pdate']==0?'Not Paid':'Awaiting confirmation'):'class="btn btn-success btn-xs"><i class="fa fa-thumbs-up"></i>confirmed'):"class='btn btn-info btn-xs'>Not Confirmed"); ?>
						</a></p>
                      </div>
                    </article>
					<?php } if($num2 == 0){ ?>
                    
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">Get</p>
                        <p class="day">0</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">No Get Alert History</a>
                        <p>You have not received any alert.</p>
                      </div>
                    </article>
					<?php } ?>
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
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="../vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
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