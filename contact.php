<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic -->
        <meta charset="utf-8">
        <title>Whats Top Rank label in our lists | Boardgame Kickstarter Rank Database | BGK rank</title>

		<meta name="description" content="LIVE, by publisher projects average | Boardgame Kickstarter Rank Database | BGK rank">
        <meta property="og:image" content="https://bgkrank.com/img/logo.png" />    
		
<?php require '1header.php'; ?>			




<?php



?>


            <!-- Section Area - Content Central -->
            <section class="content-info">

			
		
			
			

                <div class="container">
                    <div class="row paddings-mini">


                        <!-- Right Content -->
                        <div class="col-md-12">
						
						
<?php
	if(isset($_GET['send']))
	{
	$to = "geoliat@yahoo.com"; /*Your Email*/
	$sub=$_REQUEST[Subject];
	$subject =  $sub." | contact form | bgkrank.com "; /*Issue*/
	$date = date ("l, F jS, Y");
	$time = date ("h:i A");
	$Email=$_REQUEST['Email'];

	$msg="

	Email: $_REQUEST[Email]
	Subject: $_REQUEST[Subject]

	Message sent from website on date  $date, hour: $time.\n

	Message:
	$_REQUEST[message]";

	if ($Email=="") {
		echo "<b style='color:red;'>Δώστε mail</b><br><br>";
	}
	else{
		
		if($_POST['agree']=="1")
		{
			echo "<b style='color:red;'>choose agree</b><br><br>";
		}
		else
		{
			mail($to, $subject, $msg, "From: $_REQUEST[Email]");
			echo "<b style='color:red;'>SENDED</b><br><br>";
		}		
	}
	}
?>								
						
                            <div class="panel-box">
                                <div class="titles no-margin">
                                    <h4>Contact Form</h4>
                                </div>
                                <div class="info-panel">
                                    <!-- Form Contact -->
									
									
									
                                    <form  method="post" action="contact.php?send=1">
                                         <div class="row">
                                            <div class="col-md-6">
                                                <label>Subject *</label>
<?php
if(isset($_GET['contact']))
{
		if($_GET['contact']=="1")
		{
			$option1="selected";
			$option2="";
			$option3="";				
		}
		elseif($_GET['contact']=="2")			
		{
			$option1="";
			$option2="selected";
			$option3="";							
		}
}
else
{
	$option1="";
	$option2="";
	$option3="selected";	
}	
?>												
                                                <select class="form-control" name="Subject">
													<option <?php echo $option1; ?> value="Submit kickstarter missing from our lists (the URL)">Submit kickstarter missing from our lists (the URL)</option>
													<option <?php echo $option2; ?> value="Suggest a new list of data">Suggest a new list of data</option>
													<option <?php echo $option3; ?> value="Other">Other</option>													
												</select>
                                            </div>
                                        </div>									
                                        <div class="row">
                                            <div class="col-md-12">
												&nbsp;
                                            </div>
                                        </div>										
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Your email address</label>
                                                <input type="email"  required="required" value="" maxlength="100" class="form-control" name="Email" id="email">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Comment</label>
                                                <textarea maxlength="5000" rows="10" class="form-control" name="message"  style="height: 138px;" required="required" ></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
												&nbsp;
                                            </div>
                                        </div>																				
                                        <div class="row">
                                            <div class="col-md-12">
												<input type="radio" name="agree" value="1" checked> dont send&nbsp;&nbsp;&nbsp;<input type="radio" name="agree" value="2"> agree to send
                                            </div>
                                        </div>										
                                        <div class="row">
                                            <div class="col-md-12">
												&nbsp;
                                            </div>
                                        </div>																				
                                        <div class="row">
                                            <div class="col-md-12">

				
											
                                                <input type="submit" id="1" value="Send Message" class="btn btn-lg btn-primary">
                                            </div>
                                        </div>
                                    </form>
									
																		
                                    <!-- End Form Contact -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="result"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Right Content -->
                    </div>
                </div>
			
<?php require '2footer.php'; ?>			