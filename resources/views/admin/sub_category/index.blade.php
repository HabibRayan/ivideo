@extends('admin.master')

@section('title','Sub Category | QuranerDak')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-sm-4">
                <input type="button" class="btn btn-info btn-sm float-left" id="add_sub_category" value="Add Subcategory">
            </div>
            <div class="col-sm-4 bg-light sub-cat-header">
                <div class="card">
                    <div class="card-header m-3">
                        <h3>Sub Category Information</h3>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <form class="form-inline text-right">
                    <input class="form-control mr-sm-2 my-sm-0" type="text" placeholder="Search" name="subcategory_search" id="subcategory_search">
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @if($subCategories ->count() <= 0)
                <h3>No Record Found </h3>
            @else
                <table class="table bg-light">
                    <thead class="thead-dark" style="background: green; color: white;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category</th>
                        <th scope="col">Sub Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subCategories as $key =>  $subCategory )
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $subCategory->categories->category }}</td>
                            <td>{{ $subCategory->subcategory }}</td>
                            <td>{{ $subCategory->description }}</td>
                            <td>{{ $subCategory->status }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary subcategory_edit"  data-id="{{ $subCategory->id }}" title="edit"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger delete_subcategory" data-id="{{ $subCategory->id }}" title="delete" onclick=""><i class="fa fa-trash"></i></button>
                                <button class="btn btn-sm btn-info " title="delete"><i class="fa fa-arrow-down"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </table>
                    @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="subcategory_modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close category_modal_close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="subcategory_title">Add Subcategory</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.subcategory') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="subcategory_id">

                        <div class="form-group">
                            <label for="subcategory">Subcategory:</label>
                            <input class="form-control" name="subcategory" id="subcategory">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category:</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">--Select Category--</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">--Select Status--</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group text-right mb-5">
                            <button type="submit" class="btn btn-sm btn-info" id="subcategory_save" value="insert">Save</button>
                            <button type="button" class="btn btn-sm btn-danger subcategory_modal_close" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--    delete modal--}}

    <div class="modal fade" id="subcategory_delete_modal_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-center" style="padding-bottom: 30px">
                <div class="modal-header bg-danger">
                    <h3 class="modal-title" id="exampleModalLabel">Delete Confirmation</h3>
                </div>
                <div class="modal-body text-danger">
                    Are You Sure Delete This?
                </div>
                <hr>
                <div class="text-center">
                    <button type="button" class="btn btn-sm btn-info btn-cancel" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-danger delete_confirm" data-value="yes"><i class="fa fa-trash"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        // add category
        $('#add_sub_category').on('click',function (event) {
            $('#subcategory_modal').modal('show');
        });

        $('.delete_subcategory').on('click',function (event) {
            var id = $(this).data('id');
        $('#subcategory_delete_modal_confirm').modal('show');

        $('.delete_confirm').on('click',function () {
            var btnValue = $(this).data('value');

            if (btnValue === 'yes'){
                $.ajax({
                    method: 'get',
                    url:"{{ route('subcategory.delete') }}",
                    data: { id:id },
                    success:function (data) {
                        console.log(data);
                        if (data === "Deleted"){
                            location.reload(true);
                        }
                    },
                    error:function (err) {
                        console.log(err);
                    }

                });
            }else {
                $('.btn-cancel').click();
            }
        });

        });
        $('.subcategory_edit').on('click',function (event) {
            var id = $(this).data('id');
            $.ajax({
                method:'GET',
                url: "{{ route('edit.subcategory') }}",
                data: { id: id},
                success:function (data) {
                    console.log(data);
                    var subcategoryInfo = $.parseJSON(data);
                    $('#subcategory_id').val(subcategoryInfo.id);
                    $('#subcategory').val(subcategoryInfo.subcategory);
                    $('#category_id').val(subcategoryInfo.category_id);
                    $('#description').val(subcategoryInfo.description);
                    $('#status').val(subcategoryInfo.status);
                    $('#subcategory_save').text('Update');
                    $('#subcategory_title').text('Category Update');
                    $('#subcategory_modal').modal('show');
                },
                error:function (err) {
                    console.log(err);
                }
            });
        });

        // close modal
        $('.subcategory_modal_close').on('click', function () {
            $('#subcategory_id').val('');
            $('#subcategory').val('');
            $('#category_id').val('');
            $('#description').val('');
            $('#status').val('');
            $('#subcategory_save').text('Save');
            $('#subcategory_title').text('Add Subcategory');
            return true;
        });

        // subcategory search


        $('#subcategory_search').on('keyup', function () {
            $search = $(this).val();
            $.ajax({
                method:'get',
                url: "{{ route('subcategory.search') }}",
                data: {'search':$search },
                success:function (data) {
                    console.log(data);
                    $('tbody').html(data);
                },
                error:function (err) {
                    console.log(err);
                }
            })

        });
    </script>

@endsection
