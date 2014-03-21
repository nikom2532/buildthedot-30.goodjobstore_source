<?
function message ($alert, $html = NULL, $after = 1) {
    if($html) $msg = $html;
    $msg .= '<SCRIPT type="text/javascript">alert(\''.$alert.'\');';
    switch($after) {
	case 1: $msg .= 'parent.location.reload();';
	    break;
	case 2: $msg .= 'history.back(1);';
	    break;
	default: $msg .= 'window.location=\''.$after.'\' ';
	    break;
	}
    $msg .= '</SCRIPT>';
    return $msg;
}

function makeAll($dir, $mode = 0777, $recursive = true) {
    if( is_null($dir) || $dir === "" ){
        return FALSE;
    }
    
    if( is_dir($dir) || $dir === "/" ){
        return TRUE;
    }
    if( makeAll(dirname($dir), $mode, $recursive) ){
        return mkdir($dir, $mode);
    }
    return FALSE;
}

function smartCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755))
{
	$result=false;
	
	//For Cross Platform Compatibility
	if (!isset($options['noTheFirstRun'])) {
		$source=str_replace('\\','/',$source);
		$dest=str_replace('\\','/',$dest);
		$options['noTheFirstRun']=true;
	}
	
	if (is_file($source)) {
		if ($dest[strlen($dest)-1]=='/') {
			if (!file_exists($dest)) {
				makeAll($dest,$options['folderPermission'],true);
			}
			$__dest=$dest."/".basename($source);
		} else {
			$__dest=$dest;
		}
		$result=copy($source, $__dest);
		chmod($__dest,$options['filePermission']);
		
	} elseif(is_dir($source)) {
		if ($dest[strlen($dest)-1]=='/') {
			if ($source[strlen($source)-1]=='/') {
				//Copy only contents
			} else {
				//Change parent itself and its contents
				$dest=$dest.basename($source);
				@mkdir($dest);
				chmod($dest,$options['filePermission']);
			}
		} else {
			if ($source[strlen($source)-1]=='/') {
				//Copy parent directory with new name and all its content
				@mkdir($dest,$options['folderPermission']);
				chmod($dest,$options['filePermission']);
			} else {
				//Copy parent directory with new name and all its content
				@mkdir($dest,$options['folderPermission']);
				chmod($dest,$options['filePermission']);
			}
		}

		$dirHandle=opendir($source);
		while($file=readdir($dirHandle))
		{
			if($file!="." && $file!="..")
			{
				$__dest=$dest."/".$file;
				$__source=$source."/".$file;
				//echo "$__source ||| $__dest<br />";
				if ($__source!=$dest) {
					$result=smartCopy($__source, $__dest, $options);
				}
			}
		}
		closedir($dirHandle);
		
	} else {
		$result=false;
	}
	return $result;
}

function directoryToArray($directory, $recursive=true, $level=0, $exclude=NULL) {
    $ignore = array('.','..');
    $ignore = array_merge($ignore, explode(',',$exclude) );
    $array_items = array();
    if ($handle = opendir($directory)) {
	$array_items[$directory] = '/'; 
	while (false !== ($file = readdir($handle))) {
	    //if ($file != "." && $file != "..") {
	    if(!in_array($file, $ignore)) {
		$_file = $file;
		$spaces = str_repeat( '&nbsp;', ( $level * 4 ) );
		if (is_dir($directory. "/" . $file)) {
		    if($recursive) $array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $recursive, ($level+1) ));
		    $file = $directory . "/" . $file;
		    $array_items[$file] = $spaces.'/'.$_file;
		    } 
		}
	    }
	    closedir($handle);
	}
	return $array_items;
    }
    
function delTree($dir) {
    $files = glob($dir . '*', GLOB_MARK);
    foreach($files as $file){
        if(is_dir($file)) delTree( $file );
        else {
    	    echo 'delete file: '.$file.'<br>'.PHP_EOL;
    	    @unlink($file);
    	    }
    }
    if (is_dir($dir)) {
	echo 'delete dir: '.$dir.'<br>'.PHP_EOL;
	@rmdir( $dir );
	}
}

function fileList($fileList) {
    $list = '<ul id="fileBox">'.PHP_EOL;
    foreach($fileList as $file) {
	$fPath = realpath(dirname(__FILE__).'/../..'.$file);
	is_dir($fPath) ? $icon = 'folder' : $icon = substr(strrchr($file , "."),1);
	$list .= '<li class="icon '.$icon.'">'.$file.'</li>'.PHP_EOL;
	}
    $list .= '</ul>'.PHP_EOL;
    return $list;
}

function chmodr($path, $filemode) {
    if (!is_dir($path))
        return chmod($path, $filemode);

    $dh = opendir($path);
    while (($file = readdir($dh)) !== false) {
        if($file != '.' && $file != '..') {
            $fullpath = $path.'/'.$file;
            if(is_link($fullpath))
                return FALSE;
            elseif(!is_dir($fullpath) && !chmod($fullpath, $filemode))
                    return FALSE;
            elseif(!chmodr($fullpath, $filemode))
                return FALSE;
        }
    }

    closedir($dh);

    if(chmod($path, $filemode))
        return TRUE;
    else
        return FALSE;
}
?>