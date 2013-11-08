<?php

class CacheTest extends PHPUnit_Framework_TestCase
{
    public function testCacheReturnsSavedImage()
    {
		// Test Cache Class
        $expected = 'cache/images/test.jpg';
        $image = \Image\Cache::get('http://www.crecetu.com/web/12172807/fotos/test.jpg');

        $this->assertEquals($expected,$image);

    }

}

?>
