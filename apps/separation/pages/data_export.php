<?php
/**
* Statistics export
*
* @package    Job Freelance
* @subpackage controller
* @version    1.0
* @date       15 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));

$exploration = $ws->argPost('exploration');

if (empty($exploration)) {
	$exploration = 7;
}

$flagAdmin = false;
if ($ws->connected() and ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
	$flagAdmin = true;
}

if ($flagAdmin) {
	$visitor = new object_visitor();
	$list = $visitor->getListNavigation($exploration);
	$fileName = 'separation_data' . '-' . dateFormat('YYYYMMdd') . '.xlsx';

	$headerStyle = (new \OneSheet\Style\Style())
		->setFontSize(13)
		->setFontBold()
		->setFontColor('FFFFFF')
		->setFillColor('777777');

	$writer = new \OneSheet\Writer(null, 'Navigation');
	$writer->addRow(['Date', 'Visiteur', 'Page', 'Url'], $headerStyle);
	foreach($list as $item) {
		$writer->addRow($item);
	}

	// create initial writer instance with sheet name
//	$writer = new \OneSheet\Writer(null, 'Invoices');
//	$writer->enableCellAutosizing(); // enable for current sheet
//	$writer->addRow(['InvoiceNo', 'Amount', 'CustomerNo']);
//	$writer->addRow(['']); // add empty row bcs fancy :D
//	$writer->addRow(['I-123', 123.45, 'C-123']);

	// create new sheet with specific sheet name
//	$writer->switchSheet('Refunds');
//	$writer->enableCellAutosizing(); // enable for current sheet
//	$writer->addRow(['RefundNo', 'Amount', 'InvoiceNo']);
//	$writer->addRow(['']); // add empty row bcs fancy :D
//	$writer->addRow(['R-123', 123.45, 'I-123']);

	// create another sheet with specific sheet name
//	$writer->switchSheet('Customers');
//	$writer->enableCellAutosizing(); // enable for current sheet
//	$writer->addRow(['CustomerNo', 'FirstName', 'LastName']);
//	$writer->addRow(['']); // add empty row bcs fancy :D
//	$writer->addRow(['C-123', 'Bob', 'Johnson']);

	// send file to browser for downloading 
//	$writer->writeToBrowser();
	$writer->writeToBrowser($fileName);

//	header('Content-Type: application/vnd.ms-excel'); 
//	header('Content-Disposition: attachment;filename="' . $fileName . '"'); 
//	header('Cache-Control: max-age=0'); 
//	flush(); // Envoie le buffer
//	readfile($fileName); // Envoie le fichier

//	if (function_exists('mb_internal_encoding')) {
//		mb_internal_encoding($oldEncoding);
//	}
	exit;
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>