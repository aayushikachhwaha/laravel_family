<!-- resources/views/families/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Family List
                        <a href="{{ route('families.create') }}" class="btn btn-primary btn-sm float-right">Add New Family</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($familyHeads as $familyHead)
                                    <tr>
                                        <td><!-- Conditional display of image -->
                                            @php
                                                $photoPath = 'storage/head_photos/' . $familyHead->photo;
                                            @endphp

                                            @if ($familyHead->photo !='' && file_exists(public_path($photoPath)))
                                                <div>
                                                    <img style="max-width: 150px; max-height: 150px;" src="{{ asset($photoPath) }}" alt="Family Head Photo">
                                                </div>
                                            @else
                                                <p>No photo available</p>
                                            @endif
                                        </td>
                                        <td>{{ ($familyHead->name && $familyHead->surname) ? $familyHead->name .' '. $familyHead->surname : '---' }}
                                        (Family Members: {{ $familyHead->familyMember->count() }})
                                        </td>
                                        <td>
                                            <a href="{{ route('families.show', $familyHead->id) }}" class="btn btn-sm btn-primary">View</a>
                                            &nbsp;
                                            <form action="{{ route('families.destroy', $familyHead->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No families found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
