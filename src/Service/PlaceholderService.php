<?php

namespace App\Service;

class PlaceholderService
{
    public function create($width = 100, $height = 100, $color = ['r'=> 207, 'g' => 207, 'b' => 207])
    {
        $image =  imagecreate( $width, $height);

        imagecolorallocate( $image, $color['r'],$color['g'],$color['b']);

        imagestring( $image, 7, 10, 10, $width  . ' x ' . $height, imagecolorallocate( $image, 0, 0, 0 ) );

        ob_start();
        imagepng($image);
        $stringdata = ob_get_contents(); // read from buffer
        ob_end_clean(); // delete buffer

        return $stringdata;
    }
}