<?php

namespace Modules\ContentManagement\Controllers;

use App\Http\Controllers\Controller;
use Modules\ContentManagement\Repositories\NewsRepository;
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
        $news = $this->news->getAllWithCoverPhoto();
        return view('ContentManagement::news.news', compact('news', 'type'));
    }

    public function filterByType($type)
    {
        $news = $this->news->getByTypeWithPhotos($type);
        return view('ContentManagement::news.news', compact('news', 'type'));
    }

    public function create()
    {
        return view('ContentManagement::news.createNews');
    }

    public function store(Request $request)
    {
        $data = $this->news->validateData($request);

        if (!$data) {
            return redirect()->back()->withErrors($data)->withInput();
        }

        $news = $this->news->create($data);

        if ($request->hasFile('coverPhoto')) {
            $coverPhotoPath = $request->file('coverPhoto')->store('news', 'public');
            $this->news->addPhoto($news->id, $coverPhotoPath, true);
        }

        if ($request->hasFile('otherPhotos')) {
            foreach ($request->file('otherPhotos') as $photo) {
                $photoPath = $photo->store('news', 'public');
                $this->news->addPhoto($news->id, $photoPath, false);
            }
        }

        return redirect(route('news.index'))->with('success', 'News created successfully');
    }

    public function edit($id)
    {
        $news = $this->news->getNewsWithPhotosById($id);
        return view('ContentManagement::news.editNews', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->news->validateData($request, true);

        if (!$data) {
            return redirect()->back()->withErrors($data)->withInput();
        }

        $news = $this->news->update($id, $data);

        if ($request->hasFile('coverPhoto')) {
            $coverPhotoPath = $request->file('coverPhoto')->store('news', 'public');
            $this->news->updateCoverPhoto($news->id, $coverPhotoPath);
        }

        if ($request->hasFile('otherPhotos')) {
            $this->news->updateAdditionalPhotos($news->id, $request->file('otherPhotos'));
        }

        return redirect(route('news.index'))->with('success', 'News updated successfully');
    }

    public function destroy($id)
    {
        $this->news->delete($id);
        return redirect(route('news.index'))->with('success', 'News deleted successfully');
    }
}
