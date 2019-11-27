<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic -->
        <meta charset="utf-8">

							<?php if($_GET['liveday']=="new"){ ?>
								<title>LIVE, new publishers, backers/days | Boardgame Kickstarter Rank Database | BGK rank</title>
							<?php }elseif($_GET['liveday']==0){ ?>
								<title>LIVE, backers/days | Boardgame Kickstarter Rank Database | BGK rank</title>
							<?php } ?>
							
        
							<?php if($_GET['liveday']=="new"){ ?>
								<meta name="description" content="LIVE, new publishers, backers/days | Boardgame Kickstarter Rank Database | BGK rank">
							<?php }elseif($_GET['liveday']==0){ ?>
								<meta name="description" content="LIVE, backers/days | Boardgame Kickstarter Rank Database | BGK rank">
							<?php } ?>
		
        <meta property="og:image" content="https://bgkrank.com/img/logo.png" />    							
		
<?php require '1header.php'; ?>			


            <!-- Section Title -->
            <div class="section-title" style="background:url(img/slide/1.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
							<?php if($_GET['liveday']=="new"){ ?>
								<h1>LIVE, new publishers, backers/days</h1>
							<?php }elseif($_GET['liveday']==0){ ?>
								<h1>LIVE, backers/days</h1>							
							<?php } ?>
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
                                        <th class="text-left">PROJECT NAME</th>
                                        <th class="text-left">BACKERS</th>
                                        <th class="text-left">DAYS TO GO</th>


                                    </tr>
                                </thead>

                                <tbody class="text-center">
								
								
<?php 



			

include("0config.php"); 


if(isset($_GET['liveday']))
{
	if($_GET['liveday']=="new")	
	{
		$sql="SELECT * FROM projects,publishers where pub_id=pro_pub_id and pub_pro_count=1 and pro_daystogo<>1000";
	}
	elseif($_GET['liveday']==0)
	{
		$sql="SELECT * FROM projects,publishers where pub_id=pro_pub_id and pub_pro_count>1 and pro_daystogo<>1000";
	}
}
//echo $sql;
$res = mysqli_query($mysqli,$sql);	
$num_rows = mysqli_num_rows($res);
//$i=1;

while($row = mysqli_fetch_assoc($res))
{
	//echo bcmul(($row['pro_backers']/(30-$row['pro_daystogo'])))." ".$row['pro_backers']." ".$row['pro_delivery']." ".$row['pro_name']." ".$row['pro_url']." ".$row['pro_backers']." ".$row['pro_daystogo']."<br>";
			
	$days=$row['pro_daystogo'];
	//if($days==0){$days=29;}		
	//if($days<0){$days=35;}		
	//$bkrday=$row['pro_backers']/;

	$pro[] = array('pro_id'=>$row['pro_id'],'pro_name'=>$row['pro_name'],'pro_url'=>$row['pro_url'],'pro_backers'=>$row['pro_backers'],'pro_daystogo'=>$row['pro_daystogo'],'pro_delivery'=>$row['pro_delivery'],'pro_pub_id'=>$row['pro_pub_id'],'pro_bkrday'=>($row['pro_backers']*$days));

//$pro[] = array('pro_id'=>$row['pro_id'],'pro_name'=>$row['pro_name'],'pro_url'=>$row['pro_url'],'pro_backers'=>$row['pro_backers'],'pro_daystogo'=>$row['pro_daystogo'],'pro_delivery'=>$row['pro_delivery'],'pro_pub_id'=>$row['pro_pub_id']);
	
	//echo $pro[1]['pro_id'];
	//$i++;
			
			 
}
/*
for ($i = 0; $i <= $num_rows; $i++) {
    echo $pro[$i]['pro_bkrday']." ".$pro[$i]['pro_id']." ".$pro[$i]['pro_name']." ".$pro[$i]['pro_url']." ".$pro[$i]['pro_backers']." ".$pro[$i]['pro_daystogo']." ".$pro[$i]['pro_delivery']." ".$pro[$i]['pro_pub_id']." <p>";

}
*/
$columns = array_column($pro, 'pro_bkrday');
array_multisort($columns, SORT_DESC, $pro);

for ($i = 0; $i < $num_rows; $i++) {
	echo "<tr>";
	if($pro[$i]['pro_daystogo']==2)
	{
	    echo "<td class='text-left number'>".($i+1)."</td><td class='text-left'><span><a target='_blank' href='".$pro[$i]['pro_url']."'><u>".$pro[$i]['pro_name']."</u></a></span></td><td class='text-left number'>".$pro[$i]['pro_backers']."</td><td class='text-left number'>2&nbsp;<b>to</b>&nbsp;Done&nbsp;recently</td>";
    }
    else
    {
	    echo "<td class='text-left number'>".($i+1)."</td><td class='text-left'><span><a target='_blank' href='".$pro[$i]['pro_url']."'><u>".$pro[$i]['pro_name']."</u></a></span></td><td class='text-left number'>".$pro[$i]['pro_backers']."</td><td class='text-left number'>".$pro[$i]['pro_daystogo']."</td>";    	
    }
	echo "</tr>";
}

//print_r($pro);
//echo "|||".$pro[1]['pro_id']."===";

?>								
								
								
                                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>			
			

<?php require '2footer.php'; ?>			