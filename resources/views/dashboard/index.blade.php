@extends('layouts.master')

@section('content')
    <div class="min-h-screen bg-violet-400 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- Top Bar / Header --}}
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        خوش آمدید، {{ auth()->user()->name ?? 'کاربر گرامی' }} 👋
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        پنل مدیریت و داشبورد کاربری شما
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <x-logout-button
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 transition duration-150 text-white text-sm font-medium rounded-xl shadow-sm" />
                </div>
            </div>

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Card 1 --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">سفارش‌ها / تسک‌ها</span>
                        <h3 class="text-3xl font-extrabold text-gray-800 mt-2">۲۴</h3>
                        <span class="text-xs text-emerald-600 font-medium mt-1 inline-block">↑ ۱۲٪ نسبت به ماه قبل</span>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-xl text-2xl">
                        📊
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">پیام‌های جدید</span>
                        <h3 class="text-3xl font-extrabold text-gray-800 mt-2">۵</h3>
                        <span class="text-xs text-gray-400 font-medium mt-1 inline-block">پاسخ داده نشده</span>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl text-2xl">
                        💬
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">وضعیت حساب</span>
                        <h3 class="text-xl font-bold text-emerald-600 mt-2">فعال</h3>
                        <span class="text-xs text-gray-400 font-medium mt-1 inline-block">پلن ویژه</span>
                    </div>
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl text-2xl">
                        ⚡
                    </div>
                </div>
            </div>

            {{-- Main Table / Content Area --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">فعالیت‌های اخیر</h2>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-700">مشاهده همه</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase font-semibold">
                            <tr>
                                <th class="py-3 px-6">عنوان</th>
                                <th class="py-3 px-6">تاریخ</th>
                                <th class="py-3 px-6">وضعیت</th>
                                <th class="py-3 px-6 text-left">عملیات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6 font-medium text-gray-900">بروزرسانی پروفایل</td>
                                <td class="py-4 px-6">امروز، ۱۴:۲۰</td>
                                <td class="py-4 px-6">
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-50 rounded-full">
                                        موفق
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <button class="text-gray-400 hover:text-gray-600">جزئیات</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6 font-medium text-gray-900">تغییر رمز عبور</td>
                                <td class="py-4 px-6">دیروز، ۱۰:۱۵</td>
                                <td class="py-4 px-6">
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-50 rounded-full">
                                        موفق
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <button class="text-gray-400 hover:text-gray-600">جزئیات</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
