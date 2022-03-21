<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Validation\Exceptions\ValidationException;
use Config\Services;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Test extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();

        \helper(['url', 'common']);

        // disable CSS file caching
        $this->cachePage(0);
	}

	public function getRequestInput(IncomingRequest $request) {
	    $input = $request->getPost();
	    if(empty($input)) {
	        $input = json_decode($request->getBody(), true);
        }

	    return $input;
    }

    public function getResponse(array $responseBody, $code = ResponseInterface::HTTP_OK)
    {
        return $this
            ->response
            ->setStatusCode($code)
            ->setJSON($responseBody);
    }

    public function validateRequest($input, $rules, $messages=[]) {
	    $this->validator = Services::Validation()->setRules($rules);
	    return $this->validator->setRules($rules, $messages)->run($input);
    }

    public function uploadFile($file, $dirname=TEMP_DIR)
    {
        $upload_file_name_only = get_unique_str();
        $upload_file_name_ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        $file_name = $upload_file_name_only . '.' . $upload_file_name_ext;

        $file_path = make_directory($dirname) . DIRECTORY_SEPARATOR . $file_name;

        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            return null;
        }

        return [
            'file_name' => $file_name,
            'file_url' => get_temp_image_url($file_name, $dirname)
        ];
    }

}
