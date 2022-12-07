@section('navigation')
    <li class="has-submenu">
        <a href="#">
            <i data-feather="monitor" class="align-self-center icon-sm icon-dual-hori-nav mr-1"></i>
            <span>أوامر التوريد</span>
        </a>
        <ul class="submenu">
            <li>
                <a href="{{ route('shipment.index') }}">
                    <i class="fas fa-eye mr-2"></i>
                    متابعة الحركات</a>
            </li>
            <li>
                <a href="{{ route('shipment.create') }}">
                    <i class="fas fa-user-plus mr-2"></i>
                    أمر حركة جديد</a>
            </li>
            <li>
                <a href="{{ route('ShipmentDetails.last100') }}">
                    <i class="ti-car mr-2"></i>
                    آخر 100 عملية</a>
            </li>
        </ul>
    </li>

    <li class="has-submenu">
        <a href="#">
            <i data-feather="users" class="align-self-center icon-sm icon-dual-hori-nav mr-1 text-danger"></i>
            <span>المندوبين والعملاء</span>
        </a>
        <ul class="submenu">
            <li class="divider-custom">
                <div class="divider-text bg-light">المندوبين</div>
            </li>
            <li><a href="{{ route('representative.index') }}"><i class="fas fa-eye"></i> مشاهدة المندوبين </a></li>
            <li><a href="{{ route('representative.create') }}"><i class="fas fa-user-plus"></i> إضافة مندوب</a></li>

            <li class="divider-custom">
                <div class="divider-text bg-light">العملاء</div>
            </li>
            <li><a href="{{ route('client.index') }}"><i class="fas fa-eye"></i>  مشاهدة العملاء</a></li>
            <li><a href="{{ route('client.create') }}"><i class="fas fa-user-plus"></i> إضافة عميل</a></li>

            <li class="divider-custom">
                <div class="divider-text bg-light">السائقين</div>
            </li>
            <li><a href="{{ route('driver.index') }}"><i class="fas fa-eye"></i>  مشاهدة السائقين</a></li>
            <li><a href="{{ route('driver.create') }}"><i class="fas fa-user-plus"></i> إضافة سائق</a></li>

            <li class="divider-custom">
                <div class="divider-text bg-light">خطوط السير</div>
            </li>
            <li><a href="{{ route('itinerary.index') }}"><i class="fas fa-eye"></i>  مشاهدة خطوط السير</a></li>
            <li><a href="{{ route('itinerary.create') }}"><i class="fas fa-user-plus"></i> إضافة خط سير</a></li>
        </ul>
    </li>

    <li class="has-submenu">
        <a href="#">
            <i data-feather="user" class="align-self-center icon-sm icon-dual-hori-nav mr-1"></i>
            <span>المصروفات</span>
        </a>
        <ul class="submenu">

            <li class="divider-custom">
                <div class="divider-text bg-light">المصروفات</div>
            </li>
            <li>
                <a href="{{ route('expense.create') }}">
                    <i class="fas fa-eye"></i>
                    إثبات عملية صرف
                </a>
            </li>
            <li>
                <a href="{{ route('expense.index') }}">
                    <i class="fas fa-eye"></i>
                    مشاهدة آخر 100 مصروف
                </a>
            </li>
            <li>
                <a href="{{ route('expense_by_period') }}">
                    <i class="fas fa-eye"></i>
                    مشاهدة المصاريف خلال فترة
                </a>
            </li>
            <li class="divider-custom">
                <div class="divider-text bg-light">أنواع المصروفات</div>
            </li>
            <li>
                <a href="{{ route('expenseType.index') }}">
                    <i class="fas fa-eye"></i>
                    مشاهدة أنواع المصروفات
                </a>
            </li>
            <li>
                <a href="{{ route('expenseType.create') }}">
                    <i class="fas fa-user-plus"></i>
                    إضافة نوع مصاريف جديد
                </a>
            </li>
            <li class="divider-custom">
                <div class="divider-text bg-light">الحسابات والبنوك</div>
            </li>
            <li>
                <a href="{{ route('bank.index') }}">
                    <i class="fas fa-eye"></i>
                    مشاهدة حركة الخزنة
                </a>
            <li>
                <a href="{{ route('bank.index') }}">
                    <i class="fas fa-eye"></i>
                    مشاهدة الحسابات
                </a>
            </li>
            <li>
                <a href="{{ route('bank.create') }}">
                    <i class="fas fa-user-plus"></i>
                    إضافة حساب جديد
                </a>
            </li>
        </ul>
    </li>

    <li class="has-submenu">
        <a href="#">
            <i data-feather="truck" class="align-self-center icon-sm icon-dual-hori-nav mr-1"></i>
            <span>شركات الشحن</span>
        </a>
        <ul class="submenu">
            <li><a href="{{ route('transportation.index') }}"><i class="fas fa-eye"></i> مشاهدة </a></li>
            <li><a href="{{ route('transportation.create') }}"><i class="ti-car"></i> إضافة </a></li>
        </ul>
    </li>

    <li class="has-submenu">
        <a href="#">
            <i data-feather="file-text" class="align-self-center icon-sm icon-dual-hori-nav mr-1"></i>
            <span>البونات</span>
        </a>
        <ul class="submenu">
            <li><a href="{{ route('coupon.create') }}"><i class="mdi mdi-expand-all text-success"></i>إضافة بون</a></li>
            <li><a href="{{ route('coupon.unused') }}"><i class="mdi mdi-script text-success"></i>لم تستخدم</a></li>
            <li><a href="{{ route('coupon.index') }}"><i class="mdi mdi-script text-primary"></i> كل البونات</a></li>
            <li><a href="{{ route('coupon.used') }}"><i class="ti-trash text-danger"></i>تم استخدامهم</a></li>
        </ul>
    </li>

    <li class="has-submenu">
        <a href="#">
            <i data-feather="grid" class="align-self-center icon-sm icon-dual-hori-nav mr-1"></i>
            <span>مصانع الأسمنت</span>
        </a>
        <ul class="submenu">
            <li><a href="{{ route('manufactory.index') }}"><i class="fas fa-eye"></i> مشاهدة </a></li>
            <li><a href="{{ route('manufactory.create') }}"><i class="ti-car"></i> إضافة </a></li>
        </ul>
    </li>

    <li class="has-submenu">
        <a href="#">
            <i data-feather="users" class="align-self-center icon-sm icon-dual-hori-nav mr-1"></i>
            <span>المساهمين</span>
        </a>
        <ul class="submenu">
            <li><a href="{{ route('bond.index') }}"><i class="fas fa-eye"></i> مشاهدة </a></li>
            <li><a href="{{ route('bond.create') }}"><i class="fas fa-user-plus"></i> إيداع </a></li>
            <li><a href="{{ route('bond.withdraw') }}"><i class="fas fa-user-plus"></i> سحب </a></li>
            <li><a href="{{ route('bond.funds_movement') }}"><i class="fas fa-user-plus"></i> متابعة حركة الأموال </a></li>
            <li><a href="{{ route('bond.create') }}"><i class="fas fa-user-plus"></i> تسوية المبالغ </a></li>
        </ul>
    </li>
    <li class="has-submenu">
        <a class="" data-toggle="dropdown" href="#"
            <i class="ti-bell noti-icon"></i>
            <span class="badge badge-danger badge-pill noti-icon-badge">2</span>
        </a>


        <ul class="submenu">
            <li><a href="{{ route('bond.index') }}"><i class="fas fa-eye"></i> xxxxxx </a></li>
            <li><a href="#" class="dropdown-item py-3">
                <small class="float-right text-muted pl-2">2 دقيقة مضت</small>
                <div class="media">
                    <div class="avatar-md bg-primary">
                        <i class="la la-cart-arrow-down text-white"></i>
                    </div>
                    <div class="media-body align-self-center ml-2 text-truncate">
                        <h6 class="my-0 font-weight-normal text-dark">تم استلام الشحنة</h6>
                        <small class="text-muted mb-0">تم تأكيد الشراء</small>
                    </div><!--end media-body-->
                </div><!--end media-->
            </a><!--end-item--></li>
            <!-- item-->
            <li><a href="#" class="dropdown-item py-3">
                <small class="float-right text-muted pl-2">10 دقائق مضت</small>
                <div class="media">
                    <div class="avatar-md bg-success">
                        <i class="la la-group text-white"></i>
                    </div>
                    <div class="media-body align-self-center ml-2 text-truncate">
                        <h6 class="my-0 font-weight-normal text-dark">تم شراء بونات</h6>
                        <small class="text-muted mb-0">برجاء مراجعة المصنع لشراء كمية أكثر</small>
                    </div><!--end media-body-->
                </div><!--end media-->
            </a><!--end-item--></li>
            <!-- item-->
            <li><a href="#" class="dropdown-item py-3">
                <small class="float-right text-muted pl-2">40 دقيقة</small>
                <div class="media">
                    <div class="avatar-md bg-pink">
                        <i class="la la-list-alt text-white"></i>
                    </div>
                    <div class="media-body align-self-center ml-2 text-truncate">
                        <h6 class="my-0 font-weight-normal text-dark">تم الاستلام</h6>
                        <small class="text-muted mb-0">مشكلة فى السيارات</small>
                    </div><!--end media-body-->
                </div><!--end media-->
            </a><!--end-item--></li>
            <!-- item-->
           <li> <a href="#" class="dropdown-item py-3">
                <small class="float-right text-muted pl-2">1 ساعة</small>
                <div class="media">
                    <div class="avatar-md bg-warning">
                        <i class="la la-truck text-white"></i>
                    </div>
                    <div class="media-body align-self-center ml-2 text-truncate">
                        <h6 class="my-0 font-weight-normal text-dark">تم الشراء</h6>
                        <small class="text-muted mb-0">تمت العملية بنجاح</small>
                    </div><!--end media-body-->
                </div><!--end media-->
            </a><!--end-item--></li>
            <!-- item-->
            <li><a href="#" class="dropdown-item py-3">
                <small class="float-right text-muted pl-2">2 ساعة</small>
                <div class="media">
                    <div class="avatar-md bg-info">
                        <i class="la la-check-circle text-white"></i>
                    </div>
                    <div class="media-body align-self-center ml-2 text-truncate">
                        <h6 class="my-0 font-weight-normal text-dark">تم التحصيل</h6>
                        <small class="text-muted mb-0">مشلكة مع عميل</small>
                    </div><!--end media-body-->
                </div><!--end media-->
            </a><!--end-item--></li>
            <!-- All-->
            <li><a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                View all <i class="fi-arrow-right"></i>
            </a></li>
        </ul>
    </li>


    <li class="has-submenu">
    <li class="has-submenu">
        <a href="#">
            <img src="{{asset('assets/images/users/user-1.png')}}" alt="profile-user" class="rounded-circle" style="width: 50px; height: 50px;" />
            <span class="ml-1 nav-user-name hidden-sm">محمود هيكل <i class="mdi mdi-chevron-down"></i> </span>
        </a>
        <ul class="submenu">
            <li><a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i> الملف الشخصى</a></li>
            <li><a class="dropdown-item" href="#"><i class="ti-wallet text-muted mr-2"></i> محفظتى</a></li>
            <li><a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i> الإعدادت</a></li>
            <li><a class="dropdown-item" href="#"><i class="ti-lock text-muted mr-2"></i> عملياتى</a></li>
            <div class="dropdown-divider mb-0"></div>
           <li> <a class="dropdown-item" href="#"><i class="ti-power-off text-muted mr-2"></i> تسجيل الخروج</a></li>
        </ul>
    </li>

@endsection
