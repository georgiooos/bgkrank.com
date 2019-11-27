<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic -->
        <meta charset="utf-8">
        <title>Boardgame Kickstarter Rank database | BGK rank</title>

		<meta name="description" content="No more blind kickstarter buys! Data facts, filter the projects with the best production quality!  | Boardgame Kickstarter Rank Database | BGK rank">
        <meta property="og:image" content="https://bgkrank.com/img/logo.png" />    
		
<?php require '1header.php'; ?>					
		

            <!-- Section Title -->
            <div class="section-title" style="background:url(img/slide/1.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Best projects yearly</h1>
                        </div>


                    </div>
                </div>
            </div>
            <!-- End Section Title -->		
		
            <!-- Section Area - Content Central -->
            <section class="content-info">

                <div class="container paddings-mini">
				
					<center>
					<i>
					updates every few minutes, titles every few hours<br>
					almost all kicktarter included in our database, add old titles missing <a href="contact.php?contact=1">here</a>				
					</i>
					</center>					
					<br>				
				
                   <div class="row">
                       <!-- Sidebars -->
                        <aside class="col-lg-3">






<?php include("0config.php"); ?>






                            <!-- Widget Text-->
                            <div class="panel-box">

                                <div class="titles no-margin">
                                    <h4>Select Year</h4>
                                </div>
                                <div class="info-panel">
                                    <ul class="list">
										<?php
											if((isset($_GET['year'])&&$_GET['year']=="plus")||!isset($_GET['year']))
											{echo "<i class='fa fa-check'></i> &nbsp;&nbsp;<b>".date("Y")." +</b>";}
											else
											{echo "<li><i class='fa fa-check'></i> <a  style='color:DarkOliveGreen;' href='index.php?year=plus'><b><u>".date("Y")." +</u></b></a></li>";}
										
											if(isset($_GET['year'])&&$_GET['year']=="all")
											{echo "<i class='fa fa-check'></i> &nbsp;&nbsp;<b>All years</b>";}
											else
											{echo "<li><i class='fa fa-check'></i> <a  style='color:DarkOliveGreen;' href='index.php?year=all'><b><u>All years</u></b></a></li>";}
										
											$sql="SELECT distinct left(pro_delivery,4) FROM `projects` ORDER BY `projects`.`pro_delivery` desc";
											$res = mysqli_query($mysqli,$sql);	
											if(isset($_GET['year']))
											{
												if($_GET['year']!="plus"&&$_GET['year']!="all")
												{echo "<i class='fa fa-check'></i> &nbsp;&nbsp;";}
												else
												{echo "<li><i class='fa fa-check'></i> ";}
											}
											else{echo "<li><i class='fa fa-check'></i> ";}
											while($row = mysqli_fetch_assoc($res))
											{	

												if(isset($_GET['year'])&&$_GET['year']==$row['left(pro_delivery,4)'])
												{echo "<b>".$row['left(pro_delivery,4)']."</b> &nbsp;&nbsp;";}
												else
												{echo "<a  style='color:DarkOliveGreen;' href='index.php?year=".$row['left(pro_delivery,4)']."'><b><u>".$row['left(pro_delivery,4)']."</u></b></a> ";}
											}
											if(isset($_GET['year']))											
											{
												if($_GET['year']!="plus"&&$_GET['year']!="all")												
												{}
												else
												{echo "</li>";}
											}
											else{echo "</li>";}
											
											echo "<p>";																					
										?>
									
									

									
										</li>
									</u>
                                </div>
                            </div>
                            <!-- End Widget Text-->


                        </aside>
                        <!-- End Sidebars -->


						
						
						
						
                        <div class="col-lg-9">		
                            <div class="panel-box padding-b">
								
                <div class="container paddings-mini">
                    <div class="row">

<style type="text/css">
  .mobileShow {display: none;}

  /* Smartphone Portrait and Landscape */
  @media only screen
    and (min-device-width : 320px)
    and (max-device-width : 480px){ 
      .mobileShow {display: inline;}
  }
</style>
						
