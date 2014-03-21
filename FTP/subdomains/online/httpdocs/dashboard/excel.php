<html>
<head>
<title>ThaiCreate.Com PHP(COM) Excel.Application Tutorial</title>
</head>
<body>
<?
	
	//*** Get Document Path ***//
	$strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"]))); // C:/AppServ/www/myphp

	//*** Excel Document Root ***//
	$strFileName = "MyXls/MyExcel.xls";

	//*** Connect to Excel.Application ***//
	$xlApp = new COM("Excel.Application");
	$xlBook = $xlApp->Workbooks->Add();
	$xlSheet1 = $xlBook->Worksheets(1);
	$xlApp->Application->Visible = False;	


	//*** Sheet 1 ***//
	$xlSheet1->Name = "My Sheet1";

	//*** Write text to Row 1 Column 1 ***//		
	$xlApp->ActiveSheet->Cells(1,1)->Value = "ThaiCreate.Com";
	
	//*** Write text to Row 1 Column 2 ***//
	$xlApp->ActiveSheet->Cells(1,2)->Value = "Mr.Weerachai Nukitram";
	
	@unlink($strFileName); //*** Delete old files ***//	

	$xlBook->SaveAs($strPath."/".$strFileName); //*** Save to Path ***//
	//$xlBook->SaveAs(realpath($strFileName)); //*** Save to Path ***//

	//*** Close & Quit ***//
	$xlApp->Application->Quit();
	$xlApp = null;
	$xlBook = null;
	$xlSheet1 = null;
?>
Excel Created <a href="<?=$strFileName?>">Click here</a> to Download.
</body>
</html>