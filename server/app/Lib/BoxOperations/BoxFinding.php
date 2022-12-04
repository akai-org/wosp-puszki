<?php

namespace App\Lib\BoxOperations;

use App\BoxEvent;
use App\CharityBox;
use App\Collector;
use App\Lib\BoxOperations\Validators\BoxAddingCooldownValidator;
use App\Lib\BoxOperations\Validators\CollectorExistenceValidator;
use App\Lib\BoxOperations\Validators\ValidationContext;
use App\Lib\BoxOperations\Validators\Validator;
use Auth;
use Carbon\Carbon;

class BoxFinding implements BoxOperation
{
    private int $collectorId;
    private BoxOperationResult $result;
    private int $userId;

    public function __construct(int $collectorId, int $userId)
    {
        $this->collectorId = $collectorId;
        $this->userId = $userId;
        $this->result = new BoxOperationResult(BoxOperationResult::NO_EXECUTION);
    }

    public function proceed(): void
    {
        $this->validate();
        if($this->result()->kind() == BoxOperationResult::KIND_ERROR) {
            return;
        }

        $this->result = new BoxOperationResult(BoxOperationResult::NO_EXECUTION,
            'Not implemented');
    }

    public function result(): BoxOperationResult
    {
        return $this->result;
    }

    private function validate(): void
    {
        /** @var Validator[] $validatorChain */
        $validatorChain = [
            new CollectorExistenceValidator(),
        ];
        foreach ($validatorChain as $index=>$validator) {
            if ($index+1 != sizeof($validatorChain)) {
                $validator->setNext($validatorChain[$index+1]);
            }
        }

        $context = new ValidationContext($this->collectorId);
        $validation = $validatorChain[0]->validate($context);
        if ($validation->failed()) {
            $this->result = new BoxOperationResult(BoxOperationResult::KIND_ERROR, $validation->errorMessage());
        }
    }
}
