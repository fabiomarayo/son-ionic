<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Repositories\CategoryRepository;

use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->paginate();
        return view('admin.orders.index', compact(['orders']));
    }

    public function edit($id, UserRepository $userRepository)
    {
        $order = $this->orderRepository->find($id);
        $list_status = [0 => 'Pendente', 1 => 'A Caminho', 2 => 'Entregue', 3 => 'Cancelado'];
        $deliverymen = $userRepository->getDeliverymen();
        return view('admin.orders.edit', compact(['order', 'list_status', 'deliverymen']));
    }

    public function update(Request $request, $id)
    {
        $this->orderRepository->update($request->all(), $id);

        return redirect()->route('admin.orders');
    }
}
