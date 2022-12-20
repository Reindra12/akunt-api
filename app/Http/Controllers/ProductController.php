<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = Product::all();

            return response()->json([
                'success' => true,
                'message' => 'List Data Product',
                'error' => null,
                'data' => $products
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Server Sedang Error',
                'error' => $th->getMessage(),
                'data' => null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Valid',
                'error' => $validator->errors()->first(),
                'data' => null
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Product Berhasil Ditambahkan',
                'error' => null,
                'data' => $product
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Server Sedang Error',
                'error' => $th->getMessage(),
                'data' => null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Product',
                'error' => null,
                'data' => $product
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Server Sedang Error',
                'error' => $th->getMessage(),
                'data' => null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
        $product = Product::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Terdapat data yang tidak valid',
                'error' => $validator->errors()->first()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $product->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Update Data Product',
                'error' => null,
                'data' => $product
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "Terjadi kesalahan pada server",
                'error' => $th->getMessage(),
                'data' => null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        try {
            $product->delete();

            return response()->json([
                'success' => true,
                'message' =>  'Berhasil Menghapus Data',
                'error' => null
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terdapat kesalahan pada server',
                'error' => $th->getMessage(),
                'data' => null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
