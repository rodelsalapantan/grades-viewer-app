@extends('layouts.admin')

@section('title', 'Create Teacher | Admin')

@section('content')

    <div class="row justify-content-center mx-md-5">
        <div class="d-flex mb-4">
            <h2 class="mx-auto fw-bold">Create New Teacher:</h2>
        </div>
        <form action="" method="post">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter name"
                    value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" name="name" id="email" class="form-control" placeholder="Enter email"
                    value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="department" class="form-label fw-bold">Department</label>
                <select class="form-select " name="" id="department" required>
                    <option selected disabled>Select department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-5">
                <button type="submit" class="btn btn-success px-5">Create</button>
            </div>
        </form>
        <hr />

        <div class="d-flex">
            <h4 class="mx-auto fw-bold"> Or Import Spreedsheet</h4>
        </div>
        <form action="" method="post">
            <div class="mb-3">
                <label for="file" class="form-label fw-bold me-2">Choose file: </label>
                <span class="fst-italic">file format: (.xlsx, .xls, .csv)</span>
                <input type="file" class="form-control" name="" id="file" placeholder=""
                    aria-describedby="fileHelpId" accept=".xlsx, .xls, .csv">
                <div id="fileHelpId" class="form-text">Help text</div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success px-5">Save</button>
            </div>
        </form>
    </div>
@endsection
