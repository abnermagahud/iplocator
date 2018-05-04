<?php
/**
 * A class to identify the location of an IP address
 *
 * @author Abner Magahud <abnermagahud@gmail.com>
 */
class IPlocator{
	
	/**
	 * Locate the IP address
	 * @param  string $ip 		IP address to locate
	 * @return array
	 */
	public function locateIP($ip)
	{
		if(!empty($ip))
		{
			if($this->validateIP($ip))
			{
				return $this->call($ip);
			}
			else
			{
				echo "Invalid IP address";
			}
			
		}
		else
		{
			throw new Exception("Please put an IP address", 1);
		}
	}

	/**
	 * Call the IP locator API
	 * @param  string $ip		IP address
	 * @return array
	 */
	public function call($ip)
	{
		// Get cURL resource
		$ch = curl_init("http://extreme-ip-lookup.com/json/".$ip."");

		// Set cURL options
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  

		// Send the request & save response to $output 
		$output = curl_exec($ch);   

		// Close request to clear up some resources    
		curl_close($ch);

		// Return output into array
		return $this->convertJsonToArray($output);
	}

	/**
	 * Validate the IP address if it is correct format
	 * @param  string 		IP address to validate
	 * @return boolean
	 */
	public function validateIP($ip)
	{
		if (filter_var($ip, FILTER_VALIDATE_IP)) 
		{
		    return true;
		} 
		else 
		{
		    return false;
		}
	}

	/**
	 * Convert JSON data into array
	 * @param  string $json 	JSON data
	 * @return array
	 */
	public function convertJsonToArray($json)
	{
		return json_decode($json, TRUE);
	}
}

?>
