<?php

/**
 * InvoicePresenter - example of usage of Invoice control plugin for Nette Framework
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Nette-InvoiceControl
 * @package    Nette\Extras
 * @version    0.4
 */
class InvoicePresenter {
    
    public function actionGenerate() {
        /*
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * HERE starts the code, which you have to put in YOUR action. *
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         */

        // Creating new Invoice
        $invoice = new InvoiceControl(date('YmdHis'), 'Invoice - invoice number');

        // Definition of miscellaneous attributes
        $invoice->setVariableSymbol('1234');

        // Definition of DateTimes
        $dateNow = new DateTime();
        $invoice->setDateOfIssuance($dateNow);
        $dateExp = new DateTime();
        $dateExp->modify('+14 days');
        $invoice->setExpirationDate($dateExp);
        $invoice->setDateOfVatRevenueRecognition($dateNow);

        // Definition of Participants
        $supplier = new InvoiceParticipantImpl('John Doe', 'Nowhere', '11', 'Prague 3', '13000', '12345678', 'CZ12345678', '123456789 / 1111');
        $customer = new InvoiceParticipantImpl('Jane Doe', 'Somewhere', '3', 'Prague 9', '19000', '', '', '123456789 / 1111');
        $invoice->setSupplier($supplier);
        $invoice->setCustomer($customer);

        // Definition of Items
        $item = new InvoiceItemImpl('Test item 1', 1, 900, 1.19, TRUE);
        $invoice->addItem($item);

        $invoice->addItems(array(
            new InvoiceItemImpl('Test item 2', 1, 900, 1.19, TRUE),
            new InvoiceItemImpl('Test item 3', 1, 900, 1.19, TRUE),
        ));

        // Definition of new mPDF
        // Set constant and include according to your directories!!
        define('_MPDF_PATH', LIBS_DIR . '/mpdf2_5/');
        include_once(LIBS_DIR . '/mpdf2_5/mpdf.php');
        $mpdf = new mPDF('utf-8');

        // Exporting prepared Invoice to PDF
        // (use second and third parameter for saving invoice as a file - same parameters like mPDF->Output())
        $invoice->exportToPdf($mpdf);

        /*
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * HERE ends the code, which you have to put in YOUR action. *
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         */

    }

}

