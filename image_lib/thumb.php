<?php

    /*
     *  Author:     Jarrod Oberto
     *  File name:  Image Tools with BMP support 
     *  Purpose:    Create images on the fly!
     *  Requires:   
     *	Version:    1.1
     *  
     *  Modificatoin history
     *  Date      Initials  Ver	 Description
     *  May 11	  JCO       1.0	 * First build 
     *	Jul 11    JCO		1.1  * Allow external image resizing						
     *
	 *
     */



// *** Set some defaults
$source = strtolower(getGETValue('src', '')); # strToLower will prevent dirs/files with uppercase chars to not be found at first "file_exists" statement
$width = getGETValue('w', 250);
$height = getGETValue('h', 167);
$option = getGETValue('type', 'crop');
$sharpen = getGETValue('sharpen', false);
$quality = getGETValue('q', 100);
$actions = getGETValue('actions', '');
$cropPos = getGETValue('pos', 'm');	

// *** Define some paths/settings
define('DOCUMENT_ROOT',	$_SERVER['DOCUMENT_ROOT']);
define('CURRENT_PATH', dirname(__FILE__));
define('CACHE_PATH', CURRENT_PATH . '/cache');
define('USE_CACHE', true);
define('AUTO_CONVERT', true);
define('ALLOW_ACTIONS', true);

// *** For security we limit the methods that are allowed to be called
$allowedActionsArray = array('greyScale', 'blackAndWhite', 'sepia', 'negative',  
					         'rotate', 'addWatermark', 'addText', 'addBorder', 
					         'addReflection', 'roundCorners', 'addShadow',
							 'addCaptionBox', 'greyScaleDramatic', 'vintage',
							 'greyScaleEnhanced');


// *** Get the filename
$imageNameInfoArray = pathinfo($source); 
$imageName = $imageNameInfoArray['filename'];
$extension = $imageNameInfoArray['extension'];

// *** If the source doesn't start with 'http://'
if (!checkStringStartsWith('http://', $source)) {

	// *** Get image path
	$documentRoot = trim(DOCUMENT_ROOT, '/');
	$imagePath = '/' . $documentRoot . '/' . $source;
} else {

	$imagePath = $source;
}

// *** Make sure an image has been passed in and the image exists
//if ($source != '' && file_exists($imagePath)) {
if ($source != '' && file_exists($imagePath) || checkStringStartsWith('http://', $source)) {

	$actionsArray = splitParams($actions);

	// *** get action codes for filenameHash
	if (ALLOW_ACTIONS) {
		$cacheCodes = getCacheCodes($actionsArray);
	}
		
	// *** if using shadow or round corners save as png
	if (AUTO_CONVERT && strstr($cacheCodes,'.10') ||  strstr($cacheCodes,'.9')) {
		$extension = 'png';
	}
	
	// *** Filename hash.
	$filenameHash = md5($imageName . '-' . $width . 'x' . $height . $cacheCodes . $cropPos);
	$filenameHashExt = $filenameHash . '.' . $extension;

	// *** check cache
	if (file_exists(CACHE_PATH . '/' .  $filenameHashExt) && USE_CACHE) {

		// *** Output image from cache
		outputImage($filenameHash, $extension, CACHE_PATH);	
	
	} else {
		
		include('image_lib_class.php');
	
		// *** Should already exist. If not, attempt to create
		createCacheDir(CACHE_PATH);

		// *** Open image
		$imageLibObj = new imageLib($imagePath);

		// *** If we're setting the crop position, build the crop option array
		$option = getOption($option, $cropPos);
		
		// *** Resize
		$imageLibObj -> resizeImage($width, $height, $option, $sharpen);

		if (ALLOW_ACTIONS) {
			callActions($actionsArray, $imageLibObj, $allowedActionsArray);
		}
		
		// *** Filename to save cached image
		$saveAs = CACHE_PATH . '/' . $filenameHash . '.' . $extension;

		// *** Save to cache
		if (USE_CACHE) {
			$imageLibObj -> saveImage($saveAs, $quality);
		}
			
		// *** Output to browser
		$imageLibObj -> displayImage($extension);
	
	}
}

## --------------------------------------------------------

function getOption($option, $cropPos) 
{
	// *** Check if we're cropping...
	if (strtolower($option) == 'crop') { #crop 2/2

		// *** If so, create the crop option
		$option = array('crop', $cropPos);
	}	
	
	return $option;
}

## --------------------------------------------------------

function getGETValue($value, $defaultValue = '', $valueRequired=true)
#
#	Author:		Jarrod Oberto
#	Date:		May 11
#	Purpose:	Get the value from a $_GET array 
#	Params in:	(str) $value: the value to get
#				(str) $defaultValue: the default value to return should 
#					the value not exist
#	Params out: The return value
#	Notes:	
#
{
	if (array_key_exists($value, $_GET)) {
		if ($_GET[$value] != '' && $valueRequired) {
			return urldecode($_GET[$value]);
			//return $_GET[$value];
			
		}
	}

	return $defaultValue;
}

## --------------------------------------------------------

function createCacheDir ($path, $permissions=0755) 
#
#	Author:		Jarrod Oberto
#	Date:		May 11
#	Purpose:	Attempt to create the cache dir should it not exist
#	Params in:	(str) $path: the cache path
#				(int) $permissions: the folder permissions to set
#	Params out:
#	Notes:	
#		
{
	if(!file_exists($path)) {
		@mkdir($path, $permissions);
		@chmod($path, $permissions);			
	} else {
		if (!is_writable($path)) {
			echo 'Path <strong>' . $path . '</strong> directory is not writable.';
			exit;
		} 
	}
}

