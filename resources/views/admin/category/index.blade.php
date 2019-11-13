@extends('admin.master')

@section('title','Category | QuranerDak')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-sm-4">
                <input type="button" class="btn btn-info btn-sm float-left" id="add_category" value="Add Category">
            </div>
            <div class="col-sm-4 bg-light category-header">
                <div class="card">
                    <div class="card-header m-3">
                        <h3>Category Information</h3>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <form class="form-inline text-right">
                    <input class="form-control mr-sm-2 my-sm-0" type="text" placeholder="Search" name="category_search" id="category_search">
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @if($categories->count() <=0)
                    <h3>No Record Found </h3>
                    @else
                <table class="table bg-light">
                    <thead class="thead-dark" style="background: green; color: white;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $key =>  $category )
                    <tr>
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ $category->category }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->status }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary category_edit"  data-id="{{ $category->id }}" title="edit"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger delete_category" data-id="{{ $category->id }}" title="delete"><i class="fa fa-trash"></i></button>
                            <button class="btn btn-sm btn-info" title="delete"><i class="fa fa-arrow-down"></i></button>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                    @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="Category_add_modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close category_modal_close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="category_title">Add Category</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.category') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="category_id">
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <input type="text" class="form-control" id="category" name="category">
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
                            <button type="submit" class="btn btn-sm btn-info" id="category_save" value="insert">Save</button>
                            <button type="button" class="btn btn-sm btn-danger category_modal_close" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    delete modal--}}

    <div class="modal fade" id="category_delete_modal_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    $('#add_category').on('click',function (event) {
       $('#Category_add_modal').modal('show');
    });

    $('.delete_category').on('click',function (event) {
        var id = $(this).data('id');
        $('#category_delete_modal_confirm').modal('show');

        $('.delete_confirm').on('click',function () {
            var btnValue = $(this).data('value');

            if (btnValue === 'yes'){
                $.ajax({
                    method: 'get',
                    url:"{{ route('category.delete') }}",
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
    $('.category_edit').on('click',function (event) {
       var id = $(this).data('id');
       $.ajax({
           method:'GET',
           url: "{{ route('edit.category') }}",
           data: { id: id},
           success:function (data) {
               console.log(data);
               var categoryInfo = $.parseJSON(data);
               $('#category_id').val(categoryInfo.id);
               $('#category').val(categoryInfo.category);
               $('#description').val(categoryInfo.description);
               $('#status').val(categoryInfo.status);
               $('#category_save').text('Update');
               $('#category_title').text('Category Update');
               $('#Category_add_modal').modal('show');
           },
           error:function (err) {
               console.log(err);
           }
       });
    });

    // close modal
    $('.category_modal_close').on('click', function () {
        $('#category_id').val('');
        $('#category').val('');
        $('#description').val('');
        $('#status').val('');
        $('#category_save').text('Save');
        $('#category_title').text('Add Category');
        return true;
    });

        // category search


        $('#category_search').on('keyup', function () {
           $search = $(this).val();
           $.ajax({
               method:'get',
               url: "{{ route('category.search') }}",
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
