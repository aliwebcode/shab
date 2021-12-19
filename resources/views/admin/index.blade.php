@extends('admin.layouts.admin')
@section('title','لوحة التحكم - الرئيسية')
@section('index','active open')
@section('sidebarMain','active')
<style>
    body, .card-body h4, .card-header .card-title {
        font-family: 'Cairo', sans-serif !important;
    }

    table tr td, table tr, table th {
        text-align: center;
    }

    table tr td a i.la {
        font-size: 30px;
        margin: 0 5px;
    }
    .heading-elements span {
        font-size: 1.1rem !important;
    }
</style>
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="card bg-info">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="la la-check-square text-white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">11</h3>
                                            <span>الخدمات</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="card bg-danger">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="la la-image text-white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">12</h3>
                                            <span>معرض الأعمال</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="card bg-success">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="la la-users text-white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">10</h3>
                                            <span>مشتركين</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="card bg-warning">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-pointer text-white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">5</h3>
                                            <span>Total Visits</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            {{-- Section 2 --}}

            @if(isset($courses) && $courses->count() > 0)
                <!-- Latest Courses -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">أحدث الكورسات</h4>
                                </div>
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-de mb-0" style="font-size: 14px;">
                                            <thead>
                                            <tr>
                                                <th>الصورة</th>
                                                <th>اسم الكورس</th>
                                                <th>رابط الكورس</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($courses as $course)
                                                <tr>
                                                    <td><img
                                                                src="{{ asset('storage/images/'.$course->image) }}"
                                                                width="100"
                                                                height="100"
                                                        ></td>
                                                    <td>{{ $course->name }}</td>
                                                    <td>
                                                        <a href="{{ $course->link }}">
                                                            <i class="la la-external-link"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="card">
                            <div class="card-header pb-2">
                                <h4 class="text-left">خيارات سريعة</h4>
                                <div class="heading-elements">
                                    <a href="#" class="btn btn-info mx-1">
                                        إضافة خدمة
                                    </a>
                                    <a href="#" class="btn btn-info mx-1">
                                        إضافة عمل
                                    </a>
                                    <a href="#" class="btn btn-info mx-1">
                                        إضافة كتالوج
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>


@endsection
