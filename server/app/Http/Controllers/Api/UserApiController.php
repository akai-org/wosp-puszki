<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Collector;
use App\Http\Requests\Api\CollectorRequest;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\Api\CharityBoxResource;
use App\Http\Resources\Api\CollectorResource;
use App\Http\Resources\Api\UserResource;
use App\Lib\BoxOperator\BoxOperator;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OpenApi\Annotations as OA;
use Response;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *   schema="Users",
 *   title="Users",
 *   @OA\Property(title="data", property="data", type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/User"),
 *   )
 * )
 *
 * @OA\Tag(
 *     name="Users",
 *     description="API Endpoints for Users (volunters but other than collectors)"
 * )
 **/
final class UserApiController extends ApiController
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @OA\Get(
     *  path="/api/users",
     *  operationId="getUsersList",
     *  tags={"Users"},
     *  summary="Get list of Users",
     *  description="Returns list of Users",
     *  @OA\Response(
     *     response=200, description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Users")
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * Display a listing of Collectors
     * @return UserResource
     */
    public function index()
    {
        return new UserResource(User::with('roles')->get());
    }

    /**
     * @OA\Get(
     *  path="/api/users/{id}",
     *  operationId="getUserById",
     *  tags={"Users"},
     *  summary="Get user information",
     *  description="Returns user data",
     *  @OA\Parameter(
     *     name="id",
     *     description="User id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="integer",
     *         example="1"
     *     )
     *  ),
     *  @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/User")
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * Display User data
     * @return UserResource
     **/
    public function show(int $id)
    {
        return new UserResource(User::query()
            ->with('roles')
            ->find($id)
        );
    }

    /**
     * @OA\Post(
     *  path="/api/users",
     *  operationId="postUser",
     *  tags={"Users"},
     *  summary="Insert a new User",
     *  description="Insert a new User",
     *  @OA\RequestBody(
     *     description="User to create",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/UserRequest")
     *  ),
     *  @OA\Response(
     *     response="201",
     *     description="User created",
     *     @OA\JsonContent(ref="#/components/schemas/User"),
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     *  @OA\Response(response=422, description="Validation exception"),
     * )
     *
     * @param UserRequest $request
     * @return UserResource
     */
    public function create(UserRequest $request)
    {
        $request->validate([
            'userName' => 'required|alpha_num|between:1,255|unique:users,name',
            'password' => 'required|between:1,255',
            'role' => 'required|in:volounteer,admin,superadmin'
        ]);

        $user = new User();
        $user->name = $request->input('userName');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        $role = Role::where('name', '=', $request->input('role'))->first();
        $user->roles()->attach($role);

        Log::info(Auth::user()->name . " utworzył/a użytkownika: " . $user->name);

        return new UserResource($user);

    }
}
