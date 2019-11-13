<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
       return view('admin.category.index',['categories' => $categories]);
    }

    public function storeCategory(Request $request){
        $this->validate($request,[
            'category' => 'required | max:20',
            'description' => 'required',
            'status' => 'required',
        ]);

        $id = $request->input('id');
        if ($id =='') {
            Category::create([
                'category' => $request->input('category'),
                'description' => $request->input('description'),
                'status' => $request->input('status')
            ]);
        }elseif ($id != ''){
            $category = Category::find($id);
            $category->category = $request->category;
            $category->description = $request->description;
            $category->status = $request->status;
            $category->update();

        }
        return redirect()->route('admin.category');
    }

    public function editCategory(Request $request)
    {
            $categoryInfo = Category::Find($request->id);
           echo json_encode($categoryInfo);

    }

    public function deleteCategory(Request $request){


           $categoryId = Category::find($request->id);
           $categoryId->delete();

           echo "Deleted";

    }

    public function searchCategory(Request $request){

        if ($request->ajax()){
            $output="";


            $searchResults = DB::table('categories')
                ->where('category','like','%'.$request->search.'%')->get();
            if ($searchResults){
                foreach ($searchResults as $key=>$searchResult){
                    $output.= '<tr>'.
                        '<th scope="row">'. ++$key .'</th>'.
                        '<td>'. $searchResult->category .'</td>'.
                        '<td>'. $searchResult->description .'</td>'.
                        '<td>'. $searchResult->status .'</td>'.
                        '<td>'.
                            '<button class="btn btn-sm btn-primary category_edit"  data-id="{{ $category->id }}" title="edit">'.'<i class="fa fa-edit">'.'</i>'.'</button>'.
                            '<button class="btn btn-sm btn-danger delete_category" data-id="{{ $category->id }}" title="delete">'.'<i class="fa fa-trash">'.'</i>'.'</button>'.
                            '<button class="btn btn-sm btn-info" title="delete">'.'<i class="fa fa-arrow-down">'.'</i>'.'</button>'.
                        '</td>'.
                        '</tr>';
                }
                return Response($output);
            }


        }
    }
}
