<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use App\Traits\File\FileUploadTrait;

class CustomAuthController extends Controller
{
use FileUploadTrait;
    public $error;
    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            dd(123);
            return view('dashboard.pages.login');
        }

        if ($request->isMethod('POST')) {
            $credentials = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $credentials["is_active"] = 1;

            #$credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {

                // Distributor
                if (isDistributor() || isDistributorStaff()) {
                    return to_route("distributor.dashboard");
                }

                // Partner
                if (isPartner() || isPartnerStaff()) {
                    return to_route("partner.dashboard");
                }

                return redirect()->route('admin.dashboard')->with('success', "Wel-come back admin");
            }

            return redirect()->route('login')->with('error_message', 'Login details are not valid');
        }
    }

    public function showLinkRequestForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('dashboard.pages.password-reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function show()
    {
        return view('dashboard.version1.pages.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_type' => 'required',
            'username' => 'required|unique:users',
            'full_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'cpassword' => 'required_with:password|same:password|min:6',
            'photo' => 'required|file|mimes:png,jpg,jpeg,webp',
            'card_number' => 'required_if:user_type,=,client|numeric|digits_between:16,19',
            'card_holder_name' => 'required_if:user_type,=,client',
            'card_exipre' => ['required_if:user_type,=,client','regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/'],
            'card_cvv' => ['required_if:user_type,=,client', 'numeric', 'regex:/^([0-9]{3})$/'],
            'business_name' => 'required_if:user_type,=,client',
            'business_address' => 'required_if:user_type,=,client',
            'vat_no' => 'required_if:user_type,=,client',
            'attachment' => 'required_if:user_type,=,client|mimes:png,jpg,jpeg,webp,pdf',
        ]);

        $logo_path = null;
        if ($request->hasFile('photo')) {
            $logo_path = $this->uploadFile($request->file("photo"), fileService()::DIR_USER_IMAGE);
        }

        $attachment = null;
        if ($request->hasFile('attachment')) {
            $attachment = $this->uploadFile($request->file("attachment"), fileService()::DIR_CLIENT_IMAGE);
        }

        $password = Hash::make($request->password);

        $full_name = explode(" ", $request->full_name);
        if(count($full_name) == 3){
            $firstname = $full_name[0];
            $middlename = $full_name[1];
            $lastname = $full_name[2];
        }else if(count($full_name) == 2){
            $firstname = $full_name[0];
            $middlename = '';
            $lastname = $full_name[1];
        }

        $insertUser = [
            'first_name' => $firstname,
            'middle_name' => $middlename,
            'last_name' => $lastname,
            'email' => $request->email,
            'password' => $password,
            'username' => $request->username,
            'user_type' => $request->user_type,
            'photo' => $logo_path
        ];

        $user_id = User::create($insertUser);

        $id = $user_id->id;

        if($request->user_type == "client"){
            $userInsert = [
                "card_number" => base64_encode($request->card_number),
                "card_holder_name" => $request->card_holder_name,
                "card_exipre" => $request->card_exipre,
                "card_cvv" => base64_encode($request->card_cvv),
                "business_name" => $request->business_name,
                "business_address" => $request->business_address,
                "vat_no" => $request->vat_no,
                "attachment" => $attachment,
                "user_id" => $id
            ];

            Client::create($userInsert);
        }

        #$credentials = $request->only('username', 'password');
        // if (Auth::attempt($credentials)) {

        //     // Distributor
        //     if (isDistributor() || isDistributorStaff()) {
        //         return to_route("distributor.dashboard");
        //     }

        //     // Partner
        //     if (isPartner() || isPartnerStaff()) {
        //         return to_route("partner.dashboard");
        //     }

        //     return redirect()->route('admin.dashboard')->with('success', "Wel-come back admin");
        // }

        return redirect()->route('login')->with('success', 'Successfully Register '.ucfirst($request->user_type));

    }

    protected function fileUpload($name, $file, $type = null)
    {
        try {
            $currentTime = time(); // time in sec
            $imageName = $name . '-' . $currentTime . '-' . $type . '.' . $file->getClientOriginalExtension(); // full image name
            $imgPath = 'image'; // full path
            $file->move(storage_path("app/public/" . $imgPath), $imageName);
            return 'storage/' . $imgPath . '/' . $imageName;
        } catch (\Exception $e) {
            $this->error = 'Ops! looks like we had some problem: ' . $e->getMessage();
            \Log::error($this->error);
        }
    }
}
