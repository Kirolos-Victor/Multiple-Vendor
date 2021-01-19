<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\langRequest;
use App\Language;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function index()
    {
        $languages=Language::selection()->get();
        return view('admin.languages.index',compact('languages'));

    }

    public function create()
    {
        return view('admin.languages.create');
    }


    public function store(langRequest $request)
    {


        Language::create(['name'=>$request->name,
            'abbreviation'=>$request->abbreviation,
            'direction'=>$request->direction,
            'active'=>checkActive($request->active)]);
        //dd($lang);
        return redirect(route('languages.index'))->with('success','تم اضافه اللغه بنجاح');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $lang=Language::findorfail($id);
        return view('admin.languages.update',compact('lang'));
    }


    public function update(langRequest $request, $id)
    {
        if(!$request->active){
            $active = 0;
        }else{
            $active=1;
        }

        //dd($active);
        $lang=Language::findorfail($id);
        $lang->update([$request->except('_token','active'),'active'=>$active]);
        return redirect(route('languages.index'))->with('success','تم تعديل اللغة بنجاح');
    }

    public function destroy($id)
    {
        $lang=Language::findorfail($id);
        $lang->delete();
        return redirect()->back()->with('success','تم حزف اللغة بنجاح');
    }
}
