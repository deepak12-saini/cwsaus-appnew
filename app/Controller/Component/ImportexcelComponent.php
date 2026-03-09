<?php 

App::import('Vendor','excel',array('file'=>'excel/import.php'));

class ImportexcelComponent extends Component
{
    var $controller;
 		
		function __construct(){	
		      
	 
	}
	
	function import_data($filename)
	{
		 $path=$_SERVER['DOCUMENT_ROOT'].'/ezfiduciary/app/webroot/ezfid_files/';
		//  Read your Excel workbook
		$inputfilename=$path.$filename;
		
		$excel = new excel();
		
		$response = $excel->upload($inputfilename);
		return 	$response;
		
	}
	
	
	
}
?>