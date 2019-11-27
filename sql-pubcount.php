<?php 

//demo crawl
//$content = file_get_contents("https://www.kickstarter.com/projects/poots/kingdom-death-monster-15");
//preg_match('#pledged of <span class="money">(.*)</span> goal#', $content, $USDmatch);
//$usd = $USDmatch[1];
//echo str_replace(",","",str_replace("$","",$usd))."<br>";


include("0config.php"); 


$sql="SELECT * FROM publishers";




$res = mysqli_query($mysqli,$sql);	

$i=1;
//$projectLive="";
//$projectFinished="";
while($row = mysqli_fetch_assoc($res))
{
	

	$sql2="SELECT * FROM projects where pro_pub_id=".$row['pub_id'];
	$res2 = mysqli_query($mysqli,$sql2);	
		


	


			$sql5="update publishers set pub_pro_count=".mysqli_num_rows($res2)." where pub_id=".$row['pub_id'];
			//$sql5="update publishers set pub_pro_count= where pub_id=".$row['pub_id'];	
			echo $sql5.";<br>";
			//mysqli_query($mysqli,$sql5);							
		
			//echo $row['pro_id'].",".$row2['pro_id'].",";
			//echo "888".$i."<br>";
			$i++;
		
}


		 


?>
