@extends('layouts.app')

@section('content')
    <section class="element-section white-section">
        <div class="container">
            <br> <br> <br>
            <h1 class="black-element-title element-title" style="font-size:25px">تسجيل الدخول</h1>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <form action="{{ route('login') }}" method="post"
                          class="contact-form-white d-flex flex-column align-items-center element-form-left">
                        @csrf
                        @error('email')
                        <div class="alert alert-danger text-center w-100">
                            <i class="fa fa-info-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        @error('password')
                        <div class="alert alert-danger text-center w-100">
                            <i class="fa fa-info-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        <input type="text" placeholder="البريد الألكتروني" class="input-small" name="email">
                        <input type="password" placeholder=" كلمة المرور" class="input-small" name="password">
                        <button style="font-size: 17px;" class="button-submit" type="submit">تسجيل الدخول</button>
                        <a href="#">هل نسيت كلمه السر ؟</a>
                    </form>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </section>
@endsection
