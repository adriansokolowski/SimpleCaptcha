<?php

namespace libs\Captcha;

class Captcha
{

    public function get($length)
    {
        $text = '123456789ABCDEF';
        $text = substr(str_shuffle($text), 0, $length);
        $_SESSION['captcha'] = $text;
        $image = imagecreatefromjpeg(dirname(__FILE__) . '/captcha/captcha.jpg');
        if(rand(1, 2) == 2) $image = imagerotate($image, 180, 0);
        for ($i = 0; $i < rand(0, 5); $i++) {
            imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
        }
        $foreground = imagecolorallocate($image, 0, 0, 0);
        imagestring($image, 5, rand(20, 70), rand(5, 20), $text, $foreground);
        header('Content-type: image/png');
        imagepng($image);
    }

}