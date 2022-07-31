@extends('layouts.master')

@section('css')

@section('title')
    اضافة صلاحية
@stop

 <!--Internal  Font Awesome -->
 <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
 <!--Internal  treeview -->
 <link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الصلاحيات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/اضافة
                مستخدم</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')





@if (count($errors) > 0)

    <div>

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif



{!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">

                    <div class="col-xs-7 col-sm-7 col-md-7">

                        <div class="form-group">

                            <p>اسم الصلاحية:</p>
							{{-- {!! Form::text('name', null, array('class' => 'form-control')) !!} --}}
                            {{-- {!! Form::text('name', null, array('class' => 'form-control')) !!} --}}
							{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}


                        </div>

                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-4">

                        <strong>Permission:</strong>

                        <ul id="treeview1">
                            <li><a href="#">الصلاحيات</a>
                                <ul>
                                    @foreach ($permission as $value)
                                        
											<label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}


                                            {{ $value->name }}</label>

                                        <br />
                                    @endforeach

                                </ul>
                            </li>
                        </ul>


                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                    <button class="btn btn-main-primary type=" submit">تأكيد</button>

                </div>

            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}




@endsection
@section('js')
<script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>

@endsection
