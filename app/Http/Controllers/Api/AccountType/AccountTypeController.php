<?php

namespace App\Http\Controllers\Api\AccountType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountType;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\DDList\AccountTypeDDList;

class AccountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $rules = [
        'account_type' => 'required'];

    public function index()
    {
        $account_type = AccountType::all();
        return $this->showAll($account_type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $account_type = AccountType::create(
            $request->all(),
        );
        return $this->showOne($account_type, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AccountType $account_type)
    {
        return $this->showOne($account_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountType $account_type)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $account_type->fill($request->all());
        if ($account_type->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $account_type->save();
        return $this->showOne($account_type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountType $account_type)
    {
        $account_type->delete();
        return $this->showOne($account_type);
    }

    public function getDDList()
    {
        $account_type = AccountTypeDDList::collection(AccountType::all());
        return $account_type;
    }
}

