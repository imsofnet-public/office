  <?php
require_once("../config/site_func.php");
include('../config/config.php');
if(isset($_SESSION['isLog'])){
	
	if (isset($_POST['sendalert'])) {
		$val = $_POST['vid'];
		$sfunc = new SiteFunction();
		$details = "SA".$_SESSION['uid'].date('dmY')."-".$sfunc->get_rand_id(3);
		$dns = mysqli_fetch_array(mysqli_query($connection,"select * from plans where id=$val"));
		$req = mysqli_query($connection,"select * from members where id=".$_SESSION['uid']);
		$dn = mysqli_fetch_array($req);
		$fname = $dn['fullname'];
		if($dns['ptype']==1){
		if($_SESSION['info']=='complete'){
			if(mysqli_query($connection,
				"insert into ph(pmember, phid, pcreate, details) values (".$_SESSION['uid'].", $val, ".time().", '$details')")){
				if($dn['refer']!=0){
					$value = ((int)str_replace(',','',$dns['pamount'])) * 0.05;
					$dde = mysqli_fetch_array(mysqli_query($connection,"select id as idx from ph where pmember=".$_SESSION['uid']." and details='$details'"));
					mysqli_query($connection,
					"insert into referrals(member, rmember, phid, amount, value, day, ptype) values (".$dn['refer'].",".$_SESSION['uid'].",".$dde['idx'].", '".$dns['pamount']."', '$value', ".time().", ".$dns['ptype'].")");
				}
				$message = " Dear $fname,\nYou have successfully sent a card of ".($dns['ptype']==1?"# ":"$ ").$dns['pamount']." on GetAlert community.\n";
				$message .= "You will be paired anytime after 8 days and you will get alert of 150% after 30 days.\n\n";
				$message .= "\n\n You can logon to your office to check for more details.\n\n";
				$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
				
				$subject  = 'GetAlert Community SendAlert Confirmation';
				$header = "From: Get Alert <info@get-alert.com>";
				$email = $_SESSION['email'];
				mail($email,$subject,$message,$header);			
				
				echo 'Your card was successfully sent';
					
			}else{
				echo 'An error occurred while sending alert card. Please try again later';
			}
		}else{
			echo 'ERROR! Please complete your naira account profile information inorder to send/get alert on this platform';
		}
		}else{
		if($_SESSION['btc']=='complete'){
			if(mysqli_query($connection,
				"insert into ph(pmember, phid, pcreate, details) values (".$_SESSION['uid'].", $val, ".time().", '$details')")){
				if($dn['refer']!=0){
					$value = ((int)str_replace(',','',$dns['pamount'])) * 0.05;
					$dde = mysqli_fetch_array(mysqli_query($connection,"select id as idx from ph where pmember=".$_SESSION['uid']." and details='$details'"));
					mysqli_query($connection,
					"insert into referrals(member, rmember, phid, amount, value, day, ptype) values (".$dn['refer'].",".$_SESSION['uid'].",".$dde['idx'].", '".$dns['pamount']."', '$value', ".time().", ".$dns['ptype'].")");
				}
				$message = " Dear $fname,\nYou have successfully sent a card of ".($dns['ptype']==1?"&#8358; ":"$ ").$dns['pamount']." on GetAlert community.\n";
				$message .= "You will be paired anytime after 8 days and you will get alert of 150% after 30 days.\n\n";
				$message .= "\n\n You can logon to your office to check for more details.\n\n";
				$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
				
				$subject  = 'GetAlert Community SendAlert Confirmation';
				$header = "From: Get Alert <info@get-alert.com>";
				$email = $_SESSION['email'];
				mail($email,$subject,$message,$header);			
				
				echo 'Your card was successfully sent';
					
			}else{
				echo 'An error occurred while sending alert card. Please try again later';
			}
		}else{
			echo 'ERROR! Please complete your bitcoin wallet profile information inorder to send/get alert on this platform';
		}
		}		
		
	}else if(isset($_POST['getalert'])) {
		$val = $_POST['vid'];
		$oid = $_POST['oid'];
		$pfo = $_POST['pfour'];
		$req4 = mysqli_query($connection,"select * from members where pin=$pfo and id=".$_SESSION['uid']);
		$num4 = mysqli_num_rows($req4);
		if($num4 > 0){
		$sfunc = new SiteFunction();
		$details = "GA".$_SESSION['uid'].date('dmY')."-".$sfunc->get_rand_id(3);
		$dns = mysqli_fetch_array(mysqli_query($connection,"select * from plans where id=$val"));
		$req = mysqli_query($connection,"select * from members where id=".$_SESSION['uid']);
		$dn = mysqli_fetch_array($req);
		$fname = $dn['fullname'];
		if($dns['ptype']==1){
		if($_SESSION['info']=='complete'){
		if(mysqli_query($connection,
			"insert into gh(gmember, ghid, gcreate, details) values (".$_SESSION['uid'].", $val, ".time().", '$details')")){
			mysqli_query($connection,"delete from office where id=$oid");
				
			$message = " Dear $fname,\nYou have successfully requested for a card of ".($dns['ptype']==1?"# ":"$ ").$dns['gamount']." on GetAlert community.\n";
			$message .= "You will be paired anytime after 1 day and you must confirm the payment before 3 days. If you discover that the uploaded document (POP) is fake,\n";
			$message .= "open a dispute before the expired date or system will automatically confirm the payment.";
			$message .= "\n\n You can logon to your office to check for more details.\n\n";
			$message .= "\n\nGetAlert &copy 2017 https://get-alert.com \n";
			
			$subject  = 'GetAlert Community GetAlert Confirmation';
			$header = "From: Get Alert <info@get-alert.com>";
			$email = $_SESSION['email'];
			mail($email,$subject,$message,$header);			
			
			echo 'Your card was successfully dispatched';
				
		}else{
			echo 'An error occurred while geting alert card. Please try again later';
		}
		}else{
			echo 'ERROR! Please complete your naira account profile information in order to send/get alert on this platform';
		}
		}else{
		if($_SESSION['btc']=='complete'){
		if(mysqli_query($connection,
			"insert into gh(gmember, ghid, gcreate, details) values (".$_SESSION['uid'].", $val, ".time().", '$details')")){
			mysqli_query($connection,"delete from office where id=$oid");
				
			$message = " Dear $fname,\nYou have successfully requested for a card of ".($dns['ptype']==1?"# ":"$ ").$dns['gamount']." on GetAlert community.\n";
			$message .= "You will be paired anytime after 1 day and you must confirm the payment before 3 days. If you discover that the uploaded document (POP) is fake,\n";
			$message .= "open a dispute before the expired date or system will automatically confirm the payment.";
			$message .= "\n\n You can logon to your office to check for more details.\n\n";
			$message .= "\n\nGetAlert &copy 2017 https://get-alert.com \n";
			
			$subject  = 'GetAlert Community GetAlert Confirmation';
			$header = "From: Get Alert <info@get-alert.com>";
			$email = $_SESSION['email'];
			mail($email,$subject,$message,$header);			
			
			echo 'Your card was successfully dispatched';
				
		}else{
			echo 'An error occurred while geting alert card. Please try again later';
		}
		}else{
			echo 'ERROR! Please complete your bitcoin wallet profile information inorder to send/get alert on this platform';
		}
		}
	}else{
		echo "ERROR! You have entered wrong pin.";
	}
	}else if(isset($_POST['getoffice'])){
		$value = $_POST['vid'];
		$ptype = $_POST['ptype'];
		if($ptype == 1){
			if($value >= 60000){
				if(mysqli_query($connection,"insert into office(ghid,member) values (9,".$_SESSION[uid].")")){
					$sum = 60000;
					$req = mysqli_query($connection,"select id,value from referrals where ptype=1 and paid=1 and gh=0 and member=".$_SESSION['uid']);
					while($dx = mysqli_fetch_array($req)){
						$val = (int)($dx['value']);
						$idx = $dx['id'];
						if($sum > 0){
							if($val > $sum){
								$val = $val - $sum;
								$sum = 0;
								$gh = 0;
							}else{
								$sum = $sum - $val;
								$val = 0;
								$gh = 1;
							}
							mysqli_query($connection,"update referrals set value=$val, gh=$gh where id=$idx");
						}else{
							break;
						}
					}
				}
				echo '#60,000 have been transferred successfully. Please check your GetAlert office to request for it';
			}else{
				echo 'ERROR! You can not transfer amount less than #60,000';
			}
		}else{
			if($value >= 200){
				if(mysqli_query($connection,"insert into office(ghid,member) values (5,".$_SESSION[uid].")")){
					$sum = 200;
					$req = mysqli_query($connection,"select id,value from referrals where ptype=2 and paid=1 and gh=0 and member=".$_SESSION['uid']);
					while($dx = mysqli_fetch_array($req)){
						$val = (int)($dx['value']);
						$idx = $dx['id'];
						if($sum > 0){
							if($val > $sum){
								$val = $val - $sum;
								$sum = 0;
								$gh = 0;
							}else{
								$sum = $sum - $val;
								$val = 0;
								$gh = 1;
							}
							mysqli_query($connection,"update referrals set value=$val, gh=$gh where id=$idx");
						}else{
							break;
						}
					}
				}
				echo '$200 have been transferred successfully. Please check your GetAlert office to request for it';
			}else{
				echo 'ERROR! You can not transfer amount less than $200';
			}
		}
	}else if(isset($_POST['support'])){
		$sub = mysqli_real_escape_string($connection,$_POST['subj']);
		$msg = mysqli_real_escape_string($connection,$_POST['msg']);
		
		mysqli_query($connection,
				"insert into messages(member,sender,subject,message,date) values (0,".$_SESSION['uid'].",'$sub','$msg',".time().")");
		$msgr = "Your message has been received and our support will get back to you within 48 hours <br/><br/>Your message reads<br/>__________<br/>".$msg;
		$subr = "re-".$sub;
		mysqli_query($connection,
				"insert into messages(member,subject,message,date) values (".$_SESSION['uid'].",'$subr','$msgr',".time().")");
						
				$subject  = 'GetAlert Community Support - '.$subr;
				$header = "From: Get Alert <support@get-alert.com>";
				$email = $_SESSION['email'];
				mail($email,$subject,$msgr,$header);	
				
		echo "Your message has been received and our support will get back to you within 48 hours";
	}else if(isset($_POST['info'])){
		$phone = $_POST['phone'];
		$country = $_POST['country'];
		$state = $_POST['state'];
		$target_dir = "res/profile/";
		$image_name = 'alert'.$_SESSION['uid'];
		$uploadOk = 1;
		if(!isset($_POST['submit'])){
			header('Location: profile.php?act=1');
		}
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		if($check !== false) {
			$imageFileType = pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
			// Check file size
			if ($_FILES["file"]["size"] > 102400) {
				//echo "Error! The file you upload is more than 100kb.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG") {
				//echo "\nError! Only JPG, JPEG, & PNG files are allowed.";
				$uploadOk = 0;
			}			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				//echo "\nSorry, your file was not uploaded.";
				header('Location: profile.php?act=0');
			// if everything is ok, try to upload file
			} else {
				if($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "JPG" || $imageFileType == "JPEG") {
					$ext = '.jpg';
				}else if($imageFileType == "png" || $imageFileType == "PNG"){
					$ext = '.png';
				}
				$image_name = $image_name . $ext;
				$target_file = $target_dir . $image_name;
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
					mysqli_query($connection,"update members set photo='$image_name', phone='$phone', state='$state', country='$country' where id=".$_SESSION['uid']);
					$message = " Dear member,\nYou have successfully update your profile on GetAlert community.\n";
				$message .= "If you did not do this, please contact support@get-alert.com\n\n";
				$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
				
				$subject  = 'GetAlert Community Profile Update';
				$header = "From: Get Alert <info@get-alert.com>";
				$email = $_SESSION['email'];
				mail($email,$subject,$message,$header);	
					//resetsession();
					//echo "Your profile has been saved. Please logout and re-login.";
					header('Location: profile.php?act=2');
				} else {
					echo "Sorry, there was an error updating your profile. Please try again later or contact support.";
					header('Location: profile.php?act=1');
				}
			}
		} else {
			mysqli_query($connection,"update members set phone='$phone', state='$state', country='$country' where id=".$_SESSION['uid']);
			$message = " Dear member,\nYou have successfully update your profile on GetAlert community.\n";
				$message .= "If you did not do this, please contact support@get-alert.com\n\n";
				$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
				
				$subject  = 'GetAlert Community Profile Update';
				$header = "From: Get Alert <info@get-alert.com>";
				$email = $_SESSION['email'];
				mail($email,$subject,$message,$header);	
			header('Location: profile.php?act=3');
			//echo "Your profile has been saved. No image or picture was saved. Please logout and re-login.";
		}
	}else if(isset($_POST['dispute'])){
		$alert = $_POST['alertid'];
		$msg = mysqli_real_escape_string($connection,$_POST['msg']);
		$cat = $_POST['cat'];
		$target_dir = "res/images/dispute/";
		$sfunc = new SiteFunction();
		$image_name = 'DIS'.date('dmY').$_SESSION['uid'].$sfunc->get_rand_id(2);
		$uploadOk = 1;
		$num = mysqli_num_rows(mysqli_query($connection,"select * from gh where details='$alert' and gmember=".$_SESSION['uid']));
		if($num > 0){
			$check = getimagesize($_FILES["file"]["tmp_name"]);
			if($check !== false) {
				$imageFileType = pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
				// Check file size
				if ($_FILES["file"]["size"] > 102400) {
					echo "Error! The file you upload is more than 100kb.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG") {
					echo "\nError! Only JPG, JPEG, & PNG files are allowed.";
					$uploadOk = 0;
				}			
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "\nSorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
					if($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "JPG" || $imageFileType == "JPEG") {
						$ext = '.jpg';
					}else if($imageFileType == "png" || $imageFileType == "PNG"){
						$ext = '.png';
					}
					$disid = $image_name;
					$image_name = $image_name . $ext;
					$target_file = $target_dir . $image_name;
					if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
						mysqli_query($connection,
						"insert into dispute(did,alertid,member,date,details,message,photo) values ('$disid','$alert',".$_SESSION['uid'].",".time().",'$cat','$msg','$image_name')");
						mysqli_query("update ph set disputed=1 where id=(select ph from gh where details='$alert' and gmember=".$_SESSION['uid'].")");
						echo "Your dispute has been lodged. Our support will look into it and get back to you within 48 hours";
				$message = " Dear member,\nYou have successfully open dispute ($disid of $alert) on GetAlert community.\n";
				$message .= "Our support will look into it and get back to you within 48 hours\n\n";
				$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
				
				$subject  = 'GetAlert Community Disputed Alert';
				$header = "From: Get Alert <dispute@get-alert.com>";
				$email = $_SESSION['email'];
				mail($email,$subject,$message,$header);	
					} else {
						echo "Sorry, there was an error uploading your file for dispute. Please try again later or contact support.";
					}
				}
			} else {
				$disid = $image_name;
				mysqli_query($connection,
				"insert into dispute(did,alertid,member,date,details,message,photo) values ('$disid','$alert',".$_SESSION['uid'].",".time().",'$cat','$msg','')");
				mysqli_query("update ph set disputed=1 where id=(select ph from gh where details='$alert' and gmember=".$_SESSION['uid'].")");
				echo "Your profile has been saved.\nNo image or picture was saved.\nOur support will look into it and get back to you within 48 hours.";
				$message = " Dear member,\nYou have successfully open dispute ($disid of $alert) on GetAlert community.\n";
				$message .= "Our support will look into it and get back to you within 48 hours\n\n";
				$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
				
				$subject  = 'GetAlert Community Disputed Alert';
				$header = "From: Get Alert <dispute@get-alert.com>";
				$email = $_SESSION['email'];
				mail($email,$subject,$message,$header);
			}
		}else{
			echo "The alert ID you entered is invalid. Check and try again";
		}
	}else if(isset($_POST['account'])){
		$accname = $_POST['accname'];
		$accnumber = $_POST['accnumber'];
		$accbank = $_POST['accbank'];
		$wallet = $_POST['wallet'];
		$pfour = $_POST['pfour'];
		if(strlen($pfour) != 4){
			header('Location: settings.php?act=6');
		}
		if($_POST['ptype'] != $_POST['ptype2']){
			header('Location: settings.php?act=5');
		}
		if(strlen($_POST['ptype'])<6){
			header('Location: settings.php?act=4');
		}
		$ptype = sha1($_POST['ptype']);
		if(is_numeric($pfour)){
		if(validate($wallet)){
		if($_SESSION['pin4']==0){
			mysqli_query($connection,"update members set password='$ptype', pin=$pfour, accname='$accname', accnumber='$accnumber', accbank='$accbank', wallet='$wallet' where id=".$_SESSION['uid']);
			}else{
			mysqli_query($connection,"update members set password='$ptype', accname='$accname', accnumber='$accnumber', accbank='$accbank', wallet='$wallet' where id=".$_SESSION['uid']);
			}
			$message = " Dear member,\nYou have successfully update your profile account on GetAlert community.\n";
			$message .= "If you did not do this, please contact support@get-alert.com\n\n";
			$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
			
			$subject  = 'GetAlert Community Profile Update';
			$header = "From: Get Alert <info@get-alert.com>";
			$email = $_SESSION['email'];
			mail($email,$subject,$message,$header);
			header('Location: settings.php?act=1');
		}else{
		if($_SESSION['pin4']==0){
			mysqli_query($connection,"update members set password='$ptype', pin=$pfour, accname='$accname', accnumber='$accnumber', accbank='$accbank' where id=".$_SESSION['uid']);
			}else{
			mysqli_query($connection,"update members set password='$ptype', accname='$accname', accnumber='$accnumber', accbank='$accbank' where id=".$_SESSION['uid']);
			}
			$message = " Dear member,\nYou have successfully update your profile account on GetAlert community.\nYour bitcoin wallet address is not found or correct so it is not save.";
				$message .= "If you did not do this, please contact support@get-alert.com\n\n";
				$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
				
				$subject  = 'GetAlert Community Profile Update';
				$header = "From: Get Alert <info@get-alert.com>";
				$email = $_SESSION['email'];
				mail($email,$subject,$message,$header);
			header('Location: settings.php?act=2');
		}
		}else{
			//echo '4-digit pin is required. Only digits are allowed.';
			header('Location: settings.php?act=3');
		}
	}else if(isset($_POST['check'])){
		$pwtyp = $_POST['typ'];
		if($_SESSION['pin4']==0){
		if(sha1($pwtyp) == $_SESSION['pwtype']){
			echo 1;
		}else{
			echo 0;
		}
		}else{
		if($pwtyp == $_SESSION['pin4']){
			echo 1;
		}else{
			echo 0;
		}
		}
	}else if(isset($_POST['extend'])){
		$phid = $_POST['phid'];
		$ghid = $_POST['ghid'];
		if(mysqli_query($connection,"update ph set exp=(exp+86400) where id=$phid")){
			mysqli_query($connection,"update gh set pdetails=1 where id=$ghid");
			$message = " Dear member,\nYour paired member have successfully extended your payment time by 24hours on GetAlert community.\n";
			$message .= "You must make the payment and upload POP which is not fake otherwise your account will be banned from this community.\n";
			$message .= "\n\n You can logon to your office to check for more details.\n\n";
			$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
			
			$subject  = 'GetAlert Community GetAlert Payment Time Extension';
			$header = "From: Get Alert <info@get-alert.com>";
			$email = mysqli_fetch_array(mysqli_query($connection,"select email from members where id=(select pmember from gh where id=$ghid)"))['email'];
			mail($email,$subject,$message,$header);
			header('Location: office2.php?act=0');
		}else{
			header('Location: office2.php?act=2');
		}
	}else if(isset($_POST['confirm'])){
		$phid = $_POST['phid'];
		$ghid = $_POST['ghid'];
		if(mysqli_query($connection,"update ph set confirm=1 where id=$phid")){
			mysqli_query($connection,"update ph set pdate=".time()." where pdate=0 and confirm=1 and id=$phid");
			mysqli_query($connection,"update gh set pdetails=1, gdate=".time()." where id=$ghid");
			mysqli_query($connection,"update referrals set paid=1 where phid=$phid");
			$message = " Dear member,\nYour paired member have successfully confirmed your payment on GetAlert community.\n";
			$message .= "Your alert card will be ready when the progress is 100% then you can request for an alert card.\n";
			$message .= "\n\n You can logon to your office to check for more details.\n\n";
			$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
			
			$subject  = 'GetAlert Community GetAlert Payment Confirmation';
			$header = "From: Get Alert <info@get-alert.com>";
			$email = mysqli_fetch_array(mysqli_query($connection,"select email from members where id=(select pmember from gh where id=$ghid)"))['email'];
			mail($email,$subject,$message,$header);
			header('Location: office2.php?act=1');
		}else{
			header('Location: office2.php?act=2');
		}
	}else if(isset($_POST['dup'])){
		$phid = $_POST['phid'];
		$mtyp = $_POST['ptype'];
		if($mtyp == 1){
			$target_dir = "res/images/alert/";
			$image_name = 'ph'.$phid.date('dmY');
			$uploadOk = 1;
			if(!isset($_POST['submit'])){
				$uploadOk = 1;
				//header('Location: office.php?act=1');
			}
			
			$imageFileType = pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($phid)) {
				$check = getimagesize($_FILES["file"]["tmp_name"]);
				if($check !== false) {
					//echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 0;
				} else {
					//echo "Error! The file you upload is not an image ->( $imageFileType ).";
					$uploadOk = 1;
					//header('Location: office.php?act=1');
				}
			}
			// Check if file already exists
			//if (file_exists($target_file)) {
			//	echo "Sorry, file already exists.";
			//	$uploadOk = 0;
			//}
			
			// Check file size
			$imgSize = $_FILES["file"]["size"];
			if ($imgSize > 102400) {
				$uploadOk = 2;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG") {
				$uploadOk = 3;
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk != 0) {
				if($uploadOk == 1){
					header('Location: office.php?act=1');
				}else if($uploadOk == 2){
					header('Location: office.php?act=2');
				}else if($uploadOk == 3){
					header('Location: office.php?act=3');
				}else{
					header('Location: office.php?act=1');
				}
			// if everything is ok, try to upload file
			} else {
				if($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "JPG" || $imageFileType == "JPEG") {
					$ext = '.jpg';
				}else if($imageFileType == "png" || $imageFileType == "PNG"){
					$ext = '.png';
				}
				$image_name = $image_name . $ext;
				$target_file = $target_dir . $image_name;
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
					mysqli_query($connection,"update ph set alert='$image_name', pdate=".time().", dalert='Naira' where id=$phid");
					$dns = mysqli_fetch_array(mysqli_query($connection,"select pamount from plans where id=(select phid from ph where id=$phid)"));
					$message = " Dear member,\nYour paired member have successfully sent a card of ".($mtyp==1?"# ":"$ ").$dns['pamount']." on GetAlert community.\n";
					$message .= "You must check the POP and confirm the payment before 3 days or automatic confirmation will be ensued. \nIf you have not been paid or the POP is fake, please open a dispute immediately before the end of ".date('D d/m/Y h:i:s A',time()+(3*24*60*60)).".\n";
					$message .= "\n\n You can logon to your office to check for more details.\n\n";
					$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
					
					$subject  = 'GetAlert Community GetAlert Payment Confirmation';
					$header = "From: Get Alert <info@get-alert.com>";
					$email = mysqli_fetch_array(mysqli_query($connection,"select email from members where id=(select gmember from ph where id=$phid)"))['email'];
					mail($email,$subject,$message,$header);
					header('Location: office.php?act=0');
				} else {
					header('Location: office.php?act=7');
				}
			}	
		}else{
			$details = $_POST['details'];
			if(isset($phid)){
				if($details != ''){
					if(strlen($details)==64){
						$req = mysqli_query($connection,"select wallet from members where id=(select gmember from ph where id=$phid)");
						$dn = mysqli_fetch_array($req);
						$wallet = $dn['wallet'];
						$payment = confirm_tx($wallet,$details);
						if($payment == 0){
							echo 'This transaction ID is invalid. Please enter the correct ID\nCheck your internet connection or contact support.';
						}else{	//echo date('Y-m-d H:i:s',1488994237);
							$amount = $payment[7] / 100000000.0;
							$pdate = $payment[0];
							$ppdat = time(); $ddd = date('D d-m-Y h:i:s A',$pdate);
							mysqli_query($connection,"update ph set pdate=$ppdat, dalert='$details', alert='BTC $amount on $ddd' where id=$phid");
							$dns = mysqli_fetch_array(mysqli_query($connection,"select pamount from plans where id=(select phid from ph where id=$phid)"));
				$message = " Dear member,\nYour paired member have successfully sent a card of ".($mtyp==1?"# ":"$ ").$dns['pamount']." on GetAlert community.\n";
				$message .= "You must check the transaction id ($details) with blockchain on $pdate and wait till it receives 3 confirmations; also confirm the payment before 3 days or automatic confirmation will be ensued. \nIf you have not been paid or the transaction ID is fake, please open a dispute immediately before the end of ".date('D d/m/Y h:i:s A',time()+(3*24*60*60)).".\n";
				$message .= "\n\n You can logon to your office to check for more details.\n\n";
				$message .= "\n\nGetAlert (c) 2017 https://get-alert.com \n";
				
				$subject  = 'GetAlert Community GetAlert Payment Confirmation';
				$header = "From: Get Alert <info@get-alert.com>";
				$email = mysqli_fetch_array(mysqli_query($connection,"select email from members where id=(select gmember from ph where id=$phid)"))['email'];
				mail($email,$subject,$message,$header);
							header('Location: office.php?act=8');
						}
					}else{
						//echo "The transaction ID you entered is incorrect.\nCheck and type again";
						header('Location: office.php?act=5');
					}
				}else{
					//echo "Please enter the blockchain transaction ID";
					header('Location: office.php?act=6');
				}
			}else{
				//echo "Sorry, there was an error saving the transaction ID. Please try again or contact support.";
				header('Location: office.php?act=7');
			}
		}
	}else{
		header('Location: ../index.php');
	}
}else{
	header('Location: ../index.php');
}



