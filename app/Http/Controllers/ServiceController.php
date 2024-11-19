<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('photos')->latest()->paginate(5);
        return view('admin.services.services', compact('services'));
    }
    public function create()
    {
        return view('admin.services.createService');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'coverPhoto' => 'required|image|max:21048',
            'otherPhotos.*' => 'image|max:21048'
        ]);
        if(!$data){
            return redirect()->back()->withErrors($data)->withInput();
        }
        $service = Service::create($data);
        
        if ($request->hasFile('coverPhoto')) {
            $coverPhotoPath = $request->file('coverPhoto')->store('services', 'public');

            $coverPhoto = new Photo();
            $coverPhoto->service_id = $service->id;
            $coverPhoto->photo_path = $coverPhotoPath;
            $coverPhoto->is_cover = true; 
            $coverPhoto->save();
        }

        if ($request->hasFile('otherPhotos')) {
            foreach ($request->file('otherPhotos') as $photo) {
                $photoPath = $photo->store('services', 'public');

                $photoModel = new Photo();
                $photoModel->service_id = $service->id;
                $photoModel->is_cover = false;
                $photoModel->photo_path = $photoPath;
                $photoModel->save();
            }
        }
        return redirect(route('service.index'))->with('success', 'Service created successfully');
    }

    public function edit(Service $service)
    {
        return view('admin.services.editService', ['service' => $service]);
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'coverPhoto' => 'image|max:21048',
            'otherPhotos.*' => 'image|max:21048'
        ]);

        if(!$data){
            return redirect()->back()->withErrors($data);
        }
       
        $service->update($data);
        
    
        if ($request->hasFile('coverPhoto')) {
            
            $coverPhotoPath = $request->file('coverPhoto')->store('services', 'public');

            
            $oldCoverPhoto = $service->photos()->where('is_cover', true)->first();
            if ($oldCoverPhoto) {
                unlink(storage_path('app/public/' . $oldCoverPhoto->photo_path));
                $oldCoverPhoto->delete();
            }

            
            $coverPhoto = new Photo();
            $coverPhoto->service_id = $service->id;
            $coverPhoto->photo_path = $coverPhotoPath;
            $coverPhoto->is_cover = true; 
            $coverPhoto->save();
        }

        if ($request->hasFile('otherPhotos')) {

            // Remove existing additional photos from storage and database before adding new ones
            $existingAdditionalPhotos = $service->photos()->where('is_cover', false)->get();
            foreach ($existingAdditionalPhotos as $oldAdditionalPhoto) {
                $photoPath = storage_path('app/public/' . $oldAdditionalPhoto->photo_path);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
                $oldAdditionalPhoto->delete();
            }

            foreach ($request->file('otherPhotos') as $photo) {
                
                $photoPath = $photo->store('services', 'public');

                
                $additionalPhoto = new Photo();
                $additionalPhoto->service_id = $service->id;
                $additionalPhoto->is_cover = false;
                $additionalPhoto->photo_path = $photoPath;
                $additionalPhoto->save();
            }
        }

        return redirect(route('service.index'))->with('success', 'Service updated successfully');
    }

    public function destroy(Service $service)
    {
        
        foreach ($service->photos as $photo) {
            unlink(storage_path('app/public/' . $photo->photo_path));
            $photo->delete();
        }
        $service->delete();
        return redirect(route('service.index'))->with('success', 'Service deleted successfully');
    }
}
