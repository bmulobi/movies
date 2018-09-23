<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Movies;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    use ErrorHandler;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $movies = Movies::all();
            return response(['movies' => $movies], Response::HTTP_OK);
        } catch(\PDOException $e) {
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
            $urlRules = ['required', 'url', 'between:5,100', 'regex:/[.jpg|.png]$/'];

            $data = $request->validate(
                [
                    'title' => 'required|string|between:5,100|unique:movies,title',
                    'description' => 'required|string|between:5,200',
                    'actors' => 'required|array|between:1,5',
                    'url' => $urlRules,
                    'popularity' => 'integer|min:0',
                    'category' => 'required|string|between:5,50|exists:categories,name'

                ]);
        } catch(ValidationException $e) {
            return \response(
                ["message" => 'The given data was invalid', 'error' => $e->errors()],
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $category = Categories::select('id')->whereName($data['category'])->first();
            $data['category'] = $category['id'];

            $category = Movies::create($data);

            return \response(['category' => $category], Response::HTTP_CREATED);
        } catch(\PDOException $e) {
            return $this->getError($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function show(Movies $movie)
    {
        return \response(['movie' => $movie], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function edit(Movies $movies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movies $movie)
    {
        $urlRules = ['url', 'between:5,100', 'regex:/[.jpg|.png]$/'];
        try {
            $data = $request->validate(
                [
                    'title' => 'string|between:5,100|unique:movies,title',
                    'description' => 'string|between:5,200',
                    'actors' => 'array|between:1,5',
                    'url' => $urlRules,
                    'popularity' => 'integer|min:0',
                    'category' => 'string|between:5,50|exists:categories,name'

                ]);

            if ($data['category'] ?? null) {
                $category = Categories::select('id')->whereName($data['category'])->first();
                $data['category'] = $category['id'];
            }
        } catch(ValidationException $e) {
            return \response(
                ["message" => "The given data is invalid", 'error' => $e->errors()],
                Response::HTTP_BAD_REQUEST
            );
        }

        $movie->update($data);

        return \response(['movie' => $movie], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movies $movie)
    {
        try {
            $movie->delete();
            return \response(['The movie was deleted successfully'], Response::HTTP_OK);
        } catch(\PDOException $e) {
            return $this->getError($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function getByCategory(Request $request, $categoryId) {
        try {
            $movies = Movies::whereCategory($categoryId)->get();

            return \response(['movies' => $movies], Response::HTTP_OK);
        } catch (\PDOException $e) {
            return $this->getError($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function getByActorName(Request $request, $actor) {
        try {
            $movies =
                DB::select(
                    "select * from movies where '$actor' = ANY(select * from json_array_elements_text(actors))"
                );

            return \response(['movies' => $movies], Response::HTTP_OK);
        } catch (\PDOException $e) {
            return $this->getError($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
