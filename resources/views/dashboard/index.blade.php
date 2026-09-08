{{-- اول از همه به لاراول بگو که این صفحه از لایوت مستر ارث‌بری می‌کنه --}}
@extends('layouts.master') 

{{-- مشخص کن که این بخش باید توی قسمت @yield('content') در فایل مستر قرار بگیره --}}
@section('content')

    {{-- کدهای اصلی تو اینجا قرار می‌گیرن --}}
    <x-logout-button class="btn btn-danger" />

@endsection
