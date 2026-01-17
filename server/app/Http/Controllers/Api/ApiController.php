<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use ReflectionClass;
use ReflectionException;

/**
 * @author kabix09
 * Class to declare common CRUD functions for API requests
 *
 * @OA\Info(
 *      version="3.0.0",
 *      title="WOSP API Documentation",
 *      description="WOSP API in Swagger OpenApi description",
 *
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 *
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="WOSP API Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="basic"
 * )
 *
 * @link https://blog.quickadminpanel.com/laravel-api-documentation-with-openapiswagger/
 * @link https://github.com/DarkaOnLine/L5-Swagger/issues/318
 */
abstract class ApiController extends Controller
{
    // @phpstan-ignore property.onlyWritten
    private ReflectionClass $proxyClass;

    /**
     * @throws ReflectionException
     */
    public function __construct(string $class)
    {
        $this->proxyClass = new ReflectionClass($class);
    }
}