<div class="mobileShow">
<center>drag table to scroll</center>
</div>					
							
                            <table border=1 class="table-striped table-responsive table-hover result-point" valign="top">
                                <thead class="point-table-head">
                                    <tr>
                                        <th class="text-left">No</th>
                                        <th class="text-center"><a href='toprank.php'><u>ACHIEVMENT</u></a></th>
                                        <th class="text-center">YEAR</th>
										<th class="text-left">PROJECT NAME</th>
                                        <th class="text-center">BACKERS</th>
                                        <th class="text-center">LIVE</th>									

                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>								
<?php
								
	$sql2="SELECT * FROM projects" ;

	if($_SERVER['QUERY_STRING']==""||$_GET['year']=="plus")
	{
		$sql2=$sql2." where ";
	
		mysqli_data_seek($res, 0); 	
		$firstYear=1;

		while($row = mysqli_fetch_assoc($res))
		{

			if($row['left(pro_delivery,4)']>=date("Y"))
			{
				if($firstYear>1){$sql2=$sql2." or ";}
				$sql2=$sql2." left(pro_delivery,4)='".$row['left(pro_delivery,4)']."' ";
			}

			$firstYear++;
		}
	}
	elseif($_GET['year']=="all"){}
	else
	{
		$sql2=$sql2." where ";		
		$sql2=$sql2." left(pro_delivery,4)='".$_GET['year']."' ";
	}
	//echo $sql2;
	
	
	
	
	
	$sql2=$sql2." order by pro_backers desc limit 0,500";
	//echo $sql2."--<br>";


	$sql3="SELECT * FROM `projects` where left(pro_delivery,4)=".(date("Y")-1)." ORDER BY pro_backers desc limit 0,10";
	//echo $sql3;
	$res3 = mysqli_query($mysqli,$sql3);	
	$k=1;
	while($row3 = mysqli_fetch_assoc($res3))
	{
		if($k==1){$backersBest=$row3['pro_backers'];}
		$backers=$row3['pro_backers'];
		$k++;
	}

	



	
	//echo "===".$backers."||||";

	$res2 = mysqli_query($mysqli,$sql2);	
	$x=1;
	while($row2 = mysqli_fetch_assoc($res2))
	{
		if($row2['pro_daystogo']<>1000){$live='LIVE';}else{$live='';}
			
		echo "<tr>";	
		if($row2['pro_backers']>=$backersBest)
		{
			echo "<td class='text-left number'>".$x."</td><td class='text-right'><span><a href='toprank.php'><u>champion rank</u></a></span></td><td>".substr($row2['pro_delivery'],0,4)."</td><td class='text-left'><span><a target='_blank' href='".$row2['pro_url']."'><u>".$row2['pro_name']."</u></a></span></td><td class='text-left number'>".$row2['pro_backers']."</td><td>".$live."</td>";
		}
		elseif($row2['pro_backers']>=$backers)
		{
			echo "<td class='text-left number'>".$x."</td><td class='text-right'><span><a href='toprank.php'><u>top rank</u></a></span></td><td>".substr($row2['pro_delivery'],0,4)."</td><td class='text-left'><span><a target='_blank' href='".$row2['pro_url']."'><u>".$row2['pro_name']."</u></a></span></td><td class='text-left number'>".$row2['pro_backers']."</td><td>".$live."</td>";
		}		
		else
		{
			echo "<td class='text-left number'>".$x."</td><td class='text-right'><span>&nbsp;</span></td><td>".substr($row2['pro_delivery'],0,4)."</td><td class='text-left'><span><a target='_blank' href='".$row2['pro_url']."'><u>".$row2['pro_name']."</u></a></span></td><td class='text-left number'>".$row2['pro_backers']."</td><td>".$live."</td>";		
		}
		echo "</tr>";
		$x++;
	}
?>								
								
<!--								

                                        <td class='text-left number'></td>
                                        <td class='text-left'><span>top rank</span></td>
                                        <td>38</td>
                                        <td>26</td>
                                        <td>9</td>
                                        <td>3</td>
                                        <td>73</td>
                                        <td>32</td>
                                        <td>+41</td>
                                        <td>87</td>
										-->




                                  </tbody>
                            </table>
							</div></div></div></div>
		

                   </div>
                </div>								


<?php require '2footer.php'; ?>					