{{-- extend layout --}}
@extends('admin.layout.contentLayoutMaster')
{{-- page title --}}
@section('title', $slider->created_at ? __('admin.slider-update') : 'admin.slider-create')

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
                    <input name="old-images[]" id="old_images" hidden disabled value="{{$slider->files}}">
                    <h4 class="card-title">{{$slider->created_at ? __('admin.slider-update') : __('admin.slider-create')}}</h4>
                    {!! Form::model($slider,['url' => $url, 'method' => $method,'files' => true]) !!}
                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::text('url',$slider->url,['class' => 'validate '. $errors->has('url') ? '' : 'valid']) !!}
                            {!! Form::label('url',__('admin.url')) !!}
                            @error('url')
                            <small class="errorTxt4">
                                <div class="error">
                                    {{$message}}
                                </div>
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col s12">
                            <select class="select2-customize-result browser-default" multiple="multiple" name="type" >
                                <option value="" disabled>Choose your option</option>
                                    <option value="{{ $type }}" {{ $slider->type ? "selected" : "" }}>
                                        {{ucfirst($type)}}
                                    </option>

                            </select>

                        </div>
                        <div class="col s12 mb-2">
                            <label>
                                <input type="checkbox" name="status"
                                       value="true" {{$slider->status ? 'checked' : ''}}>
                                <span>{{__('admin.status')}}</span>
                            </label>
                        </div>
                        <ul class="tabs">
                            @foreach($languages as $key => $language)
                                <li class="tab col ">
                                    <a href="#lang-{{$key}}">{{$language->locale}}</a>
                                </li>
                            @endforeach
                        </ul>
                        @foreach($languages as $key => $language)
                            <div id="lang-{{$key}}" class="col s12  mt-5">
                                <div class="input-field ">
                                    {!! Form::text('title['.$key.']',$slider->language($language->id) !== null ? $slider->language($language->id)->title : "",['class' => 'validate '. $errors->has('title.*') ? '' : 'valid']) !!}
                                    {!! Form::label('title['.$key.']',__('admin.title')) !!}
                                    @error('title.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                            <textarea
                                                    name="description[{{$key}}]"
                                                    class="materialize-textarea validate {{ $errors->has('description.*') ? '' : 'valid'}}">
                                                {!! $slider->language($language->id) !== null ? $slider->language($language->id)->description : "" !!}
                                            </textarea>
                                    <label for="description['{{$key}}']">{{__('admin.description')}}</label>
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
                            {!! Form::submit($slider->created_at ? __('admin.update') : __('admin.create'),['class' => 'btn cyan waves-effect waves-light right']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>

@endsection

{{-- vendor script --}}
@section('vendor-script')
    <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/form-select2.js')}}"></script>
@endsection
