<?php
namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;


class StoreController extends Controller
{
    public function index()
    {
        return Store::all();
    }

    public function show($id)
    {
        $store = Store::find($id);
        if (!empty($store)) {
            return $store;
        } else {
            abort(404);
            // return response('not found', 404);
        }
    }

    public function store(Request $request)
    {
        return Store::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->update($request->all());

        return $store;
    }

    public function delete(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return 204;
    }

}
