<?php


namespace App\Controllers\Api;

use App\Models\ClientModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Client extends Base_api
{
    use ResponseTrait;

    /**
     * Get all Clients
     * @return Response
     */
    public function index()
    {
        $model = new ClientModel();
        return $this->respond(
            [
                'message' => 'Clients retrieved successfully',
                'clients' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Client
     */
    public function store()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[client.email]',
            'retainer_fee' => 'required|max_length[255]'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->respond(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $clientEmail = $input['email'];

        $model = new ClientModel();
        $model->save($input);


        $client = $model->where('email', $clientEmail)->first();

        return $this->respond(
            [
                'message' => 'Client added successfully',
                'client' => $client
            ]
        );
    }

    /**
     * Get a single client by ID
     */
    public function show($id)
    {
        try {

            $model = new ClientModel();
            $client = $model->findClientById($id);

            return $this->respond(
                [
                    'message' => 'Client retrieved successfully',
                    'client' => $client
                ]
            );

        } catch (Exception $e) {
            return $this->respond(
                [
                    'message' => 'Could not find client for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }


    public function update($id)
    {
        try {

            $model = new ClientModel();
            $model->findClientById($id);

            $input = $this->getRequestInput($this->request);



            $model->update($id, $input);
            $client = $model->findClientById($id);

            return $this->respond(
                [
                    'message' => 'Client updated successfully',
                    'client' => $client
                ]
            );

        } catch (Exception $exception) {

            return $this->respond(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function destroy($id)
    {
        try {

            $model = new ClientModel();
            $client = $model->findClientById($id);
            $model->delete($client);

            return $this
                ->respond(
                    [
                        'message' => 'Client deleted successfully',
                    ]
                );

        } catch (Exception $exception) {
            return $this->respond(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}

