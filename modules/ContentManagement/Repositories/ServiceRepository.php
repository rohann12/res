<?php

namespace Modules\ContentManagement\Repositories;

use Modules\ContentManagement\Models\Service;
use Modules\ContentManagement\Models\Photo;
use App\Repositories\Repository;

class ServiceRepository extends Repository
{
    protected $modelClass;

    public function __construct(Service $model)
    {
        $this->modelClass = $model;
    }

    public function getAllWithPhotos()
    {
        return $this->modelClass->with('photos')->latest()->paginate(5);
    }

    public function getByIdWithPhotos($id)
    {
        return $this->modelClass->with('photos')->findOrFail($id);
    }

    // public function create(array $data)
    // {
    //     return $this->modelClass->create($data);
    // }

    // public function update($id, array $data)
    // {
    //     $service = $this->modelClass->findOrFail($id);
    //     $service->update($data);
    //     return $service;
    // }

    public function delete($id)
    {
        $service = $this->modelClass->findOrFail($id);

        foreach ($service->photos as $photo) {
            if (file_exists(storage_path('app/public/' . $photo->photo_path))) {
                unlink(storage_path('app/public/' . $photo->photo_path));
            }
            $photo->delete();
        }

        $service->delete();
    }

    public function addPhoto($serviceId, $photoPath, $isCover)
    {
        $photo = new Photo();
        $photo->service_id = $serviceId;
        $photo->photo_path = $photoPath;
        $photo->is_cover = $isCover;
        $photo->save();
    }

    public function updateCoverPhoto($serviceId, $photoPath)
    {
        $service = $this->modelClass->findOrFail($serviceId);
        $oldCoverPhoto = $service->photos()->where('is_cover', true)->first();

        if ($oldCoverPhoto) {
            if (file_exists(storage_path('app/public/' . $oldCoverPhoto->photo_path))) {
                unlink(storage_path('app/public/' . $oldCoverPhoto->photo_path));
            }
            $oldCoverPhoto->delete();
        }

        $this->addPhoto($serviceId, $photoPath, true);
    }

    public function updateAdditionalPhotos($serviceId, $photos)
    {
        $service = $this->modelClass->findOrFail($serviceId);
        $existingAdditionalPhotos = $service->photos()->where('is_cover', false)->get();

        foreach ($existingAdditionalPhotos as $oldAdditionalPhoto) {
            if (file_exists(storage_path('app/public/' . $oldAdditionalPhoto->photo_path))) {
                unlink(storage_path('app/public/' . $oldAdditionalPhoto->photo_path));
            }
            $oldAdditionalPhoto->delete();
        }

        foreach ($photos as $photo) {
            $photoPath = $photo->store('services', 'public');
            $this->addPhoto($serviceId, $photoPath, false);
        }
    }
    
    public function validateData($request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'coverPhoto' => 'required|image|max:21048',
            'otherPhotos.*' => 'image|max:21048'
        ]);
    }
}
