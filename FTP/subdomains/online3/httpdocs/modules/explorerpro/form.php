<body oncontextmenu="return false;">
<?php
include 'function.php';

switch($_GET['do']) {
    // create new file/folder
    case 'new':
        $_GET['type']=='file' ? $type = 'file' : $type = 'folder';
        $html = '
        <center>
        create new <i>'.$type.'</i> on <b>'.$_GET['file'].'</b>
        <form action="action.php" method="post">
        <p style="margin:5px;"><input type="text" name="filename" id="filename" size="40"/></p>
        <input type="submit" name="create" id="button" value="create" />
        <input type="hidden" name="type" value="'.$_GET['type'].'">
        <input type="hidden" name="file" value="'.$_GET['file'].'">
        </form>
        </center>
        ';
        break;
    
    //upload file to folder
    case 'upload';
	$html .= '
	<center>
	<p>upload your file to <b>'.$_GET['file'].'</b></p>
	<form enctype="multipart/form-data" action="action.php" method="POST">
	    <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
	    <input name="userfile" type="file" size="50" style="font-size:12px;"/><br />
	    <input type="submit" name="upload" value="Send File" style="margin:5px;"/>
	    <input type="hidden" name="file" value="'.$_GET['file'].'">
	</form>
	</center>
	'.PHP_EOL;
	break;    

    //edit script files
    case 'edit':
        $html = '
        <script language="Javascript" type="text/javascript" src="./edit_area/edit_area_full.js"></script>
	    <script language="Javascript" type="text/javascript">
    	    editAreaLoader.init({
    	    id: "content"	// id of the textarea to transform		
    	    ,start_highlight: true	// if start with highlight
            ,allow_resize: "both"
            ,allow_toggle: false
            ,word_wrap: true
            ,language: "en"
            ,syntax: "php"	
            });
        </script>
	<form action="action.php" method="post">
	<textarea name="content" id="content" style="height:95%; width:100%;">'.htmlspecialchars(file_get_contents(dirname(__FILE__).'/../..'.$_GET['file'])).'</textarea>
	<input type="hidden" name="file" value="'.$_GET['file'].'">
	<p style="margin-top:5px;"><input type="submit" name="save" id="button" value="save" />
	<input type="reset" name="reset" id="reset" value="reset" /></p>
	</form>
	';
	break;
	
    // view image files
    case 'view':
        $file = dirname($_SERVER["SCRIPT_NAME"]).'/../..'.$_GET['file'];
        $html = '<center><img src="'.$file.'"></center>';
        break;
    
    // rename file/foler
    case 'ren':
        $oPath = realpath(dirname(__FILE__).'/../..'.$_GET['dir'].'/'.$_GET['file']);
	if(!file_exists($oPath)) die('<p align=center>cant find <b>'.$_GET['dir'].'/'.$_GET['file'].'</b><br> file/folder not exist</p>');
	$html .= '
	<p align="center">type a new name for <b>'.$_GET['dir'].'/'.$_GET['file'].'</b></p>
	<form action="action.php" method="post">
	<table width="28%" border="0" align="center" cellpadding="5" cellspacing="0">
	    <tr>
	        <td nowrap="nowrap">Name</td>
	        <td nowrap="nowrap"><input type="text" name="nName" id="nName" value="'.$_GET['file'].'" size="30"/></td>
	    </tr>
	    <tr>
	        <td colspan="2" align="center" nowrap="nowrap"><input type="submit" name="rename" value="rename" /></td>
	    </tr>
	</table>
	<input type="hidden" name="oName" value="'.$_GET['file'].'">
	<input type="hidden" name="oDir" value="'.$_GET['dir'].'">
	</form>
	'.PHP_EOL;	    
	break;
	
    //delete file/folder
    case 'dele':
	$html ='
	<link type="text/css" rel="stylesheet" href="./explorer.css"  />
	<p align="center">are you sure to delete this selected file/folder?</p>
	'.fileList($_GET['fileBox']).'
	<form action="action.php" method="post">
	<p align="center" style="margin:5px;"><input type="submit" name="delete" id="button" value="yes" />
	<input type="submit" name="cancel" id="button" value="no" onclick="return parent.window.hs.close()"/></p>
	<input type="hidden" name="fileBox" value="'.htmlspecialchars(implode(',',$_GET['fileBox'])).'">
	</form>
	<p align="center" style="color:red;"><b>warning... this process can not be undo and will delete file/folder recursivly</b></p>
	</center>
	';
	break;

    //copy and move file/folder
    case 'move':
    case 'copy':
	//if(!is_array($fileList)) die('please select a file by tick on the chekboxes<SCRIPT type="text/javascript">alert(\'please select a file\');parent.location.reload();</SCRIPT>');
	$html  = '<link type="text/css" rel="stylesheet" href="./explorer.css"  />
	<p align="center">are you sure to '.$_GET['do'].' this selected file/folder?</p>';
	
	$html .= fileList($_GET['fileBox']);
	$path = dirname(__FILE__).'/../..';
	$a = directoryToArray( realpath($path) );
	ksort($a);
	$html .= '
	<form action="action.php" method="post">
	<table width="28%" border="0" align="center" cellpadding="5" cellspacing="0">
	<tr>
	    <td nowrap="nowrap" align="right">'.$_GET['do'].' to</td>
	    <td><select name="nDir" id="nDir">';
	foreach($a as $k=>$v) {
	    $k == realpath($path).$_GET['dir'] ? $select = 'selected="selected"' : $select = '';
	    $html .= '<option value="'.$k.'" '.$select.'>'.$v.'</option>'.PHP_EOL;
	    }
	$_GET['do'] == 'copy' ? $backup = '<input type="checkbox" name="backup" value="1" />backup&nbsp;' : $backup = '';
	$html .= '
	    </select>
	    </td>
	</tr>
	<tr>
	    <td colspan="2" align="center" nowrap="nowrap">
		'.$backup.'
        	<input type="submit" name="'.$_GET['do'].'" value="'.$_GET['do'].'" />
	    </td>
	</tr>
	</table>
	<input type="hidden" name="fileBox" value="'.htmlspecialchars(implode(',',$_GET['fileBox'])).'">
	<input type="hidden" name="oDir" value="'.$_GET['dir'].'">
	</form>
	'.PHP_EOL;
	break;
    
    //permission
    case 'perm':
	$html  = '<link type="text/css" rel="stylesheet" href="./explorer.css"  />
	<p align="center">are you sure to change permission this selected file/folder?</p>';
	
	$html .= fileList($_GET['fileBox']);
	$path = dirname(__FILE__).'/../..';
	$a = directoryToArray( realpath($path) );
	ksort($a);
	$html .= '
	<form action="action.php" method="post">
	<table width="28%" border="0" align="center" cellpadding="5" cellspacing="0">
	<tr>
	    <td nowrap="nowrap" align="right"><input type="text" name="mod" value="755" size="3" maxlength="3" /> </td>
	    <td nowrap="nowrap"><input type="checkbox" name="recrusive"/>recrusive </td>
	</tr>
	<tr>
	    <td colspan="2" align="center" nowrap="nowrap">
        	<input type="submit" name="perm" value="change permission" />
	    </td>
	</tr>
	</table>
	<input type="hidden" name="fileBox" value="'.htmlspecialchars(implode(',',$_GET['fileBox'])).'">
	<input type="hidden" name="oDir" value="'.$_GET['dir'].'">
	</form>
	'.PHP_EOL;	
	break;
	

	
    }

echo $html;
?>
</body>
