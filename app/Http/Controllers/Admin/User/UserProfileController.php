<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use App\Models\Partner;
use App\Models\User;
use App\Models\Client;
use App\Traits\File\FileUploadTrait;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    use FileUploadTrait;

    public function userProfile()
    {
        $user = Auth::user();
        $client = Client::where('user_id',$user->id)->first();
        return view('dashboard.version1.users.user_profile',compact('user', 'client'));
    }

    public function userProfileUpdate(UserProfileUpdateRequest $request)
    {
        $user = Auth::user();
        if($user->user_type == 'admin' || $user->user_type == 'partner' || $user->user_type == 'client' || $user->user_type == 'individual'){
            if($user->user_type == 'client' || $user->user_type == 'individual'){
                $full_name = explode(" ", $request->full_name);
                if(count($full_name) == 3){
                    $user->first_name = $full_name[0];
                    $user->middle_name = $full_name[1];
                    $user->last_name = $full_name[2];
                }else if(count($full_name) == 2){
                    $user->first_name = $full_name[0];
                    $user->middle_name = '';
                    $user->last_name = $full_name[1];
                }
            }else{
                $user->first_name = $request->first_name;
                $user->middle_name = $request->middle_name;
                $user->last_name = $request->last_name;
            }
            $user->username = $request->username;
            $user->email = $request->email;
            if($request->hasFile("photo")){

                if(isset($user->photo)){
                    $previousImagePath = public_path($user->photo);
                }

                $user->photo = $this->uploadFile($request->file("photo"), fileService()::DIR_USER_IMAGE);

                if(isset($previousImagePath)){
                    if($previousImagePath && file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
            }

            $user->update();
            
            if($user->user_type == 'client'){

                $client = new Client;
                $insert = ["card_number" => base64_encode($request->card_number),
                    "card_holder_name" => $request->card_holder_name,
                    "card_exipre" => $request->card_exipre,
                    "card_cvv" => base64_encode($request->card_cvv),
                    "business_name" => $request->business_name,
                    "business_address" => $request->business_address,
                    "vat_no" => $request->vat_no,
                ];
                if($request->hasFile("attachment")){
                    if(isset($client->attachment)){
                        $previousImagePath = public_path($client->attachment);
                    }
                    $insert['attachment'] = $this->uploadFile($request->file("attachment"), fileService()::DIR_CLIENT_IMAGE);
                    if(isset($previousImagePath)){
                        if($previousImagePath && file_exists($previousImagePath)) {
                            unlink($previousImagePath);
                        }
                    }
                }

                $client->where("user_id",$user->id)->update($insert);
            }
            if($user->user_type == 'admin' || $user->user_type == 'partner' || $user->user_type == 'client' || $user->user_type == 'individual'){
                return redirect()->back()->with('success', 'Profile Information Updated Successfully');
            }
        }
    }
}
