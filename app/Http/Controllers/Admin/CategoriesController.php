<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\Mawhob;
use App\Models\Teacher_Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.categories');
        return view('admin.categories.index', compact('title'));
    }
    ////////////////////////////////////////
    /// Get Categories
    public function getCategories(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }
        $list = Category::orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = CategoryResource::collection($list);
        $recordsTotal = Category::get()->count();
        $recordsFiltered = Category::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    /////////////////////////////////////////
    /// Get All Categories
    public function getAllCategories()
    {
        $categories = Category::get();
        return $this->returnData('OK', 'data', $categories);
    }

    ////////////////////////////////////////////
    /// create Category
    public function create()
    {
        $title = trans('menu.add_new_category');
        return view('admin.categories.create', compact('title'));
    }
    /////////////////////////////////////////////
    /// store Category
    public function store(CategoryRequest $request)
    {
        try {
            if ($request->has('icon')) {
                $icon_path = $request->file('icon')->store('Categories');
            } else {
                $icon_path = '';
            }

            if (setting()->site_lang_en == 'on') {
                Category::create([
                    'icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'field' => $request->field,
                    'language' => 'ar_en',
                ]);
            } else {
                Category::create([
                    'icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'description_ar' => $request->description_ar,
                    'description_en' => null,
                    'field' => $request->field,
                    'language' => 'ar',
                ]);
            }

            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }
    /////////////////////////////////////////
    /// edit Category
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.not.found');
        }
        $title = trans('categories.update_category');
        return view('admin.categories.update', compact('title', 'category'));
    }
    ////////////////////////////////////////////
    /// update Category
    public function update(CategoryUpdateRequest $request)
    {
        try {
            $category = Category::find($request->id);

            if ($request->hasFile('icon')) {
                if (!empty($category->icon)) {
                    Storage::delete($category->icon);
                    $icon_path = $request->file('icon')->store('Categories');
                } else {
                    $icon_path = $request->file('icon')->store('Categories');
                }
            } else {
                if (!empty($category->icon)) {
                    $icon_path = $category->icon;
                } else {
                    $icon_path = '';
                }
            }

            if (setting()->site_lang_en == 'on') {
                $category->update([
                    'icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'field' => $request->field,
                    'language' => 'ar_en',
                ]);
            } else {
                $category->update([
                    'icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'description_ar' => $request->description_ar,
                    'description_en' => null,
                    'field' => $request->field,
                    'language' => 'ar',
                ]);
            }
            return $this->returnSuccessMessage(trans('general.update_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Category destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $category = Category::find($request->id);
                if (!$category) {
                    return redirect()->route('admin.not.found');
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Courses
                $courses = Course::where('category_id', $request->id)->get();
                if (!$courses->isEmpty()) {
                    return $this->returnError([trans('categories.cannot_be_deleted_because_it_have_courses')], 500);
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Teacher Categories
                $teacherCategory = Teacher_Category::where('category_id', $request->id)->get();
                if (!$teacherCategory->isEmpty()) {
                    return $this->returnError([trans('categories.cannot_be_deleted_because_it_have_teacher_category')], 500);
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Categories
                $mawhobs = Mawhob::where('category_id', $request->id)->get();
                if (!$mawhobs->isEmpty()) {
                    return $this->returnError([trans('categories.cannot_be_deleted_because_it_have_mawhob')], 500);
                }



                $category->delete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ///////////////////////////////////////////////////////////////
    /// get All Category Name
    public function getAllCategoryName(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table("categories")
                ->select("id", "name_ar")
                ->where('name_ar', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }
}


