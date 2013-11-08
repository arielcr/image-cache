<?php

namespace Image;

class Cache{

    // Cache directory
    private static $image_path = 'cache/images/';

    public static function get($image_url, $width = NULL)
    {
		$cached_image = '';
		
		if(!empty($image_url)){
		
			// Get file name
			$exploded_image_url = explode("/", $image_url);
			$image_filename = end($exploded_image_url);
			$exploded_image_filename = explode(".", $image_filename);
			$extension = end($exploded_image_filename);

			// Image validation
			if (strtolower($extension) == "gif" || strtolower($extension) == "jpg" || strtolower($extension) == "png") {

				$cached_image = self::$image_path . $image_filename;

				// Check if image exists
				if (file_exists($cached_image)) {
					return $cached_image;
				} else {

					// Get remote image
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $image_url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$image_to_fetch = curl_exec($ch);
					curl_close($ch);

					// Save image
					$local_image_file = fopen($cached_image, 'w+');
					chmod($cached_image, 0755);
					fwrite($local_image_file, $image_to_fetch);
					fclose($local_image_file);

					// Resize image
					if(!is_null($width)){
						$image = new SimpleImage(); 	
						$image->load($cached_image); 
						$image->resizeToWidth($width); 
						$image->save($cached_image);
					}

				}

			}	

		}
		
		return $cached_image;

    }

}