<?php

namespace OndrejBrejla\NetteInvoiceControl;

/**
 * InvoicePresenter - example of usage of Invoice control plugin for Nette Framework
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Nette-InvoiceControl
 */
class InvoicePresenter {

    public function actionGenerate() {
        /*
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * HERE starts the code, which you have to put in YOUR action. *
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         */

        // Creating new Invoice
        $invoice = new InvoiceControl(date('YmdHis'), 'Faktura - daňový doklad č.');

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
        $supplierBuilder = new ParticipantBuilder('Jan Vosáhlo', 'Českobratrská', '11', 'Praha 3 - Žižkov', '13000');
        $supplier = $supplierBuilder->setIn('12345678')->setTin('CZ12345678')->setAccountNumber('123456789 / 1111')->build();
        $customerBuilder = new ParticipantBuilder('Pepa Pivrnec', 'Někde', '3', 'Praha 9 - Prosek', '19000');
        $customer = $customerBuilder->setAccountNumber('123456789 / 1111')->build();
        $invoice->setSupplier($supplier);
        $invoice->setCustomer($customer);

        // Definition of Items
        $item = new ItemImpl('Testovací item 1', 1, 900, 1.19, TRUE);
        $invoice->addItem($item);

        $invoice->addItems(array(
            new ItemImpl('Testovací item 2', 1, 900, 1.19, TRUE),
            new ItemImpl('Testovací item 3', 1, 900, 1.19, TRUE),
        ));

        // Definition of new mPDF
        // Set constant and include according to your directories!!
        define('_MPDF_PATH', LIBS_DIR . '/mpdf2_5/');
        include_once(LIBS_DIR . '/mpdf2_5/mpdf.php');
        //iso...don't know why...utf-8 didn't work
        $mpdf = new mPDF('iso-8859-2');

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

