@extends('layouts.master')
@section('css')
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
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
                <h4 class="content-title mb-0 my-auto">{{ __('classroom.classroom') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('classroom.classroom_list') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="card-header pb-0">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div>
                            <a class="btn ripple btn-success" data-target="#modaldemo3" data-toggle="modal" href="">
                                {{ __('classroom.create') }}
                            </a>
                            <button data-target="#delete_all" data-effect="effect-scale" data-toggle="modal" type="button"
                                class="btn modal-effect ripple btn-success" id="btn_delete_all">
                                {{ trans('classroom.delete') }}
                            </button>
                            <form action="{{ route('filter') }}" method="POST" class="mt-4">
                                @csrf
                                <select class="selectpicker bg-success text-light form-control w-25" data-style="btn-info"
                                    name="grade_id" required onchange="this.form.submit()">
                                    <option value="" selected disabled>
                                        {{ trans('classroom.search') }}</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </form>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable table-striped mg-b-0 text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <input name="select_all" id="example-select-all" type="checkbox"
                                                onclick="CheckAll('box1', this)" />
                                        </th>
                                        <th>#</th>
                                        <th>{{ __('classroom.class_name') }}</th>
                                        <th>{{ __('classroom.Grade_name') }}</th>
                                        <th>{{ __('tables.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($search))
                                        <?php $list_classes = $search; ?>
                                    @else
                                        <?php $list_classes = $classrooms; ?>
                                    @endif
                                    @foreach ($list_classes as $classroom)
                                        <tr>
                                            <td class="text-center"><input type="checkbox" value="{{ $classroom->id }}"
                                                    class="box1"></td>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $classroom->class_name }}</td>
                                            <td>{{ $classroom->grade->name }}</td>
                                            <td>
                                                <a class="modal-effect btn btn-primary" data-effect="effect-scale"
                                                    data-toggle="modal" data-target="#class{{ $classroom->id }}"
                                                    href="">{{ __('tables.update') }}
                                                </a>

                                                <a class="modal-effect btn btn-danger" data-effect="effect-scale"
                                                    data-toggle="modal"
                                                    href="#delete{{ $classroom->id }}">{{ __('tables.delete') }}
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Update Modal effects -->
                                        <div class="modal" id="class{{ $classroom->id }}">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">{{ __('classroom.create') }}</h6><button
                                                            aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="classrooms/{{ $classroom->id }}" method="post">
                                                        {{ method_field('put') }}
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $classroom->id }}">
                                                        <div class="modal-body" data-class-room="list_class"
                                                            id="dynamicadd">
                                                            <div class="row row-sm">
                                                                <div class="col-4">
                                                                    <div class="form-group mg-b-0">
                                                                        <label
                                                                            class="form-label">{{ __('classroom.name_ar') }}:
                                                                        </label>
                                                                        <input class="form-control" name="class_name_ar"
                                                                            value="{{ $classroom->getTranslation('class_name', 'ar') }}"
                                                                            type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="form-label">{{ __('classroom.name_en') }}:
                                                                        </label>
                                                                        <input class="form-control" name="class_name_en"
                                                                            value="{{ $classroom->getTranslation('class_name', 'en') }}"
                                                                            type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <label
                                                                        class="main-content-label tx-11 tx-medium tx-gray-600">
                                                                        {{ __('classroom.Grade_name') }}
                                                                    </label>
                                                                    <div class="row row-sm">
                                                                        <select name="grade_name"
                                                                            class="form-control select2-no-search">
                                                                            <option value="{{ $classroom->grade->id }}">
                                                                                {{ $classroom->grade->name }}</option>
                                                                            @foreach ($grades as $grade)
                                                                                <option value="{{ $grade->id }}">
                                                                                    {{ $grade->name }} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-primary"
                                                                type="submit">{{ __('tables.save') }}</button>
                                                            <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                                type="button">{{ __('tables.close') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete Modal effects -->
                                        <div class="modal" id="delete{{ $classroom->id }}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">{{ __('grades.create_new_grade') }}</h6>
                                                        <button aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="classrooms/{{ $classroom->id }}" method="POST">
                                                        {{ method_field('DELETE') }}
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $classroom->id }}">
                                                        <div class="modal-body">
                                                            <p>{{ __('tables.delete_q') . ' ' . $classroom->class_name . '؟' }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-danger"
                                                                type="submit">{{ __('tables.delete') }}</button>
                                                            <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                                type="button">{{ __('tables.close') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- bd -->
                    </div><!-- bd -->
                </div><!-- bd -->
            </div>
            <!-- Large Modal -->
            <div class="modal" id="modaldemo3">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">{{ __('classroom.create') }}</h6><button aria-label="Close"
                                class="close" data-dismiss="modal" type="button"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('classrooms.store') }}" method="post">
                            @csrf
                            <div class="modal-body" data-class-room="list_class" id="dynamicadd">
                                <div class="row row-sm">
                                    <div class="col-4">
                                        <div class="form-group mg-b-0">
                                            <label class="form-label">{{ __('classroom.name_ar') }}: </label>
                                            <input class="form-control" name="class_name_ar" type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('classroom.name_en') }}: </label>
                                            <input class="form-control" name="class_name_en" type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">
                                            {{ __('classroom.Grade_name') }}
                                        </label>
                                        <div class="row row-sm">
                                            <select name="grade_name" class="form-control select2-no-search">
                                                <option label="{{ __('classroom.select') }}">
                                                </option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}">
                                                        {{ $grade->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn ripple btn-primary" type="submit">{{ __('tables.save') }}</button>
                                <button class="btn ripple btn-secondary" data-dismiss="modal"
                                    type="button">{{ __('tables.close') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Large Modal -->
            <!-- Delete Modal effects -->
            <div class="modal" id="delete_all">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">{{ __('grades.create_new_grade') }}</h6>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('delete.all') }}" method="POST">
                            {{-- {{ method_field() }} --}}
                            @csrf
                            <input class="text" type="hidden" id="delete_all_id" name="delete_all_id"
                                value=''>
                            <div class="modal-body">
                                <p>{{ __('tables.delete_q') . ' ؟' }}
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn ripple btn-danger" type="submit">{{ __('tables.delete') }}</button>
                                <button class="btn ripple btn-secondary" data-dismiss="modal"
                                    type="button">{{ __('tables.close') }}</button>
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
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
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
    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $(".datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });
                console.log(selected.length);
                if (selected.length <= 0) {
                    $('#delete_all').modal('show')
                } else {
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>
@endsection
