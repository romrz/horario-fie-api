<?php 

/*
    Creates a persisten connection using CURL.

    The cookies are stored between requests.
*/
class CurlPersistentConnection
{

    protected $ch; // Curl connection handler

    public function __construct()
    {
        $this->ch = curl_init();
    }

    /*
        Executes a post request to the given URL
        with the given parameters.

        Returns the contents of the response.
    */
    public function get($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($this->ch);
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }

}