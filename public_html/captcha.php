<body>
  <?php
    function generarClaveAleatoria() {
      $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()+=<>?';
      $longitud = 6;
      $clave = '';

      for ($i = 0; $i < $longitud; $i++) {
          $clave .= $caracteres[rand(0, strlen($caracteres) - 1)];
      }

      return $clave;
    }
    
    $input_text = generarClaveAleatoria();
    $width = 80;
    $height = 32;

    $textImage = imagecreatetruecolor($width, $height);
    $color = imagecolorallocate($textImage, 0, 0, 0);
    imagecolortransparent($textImage, $color);

    $blue = imagecolorallocate($textImage, 216, 213, 216 );

    $background = imagecreatetruecolor($width, $height);
    $backgroundColor = imagecolorallocate($background, 65, 66, 64 ); // Color de fondo
    imagefilledrectangle($background, 0, 0, $width, $height, $backgroundColor);

    $font = 'fonts/Arial.otf';
    //imagefilter($textImage, IMG_FILTER_GAUSSIAN_BLUR);
    imagettftext($textImage, 10, 0, 4, 10, $blue, $font, $input_text);

    for ($i = 0; $i < 10; $i++) {
      $green = imagecolorallocatealpha($background, 38, 54, 122, rand(50, 100)); // Color verde
      $circleSize = rand(5, 20);
      $circleX = rand(0, $width);
      $circleY = rand(0, $height);
      imagefilledellipse($background, $circleX, $circleY, $circleSize, $circleSize, $green);

      $lineColor = imagecolorallocatealpha($background, 56, 11, 59 , rand(50, 100)); // Color rojo
      $lineX1 = rand(0, $width);
      $lineY1 = rand(0, $height);
      $lineX2 = rand(0, $width);
      $lineY2 = rand(0, $height);
      imageline($background, $lineX1, $lineY1, $lineX2, $lineY2, $lineColor);
    }
    imagecopymerge($background, $textImage, 10, 10, 0, 0, $width, $height, 100);
    $output = imagecreatetruecolor($width, $height);

    imagecopy($output, $background, 0, 0, 0, 0, $width, $height);

    imagefilter($output, IMG_FILTER_GAUSSIAN_BLUR);
    ob_start();
    imagepng($output);
    //printf('<img id="output" src="data:image/png;base64,%s" />', base64_encode(ob_get_clean()));
  ?>

  <div><?php printf('<img id="output" src="data:image/png;base64,%s" />', base64_encode(ob_get_clean())); ?></div>
</body>