<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\JsonApi\V1\Domains\DomainSchema;
use App\Models\Domain;
use Illuminate\Contracts\Support\Responsable;
use LaravelJsonApi\Core\Responses\DataResponse;
use LaravelJsonApi\Laravel\Http\Controllers\Actions;

class DomainController extends Controller
{

    use Actions\FetchMany;
    use Actions\FetchOne;
    use Actions\Store;
    use Actions\Update;
    use Actions\Destroy;
    use Actions\FetchRelated;
    use Actions\FetchRelationship;
    use Actions\UpdateRelationship;
    use Actions\AttachRelationship;
    use Actions\DetachRelationship;

    public function token(DomainSchema $schema, Domain $domain, $resource)
    {
        $this->authorize('createToken', $domain);
        $domain->tokens()->delete();
        $token = $domain->createToken('domain_token',['domain_token']);
        $domain->withAccessToken($token->plainTextToken);
        return new DataResponse($domain);
    }

}
