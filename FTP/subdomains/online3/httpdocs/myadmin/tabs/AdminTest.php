<?php
include_once( PS_ADMIN_DIR . '/../classes/AdminTab.php' );

class AdminTest extends AdminTab
{ 
   
  public function __construct() 
  {
		$this->table = 'test'; 
		$this->className = 'Test';
		$this->lang = true;
		$this->edit = true;
		$this->delete = true;
		
		$this->fieldsDisplay = array(
		  'id_test' => array( 'title' => $this->l( 'ID' ),'align' => 'center', 'width' => 25 ),
		  'image' => array('title' => $this->l('Photo'), 'align' => 'center', 'image' => 'module_hl', 'width' => 45, 'orderby' => false, 'filter' => false, 'search' => false),
		   'test' => array('title' => $this->l( 'Test' ), 'width' => 200 ),
		  'name' => array('title' => $this->l( 'Name' ), 'width' => 200 ));
		
		$this->fieldImageSettings = array('name' => 'image', 'dir' => 'module_hl');
			
		$this->maxImageSize = 1000000;
		
		$this->_select = 'position ';
		
		parent::__construct();
    }
	
	public function postProcess()
	{
		global $cookie, $link, $currentIndex;
		/* Delete image */
		if (Tools::isSubmit('deleteImage'))
		{
			$object = $this->loadObject();
			$dir = $this->fieldImageSettings['dir'].'/';
			$file = _PS_IMG_DIR_ . $dir . $object->id . '.' . $this->imageType; //die($file);
			if (file_exists($file))
				unlink($file);
		}
		/* Delete multiple objects */
		if(Tools::isSubmit('submitDel'.$this->table))
		{
			//print_r($_POST); die;
		}
		/* Delete object */
		if(isset($_GET['delete'.$this->table]))
		{
			if( Validate::isLoadedObject($object = $this->loadObject()) )
			{
				//print_r($this->fieldImageSettings); die;
				/*echo '<pre>';
				 print_r($object); echo '</pre>'; 
				echo '<p>'.$object->id.'</p>';
				die;*/
										
				$dir = $this->fieldImageSettings['dir'].'/';
				$file = _PS_IMG_DIR_ . $dir . $object->id . '.' . $this->imageType; //die($file);
				if (file_exists($file))
					unlink($file);
			}
			else
				$this->_errors[] = Tools::displayError('An error occurred while deleting object.').' <b>'.$this->table.'</b> '.Tools::displayError('(cannot load object)');
		}
		elseif (isset($_GET['position']))
		{
			echo Validate::isLoadedObject($object = $this->loadObject()); die;
			if ($this->tabAccess['edit'] !== '1')
				$this->_errors[] = Tools::displayError('You do not have permission to edit here.');
			elseif (!Validate::isLoadedObject($object = $this->loadObject()))
				$this->_errors[] = Tools::displayError('An error occurred while updating status for object.').' <b>'.$this->table.'</b> '.Tools::displayError('(cannot load object)');
			elseif (!$object->updatePosition((int)(Tools::getValue('way')), (int)(Tools::getValue('position'))))
				$this->_errors[] = Tools::displayError('Failed to update the position.');
			else
				Tools::redirectAdmin($currentIndex.'&'.$this->table.'Orderby=position&'.$this->table.'Orderway=asc&conf=4'.(($id_category = (int)(Tools::getValue('id_cms_category'))) ? ('&id_cms_category='.$id_category) : '').'&token='.Tools::getAdminTokenLite('AdminCMSContent'));
		}
		
		/* Add object */
		if (Tools::isSubmit('submitAdd'.$this->table) )
		{//1										 
			
		}//1
		
		parent::postProcess(); 
	}
	
