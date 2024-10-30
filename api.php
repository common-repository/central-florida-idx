<?php 


	$query=$_SERVER['QUERY_STRING']; // the query string used when this page is loaded, whatever it may be
	
	$url1="https://tmls.idxblue.com/index.php?".$query;  // the IDXblue main file, with the query string appended
				
	$url2=$url1."&xml=yes&json=yes"; // take the original URL and add some extra query string to achieve desired result
	
	$ch = curl_init($url2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);       
	curl_close($ch);
	echo $output;
	
?>