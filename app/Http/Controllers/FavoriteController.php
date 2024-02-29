<?php

namespace App\Http\Controllers;

use App\Enums\BoolStatus;
use App\Http\Requests\Favorite\FavoriteRequest;
use App\Models\Favorite;
use App\Repositories\FavoriteRepository\InterfaceFavoriteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    private InterfaceFavoriteRepository $interfaceFavoriteRepository;

    public function __construct(InterfaceFavoriteRepository $interfaceFavoriteRepository){
        $this->interfaceFavoriteRepository = $interfaceFavoriteRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites=$this->interfaceFavoriteRepository->getUserFavorites(Auth::id())->paginate(5);
        return view("Favorite.index",compact("favorites"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FavoriteRequest $request)
    {
        $is_active=null;
        $checkNews=$this->interfaceFavoriteRepository->checkUserFavorite($request->newsId,Auth::id())->first();
        if($checkNews){
            if($checkNews->is_active == BoolStatus::yes)
                $is_active=BoolStatus::no;
            else
                $is_active=BoolStatus::yes;
            $this->interfaceFavoriteRepository->updateItem($checkNews->id,[
                "is_active" => $is_active
            ]);
        }
        else
            $this->interfaceFavoriteRepository->insertData([
                "user_id" => Auth::id(),
                "news_id" => $request->newsId
            ]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $checkNews=$this->interfaceFavoriteRepository->checkUserFavorite($id,Auth::id())->where("is_active",BoolStatus::yes)->first();
        if($checkNews){
            $this->interfaceFavoriteRepository->updateItem($checkNews->id,[
                "is_active" => BoolStatus::no
            ]);
            Session::flash('success', "اطلاعات خبر، با موفقیت از لیست علاقه مندیتان حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
