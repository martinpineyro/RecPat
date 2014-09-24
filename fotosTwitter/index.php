<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "564014998-SqGBmG5shexaDxTEc5tjAGkULynRnAUmIMrKComS",
    'oauth_access_token_secret' => "QjMe4xTyG7TuDhn8XV7Dv68tyYhulOaHaCykJKlOMPTxv",
    'consumer_key' => "TdnwK3nLPRAN8VRIStCM2qWcD",
    'consumer_secret' => "jAhXMzPyen2l6GVMI8xwVnfvQ1ITi0YJyjroePfs1I6AyFw6VA"
);



$contador = 1;
$totalFotos =1000;

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=filter%3Aimages&geocode=-32,-55,200km&count=100';


$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

$response =  $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
   
$response = json_decode($response);


	$maximo_id = $response->statuses[0]->id;
	
	foreach($response->statuses as $tweet)
	{
	
	if($tweet->id<=$maximo_id){
	$maximo_id = $tweet->id;
	}
	
	  echo "<p>$contador&nbsp<b>{$tweet->user->screen_name}</b>:&nbsp HORA: &nbsp {$tweet->created_at}&nbsp UBICACION: &nbsp{$tweet->user->location}&nbsp<img src='{$tweet->entities->media[0]->media_url}' width='100'>&nbsp POSICION:{$tweet->coordinates->coordinates[1]},{$tweet->coordinates->coordinates[0]}</p>\n";
	  echo "\n";
	  
	  $contador++; 
	   
	}
	


while($contador<$totalFotos){

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=filter%3Aimages&geocode=-32,-55,150km&count=100&max_id='.$maximo_id;


$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

$response =  $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
   

$response = json_decode($response);

$cursor = $response->next_page;
echo $cursor;

	foreach($response->statuses as $tweet)
	{
	
	if($tweet->id<=$maximo_id){
	$maximo_id = $tweet->id;
	}

	
	  echo "<p>$contador&nbsp<b>{$tweet->user->screen_name}</b>:&nbsp HORA: &nbsp {$tweet->created_at}&nbsp UBICACION: &nbsp{$tweet->user->location}&nbsp<img src='{$tweet->entities->media[0]->media_url}' width='100'>&nbsp POSICION:{$tweet->coordinates->coordinates[1]},{$tweet->coordinates->coordinates[0]}</p>\n";
	  echo "\n";
	  $contador++;
	 }
	
	

}



?>
