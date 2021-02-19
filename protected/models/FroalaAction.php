<?php

class FroalaAction extends CFormModel
{
	public $directoryName;
	public $urlupload;
	public $allowedExts;
	public $allowedMimeTypes;
	public $fieldname;
	public $genfiename = true;

	public function rules()
	{
		return array(
			array('directoryName, urlupload, allowedExts, allowedMimeTypes', 'required'),
		);
	}

	public function upload_file(){
		try{
			if(!is_dir($this->directoryName)){
				mkdir($this->directoryName , 0755, true);
			}
			$fileRoute = $this->directoryName;
			$fieldname = ($this->fieldname == null) ? "file" : $this->fieldname ; 
			$filename = explode(".", $_FILES[$fieldname]["name"]); 
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$tmpName = $_FILES[$fieldname]["tmp_name"];
			$mimeType = finfo_file($finfo, $tmpName);
			$extension = end($filename);
			
			if (!in_array(strtolower($mimeType), $this->allowedMimeTypes) || !in_array(strtolower($extension), $this->allowedExts)){
				Yii::app()->session['errmsg_upload']='error File does not meet the validation.';
				return false;
			}
			
			if ($this->genfiename == true)	$name = sha1(microtime()).".".$extension; else $name = $_FILES[$fieldname]["name"];
			$fullNamePath = $fileRoute . $name; 
			
			move_uploaded_file($tmpName, $fullNamePath);
			$response = new \StdClass;
			$response->link =  $this->urlupload.$name;
			$response->name =  $name;
			
			Yii::app()->session['successmsg_upload'] = stripslashes(json_encode($response)) ;
			return true;
		}catch(Exception $e){
			Yii::app()->session['errmsg_upload']='error '.$e->getMessage();
			return false;
		}
	}
}