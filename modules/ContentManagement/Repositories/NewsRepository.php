<?php

namespace Modules\ContentManagement\Repositories;

use Modules\ContentManagement\Models\News;
use Modules\ContentManagement\Models\Photo;
use App\Repositories\Repository;

class NewsRepository extends Repository
{
    protected $modelClass;

    public function __construct(News $news)
    {
        $this->modelClass = $news;
    }

    public function getAllWithCoverPhoto()
    {
        return $this->modelClass->with('coverPhoto')->get();
    }

    public function getByTypeWithPhotos($type)
    {
        return $this->modelClass->with(['coverPhoto', 'photos'])
            ->where('type', $type)
            ->get();
    }

    public function countByType($type)
    {
        return $this->modelClass->where('type', $type)->count();
    }

    public function countAll()
    {
        return $this->modelClass->count();
    }

    public function getNewsWithPhotosById($newsId)
    {
        return $this->modelClass->with('photos')->findOrFail($newsId);
    }

    public function getOtherNewsByType($newsId, $type)
    {
        return $this->modelClass->with('coverPhoto')
            ->where('type', $type)
            ->where('id', '!=', $newsId)
            ->get();
    }

    // public function create(array $data)
    // {
    //     return $this->modelClass->create($data);
    // }

    // public function update($id, array $data)
    // {
    //     $news = $this->modelClass->findOrFail($id);
    //     $news->update($data);
    //     return $news;
    // }

    public function delete($id)
    {
        $news = $this->modelClass->findOrFail($id);

        foreach ($news->photos as $photo) {
            if (file_exists(storage_path('app/public/' . $photo->photo_path))) {
                unlink(storage_path('app/public/' . $photo->photo_path));
            }
            $photo->delete();
        }

        $news->delete();
    }

    public function addPhoto($newsId, $photoPath, $isCover)
    {
        $photo = new Photo();
        $photo->news_id = $newsId;
        $photo->photo_path = $photoPath;
        $photo->is_cover = $isCover;
        $photo->save();
    }

    public function updateCoverPhoto($newsId, $photoPath)
    {
        $news = $this->modelClass->findOrFail($newsId);
        $oldCoverPhoto = $news->photos()->where('is_cover', true)->first();

        if ($oldCoverPhoto) {
            if (file_exists(storage_path('app/public/' . $oldCoverPhoto->photo_path))) {
                unlink(storage_path('app/public/' . $oldCoverPhoto->photo_path));
            }
            $oldCoverPhoto->delete();
        }

        $this->addPhoto($newsId, $photoPath, true);
    }

    public function updateAdditionalPhotos($newsId, $photos)
    {
        $news = $this->modelClass->findOrFail($newsId);
        $existingAdditionalPhotos = $news->photos()->where('is_cover', false)->get();

        foreach ($existingAdditionalPhotos as $oldAdditionalPhoto) {
            if (file_exists(storage_path('app/public/' . $oldAdditionalPhoto->photo_path))) {
                unlink(storage_path('app/public/' . $oldAdditionalPhoto->photo_path));
            }
            $oldAdditionalPhoto->delete();
        }

        foreach ($photos as $photo) {
            $photoPath = $photo->store('news', 'public');
            $this->addPhoto($newsId, $photoPath, false);
        }
    }

    public function validateData($request, $isUpdating = false)
    {
        $commonRules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string',
            'type' => 'required|in:news,article,blog,career',
            'otherPhotos.*' => 'nullable|image|max:21048',
        ];

        if ($request->input('type') === 'career') {
            $rules = array_merge($commonRules, [
                'coverPhoto' => ($isUpdating ? 'mimes:pdf|max:21048' : 'required|mimes:pdf|max:21048'),
            ]);
        } else {
            $rules = array_merge($commonRules, [
                'coverPhoto' => ($isUpdating ? 'image|max:21048' : 'required|image|max:21048'),
            ]);
        }

        return $request->validate($rules);
    }
}
