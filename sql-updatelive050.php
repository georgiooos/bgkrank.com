<?php 

//demo crawl
//$content = file_get_contents("https://www.kickstarter.com/projects/poots/kingdom-death-monster-15");
//preg_match('#pledged of <span class="money">(.*)</span> goal#', $content, $USDmatch);
//$usd = $USDmatch[1];
//echo str_replace(",","",str_replace("$","",$usd))."<br>";


include("0config.php"); 

//$limitStart=0;
//$sql="SELECT * FROM projects order by pro_id";
//$sql="SELECT * FROM projects where pro_daystogo<>1000 order by pro_id limit 0,55";
$sql="SELECT * FROM projects where pro_daystogo<>1000 order by pro_id limit 50,55";
//$sql="SELECT * FROM projects where pro_daystogo<>1000 order by pro_id limit 100,55";
//$sql="SELECT * FROM projects where pro_daystogo<>1000 order by pro_id limit 150,55";
//$sql="SELECT * FROM projects where pro_daystogo<>1000 order by pro_id limit 200,55";
//$sql="SELECT * FROM projects where pro_daystogo<>1000 order by pro_id limit 250,55";
//$sql="SELECT * FROM projects where pro_daystogo<>1000 order by pro_id limit 300,55";
//$sql="SELECT * FROM projects where pro_daystogo<>1000 order by pro_id limit 350,55";
//$sql="SELECT * FROM projects where pro_daystogo<>1000 order by pro_id limit 400,55";




$res = mysqli_query($mysqli,$sql);	


