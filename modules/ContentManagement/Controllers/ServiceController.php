<?php

namespace Modules\ContentManagement\Controllers;

use App\Http\Controllers\Controller;
use Modules\ContentManagement\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->getAllWithPhotos();
        return view('admin.services.services', compact('services'));
    }

    public function create()
    {
        return view('admin.services.createService');
    }

    public function store(Request $request)
    {
        $data = $this->serviceRepository->validateData($request);

        if (!$data) {
            return redirect()->back()->withErrors($data)->withInput();
        }

        $service = $this->serviceRepository->create($data);

        if ($request->hasFile('coverPhoto')) {
            $coverPhotoPath = $request->file('coverPhoto')->store('services', 'public');
            $this->serviceRepository->addPhoto($service->id, $coverPhotoPath, true);
        }

        if ($request->hasFile('otherPhotos')) {
            foreach ($request->file('otherPhotos') as $photo) {
                $photoPath = $photo->store('services', 'public');
                $this->serviceRepository->addPhoto($service->id, $photoPath, false);
            }
        }

        return redirect(route('service.index'))->with('success', 'Service created successfully');
    }

    public function edit($id)
    {
        $service = $this->serviceRepository->getByIdWithPhotos($id);
        return view('admin.services.editService', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->serviceRepository->validateData($request);

        if (!$data) {
            return redirect()->back()->withErrors($data);
        }

        $service = $this->serviceRepository->update($id, $data);

        if ($request->hasFile('coverPhoto')) {
            $coverPhotoPath = $request->file('coverPhoto')->store('services', 'public');
            $this->serviceRepository->updateCoverPhoto($service->id, $coverPhotoPath);
        }

        if ($request->hasFile('otherPhotos')) {
            $this->serviceRepository->updateAdditionalPhotos($service->id, $request->file('otherPhotos'));
        }

        return redirect(route('service.index'))->with('success', 'Service updated successfully');
    }

    public function destroy($id)
    {
        $this->serviceRepository->delete($id);
        return redirect(route('service.index'))->with('success', 'Service deleted successfully');
    }
}
