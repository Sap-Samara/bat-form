@extends('dashboard')

@section('title', 'Create Form')

@section('content')
    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Create Form</h3>
            </div>
            <div class="panel-body">
                <div class="card">
                    <div class="card-body">
                        <!-- Form to create a new form -->
                        <form action="{{ route('forms.store') }}" method="POST">
                            @csrf
                            <!-- Form Name Field -->
                            <div class="form-group">
                                <label for="form_name">Form Name: <span class="text-red"> *</span></label>
                                <input type="text" name="form_name" id="form_name" class="form-control" value="{{ old('form_name') }}" required>
                            </div>

                            <!-- Callout Information -->
                            <div class="callout callout-default"
                                style="border: 1px solid #ddd; padding: 15px; margin-top: 15px; font-style: oblique; border-radius: 5px;">
                                Select the field type you want to add below. Make sure to adjust any necessary field
                                options if the type is select, checkbox, or radio. Separate each option with a comma.
                            </div>

                            <div class="callout callout-default"
                                style="border: 1px solid #ddd; padding: 15px; margin-top: 15px; font-style: oblique; border-radius: 5px;">
                                Click 'Add fields' button to add fields
                            </div>

                            <!-- Card for editing fields with border -->
                            <div class="card card-light"
                                style="margin-top: 20px; border: 1px solid #ddd; border-radius: 5px;">
                                <div class="card-header">
                                    <h3 class="card-title">Adding Fields</h3>
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
                                            <!-- Initial empty rows will be added dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End Card -->

                            <!-- Save Form Button -->
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Create Form</button>
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
        var fieldCount = 0; // Initial count for fields

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
