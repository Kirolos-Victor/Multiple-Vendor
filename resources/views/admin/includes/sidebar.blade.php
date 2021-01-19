<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href=""><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item"><a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">اللغات </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{\App\Language::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('languages.index')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('languages.create')}}" data-i18n="nav.dash.crypto">أضافة
                            لغة جديد </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الرئيسيه </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\MainCategories::where('translation_language',mainLanguage())->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('main_categories.index')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('main_categories.create')}}" data-i18n="nav.dash.crypto">أضافة
                            قسم رئيسي </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المتلجر  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{\App\Vendor::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('vendors.index')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض المتلجر </a>
                    </li>
                    <li><a class="menu-item" href="{{route('vendors.create')}}" data-i18n="nav.dash.crypto">أضافة
                            المتلجر </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
