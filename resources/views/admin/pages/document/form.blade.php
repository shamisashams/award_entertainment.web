{{-- extend layout --}}
@extends('admin.layout.contentLayoutMaster')
{{-- page title --}}
{{--@section('title', $document->created_at ? __('admin.document-update') : 'admin.document-create')--}}

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection
{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/dropify/css/dropify.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
{{--                    <input name="old-images[]" id="old_images" hidden disabled value="{{$document->files}}">--}}
                    <h4 class="card-title">{{$document->created_at ? __('admin.document-update') : __('admin.document-create')}}</h4>
                    {!! Form::model($document,['url' => $url, 'method' => $method,'files' => true]) !!}
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
                                {!! Form::checkbox('status', 'true', $document->status ? 'checked' : '') !!}
                                <span>{{__('admin.status')}}</span>
                            </label>
                        </div>
                        {{--                        slider not useing --}}

                        <div class="input-field col s12">
{{--                            @dd($selectedCompanies)--}}
                            <select class="select2-customize-result browser-default"
                                    multiple name="companies[]">
                                <option value="" disabled>Choose your option</option>
                                @foreach($companies as $key => $company)
                                    <option value="{{ $company->id }}"
                                        {{ in_array($company->id, $selectedCompanies) ? "selected": ""}}
                                    >
                                        {!! $company->language()->content_title !!}
                                    </option>

                                @endforeach
                            </select>

                        </div>
{{--                        <div class="input-field col s12">--}}
{{--                            {!! Form::text('link',$document->link ,['class' => 'validate '. $errors->has('link') ? '' : 'valid']) !!}--}}
{{--                            {!! Form::label('document_link',__('admin.document_link')) !!}--}}
{{--                            @error('link')--}}
{{--                            <small class="errorTxt4">--}}
{{--                                <div class="error">--}}
{{--                                    {{$message}}--}}
{{--                                </div>--}}
{{--                            </small>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
                        <div>
                            <h5>@lang('admin.pdf')</h5>
                            <div class="input-field">
                                <input
                                    type="file"
                                    id="input-file-events"
                                    class="dropify"
                                    name="pdf"
                                    @if($document->pdf)
                                    data-default-file="{{asset($document->pdf->path. '/'. $document->pdf->title)}}"
                                    @endif
                                />
                            </div>
                        </div>
                        @foreach($languages as $key => $language)
                            <div id="lang-{{$key}}" class="col s12  mt-5">

                                <div class="input-field ">
                                    {!! Form::text('title['.$key.']',$document->language($language->id) !== null ? $document->language($language->id)->title : "",['class' => 'validate '. ($errors->has('title.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('title['.$key.']',__('admin.title')) !!}
                                    @error('title.*')
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
                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::submit($document->created_at ? __('admin.update') : __('admin.create'),['class' => 'btn cyan waves-effect waves-light right']) !!}
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
    <script src="{{asset('vendors/dropify/js/dropify.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/form-select2.js')}}"></script>
    <script src="{{asset('js/scripts/form-file-uploads.js?v='.time())}}"></script>

@endsection
