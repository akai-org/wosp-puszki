<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *      title="CollectorRequest",
 *      description="new Collector schema",
 *      type="object",
 *      required={
 *          "collectorIdentifier",
 *          "firstName",
 *          "lastName"
 *      },
 *      @OA\Property(
 *          property="collectorIdentifier",
 *          description="Id of the collector identifier",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="firstName",
 *          description="Wolunteer first name",
 *          type="string",
 *          example="Jan"
 *      ),
 *      @OA\Property(
 *          property="lastName",
 *          description="Wolunteer last name",
 *          type="string",
 *          example="Kowalski"
 *      )
 * )
 */
class CollectorRequest extends FormRequest
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
            'collectorIdentifier' => [
                'required',
            ],
            'firstName' => [
                'required',
            ],
            'lastName' => [
                'required',
            ],
        ];
    }
}
