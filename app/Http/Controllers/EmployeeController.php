<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $employees = Employee::orderBy('order','asc')->paginate(5);

        if ($status !== null) {
            $employees->where('is_active', $status);
        }

        return view('admin.employee.employees', compact('employees', 'status'));
    }

    public function filterByStatus($status)
    {
        $employees = Employee::where('is_active', $status)->latest()->paginate(5);

        return view('admin.employee.employees', compact('employees', 'status'));
    }


    public function create()
    {
        return view('admin.employee.createEmployee');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'joined_date' => 'required|date',
            'linkedin_link' => 'nullable|string|max:255',
            'fb_link' => 'nullable|string|max:255',
            'insta_link' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'photo_url' => 'nullable|image|mimes:jpeg|max:2048',
        ]);

        // Handle photo upload if provided
        if ($request->hasFile('photo_url')) {
            $photo = $request->file('photo_url');
            $photoPath = public_path('images/employees');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move($photoPath, $photoName);
        }


        $employee = new Employee();
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->description = $request->description;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->joined_date = $request->joined_date;
        $employee->linkedin_link = $request->linkedin_link;
        $employee->fb_link = $request->fb_link;
        $employee->insta_link = $request->insta_link;
        $employee->order = $request->order;
        $employee->photo_url = $photoName ?? null;
        if ($request->has('active')) {
            $employee->is_active = true;
        }


        $employee->save();


        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
    }
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        // Pass the employee details to the view
        return view('admin.employee.editEmployee', compact('employee'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'joined_date' => 'required|date',
            'linkedin_link' => 'nullable|string|max:255',
            'fb_link' => 'nullable|string|max:255',
            'insta_link' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'photo_url' => 'nullable|image|mimes:jpeg|max:2048',
        ]);

        if (!$validatedData) {
            return back()->withInput();
        }
        // Retrieve the employee record to be updated
        $employee = Employee::findOrFail($id);

        // Handle photo upload if provided
        if ($request->hasFile('photo_url')) {
            $photo = $request->file('photo_url');
            $photoPath = public_path('images/employees');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move($photoPath, $photoName);

            // Delete the old photo if exists
            if ($employee->photo_url) {
                // Assuming photo is stored in the public/images directory
                $oldPhotoPath = public_path('images/employees' . $employee->photo_url);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
            // Update the photo_url attribute with the new photo name
            $employee->photo_url = $photoName;
        }

        // Update other attributes
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->description = $request->description;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->joined_date = $request->joined_date;
        $employee->address = $request->address;
        $employee->linkedin_link = $request->linkedin_link;
        $employee->fb_link = $request->fb_link;
        $employee->insta_link = $request->insta_link;
        $employee->order = $request->order;

        if ($request->has('active')) {
            $employee->is_active = true;
        } else {
            $employee->is_active = false;
        }

        // Save the updated employee record
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        // Retrieve the employee record to be deleted
        $employee = Employee::findOrFail($id);

        // Delete the employee record
        $employee->delete();

        // Redirect the user back to the homepage with a success message
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }

}
