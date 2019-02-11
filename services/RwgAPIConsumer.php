<?php
namespace Services;
use GuzzleHttp;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
/**
 * Consumes the current RWG Test API
 */
class RwgAPIConsumer implements APIConsumer
{

	/*
	 * getAPI Function
	 * Open a Guzzle Client GET request to API end point
	 * @return null | Object an Object with arrays.
	 */
	public function getAPI()
	{
		$client = new GuzzleHttp\Client();

		try
		{
			$response = $client->request('GET', 'http://hiring.rewardgateway.net/list', [
				'auth' => ['hard', 'hard']
			]);
		}
		catch (RequestException $e) {
			return $this->handleErrors($e);
		}
		return json_decode( $response->getBody(), true);
	}

	/*
	 * handleErrors Function
	 * Log the exception if a response exists or timed out.
	 * @param Object $exception a type of GuzzleHttp\Exception\RequestException.
	 * @return Object a time object to identify error in logs.
	 */
	public function handleErrors($exception)
	{
		$timestamp = time();

		if ($exception->hasResponse()) {
			logger( 'Timestamp:'.$timestamp. Psr7\str($exception->getResponse()) );
			return $timestamp;
		}

		$error = 'Timestamp:'.$timestamp.'HTTP Code: 408, The Response has timed out. Request was sent:'.
			Psr7\str($exception->getRequest());
		logger($error);
		return $timestamp;
	}
}