@extends('layouts.master')

@section('css')
@section('title')
    قائمة الفواتير
@stop
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمة
                الفواتير</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<!-- row -->
<div class="row">
    <!-- row opened -->



    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                {{-- <div class="d-flex justify-content-between"> --}}
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="invoices/create">
                        <i class="fas fa-plus"></i>
    اضافة فاتورة

                    </button> --}}
                    <a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i>
                        &nbsp; اضافة فاتورة
                    </a>

                    <a href="export_invoice" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                        class="fas fa-file-download"></i>
                    &nbsp; تصدير اكسيل
                </a>
                {{-- </div> --}}

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">رقم الفاتورة</th>
                                <th class="border-bottom-0">تاريخ الفاتورة</th>
                                <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                <th class="border-bottom-0">المنتج</th>
                                <th class="border-bottom-0">القسم</th>
                                <th class="border-bottom-0">الحسم</th>
                                <th class="border-bottom-0">نسبة الضريبة</th>
                                <th class="border-bottom-0">قيمة الضريبة</th>
                                <th class="border-bottom-0">الاجمالي</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">ملاحظات</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($invoices as $x)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }} </td>
                                    <td>{{ $x->invoice_number }}</td>
                                    <td>{{ $x->invoice_Date }}</td>
                                    <td>{{ $x->Due_date }}</td>
                                    <td>{{ $x->product }}</td>
                                    {{-- <td>{{ $x-> section->section_name}}</td> --}}
                                    <td>
                                        <a
                                            href="{{ url('InvoicesDetails') }}/{{ $x->id }}">{{ $x->section->section_name }}</a>
                                          

                                    </td>
                                    <td>{{ $x->Discount }}</td>
                                    <td>{{ $x->Rate_VAT }}</td>
                                    <td>{{ $x->Value_VAT }}</td>
                                    <td>{{ $x->Total }}</td>
                                    <td>

                                        @if ($x->Value_Status == 1)
                                            <span class="text-success">{{ $x->Status }}</span>
                                        @elseif($x->Value_Status == 2)
                                            <span class="text-danger">{{ $x->Status }}</span>
                                        @else
                                            <span class="text-warning">{{ $x->Status }}</span>
                                        @endif

                                    </td>
                                    <td>{{ $x->note }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                            <div class="dropdown-menu tx-13">

                                                <a class="dropdown-item"
                                                    href=" {{ url('edit_invoice') }}/{{ $x->id }}">تعديل
                                                    الفاتورة</a>
                                                <a class="dropdown-item" data-toggle="modal"
                                                    data-target="#exampleModaldelete" href="#"
                                                    data-invoice_id="{{ $x->id }}"> <i
                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                    الفاتورة</a>

                                                <a class="dropdown-item"
                                                    href=" {{ url('updat_invoice') }}/{{ $x->id }}">
                                                    {{-- href=" {{ url::route('updat_invoice' , [$x->id]) }}"> --}}
                                                    <i class="fas fa-caret-square-right"
                                                        style='color:green'></i>&nbsp;&nbsp;تحديث
                                                    الفاتورة</a>


                                                <a class="dropdown-item" data-toggle="modal"
                                                    data-target="#exampleModalmove" href="#"
                                                    data-invoice_id="{{ $x->id }}"> <i
                                                        class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;
                                                    نقل الى الأرشفة</a>

                                                    <a class="dropdown-item"
                                                    href=" {{ url('print_invoice') }}/{{ $x->id }}">
                                                    {{-- href=" {{ url::route('updat_invoice' , [$x->id]) }}"> --}}
                                                    <i class="fa fa-print"
                                                        style='color:green'></i>&nbsp;&nbsp;طباعة
                                                    الفاتورة</a>


                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- -delete --}}
    <div class="modal fade" id="exampleModaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف فاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('invoices/destroy') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="text" name="invoice_id" id="invoice_id" value="">
                        {{-- <input class="form-control" name="invoice_name" id="invoice_name" type="text" readonly> --}}
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">حذف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- -move --}}

    <div class="modal fade" id="exampleModalmove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نقل الى الأرشيف</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('invoices/destroy') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الأرشفة ؟</p><br>
                        <input type="text" name="invoice_id" id="invoice_id" value="">
                        <input type="text" name="page_id" id="page_id" value="2">
                        {{-- <input class="form-control" name="invoice_name" id="invoice_name" type="text" readonly> --}}
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">تأكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<script>
    $('#exampleModaldelete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var invoice_id = button.data('invoice_id')

        var modal = $(this)

        modal.find('.modal-body #invoice_id').val(invoice_id);
    })
</script>

<script>
    $('#exampleModalmove').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var invoice_id = button.data('invoice_id')

        var modal = $(this)

        modal.find('.modal-body #invoice_id').val(invoice_id);
    })
</script>

@endsection
