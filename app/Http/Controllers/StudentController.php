<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function get_all_students()
    {
        $student = Student::all();

        if (count($student) > 0) {
            return response()->json([
                'date' => $student,
                'message' => 'Student reterived successfully',
                'success' => true,
            ]);
        }

        return response()->json([
            'message' => 'Student not found',
            'success' => false,
        ]);
    }

    public function add_new_student(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'fees' => 'required',
        ]);

        $student = Student::create($request->all());

        if ($student) {
            return response()->json(
                [
                    'date' => $student,
                    'message' => 'Student created successfully',
                    'success' => true,
                ]
            );
        }

        return response()->json([
            'message' => 'Student not created',
            'success' => false,
        ]);
    }

    public function get_specific_students($id)
    {
        $student = Student::find($id);

        if ($student) {
            return response()->json([
                'date' => $student,
                'message' => 'Student reterived successfully',
                'success' => true,
            ]);
        }

        return response()->json([
            'message' => 'Student not found',
            'success' => false,
        ]);
    }

    public function get_city_students($city)
    {
        $student = Student::where('city', $city)->get();

        if (count($student) > 0) {
            return response()->json([
                'date' => $student,
                'message' => 'Student reterived successfully',
                'success' => true,
            ]);
        }

        return response()->json([
            'message' => 'Student not found',
            'success' => false,
        ]);
    }

    public function update_student(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'fees' => 'required',
        ]);

        $student = Student::find($id);

        if ($student) {
            $student->update($request->all());
            return response()->json([
                'data' => $student,
                'success' => true,
                'message' => 'Student updated successfully'
            ]);
        }

        return response()->json([
            'message' => 'Student not found',
            'success' => false
        ]);
    }

    public function delete_student($id)
    {
        $student =  Student::find($id);

        if ($student) {
            $student->delete();
            return response()->json([
                'message' => 'Student deleted successfully',
                'success' => true
            ]);
        }

        return response()->json([
            'message' => 'Student not found',
            'success' => false
        ]);
    }
}
