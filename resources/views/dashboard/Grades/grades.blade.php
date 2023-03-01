@extends('layouts.master')
@section('css')
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('words.grades') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('words.grades_list') }}</span>
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="modal-effect btn btn-success" data-effect="effect-scale" data-toggle="modal"
                            href="#modaldemo8">{{ __('grades.create_new_grade') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('tables.name') }}</th>
                                    <th>{{ __('tables.notes') }}</th>
                                    <th>{{ __('tables.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grades as $grade)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $grade->name }}</td>
                                        <td>{{ $grade->notes }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-primary" data-effect="effect-scale"
                                                data-toggle="modal"
                                                href="#edit{{ $grade->id }}">{{ __('tables.update') }}
                                            </a>

                                            <a class="modal-effect btn btn-danger" data-effect="effect-scale"
                                                data-toggle="modal"
                                                href="#delete{{ $grade->id }}">{{ __('tables.delete') }}
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Update Modal effects -->
                                    <div class="modal" id="edit{{ $grade->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{ __('grades.create_new_grade') }}</h6><button
                                                        aria-label="Close" class="close" data-dismiss="modal"
                                                        type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="grades/{{ $grade->id }}" method="POST">
                                                    {{ method_field('put') }}
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $grade->id }}">
                                                    <div class="modal-body">
                                                        <div class="form-group d-flex">
                                                            <div class="form-group w-50 ml-2">
                                                                <label
                                                                    class="main-content-label tx-11 tx-medium tx-gray-600">{{ __('grades.name_ar') }}</label>
                                                                <input class="form-control" type="text" name="name_ar"
                                                                    value="{{ $grade->getTranslation('name', 'ar') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group w-50 mr-2">
                                                                <label
                                                                    class="main-content-label tx-11 tx-medium tx-gray-600">{{ __('grades.name_en') }}</label>
                                                                <input class="form-control" type="text" name="name_en"
                                                                    value="{{ $grade->getTranslation('name', 'en') }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label
                                                                class="main-content-label tx-11 tx-medium tx-gray-600">{{ __('tables.notes') }}</label>
                                                            <textarea class="form-control" rows="3" name="notes">{{ $grade->notes }}</textarea>
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
                                    <div class="modal" id="delete{{ $grade->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{ __('grades.create_new_grade') }}</h6><button
                                                        aria-label="Close" class="close" data-dismiss="modal"
                                                        type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="grades/{{ $grade->id }}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $grade->id }}">
                                                    <div class="modal-body">
                                                        <p>{{ __('tables.delete_q') . ' ' . $grade->name . '؟' }}</p>
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
    </div>
    <!-- row closed -->
    <!-- Create Modal effects -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('grades.create_new_grade') }}</h6><button aria-label="Close"
                        class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group d-flex">
                            <div class="form-group w-50 ml-2">
                                <label
                                    class="main-content-label tx-11 tx-medium tx-gray-600">{{ __('grades.name_ar') }}</label>
                                <input class="form-control" type="text" name="name_ar" required>
                            </div>
                            <div class="form-group w-50 mr-2">
                                <label
                                    class="main-content-label tx-11 tx-medium tx-gray-600">{{ __('grades.name_en') }}</label>
                                <input class="form-control" type="text" name="name_en" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="main-content-label tx-11 tx-medium tx-gray-600">{{ __('tables.notes') }}</label>
                            <textarea class="form-control" rows="3" name="notes"></textarea>
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
    <!-- End Modal effects-->
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
@endsection
