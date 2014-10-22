<?php

require 'instagram.class.php';

// initialize class
$instagram = new Instagram(array(
  'apiKey'      => 'c1bd7a211a3c444592904287f36fe4cc',
  'apiSecret'   => '2b1ee36d7d234faeb94c038ec80e3ce8',
  'apiCallback' => 'http://www.mpineyro.com/fotosInstagram/success.php' // must point to success.php
));



// create login URL
$loginUrl = $instagram->getLoginUrl();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram - OAuth Login</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <style>
      .login {
        display: block;
        font-size: 20px;
        font-weight: bold;
        margin-top: 50px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <header class="clearfix">
        <h1><span>buscar fotos en Instagram por latitud y longitud</span></h1>
      </header>
      <div class="main">
        <ul class="grid">
          
          <li>
            <a class="login" href="<? echo $loginUrl ?>">» Hacer Click para loguearse con cuenta de instagram</a>
            
          </li>
        </ul>
        <!-- GitHub project -->

      </div>
    </div>
  </body>
</html>