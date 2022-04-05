@extends('admin.layouts.admin')
@section('title','لوحة التحكم - طلب توثيق ')
@section('activations','active')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        @if(session()->get('msg'))
                            <p class="alert alert-success">{{ session()->get('msg') }}</p>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">طلب توثيق</h4>
                            </div>
                            <div class="card-content p-2">
                                <div class="row text-center">
                                    <div class="col-12 col-md-3">
                                        <h6>المستخدم</h6>
                                        <h6 class="mt-2"><strong>{{ $activation->user->name }}</strong></h6>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <h6>طريقة التوثيق</h6>
                                        <h6 class="mt-2"><strong>{{ $activation->image_type }}</strong></h6>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <h6>تاريخ الطلب</h6>
                                        <h6 class="mt-2"><strong>{{ $activation->created_at->format("Y-m-d") }}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <h6>حالة الطلب</h6>
                                        <h6 class="mt-2">
                                            @if($activation->approved == 1)
                                                <strong class="text-success">مقبول</strong>
                                            @elseif($activation->approved == 0)
                                                <strong>معلق</strong>
                                            @else
                                                <strong class="text-danger">مرفوض</strong>
                                            @endif
                                        </h6>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <h6>
                                            <strong>الوثيقة</strong>
                                            <br/>
                                            <br/>
                                            <span>اضغط على الصورة لتحميلها</span>
                                        </h6>
                                        <a href="{{ asset('storage/images/documents/' . $activation->image) }}"
                                           download>
                                            <img class="mt-2"
                                                 src="{{ asset('storage/images/documents/' . $activation->image) }}">
                                        </a>
                                    </div>
                                    @if($activation->approved == 0)
                                        <div class="col-12 mt-3">
                                            <form action="{{ route('admin.activations.change_status') }}" method="post" class="d-inline-block">
                                                @csrf
                                                <input type="hidden" name="status" value="1">
                                                <input type="hidden" name="id" value="{{ $activation->id }}">
                                                <button type="submit" class="btn btn-success">قبول</button>
                                            </form>
                                            <form action="{{ route('admin.activations.change_status') }}" method="post" class="d-inline-block">
                                                @csrf
                                                <input type="hidden" name="status" value="-1">
                                                <input type="hidden" name="id" value="{{ $activation->id }}">
                                                <button type="submit" class="btn btn-danger">رفض</button>
                                            </form>
                                        </div>
                                    @elseif($activation->approved == 1)
                                        <div class="col-12 mt-3">
                                            <form action="{{ route('admin.activations.change_status') }}" method="post" class="d-inline-block">
                                                @csrf
                                                <input type="hidden" name="status" value="-1">
                                                <input type="hidden" name="id" value="{{ $activation->id }}">
                                                <button type="submit" class="btn btn-danger">إلغاء التوثيق</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
