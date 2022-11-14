<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::orderBy('time','DESC')->get();
        $response = [
            'status'=> 'success',
            'message' => 'List transaction order by time',
            'error' => null,
            'data' => $transaction
        ];

        return response()->json($response, HttpResponse::HTTP_OK);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
        'title' => ['required'],
        'amount'=>['required', 'numeric'],
        'type' => ['required', 'in:expense,revenue']
       ]);

       if ($validator->fails()) {
        $error = $validator->errors()->first();

        $response = [
            'status' => "Failed",
            'message' => 'Fail Created Transaction',
            'error'=> $error
        ];
        return response()->json($response, HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
       }


       try {
        $transaction = Transaction::create($request->all());
        $response = [
            'status' => 'success',
            'message'=> 'OK!',
            'error' => null,
            'data' => $transaction
        ];

        return response()->json($response, HttpResponse::HTTP_ACCEPTED);
       } catch (QueryException $e) {
        return response()->json([
            'status' => "Failed",
            'message' => 'Fail Created Transaction',
            'error'=> $e->errorInfo
        ]);

       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction =  Transaction::findOrFail($id);
        $response = [
            'status' => 'success',
            'message'=> 'Detail of Transaction resouce',
            'error' => null,
            'data' => $transaction
        ];
        return response()->json($response, HttpResponse::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction =  Transaction::findOrFail($id);
        // return $request->all();
        $validator = Validator::make($request->all(),[
            'title' => ['required'],
            'amount'=>['required', 'numeric'],
            'type' => ['required', 'in:expense,revenue']
           ]);

           if ($validator->fails()) {
            $error = $validator->errors()->first();

            $response = [
                'status' => true,
                'message' => 'Fail Created Transaction',
                'error'=> $error
            ];
            return response()->json($response, HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
           }

           try {
            $transaction->update($request->all());
            $response = [
                'status' => true,
                'message'=> 'Transaction updated',
                'error' => null,
                'data' => $transaction
            ];

            return response()->json($response, HttpResponse::HTTP_OK);
           } catch (QueryException $e) {
            return response()->json([
                'status' => true,
                'message' => 'Failed updating Transaction',
                'error'=> $e->errorInfo
            ]);

           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction =  Transaction::findOrFail($id);

           try {
            $transaction->delete();
            $response = [
                'status' => true,
                'message'=> 'Transaction deleted',
                'error' => null,
            ];

            return response()->json($response, HttpResponse::HTTP_OK);
           } catch (QueryException $e) {
            return response()->json([
                'status' => true,
                'message'=> $transaction,
                'error' => null,
            ]);

           }
    }
}
