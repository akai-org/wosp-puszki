<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="UserRequest",
 *      description="new User schema",
 *      type="object",
 *      required={
 *          "userName",
 *          "password",
 *          "role"
 *      },
 *      @OA\Property(
 *          property="userName",
 *          description="User name",
 *          type="string",
 *          example="Jan"
 *      ),
 *      @OA\Property(
 *          property="password",
 *          description="User password",
 *          type="string",
 *          example="qwerty123"
 *      ),
 *     @OA\Property(
 *          property="password_confirmation",
 *          description="User password the same as previous property",
 *          type="string",
 *          example="qwerty123"
 *      ),
 *      @OA\Property(
 *          property="role",
 *          description="User role",
 *          format="string",
 *          enum={"volounteer", "admin", "superadmin"},
 *          example="volounteer"
 *      )
 * )
 */
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //abort_if(Gate::denies('admin') || Gate::denies('superadmin'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'userName' => 'required|alpha_num|between:1,255|unique:users,name',
            'password' => 'required|confirmed|between:1,255',
            'role' => 'required|in:volounteer,admin,superadmin',
        ];
    }
}
