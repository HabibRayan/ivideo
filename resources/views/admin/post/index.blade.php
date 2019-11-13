@extends('admin.master')

@section('title','Post | QuranerDak')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-sm-4">
{{--                <a href="{{ route('post.form') }}" class="btn btn-sm btn-info">Add Post</a>--}}
                <input type="button" class="btn btn-info btn-sm float-left" id="add_post" value="Add Post">
            </div>
            <div class="col-sm-4 bg-light category-header">
                <div class="card">
                    <div class="card-header m-3">
                        <h3>Post Information</h3>
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

                    <table class="table bg-light">
                        <thead class="thead-dark" style="background: green; color: white;">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Subcategory</th>
                            <th scope="col">Tag</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $key => $post)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->subcategory->categories->category }}</td>
                                <td>{{ $post->subcategory->subcategory }}</td>
                                <td>{{ $post->tag }}</td>
                                <td>{{ $post->status }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary category_edit"  data-id="" title="edit"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger delete_category" data-id="" title="delete"><i class="fa fa-trash"></i></button>
                                    <button class="btn btn-sm btn-info" title="public"><i class="fa fa-check-circle"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

{{-- add modal --}}
    <div class="modal fade" id="post_add_modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close post_modal_close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="post_title">Add Post</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.post') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="post_id">

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input class="form-control" name="title" id="title">
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select class="form-control" id="category" name="category">
                                <option selected value="">--Select Category--</option>
                                @foreach($categories as  $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcategory">Subcategory:</label>
                            <select class="form-control" id="subcategory" name="subcategory">
                                <option selected value="">--Select Subcategory--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="short_description">Short Description:</label>
                            <textarea class="form-control" name="short_description" id="short_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="long_description">Long Description:</label>
                            <textarea class="form-control" name="long_description" id="long_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="video_link">Video Link:</label>
                            <input type="text" id="video_link" name="video_link" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tag">Tag:</label>
                            <input class="form-control" id="tag" name="tag">
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
                            <button type="submit" class="btn btn-sm btn-info" id="post_save" value="insert">Save</button>
                            <button type="button" class="btn btn-sm btn-danger post_modal_close" data-dismiss="modal">Close</button>
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
        $('#tag').tagsInput({
        });



        // add category
        $('#add_post').on('click',function (event) {
            $('#post_add_modal').modal('show');
        });

        $('#category').on('change', function (e) {
            var id= e.target.value;
         $.ajax({
            method:'get',
            url : "{{ route('get.category') }}",
             data : { id : id },
             success:function (data) {
                 console.log(data);
                 $('#subcategory').empty();
                 $('#subcategory').append('<option value=""  selected>--Select Subcategory--</option>');

                 $.each(data, function(index, subcategories){
                     $('#subcategory').append('<option value="'+ subcategories.id +'">'+ subcategories.subcategory +'</option>');
                 })

             },
             error:function (err) {
                console.log(err);
             }
         });
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
        $('.post_modal_close').on('click', function () {
            $('#category').val('');
            $('#subcategory').val('');
            $('#description').val('');
            $('#status').val('');
            $('#post_save').text('Save');
            $('#post_title').text('Add Post');
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
