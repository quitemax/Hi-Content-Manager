<?php
class Ecms_HelperController extends HiZend_Controller_Action
{
  function init() {
    parent::init();
    $this->view->headTitle('Ecms');
    $this->view->headTitle('Helper');
  }

  function indexAction() {
    $this->view->headTitle('Index');
    echo "<pre>";
    print_r($this->getRequest()->getParams());
    echo "</pre>";



  }

  function listAction() {
    $this->view->headTitle('List');

    //
    $ecmsHelperListSess = new Zend_Session_Namespace('admin/ecms/helper/list');

    //
    /*@var $menus HiZend_Db_Table*/
    $helpers = new Ecms_Model_EcmsHelper();

    $lg = new Ecms_Model_EcmsLangs();
    $langs = $lg->getLangs();

    /////////
    //POST
    if ($this->getRequest()->isPost()) {
		  //
		  $records = $this->getRequest()->getPost();

//		  echo "<pre>";
//		  print_r($records);
//		  echo "</pre>";


		  //
		  $listActions = isset($records['listActions'])?$records['listActions']:null;
		  unset($records['listActions']);
		  $allBox = $records['header']['all'];
		  unset($records['header']);


		  /////////////////////////////////
		  //list actions
		  if ($listActions) {

  		  ///////////////
  		  //deleteSelected
  		  if (isset($listActions['deleteSelected'])) {
  		    $deleteIds = array();
  		    if ($allBox){
  		        $deleteIds = array_keys($records);
  		    } else {
  		      foreach ($records as $key => $record) {
  		        if ($record['ID']) {
  		          $deleteIds[] = $key;
  		        }
  		      }
  		    }
  		    if ($deleteIds) {
  		      $helpers->delete("eh_id in ( ".implode(', ',$deleteIds)." )");
  		    }
  		  }

  		  ///////////////
  		  //deleteAll
  		  if (isset($listActions['deleteAll'])) {
          $deleteIds = array_keys($records);
  		    $helpers->delete("eh_id in ( ".implode(', ',$deleteIds)." )");
  		  }

  		  ///////////////
  		  //saveSelected
  		  if (isset($listActions['saveSelected']) && $listActions['saveSelected'] != '') {
  		    $saveIds = array();
  		    if ($allBox){
  		      foreach ($records as $key => $record) {
  		        unset($record['ID']);
		          $helpers->updateTranslated($record, $key);
  		      }
  		    } else {
  		      foreach ($records as $key => $record) {
  		        if ($record['ID']) {
  		          unset($record['ID']);
		            $helpers->updateTranslated($record, $key);
  		        }
  		      }
  		    }
  		  }

  		  ///////////////
  		  //saveAll
  		  if (isset($listActions['saveAll'])) {
          $saveIds = array();
          foreach ($records as $key => $record) {
            unset($record['ID']);
		        $helpers->updateTranslated($record, $key );
		      }
  		  }

  		  ///////////////
  		  //add new
  		  if (isset($listActions['add'])) {
		      $this->_redirect('/ecms/helper/add/');
  		  }

  		  ///////////////
  		  //add new
  		  if (isset($listActions['helper'])) {
		      $this->_redirect('/ecms/helper/read/');
  		  }
		  }


  	  /////////////////////////////////
  	  //record actions

  	  foreach ($records as $key => $record) {
  	    ///////////////
  	    //edit
  	    if (isset($record['edit'])) {
  	      $this->_redirect('/ecms/helper/edit/id/'.$key);
  	      break;
  	    }

  	    ///////////////
  	    //delete
  	    if (isset($record['delete'])) {
  	      $helpers->delete("eh_id = $key");
  	      break;
  	    }

  	  }
	  }


    /////////////////////////////////////////////////////////////////////////////
    //ustawienia listy
    //
    //
//	  $sort =  $serviceMenuListSess->sort;
//	  $filter =  $serviceMenuListSess->filter;
//	  unset($bannersSession->filter);
//	  unset($bannersSession->sort);

//    $page = (int)$this->getRequest()->getParam('page');
//		if ($page<1) $page = 1;

	  $helperList = new Hi_Record_List($helpers , $this->view, 'Pomocnik - Lista');
	  $helperList->setLangs($langs);
//    $serviceMenuList->onlyShowLang('pl');
	  //
//	  $adminMenuList->setSort($sort);
//    $adminMenuList->setFilter($filter);
//    $adminMenuList->setPage($page);
    //
    $helperList->setFormData(array(  'id' => 'helperList',
                                        'action' => '',
                                        'method'=>'post'));
    $helperList->setPartialsDir('record/list/');

    //
    $helperList->setColumnTitle('eh_id', 'ID');
    $helperList->setColumnTitle('eh_description', 'Opis');
    $helperList->setColumnTitle('eh_title', 'Tytuł');
    $helperList->setColumnTitle('eh_active', 'Aktywny');
    $helperList->setActionsTitle('Akcje');

    $helperList->removeColumn('eh_description');

    //
    $helperList->addRecordAction('Edytuj','edit', array('class'=>'przycisk'));
	  $helperList->addRecordAction('Usuń','delete', array('class'=>'przyciskRed'));

	  //
    $helperList->addListAction('Pomocnik','helper', array('class'=>'przyciskSeparator'));

    //
    $helperList->addListAction('Dodaj nowy','add', array('class'=>'przyciskSeparator'), 1);

    //

    $helperList->addListAction('Zapisz wybrane','saveSelected', array('class'=>'przycisk'));
    $helperList->addListAction('Zapisz wszystkie','saveAll', array('class'=>'przyciskSeparator'));

    $helperList->addListAction('Usuń wybrane','deleteSelected',  array('class'=>'przyciskRed'));
	  $helperList->addListAction('Usuń wszystkie','deleteAll',  array('class'=>'przyciskRed'));
    //
	  $this->view->helperList = $helperList->render();



  }




