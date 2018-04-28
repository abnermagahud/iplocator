<?php
/**
 * A class to identify the location of an IP address
 *
 * @author Abner Magahud <abnermagahud@gmail.com>
 */
class IPlocator{
	
	/**
	 * Locate the IP address
	 * @param  string $ip 	IP address
	 * @return array
	 */
	public function locateIP($ip)
	{
		if(!empty($ip))
		{
			return $this->call($ip);
		}
		else
		{
			throw new Exception("Please put an IP address", 1);
		}
	}

	/**
	 * Call the IP locator API
	 * @param  string $ip	IP address
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
	 * Convert JSON data into array
	 * @param  string $json JSON data
	 * @return array
	 */
	public function convertJsonToArray($json)
	{
		return json_decode($json, TRUE);
	}
}

?>