<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use App\Repositories\CategoryRepository\InterfaceCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    private InterfaceCategoryRepository $interfaceCategoryRepository;
    public function __construct(InterfaceCategoryRepository $interfaceCategoryRepository){
        $this->interfaceCategoryRepository = $interfaceCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=$this->interfaceCategoryRepository->getParentCategories()->get();
        return view("Category.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=$this->interfaceCategoryRepository->getParentCategories()->get();
        return view("Category.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $parentId=0;
        $level=1;
        if($request->parentId){
            $parentInfo=$this->interfaceCategoryRepository->findById($request->parentId);
            $parentId=$parentInfo->id;
            $level=$parentInfo->level+1;
        }
        $data = [
            "name" => $request->name,
            "level" => $level,
            "parent_id" => $parentId
        ];
        $this->interfaceCategoryRepository->insertData($data);
        Session::flash('success', "اطلاعات دسته جدید با موفقیت ثبت شد");
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
        $category=$this->interfaceCategoryRepository->findById($id);
        if($category){
            $categories=$this->interfaceCategoryRepository->getParentCategories()->get();
            return view("Category.edit",compact("category","categories"));
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id)
    {
        $parentId=0;
        $level=1;
        if($request->parentId){
            $parentInfo=$this->interfaceCategoryRepository->findById($request->parentId);
            $parentId=$parentInfo->id;
            $level=$parentInfo->level+1;
        }
        $data = [
            "name" => $request->name,
            "level" => $level,
            "parent_id" => $parentId
        ];
        if($this->interfaceCategoryRepository->updateItem($id,$data)){
            Session::flash('success', "اطلاعات دسته موردنظر با موفقیت ویرایش شد");
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
        try {
            if($this->interfaceCategoryRepository->deleteData($id)){
                Session::flash('success', "دسته موردنظر با موفقیت حذف شد");
                return redirect()->back();
            }
            Session::flash('fails', "اطلاعات نادرست است!");
            return redirect()->back();
        }
        catch (\Exception $ex){
            DB::rollBack();
            if($ex->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                // return error to user here
                Session::flash('fails', "از اطلاعات دسته موردنظر، در اطلاعات دیگر استفاده شده است و قادر به حذف آن نمی باشید!");
            }
            else{
                Session::flash('fails', $ex->getMessage() . ' - ' . $ex->getTraceAsString());
            }
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function totalDelete(Request $request)
    {
        try {
            if($request->deletedIds && count($request->deletedIds)){
                if($this->interfaceCategoryRepository->deleteTotal($request->deletedIds)){
                    Session::flash('success', "دسته های موردنظر با موفقیت حذف شدند");
                    return redirect()->back();
                }
            }
            Session::flash('fails', "دسته های موردنظرتان را انتخاب کنید");
            return redirect()->back();
        }
        catch (\Exception $ex){
            DB::rollBack();
            if($ex->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                // return error to user here
                Session::flash('fails', "از اطلاعات بعضی دسته ها، در اطلاعات دیگر استفاده شده است و قادر به حذف آنها نمی باشید!");
            }
            else{
                Session::flash('fails', $ex->getMessage() . ' - ' . $ex->getTraceAsString());
            }
            return redirect()->back();
        }
    }
}
