<?php
    $user_input = $_GET['userInput']; // get user input from img src
    $image_width = 200;
    $image_height = 50;

    // create image
    $img = imagecreatetruecolor($image_width, $image_height);
    
    // background, text, line, and pixel colors
    $bg_color = imagecolorallocate($img, 174, 215, 90); // green
    $text_color = imagecolorallocate($img, 107, 60, 201); // purple
    $line_color = imagecolorallocate($img, 255,105,180); // pink
    $pixel_color = imagecolorallocate($img, 77, 77, 77); // deep gray
    
    // fill the background
    imagefilledrectangle($img, 0, 0, $image_width, $image_height, $bg_color);

    // draw 5 to 10 random lines
    for ($line = 0; $line < rand(5,10); $line++) {
        imageline($img, 0, rand() % $image_height, $image_width, rand() % $image_height, $line_color);
    }

    // draw 50 to 100 random dots
    for ($pixel = 0; $pixel < rand(50,100); $pixel++) {
        imagesetpixel($img, rand() % $image_width, rand() % $image_height, $pixel_color);
    }
    
    $rand_angle = rand(0,20); // angle of rotation ranging from 0 to 20
    $angle = 0; // angle of rotation
    $x_axis = 0; // x-axis

    // draw user input
    for ($text = 0; $text < strlen($user_input); $text++) {
        
        imagettftext($img, 25, $rand_angle + $angle, 24 + $x_axis, $image_height - 14, $text_color, './fonts/Courier New Bold.ttf', $user_input[$text]);
        
        $angle += 10;
        $x_axis += 35;
    }
    
    // output image as a PNG via header
    header("Content-type: image/png");
    imagepng($img);
    
    // free any memory associated with image
    imagedestroy($img);
?>