  public function addAction()
  {
    $this->view->headTitle('Add');

    ///////////////////
    //init
    $ecmsHelperAddSess = new Zend_Session_Namespace('admin/ecms/helper/add');

    //
    /*@var $menus HiZend_Db_Table*/
    $helpers = new Ecms_Model_EcmsHelper();

    $lg = new Ecms_Model_EcmsLangs();
    $langs = $lg->getLangs();

    if ($record = $this->getRequest()->getPost()) {
//      echo "<pre>";
//		  print_r($record);
//		  echo "</pre>";


      $formId = $record['header']['formId'];
      unset($record['header']);
      $action = $record['actions'];
      unset($record['actions']);

		  /////////////////////////////////
  	  //main element edit actions
  	  /////////////////////////////////
      if ($formId == 'helperAdd') {
        ////////////////
  	    // Dodaj
  	    if (isset($action['add'])) {
          $id = $helpers->insertTranslated($record['Row']);
          $this->_redirect('/ecms/helper/edit/id/'.$id);
  	    }

  	    ////////////////
  	    // Anuluj
  	    if (isset($action['cancel'])) {
          $this->_redirect('/ecms/helper/list/');
  	    }
  	  }
  	}

		///////////////////
	  //menu edit
	  $helperAdd = new Hi_Record_Item($helpers, $this->view, 'Dodaj Pomoc');
	  $helperAdd->setLangs($langs);
	  $helperAdd->setPartialsDir('record/item/');
    $helperAdd->setFormData(array(  'id' => 'helperAdd',
                                        'action' => '',
                                        'method'=>'post'));

	  $helperAdd->setColumnTitle('eh_id', 'ID');
    $helperAdd->setColumnTitle('eh_sys_name', 'Nazwa systemowa');
    $helperAdd->setColumnTitle('eh_title', 'Tytuł');
    $helperAdd->setColumnTitle('eh_description', 'Opis');
    $helperAdd->setColumnTitle('eh_active', 'Aktywny');
    $helperAdd->setActionsTitle('Akcje');

    //
    $this->view->headScript()->appendFile($this->_publicPath.'admin/js/tiny_mce/tiny_mce.js', 'text/javascript');
    $this->view->headScript()->appendScript($this->view->render('js/tiny_init.js'), 'text/javascript');
    $helperAdd ->setAttribs('eh_description', array('class'=>'tiny_full'));

    $helperAdd->addAction('Dodaj','add', array('class'=>'przyciskSeparator'));
    $helperAdd->addAction('Anuluj','cancel', array('class'=>'przycisk'));


    $this->view->helperAdd = $helperAdd->render();
  }






