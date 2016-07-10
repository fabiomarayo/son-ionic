<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCupomRequest;
use CodeDelivery\Repositories\CupomRepository;

use CodeDelivery\Http\Requests;
use Illuminate\Http\Request;

class CupomsController extends Controller
{
    private  $cupomRespository;
    public function __construct(CupomRepository $cupomRespository)
    {
        $this->cupomRepository = $cupomRespository;

    }

    public function index(CupomRepository $cupomRespository)
    {
        $cupoms = $cupomRespository->paginate();
        return view('admin.cupoms.index', compact(['cupoms']));
    }

    public function create()
    {
        return view('admin.cupoms.create');
    }

    public function store(AdminCupomRequest $request)
    {
        $data = $request->all();
        $this->cupomRepository->create($data);
        return redirect()->route('admin.cupoms');
    }

    public function edit($id)
    {
        $cupom = $this->cupomRepository->find($id);
        return view('admin.cupoms.edit', compact('cupom'));
    }

    public function update(AdminCupomRequest $request, $id)
    {
        $data = $request->all();
        $this->cupomRepository->update($data, $id);
        return redirect()->route('admin.cupoms');
    }
}
