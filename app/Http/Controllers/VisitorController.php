<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactFormMail;
use App\Models\Career;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Message;
use App\Models\News;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $news = News::all();
        return view('home', compact('projects', 'news'));
    }

    public function employeeDetails($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        return view('employeeDetails', compact('employee'));
    }
    public function contact()
    {
        $company = Company::first();
        return view('contact', compact('company'));
    }
    public function about()
    {
        return view('about');
    }
    public function news()
    {
        $all = News::select(
            'news.id',
            'news.title',
            'news.description',
            'news.type',
            'news.author',
            'news.created_at',
            DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.news_id = news.id AND photos.is_cover = 1) as photo_path")
        )->get();
        $news = News::select(
            'news.id',
            'news.title',
            'news.description',
            'news.type',
            'news.author',
            'news.created_at',
            DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.news_id = news.id AND photos.is_cover = 1) as photo_path")
        )->where('type', 'news')->get();
        $blog = News::select(
            'news.id',
            'news.title',
            'news.description',
            'news.type',
            'news.author',
            'news.created_at',
            DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.news_id = news.id AND photos.is_cover = 1) as photo_path")
        )->where('type', 'blog')->get();
        $article = News::select(
            'news.id',
            'news.title',
            'news.description',
            'news.type',
            'news.author',
            'news.created_at',
            DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.news_id = news.id AND photos.is_cover = 1) as photo_path")
        )->where('type', 'article')->get();
        $careers = News::select(
            'news.id',
            'news.title',
            'news.description',
            'news.type',
            'news.author',
            'news.created_at',
            DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.news_id = news.id AND photos.is_cover = 1) as photo_path")
        )->where('type', 'career')->get();
        $newsCount = News::where('type', 'news')->count();
        $articleCount = News::where('type', 'article')->count();
        $blogCount = News::where('type', 'blog')->count();
        $careerCount = News::where('type', 'career')->count();
        $allCount = News::count();

        return view('news', compact('all', 'blog', 'article', 'news', 'careers', 'newsCount', 'articleCount', 'blogCount', 'careerCount', 'allCount'));
    }

    public function services()
    {
        $services = Service::with('photos')->get();
        return view('services', compact('services'));
    }
    public function careers()
    {
        $careers = Career::all();
        return view('careers', compact('careers'));
    }
    public function serviceView($serviceId)
    {
        $service = Service::with('photos')->findOrFail($serviceId);
        return $service;
    }
    public function projects(Request $request)
    {
        $projectsAll = Project::with('photos')->get();
        $projectsCompleted = Project::with('photos')->where('status', 'completed')->get();
        $projectsRunning = Project::with('photos')->where('status', 'running')->get();
        $projectsUpcoming = Project::with('photos')->where('status', 'upcoming')->get();
        return view('projects', compact('projectsAll', 'projectsCompleted', 'projectsRunning', 'projectsUpcoming'));
   
;
    }

    public function newsView($newsId)
    {
        $item = News::with('photos')->findOrFail($newsId);
        $news = News::where('type', 'news')
            ->where('id', '!=', $newsId)
            ->select(
                'news.id',
                'news.title',
                'news.description',
                'news.type',
                'news.author',
                'news.created_at',
                DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.news_id = news.id AND photos.is_cover = 1) as photo_path")
            )->get();
        return view('newsView', compact('news', 'item'));
    }
    public function blogView($blogId)
    {
        $item = News::with('photos')->findOrFail($blogId);
        $blogs = News::where('type', 'blog')
            ->where('id', '!=', $blogId)
            ->select(
                'news.id',
                'news.title',
                'news.description',
                'news.type',
                'news.author',
                'news.created_at',
                DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.news_id = news.id AND photos.is_cover = 1) as photo_path")
            )->get();
        return view('blogView', compact('blogs', 'item'));
    }
    public function updates($newsId){
        $item = News::with('photos')->findOrFail($newsId);
        $type = $item->type;
        $others = News::where('type', $type)
            ->where('id', '!=', $newsId)
            ->select(
                'news.id',
                'news.title',
                'news.description',
                'news.type',
                'news.author',
                'news.created_at',
                DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.news_id = news.id AND photos.is_cover = 1) as photo_path")
            )->get();
        return view('updates', compact('others', 'item'));
    }
    public function articleView($articleId)
    {
        $item = News::with('photos')->findOrFail($articleId);
        $articles = News::where('type', 'article')
            ->where('id', '!=', $articleId)
            ->select(
                'news.id',
                'news.title',
                'news.description',
                'news.type',
                'news.author',
                'news.created_at',
                DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.news_id = news.id AND photos.is_cover = 1) as photo_path")
            )->get();
        return view('articleView', compact('articles', 'item'));
    }
    public function careerView($careerId)
    {
        $item = News::with('photos')->findOrFail($careerId);
        $careers = News::where('type', 'career')
            ->where('id', '!=', $careerId)
            ->select(
                'news.id',
                'news.title',
                'news.description',
                'news.type',
                'news.author',
                'news.created_at',
                DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.news_id = news.id AND photos.is_cover = 1) as photo_path")
            )->get();
        return view('careerView', compact('careers', 'item'));
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
