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
                        <div class="form-group" data-field-type="{{ $field->type }}">
                            <!-- Label for the field -->
                            <label for="{{ $field->name }}">{{ $field->label }}</label>

                            @switch($field->type)
                                @case('select')
                                    <select name="{{ $field->name }}" id="{{ $field->name }}" class="form-control field-select">
                                        <option value="" disabled selected>{{ ucfirst($field->type) }}</option>
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

            <!-- Menu tambahan yang akan muncul berdasarkan pilihan -->
            <div id="additional-options" style="display: none;">
                <!-- Konten menu tambahan -->
                <h4>Additional Options</h4>
                <!-- Misalnya, dropdown atau input tambahan -->
                <div class="form-group">
                    <label for="additional_input">Additional Input</label>
                    <input type="text" id="additional_input" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fields = document.querySelectorAll('.form-group');

    // Fungsi untuk menunjukkan atau menyembunyikan menu tambahan
    function toggleAdditionalOptions() {
        const additionalOptions = document.getElementById('additional-options');
        let showOptions = false;

        fields.forEach(field => {
            const fieldType = field.getAttribute('data-field-type');
            const fieldElement = field.querySelector('select, input[type="radio"], input[type="checkbox"]');

            if (fieldElement && fieldElement.checked) {
                showOptions = true; // Menampilkan menu tambahan jika ada field yang dipilih
            }
        });

        additionalOptions.style.display = showOptions ? 'block' : 'none';
    }

    // Menambahkan event listener untuk perubahan pada field
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('change', toggleAdditionalOptions);
    });

    // Inisialisasi tampilan awal
    toggleAdditionalOptions();
});
</script>
@endsection

@endsection