//$projectLive="";
//$projectFinished="";
$counter=0;
$sqlX="";
while($row = mysqli_fetch_assoc($res))
{
//<a id="back-project-button" href="https://www.kickstarter.com/projects/512772051/merchants-cove/pledge/new?clicked_reward=false" class="bttn bttn-green bttn-large block mb3 keyboard-focusable" style="">Back this project</a>-
	
	$content = file_get_contents($row['pro_url']);
	
	

	//preg_match('#class="bttn bttn-green bttn-large block mb3 keyboard-focusable" style="">(.*)</a>	#', $content, $table1);		
	//$projectLive=$table1[1];
	//preg_match('# backers</b> (.*) <span class="money">$#', $content, $table1);			
	//$projectFinished=$table1[1];
	//echo $projectLive."9999999999999999999".$projectFinished;
	//if($projectLive=="Back this project")
	if(strpos($content, '<a class="bttn bttn-green bttn-medium" id="nav-back-project-button" title="Back this project" href="') !== false) 	
	{

		/*
		preg_match('#<meta property="og:title" content="(.*)"/>#', $content, $table1);	
		$name=str_replace(array("'", "\"", "&quot;", "&#39;", "&amp;#39;", "&amp;quot;", "&#x27;", "&amp;#x27;"),"",$table1[1]);
		*/

		
		preg_match('#<div class="ml5 ml0-lg mb4-lg"><div class="block type-16 type-28-md bold dark-grey-500"><span>(.*)</span></div><span class="block dark-grey-500 type-12 type-14-md lh3-lg">backers</span></div>#', $content, $USDmatch);
		//echo "--------------<p>";
			//print_r($USDmatch);
				//echo "<p>--------------<p>";
		$backers=str_replace(",","",$USDmatch[1]);
		$k=1;
		for($k = 1; $k <= 100; $k++){if(is_numeric(substr($backers,$k-1,1))){}else{break;}}
		$backers=trim(substr($backers,0,$k-1));preg_match('#</span></div><span class="block dark-grey-500 type-12 type-14-md lh3-lg">(.*)</span></div><div class="ml5 ml0-lg"><div><div><span class="block type-16 type-28-md bold dark-grey-500">#', $content, $USDmatch);if(substr($USDmatch[1],strpos($USDmatch[1],"backer<"),7)=="backer<")($backers=1);


		if(strpos($content, '<span class="block navy-600 type-12 type-14-md lh3-lg">hours<!-- --> <!-- -->to go</span>') !== false)
		{
			$days=2;
		}
		else
		{

			preg_match('#<div class="ml5 ml0-lg"><div><div><span class="block type-16 type-28-md bold dark-grey-500">(.*)</span><span class="block navy-600 type-12 type-14-md lh3-lg">days<!-- --> <!-- -->to go</span></div></div></div></div><div class="py0 pb2">#', $content, $table1);
			$days=$table1[1];
			if($days==""){$days=0;}			
		}


		/*
		preg_match('#data-format="MMM YYYY" class="invisible-if-js js-adjust-time">(.*)</time></span>#', $content, $table1);
		$delivery=$table1[1];
		$month=substr($delivery,0,3);
		
		if($month=="Jan"){$month="01";}elseif($month=="Feb"){$month="02";}elseif($month=="Mar"){$month="03";}elseif($month=="Apr"){$month="04";}elseif($month=="May"){$month="05";}elseif($month=="Jun"){$month="06";}elseif($month=="Jul"){$month="07";}elseif($month=="Aug"){$month="08";}elseif($month=="Sep"){$month="09";}elseif($month=="Oct"){$month="10";}elseif($month=="Nov"){$month="11";}elseif($month=="Dec"){$month="12";}		


		preg_match('#<div class="type-14 bold">(.*)</div><div class="mr2">#', $content, $table1);
		$pub=$table1[1];
		*/
		//echo "<a href='".$row['pro_url']."'>".$row['pro_url']."</a><br>";


		/*
		$sql2="SELECT * FROM publishers where pub_name='".$pub."'";
		$res2 = mysqli_query($mysqli,$sql2);	
		$row2 = mysqli_fetch_assoc($res2);
		*/
		
		/*
		if(mysqli_num_rows($res2)==0)
		{
			$sql4="insert into publishers(pub_name,pUb_proj_count)values('".$pub."',1)";
			mysqli_query($mysqli,$sql4);

			$sql3="SELECT max(pub_id) FROM publishers";
			$res3 = mysqli_query($mysqli,$sql3);	
			$row3 = mysqli_fetch_assoc($res3);


			$sql5="update projects set `pro_name`='".$name."', `pro_backers`=".$backers.", `pro_daystogo`=".$days.", `pro_delivery`='".substr($delivery,4,4)."-".$month."-01', `pro_visible_f`=1, pro_pub_id=".$row3['max(pub_id)']." where pro_id=".$row['pro_id'].";";
			echo $sql5."<br>";//1
			//echo " |||| <a href=".$row['pro_url'].">".$row['pro_url']."</a><br>";						
			//mysqli_query($mysqli,$sql5);					
			//echo $counter."<br>";

		}
		else
		{

			$sql4="update publishers set pub_pro_count=".($row2['pub_pro_count']+1)." where pub_id=".$row2['pub_id'];
			echo $sql4.";<br>";
			//mysqli_query($mysqli,$sql4);
		*/
			if($backers!=""&&$days!="")
			{		
			$sql5="update projects set `pro_backers`=".$backers.", `pro_daystogo`=".$days." where pro_id=".$row['pro_id'].";";
			$sqlX=$sqlX.$sql5;			
			echo $sql5."<br>";//1
			}
			//echo " |||| <a href=".$row['pro_url'].">".$row['pro_url']."</a><br>";						
			//mysqli_query($mysqli,$sql5);					
			//echo $counter."<br>";			
		//}


		//echo " |||| <a href=".$row['pro_url'].">".$row['pro_url']."</a>";

	}
	//if($projectLive=="pledged")
		 
	if(strpos($content, 'backers</b> pledged <span class="money">') !== false) 		 
	{
		
		//preg_match('#<meta property="og:title" content="(.*)"/>#', $content, $table1);	
		//$name=str_replace(array("'", "\"", "&quot;", "&#39;", "&amp;#39;", "&amp;quot;", "&#x27;", "&amp;#x27;"),"",$table1[1]);
		

		
		preg_match('#<b>(.*) backer#', $content, $USDmatch);
		$backers=str_replace(",","",$USDmatch[1]);
		$k=1;
		for($k = 1; $k <= 100; $k++){if(is_numeric(substr($backers,$k-1,1))){}else{break;}}
		$backers=trim(substr($backers,0,$k-1));preg_match('#</span></div><span class="block dark-grey-500 type-12 type-14-md lh3-lg">(.*)</span></div><div class="ml5 ml0-lg"><div><div><span class="block type-16 type-28-md bold dark-grey-500">#', $content, $USDmatch);if(substr($USDmatch[1],strpos($USDmatch[1],"backer<"),7)=="backer<")($backers=1);


		//preg_match('#<span class="block type-16 type-24-md medium soft-black">(.*)</span><span class="block navy-600 type-12 type-14-md lh3-lg">days<!-- --> <!-- -->to go</span></div></div></div></div><div class="py0 pb2"><a id="back-project-button"#', $content, $table1);
		//echo "days ".$table1[1]."!!!!!!!!!!!!<br>";
		
		/*
		preg_match('#data-format="MMM YYYY" class="invisible-if-js js-adjust-time">(.*)</time></span>#', $content, $table1);
		$delivery=$table1[1];
		$month=substr($delivery,0,3);
		
		if($month=="Jan"){$month="01";}elseif($month=="Feb"){$month="02";}elseif($month=="Mar"){$month="03";}elseif($month=="Apr"){$month="04";}elseif($month=="May"){$month="05";}elseif($month=="Jun"){$month="06";}elseif($month=="Jul"){$month="07";}elseif($month=="Aug"){$month="08";}elseif($month=="Sep"){$month="09";}elseif($month=="Oct"){$month="10";}elseif($month=="Nov"){$month="11";}elseif($month=="Dec"){$month="12";}		

		preg_match('#by (.*) &mdash; Kickstarter#', $content, $table2);
		$pub=trim(substr($table2[1],0,40));
		*/
		//echo "||||".$pub."-----";


		/*
		$sql2="SELECT * FROM publishers where pub_name='".$pub."'";
		$res2 = mysqli_query($mysqli,$sql2);	
		$row2 = mysqli_fetch_assoc($res2);

		if(mysqli_num_rows($res2)==0)
		{
			$sql4="insert into publishers(pub_name,pub_proj_count)values('".$pub."',1)";
			
			mysqli_query($mysqli,$sql4);

			$sql3="SELECT max(pub_id) FROM publishers";
			$res3 = mysqli_query($mysqli,$sql3);	
			$row3 = mysqli_fetch_assoc($res3);
		*/
			//echo $sql3;


			/*
			$sql5="update projects set `pro_name`='".$name."', `pro_backers`=".$backers.", `pro_daystogo`=1000, `pro_delivery`='".substr($delivery,4,4)."-".$month."-01', `pro_visible_f`=1, pro_pub_id=".$row3['max(pub_id)']." where pro_id=".$row['pro_id'].";";
			echo $sql5."<br>";//2
			*/
			//echo " |||| <a href=".$row['pro_url'].">".$row['pro_url']."</a><br>";
			//mysqli_query($mysqli,$sql5);					
			//echo $counter."<br>";
		/*
		}
		else
		{

			$sql4="update publishers set pub_pro_count=".($row2['pub_pro_count']+1)." where pub_id=".$row2['pub_id'];
			echo $sql4.";<br>";
		*/
			//mysqli_query($mysqli,$sql4);
			if($backers!="")
			{			
			$sql5="update projects set `pro_backers`=".$backers.", `pro_daystogo`=1000 where pro_id=".$row['pro_id'].";";
			$sqlX=$sqlX.$sql5;			
			echo $sql5."<br>";//2
			}

			//mysqli_query($mysqli,$sql5);					
			//echo $counter."<br>";
		//}


		//echo "<a href='".$row['pro_url']."'>".$row['pro_url']."</a><br>";
		
	}

	if(strpos($content, 'backers</b> pledged <span class="money">') === false&&strpos($content, '<a class="bttn bttn-green bttn-medium" id="nav-back-project-button" title="Back this project" href="') === false)
	{

		//preg_match('#<meta property="og:title" content="(.*)"/>#', $content, $table1);	
		//$name=str_replace(array("'", "\"", "&quot;", "&#39;", "&amp;#39;", "&amp;quot;", "&#x27;", "&amp;#x27;"),"",$table1[1]);
		

		
		preg_match('#<div class="ml5 ml0-lg mb4-lg"><div class="block type-16 type-28-md bold dark-grey-500"><span>(.*)</span></div><span class="block dark-grey-500 type-12 type-14-md lh3-lg">backers</span></div>#', $content, $USDmatch);

		$backers=str_replace(",","",$USDmatch[1]);
		$k=1;
		for($k = 1; $k <= 100; $k++){if(is_numeric(substr($backers,$k-1,1))){}else{break;}}
		$backers=trim(substr($backers,0,$k-1));preg_match('#</span></div><span class="block dark-grey-500 type-12 type-14-md lh3-lg">(.*)</span></div><div class="ml5 ml0-lg"><div><div><span class="block type-16 type-28-md bold dark-grey-500">#', $content, $USDmatch);if(substr($USDmatch[1],strpos($USDmatch[1],"backer<"),7)=="backer<")($backers=1);



		//preg_match('#<span class="block type-16 type-24-md medium soft-black">(.*)</span><span class="block navy-600 type-12 type-14-md lh3-lg">days<!-- --> <!-- -->to go</span></div></div></div></div><div class="py0 pb2"><a id="back-project-button"#', $content, $table1);
		//echo "days ".$table1[1]."!!!!!!!!!!!!<br>";

		/*
		preg_match('#data-format="MMM YYYY" class="invisible-if-js js-adjust-time">(.*)</time></span>#', $content, $table1);
		$delivery=$table1[1];
		$month=substr($delivery,0,3);
		
		if($month=="Jan"){$month="01";}elseif($month=="Feb"){$month="02";}elseif($month=="Mar"){$month="03";}elseif($month=="Apr"){$month="04";}elseif($month=="May"){$month="05";}elseif($month=="Jun"){$month="06";}elseif($month=="Jul"){$month="07";}elseif($month=="Aug"){$month="08";}elseif($month=="Sep"){$month="09";}elseif($month=="Oct"){$month="10";}elseif($month=="Nov"){$month="11";}elseif($month=="Dec"){$month="12";}		

		preg_match('#by (.*) &mdash; Kickstarter#', $content, $table1);
		$pub=trim(substr($table1[1],0,40));
		*/
		//echo "||2||".$pub."-----";

		/*
		$sql2="SELECT * FROM publishers where pub_name='".$pub."'";
		$res2 = mysqli_query($mysqli,$sql2);	
		$row2 = mysqli_fetch_assoc($res2);

		if(mysqli_num_rows($res2)==0)
		{
			$sql4="insert into publishers(pub_name,pub_proj_count)values('".$pub."',1)";
			
			mysqli_query($mysqli,$sql4);
			echo $sql4;

			$sql3="SELECT max(pub_id) FROM publishers";
			$res3 = mysqli_query($mysqli,$sql3);	
			$row3 = mysqli_fetch_assoc($res3);

			//echo $sql3;


			$sql5="update projects set `pro_name`='".$name."', `pro_backers`=".$backers.", `pro_daystogo`=1000, `pro_delivery`='".substr($delivery,4,4)."-".$month."-01', `pro_visible_f`=1, pro_pub_id=".$row3['max(pub_id)']." where pro_id=".$row['pro_id'].";";
			echo $sql5."<br>";//3

			//mysqli_query($mysqli,$sql5);					
			//echo $counter."<br>";			


		}
		else
		{

			$sql4="update publishers set pub_pro_count=".($row2['pub_pro_count']+1)." where pub_id=".$row2['pub_id'];
			echo $sql4.";<br>";
			//mysqli_query($mysqli,$sql4);
		*/
			if($backers!="")
			{			
			$sql5="update projects set `pro_backers`=".$backers.", `pro_daystogo`=1000 where pro_id=".$row['pro_id'].";";
			$sqlX=$sqlX.$sql5;					
			echo $sql5."<br>";//3
			}
			//echo " 111111 <a href=".$row['pro_url'].">".$row['pro_url']."</a><br>";			
			//mysqli_query($mysqli,$sql5);					
			//echo $counter."<br>";			
		//}


		//echo "<a href='".$row['pro_url']."'>".$row['pro_url']."</a><br>";
		
	}
	//$counter++;

	//echo $i." ".$sql."<br>";
	//mysqli_query($mysqli,$sql);		

	/*	
	$projectLive="";
	$projectFinished="";
	*/
} 
//echo "<p>".$sqlX."<p>";//3
mysqli_multi_query($mysqli,$sqlX);					

echo $sql;
?>
