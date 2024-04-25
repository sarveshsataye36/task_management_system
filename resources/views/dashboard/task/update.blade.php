<div class="modal fade" id="taskUpdateModel" tabindex="-1" aria-labelledby="userAddModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="addForm">
                <form action="" method="post" id="updateFormSubmit">
                    <div class="row px-2">
                        <div class="col-lg-12 py-3">
                            <h5 id="headChanage">Update Task</h5>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="task_name" class="form-label">Task name</label>
                                <input type="text" id="task_name" name="task_name" class="form-control"
                                    autocomplete="false">
                                <span id="task_name_error_update" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="task_details" class="form-label">Task description</label>
                                <textarea name="task_details" id="task_details" cols="2" rows="2" class="form-control"></textarea>
                                <span id="task_details_error_update" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="task_user_id" class="form-label">Assign To</label>
                                <select class="form-select" id="task_user_id" aria-label="Default select example"
                                    name="task_user_id">
                                    <option value="">User Name</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}</option>
                                    @endforeach
                                </select>
                                <span id="task_user_id_error_update" class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                                <label for="task_project_id" class="form-label">Projects</label>
                                <select class="form-select" id="task_project_id" aria-label="Default select example"
                                    name="task_project_id">
                                    <option value="">Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                                <span id="task_project_id_error_update" class="text-danger error"></span>
                            </div>
                            <div class="col-lg-12">
                                <label for="task_status" class="form-label">Task Status</label>
                                <select class="form-select" id="task_status" aria-label="Default select example"
                                    name="task_status">
                                    <option value="">Task Status</option>
                                    <option value="complete">Complete</option>
                                    <option value="incomplete">Incomplete</option>
                                </select>
                                <span id="task_status_error_update" class="text-danger error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="taskID" name="taskID">
                        <div class="col-lg-12 d-flex justify-content-center py-3">
                            <button class="btn btn-primary" id="updateSubmit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
         // update         
         $("#updateFormSubmit").submit(function(e) {
                    e.preventDefault();
                    $("#updateSubmit").prop('disabled', true);

                    var formdata = new FormData(this);
                    formdata.append('_method', 'PUT');
                    var model_id = $('#taskID').val();
                    var url = "{{ route('task.update', ':model_id') }}";

                    // Manually append CSRF token to FormData
                    formdata.append('_token', '{{ csrf_token() }}');

                    console.log(formdata);
                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: formdata,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $("#updateSubmit").prop('disabled', false);
                            if (data.success) {

                                // Clear all previous error messages
                                $('.error').empty();
                                toastr.success("Task Updated Successfully");
                            }
                        },
                        statusCode: {
                            422: function(responseObject, textStatus, jqXHR) {
                                $("#updateSubmit").prop('disabled', false);
                                var errors = responseObject.responseJSON.errors;

                                // Clear all previous error messages
                                $('.error').empty();

                                // Populate error messages
                                $.each(errors, function(key, value) {
                                    document.getElementById(key + '_error_update').innerHTML = value;
                                });
                            },
                            500: function(responseObject, textStatus, errorThrown) {
                                $("#updateSubmit").prop('disabled', false);
                                toastr.error("Unable to update task");
                            }
                        }
                    });


                });
    </script>
@endpush