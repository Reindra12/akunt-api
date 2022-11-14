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
        $transaction = Transaction::orderBy('time','DESC')->get()->map(function($trans){
            return [
                    'id' => $trans->id,
                   'title' => $trans->title,
                   'amount' => $trans->amount,
                    'time' => $trans->time,
                    'type' => $trans->type
            ];
        });
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
        $transaction =  Transaction::find($id);

        if ($transaction==null) {
            $response = [
                'status' => true,
                'message'=> "empty",
                'error' => "ID not found",
                // 'data' => $transaction
            ];
            return response()->json($response,HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }else{
            $response = [
                'status' => 'success',
                'message'=> 'Detail of Transaction resouce',
                'error' => null,
                'data' => $transaction
            ];
            return response()->json($response, HttpResponse::HTTP_OK);
        }



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
        $transaction =  Transaction::find($id);
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
                'message' => 'failed to update Transaction',
                'error'=> $error
            ];
            return response()->json($response, HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
           }


           if ($transaction==null) {
            return response()->json([
                'status' => true,
                'message' => 'failed to update Transaction',
                'error'=> 'ID not found'
            ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
           } else {
            $transaction->update($request->all());

            return response()->json([
                'status' => true,
                'message'=> 'Transaction updated',
                'error' => null,
                'data' => $transaction
            ], HttpResponse::HTTP_OK);
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
        $transaction =  Transaction::find($id);

        if ($transaction==null) {
            return response()->json([
                'status' => true,
                'message'=> 'failed to delete Transaction',
                'error' => null,
            ]);
        }else{
            $transaction->delete();
            return response()->json([
                'status' => true,
                'message'=> 'Transaction deleted',
                'error' => null,
            ], HttpResponse::HTTP_OK);

        }

    }
}
