<?php

namespace Modules\BusinessOperations\Repositories;

use Modules\BusinessOperations\Models\Project;
use Modules\ContentManagement\Models\Photo;
use Illuminate\Support\Facades\Storage;

class ProjectRepository
{
    public function getAllProjects()
    {
        return Project::with('photos')->paginate(5);
    }

    public function getProjectsByStatus($status)
    {
        return Project::with('photos')->where('status', $status)->latest()->paginate(5);
    }

    public function createProject(array $data)
    {
        $project = Project::create($data);

        if (isset($data['featured'])) {
            $project->featured = true;
        }

        if (isset($data['carousel'])) {
            $project->on_carousel = true;
            $project->short_description = $data['short_description'];
        }
        $project->save();

        if (isset($data['coverPhoto'])) {
            $coverPhotoPath = $data['coverPhoto']->store('projects', 'public');

            $coverPhoto = new Photo();
            $coverPhoto->project_id = $project->id;
            $coverPhoto->photo_path = $coverPhotoPath;
            $coverPhoto->is_cover = true;
            $coverPhoto->save();
        }

        if (isset($data['otherPhotos'])) {
            foreach ($data['otherPhotos'] as $photo) {
                $photoPath = $photo->store('projects', 'public');

                $photoModel = new Photo();
                $photoModel->project_id = $project->id;
                $photoModel->is_cover = false;
                $photoModel->photo_path = $photoPath;
                $photoModel->save();
            }
        }

        return $project;
    }

    public function updateProject(Project $project, array $data)
    {
        if (isset($data['featured'])) {
            $project->featured = true;
        } else {
            $project->featured = false;
        }
        if (isset($data['carousel'])) {
            $project->on_carousel = true;
            $project->short_description = $data['short_description'];
        } else {
            $project->on_carousel = false;
        }

        $project->update($data);

        if (isset($data['coverPhoto'])) {
            $coverPhotoPath = $data['coverPhoto']->store('projects', 'public');

            $oldCoverPhoto = $project->photos()->where('is_cover', true)->first();
            if ($oldCoverPhoto) {
                unlink(storage_path('app/public/' . $oldCoverPhoto->photo_path));
                $oldCoverPhoto->delete();
            }

            $coverPhoto = new Photo();
            $coverPhoto->project_id = $project->id;
            $coverPhoto->photo_path = $coverPhotoPath;
            $coverPhoto->is_cover = true;
            $coverPhoto->save();
        }

        if (isset($data['otherPhotos'])) {
            $existingAdditionalPhotos = $project->photos()->where('is_cover', false)->get();
            foreach ($existingAdditionalPhotos as $oldAdditionalPhoto) {
                $photoPath = storage_path('app/public/' . $oldAdditionalPhoto->photo_path);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
                $oldAdditionalPhoto->delete();
            }

            foreach ($data['otherPhotos'] as $photo) {
                $photoPath = $photo->store('projects', 'public');

                $additionalPhoto = new Photo();
                $additionalPhoto->project_id = $project->id;
                $additionalPhoto->is_cover = false;
                $additionalPhoto->photo_path = $photoPath;
                $additionalPhoto->save();
            }
        }

        return $project;
    }

    public function deleteProject(Project $project)
    {
        foreach ($project->photos as $photo) {
            unlink(storage_path('app/public/' . $photo->photo_path));
            $photo->delete();
        }
        $project->delete();
        return true;
    }
}
