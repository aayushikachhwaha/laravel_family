@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Back Button -->
    <a href="{{ route('families.index') }}" class="btn btn-secondary">Back to Families List</a>

    

    <div class="row justify-content-center">
        <div class="col-md-8">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
        @endif
            <div class="card">
                <div class="card-header">Create Family Head and Members</div>

                <div class="card-body">
                    <form id="familyForm" method="POST" action="{{ route('families.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Head Details -->
                        <h5>Family Head Details</h5>
                        <div class="form-group">
                            <label for="head_name">Name</label>
                            <input type="text" class="form-control" id="head_name" name="head_name" required>
                        </div>
                        <div class="form-group">
                            <label for="head_surname">Surname</label>
                            <input type="text" class="form-control" id="head_surname" name="head_surname" required>
                        </div>
                        <div class="form-group">
                            <label for="head_birthdate">Birthdate</label>
                            <input type="date" class="form-control" id="head_birthdate" name="head_birthdate" required>
                        </div>
                        <div class="form-group">
                            <label for="head_mobile_no">Mobile No</label>
                            <input type="text" class="form-control" id="head_mobile_no" name="head_mobile_no" required>
                        </div>
                        <div class="form-group">
                            <label for="head_address">Address</label>
                            <textarea class="form-control" id="head_address" name="head_address" rows="3" required></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="head_state">State</label>
                                <select class="form-control" id="head_state" name="head_state" required>
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="head_city">City</label>
                                <select class="form-control" id="head_city" name="head_city" required>
                                    <option value="">Select City</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="head_pincode">Pincode</label>
                            <input type="text" class="form-control" id="head_pincode" name="head_pincode" required>
                        </div>
                        <div class="form-group">
                            <label>Marital Status</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="head_marital_status" id="married" value="married">
                                <label class="form-check-label" for="married">Married</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="head_marital_status" id="unmarried" value="unmarried" checked>
                                <label class="form-check-label" for="unmarried">Unmarried</label>
                            </div>
                        </div>
                        <div class="form-group" id="weddingDateContainer" style="display: none;">
                            <label for="head_wedding_date">Wedding Date</label>
                            <input type="date" class="form-control" id="head_wedding_date" name="head_wedding_date">
                        </div>
                        <div class="form-group">
                            <label for="head_photo">Upload Photo</label>
                            <input type="file" class="form-control-file" id="head_photo" name="head_photo">
                        </div>
                        <div class="form-group">
                            <label for="head_hobbies">Hobbies</label>
                            <div id="head_hobbies_container">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="head_hobbies[]" placeholder="Enter hobby">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary add-head-hobby" type="button">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Members Details -->
                        <hr>
                        <h5>Family Members</h5>
                        <div id="members_container">
                            <div class="member-form">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="member_name">Name</label>
                                        <input type="text" class="form-control" name="members[0][name]" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="member_birthdate">Birthdate</label>
                                        <input type="date" class="form-control" name="members[0][birthdate]" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Marital Status</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="members[0][marital_status]" value="married">
                                            <label class="form-check-label">Married</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="members[0][marital_status]" value="unmarried" checked>
                                            <label class="form-check-label">Unmarried</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" id="member_wedding_date_container_0" style="display: none;">
                                        <label for="member_wedding_date">Wedding Date</label>
                                        <input type="date" class="form-control" name="members[0][wedding_date]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_education">Education</label>
                                    <input type="text" class="form-control" name="members[0][education]">
                                </div>
                                <div class="form-group">
                                    <label for="members[0][photo]">Upload Photo</label>
                                    <input type="file" class="form-control-file" name="members[0][photo]">
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-danger remove-member">Remove Member</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-secondary mt-3 mb-3 add-member">Add Member</button>

                        <hr>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">
