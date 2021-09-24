{{-- extend layout --}}
@extends('admin.layout.contentLayoutMaster')
{{-- page value --}}
@section('value', $setting->created_at ? __('admin.setting-update') : 'admin.setting-create')


@section('content')
    <div class="row">
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-value">{{$setting->created_at ? __('admin.setting-update') : __('admin.setting-create')}}</h4>
                    {!! Form::model($setting,['url' => $url, 'method' => $method]) !!}
                    <div class="row">
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
                                    {!! Form::text('value['.$key.']',$setting->language($language->id) !== null ? $setting->language($language->id)->value : "",['class' => 'validate '. $errors->has('value.*') ? '' : 'valid']) !!}
                                    {!! Form::label('value['.$key.']',__('admin.value')) !!}
                                    @error('value.*')
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
                            {!! Form::submit($setting->created_at ? __('admin.update') : __('admin.create'),['class' => 'btn cyan waves-effect waves-light right']) !!}
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
