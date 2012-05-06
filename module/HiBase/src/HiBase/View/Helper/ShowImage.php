<?php
namespace HiBase\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ShowImage extends AbstractHelper
{
//    protected $count = 0;

    public function __invoke($imagePath = '')
    {
//        $this->count++;
//        $output = sprintf("I have seen 'The Jerk' %d time(s).", $this->count);
        return htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8');
    }
}