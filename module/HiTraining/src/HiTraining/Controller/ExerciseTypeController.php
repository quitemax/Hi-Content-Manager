<?php

namespace HiTraining\Controller;

use Zend\Mvc\Controller\ActionController,
    HiTraining\Model\ExerciseType,
//    Exercises\Model\DbTable\WorkoutExercise,
//    Exercises\Model\DbTable\WorkoutExerciseType,
    HiTraining\Form\ExerciseType\Grid as TypeGrid,
    HiTraining\Form\ExerciseType\Row as TypeRow,
    HiTraining\Form\ExerciseType\Tree as TypeTree,
    Zend\Dom\Query,
    Zend\View\Model\JsonModel;


class ExerciseTypeController extends ActionController
{

    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    protected $_view;

    public function setView($view)
    {
        $this->_view = $view;
    }


    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    protected $_type;

    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    protected $_exercise;

    public function setExercise($exercise)
    {
        $this->_exercise = $exercise;
        return $this;
    }

    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    public function indexAction()
    {
        return array();
    }

    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    public function statsAction()
    {
        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('type_id', 0);


         $typeTree = new TypeTree(
                array(
                    'title'     => 'exerciseTypeTree',
                    'name'      => 'etT', //editNavigationItemElementRow
//                    'langs'     => $hicmsLangsDbTable->getLangs(),
                    'model'     => $this->_type,
                    'view'      => $this->_view,
                )
        );


        $typeTree->setSelectedId($id);
//            $itemElementsTree->setPositionVisible(true);
        $typeTree->setCookiePath(
            $this->url()->fromRoute('hi-training/exercise-type/stats')
            . '/' . 'type_id' . '/'     //. '/' . self::URL_EDIT . self::PARAM_ITEM_ID . '/' . $id . '/'
        );
        $typeTree->setGlobalLink(
            $this->url()->fromRoute('hi-training/exercise-type/stats')
            . '/' . 'type_id' . '/'    //. self::URL_EDIT . self::PARAM_ITEM_ID . '/' . $id . '/' . self::PARAM_ELEMENT_ID . '/'
        );

        $type = $this->_type->getRow(array('type_id' => $id));

        $exercises = $this->_exercise->getExercises(
            array(
                'workout_exercise.type_id' => $id
            ),
            array(
                '`workout`.`date` asc'
            )
        );

        return array(
            'tree'        => $typeTree->build(),
            'type'        => $type,
            'exercises'   => $exercises,
        );
    }

    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    public function ajaxFormTypeAction()
    {
        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('type_id', 0);

        $row = $this->_type->getRow(array('type_id' => $id))->toArray();

        return new JsonModel(array(
            'type' => $row['form_type'],
        ));


    }


    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    public function editTreeAction()
    {

        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('type_id', 0);


        $typeTree = new TypeTree(
                array(
                    'title'     => 'exerciseTypeTree',
                    'name'      => 'etT', //editNavigationItemElementRow
//                    'langs'     => $hicmsLangsDbTable->getLangs(),
                    'model'     => $this->_type,
                    'view'      => $this->_view,
                )
        );


        $typeTree->setSelectedId($id);
//            $itemElementsTree->setPositionVisible(true);
        $typeTree->setCookiePath(
            $this->url()->fromRoute('hi-training/exercise-type/edit-tree')
            . '/' . 'type_id' . '/'     //. '/' . self::URL_EDIT . self::PARAM_ITEM_ID . '/' . $id . '/'
        );
        $typeTree->setGlobalLink(
            $this->url()->fromRoute('hi-training/exercise-type/edit-tree')
            . '/' . 'type_id' . '/'    //. self::URL_EDIT . self::PARAM_ITEM_ID . '/' . $id . '/' . self::PARAM_ELEMENT_ID . '/'
        );

//            $itemElementsTree->setData($itemElementsTreeData);

        /**
         * Grid FORM
         */
        $form = new TypeGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING Row
         */
        $row = new TypeRow(
            array(
                'model' => $this->_type,
                'view' => $this->_view,
            )
        );

        //
        $types = $this->_type->getBehaviour('nestedSet')->getResultSetForSelect();
//        $checkupsValues = array();
//        foreach ($checkups as $checkup) {
//            $checkupsValues[$checkup['checkup_id']] = $checkup['date'] . ' ' . date('l', strtotime($checkup['date']) );
//        }



        $row->setFieldType('tree_parent_id', 'select');
        $row->setFieldOptions(
            'tree_parent_id',
            array(
                'values' => $types,
            )
        );

        if ($id > 0) {
            $row->setRowId($id);

            $row->addField(
                'descend_form_type',
                'checkbox',
                array(
                    'label'     => 'descend_form_type',
                )
            );

            $row->addAction(
                'add',
                'submit',
                array(
                    'label'     => 'add',
                    'class'     => 'actionImage',
    //                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
                )
            );

            $row->addAction(
                'delete',
                'submit',
                array(
                    'label'     => 'delete',
                    'class'     => 'actionImage',
    //                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
                )
            );
        }


        //
        $row->build();

        //
        $form->addSubForm($row, $row->getName());


        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();


            if ($form->isValid($formData)) {
                if (    isset($formData['header']['formId'])
                        && $formData['header']['formId'] == 'ExerciseTypeGridForm') {

                    if (isset($formData['ExerciseTypeRow']['actions']['save'])) {

                        if (is_array($formData['ExerciseTypeRow']['row'])){
//                            \Zend\Debug::dump($formData);

                            if ($id > 0) {
                                $row = $this->_type->getRow(array('type_id' => $id));
                            } else {
                                $row = $this->_type->createRow();
                            }

                            //
                            $formDescend = isset($formData['ExerciseTypeRow']['row']['descend_form_type']) ? $formData['ExerciseTypeRow']['row']['descend_form_type'] : 0;
                            unset($formData['ExerciseTypeRow']['row']['descend_form_type']);

                            //
                            $row->populateCurrentData($formData['ExerciseTypeRow']['row']);

                            $row->save();

                            $this->_type->getBehaviour('nestedSet')->rebuildNestedSetFromAdjacencyModel();

//                            \Zend\Debug::dump($row->toArray());

                            //
                            if ($id > 0 && $formDescend) {

                                $refreshedRow = $this->_type->getRow(array('type_id' => $id));

                                $editResultSet = $this->_type->getResultSet(array('tree_parent_id' => $id));
                                foreach ($editResultSet as $editRow) {
                                    $editRow->populateCurrentData(
                                        array(
                                            'form_type' => $formData['ExerciseTypeRow']['row']['form_type'],
                                        )
                                    )->save();
                                }
//                                \Zend\Debug::dump($editResultSet->toArray());
                            }

                            $wildcard = array();
                            if ($id > 0) {
                                $wildcard = array('type_id' =>  $id);
                            } else {
                                $wildcard = array('type_id' =>  $row->getId());
                            }

                            return $this->redirect()->toRoute('hi-training/exercise-type/edit-tree/wildcard', $wildcard);



                        }
                    }

                    if (isset($formData['ExerciseTypeRow']['actions']['add'])) {

                        return $this->redirect()->toRoute('hi-training/exercise-type/edit-tree');
                    }

                    if (isset($formData['ExerciseTypeRow']['actions']['delete'])) {

                        if ($id > 0) {
                            $editRow = $this->_type->getRow(array('type_id' => $id));
                            $editRow->delete();
                            $this->_type->getBehaviour('nestedSet')->rebuildNestedSetFromAdjacencyModel();
                        }
                        return $this->redirect()->toRoute('hi-training/exercise-type/edit-tree');
                    }
                }
            }
        }



