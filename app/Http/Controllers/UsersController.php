<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
      public function __construct(){
        //  除了此处指定的动作以外，所有其他动作都必须登录用户才能访问
        $this->middleware('auth',['except'=>['show']]
    );
      }
     
    public function show(User $user){
        return view('users.show',compact('user'));
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

     public function update(UserRequest $request, User $user,ImageUploadHandler $uploader)
    {
        $this->authorize('update', $user);
        //   dd($request->avatar);
        $data = $request->all();
         if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
