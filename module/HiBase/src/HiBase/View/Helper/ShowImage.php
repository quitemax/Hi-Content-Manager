<?php
namespace HiBase\View\Helper;

use Zend\View\Helper\AbstractHelper;

require_once 'ThumbLib/ThumbLib.inc.php';
require_once 'One.php';

use PhpThumbFactory;

class ShowImage extends AbstractHelper
{
//    protected $count = 0;

    const CACHE_PATH = '/';

    public function __invoke($imagePath = '')
    {

        try
        {
            $one = \One::oneone();;
            \Zend\Debug::dump(\One::oneone());
            $new = new \PhpThumbFactory();
             $thumb = \PhpThumbFactory::create('http://assets.bodybuilding.com/images/trackers/exercise/heatmap/7.gif');
        }
        catch (Exception $e)
        {
             // handle error here however you'd like
//             \Zend\Debug::dump($e->getMessage());
        }
//        $this->count++;
//        $output = sprintf("I have seen 'The Jerk' %d time(s).", $this->count);
        return htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8');
    }
}