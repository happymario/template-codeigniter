<?php

namespace App\Controllers;

class Test extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function phpinfo() {
	    return phpinfo();
    }

    public function howto() {
        //return view('test/example_layout');
        return view('test/example_howto');
    }

    public function html_purifier() {
        require_once APPPATH . "/ThirdParty/HTMLPurifier/HTMLPurifier.auto.php";

        /**
         * Config/Autoload.php
         *
         * public $psr4 = [
            APP_NAMESPACE => APPPATH, // For custom app namespace
            'Config'      => APPPATH . 'Config',
            "App" => APPPATH,
            "TCPDF" => "ThirdParty/tcpdf"
            ];
         * public $classmap = [
            "TCPDF" => APPPATH . "ThirdParty/tcpdf/tcpdf.php"
            ];
         * ***********************************************************************
         */

        $config = \HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);

        $dirty_html = "<!doctype html>
			 <html lang=en>
			 <head>
			 <meta charset=utf-8>
			 <title>HTML Template</title>
			 <style type=text/css>
			 @import url(0.css);
			 </style>
			 </head>
			 <body>
			 <center><h1>
			 A simple HTML template
			 </h1></center>
			 <!-- START YOUR TEXT -->
			 ...your text goes here... <p>
			 See <a href=quick-html.html>this</a>.
			 <!-- END YOUR TEXT -->
			 <p> 2020/02/05
			 </body></html>";

        $data['clean_html'] = $purifier->purify($dirty_html);

        return view('test/html_purifier', $data);
    }
}
