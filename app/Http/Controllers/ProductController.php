<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;

class ProductController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $sortBy = $request->query('sort_by', 'updated_at.desc');
        $sorts = explode('.', $sortBy);


        return response()
            ->json(
                Product::orderBy($sorts[0], $sorts[1])->get()
            );
    }

    public function search(Request $request)
    {
        # code...
        $query = $request->query('query');

        if (empty($query)) {
            return response()->json(['error' => 'Query not specified!'], 400);
        }

        $fulltext = $request->query('fulltext', 'false');
        $sortBy = $request->query('sort_by', 'name.asc');
        $sorts = explode('.', $sortBy);


        if ($fulltext == 'true') {
            $data = Product::query()
                ->whereRaw("MATCH(name,description) AGAINST(? IN BOOLEAN MODE)", array($query))
                ->orderBy($sorts[0], $sorts[1])
                ->get();
            return response()->json($data);
        }

        $data = Product::query()
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->orderBy($sorts[0], $sorts[1])
            ->get();

        return response()->json($data);
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
        //
        if ($request->expectsJson()) {
            return response()->json(['error' => 'only JSON allowed!'], 402);
        }

        $this->validate($request, [
            'name' => 'required|unique:products|max:50|min:5',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'measure' => 'required|max:8',
        ]);

        if ($request->has('picture')) {
            $product = Product::query()->create(
                [
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'stock' => $request->input('stock'),
                    'measure' => $request->input('measure'),
                    'picture' => $request->input('picture')
                ]
            );
        } else {
            $product = Product::query()->create(
                [
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'stock' => $request->input('stock'),
                    'measure' => $request->input('measure')
                ]
            );
        }

        if (empty($product)) {
            return response()->json(['error' => 'unknown error'], 501);
        }

        return response()->json([
            'message' => 'Product create success!',
            'code' => 201,
            'data' => $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::query()->find($id);
        if (empty($product)) {
            return response()->json(['error' => 'Product not found'], 402);
        }

        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request->expectsJson()) {
            return response()->json(['error' => 'only JSON allowed!'], 402);
        }

        $this->validate($request, [
            'name' => 'required|unique:products|max:50|min:5',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'measure' => 'required|max:8',
        ]);

        if ($request->has('picture')) {
            $update = Product::query()->find($id)->update(
                [
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'stock' => $request->input('stock'),
                    'measure' => $request->input('measure'),
                    'picture' => $request->input('picture')
                ]
            );
        } else {
            $update = Product::query()->find($id)->update(
                [
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'stock' => $request->input('stock'),
                    'measure' => $request->input('measure')
                ]
            );
        }

        if (!$update) {
            return response()->json(['error' => 'unknown error'], 500);
        }



        return response()->json([
            'message' => 'Product updated!',
            'code' => 200
        ]);
    }

    public function delete($id)
    {
        # code...
        $product = Product::query()->find($id)->first();
        if (empty($product)) {
            return response()->json(['error' => 'Product not found!'], 404);
        }

        if (!$product->delete()) {
            return response()->json(['error' => 'Unknown Error'], 500);
        }

        return response()->json([
            'message' => 'Product deleted! (soft)',
            'code' => 200
        ]);
    }

    public function restore($id)
    {
        # code...
        $product = Product::withTrashed()->find($id);
        if (empty($product)) {
            return response()->json(['error' => 'Product not found!'], 404);
        }

        if (!$product->restore()) {
            return response()->json(['error' => 'unknown error'], 500);
        }

        return response()->json([
            'message' => 'Product restored!',
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::withTrashed()->find($id);
        if (empty($product)) {
            $notSoftDeleted = Product::query()->find($id);

            if (empty($notSoftDeleted)) {
                return response()->json(['error' => 'Product not found!'], 404);
            }

            if (!$notSoftDeleted->forceDelete()) {
                return response()->json(['error' => 'Unknown Error'], 500);
            }

            return response()->json([
                'message' => 'Product deleted! (permanent)',
                'code' => 200
            ]);
        }

        if (!$product->forceDelete()) {
            return response()->json(['error' => 'Unknown Error'], 500);
        }

        return response()->json([
            'message' => 'Product deleted! (permanent)',
            'code' => 200
        ]);
    }
}