	protected function postImage($id)
	{
		if (isset($_FILES['image']) AND isset($_FILES['image']['tmp_name']) AND !empty($_FILES['image']['tmp_name']))
		{//2
			$dir = $this->fieldImageSettings['dir'].'/';
			$file = _PS_IMG_DIR_ . $dir . $id . '.' . $this->imageType;
			
			if (file_exists($file))
				unlink($file);
				
			if ($error = checkImage($_FILES['image'], $this->maxImageSize))
				$this->_errors[] = $error;
			elseif (!$tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS') OR !move_uploaded_file($_FILES['image']['tmp_name'], $tmpName))
				return false;
			elseif (!imageResize($tmpName, $file))
				$this->_errors[] =Tools::displayError($this->l('An error occurred during the image upload.'));
				
			if (isset($tmpName))
				unlink($tmpName);
		}//2
	}
	
  public function displayForm()
  {
    global $currentIndex;
		//parent::displayForm();

	/*if (!($obj = $this->loadObject(true)))
			return;*/
			
    $defaultLanguage = intval( Configuration::get( 'PS_LANG_DEFAULT' ) );
    $languages = Language::getLanguages();
    $obj = $this->loadObject( true );

	//echo 'id='.$this->getFieldValue($obj, 'name');
	
    echo '
      <script type="text/javascript">
        id_language = Number('.$defaultLanguage.');
      </script>';

    echo '
      <form action="' . $currentIndex . '&submitAdd' .  $this->table . '=1&token=' . $this->token . '" method="post" class="width3" enctype="multipart/form-data">
        ' . ($obj->id ? '<input type="hidden" name="id_' . $this->table . '" value="' . $obj->id . '" />' : '').'
        <fieldset><legend><img src="../img/admin/profiles.png" />' . $this->l( 'Profiles' ) . '</legend>
		
		<label>'.$this->l('TEST:').' </label>
				<div class="margin-form">
					<input type="text" size="60" maxlength="128" name="test" value="'.htmlentities($this->getFieldValue($obj, 'test'), ENT_COMPAT, 'UTF-8').'" /> <sup>*</sup>
				</div>
				
          <label>'.$this->l( 'Name:' ).' </label>
          <div class="margin-form">';
    foreach ( $languages as $language )
      echo '
          <div id="name_' . $language['id_lang'|'id_lang'] . '" style="display: ' . ($language['id_lang'|'id_lang'] == $defaultLanguage ? 'block' : 'none') . '; float: left;">
            <input size="33" type="text" name="name_' . $language['id_lang'|'id_lang'] . '" value="' . htmlentities( $this->getFieldValue( $obj, 'name', intval( $language['id_lang'|'id_lang'] ) ), ENT_COMPAT, 'UTF-8' ) . '" /><sup>*</sup>
          </div>';
    $this->displayFlags( $languages, $defaultLanguage, 'name', 'name' );
	
    echo '
          <div class="clear"></div>
        </div>';
		
		echo '<div class="clear"></div>
			<label>'.$this->l('Image:').' </label>
				<div class="margin-form">';
				
				//displayImage($id, $image, $size, $id_image = NULL, $token = NULL, $disableCache = false)
				echo $this->displayImage($obj->id, _PS_IMG_DIR_. $this->fieldImageSettings['dir'].'/'.$obj->id.'.jpg', 350, NULL,NULL, true);
				echo 	$this->displayImage($obj->id, _PS_IMG_DIR_.'c/'.$obj->id.'.jpg', 350, NULL, Tools::getAdminToken('Admin'.$this->className.(int)(Tab::getIdFromClassName('Admin'.$this->className)).(int)($cookie->id_employee)), true);
				
		echo '
					<input type="file" name="image" />
				</div>';
		
        echo '<div class="margin-form">
          <input type="submit" value="' . $this->l( ' Save ' ) . '" name="submitAdd' . $this->table . '" class="button" />
        </div>
        <div class="small"><sup>*</sup> ' . $this->l( 'Required field' ) . '</div>
      </fieldset>
    </form> ';
    }
}