<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRegisterPostRequest;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{ /**
     * トップページ を表示する
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.register');
    }


    //会員の新規登録
    public function register(UserRegisterPostRequest $request)
    {
         // validate済みのデータの取得
        $datum = $request->validated();
        //var_dump($datum); exit;
        
        //パスワードのHash化
        $datum['password'] = Hash::make($datum['password']);
        
        // テーブルへのINSERT
        $r = UserModel::create($datum);
        //var_dump($r); exit;
        
        // タスク登録成功
        $request->session()->flash('front.user_register_success', true);
        
        //topに戻る
        return redirect('/');
        
    }

}