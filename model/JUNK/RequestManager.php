<?php

namespace Microsoft\Office365\UnifiedAPI\Connect;

require_once '../model/Constants.php';

/** 
 *  Sends POST requests to the specified endpoint. 
 *  It's used by AuthenticationManager to get OAuth tokens 
 *
 *  @class    RequestManager
 *  
 */
class RequestManager
{
    
    /**
     *  Helper method to send a POST request.
     *
     *  @param string $endpoint The endpoint to send the request to.
     *  @param array  $headers  Array of key-value pairs that form the header.
     *  @param array  $body     Array of key-value pairs that form the body.
     *
     *  @function sendPostRequest
     *  @return   string The raw response returned by the endpoint.
     */
    public static function sendPostRequest($endpoint, $headers, $body) 
    {
        $curl = curl_init();
        json_encode($body);
        
        curl_setopt_array(
            $curl, 
            array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $endpoint,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_POSTFIELDS => $body
            )
        );
        
        // The following curl options can be used in development to debug the code.
        // Option to disable certificate verification. Do not use on production env.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        // Option to set a proxy for curl to use. 
        // Useful if you want to review traffic with a tool like Fiddler. 
        // curl_setopt($curl, CURLOPT_PROXY, '127.0.0.1:8888');
        
        // Enable error reporting on curl
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
      

        
        // Send the request & save response to a variable
        $response = curl_exec($curl);
        // Check for errors
        if (curl_errno($curl)) {
            throw new \RuntimeException(curl_error($curl));
        }
        
        // Close request and clear some resources
        curl_close($curl);
        
        return $response;
    }
}
?>
