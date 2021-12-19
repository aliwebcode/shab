@extends('admin.layouts.admin')
@section('title','لوحة التحكم - إضافة بريد جديد')
@section('mail','active')
@section('style')
    <style>
        .gallery.show {
            padding: 10px;
            background-color: #eee;
            border-radius: 4px;
            margin: 10px 0;
        }
        .gallery img {
            margin: 5px;
            width: 100px;
            height: 100px;
            border-radius: 7px;
        }
    </style>
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center">إضافة بريد جديد</h2>
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <p class="alert alert-warning">
                                    <i class="la la-warning"></i>
                                    {{ $error }}
                                </p>
                            @endforeach
                        @endif
                        @if(session()->get('msg'))
                            <p class="alert alert-success">{{ session()->get('msg') }}</p>
                        @endif
                        <a href="{{ route('admin.mail.index') }}" class="btn btn-info mb-2">
                            <i class="la la-angle-right" style="font-size: 14px;"></i>
                            <span>رجوع</span>
                        </a>
                        <div class="card p-2">
                            <div class="card-content">
                                <form action="{{ route('admin.mail.save') }}"
                                      method="post">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label>عنوان الرسالة</label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>نص الرسالة</label>
                                        <textarea class="form-control" name="message" cols="30" rows="10" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-info" value="إضافة">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
