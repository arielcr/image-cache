<?php

class CacheTest extends PHPUnit_Framework_TestCase
{
	/**
     * @param string $imageUrl Image url 
     * @param string $expectedResult Expected result
     *
     * @dataProvider providerTestCacheReturnsSavedImage
     */
    public function testCacheReturnsSavedImage($imageUrl, $expectedResult)
    {
        $image = Image\Cache::get($imageUrl);
        $this->assertEquals($expectedResult,$image);
    }

	public function providerTestCacheReturnsSavedImage()
	{
		return array(
            array('http://www.crecetu.com/web/12172807/fotos/test.jpg', 'cache/images/test.jpg'),
            array('', ''),
        );
	}

}

?>
