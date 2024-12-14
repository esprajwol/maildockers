<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Services\Models\Package\PackageService;
use App\Services\Models\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, userService $userService)
    {
        $users = $userService->getAll(true, null);

        return view('dashboard.users.index', compact('users'));
    }

    public function create(Request $request)
    {
        return view('dashboard.users.add_user');
    }

    public function store(UserStoreRequest $request, UserService $userService)
    {
        //dd($request->all());

        try{
            \DB::beginTransaction();
            $user = $userService->store($request->getData());
            \DB::commit();
            //dd($user);
            flashMessage("User created successfully");

            return to_route("admin.users.index");
        }
        catch(\Throwable $e){
            \DB::rollBack();
            commonLog("Failed to store User", errorArray($e));

            ddError($e);

        }
    }

    public function edit(User $user)
    {
        //dd($distrackModel->all());
        $data["user"] = $user;
        /*$data["parentUsers"] = $userService->getAll(false, null );
        $data["packages"] = $packageService->getAll(false );*/

        return view("dashboard.users.edit_user")->with($data);
    }

    public function update(UserUpdateRequest $request, User $user, UserService $userService)
    {
        //dd($request->all());
        try{
            \DB::beginTransaction();
            $distrackModel = $userService->update($user, $request->getData());
            \DB::commit();


            flashMessage("User updated successfully");

            return to_route("admin.users.index");

        }
        catch(\Throwable $e){
            \DB::rollBack();
            commonLog("Failed to store User", errorArray($e));

            ddError($e);

        }
    }

    public function destroy(Request $request, User $user)
    {
        try{
            if(!empty($user->photo)){
                $image = public_path($user->photo);
                if ($image && file_exists($image)) {
                    unlink($image);
                }
            }
            $user->delete();

            flashMessage("User deleted successfully");

            return to_route("admin.users.index");
        }
        catch(\Throwable $e){
            commonLog("Failed to Delete Model", errorArray($e));

            ddError($e);
        }
    }
}
