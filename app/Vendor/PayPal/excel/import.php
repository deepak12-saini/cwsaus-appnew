<?php
ini_set('max_execution_time', 3000); //300 seconds = 5 minutes
require 'Classes/PHPExcel/IOFactory.php';

class excel {

	function upload($inputfilename){
		
		//$inputfilename = 'transactions-1.xls';
		$exceldata = array();

		//  Read your Excel workbook
		try
		{
			$inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
			$objReader = PHPExcel_IOFactory::createReader($inputfiletype);
			$objPHPExcel = $objReader->load($inputfilename);
		}
		catch(Exception $e)
		{
			die('Error loading file "'.pathinfo($inputfilename,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
		//$highestColumn = 'K';
		$rowData = array();
		//  Loop through each row of the worksheet in turn
		//for ($row = 2; $row <= $highestRow; $row++)
		for ($row = 2; $row <= $highestRow; $row++)
		{ 
			//  Read a row of data into an array
			$rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			
		}
		
		return $rowData;
	}

	
}

?>

						
