<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserPasswordResetRequest;
use App\Services\Models\User\UserPasswordResetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPasswordResetController extends Controller
{
    public function userPasswordReset(){
        $data['user'] = user();
        return view('dashboard.version1.users.form_user_password_reset')->with($data);
    }
    public function updatePassword(UserPasswordResetRequest $request, UserPasswordResetService $userPasswordResetService)
    {
        //dd($request->all());
        try{
            \DB::beginTransaction();
            $user = user();
            $user = $userPasswordResetService->update($user, $request->getData());
            \DB::commit();


            flashMessage("Password updated successfully");
            return redirect()->back();

            //return to_route("admin.partners.index");

        }
        catch(\Throwable $e){
            \DB::rollBack();
            commonLog("Failed to update Password", errorArray($e));

            ddError($e);

        }
       /* $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('success', 'Current Password is not correct !');
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password successfully updated');*/
    }
}
