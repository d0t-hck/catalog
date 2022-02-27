<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class CommonController extends Controller
{
    abstract protected function getModel();

    public function list() {
        return response()->json(($this->getModel())::all(), 200);
    }

    public function item($id) {
        return response()->json(($this->getModel())::find($id));
    }

    public function create(Request $request) {
        $data = $this->validate($request, $this->getModel()::getValidationRules());
        $entity = $this->getModel()::create($data);
        return response()->json($entity, 201);
    }

    public function update($id, Request $request) {
        $entity = $this->getModel()::findOrFail($id);
        $data = $this->validate($request, $this->getModel()::getValidationRules(false));
        $entity->update($data);
        return response()->json($entity, 200);
    }

    public function delete($id) {
        $this->getModel()::findOrFail($id)->delete();
        return response(204);
    }
}
