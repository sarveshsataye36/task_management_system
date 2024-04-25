   <!-- Add Modal -->
   <div class="modal fade" id="userAddModel" tabindex="-1" aria-labelledby="userAddModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="addForm">
                <form action="" method="post" id="addFormSubmit">
                    <div class="row" style="background: white">
                        <div class="py-3">
                            <h5 id="headChanage">Add User</h5>
                        </div>
                        <hr>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="fname" class="form-label">First name</label>
                                <input type="text" id="fname" name="fname" class="form-control"
                                    autocomplete="false">
                                <span id="fname_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last name</label>
                                <input type="text" id="lname" name="lname" class="form-control"
                                    autocomplete="false">
                                <span id="lname_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    autocomplete="false">
                                <span id="email_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="text" id="mobile" name="mobile" class="form-control"
                                    autocomplete="false">
                                <span id="mobile_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control"
                                    autocomplete="false">
                                <span id="password_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="cnf_pass" class="form-label">Confirm Password</label>
                                <input type="password" id="cnf_pass" name="cnf_pass" class="form-control"
                                    autocomplete="false">
                                <span id="cnf_pass_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="selectRole" class="form-label">Roles</label>
                                <select class="form-select" id="role" aria-label="Default select example"
                                    name="role">
                                    <option value="">User Roles</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role_name }}">{{ $role->role_title }}</option>
                                    @endforeach
                                </select>
                                <span id="role_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center py-3">
                            <button class="btn btn-primary" id="addSubmit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        // Insert
        $("#addFormSubmit").submit(function(e) {
                    e.preventDefault();
                    $("#addSubmit").prop('disabled', true);

                    var formdata = new FormData(this);

                    // Manually append CSRF token to FormData
                    formdata.append('_token', '{{ csrf_token() }}');

                    console.log(formdata);
                    $.ajax({
                        url: '{{ route('user.store') }}',
                        type: 'POST',
                        data: formdata,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $("#addSubmit").prop('disabled', false);
                            if (data.success) {

                                // Clear form fields
                                document.getElementById('addFormSubmit').reset();

                                // Clear all previous error messages
                                $('.error').empty();
                                toastr.success("User Created Successfully");
                            }
                        },
                        statusCode: {
                            422: function(responseObject, textStatus, jqXHR) {
                                $("#addSubmit").prop('disabled', false);
                                var errors = responseObject.responseJSON.errors;

                                // Clear all previous error messages
                                $('.error').empty();

                                // Populate error messages
                                $.each(errors, function(key, value) {
                                    document.getElementById(key + '_error').innerHTML = value;
                                });
                            },
                            500: function(responseObject, textStatus, errorThrown) {
                                $("#addSubmit").prop('disabled', false);
                                toastr.error("Unable to create user");
                            }
                        }
                    });


                });
    </script>
@endpush