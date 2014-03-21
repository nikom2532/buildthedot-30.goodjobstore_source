<?php

class explorerpro extends Module
{	
	private $_html = '';
	private $_postErrors = array();
	
 	function __construct()
 	{
 	 	$this->name = 'explorerpro';
 	 	$this->version = '0.1';
 	 	$this->tab = '[mod-id]';
		
		parent::__construct();
		
		$this->displayName = $this->l('File Explorer Pro');
		$this->description = $this->l('Browse your files from Back Office');
 	}

	function install()
	{
	 	if (!parent::install())
	 		return false;
	 	return true;
	}
	
	public function uninstall()
	{
		if (!parent::uninstall())
		return false;
	}
	
	private function _link($link)
	{
		$tab = Tools::getValue('tab');
		$currentIndex = __PS_BASE_URI__.substr($_SERVER['SCRIPT_NAME'], strlen(__PS_BASE_URI__)).($tab ? '?tab='.$tab : '');
		$token = Tools::getValue('token');
		$url = $currentIndex.'&configure='.$this->name.'&dir='.$link.'&token='.$token;
		return $url;
	}
	
	private function _size($dir) 
	{
		$kb = 1024;         // Kilobyte
		$mb = 1024 * $kb;   // Megabyte
		$gb = 1024 * $mb;   // Gigabyte
		$tb = 1024 * $gb;   // Terabyte
                $size = filesize($dir);

                if($size < $kb) { return $size."b";	}
                else if($size < $mb) { return round($size/$kb,0)."k"; }
                else if($size < $gb) { return round($size/$mb,0)."m"; }
                else if($size < $tb) { return round($size/$gb,0)."g"; }
                else { return round($size/$tb,0)."t"; }
	}
	
	
	private function _getdir($subdir)
	{
		$basedir = _PS_ROOT_DIR_;
		@chdir($basedir.$subdir) or die( $this->warning = '<div class="alert error">'.$this->l('You dont have permission to access this').'</div>' );
		
		//if(empty($subdir)) $subdir = '/';
		
		if ($handle = opendir('.'))
		{
			while ($dir = readdir($handle)) 
			{ 
				if(is_dir($dir)) $dirlist[]=$dir;
				if(is_file($dir)) $filelist[]=$dir;
				//print_r($dirlist);
			}
			
			if($dirlist)
			{
				asort($dirlist);
				$parrent = dirname($subdir);
				//if($subdir!='/') $getdir .= '<tr><td colspan="4" class="icon parent"><a href="'.$this->_link($parrent).'">Parrent Directory</a></td></tr>'.PHP_EOL;
				if($_GET['dir'] != '/' ) 
				{
					$getdir .= '<tr><td colspan="6" class="icon parent"><a href="'.$this->_link($parrent).'">Parrent Directory</a></td></tr>'.PHP_EOL;
					$slash='/';
				}
				foreach($dirlist as $dir)
				{
					if($dir != '.' && $dir != '..')
					{
					    $changeddate = date("d-M-Y H:i", filectime($dir));
					    $getdir .= '
					    <tr>
						<td class="icon folder" nowrap="nowrap"><a href="'.$this->_link($subdir.$slash.$dir).'">'.$dir.'</a></td>
						<td nowrap="nowrap">'.$changeddate.'</td>
						<td nowrap="nowrap" align="center">-</td>
						<td nowrap="nowrap" align="center">'.substr(sprintf('%o', fileperms($dir)), -3).'</td>
						<td nowrap="nowrap" align="right">
						<a href="javascript:void(0)" onclick="return hs.htmlExpand(this, { objectType: \'iframe\', width: 400, headingText: \'rename\', src: \''.$this->_path.'form.php?do=ren&file='.$dir.'&dir='.$subdir.'\' } )" class="highslide"><img src="'._PS_ADMIN_IMG_.'tab-preferences.gif" title="rename/move"></a>
						<input type="checkbox" name="fileBox[]" class="noborder" value="'.$subdir.$slash.$dir.'" />
						</td>
					    </tr>
					    ';
					}
				}
			}
			
			if($filelist)
			{
				asort($filelist);
				foreach($filelist as $dir)
				{
					$img = array('jpg','jpeg','png','gif','ico');
					$ext = strrchr ( $dir , "." );
					$changeddate = date("d-M-Y H:i", filectime($dir));
					$size = $this->_size($dir);
					in_array(substr($ext,1),$img) ? $viewEdit = 'view': $viewEdit = 'edit';
					in_array(substr($ext,1),$img) ? $icon = '<img src="'._PS_ADMIN_IMG_.'details.gif" title="'.$viewEdit.'">' : $icon = '<img src="'._PS_ADMIN_IMG_.'edit.gif" title="'.$viewEdit.'">';
					$getdir .= '
					<tr>
					    <td class="icon '.substr($ext,1).'" nowrap="nowrap">'.$dir.'</td>
					    <td nowrap="nowrap">'.$changeddate.'</td>
					    <td nowrap="nowrap" align="center">'.$size.'</td>
					    <td nowrap="nowrap" align="center">'.substr(sprintf('%o', fileperms($dir)), -3).'</td>
					    <td nowrap="nowrap" align="right">
					    <a href="javascript:void(0)" onclick="return hs.htmlExpand(this, { objectType: \'iframe\', width: 400, headingText: \''.$subdir.$slash.$dir.'\', src: \''.$this->_path.'form.php?do='.$viewEdit.'&file='.$subdir.$slash.$dir.'\' } )" >'.$icon.'</a>
					    <a href="javascript:void(0)" onclick="return hs.htmlExpand(this, { objectType: \'iframe\', width: 400, headingText: \'rename\', src: \''.$this->_path.'form.php?do=ren&file='.$dir.'&dir='.$subdir.'\'} )" ><img src="'._PS_ADMIN_IMG_.'tab-preferences.gif" title="rename/move"></a>
					    <input type="checkbox" name="fileBox[]" class="noborder" value="'.$subdir.$slash.$dir.'" />
					    </td>
					</tr>
					';
					//<a href="'.$this->_path.'form.php?do=ren&file='.$subdir.$slash.$dir.'" onclick="return hs.htmlExpand(this, { objectType: \'iframe\', width: 400, headingText: \''.$subdir.$slash.$dir.'\' } )" ><img src="'._PS_ADMIN_IMG_.'tab-preferences.gif" title="rename"></a>
				}
			}

		}
		return $getdir;
	}
	
