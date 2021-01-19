@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> الاقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل - {{$main_category -> name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل قسم رئيسي </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('main_categories.update',$main_category -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <input name="id" value="{{$main_category -> id}}" type="hidden">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="{{asset($main_category -> photo)}}"
                                                        class="rounded-circle  height-150" alt="صورة القسم  ">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label> صوره القسم </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم {{__('messages.'.$main_category -> translation_language)}}</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم القسم
                                                                - {{__('messages.'.$main_category -> translation_language)}} </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$main_category -> name}}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 hidden">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أختصار
                                                                اللغة {{__('messages.'.$main_category -> translation_lang)}} </label>
                                                            <input type="text" id="abbr"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$main_category -> translation_lang}}"
                                                                   name="translation_language">

                                                            @error("translation_language")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>
                                                @isset($main_category -> categories)
                                                    @foreach($main_category -> categories   as $index =>  $translation)


                                                                <input name="id" value="{{$translation -> id}}" type="hidden">


                                                                <div class="form-body">

                                                                    <h4 class="form-section"><i class="ft-home"></i> بيانات القسم {{__('messages.'.$translation -> translation_language)}} </h4>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="projectinput1"> اسم القسم
                                                                                    - {{__('messages.'.$translation -> translation_language)}} </label>
                                                                                <input type="text" id="name"
                                                                                       class="form-control"
                                                                                       placeholder="  "
                                                                                       value="{{$translation -> name}}"
                                                                                       name="category[{{$index}}][name]">
                                                                                @error("category.0.name")
                                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 hidden">
                                                                            <div class="form-group">
                                                                                <label for="projectinput1"> أختصار
                                                                                    اللغة {{__('messages.'.$translation -> translation_language)}} </label>
                                                                                <input type="text" id="abbr"
                                                                                       class="form-control"
                                                                                       placeholder="  "
                                                                                       value="{{$translation -> translation_language}}"
                                                                                       name="category[{{$index}}][translation_language]">

                                                                                @error("category.0.translation_language")
                                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 hidden">
                                                                            <div class="form-group">
                                                                                <input type="text" id="abbr"
                                                                                       class="form-control"
                                                                                       placeholder="  "
                                                                                       value="{{$translation -> id}}"
                                                                                       name="category[{{$index}}][id]">

                                                                                @error("category.0.translation_language")
                                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                        </div>

                                                    @endforeach
                                                @endisset

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"
                                                                   name="active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   value="1"
                                                                   {{$main_category->active?'checked':''}}/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>
                                                            @error('active')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> تحديث
                                            </button>
                                        </form>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                </section>
                        </div>
                    </div>
                <!-- // Basic form layout section end -->
            </div>


@endsection
