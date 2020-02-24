<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
  public function index()
  {
    $comments = Comment::orderBy('created_at', 'DESC')
                          ->paginate(10);
    $cnt = Comment::count();
    return view('comments.index')
          ->with('cnt', $cnt)
          ->with('comments', $comments);
  }

  public function create()
  {
    return view('comments.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'numberOfComments' => 'required|integer|min:1|max:1000'
    ]);

    // コマンドを準備して実行する
    $artisan = base_path() . '/artisan command:StoreCommentsCommand';
    $argument = $request->numberOfComments;
    $command = "php {$artisan} {$argument}";
    // ここを有効にしてどのようなコマンドが実行されるのか確認すると良い．
    // dd("nohup {$command} > /dev/null &");
    exec("nohup {$command} > /dev/null &");

    return redirect('/comments');
  }
}