	public function getContent()
	{
		$this->_html = '
		<link type="text/css" rel="stylesheet" href="'._MODULE_DIR_.$this->name.'/explorer.css" media="all" />
                <script type="text/javascript" src="'._MODULE_DIR_.$this->name.'/highslide/highslide-full.js"></script>
                <link rel="stylesheet" type="text/css" href="'._MODULE_DIR_.$this->name.'/highslide/highslide.css" />
		<!--[if lt IE 7]>
		<link rel="stylesheet" type="text/css" href="highslide/highslide-ie6.css" />
		<![endif]-->

		<script type="text/javascript">
		    hs.graphicsDir = \''._MODULE_DIR_.$this->name.'/highslide/graphics/\';
		    hs.outlineType = \'rounded-white\';
		    hs.showCredits = false;
		    hs.wrapperClassName = \'titlebar\';
		    hs.enableKeyListener = true;
		    hs.blockRightClick = true;
		    hs.preserveContent = false;
		    hs.allowMultipleInstances = true;

		function submitToHighslide(form) {
		    var anchor;
		    for (var i = 0; i < form.elements.length; i++) {
		    	if (form.elements[i].type == \'submit\') {
					anchor = form.elements[i];
					break;
				}
			}
			hs.overrides.push(\'onAfterExpand\');
			hs.htmlExpand(anchor, {
				objectType: \'iframe\',
				src: \'about:blank\',
				height: 300,
				onAfterExpand: function(expander) {
					form.target = expander.iframe.name;
					form.submit();
				}
			});
			return false;
		}
		</script>
		<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->displayName.' <span style="font-weight:normal;">('.$_GET['dir'].')</span></legend>
		<form method="get" action="'._MODULE_DIR_.$this->name.'/form.php" onsubmit="return submitToHighslide(this)">
		<table width="80%" border="0" cellspacing="0" cellpadding="0" id="explorer">
		    <tr>
			<th width="55%" scope="col">Name</th>
			<th width="22%" scope="col">Last modified</th>
			<th width="5%" scope="col" align="center">Size</th>
			<th width="5%" scope="col" align="center">Perm</th>
			<th scope="col" align="center" >Action</th>
		    </tr>
		'.$this->_getdir($_GET['dir']).'
		<tr height="30">
		<td>
		<input type="button" value="new file"  class="button" onclick="return hs.htmlExpand(this, { objectType: \'iframe\', width: 300, headingText: \'new folder\', src: \''.$this->_path.'form.php?do=new&type=file&file='.$_GET['dir'].'\' } )">
		<input type="button" value="new folder"  class="button" onclick="return hs.htmlExpand(this, { objectType: \'iframe\', width: 300, headingText: \'new folder\', src: \''.$this->_path.'form.php?do=new&type=dir&file='.$_GET['dir'].'\' } )">
		<input type="button" value="upload file"  class="button" onclick="return hs.htmlExpand(this, { objectType: \'iframe\', width: 400, headingText: \'upload file\', src: \''.$this->_path.'form.php?do=upload&file='.$_GET['dir'].'\' } )">
		</td>
		<td colspan="5" align="right">
		<select name="do" id="do" style="font-size: 1em; width: 150px;">
		    <option selected="selected">With Selected</option>
		    <option value="copy">Copy</option>
		    <option value="move">Move</option>
		    <option value="dele">Delete</option>
		    <option value="perm">Permission</option>
		</select>
		<input type="submit" name="go" value="go" class="button">
		<input type="checkbox" name="checkme" class="noborder" onclick="checkDelBoxes(this.form, \'fileBox[]\', this.checked)" />
		<input type="hidden" value="'.$_GET['dir'].'" name="dir">
		</td>
		</tr>
		</table>
		</form>
		</fieldset>
		';
		return $this->_html;
	}	
}
?>
