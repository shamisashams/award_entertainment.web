{{-- extend layout --}}
@extends('admin.layout.contentLayoutMaster')
{{-- page title --}}
@section('title', $company->created_at ? __('admin.company-update') : 'admin.company-create')

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection
{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <input name="old-images[]" id="old_images" hidden disabled value="{{$company->files}}">
                    <h4 class="card-title">{{$company->created_at ? __('admin.company-update') : __('admin.company-create')}}</h4>
                    {!! Form::model($company,['url' => $url, 'method' => $method,'files' => true]) !!}
                    <div class="row">
                        <ul class="tabs">
                            @foreach($languages as $key => $language)
                                <li class="tab col ">
                                    <a href="#lang-{{$key}}">{{$language->locale}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="col s12 mb-2 mt-4">
                            <label>
{{--                                <input type="checkbox" name="status"--}}
{{--                                       value="true" {{$blog->status ? 'checked' : ''}}>--}}
                                {!! Form::checkbox('status', 'true', $company->status ? 'checked' : '') !!}
                                <span>{{__('admin.status')}}</span>
                            </label>
                        </div>
                        <div class="input-field col s12">
                            {!! Form::text('company_link',$company->company_link ,['class' => 'validate '. $errors->has('company_link') ? '' : 'valid']) !!}
                            {!! Form::label('company_link',__('admin.company_link')) !!}
                            @error('company_link')
                            <small class="errorTxt4">
                                <div class="error">
                                    {{$message}}
                                </div>
                            </small>
                            @enderror
                        </div>
                        @foreach($languages as $key => $language)
                            <div id="lang-{{$key}}" class="col s12  mt-5">

                                <div class="input-field ">
                                    {!! Form::textarea('description['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->description : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('description.*') ? '' : 'valid')]) !!}
                                    {{--                                    {!! Form::label('content['.$key.']',__('admin.content')) !!}--}}

                                    @error('description.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>



                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <div class="input-images"></div>
                        @if ($errors->has('images'))
                            <span class="help-block">
                                            {{ $errors->first('images') }}
                                        </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::submit($company->created_at ? __('admin.update') : __('admin.create'),['class' => 'btn cyan waves-effect waves-light right']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>

    <script src="{{asset("ckeditor/ckeditor.js")}}"></script>
@endsection

{{-- vendor script --}}
@section('vendor-script')
    <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/form-select2.js')}}"></script>
@endsection
