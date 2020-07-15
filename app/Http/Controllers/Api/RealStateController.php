<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\RealStateRequest;
use App\RealState;

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

    public function show($id)
    {
        try{
            $realState = $this->realState->findOrFail($id);

            return response()->json([
                'data' => $realState
            ],200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function store(RealStateRequest $request)
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

            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }

    }

    public function update($id, RealStateRequest $request)
    {
        $data = $request->all();

        try{
            $realState = $this->realState->findOrFail($id);
            $realState->update($data); //Mass Asignment

            return response()->json([
                'data' => [
                    'msg' => 'Imóvel Atualizado com Sucesso!'
                ]
            ],200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function destroy($id)
    {

        try{
            $realState = $this->realState->findOrFail($id);
            $realState->delete(); //Mass Asignment

            return response()->json([
                'data' => [
                    'msg' => 'Imóvel Removido com Sucesso!'
                ]
            ],200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
