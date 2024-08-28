@extends('dashboard')

@section('title', 'Manage Forms')

@section('content')
<div id="page-content">
    <div class="panel">
        <div class="panel-heading" style="position: relative;">
            <h3 class="panel-title">Manage Forms</h3>
            <!-- Add the 'Create Form' button next to the panel title -->
            <a href="{{ route('forms.create') }}" class="btn btn-secondary" style="position: absolute; top: 0; right: 0;">
                <i class="fas fa-plus"></i> Create Form
            </a>
        </div>
        <div class="panel-body">
            <div class="card">
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Form Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Check if there are any forms available -->
                            @forelse($forms as $form)
                            <tr>
                                <!-- Display the form name -->
                                <td>{{ $form->name }}</td>
                                <td>
                                    <!-- Edit button -->
                                    <a href="{{ route('forms.edit', $form->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <!-- View This Form button -->
                                    <a href="{{ route('forms.show', $form->id) }}" class="btn btn-primary btn-sm">View This Form</a>
                                    <!-- Add Child button -->
                                    <a href="{{ route('forms.addChild', $form->id) }}" class="btn btn-primary btn-sm">Add Child</a>
                                    <!-- Delete button with confirmation prompt -->
                                    <form action="{{ route('forms.destroy', $form->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this form?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <!-- Display a message if no forms are available -->
                                <td colspan="2" class="text-center">No forms available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Pagination controls -->
                    {{ $forms->links() }}
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
