@extends('layouts.master')
@section('css')

@section('title')
    اضافة مستخدم
@stop

<!-- Internal Nice-select css  -->
<link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />

@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/اضافة
                مستخدم</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (count($errors) > 0)

    <div>

        <strong>خطأ!</strong>

        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif







<div class="row">


    <div class="col-lg-12 col-md-12">


        <div class="card">
            <div class="card-body">
                <div>
                    <a href="{{ route('users.index') }}" class="modal-effect btn btn-sm btn-primary"
                        style="color:white">
                        رجوع
                    </a>
                </div>
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    {{ csrf_field() }}
                    {{-- 1 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label"> اسم المستخدم
                                <span class="tx-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="col">
                            <label>البريد الالكتروني
                                <span class="tx-danger">*</span>
                            </label>
                            <input class="form-control " name="email" type="email" required>
                        </div>



                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col">
                            <label> كلمة المرور
                                <span class="tx-danger">*</span>
                            </label>
                            <input class="form-control " name="password" type="password" required>
                        </div>

                        <div class="col">
                            <label> تأكيد كلمة المرور
                                <span class="tx-danger">*</span>
                            </label>
                            <input class="form-control " name="confirm-password" type="password" required>


                        </div>


                    </div>


                    {{-- 3 --}}

                    <div class="row">


                        <div class="col">
                            <label for="inputName" class="control-label">حالة المستخدم</label>
                            <select name="status" id="status" class="form-control">
                                <!--placeholder-->

                                <option value="مفعل">مفعل</option>
                                <option value="غير مفعل">غير مفعل</option>
                            </select>
                        </div>

                    </div>







                    <div class="row">


                        <div class="col">
                            <label for="inputName" class="control-label">صلاحية المستخدم:</label>


                            {!! Form::select('roles_name[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}

                        </div>

                    </div><br><br>



                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                        <button class="btn btn-main-primary type=" submit">تأكيد</button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
@endsection
