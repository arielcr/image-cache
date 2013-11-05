<?php

namespace Imagecache;

class Image{

    // Cache directory
    private static $image_path = 'cache/images/';

    public static function cache($image_url)
    {
        // Get file name
        $exploded_image_url = explode("/", $image_url);
        $image_filename = end($exploded_image_url);
        $exploded_image_filename = explode(".", $image_filename);
        $extension = end($exploded_image_filename);

        // Image validation
        if (strtolower($extension) == "gif" || strtolower($extension) == "jpg" || strtolower($extension) == "png") {

            // Get remote image
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $image_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $image_to_fetch = curl_exec($ch);
            curl_close($ch);

			// Check if image exists
			if (file_exists(self::$image_path . $image_filename)) {
				return "YA EXISTE! : " . self::$image_path . $image_filename;
			} else {
				// Save image
	            $local_image_file = fopen(self::$image_path . $image_filename, 'w+');
	            chmod(self::$image_path . $image_filename, 0755);
	            fwrite($local_image_file, $image_to_fetch);
	            fclose($local_image_file);
	
				$image = new SimpleImage(); 	
				$image->load(self::$image_path . $image_filename); 
				$image->resizeToWidth(172); 
				$image->save(self::$image_path . $image_filename); 
	
			}

        }

        return "NO EXISTE, GUARDADA: " . self::$image_path . $image_filename;
    }

}