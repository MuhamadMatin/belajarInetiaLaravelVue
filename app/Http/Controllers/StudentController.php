<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\ClassResource;
use App\Http\Resources\StudentResource;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari request
        $search = $request->input('search');
        $class_id = $request->input('class_id');

        // Query dasar
        $query = Student::query();
        $classes = ClassResource::collection(Classes::all());

        // Jika ada pencarian, tambahkan kondisi pencarian
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        if ($class_id) {
            $query->where('class_id', $class_id);
        }

        // Lakukan pagination pada hasil query
        $students = StudentResource::collection($query->paginate(10));

        // Kembalikan data ke view
        return inertia('Students/Index', [
            'students' => $students,
            'classes' => $classes,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassResource::collection(Classes::all());

        return inertia('Students/Create', [
            'classes' => $classes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classes = ClassResource::collection(Classes::all());
        return inertia('Students/Edit', [
            'classes' => $classes,
            'student' => StudentResource::make($student),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }
}
