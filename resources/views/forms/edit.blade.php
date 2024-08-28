@extends('dashboard')

@section('title', 'Edit Form')

@section('content')
    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Form: {{ $form->name }}</h3>
            </div>
            <div class="panel-body">
                <div class="card">
                    <div class="card-body">
                        <!-- Form to edit form details -->
                        <form action="{{ route('forms.update', $form->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="form_name">Form Name: <span class="text-red"> *</span></label>
                                <input type="text" name="form_name" id="form_name" class="form-control"
                                    value="{{ old('form_name', $form->name) }}" required>
                            </div>

                            <!-- Callout Information -->
                            <div class="callout callout-default"
                                style="border: 1px solid #ddd; padding: 15px; margin-top: 15px; font-style: oblique; border-radius: 5px;">
                                Select the field type you want to edit below. Make sure to adjust any necessary field
                                options if the type is select, checkbox, or radio. Separate each option with a comma.
                            </div>

                            <!-- Card for editing fields with border -->
                            <div class="card card-light"
                                style="margin-top: 20px; border: 1px solid #ddd; border-radius: 5px;">
                                <div class="card-header">
                                    <h3 class="card-title">Editing Fields</h3>
                                    <div class="card-tools">
                                        <button type="button" id="add-field" class="btn btn-default btn-tool"
                                            style="float: right;">
                                            <i class="fas fa-plus"></i>&nbsp; Add Fields
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table id="dynamic_field" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Values (Selected fields)</th>
                                                <th>Required</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="fields-container">
                                            @foreach ($fields as $field)
                                                <tr id="row{{ $field->id }}">
                                                    <td>
                                                        <input type="text" class="form-control" name="label[]"
                                                            value="{{ old('label.' . $loop->index, $field->label) }}" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="name[]"
                                                            value="{{ old('name.' . $loop->index, $field->name) }}" required>
                                                    </td>
                                                    <td>
                                                        <select name="type[]" class="form-control">
                                                            <option value="text" {{ old('type.' . $loop->index, $field->type) == 'text' ? 'selected' : '' }}>text</option>
                                                            <option value="email" {{ old('type.' . $loop->index, $field->type) == 'email' ? 'selected' : '' }}>email</option>
                                                            <option value="password" {{ old('type.' . $loop->index, $field->type) == 'password' ? 'selected' : '' }}>password</option>
                                                            <option value="textarea" {{ old('type.' . $loop->index, $field->type) == 'textarea' ? 'selected' : '' }}>textarea</option>
                                                            <option value="select" {{ old('type.' . $loop->index, $field->type) == 'select' ? 'selected' : '' }}>select</option>
                                                            <option value="radio" {{ old('type.' . $loop->index, $field->type) == 'radio' ? 'selected' : '' }}>radio</option>
                                                            <option value="checkbox" {{ old('type.' . $loop->index, $field->type) == 'checkbox' ? 'selected' : '' }}>checkbox</option>
                                                            <option value="hidden" {{ old('type.' . $loop->index, $field->type) == 'hidden' ? 'selected' : '' }}>hidden</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="value[]" class="form-control"
                                                            value="{{ old('value.' . $loop->index, $field->values) }}">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="required[{{ $loop->index }}]"
                                                            value="1" {{ old('required.' . $loop->index, $field->required) == '1' ? 'checked' : '' }}> Yes
                                                        <input type="radio" name="required[{{ $loop->index }}]"
                                                            value="0" {{ old('required.' . $loop->index, $field->required) == '0' ? 'checked' : '' }}> No
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm remove-field">Hapus</button>
                                                        <input type="hidden" name="field_id[]" value="{{ $field->id }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End Card -->

                            <!-- Save Form Button -->
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Update Form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var fieldCount = {{ count($fields) }}; // Initial count for fields

        // Event listener for Add Field button
        $('#add-field').on('click', function () {
            fieldCount++;
            var newRow = `
                <tr id="row${fieldCount}">
                    <td><input type="text" class="form-control" name="label[]" placeholder="Field label"></td>
                    <td><input type="text" class="form-control" name="name[]" placeholder="Field name"></td>
                    <td>
                        <select name="type[]" class="form-control">
                            <option value="text">text</option>
                            <option value="email">email</option>
                            <option value="password">password</option>
                            <option value="textarea">textarea</option>
                            <option value="select">select</option>
                            <option value="radio">radio</option>
                            <option value="checkbox">checkbox</option>
                            <option value="hidden">hidden</option>
                        </select>
                    </td>
                    <td><input type="text" name="value[]" class="form-control"></td>
                    <td>
                        <input type="radio" name="required[${fieldCount}]" value="1"> Yes
                        <input type="radio" name="required[${fieldCount}]" value="0"> No
                    </td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-field">Hapus</button></td>
                </tr>
            `;
            $('#fields-container').append(newRow);
        });

        // Event listener for Remove button
        $('#fields-container').on('click', '.remove-field', function () {
            $(this).closest('tr').remove();
        });
    });
</script>
