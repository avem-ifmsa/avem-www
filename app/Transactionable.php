<?php

interface Transactionable
{
	function getTransactionConceptAttribute();
	function getTransactionPeriodAttribute();
	function getTransactionPointsAttribute();
};
