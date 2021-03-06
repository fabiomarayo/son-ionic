<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;

use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
{
    private $userRepository;
    private $productRepository;
    private $orderService;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository, ProductRepository $productRepository, OrderService $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();

        $clientId = $this->userRepository->find($id)->client->id;
        $orders = $this->orderRepository->with('items')->scopeQuery(function($query) use ($clientId){
            return $query->where('client_id','=',$clientId);
        })->paginate();

        return $orders;
    }

    public function show($id)
    {
        $o = $this->orderRepository->with(['items','client','cupom'])->find($id);
        $o->items->each(function($i) {
            $i->product;
        });
        return $o;
    }

    public function store(Request $request)
    {
        $id = Authorizer::getResourceOwnerId();

        $data = $request->all();
        $clientId = $this->userRepository->find($id)->client->id;

        $data['client_id'] = $clientId;

        $o = $this->orderService->create($data);

        $o = $this->orderRepository->with('items')->find($o->id);
        return $o;
    }


}
