<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Permission;
use Auth;
use Entrust;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function createUser()
    {
        // ======== create user ==========
        // $owner = new Role();
        // $owner->name = 'owner';
        // $owner->display_name = 'Project Owner'; // optional
        // $owner->description = 'User is the owner of a given project'; // optional
        // $owner->save();

        // $admin = new Role();
        // $admin->name = 'admin';
        // $admin->display_name = 'User Administrator'; // optional
        // $admin->description = 'User is allowed to manage and edit other users'; // optional
        // $admin->save();

        // ======== attachRole for user =========
        // $user = User::where('name', '=', 'admin2')->first();
        // $role_admin = Role::where('name', '=', 'admin')->first();
        // role attach alias
        // $user->attachRole($role_admin); // parameter can be an Role object, array, or id

        // ======= attachPermission for Role
        // $createPost = new Permission();
        // $createPost->name = 'create-post';
        // $createPost->display_name = 'Create Posts'; // optional
        // // Allow a user to...
        // $createPost->description = 'create new blog posts'; // optional
        // $createPost->save();

        // $editUser = new Permission();
        // $editUser->name = 'edit-user';
        // $editUser->display_name = 'Edit Users'; // optional
        // // Allow a user to...
        // $editUser->description = 'edit existing users'; // optional
        // $editUser->save();

        // $role_admin = Role::where('name', '=', 'admin')->first();
        // $role_admin->attachPermission($createPost);
        // // equivalent to $admin->perms()->sync(array($createPost->id));

        // $role_owner = Role::where('name', '=', 'owner')->first();
        // $role_owner->attachPermissions(array($createPost, $editUser));
        // // equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));

        // ============ check role and permission
        // $user = User::where('name', '=', 'admin')->first();

        // $user->hasRole('owner');   // false
        // // or
        // $user->hasRole('admin');   // true
        // $user->can('edit-user');   // false
        // $user->can('create-post'); // true

        // $user->hasRole(['owner', 'admin']);       // true
        // $user->can(['edit-user', 'create-post']); // true

        // $user->hasRole(['owner', 'admin']);             // true
        // $user->hasRole(['owner', 'admin'], true);       // false, user does not have admin role
        // $user->can(['edit-user', 'create-post']);       // true
        // $user->can(['edit-user', 'create-post'], true); // false, user does not have edit-user permission

        // Entrust::hasRole('role-name');
        // Entrust::can('permission-name');
        // // is identical to
        // Auth::user()->hasRole('role-name');
        // Auth::user()->can('permission-name');

        // match any admin permission
        // dd($user->can("admin.*")); // true
        // match any permission about users
        // dd($user->can("*_users")); // true

        // Loc ra nhung nguoi co Role admin, ...
        // $admins = User::withRole('admin')->get();

        // ========== nang cao ========
        // $user->ability(array('admin', 'owner'), array('create-post', 'edit-user')); //true

        // Entrust::ability('admin,owner', 'create-post,edit-user');
        // or
        // Auth::user()->ability('admin,owner', 'create-post,edit-user');

        // ========== Blade templates ==========

        // @role('admin')
        //     <p>This is visible to users with the admin role. Gets translated to
        //     \Entrust::role('admin')</p>
        // @endrole

        // @permission('manage-admins')
        //     <p>This is visible to users with the given permissions. Gets translated to
        //     \Entrust::can('manage-admins'). The @can directive is already taken by core
        //     laravel authorization package, hence the @permission directive instead.</p>
        // @endpermission

        // @ability('admin,owner', 'create-post,edit-user')
        //     <p>This is visible to users with the given abilities. Gets translated to
        //     \Entrust::ability('admin,owner', 'create-post,edit-user')</p>
        // @endability

        // =========== Route middleware =========
        // Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
        //     Route::get('/', 'AdminController@welcome');
        //     Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
        // });

        // 'middleware' => ['role:admin|root'] // OR
        // 'middleware' => ['role:owner', 'role:writer'] // AND
        // 'middleware' => ['ability:admin|owner,create-post|edit-user,true'] // ability

        // only users with roles that have the 'manage_posts' permission will be able to access any route within admin/post
        // Entrust::routeNeedsPermission('admin/post*', 'create-post');

        // // only owners will have access to routes within admin/advanced
        // Entrust::routeNeedsRole('admin/advanced*', 'owner');

        // // optionally the second parameter can be an array of permissions or roles
        // // user would need to match all roles or permissions for that route
        // Entrust::routeNeedsPermission('admin/post*', array('create-post', 'edit-comment'));
        // Entrust::routeNeedsRole('admin/advanced*', array('owner','writer'));
        // Entrust::routeNeedsRole('admin/advanced*', 'owner', Redirect::to('/home'));

        // // if a user has 'create-post', 'edit-comment', or both they will have access
        // Entrust::routeNeedsPermission('admin/post*', array('create-post', 'edit-comment'), null, false);

        // // if a user is a member of 'owner', 'writer', or both they will have access
        // Entrust::routeNeedsRole('admin/advanced*', array('owner','writer'), null, false);

        // // if a user is a member of 'owner', 'writer', or both, or user has 'create-post', 'edit-comment' they will have access
        // // if the 4th parameter is true then the user must be a member of Role and must have Permission
        // Entrust::routeNeedsRoleOrPermission(
        //     'admin/advanced*',
        //     array('owner', 'writer'),
        //     array('create-post', 'edit-comment'),
        //     null,
        //     false
        // );

        // =========== Route filter ==========

        // Route::filter('manage_posts', function()
        // {
        //     // check the current user
        //     if (!Entrust::can('create-post')) {
        //         return Redirect::to('admin');
        //     }
        // });

        // // only users with roles that have the 'manage_posts' permission will be able to access any admin/post route
        // Route::when('admin/post*', 'manage_posts');
        // Using a filter to check for a role:

        // Route::filter('owner_role', function()
        // {
        //     // check the current user
        //     if (!Entrust::hasRole('Owner')) {
        //         App::abort(403);
        //     }
        // });

        // // only owners will have access to routes within admin/advanced
        // Route::when('admin/advanced*', 'owner_role');

    }
}
