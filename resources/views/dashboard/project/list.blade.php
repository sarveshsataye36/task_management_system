<x-main_admin_layout>


    <div>
        <!-- Add Modal -->
        @include('dashboard.project.add')
        <div>
            <!-- Update Modal -->
            @include('dashboard.project.update')
        </div>
        <div class="mb-2">
            <button type="button" class="btn btn-primary" id="addUser" data-bs-toggle="modal"
                data-bs-target="#projectAddModel">Add Project</button>
        </div>
        <table class="table table-bordered" id="buttons-datatables">
            <thead>
                <tr>
                    <th scope="col">Sr No</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Project TL</th>
                    <th scope="col">Project Desc</th>
                    <th scope="col">Project Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                @foreach ($projects as $row)
                    <tr id="project{{ $row->id }}">
                        <th scope="row">{{ $count }}</th>
                        <td>{{ $row->project_name }}</td>
                        <td>{{ $row->users->fname }} {{ $row->users->lname }}</td>
                        <td>{{ $row->project_desc }}</td>
                        <td>{{ $row->project_status }}</td>
                        <td>
                            <i class='bx bx-pencil nav_icon cursor-pointer text-primary edit-element'
                                data-bs-toggle="modal" data-bs-target="#projectUpdateModel"
                                data-id="{{ $row->id }}"></i>
                            &nbsp;&nbsp;
                            <i class='bx bx-show nav_icon cursor-pointer'></i>
                            &nbsp;&nbsp;
                            <i class='bx bx-trash nav_icon cursor-pointer text-danger deleteProject'
                                data-id="{{ $row->id }}"></i>
                        </td>
                    </tr>
                    <?php $count++; ?>
                @endforeach
            </tbody>
        </table>



        @push('script')
            <script>
                // Edit
                $("#buttons-datatables").on("click", ".edit-element", function(e) {
                    e.preventDefault();
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('project.edit', ':model_id') }}";

                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'GET',
                        data: {
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data, textStatus, jqXHR) {
                            if (!data.error) {
                                $("#updateFormSubmit input[name='edit_model_id']").val(data.project.id);
                                $("#updateFormSubmit input[name='project_name']").val(data.project.project_name);
                                $("#updateFormSubmit input[name='project_desc']").val(data.project.project_desc);
                                $("#updateFormSubmit input[name='projectID']").val(data.project.id);
                                $("#updateFormSubmit select[name='project_status']").val(data.project.project_status).trigger('change')
                                $("#updateFormSubmit select[name='project_user_id']").val(data.project.project_user_id).trigger('change');
                            } else {
                                alert(data.error);
                            }
                        },
                        error: function(error, jqXHR, textStatus, errorThrown) {
                            toastr.error("Something went wrong");
                        },
                    });
                });


                $("#buttons-datatables").on("click", ".deleteProject", function(e) {
                    e.preventDefault();

                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('project.destroy', ':model_id') }}";

                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: {
                            '_method': "DELETE",
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data, textStatus, jqXHR) {
                            if (!data.error) {
                                document.getElementById('project' + model_id).outerHTML = "";
                                toastr.success("Project deleted successfully");
                            }
                        },
                        error: function(error, jqXHR, textStatus, errorThrown) {
                            toastr.error("Unable to delete project");
                        },
                    });
                });
            </script>
        @endpush
</x-main_admin_layout>
