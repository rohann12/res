<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Photo;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{


    protected $news;

    public function __construct(NewsRepository $news)
    {
        $this->news = $news;
    }

    public function index(Request $request)
    {
        $type = $request->query('type');
        $news = $this->news->with('photos')->latest()->paginate(5);
        return view('admin.news.news', compact('news', 'type'));
    }

    public function filterByType($type)
    {
        $news = News::with('photos')->where('type', $type)->latest()->paginate(5);

        return view('admin.news.news', compact('news', 'type'));
    }
    public function create()
    {
        return view('admin.news.createNews');
    }


    public function store(Request $request)
    {
        // Define common validation rules
        $commonRules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string',
            'type' => 'required|in:news,article,blog,career',
            'otherPhotos.*' => 'nullable|image|max:21048', // Common rule for other photos
        ];

        // Check if type is 'career' and adjust validation rules accordingly
        if ($request->input('type') === 'career') {
            $rules = array_merge($commonRules, [
                'coverPhoto' => 'required|mimes:pdf|max:21048',
            ]);
        } else {
            $rules = array_merge($commonRules, [
                'coverPhoto' => 'required|image|max:21048',
            ]);
        }

        // Validate the request data
        $data = $request->validate($rules);

        if (!$data) {
            return redirect()->back()->withErrors($data)->withInput();
        }
        $news = News::create($data);

        if ($request->hasFile('coverPhoto')) {
            $coverPhotoPath = $request->file('coverPhoto')->store('news', 'public');

            $coverPhoto = new Photo();
            $coverPhoto->news_id = $news->id;
            $coverPhoto->photo_path = $coverPhotoPath;
            $coverPhoto->is_cover = true;
            $coverPhoto->save();
        }

        if ($request->hasFile('otherPhotos')) {
            foreach ($request->file('otherPhotos') as $photo) {
                $photoPath = $photo->store('news', 'public');

                $photoModel = new Photo();
                $photoModel->news_id = $news->id;
                $photoModel->is_cover = false;
                $photoModel->photo_path = $photoPath;
                $photoModel->save();
            }
        }
        return redirect(route('news.index'))->with('success', 'News created successfully');
    }

    public function edit(News $news)
    {
        return view('admin.news.editNews', ['news' => $news]);
    }

    public function update(Request $request, News $news)
    {

        // Define common validation rules
        $commonRules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string',
            'type' => 'in:news,article,blog,career',
            'otherPhotos.*' => 'nullable|image|max:21048', // Common rule for other photos
        ];

        // Check if type is 'career' and adjust validation rules accordingly
        if ($request->input('type') === 'career') {
            $rules = array_merge($commonRules, [
                'coverPhoto' => 'mimes:pdf|max:21048',
            ]);
        } else {
            $rules = array_merge($commonRules, [
                'coverPhoto' => 'image|max:21048',
            ]);
        }
        
        // Validate the request data
        $data = $request->validate($rules);
        

        if (!$data) {
            return redirect()->back()->withErrors($data)->withInput();
        }

        $news->update($data);


        if ($request->hasFile('coverPhoto')) {

            $coverPhotoPath = $request->file('coverPhoto')->store('news', 'public');

            $oldCoverPhoto = $news->photos()->where('is_cover', true)->first();
            if ($oldCoverPhoto) {
                unlink(storage_path('app/public/' . $oldCoverPhoto->photo_path));
                $oldCoverPhoto->delete();
            }

            $coverPhoto = new Photo();
            $coverPhoto->news_id = $news->id;
            $coverPhoto->photo_path = $coverPhotoPath;
            $coverPhoto->is_cover = true;
            $coverPhoto->save();
        }

        if ($request->hasFile('otherPhotos')) {

            // Remove existing additional photos from storage and database before adding new ones
            $existingAdditionalPhotos = $news->photos()->where('is_cover', false)->get();
            foreach ($existingAdditionalPhotos as $oldAdditionalPhoto) {
                $photoPath = storage_path('app/public/' . $oldAdditionalPhoto->photo_path);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
                $oldAdditionalPhoto->delete();
            }

            foreach ($request->file('otherPhotos') as $photo) {
                $photoPath = $photo->store('news', 'public');

                $additionalPhoto = new Photo();
                $additionalPhoto->news_id = $news->id;
                $additionalPhoto->is_cover = false;
                $additionalPhoto->photo_path = $photoPath;
                $additionalPhoto->save();
            }
        }

        return redirect(route('news.index'))->with('success', 'News updated successfully');
    }

    public function destroy(News $news)
    {
        foreach ($news->photos as $photo) {
            unlink(storage_path('app/public/' . $photo->photo_path));
            $photo->delete();
        }
        $news->delete();
        return redirect(route('news.index'))->with('success', 'News deleted successfully');
    }
}
