<?php
	class phpCURL
	{
		function postData($url,$table,$fields)
		{
			$fields_string = '';
			//url-ify the data for the POST
			foreach($fields as $key=>$value) 
			{
				$fields_string .= $key.'='.$value.'&';
				//echo $fields_string;
			}
			rtrim($fields_string, '&');
			//echo $fields_string;

			//open connection
			$ch = curl_init();

			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($fields));

			//execute post
			$result = curl_exec($ch);
			if(curl_errno($ch))
			{
					print 'CURL Error: '.curl_error($ch);
			}

			//close connection
			curl_close($ch);
		}
	}
?>