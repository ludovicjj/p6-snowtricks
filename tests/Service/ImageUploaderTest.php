<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ImageUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploaderTest extends TestCase
{
    /**
     * @var string
     */
    private $imageDirectory;

    /**
     * @var string
     */
    private $imageUploadPath;

    /**
     * @var ImageUploader
     */
    private $imageUploader;

    protected function setUp()
    {
        $this->imageDirectory = 'App/public/uploads/images';
        $this->imageUploadPath = '/uploads/images';
        $this->imageUploader = new ImageUploader($this->imageDirectory, $this->imageUploadPath);
    }

    public function testInstanceOfAndMethodExist()
    {
        static::assertInstanceOf(ImageUploader::class, $this->imageUploader);
        static::assertTrue(method_exists($this->imageUploader, 'getImageInfo'));
    }

    /**
     * @param string $filename
     * @param string $extension
     * @dataProvider provideValues
     */
    public function testGetImageInfo(string $filename, string $extension)
    {
        $fileMock = $this->createMock(UploadedFile::class);
        $fileMock->method('getFilename')->willReturn($filename);
        $fileMock->method('guessExtension')->willReturn($extension);
        $fileMock->method('getClientOriginalName')->willReturn($filename.''.$extension);

        $newFileName = $this->imageUploader->getImageInfo($fileMock);
        static::assertNotNull($newFileName);
        static::assertInternalType('array', $newFileName);
        static::assertInternalType('string', $newFileName['filename']);
        static::assertInternalType('string', $newFileName['path']);
        static::assertInternalType('string', $newFileName['alt']);
    }

    public function provideValues()
    {
        yield array('image1', 'jpg');
        yield array('image2', 'png');
        yield array('image3', 'jpeg');
    }
}