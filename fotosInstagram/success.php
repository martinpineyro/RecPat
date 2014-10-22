<?php

/**
 * Instagram PHP API
 * 
 * @link https://github.com/cosenary/Instagram-PHP-API
 * @author Christian Metz
 * @since 01.10.2013
 */

require_once 'instagram.class.php';

// initialize class
$instagram = new Instagram(array(
  'apiKey'      => 'c1bd7a211a3c444592904287f36fe4cc',
  'apiSecret'   => '2b1ee36d7d234faeb94c038ec80e3ce8',
  'apiCallback' => 'http://www.mpineyro.com/fotosInstagram/success.php' // must point to success.php
));

// receive OAuth code parameter
$code = $_GET['code'];

// check whether the user has granted access
if (isset($code)) {

  // receive OAuth token object
  $data = $instagram->getOAuthToken($code);
  $username = $username = $data->user->username;
  
  // store user access token
  $instagram->setAccessToken($data);

  // now you have access to all authenticated user methods
  
  /*
  $latitud = -33.26340999753042;
  $longitud = -55.55895542272177;
  */
  
  $latitud = 40.71459922170601;
  $longitud = -74.00542867768267;
  
  
  $distance = 5000; //entre min = 1000, max = 5000
  $cantidadDeFotos = 500;
 
  
  $result = $instagram->searchLocation($latitud,$longitud, $distance);
  

} else {

  // check whether an error occurred
  if (isset($_GET['error'])) {
    echo 'An error occurred: ' . $_GET['error_description'];
  }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fotos por coordenadas lat y long</title>
    
    <link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/4.2/video.js"></script>
  </head>
  <body>
    <div class="container">
      <header class="clearfix">
       
        <h1>Fotos por latitud y longitud<span> <? echo "latitud: ".$latitud ?></span> <span> <? echo "longitud: ".$longitud ?></span> <span> <? echo "distancia (radio): ".$distance ?></span></h1>
      </header>
      <div class="main">
        <ul class="grid">
        
        
        <?php
        	
           $ubicacionesID = array();
          
          //llenar un array con todas las ubicaciones cercanas a la lat y long que eleg¨ª
          foreach ($result->data as $ubicacion) {
          
          //echo $ubicacion->id;
          //echo "-";
   	  
   	  $resultado = $instagram->getLocationMedia($ubicacion->id);
          	
          	foreach ($resultado->data as $media) 
	           {
	           echo $ubicacion->id;
	           
	            $content = "<li>";

		            if ($media->type === 'video') {
		              // video
		              $poster = $media->images->low_resolution->url;
		              $source = $media->videos->standard_resolution->url;
		              $content .= "<video class=\"media video-js vjs-default-skin\" width=\"250\" height=\"250\" poster=\"{$poster}\"
		                           data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
		                             <source src=\"{$source}\" type=\"video/mp4\" />
		                           </video>";

		            } 
		            else if ($media->type === 'image'){
		              // image
		              $image = $media->images->low_resolution->url;
		              $content .= "<img class=\"media\" src=\"{$image}\"/>";
	
		            }
		                        
				
		            // create meta section
		            $avatar = $media->user->profile_picture;
		            $username = $media->user->username;
		            $comment = $media->caption->text;
		            $latFoto= $media->location->latitude;
		            $longFoto= $media->location->longitude;
		            
		            $content .= "<div class=\"content\">
		                           <div class=\"avatar\" style=\"background-image: url({$avatar})\"></div>
		                           <p>".$latFoto."</p>
		                           <p>".$longFoto."</p>
		                          
		                           <div class=\"comment\">{$comment}</div>
		                         </div>";

		            // output media
		           echo $content . "</li>";
		           
		   }	
           }


         
          
        ?>
        </ul>
      
      </div>
    </div>
    <!-- javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        // rollover effect
        $('li').hover(
          function() {
            var $image = $(this).find('.image');
            var height = $image.height();
            $image.stop().animate({ marginTop: -(height - 82) }, 1000);
          }, function() {
            var $image = $(this).find('.image');
            var height = $image.height();
            $image.stop().animate({ marginTop: '0px' }, 1000);
          }
        );
      });
    </script>
  </body>
</html>