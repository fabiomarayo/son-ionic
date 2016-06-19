<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminClientRequest;

use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Services\ClientService;

class ClientsController extends Controller
{
    private  $clientRepository;
    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(ClientRepository $clientRepository, ClientService $clientService)
    {
        $this->clientRepository = $clientRepository;


        $this->clientService = $clientService;
    }

    public function index(ClientRepository $clientRepository)
    {
        $clients = $clientRepository->paginate();
        return view('admin.clients.index', compact(['clients']));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(AdminClientRequest $request)
    {
        $data = $request->all();
        $this->clientService->create($data);
        return redirect()->route('admin.clients');
    }

    public function edit($id)
    {
        $client = $this->clientRepository->find($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(AdminClientRequest $request, $id)
    {
        $data = $request->all();
        $this->clientService->update($data, $id);
        return redirect()->route('admin.clients');
    }
}
