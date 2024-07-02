@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Family Details</div>

                <div class="card-body">
                    <!-- Family Head Details -->
                    <h5>Family Head Details</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $family->name }}</td>
                        </tr>
                        <tr>
                            <th>Surname</th>
                            <td>{{ $family->surname }}</td>
                        </tr>
                        <tr>
                            <th>Birthdate</th>
                            <td>{{ $family->birthdate }}</td>
                        </tr>
                        <tr>
                            <th>Mobile No</th>
                            <td>{{ $family->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $family->address }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $family->state }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $family->city }}</td>
                        </tr>
                        <tr>
                            <th>Pincode</th>
                            <td>{{ $family->pincode }}</td>
                        </tr>
                        <tr>
                            <th>Marital Status</th>
                            <td>{{ ucfirst($family->marital_status) }}</td>
                        </tr>
                        @if($family->marital_status == 'married')
                        <tr>
                            <th>Wedding Date</th>
                            <td>{{ $family->wedding_date }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Photo</th>
                            <td>
                                @php
                                    $photoPath = 'storage/head_photos/' . $family->photo;
                                @endphp

                                @if (file_exists(public_path($photoPath)))
                                    <div>
                                        <img style="max-width: 150px; max-height: 150px;" src="{{ asset($photoPath) }}" alt="Family Head Photo">
                                    </div>
                                @else
                                    <p>No photo available</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Hobbies</th>
                            <td>
                                    {{ $family->hobbies }}
                            </td>
                        </tr>
                    </table>

                    <!-- Family Members Details -->
                    <hr>
                    <h5>Family Members</h5>
                    @if($family->FamilyMember->isEmpty())
                        <p>No family members added.</p>
                    @else
                        @foreach($family->FamilyMember as $member)
                        <div class="card mb-3">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $member->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Birthdate</th>
                                        <td>{{ $member->birthdate }}</td>
                                    </tr>
                                    <tr>
                                        <th>Marital Status</th>
                                        <td>{{ ucfirst($member->marital_status) }}</td>
                                    </tr>
                                    @if($member->marital_status == 'married')
                                    <tr>
                                        <th>Wedding Date</th>
                                        <td>{{ $member->wedding_date }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Education</th>
                                        <td>{{ $member->education }}</td>
                                    </tr>
                                    <tr>
                                        <th>Photo</th>
                                        <td>
                                            @php
                                                $memPhotoPath = 'storage/head_photos/' . $member->photo;
                                            @endphp
                                            @if (file_exists(public_path($memPhotoPath)))
                                                <div>
                                                    <img style="max-width: 150px; max-height: 150px;" src="{{ asset($memPhotoPath) }}" alt="Family Head Photo">
                                                </div>
                                            @else
                                                <p>No photo available</p>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @endforeach
                    @endif

                    <!-- Back Button -->
                    <a href="{{ route('families.index') }}" class="btn btn-secondary">Back to Families List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
