<?php

namespace App\Http\Controllers;

use toastr;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use Illuminate\Http\RedirectResponse;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('dashboard.Grades.grades', compact('grades'));
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
    public function store(StoreGrades $storeGrades)
    {

        if (Grade::where('name->ar', $storeGrades->name_ar)->orWhere('name->en', $storeGrades->name_en)->exists()) {
            return back()->withErrors(__('validation.exists_trans'));
            // toastr()->error(__('validation.exists_trans'));
            // return redirect()->route('grades.index');
        }

        try {

            Grade::create([
                'name' => [
                    'ar' => $storeGrades->name_ar,
                    'en' => $storeGrades->name_en
                ],
                'notes' => $storeGrades->notes
            ]);

            toastr()->success(__('messages.success'));

            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGrades $storeGrades)
    {
        try {
            $grade = Grade::find($storeGrades->id);
            $grade->update([
                'name' => [
                    'ar' => $storeGrades->name_ar,
                    'en' => $storeGrades->name_en,
                ],
                'notes' => $storeGrades->notes
            ]);


            toastr()->success(__('messages.update'));

            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade, Request $request)
    {
        $id = Classroom::where('grade_id', $request->id)->pluck('grade_id');
        if ($id->count() == 0) {
            try {
                Grade::destroy($request->id);
                toastr()->success(__('messages.delete'));
                return back();
            } catch (\Exception $e) {
                return back()->withErrors(['error' => $e->getMessage()]);
            }
        } else {
            toastr()->error(__('validation.not_delete'));
            return back();
        }
    }
}
