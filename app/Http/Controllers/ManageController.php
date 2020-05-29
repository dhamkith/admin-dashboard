<?php

namespace App\Http\Controllers;
 
use App\User;
use App\Role; 
use Validator;
use App\Permission;
use Illuminate\Http\Request;
use App\Traits\FunctionsTrait;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class ManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'DESC')
                ->paginate(12); 
        return view('manage.users.all-users', compact('users'));
    }
    
    /**
     * get userEdit view
     *
     * @return \Illuminate\Http\Response
     */
    public function userEdit($id) {
        
        $user = User::find($id);
        $roles = Role::all();
        if (is_null($user)) {
            return redirect()->route('manage.all.users');        
        } else {
            return view('manage.users.user', compact('user', 'roles'));
        }
    }

     /**
     * Display a listing of the userSearch.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function userSearch(Request $request) {

        $field = $request->field;

        $search = $request->search;

        if( $search !== null) {
            
             $users = User::where($field,'LIKE',"%$search%")->latest()->paginate(12);

             $pagination = $users->appends ( array (
                'search' => $request->search,
                'field' => $request->field
            ) );

            if (count ( $users ) > 0){
                return view('manage.users.search.users', compact('users', 'search' ));
            } else {
                return view('manage.users.search.users', compact('users'))->withMessage ( 'No Details found . Try to search again !' );
            }

        } else {
            return view('manage.users.search.users')->withMessage ( 'No Details found. Try to search again !' );
        }
    } 
    /**
     * get online user lists.
     *
     *  @return \Illuminate\Http\Response
     */
    public function getOnlineUsers(Request $request)
    {  
        $users = User::all();
        $online_user_ids = \array_values(FunctionsTrait::getOnlineUserIds($users));
        //$users_online = User::find($online_user_ids);
        /*
        * LengthAwarePaginator
        * $music_ids=array of ids, $per_page, $id = user_id = null, $playlist_id
        */
        $per_page = 12;
        $users_online = FunctionsTrait::customPaginate($online_user_ids, $per_page, null, $request, 'App\User');
        return view('manage.users.search.users-online', compact('users_online'));
    }

     /**
     * Update.
     *
     * @param  \Illuminate\Http\Request  $request $id
     * @return \Illuminate\Http\Response
     */
    public function userUpdate(Request $request, $id)
    { 
        $this->validate($request, [
            'name'  => 'required|max:255'
        ]); 

        $user = User::find($id);

        $user->name = escape_route($request->name);

        $banned = $request->suspend ? $request->banned_until : null; 

        if ($banned !== null):
            $now = time();
            $request_date = date_timestamp_get(\DateTime::createFromFormat('Y-m-d', $banned));
            if ($now > $request_date):
                return redirect()->back()->with('error', 'error: select date');
            endif;
            $user->banned_until = $banned;
        else:
            $user->banned_until = $banned;
        endif;

        if ( $request->password_options == 'auto' ){
            $lenght = 10;
            $keyspace = '123456789abcdefghijkmnopqtsuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ';
            $str = "";
            $max = mb_strlen($keyspace, '8bit')-1;
            for( $i = 0; $i < $lenght; ++$i ){
                $str .= $keyspace[random_int(0, $max )];
            }

            $user->password =  bcrypt($str);
            
        } elseif( $request->password_options == 'manual'){

            $user->password = bcrypt($request->password);
        }

        $user->save();

        if ( $request->roles ){
            $user->roles()->detach();
            foreach ( $request->roles as $role ):
                $user->roles()->attach(Role::find($role));
            endforeach;
        }

        if ($user->save()) {
            return redirect('/manage/users')->with('success', 'Users Updated');
        } else {
            Session::flash('danger', 'Sorry a problem occurred while Updating this user.');
            return redirect()->route('user.create');
        }
    }
    
    /**
    * user login ip api.
    * userLoginips
    *  
    */
   public function userLoginIps(Request $request, $id)
   {
       $user = User::find($id);
       if( $user ) {
           $hold = [];
           $datas = json_decode( $user->last_login_ip, true);
           if($datas) { 
               $datas = \array_reverse($datas); 
               foreach ($datas as $data) {
                   $split = preg_split("/[\-]+/", $data); 
                   $date = Carbon::createFromTimestamp($split[1]);
                   $date = $date->toDayDateTimeString();
                   $hold[] = (object)array('ip'=>$split[0],'time'=>$date);
               }
               return response()->json($hold);
           } else {
               $hold[] = (object)array('ip'=>' ','time'=>'User logger data empty');
               return response()->json($hold);
           }

       }
   }
    /**
     * Delete.
     *
     * @return tags names
     */
    public function userDelete(Request $request)
    { 
        $users_ids = explode(',', $request->users);
        if ($users_ids) {
            foreach ($users_ids as $id) {
                if ($id) {
                    if( $request->action === 'activate') {
                        User::where('id', $id)->update(['banned_until' => null ]);
                    } elseif ( $request->action === 'suspend') {
                        $suspend = Carbon::now()->addYears(10);  
                        User::where('id', $id)->update(['banned_until' => $suspend ]); 
                    } 
                } else {
                    return redirect()->back()->with('error', 'atleast select one user ...');
                }
            } 
            return redirect('/manage/users')->with('success', 'selected users '.$request->action.' succesfuly');
        } 

      
    }

    /**
     * Show the roles in Admin dashboad .
     *
     * @return \Illuminate\Http\Response
     */
    public function roles()
    {   
        $roles = Role::all();
        return view('manage.roles.roles', compact('roles'));
    }

    /**
     * get all the roles.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function rloeEdit($id) {

        $role = Role::find($id);
        $permissions = Permission::all();
        return view('manage.roles.role-edit', compact('role', 'permissions'));
    }
    
     /**
     * Store a newly created Role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rolesStore(Request $request) 
    {
        
        $validator = Validator::make($request->all(),[
            'name'  => 'required',
            'slug'  => 'required',
        ]);

        $lowercase = strtolower($request->slug);
        //$slug = str_slug( $lowercase, "_" );
        $slug = preg_replace('/\s+/', '_', $lowercase);
        
        if( $validator->fails() ) {
            $response = array( 'response' => $validator->messages(), 'validator' => false );
            return $response;
        } else {
 
            $role = new Role; 
            $role->name = escape_route($request->name);
            $role->slug = escape_route($slug);
            $role->save();

            if ( $role->save() ) {
                $response = array( 'validator' => true, 'success' => 'role created succesfuly' );
                return response()->json($response);
            } 

        }
    }

    /**
     * role Update
     *
     * @param  \Illuminate\Http\Request  $request $id
     * @return \Illuminate\Http\Response
     */
    public function rolesUpdate (Request $request, $id) 
    {
        $this->validate($request, [
            'name'  => 'required|max:255'
        ]);

        $role = Role::find($id);
        $role->name = escape_route($request->name);
        $role->save();

        if ( $request->permissions ){
            $role->permissions()->detach();
            foreach ( $request->permissions as $permission ):
                $role->permissions()->attach(Permission::where('slug',$permission)->first());
            endforeach;
        } else {
            $role->permissions()->detach();
        }

        return redirect()->back()->with('success', 'role Update');
    }

    /**
     * Show the permissions in Admin dashboad .
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions()
    {   
        $permissions = Permission::all();
        return view('manage.permissions.permissions', compact('permissions'));
    }

    /**
    * get all the roles.
    *
    * @return \Illuminate\Http\Response
    */
    public function permissionEdit($id) {

        $permission = Permission::find($id);
        return view('manage.permissions.permission-edit', compact('permission'));
    }

     /**
     * permission Store.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function permissionStore(Request $request) 
    {        
        $validator = Validator::make($request->all(),[
            'name'  => 'required',
            'slug'  => 'required',
        ]);
        
        $lowercase = strtolower($request->slug);
        $slug = preg_replace('/\s+/', '_', $lowercase);

        if( $validator->fails() ) {
            $response = array( 'response' => $validator->messages(), 'validator' => false );
            return $response;
        } else {
        
            $permission = new Permission; 
            $permission->name = escape_route($request->name);
            $permission->slug = escape_route($slug);
            $permission->save();

            if ( $permission->save() ) {
                $response = array( 'validator' => true, 'success' => 'permission created succesfuly' );
                return response()->json($response);
            } 

        }

    }
    /**
     * permission Update
     *
     *  
     * @param  \Illuminate\Http\Request  $request $id
     * @return \Illuminate\Http\Response
     */
    public function permissionUpdate (Request $request, $id) 
    {
        $this->validate($request, [
            'name'  => 'required|max:255'
        ]);

        $permission = Permission::find($id);    
        $permission->name = escape_route( $request->name);
        $permission->save();

        return redirect()->back()->with('success', 'Permission Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissionDestroy($id)
    {
        
        if ( auth('admin')->check()) { 

            $default_permissions = config('default_role_permissions')['permissions'];
            $permission = Permission::find($id);

            if (array_key_exists($permission->slug, $default_permissions)) {
                return redirect()->back()->with('error', 'app default permissions');
            } else {
                $permission->delete();
                return redirect()->back()->with('success', 'permission delete succesfuly');
            }

        } else {

            return redirect()->back()->with('error', 'Unauthorized');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roleDestroy($id)
    {
        
        if ( auth('admin')->check()) { 

            $default_role =  config('default_role_permissions')['roles'];
            $role = Role::find($id);

            if (array_key_exists($role->slug, $default_role)) {
                return redirect()->back()->with('error', 'app default roles');
            } else {
                $role->delete();
                return redirect()->back()->with('success', 'role delete succesfuly');
            }

        } else {

            return redirect()->back()->with('error', 'Unauthorized');
        }
        
    }
}
