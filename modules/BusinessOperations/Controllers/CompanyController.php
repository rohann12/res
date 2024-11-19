<?php

namespace Modules\BusinessOperations\Controllers;

use App\Http\Controllers\Controller;
use Modules\BusinessOperations\Repositories\CompanyRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
   
    protected $company;

    public function __construct(CompanyRepository $company)
    {
        $this->company = $company;
    }

   
    public function index(){

        $company=$this->company->get()->first();
        return view('BusinessOperations::company')->with('company', $company);;
    }

    public function edit($id)
    {
        $company =$this->company->find($id);
        if (!$company) {
            throw new Exception("Company not found"); // Handle the case when company doesn't exist
        }

        return view('BusinessOperations::editCompany')->with($company);
    }
    public function update(Request $request, $id)
    {
        $validatedData =$request->validate([
            // 'name' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'welcome_text' => 'nullable|string',
            'description' => 'string',
            'email' => 'string|email|max:255',
            'contact' => 'string|max:255',
            'address' => 'string|max:255',
            'fbLink' => 'nullable|string|max:255',
            'instaLink' => 'nullable|string|max:255',
            'linkedInLink' => 'nullable|string|max:255',
            // 'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
    DB::beginTransaction(); // Start the transaction

    try {
        $company = $this->company->find($id); // Use find to get the company record

        if (!$company) {
            throw new Exception("Company not found"); // Handle the case when company doesn't exist
        }

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();

            // Delete old logo if it exists
            if ($company->logo) {
                $oldLogoPath = public_path('images/' . $company->logo);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath); // Remove the old logo
                }
            }

            // Move the new logo to the public/images folder
            $logo->move(public_path('images'), $logoName);
            $company->logo = $logoName; // Assign new logo to the company
        }

        // Fill the company record with the validated data
        $company->fill($validatedData);
        // Save the changes
        $company->save();

        DB::commit(); // Commit the transaction

        return redirect()->route('company.index')->with('success', 'Company updated successfully!');
    } catch (Exception $ex) {
        DB::rollback(); // Roll back the transaction if there's an error
        return back()->with('error', 'An error occurred while updating the company. Please try again.');
    }

       
    }
}
