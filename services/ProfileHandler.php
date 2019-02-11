<?php
namespace Services;


class ProfileHandler
{
	/*
	 * getProfileData function
	 * Requires RwgAPIConsumer class to get data from api,
	 * then executes cleanseData if array is returned.
	 * @return view & array
	 */
	public function getProfileData()
	{
		$consumer = new RwgAPIConsumer();
		$response = $consumer->getAPI();

		if( !is_array($response) )
		{
			//return the error view with response error timestamp
			return view('error',['error'=>$response]);
		}

		return view('feed',['profiles'=>$this->cleanseData($response)]);
	}

	/*
	 * cleanseData function
	 * Cleans the bio and avatar links for website.
	 * @profiles array | object
	 * @return array $profile
	 */
	private function cleanseData($profiles)
	{
		foreach ($profiles as $id => $profile)
		{
			$profiles[$id]['bio'] = $this->cleanBio($profile['bio']);
			$profiles[$id]['avatar'] = $this->getAvatar($profile['avatar']);

		}
		return $profiles;
	}

	/*
	 * cleanBio function
	 * Cleans bio of HTML and JS.
	 * @bio string
	 * @return string $string
	 */
	private function cleanBio($bio)
	{
		$string = strip_tags($bio);
		$string = str_replace('alert(1);','',$string);
		$string = strlen($string) == 1 ?  '' : $string;
		return $string;
	}


	/*
 	* getAvatar function
 	* replaces invalid / inactive urls
 	* @avatar string
 	* @return string $avatar
 	*/
	private function getAvatar($avatar)
	{
		if($avatar == 'http://httpstat.us/503' || $avatar == "0")
		{
			return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADsklEQVRYR63XdwincxwH8NeZGWXGnRWZiSJ/kGRlJMqI0+FynSI7skpmnGzJzChd54pkZkUJ2WVE6cqR7BHK3r2v76Pnfvc83+e5zqd+f/z6fcb795nv7xTjZXUciL2xAzbHGvgHP+ADvIln8QR+GuN6ygilzXAOZuIPPIc38CG+L/ZrYgvshD2xHO7BVfi4FqMGYGWcj3PxMm7A4/h9AHTsDsKZBdAcXFHAL2HaB2ATPIB1cHJJ6YhkLaYS3wFyEz7D4fh00kkXgG3wDF7HrFLfLrv0wMblh/fwVQ/CtTAX22NfLGjrTQLIP38JT+IE/DXhNPqn4qxW8Kj8jWtxIX7tALIC7ir9sWs7E20Aqd2L+KSkazJ4/N6Mkyq1+BkX4+oeEA9hbezR9EQbwKU4Bjv2pD0dnu4fIweULE7qJvhbuB2X58cGQEbtfRxSabh08nljouNeHN2jmxjzsWWy3QC4FduW1PTFuL+UZgyG17Bzj2Jips/S5KflSzbcFyX9qVGfPFgyNAbAq9ilojgdd2BqAByJ27D+wJK5E8eNiY78kUMruquUsZ0ZAGmI9QYM4uvsslrHYLikTENNN1t1YQAkXY80XVmx2A9PjYmO/fH0gG6mbq8A+CbNUDq3ZrM0JUhJTxwAcGxuRADkwh1cDk3NJqU6fmQGsv+zMWuSmPMDINcts5ma1CSLKCXIgarJ19gH7wzoJea8AIjB6SNKEH/Ry1muSa7nLSMylUM3JwBeKf8+TTEkOVYLsXyP4p/YtOvsduhfht0DIFtwg9IHQwDy+3U4o0fx+kJExvjJxV0QACEKOZXZBb+NsEwPZHK6JMusjxe09VctpZ8RAKuVVZyahAUNSS7atz1KU/HlkAPMKH0yrTlGGZuc4d0Ky635SI1DSLtk60nG06GUmDlWL6RcDYA0V6jSEXi0Ej3MJmz3qB6d+8pRy27pk5Q8PsKiP28TktCpHJtw/u8mrBM4cxudcLuavIvcglzPSVa1Lt7GjbgyTtoAVsTzpb4JlpHKdISCzca0EbVtq4QB311qnXMf/48hlzCPm/hfDEC+b1jIQuoTo1MQrrgsEpKa5ZXeCUkJKY3vRdJFy7cqr590+7IGb+JkvDO6IaN5wv0nfQ+TZOJhbPc/gPilENHD2v+8loHmt9QsJPSCMporLWUdfix1v6i8GRbVfFLGPE43KkDSiAEVm9otSIzUPZzvmvIs68U+BkBjnO4N08knhDNNlS0ayYPko/KwCRPKp+uFtASQfwFMNb0ytvWaBAAAAABJRU5ErkJggg==";
		}
		return $avatar;
	}
}