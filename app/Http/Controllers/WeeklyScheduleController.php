<?php
namespace App\Http\Controllers;

use App\Models\WeeklySchedule;
use Illuminate\Http\Request;


class WeeklyScheduleController extends Controller
{
    public function index()
    {
        return WeeklySchedule::all();
    }

    public function show($id)
    {
        $model = WeeklySchedule::find($id);
        if (!empty($model)) {
            return $model;
        } else {
            abort(404);
            // return response('not found', 404);
        }
    }

    public function store(Request $request)
    {
        return WeeklySchedule::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $model = WeeklySchedule::findOrFail($id);
        $model->update($request->all());

        return $model;
    }

    public function delete(Request $request, $id)
    {
        $model = WeeklySchedule::findOrFail($id);
        $model->delete();

        return 204;
    }

}
