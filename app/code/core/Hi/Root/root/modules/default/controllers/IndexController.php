<?php
/**
 * Default_IndexController
 *
 * @author
 * @version
 */
class IndexController extends HiZend_Controller_Action {

	/**
	 * The default action - show the frameset
	 */
	public function indexAction() {
        $this->view->headTitle('Index');

        $this->view->mainFrameLink          = $this->_baseUrl . '/default/start/';
        $this->view->navigationFrameLink    = $this->_baseUrl . '/navigation/';

        $this->_helper->layout->setLayout('frameset');
	}

}

