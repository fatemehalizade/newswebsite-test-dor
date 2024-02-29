<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\NewsRequest;
use App\Models\News;
use App\Repositories\CategoryRepository\InterfaceCategoryRepository;
use App\Repositories\NewsRepository\InterfaceNewsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    private InterfaceNewsRepository $interfaceNewsRepository;
    private InterfaceCategoryRepository $interfaceCategoryRepository;

    public function __construct(InterfaceNewsRepository $interfaceNewsRepository,InterfaceCategoryRepository $interfaceCategoryRepository){
        $this->interfaceNewsRepository = $interfaceNewsRepository;
        $this->interfaceCategoryRepository = $interfaceCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $news=$this->interfaceNewsRepository->getAll()->paginate(5);
        if($request->searchText)
            $news=$this->interfaceNewsRepository->search($request->searchText)->get();
        return view("News.index",["news" => $news,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=$this->interfaceCategoryRepository->getParentCategories()->get();
        return view("News.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        $path=null;
        $image=$request->file("image");
        if($image)
            $path=UploadFunc($image,"news");
        $data = [
            "code" => "news_".rand(1000,9999),
            "image" => $path,
            "title" => $request->title,
            "category_id" => $request->categoryId,
            "user_id" => Auth::id(),
            "published_at" => $request->publishedAtH,
            "summary" => $request->summary,
            "description" => $request->description
        ];

        $this->interfaceNewsRepository->insertData($data);
        Session::flash('success', "خبر جدید با موفقیت ثبت شد");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $news=$this->interfaceNewsRepository->findById($id);
        if($news){
            $categories=$this->interfaceCategoryRepository->getParentCategories()->get();
            return view("News.edit",compact("news","categories"));
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, int $id)
    {
        $news=$this->interfaceNewsRepository->findById($id);
        if($news) {
            $path = $news->image;
            $image = $request->file("image");
            if ($image){
                if($news->image)
                    unlink("storage/".$news->image);
                $path = UploadFunc($image, "news");
            }
            $data = [
                "image" => $path,
                "title" => $request->title,
                "category_id" => $request->categoryId,
                "user_id" => Auth::id(),
                "published_at" => $request->publishedAtH,
                "summary" => $request->summary,
                "description" => $request->description
            ];

            $this->interfaceNewsRepository->updateItem($id,$data);
            Session::flash('success', "اطلاعات خبر با موفقیت ویرایش شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $news=$this->interfaceNewsRepository->findById($id);
        if($news) {
            if($news->image)
                unlink("storage/".$news->image);
            $this->interfaceNewsRepository->deleteData($id);
            Session::flash('success', "اطلاعات خبر با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
