<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $projects = Project::with('photos')->paginate(5);
        return view('admin.projects.projects', compact('projects', 'status'));
    }

    public function filterByStatus($status)
    {
        $projects = Project::with('photos')->where('status', $status)->latest()->paginate(5);

        return view('admin.projects.projects', compact('projects', 'status'));
    }
    public function create()
    {
        return view('admin.projects.createProject');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:255',
            // 'client' => 'required|string|max:255',
            // 'architect' => 'required|string|max:255',
            // 'builder' => 'required|string|max:255',
            // 'budget' => 'required|numeric',
            'status' => 'required|in:upcoming,running,completed',
            'coverPhoto' => 'required|image|max:21048',
            'otherPhotos.*' => 'image|max:21048'
        ]);

        if (!$data) {
            return redirect()->back()->withErrors($data)->withInput();
        }

        $project = Project::create($data);

        if ($request->has('featured')) {
            $project->featured = true;
        }

        if ($request->has('carousel')) {
            $project->on_carousel = true;
            $project->short_description = $request->short_description;
        }
        $project->save();


        if ($request->hasFile('coverPhoto')) {
            $coverPhotoPath = $request->file('coverPhoto')->store('projects', 'public');

            $coverPhoto = new Photo();
            $coverPhoto->project_id = $project->id;
            $coverPhoto->photo_path = $coverPhotoPath;
            $coverPhoto->is_cover = true;
            $coverPhoto->save();
        }

        if ($request->hasFile('otherPhotos')) {
            foreach ($request->file('otherPhotos') as $photo) {
                $photoPath = $photo->store('projects', 'public');

                $photoModel = new Photo();
                $photoModel->project_id = $project->id;
                $photoModel->is_cover = false;
                $photoModel->photo_path = $photoPath;
                $photoModel->save();
            }
        }
        return redirect(route('project.index'))->with('success', 'Project created successfully');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.editProject', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:255',
            // 'client' => 'required|string|max:255',
            // 'architect' => 'required|string|max:255',
            // 'builder' => 'required|string|max:255',
            // 'budget' => 'required|numeric',
            'status' => 'required|in:upcoming,running,completed',
            'coverPhoto' => 'image|max:21048',
            'otherPhotos.*' => 'image|max:21048'
        ]);

        if (!$data) {
            return redirect()->back()->withErrors($data);
        }


        if ($request->has('featured')) {
            $project->featured = true;
        } else {
            $project->featured = false;
        }
        if ($request->has('carousel')) {
            $project->on_carousel = true;
            $project->short_description = $request->short_description;
        } else {
            $project->on_carousel = false;
        }

        $project->update($data);

        if ($request->hasFile('coverPhoto')) {
            $coverPhotoPath = $request->file('coverPhoto')->store('projects', 'public');

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

        if ($request->hasFile('otherPhotos')) {
            // Remove existing additional photos from storage and database before adding new ones
            $existingAdditionalPhotos = $project->photos()->where('is_cover', false)->get();
            foreach ($existingAdditionalPhotos as $oldAdditionalPhoto) {
                $photoPath = storage_path('app/public/' . $oldAdditionalPhoto->photo_path);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
                $oldAdditionalPhoto->delete();
            }

            // Add new additional photos
            foreach ($request->file('otherPhotos') as $photo) {
                $photoPath = $photo->store('projects', 'public');

                $additionalPhoto = new Photo();
                $additionalPhoto->project_id = $project->id;
                $additionalPhoto->is_cover = false;
                $additionalPhoto->photo_path = $photoPath;
                $additionalPhoto->save();
            }
        }

        return redirect(route('project.index'))->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project)
    {
        foreach ($project->photos as $photo) {
            unlink(storage_path('app/public/' . $photo->photo_path));
            $photo->delete();
        }
        $project->delete();
        return redirect(route('project.index'))->with('success', 'Project deleted successfully');
    }
}
