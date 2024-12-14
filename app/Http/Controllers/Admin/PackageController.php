<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public $error;

    public function lists()
    {
        $package = Package::orderBy('id', 'desc')->paginate(10)->fragment('type');
        return view('dashboard.pages.package.lists', compact('package'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('dashboard.pages.package.generate');
        }
        // dd($request);
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required|string',
                'price' => 'nullable|string',
                'total_products' => 'string',
                'total_users' => 'string',
                'anti_fake_detection' => 'string',
                'create_import_qr' => 'string',
                'fake_detection_alert' => 'string',
                'product_sold_alert' => 'string',
                'out_stock_notifications' => 'string',
                'permissions_system' => 'string',
                'advanced_analytics_system' => 'string',
                'stores_listing' => 'string',
                'managers_dashboard' => 'string',
                'unlimited_lotteries' => 'string',
                'consumers_database_collector' => 'string',
                'ordering' => 'string',
                'is_active' => 'boolean',
                'image_path' => 'required|file|mimes:png,jpg,jpeg,webp',
            ]);

            DB::beginTransaction();
            try {
                // dd($request);
                $logo_path = null;
                if ($request->hasFile('image_path')) {
                    $fileName = $request->file('image_path');
                    $logo_path = $this->fileUpload($request->name, $fileName, 'image_path');
                }

                // create price
                $package = new Package;
                $package->name = $request->name;
                $package->price = $request->price;
                $package->total_products = $request->total_products;
                $package->total_users = $request->total_users;
                $package->total_models = $request->total_models;
                $package->anti_fake_detection = $request->anti_fake_detection ?? '0';
                $package->create_import_qr = $request->create_import_qr ?? '0';
                $package->fake_detection_alert = $request->fake_detection_alert ?? '0';
                $package->product_sold_alert = $request->product_sold_alert ?? '0';
                $package->out_stock_notifications = $request->out_stock_notifications ?? '0';
                $package->permissions_system = $request->permissions_system ?? '0';
                $package->advanced_analytics_system = $request->advanced_analytics_system ?? '0';
                $package->stores_listing = $request->stores_listing ?? '0';
                $package->managers_dashboard = $request->managers_dashboard ?? '0';
                $package->unlimited_lotteries = $request->unlimited_lotteries ?? '0';
                $package->consumers_database_collector = $request->consumers_database_collector ?? '0';
                $package->ordering = $request->ordering;
                $package->image_path = $logo_path ?? '';
                $package->is_active = setIsActive();
                $package->save(); // saving code

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $this->error = 'Ops! looks like we had some problem';
                $this->error = $e->getMessage();
                return redirect()->route('admin.package.generate')->with('error-message', $this->error);
            }

            return redirect()->route('admin.package.lists')->with('success', 'Code has been generated successfully.');
        }
    }

    public function update(Request $request, $id)
    {
        $package = Package::find($id);

        if ($request->isMethod('get')) {
            return view('dashboard.pages.package.update', compact('package'));
        }
        // dd($request);
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required|string',
                'price' => 'nullable|string',
                'total_products' => 'string',
                'total_users' => 'string',
                'anti_fake_detection' => 'string',
                'create_import_qr' => 'string',
                'fake_detection_alert' => 'string',
                'product_sold_alert' => 'string',
                'out_stock_notifications' => 'string',
                'permissions_system' => 'string',
                'advanced_analytics_system' => 'string',
                'stores_listing' => 'string',
                'managers_dashboard' => 'string',
                'unlimited_lotteries' => 'string',
                'consumers_database_collector' => 'string',
                'ordering' => 'string',
                'is_active' => 'boolean',
            ]);

            DB::beginTransaction();
            try {
                // dd($request);
                $logo_path = null;
                if ($request->hasFile('image_path')) {
                    $fileName = $request->file('image_path');
                    $logo_path = $this->fileUpload($request->name, $fileName, 'image_path');
                    $package->image_path = $logo_path ?? '';
                }

                $package->name = $request->name;
                $package->price = $request->price;
                $package->total_products = $request->total_products;
                $package->total_users = $request->total_users;
                $package->total_models = $request->total_models;
                $package->anti_fake_detection = $request->anti_fake_detection ?? '0';
                $package->create_import_qr = $request->create_import_qr ?? '0';
                $package->fake_detection_alert = $request->fake_detection_alert ?? '0';
                $package->product_sold_alert = $request->product_sold_alert ?? '0';
                $package->out_stock_notifications = $request->out_stock_notifications ?? '0';
                $package->permissions_system = $request->permissions_system ?? '0';
                $package->advanced_analytics_system = $request->advanced_analytics_system ?? '0';
                $package->stores_listing = $request->stores_listing ?? '0';
                $package->managers_dashboard = $request->managers_dashboard ?? '0';
                $package->unlimited_lotteries = $request->unlimited_lotteries ?? '0';
                $package->consumers_database_collector = $request->consumers_database_collector ?? '0';
                $package->ordering = $request->ordering;
                $package->is_active = setIsActive();
                $package->save(); // saving code

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $this->error = 'Ops! looks like we had some problem';
                $this->error = $e->getMessage();
                return redirect()->route('admin.package.generate')->with('error-message', $this->error);
            }

            return redirect()->route('admin.package.lists')->with('success', 'Code has been generated successfully.');
        }
    }

    protected function fileUpload($name, $file, $type = null)
    {
        try {
            $currentTime = time(); // time in sec
            $imageName = $name . '-' . $currentTime . '-' . $type . '.' . $file->getClientOriginalExtension(); // full image name
            $imgPath = 'price'; // full path
            $file->move(storage_path("app/public/" . $imgPath), $imageName);
            return 'storage/' . $imgPath . '/' . $imageName;
        } catch (\Exception $e) {
            $this->error = 'Ops! looks like we had some problem: ' . $e->getMessage();
            \Log::error($this->error);
        }
    }

    public function show($packageId = 0)
    {
        $package = Package::find($packageId);
        $status = $package->is_active ? 'text-success' : 'text-danger';
        $html = "";
        if (!empty($package)) {
            $html = "<div class='show-card'>
                        <div class='img-avatar'>
                            <img src='" . asset($package->image_path) . "' alt='image_path' />
                        </div>
                        <div class='show-card-text'>

                            <div class='title-total'>
                                <div class='title " . $status . "'>" .
            ($package->is_active ? 'Active' : 'Inactive') . "
                                </div>
                                <h2>" . $package->name . "</h2>

                                <div class='desc'>" . $package->price . "</div>
                                <div class='desc'>" . $package->total_products . "</div>
                                <div class='desc'>" . $package->total_users . "</div>
                                <div class='desc'>" . $package->total_models . "</div>

                            </div>
                        </div>
                    </div>";
        }
        $response['html'] = $html;

        return response()->json($response);
    }
}
