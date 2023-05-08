<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

/**
 * @author kabix09
 *
 * @OA\Tag(
 *     name="Currency",
 *     description="API Endpoints for currencies and rates"
 * )
 **/
final class CountedBoxApiController extends ApiController
{
    public function __construct()
    {
        $this->middleware('admin');

        parent::__construct(CharityBox::class);
    }
}
