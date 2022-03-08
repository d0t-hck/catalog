<?php

namespace App\Http\Controllers;

use App\Actions\QueryStringAction;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

abstract class CommonController extends BaseController
{
    abstract protected function getModel();

    public function list(Request $request, QueryStringAction $action) {
        $result = $action->handle($request, $this->getModel());
        return response()->json($result);
    }

    public function item($id) {
        return response()->json(($this->getModel())::findOrFail($id));
    }

    public function create(Request $request) {
        $data = $this->validate($request, ($this->getModel())::getValidationRules());
        $entity = $this->getModel()::create($data);
        return response()->json($entity, 201);
    }

    public function update($id, Request $request) {
        $entity = $this->getModel()::findOrFail($id);
        $data = $this->validate($request, ($this->getModel())::getValidationRules(false));
        $entity->update($data);
        return response()->json($entity, 200);
    }

    public function delete($id) {
        ($this->getModel())::findOrFail($id)->delete();
        return response('status',204);
    }
}