function confirm_tx($address, $txid){
	
 // $address = "1PUiNwFn6oJpYsmyR6HEyn5wiroUbjDiob";
  $offset = 0;
  $type = "received";
  $status = "all";
  $data = file_get_contents("https://bitaps.com/api/address/transactions/". $address. "/" . $offset. "/" . $type. "/" . $status);
  $responds = json_decode($data,true); // Array of transactions
  $have = "";
  foreach ($responds as $respond) {
    if($txid == $respond[1]){	// = $have. $respond[1]. "\n";	//[7]
		return $respond;
	}
  }
 // $last_received = $respond[0][1];
  return 0;
}

function validate($address){
	$decoded = decodeBase58($address);

	$d1 = hash("sha256", substr($decoded,0,21), true);
	$d2 = hash("sha256", $d1, true);

	if(substr_compare($decoded, $d2, 21, 4)){
			return false;
	}
	return true;
}
function decodeBase58($input) {
	$alphabet = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";

	$out = array_fill(0, 25, 0);
	for($i=0;$i<strlen($input);$i++){
			if(($p=strpos($alphabet, $input[$i]))===false){
					throw new \Exception("invalid character found");
			}
			$c = $p;
			for ($j = 25; $j--; ) {
					$c += (int)(58 * $out[$j]);
					$out[$j] = (int)($c % 256);
					$c /= 256;
					$c = (int)$c;
			}
			if($c != 0){
				throw new \Exception("address too long");
			}
	}

	$result = "";
	foreach($out as $val){
			$result .= chr($val);
	}

	return $result;
}
function resetsession(){

	if(!isset($_SESSION['isLog'])){
		header('Location: ../');
	}
	$req = mysqli_query($connection,"select * from members where id=".$_SESSION['uid']);
	$dn = mysqli_fetch_array($req);
	//session_start();
	$_SESSION['email'] = $dn['email'];
	$_SESSION['uid'] = $dn['id'];
	$_SESSION['pwtype'] = $dn['password'];
	$_SESSION['name'] = $dn['fullname'];
	$_SESSION['phone'] = $dn['phone'];
	$_SESSION['pics'] = $dn['photo'];
	$_SESSION['state'] = $dn['state'];
	$_SESSION['country'] = $dn['country'];
	$_SESSION['accname'] = $dn['accname'];
	$_SESSION['accnumber'] = $dn['accnumber'];
	$_SESSION['accbank'] = $dn['accbank'];
	$_SESSION['wallet'] = $dn['wallet'];
	$_SESSION['message'] = $dn['message'];
	$_SESSION['regdate'] = $dn['signdate'];
}

?>