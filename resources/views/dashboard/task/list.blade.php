<x-main_admin_layout>
        @if (auth()->user()->role == 'superAdmin' || auth()->user()->role == 'teamLeader' )
            <div>
                <!-- Add Modal -->
                @include('dashboard.task.add')
            <div>
                <!-- Update Modal -->
                @include('dashboard.task.update')
            </div>
        @endif
        @if (auth()->user()->role == 'superAdmin' || auth()->user()->role == 'teamLeader' )
            <div class="mb-2">
                <button type="button" class="btn btn-primary" id="addUser" data-bs-toggle="modal"
                    data-bs-target="#taskAddModel">Add Task</button>
            </div>
        @endif
        <table class="table table-bordered" id="buttons-datatables">
            <thead>
                <tr>
                    <th scope="col">Sr No</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Project TL</th>
                    <th scope="col">Task Employee</th>
                    <th scope="col">Task Desc</th>
                    <th scope="col">Task Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php $count = 1; ?>
                @foreach ($tasks as $row)
                    <tr id="task{{ $row->id }}">
                        <th scope="row">{{ $count }}</th>
                        <td>{{ $row->projects->project_name }}</td>
                        <td>{{ $row->projects->users->fname }} {{ $row->projects->users->lname }}</td>
                        <td>{{ $row->users->fname }} {{ $row->users->lname }}</td>
                        <td>{{ $row->task_details }}</td>
                        <td>{{ $row->task_status }}</td>
                        <td>
                            @if (auth()->user()->role == 'superAdmin' || auth()->user()->role == 'teamLeader' )
                                <i class='bx bx-pencil nav_icon cursor-pointer text-primary edit-element'
                                    data-bs-toggle="modal" data-bs-target="#taskUpdateModel"
                                    data-id="{{ $row->id }}"></i>
                            @endif
                            &nbsp;&nbsp;
                            <i class='bx bx-show nav_icon cursor-pointer'></i>
                            &nbsp;&nbsp;
                            @if (auth()->user()->role == 'superAdmin' || auth()->user()->role == 'teamLeader' )
                                <i class='bx bx-trash nav_icon cursor-pointer text-danger deleteTask'
                                    data-id="{{ $row->id }}"></i>
                            @endif
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
                    var url = "{{ route('task.edit', ':model_id') }}";

                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'GET',
                        data: {
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data, textStatus, jqXHR) {
                            
                            if (!data.error) {
                                console.log(data.task.task_details);
                                $("#updateFormSubmit input[name='edit_model_id']").val(data.task.id);
                                $("#updateFormSubmit input[name='task_name']").val(data.task.task_name);
                                $("#updateFormSubmit textarea[name='task_details']").val(data.task.task_details);
                                $("#updateFormSubmit input[name='taskID']").val(data.task.id);
                                $("#updateFormSubmit select[name='task_project_id']").val(data.task.task_project_id).trigger('change')
                                $("#updateFormSubmit select[name='task_user_id']").val(data.task.task_user_id).trigger('change');
                                $("#updateFormSubmit select[name='task_status']").val(data.task.task_status).trigger('change');
                            } else {
                                toastr.error("Something went wrong");
                            }
                        },
                        error: function(error, jqXHR, textStatus, errorThrown) {
                            toastr.error("Something went wrong");
                        },
                    });
                });


                $("#buttons-datatables").on("click", ".deleteTask", function(e) {
                    e.preventDefault();

                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('task.destroy', ':model_id') }}";

                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: {
                            '_method': "DELETE",
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data, textStatus, jqXHR) {
                            if (!data.error) {
                                document.getElementById('task' + model_id).outerHTML = "";
                                toastr.success("Task deleted successfully");
                            }
                        },
                        error: function(error, jqXHR, textStatus, errorThrown) {
                            toastr.error("Unable to delete task");
                        },
                    });
                });
            </script>
        @endpush
</x-main_admin_layout>
