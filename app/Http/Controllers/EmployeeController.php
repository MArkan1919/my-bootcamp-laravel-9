<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'    => 'required|max:225',
            'email'   => 'required|email|unique:employees',
            'gender'  => 'required',
            'address' => 'required',
            'image'   => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $validatedData['image'] = $request->file('image')->storeAs('images', $imageName);
        }

        Employee::create($validatedData);

        return to_route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'name'    => 'required|max:225',
            'email'   => 'required|email|unique:employees,email,' . $employee->id,
            'gender'  => 'required',
            'address' => 'required',
            'image'   => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $validatedData['image'] = $request->file('image')->storeAs('images', $imageName);
        }

        $employee->update($validatedData);

        return to_route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if ($employee->image) {
            Storage::delete($employee->image);
        }
        $employee->delete();

        return to_route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
