<?php
namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\WeeklySchedule;
use Illuminate\Http\Request;


class SessionController extends Controller
{
    public function index()
    {
        return Session::with(['instructor', 'weeklySchedule'])->get();
    }

    public function show($id)
    {
        $session = Session::with(['instructor', 'weeklySchedule'])->findOrFail($id);
        return $session;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => ['required', 'max:255'],
                'description' => ['required', 'max:999'],
                'instructor_id' => ['required'],
                'weekly_schedule' => 'required',
                'weekly_schedule.*.weekDay' => 'required',
                'weekly_schedule.*.startTime' => 'required',
                'weekly_schedule.*.endTime' => 'required',
            ],
            [
                'weekly_schedule.required' => 'Weekly schedule is required',
                'weekly_schedule.*.weekDay.required' => 'Please select a day',
                'weekly_schedule.*.startTime.required' => 'Please provide a starting time',
                'weekly_schedule.*.endTime.required' => 'Please provide an ending time',
            ],
            [
                'instructor_id' => 'instructor',
            ]
        );

        $session = Session::create($request->all());
        if (!is_null($request->weekly_schedule)) {
            $session->weeklySchedule()->createMany($request->weekly_schedule);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => ['required', 'max:255'],
                'description' => ['required', 'max:999'],
                'instructor_id' => ['required'],
                'weekly_schedule' => 'required',
                'weekly_schedule.*.weekDay' => 'required',
                'weekly_schedule.*.startTime' => 'required',
                'weekly_schedule.*.endTime' => 'required',
            ],
            [
                'weekly_schedule.required' => 'Weekly schedule is required',
                'weekly_schedule.*.weekDay.required' => 'Please select a day',
                'weekly_schedule.*.startTime.required' => 'Please provide a starting time',
                'weekly_schedule.*.endTime.required' => 'Please provide an ending time',
            ],
            [
                'instructor_id' => 'instructor',
            ]
        );

        $session = Session::with(['weeklySchedule'])->findOrFail($id);
        $session->update($request->all());
        $session->weeklySchedule()->delete();
        if (!is_null($request->weekly_schedule)) {
            $session->weeklySchedule()->createMany($request->weekly_schedule);
        }

        return $session->refresh();
    }

    public function destroy(Request $request, $id)
    {
        $session = Session::findOrFail($id);
        $session->weeklySchedule()->delete();
        $session->delete();

        return 204;
    }

}
