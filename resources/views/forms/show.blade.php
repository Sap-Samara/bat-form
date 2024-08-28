@extends('dashboard')

@section('title', 'View Form')

@section('content')
<div id="page-content">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Form Name: {{ $form->name }}</h3>
        </div>
        <div class="panel-body">
            <div class="card">
                <div class="card-body">
                    @foreach ($form->fields as $field)
                        <div class="form-group">
                            <!-- Label for the field -->
                            <label for="{{ $field->name }}">{{ $field->label }}</label>

                            @switch($field->type)
                                @case('select')
                                    <select name="{{ $field->name }}" id="{{ $field->name }}" class="form-control">
                                        <!-- Placeholder option -->
                                        <option value="" disabled selected>{{ ucfirst($field->type) }}</option>
                                        <!-- Permanent title as the first option -->
                                        <option value="" disabled>{{ ucfirst($field->type) }}s</option>
                                        @foreach (explode(',', $field->values) as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @break

                                @case('radio')
                                    @foreach (explode(',', $field->values) as $value)
                                        <div class="form-check">
                                            <input type="radio" name="{{ $field->name }}" id="{{ $field->name }}_{{ $loop->index }}" value="{{ $value }}" class="form-check-input">
                                            <label class="form-check-label" for="{{ $field->name }}_{{ $loop->index }}">{{ $value }}</label>
                                        </div>
                                    @endforeach
                                    @break

                                @case('checkbox')
                                    @foreach (explode(',', $field->values) as $value)
                                        <div class="form-check">
                                            <input type="checkbox" name="{{ $field->name }}[]" id="{{ $field->name }}_{{ $loop->index }}" value="{{ $value }}" class="form-check-input">
                                            <label class="form-check-label" for="{{ $field->name }}_{{ $loop->index }}">{{ $value }}</label>
                                        </div>
                                    @endforeach
                                    @break

                                @case('textarea')
                                    <textarea name="{{ $field->name }}" id="{{ $field->name }}" class="form-control" placeholder="{{ ucfirst($field->type) }}"></textarea>
                                    @break

                                @default
                                    <input type="{{ $field->type }}" name="{{ $field->name }}" id="{{ $field->name }}" class="form-control" placeholder="{{ ucfirst($field->type) }}">
                            @endswitch
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
