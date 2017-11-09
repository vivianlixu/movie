<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MovieConnection extends Controller
{
    /**
     * Get the url
     * @return string
     */
    public function getUrl()
    {
        return "http://alintacodingtest.azurewebsites.net/api/Movies";
    }

    /**
     * Configure the connection
     * @return resource
     */
    public function createConnection()
    {
        $url = $this->getUrl();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

    /**
     * Execute the url
     * @return mixed
     */
    public function getResponse()
    {
        $ch = $this->createConnection();
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $this->checkResponse($httpcode);
        return $response;
    }

    /**
     * Check the response
     * @param $httpcode int
     */
    protected function checkResponse($httpcode)
    {
        $acceptableStatus = 200;
        if($httpcode != $acceptableStatus) {
            throw new Exception("Status is incorrect");
        }
    }
}
