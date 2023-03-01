<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();
        $grades = Grade::all();
        return view('dashboard.Classrooms.classrooms', compact('classrooms', 'grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequest $classroomRequest)
    {
        try {

            Classroom::create([
                'class_name' => [
                    'ar' => $classroomRequest->class_name_ar,
                    'en' => $classroomRequest->class_name_en,
                ],
                'grade_id' => $classroomRequest->grade_name
            ]);


            toastr()->success(__('messages.success'));
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->route('classrooms.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom, ClassroomRequest $classroomRequest)
    {
        try {
            $classroom = Classroom::find($classroomRequest->id);
            $classroom->update([
                'class_name' => [
                    'ar' => $classroomRequest->class_name_ar,
                    'en' => $classroomRequest->class_name_en,
                ],
                'grade_id' => $classroomRequest->grade_name
            ]);
            toastr()->success(__('messages.update'));
            return back();
        } catch (\Exception $e) {
            return redirect('/classrooms')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        try {
            Classroom::destroy($classroom->id);

            toastr()->success(__('messages.delete'));

            return back();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete_all(Request $request)
    {
        $id = explode(',', $request->delete_all_id);
        Classroom::whereIn('id', $id)->delete();
        toastr()->success(__('messages.delete'));
        return back();
    }

    public function filter(Request $request)
    {
        $grades = Grade::all();
        $search = Classroom::where('grade_id', $request->grade_id)->get();
        return view('dashboard.Classrooms.classrooms', compact('search', 'grades'));
    }
}
