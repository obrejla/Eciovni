<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


use Latte\Engine;
use mPDF;

/**
 * Eciovni - plugin for Nette Framework for generating invoices using mPDF library.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class Eciovni
{

	/** @var Data */
	private $data;

	/** @var string */
	private $templatePath;


	/**
	 * @param Data|null $data
	 */
	public function __construct(?Data $data = null)
	{
		if ($data !== null) {
			$this->setData($data);
		}

		$this->templatePath = __DIR__ . '/Eciovni.latte';
	}


	/**
	 * Setter for path to template
	 *
	 * @param string $templatePath
	 */
	public function setTemplatePath(string $templatePath): void
	{
		$this->templatePath = $templatePath;
	}


	/**
	 * Exports Invoice template via passed mPDF.
	 *
	 * @param mPDF $mpdf
	 * @param string|null $name
	 * @param string|null $dest
	 * @return string|null
	 */
	public function exportToPdf(mPDF $mpdf, ?string $name = null, ?string $dest = null): ?string
	{
		$mpdf->WriteHTML((new Engine)->renderToString($this->templatePath, $this->computeParams()));

		$result = null;
		if ($name !== '' && $dest !== null) {
			$result = $mpdf->Output($name, $dest);
		} elseif ($dest !== null) {
			$result = $mpdf->Output('', $dest);
		} else {
			$result = $mpdf->Output($name, $dest);
		}

		return $result;
	}


	/**
	 * Renderers the invoice to the defined template.
	 */
	public function render(): void
	{
		(new Engine)->render($this->templatePath, $this->computeParams());
	}


	/**
	 * Renderers the invoice to the defined template.
	 *
	 * @param Data $data
	 * @throws IllegalStateException If data has already been set.
	 */
	public function renderData(Data $data): void
	{
		$this->setData($data);
		$this->render();
	}


	/**
	 * Sets the data, but only if it hasn't been set already.
	 *
	 * @param Data|null $data
	 * @throws IllegalStateException If data has already been set.
	 */
	private function setData(?Data $data = null): void
	{
		if ($this->data !== null) {
			throw new IllegalStateException('Data have already been set!');
		}

		$this->data = $data;
	}


	/**
	 * @return mixed[]
	 */
	private function computeParams(): array
	{
		$supplier = $this->data->getSupplier();
		$customer = $this->data->getCustomer();

		return [
			// basic info
			'title' => $this->data->getTitle(),
			'id' => $this->data->getId(),
			'items' => $this->data->getItems(),
			// supplier
			'supplierName' => $supplier->getName(),
			'supplierStreet' => $supplier->getStreet(),
			'supplierHouseNumber' => $supplier->getHouseNumber(),
			'supplierCity' => $supplier->getCity(),
			'supplierZip' => $supplier->getZip(),
			'supplierIn' => $supplier->getIn(),
			'supplierTin' => $supplier->getTin(),
			'supplierAccountNumber' => $supplier->getAccountNumber(),
			// customer
			'customerName' => $customer->getName(),
			'customerStreet' => $customer->getStreet(),
			'customerHouseNumber' => $customer->getHouseNumber(),
			'customerCity' => $customer->getCity(),
			'customerZip' => $customer->getZip(),
			'customerIn' => $customer->getIn(),
			'customerTin' => $customer->getTin(),
			'customerAccountNumber' => $customer->getAccountNumber(),
			// dates
			'dateOfIssuance' => $this->data->getDateOfIssuance(),
			'expirationDate' => $this->data->getExpirationDate(),
			'dateOfVatRevenueRecognition' => $this->data->getDateOfVatRevenueRecognition(),
			// symbols
			'variableSymbol' => $this->data->getVariableSymbol(),
			'specificSymbol' => $this->data->getSpecificSymbol(),
			'constantSymbol' => $this->data->getConstantSymbol(),
			// final values
			'finalUntaxedValue' => $this->countFinalUntaxedValue(),
			'finalTaxValue' => $this->countFinalTaxValue(),
			'finalValue' => $this->countFinalValues(),
		];
	}


	/**
	 * Counts final untaxed value of all items.
	 *
	 * @return float
	 */
	private function countFinalUntaxedValue(): float
	{
		$sum = 0;
		foreach ($this->data->getItems() as $item) {
			$sum += $item->countUntaxedUnitValue() * $item->getUnits();
		}

		return $sum;
	}


	/**
	 * Counts final tax value of all items.
	 *
	 * @return float
	 */
	private function countFinalTaxValue(): float
	{
		$sum = 0;
		foreach ($this->data->getItems() as $item) {
			$sum += $item->countTaxValue();
		}

		return $sum;
	}


	/**
	 * Counts final value of all items.
	 *
	 * @return float
	 */
	private function countFinalValues(): float
	{
		$sum = 0;
		foreach ($this->data->getItems() as $item) {
			$sum += $item->countFinalValue();
		}

		return $sum;
	}
}