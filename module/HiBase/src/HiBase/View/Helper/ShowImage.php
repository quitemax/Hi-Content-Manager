<?php
namespace HiBase\View\Helper;

use Zend\View\Helper\AbstractHelper;

require_once 'ThumbLib/ThumbLib.inc.php';

use PhpThumbFactory;

class ShowImage extends AbstractHelper
{
    //
    protected $_imgTemplate = '<img alt="%s" src="%s" width="" height=""/>';

    //
    protected $_widthDefault = 100;

    //
    protected $_heightDefault = 100;

    //
    const CACHE_PATH = '/images/hi-cache';


    /**
     *
     *
     * @param string $imagePath
     * @param array $options
     */
    public function __invoke($imagePath = '', $options = array())
    {
//        \Zend\Debug::dump($options, '$$options');
//        \Zend\Debug::dump($imagePath, '$$imagePath');
        //
        $str = '<!-- no image ' . $imagePath .'-->';

        //
        $alt = $imagePath;

        if (!empty($options['alt']) && trim($options['alt']) != '' ) {
            $alt = $options['alt'];
        }

        //
        $width = $this->_widthDefault;

        if (!empty($options['width']) && $options['width'] > 0 ) {
            $width = $options['width'];
        }

        //
        $height = $this->_heightDefault;

        if (!empty($options['height']) && $options['height'] > 0 ) {
            $height = $options['height'];
        }

        //
        if (strpos($imagePath, 'http') === false) {
            $filePath = MEDIA_PATH . str_replace(MEDIA_URL, '', $imagePath);
            $fileUrl = $this->view->basePath() . $imagePath;
        }
//        \Zend\Debug::dump($filePath, '$filePath');
//        \Zend\Debug::dump($fileUrl, '$$fileUrl');

        if (!file_exists($filePath) || is_dir($filePath)) {
            return $str;
        }

        //
        $pathParts = pathinfo($filePath);
//        \Zend\Debug::dump($pathParts, '$pathParts');

        $cachePath = PUBLIC_PATH . self::CACHE_PATH;
        $cacheUrl = $this->view->basePath() . self::CACHE_PATH;

        if (isset($options['cache']['dir']) && trim($options['cache']['dir']) != '') {
            $cachePath .= trim($options['cache']['dir']);
            $cacheUrl .= trim($options['cache']['dir']);
        }

//        \Zend\Debug::dump($cachePath, '$cachePath');
//        \Zend\Debug::dump($cacheUrl, '$cacheUrl');

        //
        if (!is_dir($cachePath)) {
            mkdir($cachePath, 0777, true);
        }

        //
        $cacheFilename = $pathParts['filename']
        . '_'
        . $width
        . '_'
        . $height
        . '_'
        . filesize($filePath)
        . '_'
        . filemtime($filePath)
        . (isset($pathParts['extension']) ? '.' . $pathParts['extension']: '');

        //
        $cacheFilePath = $cachePath
        . '/'
        . $cacheFilename;

        //
        $cacheFileUrl = $cacheUrl
        . '/'
        . $cacheFilename;

//        \Zend\Debug::dump($cacheFilePath, '$$cacheFilePath');
//        \Zend\Debug::dump(is_file($cacheFilePath), 'is_file($cacheFilePath)');


        if (file_exists($cacheFilePath)) {
            return vsprintf($this->_imgTemplate, array($alt, $cacheFileUrl));
        } else {
            try
            {
                $thumb = \PhpThumbFactory::create($filePath);
                $thumb->resize($width, $height);
                $thumb->save($cacheFilePath);
                return vsprintf($this->_imgTemplate, array($alt, $cacheFilePath));
            }
            catch (Exception $e)
            {
                 return vsprintf($this->_imgTemplate, array($alt, $fileUrl));
            }
        }

        return $str;
    }
}