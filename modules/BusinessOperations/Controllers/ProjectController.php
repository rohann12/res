<?php

namespace Modules\BusinessOperations\Controllers;

use App\Http\Controllers\Controller;
use Modules\BusinessOperations\Models\Project;
use Modules\BusinessOperations\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function index(Request $request)
    {
        $status = $request->query('status');
        $projects = $this->projectRepository->getAllProjects();
        return view('BusinessOperations::projects.projects', compact('projects', 'status'));
    }

    public function filterByStatus($status)
    {
        $projects = $this->projectRepository->getProjectsByStatus($status);
        return view('BusinessOperations::projects.projects', compact('projects', 'status'));
    }

    public function create()
    {
        return view('BusinessOperations::projects.createProject');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:255',
            'status' => 'required|in:upcoming,running,completed',
            'coverPhoto' => 'required|image|max:21048',
            'otherPhotos.*' => 'image|max:21048'
        ]);

        if (!$data) {
            return redirect()->back()->withErrors($data)->withInput();
        }

        $project = $this->projectRepository->createProject($data);

        return redirect(route('project.index'))->with('success', 'Project created successfully');
    }

    public function edit(Project $project)
    {
        return view('BusinessOperations::projects.editProject', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:255',
            'status' => 'required|in:upcoming,running,completed',
            'coverPhoto' => 'image|max:21048',
            'otherPhotos.*' => 'image|max:21048'
        ]);

        if (!$data) {
            return redirect()->back()->withErrors($data);
        }

        $this->projectRepository->updateProject($project, $data);

        return redirect(route('project.index'))->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project)
    {
        $this->projectRepository->deleteProject($project);
        return redirect(route('project.index'))->with('success', 'Project deleted successfully');
    }
}
