<?php

    /*
     *  Author:     Jarrod Oberto
     *  File name:  Image Tools with BMP support 
     *  Purpose:    Batch process a folder of images
     *  Requires:   
     *	Version:    1.0
     *  
     *  Modificatoin history
     *  Date      Initials  Ver	 Description
     *  Jun 11	  JCO       1.0	 * First build 
     *							
     *
     */

require_once('image_lib_class.php');

class imageBatch
{
	private $sourceFolder = '';
	private $actionsArray = array();
	private $fileTypeFilterArray = array();
	
	
	public function __construct ($sourceFolder, $fileTypeFilterArray=array('jpg', 'png', 'gif', 'bmp', 'psd'))
	#	If $readFileTypesArray is empty then read all image types
	{
		$this->sourceFolder = $sourceFolder;

		if (is_array($fileTypeFilterArray)) {
			$this->fileTypeFilterArray = $fileTypeFilterArray;
		} else {
			$fileTypeFilterTempArray = explode(',', $fileTypeFilterArray);
			$fileTypeFilterTempArray = array_map('trim', $fileTypeFilterTempArray);
			$this->fileTypeFilterArray = $fileTypeFilterTempArray;
		}
	
		DEFINE ('FOLDER_MUST_BE_EMPTY', false);		
	}
	
	## --------------------------------------------------------
	
	public function __call($name, $arguments)
	{
		$this->actionsArray[] = $name . '(' . implode(', ', $arguments) . ')';
	}
	
	## --------------------------------------------------------
	
	public function save($outputFolder, $quality=100, $saveType='sameAs')
	{
		// *** Check source folder
		$this->checkSourceFolder($this->sourceFolder);
		
		// *** Check the output folder
		$this->checkOutputeFolder($outputFolder);
				
		// *** Read in image files
		$readFileTypes = $this->prepareFileTypes($this->fileTypeFilterArray);
		
		$filesArray = $this->readFiles($this->sourceFolder, $readFileTypes);
			
		// *** Process
		$this->process($filesArray, $this->actionsArray, $outputFolder, $saveType, $quality);			
	}
	

	/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- 
	 * 	
	 *	PRIVATE METHODS
	 * 
	 */

	private function checkSourceFolder($sourceFolder)
	{
			
		// *** Check source folder exists
		if (!file_exists($sourceFolder)) {
			echo 'The source folder <em>' . $sourceFolder . '</em> is missing.';
			exit;
		}
		
		if (!is_readable($sourceFolder)) {
			echo 'The source folder <em>' . $sourceFolder . '</em> is not readable <br /> Please check the permissions.';
			exit;			
		}		
		
		if ($this->countFiles($sourceFolder) == 0) {  
			echo 'The source folder is empty.';
			exit;
		}
		
	}
	
	## --------------------------------------------------------	
	
	private function checkOutputeFolder($outputFolder)
	{
		// *** Check the folder exists
		if (!file_exists($outputFolder)) {
			
			if (!$this->createDir($outputFolder, 0777)) {
				echo 'The output folder <em>' . $outputFolder . '</em> is missing.';
				exit;
			}
		}	
		
		if (!is_writable($outputFolder)) {
			echo 'The output folder <em>' . $outputFolder . '</em> is not writable. <br /> Please check the permissions.';
			exit;			
		}	
		
		if ($this->countFiles($outputFolder) > 0 && FOLDER_MUST_BE_EMPTY) {  
			echo 'The output folder is not empty.';
			exit;
		}		
	}
	
	## --------------------------------------------------------	
	
	private function prepareFileTypes($readFileTypesArray) 
	{
		// *** Remove the '.' in '.jpg' (incase the user added it.
		$readFileTypesArray = array_map('ltrim', $readFileTypesArray, array_fill(0, count($readFileTypesArray), '.') );
		
		$readFileTypes = '';
		foreach ($readFileTypesArray as $type) {
			
			$readFileTypes .= '*.' . $type . ',';
		}
				
		$readFileTypes = trim($readFileTypes, ',');
		$readFileTypes = '{' . trim($readFileTypes) . '}';
		
		return $readFileTypes;
	}
	
