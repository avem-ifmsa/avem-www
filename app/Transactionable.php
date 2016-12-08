<?php

namespace App;

interface Transactionable
{
	public function getTransactionConceptAttribute();
	public function getTransactionPointsAttribute();
}
