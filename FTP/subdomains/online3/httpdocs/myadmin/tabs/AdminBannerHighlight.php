<?php
include_once( PS_ADMIN_DIR . '/../classes/AdminTab.php' );

class AdminBannerHighlight extends AdminTab
{ 
   
  public function __construct() 
  {
		$this->table = 'banner_highlight'; 
		$this->className = 'BannerHighlight';
		$this->lang = true;
		$this->edit = true;
		$this->delete = true;
		
		$this->fieldsDisplay = array(
		  'id_banner_highlight' => array( 'title' => $this->l( 'ID' ),'align' => 'center', 'width' => 25 ),
		  'image' => array('title' => $this->l('Photo'), 'align' => 'center', 'image' => 'module_hl', 'width' => 50, 'orderby' => false, 'filter' => false, 'search' => false),
		  'title' => array('title' => $this->l( 'Title' ), 'width' => 300 ),
		  'active' => array('title' => $this->l('Enabled'), 'width' => 25, 'align' => 'center', 'active' => 'status', 'type' => 'bool', 'orderby' => false)
		 );
		
		$this->fieldImageSettings = array('name' => 'image', 'dir' => 'module_hl');
			
		$this->maxImageSize = 1000000;
				
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
			
    $defaultLanguage = intval( Configuration::get( 'PS_LANG_DEFAULT' ) );
    $languages = Language::getLanguages();
    $obj = $this->loadObject( true );
	
    echo '
      <script type="text/javascript">
        id_language = Number('.$defaultLanguage.');
      </script>';

    echo '
      <form action="' . $currentIndex . '&submitAdd' .  $this->table . '=1&token=' . $this->token . '" method="post" class="width3" enctype="multipart/form-data">
        ' . ($obj->id ? '<input type="hidden" name="id_' . $this->table . '" value="' . $obj->id . '" />' : '').'
        <fieldset><legend><img src="../img/admin/profiles.png" />' . $this->l( 'Highlight Banner' ) . '</legend>
		
          <label>'.$this->l( 'Title:' ).' </label>
          <div class="margin-form">';
    foreach ( $languages as $language )
      echo '
          <div id="title_' . $language['id_lang'|'id_lang'] . '" style="display: ' . ($language['id_lang'|'id_lang'] == $defaultLanguage ? 'block' : 'none') . '; float: left;">
            <input size="33" type="text" name="title_' . $language['id_lang'|'id_lang'] . '" value="' . htmlentities( $this->getFieldValue( $obj, 'title', intval( $language['id_lang'|'id_lang'] ) ), ENT_COMPAT, 'UTF-8' ) . '" /><sup>*</sup>
          </div>';
    $this->displayFlags( $languages, $defaultLanguage, 'title', 'title' );
	
    echo '
          <div class="clear"></div>
        </div>';
		
		echo '<div class="clear"></div>
			<label>'.$this->l('Image:').' </label>
				<div class="margin-form">';
				
				//displayImage($id, $image, $size, $id_image = NULL, $token = NULL, $disableCache = false)
				echo $this->displayImage($obj->id, _PS_IMG_DIR_. $this->fieldImageSettings['dir'].'/'.$obj->id.'.jpg', 350, NULL,NULL, true);
				//echo 	$this->displayImage($obj->id, _PS_IMG_DIR_.'c/'.$obj->id.'.jpg', 350, NULL, Tools::getAdminToken('Admin'.$this->className.(int)(Tab::getIdFromClassName('Admin'.$this->className)).(int)($cookie->id_employee)), true);
				
		echo '
					<input type="file" name="image" />
					<p>'.$this->l('Upload banner from your computer').' (.gif, .jpg, .jpeg '.$this->l('or').' .png : 670x430 px)</p>
				</div>';
		
		echo '<label>'.$this->l('URL:').' </label>
				<div class="margin-form">
					<input size="33" type="text" name="url" id="url"  value="'.$obj->url.'" />
				</div>';
		
		echo '<label>'.$this->l('Enable:').' </label>
				<div class="margin-form">
					<input type="radio" name="active" id="active_on" onclick="toggleDraftWarning(false);" value="1" '.($this->getFieldValue($obj, 'active') ? 'checked="checked" ' : '').'/>
					<label class="t" for="active_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="active" id="active_off" onclick="toggleDraftWarning(true);" value="0" '.(!$this->getFieldValue($obj, 'active') ? 'checked="checked" ' : '').'/>
					<label class="t" for="active_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div>';
				
        echo '<div class="margin-form">
          <input type="submit" value="' . $this->l( ' Save ' ) . '" name="submitAdd' . $this->table . '" class="button" />
        </div>
        <div class="small"><sup>*</sup> ' . $this->l( 'Required field' ) . '</div>
      </fieldset>
    </form> ';
    }
}