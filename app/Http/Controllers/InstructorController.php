<?php
namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;


class InstructorController extends Controller
{
    public function index()
    {
        return Instructor::all();
    }

    public function show($id)
    {
        $model = Instructor::find($id);
        if (!empty($model)) {
            return $model;
        } else {
            abort(404);
            // return response('not found', 404);
        }
    }

    public function store(Request $request)
    {
        return Instructor::create($request->all());

    }

    public function update(Request $request, $id)
    {
        $model = Instructor::findOrFail($id);
        $model->update($request->all());

        return $model;
    }

    public function destroy(Request $request, $id)
    {
        $model = Instructor::findOrFail($id);
        $model->delete();

        return 204;
    }

}
