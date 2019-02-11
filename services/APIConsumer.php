<?php
namespace Services;

interface APIConsumer {
	function getAPI();

	function handleErrors($exception);
}