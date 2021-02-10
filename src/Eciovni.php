<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


use Latte\Engine;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

class Eciovni
{
	private DataImpl $data;

	private string $templatePath;

	/**
	 * Ratio between supplier and customer.
	 * | ratio <---> (100 - ratio) |
	 */
	private int $contactSizeRatio = 40;

	private ?string $stampPath = null;


	public function __construct(DataImpl $data)
	{
		$this->data = $data;
		$this->templatePath = __DIR__ . '/Eciovni.latte';
	}


	public function setTemplatePath(string $templatePath): void
	{
		if (\is_file($templatePath) === false) {
			throw new \InvalidArgumentException('Template path "' . $templatePath . '" does not exist.');
		}

		$this->templatePath = $templatePath;
	}


	/**
	 * Stamp path to PNG, JPG or GIF image with stamp.
	 */
	public function setStampPath(?string $stampPath): void
	{
		if ($stampPath !== null && \is_file($stampPath) === false) {
			throw new \InvalidArgumentException('Stamp path "' . $stampPath . '" does not exist.');
		}

		$this->stampPath = $stampPath;
	}


	/**
	 * Exports Invoice template via passed mPDF.
	 *
	 * @param mixed[] $params
	 * @throws MpdfException
	 */
	public function exportToPdf(?string $name = null, ?string $dest = null, array $params = []): ?string
	{
		$mpdf = new Mpdf;
		$mpdf->WriteHTML($this->getEngine()->renderToString($this->templatePath, array_merge($this->computeParams(), $params)));

		$result = null;
		if ($name !== null && $dest !== null) {
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
	 *
	 * @param mixed[] $params
	 */
	public function render(array $params = []): void
	{
		$this->getEngine()->render($this->templatePath, array_merge($this->computeParams(), $params));
	}


	/**
	 * Renderers the invoice to the defined template.
	 *
	 * @throws IllegalStateException If data has already been set.
	 */
	public function renderData(DataImpl $data): void
	{
		$this->data = $data;
		$this->render();
	}


	public function setContactSizeRatio(int $contactSizeRatio): void
	{
		if ($contactSizeRatio < 1 || $contactSizeRatio > 99) {
			throw new \InvalidArgumentException('Contact size ratio must be between 1 and 99.');
		}

		$this->contactSizeRatio = $contactSizeRatio;
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
			'paymentMethod' => $this->data->getPaymentMethod() ?? 'převodem',
			'contactSizeRatio' => $this->contactSizeRatio,
			'stampPath' => $this->stampPath,
			'textBottom' => $this->data->getTextBottom(),
			'unit' => $this->data->getUnit(),
			// supplier
			'supplierName' => $supplier->getName(),
			'supplierStreet' => $supplier->getStreet(),
			'supplierHouseNumber' => $supplier->getHouseNumber(),
			'supplierCity' => $supplier->getCity(),
			'supplierZip' => $supplier->getZip(),
			'supplierIn' => $supplier->getIn(),
			'supplierTin' => $supplier->getTin(),
			'supplierAccountNumber' => $supplier->getAccountNumber(),
			'supplierAddressDescription' => $supplier->getSupplierAddressDescription(),
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
			'createdDate' => $this->data->getCreatedDate(),
			'dueDate' => $this->data->getDueDate(),
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


	private function countFinalUntaxedValue(): float
	{
		$sum = 0;
		foreach ($this->data->getItems() as $item) {
			$sum += $item->countUntaxedUnitValue() * $item->getCount();
		}

		return $sum;
	}


	private function countFinalTaxValue(): float
	{
		$sum = 0;
		foreach ($this->data->getItems() as $item) {
			$sum += $item->countTaxValue();
		}

		return $sum;
	}


	private function countFinalValues(): float
	{
		$sum = 0;
		foreach ($this->data->getItems() as $item) {
			$sum += $item->countFinalValue();
		}

		return $sum;
	}


	private function getEngine(): Engine
	{
		return (new Engine)
			->addFilter('round', static fn (float $value, int $precision = 2) => number_format(round($value, $precision), $precision, ',', ' '));
	}
}
