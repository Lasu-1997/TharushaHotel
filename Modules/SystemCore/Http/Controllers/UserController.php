<?php

namespace Modules\SystemCore\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters(['name','email'])
            ->allowedSorts(['created_at'])
            ->get();
        return view('systemcore::users.index', compact('users'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
