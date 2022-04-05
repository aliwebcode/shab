@extends('admin.layouts.admin')
@section('title','لوحة التحكم - طلبات التوثيق')
@section('activations','active')
@section('style')
    <style>
        #DataTables_Table_0_filter {
            float: left !important;
        }
    </style>
@endsection
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
                                <h4 class="card-title d-inline-block">طلبات التوثيق</h4>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            <th>المستخدم</th>
                                            <th>الوثيقة</th>
                                            <th>طريقة التوثيق</th>
                                            <th>تاريخ الطلب</th>
                                            <th>حالة الطلب</th>
                                            <th>تفاصيل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($activations) && count($activations) > 0)
                                            @foreach($activations as $activation)
                                                <tr>
                                                    <td>{{ $activation->user->name }}</td>
                                                    <td>
                                                        <img
                                                            src="{{ asset('storage/images/documents/' . $activation->image) }}"
                                                            width="80" height="80">
                                                    </td>
                                                    <td>{{ $activation->image_type }}</td>
                                                    <td>{{ $activation->created_at->format("Y-m-d") }}</td>
                                                    <td>
                                                        @if($activation->approved == 1)
                                                            <span class="text-success">مقبول</span>
                                                        @elseif($activation->approved == 0)
                                                            <span>معلق</span>
                                                        @else
                                                            <span class="text-danger">مرفوض</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.activations.show', $activation->id) }}" class="btn btn-info btn-sm delete_element">
                                                            <i class="la la-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>المستخدم</th>
                                            <th>الوثيقة</th>
                                            <th>طريقة التوثيق</th>
                                            <th>تاريخ الطلب</th>
                                            <th>حالة الطلب</th>
                                            <th>تفاصيل</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
