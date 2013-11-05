<?php

namespace Arielcr;

class Image{

    // Cache directory
    private static $image_path = 'cache/images/';

    public static function cache($image_url)
    {

        //get the name of the file
        $exploded_image_url = explode("/", $image_url);
        $image_filename = end($exploded_image_url);
        $exploded_image_filename = explode(".", $image_filename);
        $extension = end($exploded_image_filename);


        //make sure its an image
        if (strtolower($extension) == "gif" || strtolower($extension) == "jpg" || strtolower($extension) == "png") {

            //get the remote image
            //$image_to_fetch = file_get_contents($image_url);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $image_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $image_to_fetch = curl_exec($ch);
            curl_close($ch);

            //save it
            $local_image_file = fopen(self::$image_path . $image_filename, 'w+');
            chmod(self::$image_path . $image_filename, 0755);
            fwrite($local_image_file, $image_to_fetch);
            fclose($local_image_file);

        }


        return self::$image_path . $image_filename;
    }

}