<?php
class Hi_Record_List_Properties extends Hi_Record_List
{
//  protected $_formData;
//  protected $_recordActions = array();
//  protected $_listActions = array();
//  protected $_sort = null;
//  protected $_filter = null;
//  protected $_page = null;
//  protected $_results;
//  protected $_removedColumns = array();
//  protected $_hiddenColumns = array();
//  protected $_columnTitles = array();
//  protected $_columnTypes = array();
//  protected $_columnValues = array();
//  protected $_recordActionsTitle = 'Actions';
//  protected $_columns = array();
//  protected $_partialDir = array();
//  protected $_modelInfo;
//  protected $_primary;
//  protected $_filters = array();
//  protected $_checkbox = true;

  /**
   * Creates an instance of Hi_Record_List
   *
   * @param $model HiZend_Db_Table
   * @param $view Zend_View
   * @param $title string
   *
   * @return
   */
  public function __construct(HiZend_Db_Table $model, Zend_View $view, $title = '') {
    parent::__construct($model, $view, $title);

    /*@var $modelTable HiZend_Db_Table*/
    $modelInfo = $this->_model->info();
    $tmpMetadata = $modelInfo['metadata'];
    $this->_modelInfo = $modelInfo;
    $this->_primary = $modelInfo['primary'][1];

    $metadataValueCols = array();
    $metadataCols = array();
    foreach ($tmpMetadata as $field => $meta) {
      if (strpos($field, 'value')!==false) {
        $metadataValueCols[$field] = $meta;
      } else {
        $metadataCols[$field] = $meta;
      }
    }
    $this->_columns = $metadataCols+$metadataValueCols;

  }