        return array(
            'form' => $form,//
            'tree'   => $typeTree->build(),
        );
    }


    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    public function treeAction()
    {

        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('type_id', 0);

        $type = $this->_type->getRow(array('type_id' => $id));


        $typeTree = new TypeTree(
                array(
                    'title'     => 'exerciseTypeTree',
                    'name'      => 'etT', //editNavigationItemElementRow
//                    'langs'     => $hicmsLangsDbTable->getLangs(),
                    'model'     => $this->_type,
                    'view'      => $this->_view,
                )
        );


        $typeTree->setSelectedId($id);
//            $itemElementsTree->setPositionVisible(true);
        $typeTree->setCookiePath(
            $this->url()->fromRoute('hi-training/exercise-type/tree')
            . '/' . 'type_id' . '/'     //. '/' . self::URL_EDIT . self::PARAM_ITEM_ID . '/' . $id . '/'
        );
        $typeTree->setGlobalLink(
            $this->url()->fromRoute('hi-training/exercise-type/tree')
            . '/' . 'type_id' . '/'    //. self::URL_EDIT . self::PARAM_ITEM_ID . '/' . $id . '/' . self::PARAM_ELEMENT_ID . '/'
        );


        return array(
            'type'   => $type,
            'tree'   => $typeTree->build(),
        );
    }









































    public function ripAction()
    {
        session_start();




        /*
         * every record with a link field
         */
//        $_SESSION['link'] = null;
//        if (empty($_SESSION['link'])) {
//            $_SESSION['position'] = 10;
//            $_SESSION['link'] = array(
//                'http://www.bodybuilding.com/exercises/detail/view/name/ankle-circles',
//                'http://www.bodybuilding.com/exercises/detail/view/name/anterior-tibialis-smr',
//                'http://www.bodybuilding.com/exercises/detail/view/name/calf-stretch-elbows-against-wall',
//                'http://www.bodybuilding.com/exercises/detail/view/name/calf-stretch-hands-against-wall',
//                'http://www.bodybuilding.com/exercises/detail/view/name/calves-smr',
//                'http://www.bodybuilding.com/exercises/detail/view/name/foot-smr',
//                'http://www.bodybuilding.com/exercises/detail/view/name/knee-circles',
//                'http://www.bodybuilding.com/exercises/detail/view/name/peroneals-stretch',
//                'http://www.bodybuilding.com/exercises/detail/view/name/peroneals-smr',
//                'http://www.bodybuilding.com/exercises/detail/view/name/posterior-tibialis-stretch',
//                'http://www.bodybuilding.com/exercises/detail/view/name/seated-calf-stretch',
//                'http://www.bodybuilding.com/exercises/detail/view/name/standing-gastrocnemius-calf-stretch',
//                'http://www.bodybuilding.com/exercises/detail/view/name/standing-soleus-and-achilles-stretch',
////                '',
////                '',
////                '',
////                '',
//            );
//        }

//        foreach ($_SESSION['link'] as $key => $link) {
//            unset($_SESSION['link'][$key]);
//
//            $rip = $this->_type->createRow();
//            $rip['tree_parent_id'] = 856;//856, 857
//            $rip['link'] = $link;
//            $rip['tree_order'] = $_SESSION['position'];
//            $_SESSION['position'] += 10;
//
//
//            $html = file_get_contents($link);
//            \Zend\Debug::dump($rip);
//
//            $query = new Query($html);//
//    //        $document = $query->getDocument();//
//
//            //NAME
//            $nodelist = $query->execute('div#exerciseDetails h1');
//
//            foreach ($nodelist as $key => $node) {
//                $rip['name'] = trim($node->nodeValue);
//    //            \Zend\Debug::dump($key);
//                \Zend\Debug::dump(trim($node->nodeValue));
//            }
//
//            //MECHANICS
//            $nodelist = $query->execute('div#exerciseDetails p a');
//
//
////            $info = array(
////                '0' => 'type',
////                '1' => 'main muscle',
////                '2' => 'equipment',
////                '3' => 'mechanics',
////                '4' => 'level',
////                '5' => 'sport',
////                '6' => 'force',
////            );
//
//            $rip['mechanics_type'] = DbTable::MECHANICS_TYPE_NA;
//            $rip['force_type'] = DbTable::FORCE_TYPE_NA;
//            foreach ($nodelist as $key => $node) {
////                switch($key) {
////                    case 2:
////                        \Zend\Debug::dump(trim($node->nodeValue), '\Zend\Debug::dump(trim($node->nodeValue));');
////                        \Zend\Debug::dump(stripos($node->nodeValue, 'isolation') !==  false, 'stripos($node->nodeValue, \'isolation\')');
//                        if (stripos($node->nodeValue, 'bands') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_BANDS;
//                        }
//                        if (stripos($node->nodeValue, 'barbell') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_BARBELL;
//                        }
//                        if (stripos($node->nodeValue, 'body only') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_BODYONLY;
//                        }
//                        if (stripos($node->nodeValue, 'cable') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_CABLE;
//                        }
//                        if (stripos($node->nodeValue, 'dumbbell') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_DUMBBELL;
//                        }
//                        if (stripos($node->nodeValue, 'curl bar') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_EZCURLBAR;
//                        }
//                        if (stripos($node->nodeValue, 'exercise ball') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_EXERCISEBALL;
//                        }
//                        if (stripos($node->nodeValue, 'foam roll') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_FOAMROLL;
//                        }
//                        if (stripos($node->nodeValue, 'kettlebells') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_KETTLEBELLS;
//                        }
//                        if (stripos($node->nodeValue, 'machine') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_MACHINE;
//                        }
//                        if (stripos($node->nodeValue, 'medicine ball') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_MEDICINEBALL;
//                        }
//                        if (stripos($node->nodeValue, 'none') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_NONE;
//                        }
//                        if (stripos($node->nodeValue, 'other') !== false) {
//                            $rip['equipment'] = DbTable::EQUIPMENT_TYPE_OTHER;
//                        }
//
////                        break;
////                    case 3:
//
//
//                        if (stripos($node->nodeValue, 'isolation') !== false) {
//                            $rip['mechanics_type'] = DbTable::MECHANICS_TYPE_ISOLATION;
//                        }
//                        if (stripos($node->nodeValue, 'compound') !== false) {
//                            $rip['mechanics_type'] = DbTable::MECHANICS_TYPE_COMPOUND;
//                        }
//
////                        break;
////                    case 6:
//
//
//                        if (stripos($node->nodeValue, 'push') !== false) {
//                            $rip['force_type'] = DbTable::FORCE_TYPE_PUSH;
//                        }
//                        if (stripos($node->nodeValue, 'pull') !== false) {
//                            $rip['force_type'] = DbTable::FORCE_TYPE_PULL;
//                        }
//                        if (stripos($node->nodeValue, 'static') !== false) {
//                            $rip['force_type'] = DbTable::FORCE_TYPE_STAIC;
//                        }
//
////                        break;
////                    default:
////                        break;
////                }
////                \Zend\Debug::dump($key);
////                \Zend\Debug::dump(trim($node->nodeValue));
//            }
//
//            //rating
//            $nodelist = $query->execute('div#exerciseRating span.rating');
//
//            foreach ($nodelist as $key => $node) {
//
//                \Zend\Debug::dump($key);
//                \Zend\Debug::dump(trim($node->nodeValue));
//                $rip['rating'] = trim($node->nodeValue);
//            }
//
//            //description
//            $nodelist = $query->execute('div#listing div.guideContent');
//
//            foreach ($nodelist as $key => $node) {
//
//                \Zend\Debug::dump($key);
//                \Zend\Debug::dump(trim($node->nodeValue));
//    //            function innerHTML($node){
//    //              $doc = new \DOMDocument();
//    //              $doc->appendChild($doc->importNode($node, true));
//    //              \Zend\Debug::dump($doc->saveHTML(), '$doc->saveHTML()');
//
//                  $doc = new \DOMDocument();
//                  foreach ($node->childNodes as $child)
//                    $doc->appendChild($doc->importNode($child, true));
//
//                  $rip['description'] = $doc->saveHTML();
//
//    //            $rip['description'] = trim($node->nodeValue);
//            }
//
//            //type img
//            $nodelist = $query->execute('div.exercisePhotos a img');
//            $imgArray = array();
//
//            foreach ($nodelist as $key => $node) {
//
//                \Zend\Debug::dump($key);
//                \Zend\Debug::dump(trim($node->getAttribute('src')));
//
//    //            function innerHTML($node){
//    //              $doc = new \DOMDocument();
//    //              foreach ($node->childNodes as $child)
//    //                $doc->appendChild($doc->importNode($child, true));
//    //
//    //              $rip['type_img'] = $doc->saveHTML();
//    //            }
//                $imgArray[] = trim($node->getAttribute('src'));
//            }
//            $rip['type_img'] = implode(',', $imgArray);
//
//            //guide img
//            $nodelist = $query->execute('div.guideImage img');
//
//            foreach ($nodelist as $key => $node) {
//
//                \Zend\Debug::dump($key);
//                \Zend\Debug::dump(trim($node->nodeValue), 'div.guideImage');
//                $rip['guide_img'] = trim($node->getAttribute('src'));
//            }
//
//            \Zend\Debug::dump($rip);
//
//            $rip->save();
//            break;
//        }








        /*
         * every record with a link field
         */
//        $_SESSION['rips'] = null;
//        if (empty($_SESSION['rips'])) {
//            $rips = $this->_type->getResultSet(array('link not LIKE ? AND link is not null' => ''))->toArray();
//
//            $_SESSION['rips'] = $rips;
////            $_SESSION['position'] = 10;
////            \Zend\Debug::dump($rips);
//        }

//
        if (!empty($_SESSION['rips'])) foreach ($_SESSION['rips'] as $key => $rip) {
            unset($_SESSION['rips'][$key]);


            $rip = $this->_type->getRow(array('type_id' => $rip['type_id']));
            $html = file_get_contents($rip['link']);
//            $rip['tree_order'] = $_SESSION['position'];
//            $_SESSION['position'] += 10;
//            \Zend\Debug::dump($rip);

            $query = new Query($html);//
    //        $document = $query->getDocument();//

            //NAME
            $nodelist = $query->execute('div#exerciseDetails h1');

            foreach ($nodelist as $key => $node) {
                $rip['name'] = trim($node->nodeValue);
                \Zend\Debug::dump($key);
                \Zend\Debug::dump(trim($node->nodeValue));
            }

            //MECHANICS
            $nodelist = $query->execute('div#exerciseDetails p a');


//            $info = array(
//                '0' => 'type',
//                '1' => 'main muscle',
//                '2' => 'equipment',
//                '3' => 'mechanics',
//                '4' => 'level',
//                '5' => 'sport',
//                '6' => 'force',
//            );

            $rip['mechanics_type'] = ExerciseType::MECHANICS_TYPE_NA;
            $rip['force_type'] = ExerciseType::FORCE_TYPE_NA;
            foreach ($nodelist as $key => $node) {
//                switch($key) {
//                    case 2:
                        \Zend\Debug::dump(trim($node->nodeValue), '\Zend\Debug::dump(trim($node->nodeValue));');
                        \Zend\Debug::dump(stripos($node->nodeValue, 'isolation') !==  false, 'stripos($node->nodeValue, \'isolation\')');
                        if (stripos($node->nodeValue, 'bands') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_BANDS;
                        }
                        if (stripos($node->nodeValue, 'barbell') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_BARBELL;
                        }
                        if (stripos($node->nodeValue, 'body only') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_BODYONLY;
                        }
                        if (stripos($node->nodeValue, 'cable') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_CABLE;
                        }
                        if (stripos($node->nodeValue, 'dumbbell') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_DUMBBELL;
                        }
                        if (stripos($node->nodeValue, 'curl bar') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_EZCURLBAR;
                        }
                        if (stripos($node->nodeValue, 'exercise ball') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_EXERCISEBALL;
                        }
                        if (stripos($node->nodeValue, 'foam roll') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_FOAMROLL;
                        }
                        if (stripos($node->nodeValue, 'kettlebells') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_KETTLEBELLS;
                        }
                        if (stripos($node->nodeValue, 'machine') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_MACHINE;
                        }
                        if (stripos($node->nodeValue, 'medicine ball') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_MEDICINEBALL;
                        }
                        if (stripos($node->nodeValue, 'none') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_NONE;
                        }
                        if (stripos($node->nodeValue, 'other') !== false) {
                            $rip['equipment'] = ExerciseType::EQUIPMENT_TYPE_OTHER;
                        }

//                        break;
//                    case 3:


                        if (stripos($node->nodeValue, 'isolation') !== false) {
                            $rip['mechanics_type'] = ExerciseType::MECHANICS_TYPE_ISOLATION;
                        }
                        if (stripos($node->nodeValue, 'compound') !== false) {
                            $rip['mechanics_type'] = ExerciseType::MECHANICS_TYPE_COMPOUND;
                        }

//                        break;
//                    case 6:


                        if (stripos($node->nodeValue, 'push') !== false) {
                            $rip['force_type'] = ExerciseType::FORCE_TYPE_PUSH;
                        }
                        if (stripos($node->nodeValue, 'pull') !== false) {
                            $rip['force_type'] = ExerciseType::FORCE_TYPE_PULL;
                        }
                        if (stripos($node->nodeValue, 'static') !== false) {
                            $rip['force_type'] = ExerciseType::FORCE_TYPE_STAIC;
                        }

//                        break;
//                    default:
//                        break;
//                }
                \Zend\Debug::dump($key);
                \Zend\Debug::dump(trim($node->nodeValue));
            }

            //rating
            $nodelist = $query->execute('div#exerciseRating span.rating');

            foreach ($nodelist as $key => $node) {

                \Zend\Debug::dump($key);
                \Zend\Debug::dump(trim($node->nodeValue));
                $rip['rating'] = trim($node->nodeValue);
            }

            //description
            $nodelist = $query->execute('div#listing div.guideContent');

            foreach ($nodelist as $key => $node) {

                \Zend\Debug::dump($key);
                \Zend\Debug::dump(trim($node->nodeValue));
    //            function innerHTML($node){
    //              $doc = new \DOMDocument();
    //              $doc->appendChild($doc->importNode($node, true));
    //              \Zend\Debug::dump($doc->saveHTML(), '$doc->saveHTML()');

                  $doc = new \DOMDocument();
                  foreach ($node->childNodes as $child)
                    $doc->appendChild($doc->importNode($child, true));

                  $rip['description'] = $doc->saveHTML();

    //            $rip['description'] = trim($node->nodeValue);
            }

            //type img
            $nodelist = $query->execute('div.exercisePhotos a img');
            $imgArray = array();

            foreach ($nodelist as $key => $node) {

                \Zend\Debug::dump($key);
                \Zend\Debug::dump(trim($node->getAttribute('src')));

    //            function innerHTML($node){
    //              $doc = new \DOMDocument();
    //              foreach ($node->childNodes as $child)
    //                $doc->appendChild($doc->importNode($child, true));
    //
    //              $rip['type_img'] = $doc->saveHTML();
    //            }
                $imgArray[] = trim($node->getAttribute('src'));
            }
            $rip['type_img'] = implode(',', $imgArray);

            //guide img
            $nodelist = $query->execute('div.guideImage img');

            foreach ($nodelist as $key => $node) {

                \Zend\Debug::dump($key);
                \Zend\Debug::dump(trim($node->nodeValue), 'div.guideImage');
                $rip['guide_img'] = trim($node->getAttribute('src'));
            }

            \Zend\Debug::dump($rip->toArray());

            $rip->save();
            break;
        }













    }
}