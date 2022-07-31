@extends('layouts.master')
@section('css')


@section('title')
    تقرير الفواتير
@stop
{{-- 
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">


<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" /> --}}
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

<!-- Internal Spectrum-colorpicker css -->
<link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

<!-- Internal Select2 css -->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/تقرير
                الفواتير</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">

                <form action="/search_invoicescustomer"  role="search" autocomplete="off">
                    {{ csrf_field() }}

                    
                    
                 
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">القسم</label>
                            <select name="Section" class="form-control select2" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">
                                <!--placeholder-->
                                <option value="" selected >حدد القسم</option>
                                @foreach ($section as $section)
                                    <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col" >
                            <label for="inputName" class="control-label">المنتج</label>
                            <select id="product" name="product" class="form-control select2">
                            </select>
                        </div>


                        <div class="col" id="start_at">
                            <label>من تاريخ</label>
                            <input class="form-control fc-datepicker" name="start_at" placeholder="YYYY-MM-DD"
                                type="text" value="{{   $st_date ?? ''}}">
                        </div>


                        <div class="col" id="end_at">
                            <label>الى تاريخ</label>
                            <input class="form-control fc-datepicker" name="end_at" placeholder="YYYY-MM-DD"
                                type="text" value="{{ $en_date ?? '' }}">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class=" col">
                            <button type="submit" class="btn btn-primary">بحث</button>
                        </div>
                    </div>

                </form>





            </div><br>
            <!-- row closed -->

                    <div class="card-body">
                        <div class="table-responsive">
                            @if (isset($details))
                                <table id="example" class="table key-buttons text-md-nowrap">
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
                                          
                                    </thead>
                                    <tbody>

                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($details as $x)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td>{{ $i }} </td>
                                                <td>{{ $x->invoice_number }}</td>
                                                <td>{{ $x->invoice_Date }}</td>
                                                <td>{{ $x->Due_date }}</td>
                                                <td>{{ $x->product }}</td>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            @endif

                      
                </div>
            </div>


        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
</div>
@endsection
@section('js')

<!-- Internal Data tables -->
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

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>



<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(document).ready(function() {
        $('select[name="Section"]').on('change', function() {
            var SectionId = $(this).val();
            if (SectionId) {
                $.ajax({
                    url: "{{ URL::to('section') }}/" + SectionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="product"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="product"]').append('<option value="' +
                                value + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


@endsection