  public function editAction()
	{
	  $this->view->headTitle('Edit');

    ///////////////////
	  //PARAMS
	  if (!($id = (int)$this->_request->getParam('id'))) {
			$this->_redirect('/ecms/helper/list/');
		}


    ///////////////////
    //init
    $ecmsHelperEditSess = new Zend_Session_Namespace('admin/ecms/helper/edit');

    //
    /*@var $menus HiZend_Db_Table*/
    $helpers = new Ecms_Model_EcmsHelper();

    $lg = new Ecms_Model_EcmsLangs();
    $langs = $lg->getLangs();


    if ($record = $this->getRequest()->getPost()) {
//      echo "<pre>";
//      print_r($record);
//      echo "</pre>";

      $formId = $record['header']['formId'];
      unset($record['header']);
      $action = $record['actions'];
      unset($record['actions']);


		  /////////////////////////////////
  	  //main element edit actions
  	  /////////////////////////////////
      if ($formId == 'helperEdit') {

        ////////////////
  	    // Edycja
  	    if (isset($action['edit'])) {
  	      $id = $record['Row']['eh_id'];
  	      unset($record['Row']['eh_id']);
          $helpers->updateTranslated($record['Row'], $id);
          $this->_redirect('/ecms/helper/edit/id/'.$id);
  	    }

  	    ////////////////
  	    // Usuwanie
  	    if (isset($action['delete'])) {
          $id = $record['Row']['eh_id'];
          $helpers->delete("eh_id = $id");
          $this->_redirect('/ecms/helper/list/');
  	    }

  	    ////////////////
  	    // Anuluj
  	    if (isset($action['cancel'])) {
          $this->_redirect('/ecms/helper/list/');
  	    }
      }
    }


	  ///////////////////
	  //helper edit
	  //
	  $helperEdit = new Hi_Record_Item($helpers, $this->view, 'Pomocnik - Edytuj');
	  $helperEdit->setLangs($langs);
	  $helperEdit->setPartialsDir('record/item/');
    $helperEdit->setFormData(array(  'id' => 'helperEdit',
                                        'action' => '',
                                        'method'=>'post'));

	  $helperEdit->setColumnTitle('eh_id', 'ID');
    $helperEdit->setColumnTitle('eh_title', 'Tytuł');
    $helperEdit->setColumnTitle('eh_description', 'Opis');
    $helperEdit->setColumnTitle('eh_active', 'Aktywny');
    $helperEdit->setActionsTitle('Akcje');

    //
    $this->view->headScript()->appendFile($this->_publicPath.'admin/js/tiny_mce/tiny_mce.js', 'text/javascript');
    $this->view->headScript()->appendScript($this->view->render('js/tiny_init.js'), 'text/javascript');
    $helperEdit ->setAttribs('eh_description', array('class'=>'tiny_full'));

    $helperEdit->addAction('Zapisz','edit', array('class'=>'przycisk'));

	  $helperEdit->addAction('Anuluj','cancel', array('class'=>'przyciskSeparator'));

	  $helperEdit->addAction('Usuń','delete', array('class'=>'przyciskRed'));

	  $helperEdit->setId($id);

    $this->view->helperEdit = $helperEdit->render();
	}

	public function readAction() {
	  $this->view->headTitle('Read');

    ///////////////////
    //init
    $ecmsHelperEditSess = new Zend_Session_Namespace('admin/ecms/helper/edit');

    //
    /*@var $menus HiZend_Db_Table*/
    $helpers = new Ecms_Model_EcmsHelper();

    $lg = new Ecms_Model_EcmsLangs();
    $langs = $lg->getLangs();
    $lang = 'pl';

    $this->view->helpersList = $helpers->getAll(null, null, null, null, $lang);


	}


}
