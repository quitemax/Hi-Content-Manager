<?php
/**
 * Hi CMS
 *
 * @category   HiBase
 * @package    HiBase_Db
 * @copyright  Copyright (c) 2012 Piotr Maxymilian Socha
 * @license
 */

namespace HiBase\Db\Behaviour;


use HiBase\Db\Behaviour\Behaviour;

/**
 *
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @subpackage Table
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class ImageArray extends Behaviour
{
    protected $_imageColumn;
    protected $_imagePath;
//    protected $_level;
//    protected $_order;
//    protected $_parentId;
//    protected $_rootId;
//    protected $_basePrimaryKey;
//    protected $_titleColumn;

//    /**#@+
//     * List id template
//     */
//    const INFO_PLACEMENT_APPEND = 1;
//    /**#@-*/
//
//    /**#@+
//     * List id template
//     */
//    const INFO_PLACEMENT_PREPEND = 2;
//    /**#@-*/


    /**
     *
     *
     * @return void
     */
    public function __construct($dbTable = null, $config = array())
    {
        parent::__construct($dbTable, $config);

        foreach ($config as $optionName => $option) {
            switch($optionName) {
                case 'image':
                    $this->_imageColumn = $option;
                    break;
                case 'path':
                    $this->_imagePath = $option;
                    break;
                default:
                    break;
            }
        }
    }

    /**
     *
     *
     * @return array
     */
    public function beforeSave($row = null)
    {
        //
        parent::beforeSave($row);


//         \Zend\Debug::dump($_POST, '$$$_POST');
//        if (isset($_POST['delete'][$this->_imageColumn]) && (int)$_POST['delete'][$this->_imageColumn] == 1) {
//            $deleteImg = $row->getOriginalData($this->_imageColumn);
//
//            if ($deleteImg) {
////                \Zend\Debug::dump($deleteImg, '$$deleteImg');
////                \Zend\Debug::dump($row->getOriginalData());
//                $filename = MEDIA_PATH . str_replace(MEDIA_URL, '', $deleteImg);
////                \Zend\Debug::dump($filename, '$filename');
//                if (is_file($filename)) {
//                    unlink($filename);
//                    $row[$this->_imageColumn] = '';
//                }
//            }
//        }

        //
//        \Zend\Debug::dump($_FILES, '$_FILES');
//        if (is_array($_FILES) && count ($_FILES)) {
//            if (isset($_FILES[$this->_imageColumn]) && isset($_FILES[$this->_imageColumn]['name'])
//                && trim($_FILES[$this->_imageColumn]['name']) != '' ) {
//
//                //
//                $data = $_FILES[$this->_imageColumn];
//
//
//
//
//                $uploaddir = MEDIA_PATH . $this->_imagePath;
//                $uploadurl = MEDIA_URL . $this->_imagePath;
//
//                if (!is_dir($uploaddir)) {
//                    mkdir($uploaddir, 0777, true);
//                }
//
//                $timestamp = md5(microtime());
//                $uploadfile = $uploaddir . '/' . $timestamp . '_' .  basename($data['name']);
//                $uploadurl = $uploadurl . '/' . $timestamp . '_' .  basename($data['name']);
//
////                \Zend\Debug::dump($uploaddir);
////                \Zend\Debug::dump($uploadurl);
////                \Zend\Debug::dump($uploadfile);
//
//                if (move_uploaded_file($data['tmp_name'], $uploadfile)) {
//
//                    //
//                    $deleteImg = $row->getOriginalData($this->_imageColumn);
//                    if ($deleteImg) {
//    //                    \Zend\Debug::dump($deleteImg, '$deleteImg');
//                        //
//                        $filename = MEDIA_PATH . str_replace(MEDIA_URL, '', $deleteImg);
//    //                    \Zend\Debug::dump($filename, '$filename');
//                        if (is_file($filename)) {
//                            unlink($filename);
//                        }
//                    }
//
//                    unset($_FILES[$this->_imageColumn]);
//                    $row[$this->_imageColumn] = $uploadurl;
//                }
//            }
//        }

        return $row;
    }

//    /**
//     *
//     *
//     * @return void
//     */
//    public function setLang($lang = 'pl')
//    {
//        $this->_lang = $lang;
//    }
//
//    /**
//     *
//     *
//     * @return void
//     */
//    public function getLang()
//    {
//        return $this->_lang;
//    }
//
//    /**
//     *
//     *
//     * @return void
//     */
//    public function setLangs($langs = null)
//    {
//        if (is_array($langs)) {
//            $this->_langs = $langs;
//        }
//    }
//
//    /**
//     *
//     *
//     * @return void
//     */
//    public function getLangs()
//    {
//        return $this->_langs;
//    }

}