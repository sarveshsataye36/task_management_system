   <!-- Add Modal -->
   <div class="modal fade" id="projectAddModel" tabindex="-1" aria-labelledby="userAddModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="addForm">
                <form action="" method="post" id="addFormSubmit">
                    <div class="row px-2">
                        <div class="col-lg-12 py-3">
                            <h5 id="headChanage">Add Project</h5>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="project_name" class="form-label">Project name</label>
                                <input type="text" id="project_name" name="project_name" class="form-control"
                                    autocomplete="false">
                                <span id="project_name_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="project_desc" class="form-label">Project desc</label>
                                <textarea name="project_desc" id="project_desc" cols="2" rows="2" class="form-control"></textarea>
                                <span id="project_desc_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="project_user_id" class="form-label">Assign</label>
                                <select class="form-select" id="project_user_id" aria-label="Default select example"
                                    name="project_user_id">
                                    <option value="">User Name</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}</option>
                                    @endforeach
                                </select>
                                <span id="project_user_id_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                                <label for="project_status" class="form-label">Project Status</label>
                                <select class="form-select" id="project_status" aria-label="Default select example"
                                    name="project_status">
                                    <option value="">Project Status</option>
                                    <option value="complete">Complete</option>
                                    <option value="incomplete">Incomplete</option>
                                    <option value="drop">Drop</option>
                                </select>
                                <span id="project_status_error" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center py-3">
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
                        url: '{{ route('project.store') }}',
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
                                toastr.success("Project Created Successfully");
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
                                toastr.error("Unable to create project");
                            }
                        }
                    });


                });
    </script>
@endpush