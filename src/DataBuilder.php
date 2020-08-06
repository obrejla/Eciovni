<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


use Nette\SmartObject;

/**
 * @deprecated since 2020-08-06, please use DataImpl::from().
 */
class DataBuilder
{
	use SmartObject;

	/** @var DataImpl */
	private $data;


	/**
	 * @deprecated since 2020-08-06, please use DataImpl::from()
	 * @param ItemImpl[] $items
	 */
	public function __construct(string $id, string $title, Participant $supplier, Participant $customer, \DateTime $expirationDate, \DateTime $dateOfIssuance, array $items)
	{
		trigger_error(__METHOD__ . ': This method is deprecated, please use native ' . DataImpl::class . '::from().');
		$this->data = DataImpl::from($id, $title, $supplier, $customer, $expirationDate, $dateOfIssuance, $items);
	}


	public function build(): DataImpl
	{
		return $this->data;
	}
}
