# Open API

List of API endpoints available for authorized apps

## Content

Project split API for two parts

- First using Swagger
- Second, providing list of free methods for ajax requests created for the purpose of the project functionality

## Technology

- Swagger [Open API](https://www.openapis.org/) standard for Laraver
    - [Laraver library](https://github.com/DarkaOnLine/L5-Swagger)
    - [GitHube for OpenAPI](https://github.com/OAI/OpenAPI-Specification)
- Ajax api

## URL

Endpoint for requests

```
http://localhost:8000/api/
```

**Note** It is possible to version the API in future changes/refactoring process by `/api/v2` (or `/api/v3`)

## Documentation

1. Interactive api for human endpoints tests:

```
http://localhost:8000/api/documentation
```

2. Regenerate api

```php
$ php artisan l5-swagger:generate
```

**Note**: This method regenerate `storage/api-docs/` files

<span style="color: red">It's required to rebuild docs after each change!!!</span>

## Modules

|    | name        | prefix | controller                                                                                |
|----|-------------|--------|-------------------------------------------------------------------------------------------|
| 1. | Charity Box |        | [CharityBoxApiController](../../app/Http/Controllers/Api/CharityBoxApiController.php)     |
| 2. | BoxEvents   |        | [LogsApiController](../../app/Http/Controllers/Api/LogsApiController.php)                 |
| 3. | Collectors  |        | [CollectorApiController](../../app/Http/Controllers/Api/CollectorApiController.php)       |
| 4. | Users       |        | [UserApIController](../../app/Http/Controllers/Api/UserApiController.php)                 |
| 5. | Stations    |        | [AvailabilityApiController](../../app/Http/Controllers/Api/AvailabilityApiController.php) |

## Models

It's list of virtual objects:

- `Models`
- `Requests`
- `Resources`

in [app/Virtual](../../app/Virtual) folder which describe structure of requests like response, request schema and
parameters via `Annotations`

These classes do not introduce any logic, they mostly map structure of entities and prepare empty objects.

## Warnings ❗❗

#### 1. Collections

<span style="color: green">Collections are not wrapped by `data` in responses!!!</span>

In Open Api documentation you can see, schema collections data are encapsulated by `data` key which is **incorrect**.

```php
/**
 * @OA\Schema(
 *   schema="BoxEvents",
 *   title="BoxEvents",
 *   @OA\Property(title="data", property="data", type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/BoxEvent"),
 *   )
 * )
 * /
```

This field is forced by `Annotation: Schema > Property` syntax, because library doesn't allow to create unnamed arrays
structure like to one below to represent json results

```php
[
    { 
     "id": 1,
     ...
    },
    {
     "id": 2,
     ...
    }
```



