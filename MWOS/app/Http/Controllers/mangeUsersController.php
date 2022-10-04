<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class mangeUsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
                if($search!=""){
                    $Users =  DB::table('users')
                    ->where([
                        ['role','1'],
                        [DB::raw("CONCAT(id,' ',Fname,' ',Lname,' ',email ,' ',phoneNumber)"),'LIKE','%'.$search.'%']
                    ])
                    ->orWhere([
                        ['role','3'],
                        [DB::raw("CONCAT(id,' ',Fname,' ',Lname,' ',email ,' ',phoneNumber)"),'LIKE','%'.$search.'%']
                    ])
                   
                    ->paginate(4);
            $Users->appends(['search' => $search]);
            $count = $Users->total();
            if($count == 0)
            return view('admin.mangeUsers')->with(['Users' => $Users,'NoFound' => 'There is no result 😔']);
            else
            return view('admin.mangeUsers')->with(['Users' => $Users,'found' => $count.' records founded']);
             

            
        }
        else{
            $Users =  DB::table('users')
            ->where('role','3')
            ->orWhere('role','1')
            ->paginate(4); 
            return view('admin.mangeUsers',compact('Users'));
        }
      
    }
}
