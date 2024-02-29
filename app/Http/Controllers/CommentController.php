<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Repositories\CommentRepository\InterfaceCommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private InterfaceCommentRepository $interfaceCommentRepository;

    public function __construct(InterfaceCommentRepository $interfaceCommentRepository){
        $this->interfaceCommentRepository = $interfaceCommentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments=$this->interfaceCommentRepository->query()->where("user_id",Auth::id())->orderBy("id","desc")->paginate(5);
        return view("Comment.index",compact("comments"));
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
    public function store(CommentRequest $request)
    {
        $fullname=$request->fullname;
        $email=$request->email;
        $userId=null;
        if(Auth::check()){
            $user=Auth::user();
            $fullname=$user->first_name." ".$user->last_name;
            $email=$user->email;
            $userId=$user->id;
        }
        $data = [
            "fullname" => $fullname,
            "email" => $email,
            "comment" => $request->comment,
            "user_id" => $userId,
            "news_id" => $request->newsId,
            "parent_id" => $request->parentId
        ];
        $this->interfaceCommentRepository->insertData($data);
        return back()->with("message","نظرتان با موفقیت ثبت شد");
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
