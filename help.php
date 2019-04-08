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
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
	<!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
	
    <link href="../build/css/custom.min.css" rel="stylesheet">
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
					  <li><a href="dispute.php">Open Dipute</a></li>
                      <li><a href="message.php">Message</a></li>
                      <li><a href="support.php">Support</a></li>
                      <li><a href="">Help</a></li>
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
                <h3>Help</h3>
              </div>
            </div>
			<div class="clearfix"></div>
			
			<div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Help on GetAlert</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<h2>How &amp; Terms</h2>
					<p style="text-align:justify;">
						You as a participant intentionally send alert to other participant(by clicking on "Send Alert" under the Accounts Menu), select the 'alert card' you wish to send either in
						Naira (6 alert cards available) or in Bitcoin (6 alert cards available)  after which your office will be updated. Alert Sent will be accumulating from the moment it was sent 
						at the rate of 50% for Naira or 100% for Bitcoin in 30 days during which you will be paired with another participant any time after the first 8 days and the alert should be 
						sent within 3 days of pairing or your office will be closed.<br/><br/>
						
						Let's assume you selected to send 'alert card' of &#8358;100,000, your office will be updated immediately to reflect your intention and it will continue to progress until
						you are paired with another participant after the first 8 days. The money should be paid within 72 hours to avoid the closure of your account and a proof of payment (POP) should be uploaded. After the 30th day, your 'alert card'
						will be shown as the "Get Alert Card" of &#8358;150,000 (150% growth in Naira) and you can immediately select the 'Get alert card' and you will be paired with another participant
						after the first day you	selected the "Get Alert" and you must be paid within 72 hours (you can extend it if you like). Once the alert has been received, you must confirmed the alert
						immediately or before the end of 72hours in which it will be automatically confirmed.<br/><br/>

						Similarly, you will be able to 'Get Alert' of $100 for $50 sent card, $200 for $100 sent card and $400 for $200 sent card (200% in Bitcoin) or &#8358;75,000 for &#8358;50,000 sent card and &#8358;300,000 for &#8358;200,000 sent card. (150% in Naira)<br/>
						You cannot Get Alert if you have not Send Alert and you must pay the other participant within 72 hours(including the weekends). You must not upload a fake POP and you must not abuse the system if so, your
						account will be terminated.  After getting alert, you are given a maximum of 72 hours to send another alert. If no new alert is sent after 72 hours you got alert, your account will be suspended until you write suppport.<br/><br/>
						*Do not confirm any transaction until you are sure that you indeed received the alert. The support will not come to any participant aid who confirmed 'Get Alert' without receiving the alert. You must confirm the payment
						or open a dispute before the completion of 72 hours. If you have any question please contact the get-alert support by using the support menu at the side bar.
					
				     </p>
				  </div>
				  <div class="x_content">
				  		<!-- Client Section -->

<style type="text/css">
<!--
	div.question-q-box{
		border:1px solid #ff0000;
		font-style: bold;
		font-size: 18px;
		color: #0033ff;
	}