## --------------------------------------------------------

function splitParams ($actions)
#
#	Author:		Jarrod Oberto
#	Date:		May 11
#	Purpose:	Seperates the actions into a key/pair array with action being 
#				the key and params being the associate
#	Params in:	(str) $actions: the actions as inputted by the user
#	Params out: (array) the seperated actions in an array
#	Notes:	
#
{
	$actionsArray = array();
	
	if (trim($actions) != '') {
		
		$actionsTempArray = explode (';', $actions);
		$actionsTempArray = array_map('trim', $actionsTempArray);
		$i = 0;
		foreach ($actionsTempArray as $userAction) {

			$pos = strpos($userAction, '(');

			if ($pos !== false) {

				$action = substr($userAction, 0, $pos);
				$params = substr($userAction, $pos);

				$params = trim($params, '(');
				$params = trim($params, ')');

				// *** Store in a array. The '-n' is added to make key unique as to
				//   * allow the same action to be called
				$actionsArray[$action . '-' . $i] = trim($params);
				$i++;
			}

		}
	}
	
	return $actionsArray;
}

## --------------------------------------------------------

function callActions ($actionsArray, $imageLibObj, $allowedActionsArray)
#
#	Author:		Jarrod Oberto
#	Date:		May 11
#	Purpose:	Call actions to be applied to image
#	Params in:	(array) $actionsArray: The actions and their parameters
#				(obj) $imageLibObj: The image object
#				(array) $allowedActionsArray: A list of allowed methods to be 
#					called.
#	Params out: n/a
#	Notes:	
#		
{

	if (count($actionsArray) > 0) {

		foreach ($actionsArray as $action => $params) {

			$action = removeActionId($action);
			
			$paramsArray = explode(',', $params);
			$paramsArray = array_map('trim', $paramsArray);
						
			if (in_array($action, $allowedActionsArray) && method_exists($imageLibObj, $action)) {
				
				// *** Call action		
				if ($paramsArray[0] == '') {
					@call_user_func_array(array($imageLibObj, $action), array());
				} else {
					@call_user_func_array(array($imageLibObj, $action), $paramsArray );
				}
			}
		}
	}	
}

## --------------------------------------------------------

function getCacheCodes($actionsArray) 
#
#	Author:		Jarrod Oberto
#	Date:		May 11
#	Purpose:	Uniquely identify a cached action by generating a code specific
#				to a particular action
#	Params in:	(array) $actionsArray: an array of actions and there parameters
#	Params out:	(str) A code defining the specified paramaters and there actions
#	Notes:	
#
{
	
	$code = '';
		
	if (count($actionsArray) > 0) {
		
		foreach ($actionsArray as $action => $params) {

			$action = removeActionId($action);

			switch($action) {

				case 'greyscale':
					$code .= '.1' . $params; 	
					break;
				case 'greyScaleDramatic':
					$code .= '.12' . $params; 	
					break;				
				case 'greyScaleEnhanced':
					$code .= '.13' . $params; 	
					break;				
				case 'blackAndWhite':
					$code .= '.2' . $params; 
					break;
				case 'sepia':
					$code .= '.3' . $params; 
					break;
				case 'negative':
					$code .= '.4' . $params; 
					break;
				case 'rotate':
					$code .= '.5' . $params; 
					break;
				case 'addText':
					$code .= '.6' . $params; 
					break;
				case 'addBorder':
					$code .= '.7' . $params; 
					break;
				case 'addReflection':
					$code .= '.8' . $params; 
					break;
				case 'roundCorners':
					$code .= '.9' . $params; 
					break;
				case 'addShadow':
					$code .= '.10' . $params; 
					break;
				case 'addCaptionBox':
					$code .= '.11' . $params; 
					break;
				case 'vintage':
					$code .= '.14' . $params; 
					break;

				default:
					break;
			}
		}
	}
	
	return $code;		
}

## --------------------------------------------------------

function removeActionId($action)
#	Purpose:	Removes the '-n' at the end of the action
{
	$pos = strrpos($action, '-');
	$action = substr($action, 0, $pos);
	
	return $action;
}

## --------------------------------------------------------

function checkStringStartsWith($needle, $haystack) 
#	Check if a string starts with a specific pattern
{
	return (substr($haystack, 0, strlen($needle))==$needle);
}

## --------------------------------------------------------

function outputImage($filenameHash, $ext, $cachePath)
#
#	Author:		Jarrod Oberto
#	Date:		May 11
#	Purpose:	Output image to browser
#	Params in:  (str) $filenameHash: the cached filename
#				(str) $ext: the file extension to save the image as
#				(str) $cachePath: the path of the cached directory
#	Params out:
#	Notes:	
#		
{
	// *** Read file to string
	$img = file_get_contents($cachePath . '/' . $filenameHash . '.' . $ext);

	switch($ext)
	{
		case 'jpg':
		case 'jpeg':
			header('Content-type: image/jpeg');

			break;
		case 'gif':
			header('Content-type: image/gif');
	
			break;
		case 'png':
			header('Content-type: image/png');

			break;
		case 'bmp':
			//echo 'bmp file format is not supported.';
			break;

		// ... etc

		default:
			// *** No extension - No save.
			break;
	}
		
		// *** Output 
		header('Content-Length: ' . strlen($img));
		echo $img;
		exit();		
}
?>
