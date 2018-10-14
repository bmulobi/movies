<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Repository;

class CategoriesController extends Controller
{
    use ErrorHandler;

    private $repository;
    private $categories;

    public function __construct(Categories $categories)
    {
        $this->repository = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->is(route('categories'))) {
           // return view('categories', )
        }

        try {
            $categories = Categories::all();

            return \response(['categories' => $categories], Response::HTTP_OK);
        } catch (\PDOException $e) {
            return $this->getError($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|between:5,50|unique:categories,name',
                'description' => 'required|string|between:5,200',
            ]);
        } catch(ValidationException $e) {
            return response([
                'message' => $e->getMessage(),
                'error' => $e->errors()
            ],
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $category = Categories::create($data);
            return response(['category' => $category], Response::HTTP_CREATED);

        } catch (\PDOException $e) {
            return $this->getError($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $category)
    {
        try {
            $category->delete();
            return \response(['message' => "The category was deleted successfully"], Response::HTTP_OK);

        } catch (\PDOException $e) {
            return $this->getError($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
