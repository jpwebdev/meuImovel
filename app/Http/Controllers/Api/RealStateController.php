<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RealState;
use Illuminate\Http\Request;

class RealStateController extends Controller
{
    /**
     * @var RealState
     */
    private $realState;

    public function __construct(RealState $realState)
    {

        $this->realState = $realState;
    }

    public function index()
    {
        $realState = $this->realState->paginate('10');

        return response()->json($realState, 200);
    }

    public function store(request $request)
    {
        $data = $request->all();

        try{

            $realState = $this->realState->create($data); //Mass Asignment

            return response()->json([
                'data' => [
                    'msg' => 'Imóvel Cadastrado com Sucesso!'
                ]
            ],200);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 401);
        }


    }
}