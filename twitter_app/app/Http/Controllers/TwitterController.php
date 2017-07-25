<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Twitter;
use \File;

class TwitterController extends Controller
{

	private $count = 10;
	private $format = 'array';
    public function twitterUserTimeline()
    {
    	$data = Twitter::getUserTimeline(['count' => $this->count, 'format' => $this->format]);

    	return view('twitter')->with('data', $data);
    }

    public function tweet(Request $request)
    {
    	$this->validate($request, array(
    		'tweet' => 'required'
    	));

    	$newTweet = ['status' => $request->tweet];

    	if (!empty($request->images)) {
    		foreach($request->images as $image){
    			$uploadMedia = Twitter::uploadMedia(['media' => File::get($image->getRealPath())]);
    			if (!empty($uploadMedia)) {
    				$newTweet['media_ids'][$uploadMedia->media_id_string] = $uploadMedia->media_id_string;
    			}
    		}
    	}
    	$twitter = Twitter::postTweet($newTweet);
    	return back();
    }
}
