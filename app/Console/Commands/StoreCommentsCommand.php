<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Comment;

class StoreCommentsCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'command:StoreCommentsCommand';   // ここがコマンドの名前になる

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command description';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    for ($i = 1; $i <= 5; $i++) {
      usleep(1330000);  // 1.33 秒スリープする
      $comment = new Comment();
      $comment->title = $i . '件目のコメント';
      $comment->body = 'コメント' . $i . 'の本文';
      $comment->save();
    }
  }
}
