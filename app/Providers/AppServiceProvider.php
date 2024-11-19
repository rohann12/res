<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use App\Models\News;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer(['UserInteractions::layouts.navbar', 'UserInteractions::layouts.footer'], function ($view) {
            $view->with('company', Company::first());
        });

        // View::composer('carousel', function ($view) {
        //     $view
        // });
        View::composer('UserInteractions::about', function ($view) {
            $welcomeText = Company::select('welcome_text')->first();
            $description = Company::select('description')->first();
            $employees = Employee::all();
            $view->with(['employees' => $employees, 'welcomeText' => $welcomeText, 'description' => $description]);
        });

        View::composer('UserInteractions::home', function ($view) {
            $projects = Project::with('photos')->where('featured', 1)->get();
            $clients = Client::select('logo_path','company_name')->get();
            $slogan = Company::select('slogan')->first();
            $news = News::select(
                'news.id',
                'news.title',
                'news.description',
                'news.type',
                'news.author',
                'news.created_at',
                DB::raw("(SELECT photo_path FROM photos
                     WHERE photos.news_id =news.id AND photos.is_cover = 1) as photo_path")
            )
                ->latest()
                ->limit(3)
                ->get();
            $view->with(['projects' => $projects, 'news' => $news,'slogan' => $slogan, 'clients' => $clients
            ])
                ->with('projectsCarousel', Project::where('on_carousel', 1)
                    ->select(
                        'projects.name',
                        'projects.short_description',
                        DB::raw("(SELECT photo_path FROM photos 
                    WHERE photos.project_id = projects.id AND photos.is_cover = 1) as photo_path")
                    )
                    ->get());;
        });

        View::composer('UserInteractions::about', function ($view) {
            $welcomeText = Company::select('welcome_text')->first();
            // $splitText = explode('</p>', $welcomeText);
            $description = Company::select('description')->first();
            $words = explode(' ', $description->description);
            $wordLimit = 93;
            $firstPart = implode(' ', array_slice($words, 0, $wordLimit));
            $secondPart = implode(' ', array_slice($words, $wordLimit));
            $slogan = Company::select('slogan')->first();
            $completed = Project::where('status', 'completed')->count();
            $running = Project::where('status', 'running')->count();
            $upcoming = Project::where('status', 'upcoming')->count();
           

            $employees = Employee::all();
            $view->with([
                'employees' => $employees,
                'slogan' => $slogan,
                'welcomeText' => $welcomeText,
                'descriptionfirst' => $firstPart ,
                'descriptionsecond' => $secondPart ,
                'completed' => $completed,
                'running' => $running,
                'upcoming' => $upcoming
            ]);
        });
    }
}