@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Elements</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Tabs</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
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
    @if (session()->has('add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">Basic Style Tabs</h6>
                        <p class="text-muted card-sub-title">It is Very Easy to Customize and it uses in your website
                            apllication.</p>
                    </div>
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                    data-toggle="tab">معلومات الفاتورة</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link"
                                                    data-toggle="tab">حالات الدفع</a></li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link"
                                                    data-toggle="tab">المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">رقم الفاتورة</th>
                                                            <td>{{ $invoices1->invoice_number }}</td>
                                                            <th scope="row">تاريخ الاصدار</th>
                                                            <td>{{ $invoices1->invoice_Date }}</td>
                                                            <th scope="row">تاريخ الاستحقاق</th>
                                                            <td>{{ $invoices1->Due_date }}</td>
                                                            <th scope="row">القسم</th>
                                                            <td>{{ $invoices1->section->section_name }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">المنتج</th>
                                                            <td>{{ $invoices1->product }}</td>
                                                            <th scope="row">مبلغ التحصيل</th>
                                                            <td>{{ $invoices1->Amount_collection }}</td>
                                                            <th scope="row">مبلغ العمولة</th>
                                                            <td>{{ $invoices1->Amount_Commission }}</td>
                                                            <th scope="row">الخصم</th>
                                                            <td>{{ $invoices1->Discount }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">نسبة الضريبة</th>
                                                            <td>{{ $invoices1->Rate_VAT }}</td>
                                                            <th scope="row">قيمة الضريبة</th>
                                                            <td>{{ $invoices1->Value_VAT }}</td>
                                                            <th scope="row">الاجمالي مع الضريبة</th>
                                                            <td>{{ $invoices1->Total }}</td>
                                                            <th scope="row">الحالة الحالية</th>

                                                            @if ($invoices1->Value_Status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $invoices1->Status }}</span>
                                                                </td>
                                                            @elseif($invoices1->Value_Status == 2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $invoices1->Status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $invoices1->Status }}</span>
                                                                </td>
                                                            @endif

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>رقم الفاتورة</th>
                                                            <th>نوع المنتج</th>
                                                            <th>القسم</th>
                                                            <th>حالة الدفع</th>
                                                            <th>تاريخ الدفع </th>
                                                            <th>ملاحظات</th>
                                                            <th>تاريخ الاضافة </th>
                                                            <th>المستخدم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($invoice2 as $x)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $x->invoice_number }}</td>
                                                                <td>{{ $x->product }}</td>
                                                                <td>{{ $invoices1->section->section_name }}</td>
                                                                @if ($x->Value_Status == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $x->Status }}</span>
                                                                    </td>
                                                                @elseif($x->Value_Status == 2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $x->Status }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $x->Status }}</span>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $x->Payment_Date }}</td>
                                                                <td>{{ $x->note }}</td>
                                                                <td>{{ $x->created_at }}</td>
                                                                <td>{{ $x->user }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <div class="card card-statistics">
                                              
                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post"  action="{{ url('/InvoiceAttachments') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="invoice_number" name="invoice_number"
                                                                    value="{{$invoices1->invoice_number}}">
                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                    value="{{$invoices1->id}}">
                                                                <label class="custom-file-label" for="customFile">حدد
                                                                    المرفق</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">تاكيد</button>
                                                        </form>
                                                    </div>
                                            
                                                <br>
                                            </div>

                                            <div class="table-responsive mt-15">

                                                <table class="table center-aligned-table mb-0 table table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th scope="col">#</th>
                                                            <th scope="col">اسم الملف</th>
                                                            <th scope="col">قام بالاضافة</th>
                                                            <th scope="col">تاريخ الاضافة</th>
                                                            <th scope="col">العمليات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($invoice3 as $x)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $x->file_name }}</td>
                                                                <td>{{ $x->Created_by }}</td>
                                                                <td>{{ $x->created_at }}</td>
                                                                <td colspan="2">

                                                                    <a class="btn btn-outline-success btn-sm"
                                                                        href="{{ url('View_file') }}/{{ $x->invoice_number }}/{{ $x->file_name }}"
                                                                        role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                        عرض</a>

                                                                    <a class="btn btn-outline-info btn-sm"
                                                                        href="{{ url('download') }}/{{ $x->invoice_number }}/{{ $x->file_name }}"
                                                                        role="button"><i class="fas fa-download"></i>&nbsp;
                                                                        تحميل</a>

                                                                    <a class="btn btn-outline-success btn-sm "
                                                                        data-toggle="modal" data-id="{{ $x->id }}"
                                                                        data-file_name="{{ $x->file_name }}"
                                                                        data-invoice_number="{{ $x->invoice_number }}"
                                                                        data-target="#exampleModaldelete">
                                                                        حذف
                                                                    </a>



                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <ul class="nav nav-tabs html-source" id="html-source-code" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active ml-1 html-code" id="html-code" data-toggle="tab" href="#html-code"
                                    role="tab" aria-controls="html-code" aria-selected="true"><i
                                        class="fab fa-html5 text-orange ml-2"></i>HTML</a>
                            </li>
                        </ul> --}}





                        </div>
                        <!---Prism Pre code-->
                    </div>
                    <!-- /div -->
                </div>


                <!--------- delete---------->

                <div class="modal fade" id="exampleModaldelete" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">حذف مرفق</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{ route('DeleteFile') }}" method="post">
                                <!--- <form action='invoic/destroy' method="post">------>
                                {{-- method_field('delete') --}}
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <p style="color:red">هل انت متاكد من عملية الحذف ؟</p><br>
                                    <input type="text" name="id" id="id" value=""><br>
                                    <input name="file_name" id="file_name" type="text" value=""><br>
                                    <input name="invoice_number" id="invoice_number" type="text" value=""><br>
                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-danger">حذف</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- /row -->
            </div>
            <!-- Container closed -->
        </div>
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#exampleModaldelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);

        })
    </script>
@endsection
