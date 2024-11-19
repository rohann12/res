<?php

namespace Modules\UserInteractions\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Visitor\Models\Client;
class ClientController extends Controller
{
    //
    public function index()
    {
        $clients = Client::latest()->paginate(5);
        return view('admin.client.clients', compact('clients'));
    }

    public function create()
    {
        return view('admin.client.createClient');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|string|email|max:255|unique:clients,email',
        ]);

        if(!$validatedData){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = public_path('images/clients');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->move($logoPath, $logoName);
        }

        $client = new Client();
        $client->company_name = $request->company_name;
        $client->logo_path = $logoName ?? null;
        $client->email = $request->email;

        $client->save();

        return redirect()->route('client.index')->with('success', 'Client created successfully!');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client.editClient', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $id,
        ]);

        if(!$validatedData){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $client = Client::findOrFail($id);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = public_path('images/clients');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->move($logoPath, $logoName);

            if ($client->logo_path) {
                $oldLogoPath = public_path('images/clients/' . $client->logo_path);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }

            $client->logo_path = $logoName;
        }

        $client->company_name = $request->company_name;
        $client->email = $request->email;

        $client->save();

        return redirect()->route('client.index')->with('success', 'Client updated successfully!');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        if ($client->logo_path) {
            $logoPath = public_path('images/clients/' . $client->logo_path);
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }

        $client->delete();

        return redirect()->route('client.index')->with('success', 'Client deleted successfully!');
    }
}
