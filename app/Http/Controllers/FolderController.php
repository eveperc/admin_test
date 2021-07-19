<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    public function showCreateForm()
    {
      return view('admin/folders/create');
    }

    public function create(CreateFolder $request)
    {
      //フォルダモデルのインスタンスを作成する
      $folder = new Folder();
      //タイトルに入力値を代入する
      $folder->title = $request->title;
      //インスタンスの状態をデータべースに書き込む
      $folder->save();

      return redirect()->route('admin.tasks.index',[
        'id' => $folder->id,
      ]);
    }
}
