<x-main_admin_layout>


    <div>
        <!-- Add Modal -->
        @include('dashboard.user.add')
        <div>
            <!-- Update Modal -->
            @include('dashboard.user.update')
        </div>
        <div class="mb-2">
            <button type="button" class="btn btn-primary" id="addUser" data-bs-toggle="modal"
                data-bs-target="#userAddModel">Add User</button>
        </div>
        <table class="table table-bordered" id="buttons-datatables">
            <thead>
                <tr>
                    <th scope="col">Sr No</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                @foreach ($users as $row)
                    <tr id="user{{ $row->id }}">
                        <th scope="row">{{ $count }}</th>
                        <td>{{ $row->fname }} {{ $row->lname }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->mobile }}</td>
                        <td>{{ $row->role }}</td>
                        <td>
                            <i class='bx bx-pencil nav_icon cursor-pointer text-primary edit-element'
                                data-bs-toggle="modal" data-bs-target="#userUpdateModel"
                                data-id="{{ $row->id }}"></i>
                            &nbsp;&nbsp;
                            <i class='bx bx-show nav_icon cursor-pointer'></i>
                            &nbsp;&nbsp;
                            <i class='bx bx-trash nav_icon cursor-pointer text-danger deleteUser'
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
                    var url = "{{ route('user.edit', ':model_id') }}";

                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'GET',
                        data: {
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data, textStatus, jqXHR) {
                            if (!data.error) {
                                $("#updateFormSubmit input[name='edit_model_id']").val(data.user.id);
                                $("#updateFormSubmit input[name='fname']").val(data.user.fname);
                                $("#updateFormSubmit input[name='lname']").val(data.user.lname);
                                $("#updateFormSubmit input[name='email']").val(data.user.email);
                                $("#updateFormSubmit input[name='mobile']").val(data.user.mobile);
                                $("#updateFormSubmit input[name='role']").val(data.user.role);
                                $("#updateFormSubmit input[name='userID']").val(data.user.id);
                                $("#updateFormSubmit select[name='role']").val(data.user.role).trigger(
                                    'change');
                            } else {
                                alert(data.error);
                            }
                        },
                        error: function(error, jqXHR, textStatus, errorThrown) {
                            toastr.error("Something went wrong");
                        },
                    });
                });


                $("#buttons-datatables").on("click", ".deleteUser", function(e) {
                    e.preventDefault();

                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('user.destroy', ':model_id') }}";

                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: {
                            '_method': "DELETE",
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data, textStatus, jqXHR) {
                            if (!data.error) {
                                document.getElementById('user' + model_id).outerHTML = "";
                                toastr.success("User deleted successfully");
                            }
                        },
                        error: function(error, jqXHR, textStatus, errorThrown) {
                            toastr.error("Unable to delete user");
                        },
                    });
                });
            </script>
        @endpush
</x-main_admin_layout>