$(document).ready(function() {
    // Toggle wedding date field based on marital status for family head
    $('input[name="head_marital_status"]').change(function() {
        if ($(this).val() === 'married') {
            $('#weddingDateContainer').show();
        } else {
            $('#weddingDateContainer').hide();
        }
    });

    // Toggle wedding date field based on marital status for family members
    $(document).on('change', 'input[name^="members["][name$="[marital_status]"]', function() {
        var container = $(this).closest('.member-form').find('#member_wedding_date_container_' + $(this).closest('.member-form').index());
        if ($(this).val() === 'married') {
            container.show();
        } else {
            container.hide();
        }
    });

    // Add hobby field for family head
    $(document).on('click', '.add-head-hobby', function() {
        var inputGroup = $('<div class="input-group mb-2"><input type="text" class="form-control" name="head_hobbies[]" placeholder="Enter hobby"><div class="input-group-append"><button class="btn btn-outline-secondary remove-head-hobby" type="button">Remove</button></div></div>');
        $('#head_hobbies_container').append(inputGroup);
    });

    // Remove hobby field for family head
    $(document).on('click', '.remove-head-hobby', function() {
        $(this).closest('.input-group').remove();
    });

    // Add member field
    $(document).on('click', '.add-member', function() {
        var membersContainer = $('#members_container');
        var newIndex = membersContainer.children().length; // Get new index
        var newMemberForm = '<div class="member-form">';
        newMemberForm += '<div class="form-row">';
        newMemberForm += '<div class="form-group col-md-6">';
        newMemberForm += '<label for="member_name">Name</label><input type="text" class="form-control" name="members[' + newIndex + '][name]" required></div>';
        newMemberForm += '<div class="form-group col-md-6">';
        newMemberForm += '<label for="member_birthdate">Birthdate</label><input type="date" class="form-control" name="members[' + newIndex + '][birthdate]" required></div>';
        newMemberForm += '</div>';
        newMemberForm += '<div class="form-row">';
        newMemberForm += '<div class="form-group col-md-6">';
        newMemberForm += '<label>Marital Status</label><br>';
        newMemberForm += '<div class="form-check form-check-inline">';
        newMemberForm += '<input class="form-check-input" type="radio" name="members[' + newIndex + '][marital_status]" value="married">';
        newMemberForm += '<label class="form-check-label">Married</label></div>';
        newMemberForm += '<div class="form-check form-check-inline">';
        newMemberForm += '<input class="form-check-input" type="radio" name="members[' + newIndex + '][marital_status]" value="unmarried" checked>';
        newMemberForm += '<label class="form-check-label">Unmarried</label></div></div>';
        newMemberForm += '<div class="form-group col-md-6" id="member_wedding_date_container_' + newIndex + '" style="display: none;">';
        newMemberForm += '<label for="member_wedding_date">Wedding Date</label><input type="date" class="form-control" name="members[' + newIndex + '][wedding_date]"></div></div>';
        newMemberForm += '<div class="form-group">';
        newMemberForm += '<label for="member_education">Education</label><input type="text" class="form-control" name="members[' + newIndex + '][education]"></div>';
        newMemberForm += '<div class="form-group">';
        newMemberForm += '<label for="member_photo">Upload Photo</label><input type="file" class="form-control-file" name="members[' + newIndex + '][photo]"></div>';
        newMemberForm += '<div class="form-group">';
        newMemberForm += '<button type="button" class="btn btn-outline-danger remove-member">Remove Member</button></div></div>';
        membersContainer.append(newMemberForm);
    });

    // Remove member field
    $(document).on('click', '.remove-member', function() {
        $(this).closest('.member-form').remove();
    });

    // Custom validation methods
    $.validator.addMethod("ageAbove21", function(value, element) {
        // Calculate age based on birthdate
        var today = new Date();
        var birthDate = new Date(value);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age > 21;
    }, "Age must be above 21 years.");

    // Client-side form validation using jQuery Validate plugin
    $('#familyForm').validate({
        rules: {
            'head_name': {
                required: true,
                maxlength: 255
            },
            'head_surname': {
                required: true,
                maxlength: 255
            },
            'head_birthdate': {
                required: true,
                ageAbove21: true
            },
            'head_mobile_no': {
                required: true,
                maxlength: 10
            },
            'head_address': {
                required: true,
                maxlength: 255
            },
            'head_state': {
                required: true,
                maxlength: 255
            },
            'head_city': {
                required: true,
                maxlength: 255
            },
            'head_pincode': {
                required: true,
                maxlength: 10
            },
            'head_marital_status': {
                required: true
            },
            'head_wedding_date': {
                required: function(element) {
                    return $('input[name="head_marital_status"]:checked').val() === 'married';
                }
            },
            'head_hobbies[]': {
                maxlength: 255
            },
            'members[][name]': {
                required: true,
                maxlength: 255
            },
            'members[][birthdate]': {
                required: true,
                ageAbove21: true
            },
            'members[][marital_status]': {
                required: true
            },
            'members[][wedding_date]': {
                required: function(element) {
                    return $(element).closest('.member-form').find('input[name^="members["][name$="[marital_status]"]:checked').val() === 'married';
                }
            }
        },
        messages: {
            head_birthdate: {
                ageAbove21: "Head of family must be above 21 years old."
            },
            'members[][birthdate]': {
                ageAbove21: "Family member must be above 21 years old."
            }
        }
    });

    // Show/hide wedding date field based on marital status initially
    if ($('input[name="head_marital_status"]:checked').val() === 'married') {
        $('#weddingDateContainer').show();
    }

    // Show/hide wedding date field for each member based on marital status initially
    $('input[name^="members["][name$="[marital_status]"]:checked').each(function() {
        var container = $(this).closest('.member-form').find('#member_wedding_date_container_' + $(this).closest('.member-form').index());
        if ($(this).val() === 'married') {
            container.show();
        }
    });

    // Function to fetch cities based on selected state
    $('#head_state').change(function() {
        var stateId = $(this).val();
        if (stateId) {
            $.ajax({
                url: '{{ route('cities.by_state') }}',
                type: 'GET',
                data: {
                    state_id: stateId
                },
                success: function(response) {
                    $('#head_city').empty().append('<option value="">Select City</option>');
                    $.each(response, function(key, city) {
                        $('#head_city').append('<option value="' + city.name + '">' + city.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching cities:', error);
                }
            });
        } else {
            $('#head_city').empty().append('<option value="">Select City</option>');
        }
    });
});
</script>
@endsection
