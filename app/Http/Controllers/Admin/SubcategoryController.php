<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function subcategory(){
        $subCategories = Subcategory::all();
        $categories = Category::all();
        return view('Admin.sub_category.index',['subCategories'=>$subCategories,'categories' => $categories]);
    }

    public function storeSubcategory(Request $request){
        $this->validate($request,[
            'subcategory' => 'required | max:20',
            'category_id' => 'required | max:20',
            'description' => 'required',
            'status' => 'required',
        ]);

        $id = $request->input('id');
        if ($id =='') {
            Subcategory::create([
                'subcategory' => $request->input('subcategory'),
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
                'status' => $request->input('status')
            ]);
        }elseif ($id != ''){
            $subcategory = Subcategory::find($id);
            $subcategory->subcategory = $request->subcategory;
            $subcategory->category_id = $request->category_id;
            $subcategory->description = $request->description;
            $subcategory->status = $request->status;
            $subcategory->update();

        }
        return redirect()->route('admin.subcategory');
    }

    public function editSubcategory(Request $request){
        $subcategoryInfo = Subcategory::Find($request->id);
        echo json_encode($subcategoryInfo);
    }

    public function deleteSubcategory(Request $request){
        $subcategory = Subcategory::find($request->id);

        $subcategory->delete();

        echo "Deleted";
    }
    public function searchSubCategory(Request $request){
        if ($request->ajax()){
            $output="";

            $searchResults = DB::table('subcategories')
                ->join('categories','categories.id','=','subcategories.category_id')
                ->select('subcategories.*','categories.category')
                ->where('subcategory','like','%'.$request->search.'%')
                ->orWhere('category','like','%'.$request->search.'%')
                ->get();

            if ($searchResults){
                foreach ($searchResults as $key=>$searchResult){
                    $output.= '<tr>'.
                        '<th scope="row">'. ++$key .'</th>'.
                        '<td>'. $searchResult->subcategory .'</td>'.
                        '<td>'. $searchResult->category.'</td>'.
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
