<?php

use Phalcon\Mvc\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;

class IndexController extends Controller
{
    public function indexAction()
    {


        $client = new Client();

        // $resource = \GuzzleHttp\Psr7\Utils::tryFopen('http://httpbin.org', 'r');
        $response = $client->request('GET', 'http://api.weatherapi.com/v1/search.json?key=0bab7dd1bacc418689b143833220304&q=$location');
        $body = $response->getBody();
        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase();
        $bod = (object)json_decode($body, true);
        echo "<pre>";
        print_r($bod);
        die;









        // $url = "http://httpbin.org/post";

        // //     // Initialize a CURL session.
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt(
        //     $ch,
        //     CURLOPT_POSTFIELDS,
        //     "postvar1=value1&postvar2=value2&postvar3=value3"
        // );

        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $server_output = curl_exec($ch);
        // $res=json_decode($server_output);
        // echo "<pre>";
        // print_r( $server_output);
        // die;
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //     //grab URL and pass it to the variable.
        //     curl_setopt($ch, CURLOPT_URL, $url);


        //     $response = curl_exec($ch);

        //     $res=json_decode($response);
        //     echo "<pre>";
        //    print_r($res);
        // // echo $res->iss_position->longitude;

        //     $url2= "http://api.open-notify.org/astros.json";
        //     $fz=curl_init();
        //     curl_setopt($fz, CURLOPT_RETURNTRANSFER, 1);
        //     curl_setopt($fz, CURLOPT_URL, $url2);
        //     $result=curl_exec($fz);
        //     $r=json_decode($result);
        //     echo "<pre>";
        //     foreach($r as $k=>$v){
        //         foreach($v as $f=>$s){
        //             echo "<pre>";
        //     print_r($s->name);


        //     }   
        // }die;
    }
    /**
     * function to search a perticular book and display the result
     */
    public function searchAction()
    {

        $search = $_POST['search'];
        // echo $search;
        $s = explode(" ", $search);
        //    print_r ($s);

        $final = implode("+", $s);
        echo $final;
        echo "<br>";

        $url = "https://openlibrary.org/search.json?q=$final&mode=ebooks&has_fulltext=true";
        echo $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        $res = json_decode($response);
        //  echo "<pre>";
        //    print_r($res);
        //    die;  
        // foreach($res->docs as $k =>$v){
        //     echo "<pre>";
        //     echo ($v->amazon_id[0]); 
        //     die;
        // }
        $this->view->response = $res;

        // die;

    }

    /**
     * function to display the single detailed page
     */
    public function singleAction()
    {

        $key = $this->request->getPost('hidden');
        $imghidden = $this->request->getPost('imghidden');
        $j = ".json";
        //    print_r($imghidden);
        //     die; 
        $url = "https://openlibrary.org" . $key . $j;
        $ch = curl_init();
        // echo $url;
        // die;
        //grab URL and pass it to the variable.
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);

        $apidata = json_decode($response);
        echo "<pre>";
        // print_r($apidata);
        // die();
        $this->view->details = $apidata;
        $this->view->url = $imghidden;
    }
}
