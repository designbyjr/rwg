<?php

namespace App\Http\Controllers;
use Services\ProfileHandler;


class FeedController extends Controller
{
    public function getFeed()
	{
		$handler = new ProfileHandler();
		return $handler->getProfileData();
	}
}
