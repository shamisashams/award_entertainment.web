{{-- extend layout --}}
@extends('admin.layout.contentLayoutMaster')

{{-- page title --}}
@section('title', $language->title ? 'Language - Update' : 'Language - Create')

@section('content')
    <!-- jQuery Plugin Initialization -->
    <div class="row">
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-title">Language - {{$language->title ? 'Update' : 'Create'}}</h4>
                    {!! Form::model($language,['url' => $url, 'method' => $method]) !!}
                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::text('title',$language->title,['class' => 'validate '. $errors->has('title') ? '' : 'valid']) !!}
                            {!! Form::label('title',__('admin.title')) !!}
                            @error('title')
                            <small class="errorTxt4">
                                <div class="error">
                                    {{$message}}
                                </div>
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::text('locale',$language->locale,['class' => 'validate '. $errors->has('locale') ? '' : 'valid']) !!}
                            {!! Form::label('locale',__('admin.locale')) !!}
                            @error('locale')
                            <small class="errorTxt4">
                                <div class="error">
                                    {{$message}}
                                </div>
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label>
                                <input type="checkbox" name="status" {{$language->default ? 'disabled' : ''}}
                                value="true" {{$language->status ? 'checked' : ''}}>
                                <span>Status</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::submit($language->title ? 'Update' : 'Create',['class' => 'btn cyan waves-effect waves-light right']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>

@endsection


