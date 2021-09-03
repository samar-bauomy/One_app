@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{__('Locations') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{__('Locations') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


@if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
@endif



<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{__('Add New Location') }}
            </button>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Provider Name') }}</th>
                            <th>{{__('Longtitud') }}</th>
                            <th>{{__('Latitude') }}</th>
                            <th>{{__('Created_at') }}</th>
                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{__('Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($locations as $location)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>

                                <?php $provider_name = \App\User::where('id', $location->provider_id)->first(); ?>
                                @if ($provider_name)
                                    <td>{{ $provider_name->name }}</td>
                                @else
                                    <td> - </td>
                                @endif

                                <td>{{ $location->longtitud }}</td>
                                <td>{{ $location->latitude }}</td>

                                <td>{{ $location->created_at->diffForHumans() }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td class="#">
                                        <button type="button" class="btn btn-info btn-sm given" data-toggle="modal"
                                            data-target="#edit{{ $location->id }}" style="margin-right: 40px"><i class="fa fa-edit"></i></button>

                                        @if (auth()->user()->hasRole('super_admin'))
                                            <form action="{{ route('locations.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $location->id }}">
                                                <button type="button" class="btn btn-danger btn-sm given"
                                                    onclick="confirm('{{ __("Are You Sure You Want To Delete This Location ?") }}') ? this.parentElement.submit() : ''" style="position:absolute; margin-right: 20px; margin-top:-26px;"><i class="fa fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>

                            <!-- edit_modal_user -->
                            <div class="modal fade" id="edit{{ $location->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('Edit Location') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('locations.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $location->id }}" id="id">

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="col-md-12">
                                                            <label for="longtitud" class="mr-sm-2 space_top">{{__('Longtitud') }} :</label>
                                                            <input id="longtitud" type="text" name="longtitud" class="form-control" value="{{ $location->longtitud }}" required>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="latitude" class="mr-sm-2 space_top">{{__('Latitude') }} :</label>
                                                            <input type="latitude" class="form-control" name="latitude" value="{{ $location->latitude }}" required>
                                                        </div>

                                                        @if (auth()->user()->hasRole('super_admin'))
                                                            <div class="form-group modual_space">
                                                                <div class="col">
                                                                    <label class="mr-sm-2" for="provider_id">{{ __('Added By Admin') }} : <span
                                                                            style="color: red"> * </span> </label>
                                                                    <select name="provider_id" class="form-control custom-select selectpicker">
                                                                        <option value="0"> {{ __('Please Select---') }} </option>

                                                                        @foreach (\App\User::where('admin', '0')->get() as $provider)
                                                                            <option value="{{ $provider->id }}"  <?php if ($location->provider_id == $provider->id) { echo 'selected'; } ?> > {{ $provider->name }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('provider_id'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('provider_id') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{__('Submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_user -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{__('Add New Location') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('locations.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="longtitud" class="mr-sm-2 space_top">{{__('Longtitud') }} :</label>
                            <input id="longtitud" type="text" name="longtitud" class="form-control" value="{{ old('longtitud') }}" required>
                        </div>

                        <div class="col-md-12">
                            <label for="latitude" class="mr-sm-2 space_top">{{__('Latitude') }} :</label>
                            <input type="latitude" class="form-control" name="latitude" value="{{ old('latitude') }}" required>
                        </div>


                        @if (auth()->user()->hasRole('super_admin'))
                            <div class="col-md-12 form-group modual_space ">
                                <div class="col-md-12">
                                    <label class="mr-sm-2" for="provider_id">{{ __('Added By Admin') }} : <span
                                            style="color: red"> * </span> </label>
                                    <select name="provider_id" class="form-control custom-select selectpicker">
                                        <option value="0"> {{ __('Please Select---') }} </option>

                                        @foreach (\App\User::where('admin', '0')->get() as $provider)
                                            <option value="{{ $provider->id }}"> {{ $provider->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('provider_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('provider_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @else
                         <input id="provider_id" type="hidden" name="provider_id" class="form-control" value="0">
                        @endif
                    <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{__('Close') }}</button>
                        <button type="submit" class="btn btn-success">{{__('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
