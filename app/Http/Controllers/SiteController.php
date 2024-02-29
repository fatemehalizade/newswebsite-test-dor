<?php

namespace App\Http\Controllers;

use App\Repositories\NewsRepository\InterfaceNewsRepository;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private InterfaceNewsRepository $interfaceNewsRepository;
    public function __construct(InterfaceNewsRepository $interfaceNewsRepository){
        $this->interfaceNewsRepository = $interfaceNewsRepository;
    }
    public function index(){
        $latestNews=$this->interfaceNewsRepository->getAll()->paginate(4);
        return view("Site.index",compact("latestNews"));
    }
    public function detail(int $id){
        $news=$this->interfaceNewsRepository->findById($id);
        if($news){
            $this->interfaceNewsRepository->updateItem($id,[
                "views" => $news->views+1
            ]);
            return view("Site.detail",compact("news"));
        }
        return view("notfound");
    }
}
