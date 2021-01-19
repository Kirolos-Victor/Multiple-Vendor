<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\vendorRequest;
use App\MainCategories;
use App\Notifications\VendorNotify;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;//YOU MUST USE THIS FACADE because it supports notification::send()
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function index()
    {
        $vendors=Vendor::with('main_category')->selection()->paginate(10);
       // dd($vendors);
        return view('admin.vendors.index',compact('vendors'));
    }


    public function create()
    {
        $categories=MainCategories::where('translation_language',mainLanguage())->active()->select(['id','name'])->get();
        return view('admin.vendors.create',compact('categories'));
    }


    public function store(vendorRequest $request)
    {
        //return $request;
        if ($request->has('logo_image')) {
            $filePath = uploadImage('vendors', $request->logo_image);
        }

        $vendor=Vendor::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'main_category_id'=>$request->category_id,
            'logo_image'=>$filePath,
            'active'=>checkActive($request->active),
            'password' =>$request->password,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude
            ]);
       // if($vendor)
        //        {
        //            //            Notification::send($notifiable, new VendorNotify(construct));
        //            Notification::send($vendor, new VendorNotify());
        //        }
        return redirect(route('vendors.index'))->with('success','تم اضافة المتجر بنجاح');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $vendor=Vendor::findorfail($id);
        //return $vendor;
        $categories=MainCategories::Main_categories_select()->active()->select(['id','name'])->get();

        return view('admin.vendors.update',compact('vendor','categories'));
    }


    public function update(vendorRequest $request, $id)
    {
        //return $request->password;
        $vendor=Vendor::findorfail($id);
        if ($request->has('logo_image')) {
            unlink($vendor->logo_image);
            $filePath = uploadImage('vendors', $request->logo_image);
            $vendor->update([
                'logo_image'=>$filePath,
            ]);
        }
        if($request->password){
            $vendor->update([
                'password'=>$request->password,
            ]);
        }


        $vendor->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'main_category_id'=>$request->category_id,
            'active'=>checkActive($request->active),
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude
        ]);
        //return $vendor;
        return redirect(route('vendors.index'))->with('success','تم التعديل بنجاح');

    }

    public function destroy($id)
    {
        $vendor=Vendor::findorfail($id);
        $vendor->delete();
        unlink($vendor->logo_image);
        return redirect(route('vendors.index'))->with('success','تم الحزف بنجاح');
    }
    public function status($id){
        $vendor=Vendor::findorfail($id);
        $mainCategoryActive=$vendor->main_category->active;
        if($mainCategoryActive == 0)
        {
            return redirect(route('vendors.index'))->with('error','لا يمكن تفعيل');

        }
        else
        {
            $status=$vendor->active === 0 ? 1 : 0 ;
            $vendor->update(['active'=>$status]);
            return redirect(route('vendors.index'))->with('success','تم تعديل الحالة بنجاح');

        }


    }
}
