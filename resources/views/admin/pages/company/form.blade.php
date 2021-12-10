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
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/dropify/css/dropify.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <input name="old-images[]" id="old_images" hidden disabled value="{{$company->files}}">
                    <h4 class="card-title">{{$company->created_at ? __('admin.company-update') : __('admin.company-create')}}</h4>
                    {!! Form::model($company,['url' => $url, 'method' => $method,'files' => true]) !!}
{{--                    {!! Form::model($gallery,['url' => $url, 'method' => $method,'files' => true]) !!}--}}
                    {!! Form::text('old_main_image',$company->mainFile,['hidden','id'=>'old-main']) !!}
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
                        <div class="input-field col s12">
                            <textarea name="location_link" class="materialize-textarea validate {{$errors->has(' location_link') ? '' : 'valid'}}">{{$company->location_link}}</textarea>
                            <label>{{__('admin.location_link')}}</label>
                            @error('location_link')
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
                                                                        {!! Form::label('description['.$key.']',__('admin.company_description')) !!}

                                    @error('description.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="input-field ">
                                    {!! Form::text('content_title['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->content_title : "",['class' => 'validate '. ($errors->has('content_title.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('content_title['.$key.']',__('admin.content_title')) !!}
                                    @error('content_title.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::text('content_sub_title_1['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->content_sub_title_1 : "",['class' => 'validate '. ($errors->has('content_sub_title_1.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('content_sub_title_1['.$key.']',__('admin.content_sub_title_1')) !!}
                                    @error('content_sub_title_1.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="input-field ">
                                    {!! Form::textarea('content_description['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->content_description : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('content_description.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('content_description['.$key.']',__('admin.content_description')) !!}

                                    @error('content_description.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::text('content_sub_title_2['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->content_sub_title_2 : "",['class' => 'validate '. ($errors->has('content_sub_title_2.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('content_sub_title_2['.$key.']',__('admin.content_sub_title_2')) !!}
                                    @error('content_sub_title_2.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::textarea('content_description_2['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->content_description_2 : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('content_description_2.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('content_description_2['.$key.']',__('admin.content_description_2')) !!}

                                    @error('content_description_2.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::text('content_sub_title_3['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->content_sub_title_3 : "",['class' => 'validate '. ($errors->has('content_sub_title_3.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('content_sub_title_3['.$key.']',__('admin.content_sub_title_3')) !!}
                                    @error('content_sub_title_3.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::textarea('content_description_3['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->content_description_3 : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('content_description_3.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('content_description_3['.$key.']',__('admin.content_description_3')) !!}

                                    @error('content_description_3.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="input-field ">
                                    {!! Form::text('country['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->country : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('country.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('country['.$key.']',__('admin.country')) !!}

                                    @error('country.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="input-field ">
                                    {!! Form::text('address['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->address : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('address.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('address['.$key.']',__('admin.address')) !!}

                                    @error('address.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="input-field ">
                                    {!! Form::text('phone['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->phone : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('phone.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('phone['.$key.']',__('admin.phone')) !!}

                                    @error('phone.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="input-field ">
                                    {!! Form::text('email['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->email : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('email.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('email['.$key.']',__('admin.email')) !!}

                                    @error('email.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="input-field ">
                                    {!! Form::text('facebook['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->facebook : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('facebook.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('facebook['.$key.']',__('admin.facebook')) !!}

                                    @error('facebook.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="input-field ">
                                    {!! Form::text('linkedin['.$key.']',$company->language($language->id) !== null ? $company->language($language->id)->linkedin : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('linkedin.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('linkedin['.$key.']',__('admin.linkedin')) !!}

                                    @error('linkedin.*')
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
                    <label>{{__('client.main_image')}}</label>
                    <div class="form-group">
                        <input name="main-image" type="file" id="input-file-now" class="dropify"
                               data-default-file="{{$company->mainFile?asset($company->mainFile->path.'/'.$company->mainFile->title):""}}"/>
                        @if ($errors->has('main-image'))
                            <span class="help-block">
                                            {{ $errors->first('main-image') }}
                                        </span>
                        @endif
                    </div>
                    <br>
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
    <script src="{{asset('vendors/dropify/js/dropify.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/form-select2.js')}}"></script>
    <script src="{{asset('js/scripts/form-file-uploads.js?v='.time())}}"></script>

@endsection
