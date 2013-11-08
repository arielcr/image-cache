#Image Cache Class
[![Build Status](https://travis-ci.org/arielcr/image-cache.png)](https://travis-ci.org/arielcr/image-cache)

##Introduction
Simple class to save external images to a cache folder. It also has the ability to resize proportionally to a width. 

##Installation
#### Composer

This class is PSR-0 compliant and can be installed using [composer](http://getcomposer.org/).  Simply add `arielcr/image-cache` to your composer.json file.  _Composer is the sane alternative to PEAR.  It is excellent for managing dependancies in larger projects_.

    {
        "require": {
            "arielcr/image-cache": "dev-master"
        }
    }
    
##Usage
Usage is pretty straightforward. Simply call the function on the image src you want to cache. 

	<img src="<?php echo Image\Cache::get($image_url, $width); ?>"  >
	
Cached images will be on the `/cache/images/` folder.
	