  /**
   * Fetches rendered Record List (implementation of abstract parent method)
   *
   * @return string Fetched list.
   */
  public function render() {
    $temp = '';

    if ($this->_view===null || !($this->_view instanceof Zend_View)) {
      return $temp;
    }

    //
    if (!isset($this->_langs)) {
      $langs = array($this->_lang);
    } else {
      $langs = $this->_langs;
    }

    //
    $form = new Zend_Form();
    $form ->setAttribs($this->_formData);
    $form ->setEnctype(Zend_Form::ENCTYPE_MULTIPART);
    $form ->setDecorators(array(  array('ViewScript', array('viewScript' => $this->_partialDir.'_form_main.phtml', 'class' => 'tabela3', 'placement' => false)),
                                  array('Form'),
                                  ));

    //////////////////////////////////
    //title
    $tmpSubform = new Zend_Form_SubForm();
    $tmpSubform ->setDecorators(array(  array('FormElements')));

    //
    $tmpElement = new Zend_Form_Element_Text('Title');
    $tmpElement->setValue($this->_title);
    $options = array('colspan' => 2+count($this->_recordActions) );
    $tmpElement->setDecorators(array( array('ViewScript', array('viewScript' => $this->_partialDir.'_title.phtml', 'class'=>"nameElement", 'placement' => false, 'options' => $options))));
    $tmpSubform -> addElement($tmpElement);
    $form->addSubForm($tmpSubform, 'Title');


    //////////////////////////////////
    //column names
    $tmpSubform = new Zend_Form_SubForm();
    $tmpSubform ->setDecorators(array(  array('FormElements'),
                                        array('HtmlTag', array('tag' => 'tr', 'class'=>"rowElement")),
                                        ));

    //
    $tmpElement = new Zend_Form_Element_Hidden('formId');
    $tmpElement->setValue($this->_formData['id']);
    $tmpElement->setDecorators(array( array('ViewHelper')));
    $tmpSubform -> addElement($tmpElement);




//    foreach($this->_columns as $fieldName => $data) {
//      if (!isset($this->_removedColumns[$fieldName]) && !isset($this->_hiddenColumns[$fieldName]) ) {
//
//
//        switch ($data['DATA_TYPE']) {
          //////////////
  //        case 'tinyint':
  //        case 'float':
  //    		case 'decimal':
  //    		case 'double':
  //        case 'varchar':
  //        case 'text':
  //        case 'integer':
  //    		case 'bigint':
  //    		case 'mediumint':
  //    		case 'smallint':
  //    		case 'tinyint':
//          default:
            $tmpElement = new Zend_Form_Element_Text('Column_Name');
            $tmpElement->setValue(isset($this->_columnTitles['name'])?$this->_columnTitles['name']:'Column_Name');
            $tmpElement->setDecorators(array( array('ViewScript', array('viewScript' => $this->_partialDir.'_title_column.phtml', 'class'=>"titleElement", 'placement' => false))));
            $tmpSubform -> addElement($tmpElement);

            $tmpElement = new Zend_Form_Element_Text('Column_Value');
            $tmpElement->setValue(isset($this->_columnTitles['value'])?$this->_columnTitles['value']:'Column_Value');
            $tmpElement->setDecorators(array( array('ViewScript', array('viewScript' => $this->_partialDir.'_title_column.phtml', 'class'=>"titleElement", 'placement' => false))));
            $tmpSubform -> addElement($tmpElement);

//            break;
//        }
//      }
//    }

    if (count($this->_recordActions)){
      $tmpElement = new Zend_Form_Element_Text('Column_Actions');
      $tmpElement->setValue(isset($this->_columnTitles['actions'])?$this->_columnTitles['actions']:'Column_Actions');
      $options = array('colspan' => count($this->_recordActions) );
      $tmpElement->setDecorators(array( array('ViewScript', array('viewScript' => $this->_partialDir.'_title_column.phtml', 'class'=>"titleElement", 'placement' => false, 'options' => $options))));
      $tmpSubform -> addElement($tmpElement);
    }
    $tmpSubform -> addElement($tmpElement);
    $form->addSubForm($tmpSubform, 'header');


    ////////////////////////////////////
    //
    $fields = array();
    foreach ($this->_columns as $fieldName => $data) {
//      if (isset($field['alias'])) {
//        $fields[$field['alias']] = $field['db_name'];
//      }
//      else {
        $fields[] = $fieldName;
//      }
    }

//    echo "<pre>";
//    print_r($this->_columns);
//    echo "</pre>";



////
//////    //filters
//////    if ($this->_filter!=null) {
//////      foreach ($this->_filter as $key => $filter) {
//////
//////        if (array_key_exists($key, $fieldsForDB)) {
//////
//////          switch ($fieldsForDB[$key]['type']) {
//////            case 'label':
//////            case 'import':
//////            case 'text':
//////              $newFilter['condition'] = "$key LIKE ?";
//////              $newFilter['values'] = explode(' ', $filter);
//////              foreach ($newFilter['values'] as $keyVal => $val) {
//////                $newFilter['values'][$keyVal] = '%'.$val.'%';
//////              }
//////              break;
//////            case 'select':
//////            case 'checkbox':
//////              $newFilter['condition'] = "$key = ?";
//////              $newFilter['values'] = $filter;
//////              break;
//////          }
//////        }
//////        else if (array_key_exists($key, $joinFieldsForDB)){
//////          switch ($joinFieldsForDB[$key]['type']) {
//////            case 'label':
//////            case 'import':
//////            case 'text':
//////              $newFilter['condition'] = "$key LIKE ?";
//////              $newFilter['values'] = explode(' ', $filter);
//////              foreach ($newFilter['values'] as $keyVal => $val) {
//////                $newFilter['values'][$keyVal] = '%'.$val.'%';
//////              }
//////              break;
//////            case 'select':
//////            case 'checkbox':
//////              $newFilter['condition'] = "$key = ?";
//////              $newFilter['values'] = $filter;
//////              break;
//////          }
//////        }
//////        $this->_filter[$key] = $newFilter;
//////      }
//////    }
//////
//////
//////    //
////
    $results = array();
    if (isset($fields) && count($fields)>0) {
      $results =  $this->_model->getAll($this->_filters, $this->_sort, null, null/*, $this->_order*/);
    }
    $this->_results = $results;
//    echo "<pre>";
//    print_r($this->_results);
//    echo "</pre>";


    //////////////////////////////////////////////
    //data
    if (isset($results) && count($results)>0) {
      foreach ($results as $key => $result) {
        $tmpSubform = new Zend_Form_SubForm();
        $tmpSubform ->setDecorators(array(  array('FormElements'),
                                            array('HtmlTag', array('tag' => 'tr', 'class'=> 'rowElement')),
                                            ));
//
//                                            $i=0;
//
//                                            echo "<pre>";
//                                            print_r($this->_columns);
//                                            echo "</pre>";

        //
//        foreach ($result as $fieldKey => $fieldValue) {
//          $fieldData = $this->_columns[$fieldKey];
        foreach ($this->_columns as $fieldKey => $fieldData) {
          $fieldValue = isset($result[$fieldKey])?$result[$fieldKey]:null;

          //
          if (!isset($this->_removedColumns[$fieldKey]) ) {
            if (isset($this->_hiddenColumns[$fieldKey])) {
              $tmpElement = new Zend_Form_Element_Hidden($fieldKey);
              $tmpElement->setValue($fieldValue);
              $tmpElement->setDecorators(array( array('ViewHelper'),
                                                array('Errors'),
                                      ));
              $tmpSubform -> addElement($tmpElement);
//
            } else {
              if (isset($this->_columnTypes[$fieldKey])) {
                if (!isset($fieldData['TRANSLATED'])) {



                  switch ($this->_columnTypes[$fieldKey]) {
                    //////////////
//                    case 'select':
  //                    /*$tmpElement = new Zend_Form_Element_Select($fieldName);
  //                    $tmpElement->setValue(isset($rowData[$fieldName])?$rowData[$fieldName]:'');
  //                    $tmpElement->setLabel(isset($this->_columnTitles[$fieldName])?$this->_columnTitles[$fieldName]:$fieldName);
  //                    $opt = array('Root');
  //                    $opt += $this->_columnValues[$fieldName]['values'];
  //                    $tmpElement->setMultiOptions($opt);
  //                    $tmpElement->setDecorators(array( array('ViewHelper'),
  //                                                      array('Errors'),
  //                                                      array(array('Tag_TD'=>'HtmlTag'), array('tag' => 'td', 'class'=>'grey_10', 'colspan' => count($this->_actions))),
  //                                                      array('Title', array('tag' => 'td', array('tag_class' => 'titleElement'))),
  //                                                      array(array('Tag_TR'=>'HtmlTag'), array('tag' => 'tr', 'class'=>"rowElement")),
  //
  //                                            ));
  //                    $tmpSubform -> addElement($tmpElement);*/
//                      break;
                    //////////////
                    case 'properties':
                      $tmpElement = new Zend_Form_Element_Text($fieldKey);
                      $tmpElement->setValue(isset($this->_columnValues[$fieldKey][$fieldValue]['name'])?$this->_columnValues[$fieldKey][$fieldValue]['name']:"Field Name");
                      $this->_propertyItem = isset($this->_columnValues[$fieldKey][$fieldValue])?$this->_columnValues[$fieldKey][$fieldValue]:array();
                      $options = array('value'=>"cellElement");
                      $tmpElement->setDecorators(array( array('ViewScript', array('viewScript' => $this->_partialDir.'_field_info.phtml', 'class'=>"titleElement", 'placement' => false, 'options' => $options))));
                      $tmpSubform -> addElement($tmpElement);
                      break ;
                    //////////////
//                    case 'info':
//                      $tmpElement = new Zend_Form_Element_Text($fieldKey);
//                      $tmpElement->setValue(isset($this->_columnValues[$fieldKey])?$this->_columnValues[$fieldKey][$fieldValue]:$fieldValue);
//                      $options = array('value'=>"cellElement");
//                      $tmpElement->setDecorators(array( array('ViewScript', array('viewScript' => $this->_partialDir.'_field_info.phtml', 'class'=>"titleElement", 'placement' => false, 'options' => $options))));
//                      $tmpSubform -> addElement($tmpElement);
//                      break;
                  }
                } else {
                  //
                }
              } else {
                //
                if ($fieldData['PRIMARY'] ) {
                  $this->_modelPrimaryKey = $fieldKey;
//                  $tmpElement = new Zend_Form_Element_Text($fieldKey);
//                  $tmpElement->setValue($fieldValue);
//                  $options = array( 'value'=>"cellElement");
//                  $tmpElement->setDecorators(array( array('ViewScript', array('viewScript' => $this->_partialDir.'_field_info.phtml', 'class'=>"titleElement", 'placement' => false, 'options' => $options))));
//                  $tmpSubform -> addElement($tmpElement);
                  continue;
                }
//
//                echo "<pre>";
//                print_r($this->_propertyItem);
//                echo "</pre>";
//                echo "<pre>";
//                print_r($fieldData);
//                echo "</pre>".'dadadadadadadadadadadadadadadadadadada';

                if ($this->_propertyItem['data_type'] == $fieldData['DATA_TYPE']) {


                  if (!isset($fieldData['TRANSLATED'])) {
                    //
                    switch ($fieldData['DATA_TYPE']) {

                      ///////////////////////////
                      case 'tinyint':
                        $tmpElement = new Zend_Form_Element_Checkbox($fieldKey);
                        $tmpElement->setValue($fieldValue);
                        $tmpElement->setDecorators(array( array('ViewHelper'),
                                                          array('Errors'),
                                                          array('Description', array('tag' => 'p', 'class' => 'description')),
                                                          array('HtmlTag', array('tag' => 'td', 'class'=>'cellElement')),
                                                ));
                        $tmpSubform -> addElement($tmpElement);
                        break;

                      ///////////////////////////

                      case 'varchar':
                      case 'text':
                        $tmpElement = new Zend_Form_Element_Text($fieldKey);
                        $tmpElement->setValue($fieldValue);
                        $tmpElement->setAttrib('size', 40);
                        $tmpElement->setDecorators(array( array('ViewHelper'),
                                                          array('Errors'),
                                                          array('Description', array('tag' => 'p', 'class' => 'description')),
                                                          array('HtmlTag', array('tag' => 'td', 'class'=>'cell cellElement')),
                                                ));
                        $tmpSubform -> addElement($tmpElement);
                        break;

                      ///////////////////////////
                      case 'float':
                  		case 'decimal':
                  		case 'double':
                        $tmpElement = new Zend_Form_Element_Text($fieldKey);
                        $tmpElement->setValue($fieldValue);
                        $tmpElement->setAttrib('size', 10);

                        $tmpElement->setDecorators(array( array('ViewHelper'),
                                                          array('Errors'),
                                                          array('Description', array('tag' => 'p', 'class' => 'description')),
                                                          array('HtmlTag', array('tag' => 'td', 'class'=>'grey_10 cellElement')),
                                                ));
                        $tmpSubform -> addElement($tmpElement);
                        break;

                      ///////////////////////////
                      case 'integer':
                  		case 'bigint':
                  		case 'mediumint':
                  		case 'smallint':
                  		case 'int':
                  		  if ($this->_propertyItem['has_options'] && $this->_propertyItem['sys_name']=='select') {
                  		    $tmpElement = new Zend_Form_Element_Select($fieldKey);
                          $tmpElement->setValue($fieldValue);
                          $opt = array('Root');
//                          $opt += $this->_columnValues[$fieldName]['values'];
                          $tmpElement->setMultiOptions($this->_propertyItem['options']);
                          $tmpElement->setDecorators(array( array('ViewHelper'),
                                                            array('Errors'),
                                                            array('Description', array('tag' => 'p', 'class' => 'description')),
                                                            array('HtmlTag', array('tag' => 'td', 'class'=>'grey_10 cellElement')),
                                                  ));
                          $tmpSubform -> addElement($tmpElement);

                  		  } else {

                          $tmpElement = new Zend_Form_Element_Text($fieldKey);
                          $tmpElement->setValue($fieldValue);
                          $tmpElement->setAttrib('size', 10);

                          $tmpElement->setDecorators(array( array('ViewHelper'),
                                                            array('Errors'),
                                                            array('Description', array('tag' => 'p', 'class' => 'description')),
                                                            array('HtmlTag', array('tag' => 'td', 'class'=>'grey_10 cellElement')),
                                                  ));
                          $tmpSubform -> addElement($tmpElement);
                  		  }
                        break;
                      ///////////////////////////
                      case 'date':
                  		case 'time':

                        $tmpElement = new Zend_Form_Element_Text($fieldKey);
                        $tmpElement->setValue($fieldValue);
                        $tmpElement->setAttrib('size', 8);

                        $tmpElement->setDecorators(array( array('ViewHelper'),
                                                          array('Errors'),
                                                          array('Description', array('tag' => 'p', 'class' => 'description')),
                                                          array('HtmlTag', array('tag' => 'td', 'class'=>'grey_10 cellElement')),
                                                ));
                        $tmpSubform -> addElement($tmpElement);
                        break;
                      case 'datetime':


                        $tmpElement = new Zend_Form_Element_Text($fieldKey);
                        $tmpElement->setValue($fieldValue);
                        $tmpElement->setAttrib('size', 18);

                        $tmpElement->setDecorators(array( array('ViewHelper'),
                                                          array('Errors'),
                                                          array('Description', array('tag' => 'p', 'class' => 'description')),
                                                          array('HtmlTag', array('tag' => 'td', 'class'=>'grey_10 cellElement')),
                                                ));
                        $tmpSubform -> addElement($tmpElement);
                        break;

                      ///////////////////////////
                      default:
    //                    $tmpElement = new Zend_Form_Element_Text($fieldKey);
    //
    //                    $tmpElement->setValue($fieldValue);
    //      //              $tmpElement->setDecorators(array( array('ViewHelper'),
    //      //                                                array('Errors'),
    //      //                                                array('Description', array('tag' => 'p', 'class' => 'description')),
    //      //                                                array('HtmlTag', array('tag' => 'td', 'class'=>'grey_10')),
    //      //                                         ));
    //                    $tmpElement->setDecorators(array( array('Errors'),
    //                                                      array('Description', array('tag' => 'p', 'class' => 'description')),
    //                                                      array('Info'),
    //                                                      array('HtmlTag', array( 'tag' => 'td',
    //                                                                              'class'=>'cell'
    //                                                                             )
    //                                                            ),
    //                                                     )
    //                                               );
    //                    $tmpSubform -> addElement($tmpElement);
                        break;
                    }
                  } else {
                    //
                    switch ($fieldData['DATA_TYPE']) {
                      case 'varchar':
                        $tmpTranslateSubform = new Zend_Form_SubForm();
                        $tmpTranslateSubform->setDescription(isset($this->_columnTitles[$fieldName])?$this->_columnTitles[$fieldName]:$fieldName);
                        $options = array('title'=> 'titleElement', 'value' => 'cellElement', "row"=>"rowElement");
                        $tmpTranslateSubform ->setDecorators(array(  array('FormElements'),
                                                                     array('ViewScript', array('viewScript' => $this->_partialDir.'_form_multilang_field.phtml', 'placement' => false, 'options' => $options))));

                        foreach ($langs as $lang) {
                          $tmpElement = new Zend_Form_Element_Text($lang);
                          $tmpElement->setValue(isset($fieldValue[$lang])?$fieldValue[$lang]:'');
                          $tmpElement->setLabel('['.$lang.']');
                          $tmpElement->setAttrib('size', 60);
                          $options = array('title'=> 'multiTitleElement', 'value' => 'multiDataElement', "row"=>"multiRowElement");
                          $tmpElement->setDecorators(array( array('ViewHelper'),
                                                            array('ViewScript', array('viewScript' => $this->_partialDir.'_field_multilang_varchar.phtml', 'placement' => false, 'options' => $options))));
                          $tmpTranslateSubform -> addElement($tmpElement);
                        }

                        $tmpSubform->addSubForm($tmpTranslateSubform, $fieldKey);

                        break;
                      case 'text':
                        $tmpTranslateSubform = new Zend_Form_SubForm();
                        $tmpTranslateSubform->setDescription(isset($this->_columnTitles[$fieldName])?$this->_columnTitles[$fieldName]:$fieldName);
                        $options = array('title'=> 'titleElement', 'value' => 'cellElement', "row"=>"rowElement");
                        $tmpTranslateSubform ->setDecorators(array(  array('FormElements'),
                                                                     array('ViewScript', array('viewScript' => $this->_partialDir.'_form_multilang_field.phtml', 'placement' => false, 'options' => $options))));

                        foreach ($langs as $lang) {
                          $tmpElement = new Zend_Form_Element_Textarea($lang);
                          $tmpElement->setValue(isset($fieldValue[$lang])?$fieldValue[$lang]:'');
                          $tmpElement->setLabel('['.$lang.']');
                          $tmpElement->setAttrib('cols', 45);
                          $tmpElement->setAttrib('rows', 3);
                          $options = array('title'=> 'multiTitleElement', 'value' => 'multiDataElement', "row"=>"multiRowElement");
                          $tmpElement->setDecorators(array( array('ViewHelper'),
                                                            array('ViewScript', array('viewScript' => $this->_partialDir.'_field_multilang_text.phtml', 'placement' => false, 'options' => $options))));
                          $tmpTranslateSubform -> addElement($tmpElement);
                        }

                        $tmpSubform->addSubForm($tmpTranslateSubform, $fieldKey);
                        break;
                    }
                  }
                }
              }
            }
          }
        }

        //
        if (count($this->_recordActions)) {
          foreach ($this->_recordActions as $action) {
            $tmpElement = new Zend_Form_Element_Submit($action['name']);
            $tmpElement->setAttribs($action['params']);
            $tmpElement->setLabel($action['label']);
            $tmpElement->setDecorators(array( array('ViewHelper'),
                                              array('Errors'),
                                              array('Description', array('tag' => 'p', 'class' => 'description')),
                                              array('HtmlTag', array('tag' => 'td', 'class'=>'cell cellElement')),

                                    ));
            $tmpSubform -> addElement($tmpElement);
          }
        }
        $form->addSubForm($tmpSubform, $result[$this->_modelInfo['primary'][1]] );
      }
    }


    //////////////////////
    //
    if (count($this->_listActions) && count($this->_results)) {
      $tmpSubform = new Zend_Form_SubForm();
      $tmpSubform ->setDecorators(array(  array('FormElements'),
                                          array('HtmlTag', array('tag' => 'tr')),
                                          array('HtmlTag', array('tag' => 'td', 'class'=>"listActions", 'colspan'=>1+count($this->_columns)+count($this->_recordActions))),
                                          ));
      foreach ($this->_listActions as $action) {
        $tmpElement = new Zend_Form_Element_Submit($action['name']);
        $tmpElement->setAttribs($action['params']);
        $tmpElement->setLabel($action['label']);
        $tmpElement->setDecorators(array( array('ViewHelper'),
                                          array('Errors'),
                                          array('Description', array('tag' => 'p', 'class' => 'description')),
                                ));
        $tmpSubform -> addElement($tmpElement);
      }
      $form->addSubForm($tmpSubform, 'listActions');
    }

    ////////////////////
    //
    $temp = $form->render($this->_view);

    return $temp;
  }
}