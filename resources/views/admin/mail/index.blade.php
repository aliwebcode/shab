@extends('admin.layouts.admin')
@section('title','لوحة التحكم - البريد')
@section('mail','active')
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
                                <h4 class="card-title d-inline-block">البريد</h4>
                                <div class="heading-elements">
                                    <a href="{{ route('admin.mail.add') }}" class="btn btn-sm round btn-info btn-glow">
                                        <i class="la la-plus font-medium-1"></i>
                                        <span>إضافة</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            <th>عنوان الرسالة</th>
                                            <th>تاريخ الإضافة</th>
                                            <th>حذف</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($mails) && count($mails) > 0)
                                            @foreach($mails as $mail)
                                                <tr>
                                                    <td>{{ $mail->title }}</td>
                                                    <td>{{ $mail->created_at }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm delete_element"
                                                                data-toggle="modal" data-id="{{ $mail->id }}"
                                                                data-target="#delete_model">
                                                            <i class="la la-trash-o font-large-1"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>عنوان الرسالة</th>
                                            <th>تاريخ الإضافة</th>
                                            <th>حذف</th>
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

    <div class="modal fade text-left" id="delete_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18">
                        <i class="la la-question"></i>
                        هل أنت متأكد؟
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>
                        لا يمكنك التراجع عن الحذف بعد التأكيد
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">
                        إلغاء
                    </button>
                    <form action="{{ route('admin.mail.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="mail_id" id="element_id" value="0">
                        <button type="submit" class="btn btn-outline-danger">
                            تأكيد
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $('.delete_element').click(function () {
            var id = $(this).attr('data-id');
            $('#element_id').attr('value',id);
        });
    </script>
@endpush
