@extends('dashboard')

@section('title', 'Add Child')

@section('content')
    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Add Child: {{ $form->name }}</h3>
            </div>
            <div class="panel-body">
                <div class="card">
                    <div class="card-body">
                        <!-- Displaying child form inputs -->
                        <div id="dynamic-field-container">
                            @foreach ($fields as $field)
                                @if ($field->type !== 'hidden')
                                    <div class="form-group d-flex align-items-center">
                                        <label for="{{ $field->name }}" class="mr-2">{{ $field->label }}</label>
                                        @switch($field->type)
                                            @case('text')
                                                <input type="text" id="{{ $field->name }}" name="{{ $field->name }}"
                                                    class="form-control" placeholder="{{ $field->label }}"
                                                    value="{{ old($field->name) }}">
                                            @break

                                            @case('email')
                                                <input type="email" id="{{ $field->name }}" name="{{ $field->name }}"
                                                    class="form-control" placeholder="{{ $field->label }}"
                                                    value="{{ old($field->name) }}">
                                            @break

                                            @case('password')
                                                <input type="password" id="{{ $field->name }}" name="{{ $field->name }}"
                                                    class="form-control" placeholder="{{ $field->label }}">
                                            @break

                                            @case('textarea')
                                                <div class="trix-container">
                                                    <input id="{{ $field->name }}" type="hidden" name="{{ $field->name }}"
                                                        value="{{ old($field->name) }}">
                                                    <trix-editor input="{{ $field->name }}"></trix-editor>
                                                </div>
                                            @break

                                            @case('select')
                                                <div class="d-flex align-items-center">
                                                    <select id="{{ $field->name }}" name="{{ $field->name }}"
                                                        class="form-control mr-3">
                                                        @foreach (explode(',', $field->values) as $option)
                                                            <option value="{{ trim($option) }}"
                                                                {{ old($field->name) == trim($option) ? 'selected' : '' }}>
                                                                {{ trim($option) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <a href="#" class="btn btn-primary add-child-btn" data-field-type="select"
                                                        data-field-label="{{ $field->label }}"
                                                        data-field-options="{{ $field->values }}">
                                                        <i class="fas fa-plus"></i> Add Child
                                                    </a>
                                                </div>
                                            @break

                                            @case('radio')
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3">
                                                        @foreach (explode(',', $field->values) as $option)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $field->name }}"
                                                                    id="{{ $field->name }}_{{ trim($option) }}"
                                                                    value="{{ trim($option) }}"
                                                                    {{ old($field->name) == trim($option) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="{{ $field->name }}_{{ trim($option) }}">
                                                                    {{ trim($option) }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <a href="#" class="btn btn-primary add-child-btn" data-field-type="radio"
                                                        data-field-label="{{ $field->label }}"
                                                        data-field-options="{{ $field->values }}">
                                                        <i class="fas fa-plus"></i> Add Child
                                                    </a>
                                                </div>
                                            @break

                                            @case('checkbox')
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3">
                                                        @foreach (explode(',', $field->values) as $option)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="{{ $field->name }}[]"
                                                                    id="{{ $field->name }}_{{ trim($option) }}"
                                                                    value="{{ trim($option) }}"
                                                                    {{ is_array(old($field->name)) && in_array(trim($option), old($field->name)) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="{{ $field->name }}_{{ trim($option) }}">
                                                                    {{ trim($option) }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <a href="#" class="btn btn-primary add-child-btn"
                                                        data-field-type="checkbox" data-field-label="{{ $field->label }}"
                                                        data-field-options="{{ $field->values }}">
                                                        <i class="fas fa-plus"></i> Add Child
                                                    </a>

                                                    <!-- Child  Modal -->
                                                    <div class="modal fade" id="childModal" tabindex="-1" role="dialog"
                                                        aria-labelledby="childModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="childModalLabel">Add Child</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="child-form">
                                                                        <!-- Dynamic fields will be appended here -->
                                                                        @foreach (explode(',', $field->values) as $option)
                                                                        <div class="form-group">
                                                                            <label for="child-select">{{ $option }}</label>
                                                                            <select name="form_id" class="form-control">
                                                                                @foreach ($forms as $form)
                                                                                    <option value="{{ $form->id }}">
                                                                                        {{ $form->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @endforeach
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="button" id="save-child-btn"
                                                                        class="btn btn-primary">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @break
                                        @endswitch
                                    </div>
                                @else
                                    <input type="hidden" id="{{ $field->name }}" name="{{ $field->name }}"
                                        value="{{ old($field->name, $field->values) }}">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Trix Editor -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <script>
        // JavaScript to handle dynamic modal fields
        document.querySelectorAll('.add-child-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                let form = document.getElementById('child-form');
                form.reset(); // Reset the form
                $('#childModal').modal('show');
            });
        });

        document.getElementById('save-child-btn').addEventListener('click', function() {
            // Logic to save the selected form or append it to the parent form
            $('#childModal').modal('hide');
        });
    </script>
@endsection
