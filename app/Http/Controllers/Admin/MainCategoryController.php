<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\mainCategoryRequest;
use App\MainCategories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=MainCategories::where('translation_language',mainLanguage())->selection()->get();
        return view('admin.maincategories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.maincategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->category);
        $messages=[
          'required'=>'MUST ENTER'
        ];
       Request()->validate([
            'category'=>'array|min:1',
            'category.*.name'=>'required',
           'category.*.translation_language'=>'required',
           'photo'=>'required|mimes:jpg,jpeg,png'

       ],$messages);
      try {
          $categories = collect($request->category);
          $filter_main_lang_category = $categories->filter(function ($value, $key) {
              return $value['translation_language'] == mainLanguage();
          });
          $main_lang_category = array_values($filter_main_lang_category->all())[0];
          //return $main_lang_category;
          //return $request->photo;

          if ($request->has('photo')) {
              $filePath = uploadImage('main_categories', $request->photo);
          }

          DB::beginTransaction();
          $main_lang_category_id = MainCategories::insertGetId([
              'name' => $main_lang_category['name'],
              'slug' => $main_lang_category['name'],
              'translation_language' => $main_lang_category['translation_language'],
              'translation_of' => 0,
              'photo' => $filePath,
              'active' => checkActive($request->active),
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);
          //return $main_lang_category_id;
          $filter_not_main_lang_categories = $categories->filter(function ($value, $key) {
              return $value['translation_language'] != mainLanguage();
          });
          foreach ($filter_not_main_lang_categories as $not_main_lang_category) {
              MainCategories::create([
                  'name' => $not_main_lang_category['name'],
                  'slug' => $not_main_lang_category['name'],
                  'translation_language' => $not_main_lang_category['translation_language'],
                  'translation_of' => $main_lang_category_id,
                  'photo' => $filePath,
                  'active' => checkActive($request->active),
              ]);
          }
          DB::commit();
          return redirect(route('main_categories.index'))->with('success','تم الاضافة بنجاح');
      }catch (\Exception $exception){
          DB::rollBack();
          return redirect(route('main_categories.index'))->with('error','برجاء المحاولة فى ما بعد');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $main_category=MainCategories::with('categories')->selection()->findorfail($id);
        return view('admin.maincategories.update',compact('main_category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $main_category=MainCategories::findorfail($id);
        $messages=[
            'required'=>'MUST ENTER'
        ];
        Request()->validate([
            'name'=>'required|unique:main_categories,name,'.$main_category->id,
            'category.*.name'=>'required',
            'category.*.translation_language'=>'required',

        ],$messages);
        //return ($request->category);
        if (!$request->active) {
            $active = 0;
        } else {
            $active = 1;
        }
        if ($request->has('photo')) {
            $filePath = uploadImage('main_categories', $request->photo);
            unlink($main_category->photo);
            $main_category->update([
                'name'=>$request->name,
                'active'=>$active,
                'photo'=>$filePath,
            ]);
            $categories=collect($request->category);
            foreach ($categories as $category){
                $not_main_category=MainCategories::findorfail($category['id']);
                $not_main_category->update([
                    'name'=>$category['name'],
                    'active'=>$active,
                    'photo'=>$filePath,
                ]);
            }
        }
        else{
            $main_category->update([
                'name'=>$request->name,
                'active'=>$active,
            ]);
            $categories=collect($request->category);
            foreach ($categories as $category){
                //return $category['id'];
                $not_main_category=MainCategories::findorfail($category['id']);
                $not_main_category->update([
                    'name'=>$category['name'],
                    'active'=>$active,
                ]);
            }

        }
        return redirect(route('main_categories.index'))->with('success','تم التعديل بنجاح');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $main_category=MainCategories::findorfail($id);
        //database relationship on update and delete is cascade so if you deleted a main_category and there is a table in relation
        // with this table main_categories for example the vendors , the vendor with relation to this main_category
        // that will be deleted will also be deleted so take care of the cascade + add observer
        if($main_category->vendors()->count() > 0)
        {
            return redirect(route('main_categories.index'))->with('error','لا يمكن حزف هذا القسم لانة يحتوى على تجار');

        }
        else{
            unlink($main_category->photo);
            $main_category->categories()->delete();
            $main_category->delete();
            return redirect(route('main_categories.index'))->with('success','تم الحزف بنجاح');

        }

    }
    public function status($id){
        $category=MainCategories::findorfail($id);
        $status=$category->active === 0 ? 1 : 0 ;
        $category->update(['active'=>$status]);
        return redirect(route('main_categories.index'))->with('success','تم تعديل الحالة بنجاح');

    }
}
