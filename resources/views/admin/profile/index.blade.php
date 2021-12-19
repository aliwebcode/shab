@extends('admin.layouts.admin')
@section('title','لوحة التحكم - الملف الشخصي ')
@section('profile','active open')
<style>
    body, .card-body h4, .card-header .card-title {
        font-family: 'Cairo', sans-serif !important;
    }
</style>
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        @if(session()->get('msg'))
                            <p class="alert alert-success text-center mb-4">{{ session()->get('msg') }}</p>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">تعديل بياناتي</h4>
                            </div>
                            <div class="card-content p-2">
                                <form action="{{ route('admin.profile.update') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>البريد الالكتروني</label>
                                        <input
                                                type="email"
                                                class="form-control"
                                                name="email"
                                                value="{{ $admin->email }}"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label>كلمة المرور</label>
                                        <input
                                                type="password"
                                                class="form-control"
                                                name="password"
                                                placeholder="كلمة المرور الجديدة"
                                                required
                                        >
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">تعديل</button>
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
