<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img width="50" alt="image" class="rounded-circle" src="{{ Auth::user()->avatar }}" />
                    <a href="#">
                        <span class="block m-t-xs font-bold">{{ Auth::user()->name }}</span>
                    </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="{{ route('questions.index') }}">
                    <i class="fa-solid fa-house-user"></i>
                    <span class="nav-label">
                        الصفحة الرئيسية
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-large"></i>
                    <span class="fa arrow"></span>
                    <span class="nav-label">التحكم في التصنيفات</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="{{ route('admin.categories.create') }}">
                            <i class="fa-solid fa-circle-plus"></i>
                            إضافة تصنيف جديد
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}">
                            <i class="fa-solid fa-list"></i>
                            قائمة التنصيفات
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-th-large"></i>
                    <span class="fa arrow"></span>
                    <span class="nav-label">التحكم في الأسئلة</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="{{ route('admin.questions.index') }}?status=published">
                            <i class="fa-solid fa-list"></i>
                            قائمة الأسئلة المشورة
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.questions.index') }}?status=pending">
                            <i class="fa-solid fa-list"></i>
                            قائمة الأسئلة في إنتظار النشر
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-th-large"></i>
                    <span class="fa arrow"></span>
                    <span class="nav-label">التحكم في الإجابات</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="{{ route('admin.answers.index') }}?status=published">
                            <i class="fa-solid fa-list"></i>
                            قائمة الإجابات المشورة
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.answers.index') }}?status=pending">
                            <i class="fa-solid fa-list"></i>
                            قائمة الإجابات في إنتظار النشر
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-users"></i>
                    <span class="fa arrow"></span>
                    <span class="nav-label">التحكم في الأعضاء</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa-solid fa-list"></i>
                            قائمة الأعضاء
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}?filter=banned">
                            <i class="fa-solid fa-list"></i>
                            قائمة الأعضاء المحظورين
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}?filter=admins">
                            <i class="fa-solid fa-list"></i>
                            قائمة المديرين
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('admin.withdraw.index') }}">
                    <i class="fa-brands fa-paypal"></i>
                    <span class="nav-label">
                        طلبات السحب
                    </span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="fa arrow"></span>
                    <span class="nav-label">الإعدادات</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="{{ route('admin.setting','questions-and-answers') }}">
                            <i class="fa-solid fa-comments"></i>
                            الأسئلة و الإجابات
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.setting','points-and-balance') }}">
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                            النقاط و الرصيد
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.setting','activities') }}">
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                            نقاط النشاطات
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-paypal"></i>
                            <span class="fa arrow"></span>
                            <span class="nav-label">وسائل السحب</span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="{{ route('admin.payment_methods.create') }}">
                                    <i class="fa-solid fa-circle-plus"></i>
                                    إضافة وسيلة سحب
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.payment_methods.index') }}">
                                    <i class="fa-solid fa-list"></i>
                                    قائمة وسائل السحب
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>

    </div>
</nav>