	## --------------------------------------------------------
	
	private function readFiles($sourceFolder, $readFileTypes) 
	{
		$filenameArray = glob($sourceFolder . "/" . $readFileTypes, GLOB_BRACE);

		return $filenameArray;
	}
	
	## --------------------------------------------------------
	
	private function process($filesArray, $actionsArray, $outputFolder, $saveType, $quality)
	{
		// *** Loop through each image
		foreach ($filesArray as $filename) {

			// *** Get the file/path info
			$pathInfoArray = pathinfo($filename);
			
			// *** Create new image tools object
			$imageLibObj = new imageLib($filename);
			
			// *** Loop through each action to apply
			foreach ($actionsArray as $action) {
				
				// *** Split action into action/params
				$actionArray = $this->splitActionAndParams($action);
				$action = key($actionArray); 
				$params = $actionArray[$action];
				$paramsArray = explode(',', $params);
				$paramsArray = array_map('trim', $paramsArray);				
								
				// *** If the action exists...
				if (method_exists($imageLibObj, $action)) {

					// *** ...Call the action		
					if ($paramsArray[0] == '') {
						@call_user_func_array(array($imageLibObj, $action), array());
					} else {
						@call_user_func_array(array($imageLibObj, $action), $paramsArray );
					}
				}				
				
			}			
			
			// *** Get filename
			if (strtolower($saveType) == 'sameas' || $saveType == '') {				
				$ext = $pathInfoArray['extension'];
			} else {
				$ext = $saveType;
			}
			
			// *** Get path
			$saveAs = $outputFolder . '/' . $pathInfoArray['filename'] . '.' . $ext;
			
			// *** Save image
			$imageLibObj -> saveImage($saveAs, $quality);
			
			unset($imageLibObj);
		}
	
	}
	
	## --------------------------------------------------------	
	
	function createDir ($path, $permissions=0755) 
	#
	#	Author:		Jarrod Oberto
	#	Date:		May 11
	#	Purpose:	Attempt to create the dir should it not exist
	#	Params in:	(str) $path: path of directory to create
	#				(int) $permissions: the folder permissions to set
	#	Params out:
	#	Notes:	
	#		
	{
		if(!file_exists($path)) {
			$result = @mkdir($path, $permissions, true);
			@chmod($path, $permissions);			
		} 

		return $result;
	}	
	
	## --------------------------------------------------------
	
	private function countFiles($folder) 
	{
		$files = array();
		$directory = opendir($folder);
		while ($item = readdir($directory)) {
			
			// *** We filter the elements that we don't want to appear ".", ".." and ".svn"
			if (($item != ".") && ($item != "..") && ($item != ".svn")) {
				
				$files[] = $item;
			}
		}
		$numFiles = count($files);
		
		return $numFiles;
	}
	
	## --------------------------------------------------------

	private function splitActionAndParams ($action)
	#
	#	Author:		Jarrod Oberto
	#	Date:		May 11
	#	Purpose:	Seperates the actions into a key/pair array with action being 
	#				the key and params being the associate
	#	Params in:	(str) $actionsArray: the actions as inputted by the user
	#	Params out: (array) the action/param key pair array
	#	Notes:	
	#
	{
		$actionAndParamsArray = array();
		
		$actionTemp = $action;
		
		if (trim($action) != '') {

			$pos = strpos($action, '(');

			if ($pos !== false) {
			
				$actionExtract = substr($action, 0, $pos);
				$paramsExtract = substr($action, $pos);

				$paramsExtract = trim($paramsExtract, '(');
				$paramsExtract = trim($paramsExtract, ')');

				// *** Store in a array. The '-n' is added to make key unique as to
				//   * allow the same action to be called
				$actionAndParamsArray[$actionExtract] = trim($paramsExtract);

			}

		}
		return $actionAndParamsArray;
	}	
}

?>
