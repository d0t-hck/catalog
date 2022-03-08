<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class QueryStringAction
{
  protected $page = 10;

  protected $params = [
    'type',
    'status',
    'genre'
  ];

  public function handle(Request $request, $model)
  {
    if(!$request->hasAny($this->params)){
      return $model::paginate($this->page);
    }
    if ($request->has('type')) {
      return $model::where('type', 'ilike', '%' . $request->input('type') . '%')
        ->paginate($this->page);
    }
    if ($request->has(['status', 'genre'])) {
      return $model::whereHas('status', function ($query) use ($request) {
        $query->where('name', 'ilike', '%' . $request->input('status') . '%');
      })
        ->whereHas('genres', function ($query) use ($request) {
          $query->where('name', 'ilike', '%' . $request->input('genre') . '%');
        })
        ->paginate($this->page);
    }
    if ($request->has('status')) {
      return $model::with('status')->whereHas('status', function ($query) use ($request) {
        $query->where('name', 'ilike', '%' . $request->input('status') . '%');
      })
        ->paginate($this->page);
    }
    if ($request->has('genre')) {
      return $model::with('genres')->whereHas('genres', function ($query) use ($request) {
        $query->where('name', 'ilike', '%' . $request->input('genre') . '%');
      })
        ->paginate($this->page);
    }
    // return $result;
  }
}
