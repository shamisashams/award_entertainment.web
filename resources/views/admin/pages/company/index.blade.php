{{-- extend layout --}}
@extends('admin.layout.contentLayoutMaster')

{{-- page title --}}
@section('title',__('admin.company'))


@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div id="button-trigger" class="card card card-default scrollspy">

                <div class="card-content">
                    <a class="btn-floating btn-large primary-text gradient-shadow compose-email-trigger "
                       href="{{locale_route('company.create')}}">
                        <i class="material-icons">add</i>
                    </a>
                    <h4 class="card-title mt-2">@lang('admin.company')</h4>
                    <div class="row">
                        <div class="col s12">
                            <form class="mr-0 p-0">
                                <table id="data-table-simple" class="display">
                                    <thead>
                                    <tr>
                                        <th>@lang('admin.id')</th>
                                        <th>@lang('admin.description')</th>
                                        <th>@lang('admin.status')</th>
                                        <th>@lang('admin.action')</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <th>
                                            <input type="number" name="id" onchange="this.form.submit()"
                                                   value="{{Request::get('id')}}"
                                                   class="validate {{$errors->has('id') ? '' : 'valid'}}">
                                        </th>
                                        <th>
                                            <input type="text" name="description" onchange="this.form.submit()"
                                                   value="{{Request::get('description')}}"
                                                   class="validate {{$errors->has('description') ? '' : 'valid'}}">
                                        </th>
                                        <th>
                                            <select class="form-control" name="status" onchange="this.form.submit()">
                                                <option value="" {{Request::get('status') === '' ? 'selected' :''}}>@lang('admin.any')</option>
                                                <option value="1" {{Request::get('status') === '1' ? 'selected' :''}}>@lang('admin.active')</option>
                                                <option value="0" {{Request::get('status') === '0' ? 'selected' :''}}>@lang('admin.not_active')</option>
                                            </select>
                                        </th>

                                        <th></th>
                                    </tr>
                                    <tbody>
                                    @if($companies)
                                        @foreach($companies as $company)
                                            <tr>
                                                <td>{{$company->id}}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col s12">
                                                            <ul class="tabs">
                                                                @foreach($company->languages as $key => $language)
                                                                    @if(isset($languages[$language->language_id]))
                                                                        <li class="tab ">
                                                                            <a href="#desc-{{$company->id}}-{{$language->language_id}}">
                                                                                {{$languages[$language->language_id]->locale}}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                        <div class="col sm12 mt-2">
                                                            @foreach($company->languages as $key => $language)
                                                                @if(isset($languages[$language->language_id]))
                                                                    <div id="desc-{{$company->id}}-{{$language->language_id}}"
                                                                         class="">
                                                                        {!!  substr($language->description, 0, 100) !!}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </td>
                                                <td>
                                                    @if($company->status)
                                                        <span class="green-text">Active</span>
                                                    @else
                                                        <span class="red-text">Not active</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{locale_route('company.show',$company->id)}}">
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>
                                                    <a href="{{locale_route('company.edit',$company->id)}}"
                                                       class="pl-3">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <a href="{{locale_route('company.destroy',$company->id)}}"
                                                       onclick="return confirm('Are you sure?')" class="pl-3">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </form>
{{--                            {{ $company->appends(request()->input())->links('admin.vendor.pagination.material') }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


