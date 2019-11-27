<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic -->
        <meta charset="utf-8">
        <title>LIVE, by last project | Boardgame Kickstarter Rank Database | BGK rank</title>
		
        <meta name="description" content="LIVE, by last project | Boardgame Kickstarter Rank Database | BGK rank">
        <meta property="og:image" content="https://bgkrank.com/img/logo.png" />    
		
<?php require '1header.php'; ?>	




            <!-- Section Title -->
            <div class="section-title" style="background:url(img/slide/1.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>LIVE, by last project</h1>
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
                        <div class="col-lg-12">
						
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
						
                            <table class="table-striped table-responsive table-hover result-point">
                                <thead class="point-table-head">
                                    <tr>
                                        <th class="text-left">No</th>
                                        <th class="text-left">LAST PROJ. BACKERS</th>

                                        <th class="text-left">PROJECT NAME</th>
                                        <th class="text-left">YEAR</th>										
                                        <th class="text-left">PUBLISHER</th>

                                    </tr>
                                </thead>

                                <tbody class="text-center">
<?php 



			

include("0config.php"); 



	$sql3="select pro_pub_id,pub_name from projects,publishers where pro_pub_id=pub_id and pro_daystogo=1000 and pro_pub_id in (select pro_pub_id from projects where pro_daystogo<>1000) GROUP by pro_pub_id";
	//echo $sql3;
	$res3 = mysqli_query($mysqli,$sql3);
    $num_rows = mysqli_num_rows($res3);									
	while($row3 = mysqli_fetch_assoc($res3))
	{

		$sql="SELECT * from projects where pro_daystogo<>1000 and pro_pub_id=".$row3['pro_pub_id'];
		//echo $sql3;
		$res = mysqli_query($mysqli,$sql);	
		$row = mysqli_fetch_assoc($res);

		$sql2="SELECT * from projects where pro_daystogo=1000 and pro_pub_id=".$row3['pro_pub_id']." order by pro_delivery desc";
		//echo $sql3;
		$res2 = mysqli_query($mysqli,$sql2);	
		$row2 = mysqli_fetch_assoc($res2);		
		
	$pro[] = array('pro_backers'=>$row2['pro_backers'],'pro_delivery'=>$row['pro_delivery'],'pro_name'=>$row['pro_name'],'pro_url'=>$row['pro_url'],'pub_name'=>$row3['pub_name']);

}
$columns = array_column($pro, 'pro_backers');
array_multisort($columns, SORT_DESC, $pro);

for ($i = 0; $i < 50; $i++) {
	echo "<tr>";


    echo "<td class='text-left number'>".($i+1)."</td><td class='text-left number'>".$pro[$i]['pro_backers']."</td><td class='text-left'><span><a target='_blank' href='".$pro[$i]['pro_url']."'><u>".$pro[$i]['pro_name']."</u></a></span></td><td>".substr($row2['pro_delivery'],0,4)."</td><td class='text-left'><span>".$pro[$i]['pub_name']."</span></td>";    	

	echo "</tr>";
}


?>
									
									
																	
                                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>		
<?php require '2footer.php'; ?>			