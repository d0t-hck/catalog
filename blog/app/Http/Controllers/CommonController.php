<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class CommonController extends Controller
{
    private const PAGE = 10;
    abstract protected function getModel();

    public function list(Request $request) {
        if ($request->has('type')){
            $result = ($this->getModel())::where('type','ilike', '%'.$request->input('type').'%')
                ->paginate(self::PAGE);
            return response()->json($result);
        }
        if ($request->has('status') && $request->has('genre')){
            $result = ($this->getModel())::whereHas('status', function($q) use ($request) {
                $q->where('name','ilike', '%'.$request->input('status').'%');
                })
                ->whereHas('genres', function($q) use ($request) {
                    $q->where('genre','ilike', '%'.$request->input('genre').'%');
                })
                ->paginate(self::PAGE);
            return response()->json($result);
        }
        if ($request->has('status')){
            $result = ($this->getModel())::whereHas('status', function(Builder $q) use ($request) {
                    $q->where('name','ilike', '%'.$request->input('status').'%');
                })
                ->paginate(self::PAGE);
            // $result = ($this->getModel())::whereRelation('statuses', 'name','ilike', '%'.$request->input('status').'%')->paginate(self::PAGE);
            return response()->json($result);
        }
        if ($request->has('genre')){
            $result = ($this->getModel())::whereHas('genres', function($q) use ($request) {
                $q->where('genre','ilike', '%'.$request->input('genre').'%');
            })->paginate(self::PAGE);
            return response()->json($result);
        }
        return response()->json(($this->getModel())::paginate(self::PAGE));
    }

    public function item($id) {
        return response()->json(($this->getModel())::findOrFail($id));
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
        ($this->getModel())::findOrFail($id)->delete();
        return response('status',204);
    }
}
