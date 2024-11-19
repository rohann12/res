<?php

namespace Modules\UserInteractions\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendContactFormMail;
use App\Models\Career;

use App\Models\Employee;
use App\Models\Message;
use Modules\BusinessOperations\Models\Company;
use Modules\ContentManagement\Models\News; 
use Modules\BusinessOperations\Models\Project;
use Modules\ContentManagement\Models\Service;
// use news\Repositories\NewsRepository;
use Modules\ContentManagement\Repositories\NewsRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Modules\ContentManagement\Models\News as ModelsNews;

class VisitorController extends Controller
{
    protected $newsRepository;
    protected $serviceRepository;
    protected $projectRepository;
    
    public function __construct(
        NewsRepository $newsRepository,
        ServiceRepository $serviceRepository,
        ProjectRepository $projectRepository)    
    {
        $this->newsRepository = $newsRepository;
        $this->serviceRepository= $serviceRepository;
        $this->projectRepository=$projectRepository;
    }

    public function index()
    {
        $projects = Project::all();
        $news = News::all();
        return view('UserInteractions::home', compact('projects', 'news'));
    }

    public function employeeDetails($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        return view('UserInteractions::employeeDetails', compact('employee'));
    }

    public function contact()
    {
        $company = Company::first();
        return view('UserInteractions::contact', compact('company'));
    }

    public function about()
    {
        return view('UserInteractions::about');
    }
    public function news()
    {
        $all = $this->newsRepository->getAllWithCoverPhoto();
        $news = $this->newsRepository->getByTypeWithPhotos('news');
        $blogs = $this->newsRepository->getByTypeWithPhotos('blog');
        $articles = $this->newsRepository->getByTypeWithPhotos('article');
        $careers = $this->newsRepository->getByTypeWithPhotos('career');

        $newsCount = $this->newsRepository->countByType('news');
        $articleCount = $this->newsRepository->countByType('article');
        $blogCount = $this->newsRepository->countByType('blog');
        $careerCount = $this->newsRepository->countByType('career');
        $allCount = $this->newsRepository->countAll();
        
        return view('UserInteractions::news', compact('all', 'blogs', 'articles', 'news', 'careers', 'newsCount', 'articleCount', 'blogCount', 'careerCount', 'allCount'));
    }

    public function services()
    {        
        $services=$this->serviceRepository->getAllWithPhotos();
        return view('UserInteractions::services', compact('services'));
    }

    public function careers()
    {
        $careers = Career::all();
        return view('UserInteractions::careers', compact('careers'));
    }

    public function serviceView($serviceId)
    {
        $service = $this->serviceRepository->getByIdWithPhotos($serviceId);
        return view('UserInteractions::serviceView', compact('service'));
    }

    public function projects(Request $request)
    {
        $projectsAll = $this->projectRepository->getAllWithPhotos();
        $projectsCompleted = $this->projectRepository->getByStatusWithPhotos('completed');
        $projectsRunning = $this->projectRepository->getByStatusWithPhotos('running');
        $projectsUpcoming = $this->projectRepository->getByStatusWithPhotos('upcoming');

        return view('UserInteractions::projects', compact('projectsAll', 'projectsCompleted', 'projectsRunning', 'projectsUpcoming'));
    }

    public function updates($newsId)
    {
        $item = $this->newsRepository->getNewsWithPhotosById($newsId);
        $type = $item->type;
        $others = $this->newsRepository->getOtherNewsByType($newsId, $type);
        
        return view('UserInteractions::updates', compact('others', 'item'));
    }

    public function create()
    {
        return view('message_form');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'organization_name' => 'nullable|string',
            'message' => 'required|string',
        ]);
        $companyEmail = "resilientstructures@gmail.com";

        // Dispatch the job
        SendContactFormMail::dispatch($validatedData);

        // Redirect back with success message or perform any other action
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