-->
</style>

    <section id="clients">
    <div class="container">
    <div class="row">

    <h1 class="title" align="center">FAQs</h1>
    <h2 class="subtitle" align="center">Frequently Asked Questions</h2>

    <div class="wow fadeInDown">
    
	<div class="row m-t-30">
            <div class="col-md-5 col-md-offset-1">
                <!-- Question/Answer -->
                <div class="question-q-box">Q.</div>
                <div class="animated fadeInLeft wow" data-wow-delay=".1s">
                    <h4 class="question" data-wow-delay=".1s">How do I get started?</h4>
                    <p class="answer" style="text-align:justify;"> To start getting alert, just simply sign up and update your profile account then send an alert from "Send Alert Card" and wait for some
					 days to be paired with the other participants. After 30 days, you will get back 150% (naira) or 200% (dollar) of the alert card you sent.</p>
                </div>

                <!-- Question/Answer -->
                <div class="question-q-box">Q.</div>
                <div class="animated fadeInLeft wow" data-wow-delay=".3s">
                    <h4 class="question">Do I have to look for someone to send me alert?</h4>
                    <p class="answer" style="text-align:justify;">You don't have to look for anyone to get alert . The system is designed to automatically match (after clicking 'Get Alert' card) other participants to send you alert
					after 30 days of sending alert card.  You will get back 150% (naira) or 200% (dollar) of the alert card you sent.</p>
                </div>

                <!-- Question/Answer -->
                <div class="question-q-box">Q.</div>
                <div class="animated fadeInLeft wow" data-wow-delay=".5s">
                    <h4 class="question">How many days or hours do I have to send alert to someone?</h4>
                    <p class="answer" style="text-align:justify;">After you have been paired you only have 72hours (3 days) to send alert and upload proof of payment (POP) otherwise your account will be
					terminated unless the other participant decides to extend the time for you to send the alert.
                    </p>
                </div>
				
				<!-- Question/Answer -->
                <div class="question-q-box">Q.</div>
                <div class="animated fadeInLeft wow" data-wow-delay=".7s">
                    <h4 class="question">What is POP?</h4>
                    <p class="answer" style="text-align:justify;">A POP is the Proof of Payment either in teller, screenshot or transaction id from the blockchain(for bitcoin). The POP must be uploaded immediately
					you send the alert or before the completion of 72 hours after you have been paired. If you discover that the POP uploaded is fake, please open a dispute before you confirm the transaction.
					Anyone that upload a fake POP will have his/her account terminated.
                    </p>
                </div>
				
				<!-- Question/Answer -->
                <div class="question-q-box">Q.</div>
                <div class="animated fadeInRight wow" data-wow-delay="0.9s">
                    <h4 class="question"> Can I call the other participant to confirm his/her account details or to notify him of my payment?</h4>
                    <p class="answer" style="text-align:justify;">Yes, you can call other participant either to confirm his/her details before sending alert or to notify him/her of the pairing or payment on the platform.
					All phone number will be confirmed anytime from the day you joined the platform. Any account with a fake phone number will be terminated.
                    </p>
                </div>
            </div>
            <!--/col-md-5 -->

            <div class="col-md-5">
                <!-- Question/Answer -->
                <div class="question-q-box">Q.</div>
                <div class="animated fadeInRight wow" data-wow-delay=".2s">
                    <h4 class="question">How many days or hours do I have to confirm an alert send to me by someone?</h4>
                    <p class="answer" style="text-align:justify;"> After you have seen an alert you only have 72hours (3 days) to confirm the alert but if you discover that the uploaded proof of payment (POP)
					is fake, you can open a dispute to address the issue otherwise the transaction will be confirmed automatically unless the dispute was opened before the expiration of the time.
					Do not confirm any payment until you have seen it in your account, confirm with your bank manager or after 3 confirmations of bitcoin block transaction; and if you fear your time will expire, open a dispute.</p>
                </div>

                <!-- Question/Answer -->
                <div class="question-q-box">Q.</div>
                <div class="animated fadeInRight wow" data-wow-delay=".4s">
                    <h4 class="question">What Do I need to do if I send alert and upload POP but the participant has not confirm my payment?</h4>
                    <p class="answer" style="text-align:justify;">After you have sent the alert and upload POP, and the other participant does not confirm the payment after 3 days of payment, the system will automatically confirm 
					the transaction so far you have not uploaded a fake POP and the other participant has not open a dispute.</p>
                </div>

                <!-- Question/Answer -->
                <div class="question-q-box">Q.</div>
                <div class="animated fadeInRight wow" data-wow-delay=".6s">
                    <h4 class="question"> How Do I Get Alert?</h4>
                    <p class="answer" style="text-align:justify;">Once you have sent alert and have been confirmed by the other participant, a green 'Get Alert' card showing your total earning will be displayed on the
					'Get Alert' page. Once you click on it, you will automatically be paired with one, two or three participants that will send alert to your bank account (naira) or wallet (bitcoin). Once you receive alert, you have
					only 3 days (72 hours) to confirm the payment or to open a dispute if you have not got the alert or you discover a fake POP.
                    </p>
                </div>
				
				<!-- Question/Answer -->
                <div class="question-q-box">Q.</div>
                <div class="animated fadeInRight wow" data-wow-delay=".8s">
                    <h4 class="question"> How Do I Open a dispute?</h4>
                    <p class="answer" style="text-align:justify;">Once you saw 'PAID' check your bank account or wallet for the payment and confirm the payment before 72 hours of seen the alert. If you discover that you have been given
					a fake POP, go to your office under the help menu, click on 'Open Dispute' and fill out the form. You can also upload any proof to back your claim. Our support will resolve the issue and penalty will be given to
					erred party unless a genuine reason is given. 
                    </p>
                </div>
				
				<!-- Question/Answer -->
                <div class="question-q-box">Q.</div>
                <div class="animated fadeInRight wow" data-wow-delay="1s">
                    <h4 class="question"> What do I gain if I invite someone to this platform?</h4>
                    <p class="answer" style="text-align:justify;">If you refer someone with your referral link, you will get 5% bonus of whatever the person send as alert. Your accumulated bonuses can only be got when it has reached
						&#8353;50,000 or &#36;200 of bitcoin. Start inviting more people to this platform. The more you refer, the more you earn.
                    </p>
                </div>
				

            </div>
            <div class="col-md-5">
                <!-- Question/Answer -->


            </div>
            <!--/col-md-5-->
        </div>

    </div>
    </div>
    </div>
    </section>
	</div>
<!-- Client Section End -->
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