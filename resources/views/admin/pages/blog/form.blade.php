{{-- extend layout --}}
@extends('admin.layout.contentLayoutMaster')
{{-- page title --}}
@section('title', $blog->created_at ? __('admin.blog-update') : 'admin.blog-create')

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
                    <input name="old-images[]" id="old_images" hidden disabled value="{{$blog->files}}">
                    <h4 class="card-title">{{$blog->created_at ? __('admin.blog-update') : __('admin.blog-create')}}</h4>
                    {!! Form::model($blog,['url' => $url, 'method' => $method,'files' => true]) !!}
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
                                {!! Form::checkbox('status', 'true', $blog->status ? 'checked' : '') !!}
                                <span>{{__('admin.status')}}</span>
                            </label>
                        </div>
                        @foreach($languages as $key => $language)
                            <div id="lang-{{$key}}" class="col s12  mt-5">
                                <div class="input-field ">
                                    {!! Form::text('title['.$key.']',$blog->language($language->id) !== null ? $blog->language($language->id)->title : "",['class' => 'validate '. ($errors->has('title.*') ? '' : 'valid')]) !!}
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
                                    {!! Form::textarea('description['.$key.']',$blog->language($language->id) !== null ? $blog->language($language->id)->description : "",['class' => 'validate materialize-textarea '. ($errors->has('description.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('description['.$key.']',__('admin.description')) !!}

                                    @error('description.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::textarea('short-description['.$key.']',$blog->language($language->id) !== null ? $blog->language($language->id)->short_description : "",['class' => 'validate materialize-textarea '. ($errors->has('short-description.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('short-description['.$key.']',__('admin.short_description')) !!}

                                    @error('short_description.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::textarea('content['.$key.']',$blog->language($language->id) !== null ? $blog->language($language->id)->content : "",['class' => 'ckeditor validate materialize-textarea '.($errors->has('content.*') ? '' : 'valid')]) !!}
{{--                                    {!! Form::label('content['.$key.']',__('admin.content')) !!}--}}

                                    @error('content.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::text('slug['.$key.']',$blog->language($language->id) !== null ? $blog->language($language->id)->slug : "",['class' => 'validate '. ($errors->has('slug.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('slug['.$key.']',__('admin.slug')) !!}
                                    @error('slug.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::text('city['.$key.']',$blog->language($language->id) !== null ? $blog->language($language->id)->city : "",['class' => 'validate '. ($errors->has('city.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('city['.$key.']',__('admin.city')) !!}
                                    @error('city.*')
                                    <small class="errorTxt4">
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field ">
                                    {!! Form::text('country['.$key.']',$blog->language($language->id) !== null ? $blog->language($language->id)->country : "",['class' => 'validate '. ($errors->has('country.*') ? '' : 'valid')]) !!}
                                    {!! Form::label('country['.$key.']',__('admin.country')) !!}
                                    @error('country.*')
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
                            {!! Form::submit($blog->created_at ? __('admin.update') : __('admin.create'),['class' => 'btn cyan waves-effect waves-light right']) !!}
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
