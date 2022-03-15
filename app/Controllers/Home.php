<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function phpinfo() {
	    return phpinfo();
    }

    public function test() {
	    // disable CSS file caching
        $this->cachePage(0);

        //return view('test/example_layout');
        return view('test/example_howto');
    }
}
