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

class BoxAdding implements BoxOperation
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

        // nice to have: osobne klasy repozytorium/query na rzeczy związane z bazą albo chociaż
        // wywalenie wywołań statycznych metod i zastąpienie ich wstrzykiwaniem builderów przez DI.
        // Jeżeli zdecydujemy się na klasy repo/query to można przy okazji zaimplementować jakieś
        // cachowanie - collector jest pobierany kilka razy w tej metodzie, przez walidatory a potem tutaj.
        $collector = Collector::where('identifier', '=', $this->collectorId)->first();

        $box = new CharityBox();
        $box->collectorIdentifier = trim($this->collectorId);
        $box->collector_id = $collector->id;
        $box->is_given_to_collector = true;
        $box->given_to_collector_user_id = $this->userId;
        $box->time_given = Carbon::now();
        $box->save();

        // czy możemy załadować zapisywanie eventów do osobnej klasy? Albo użyć event dispatchera laravela?
        $event = new BoxEvent();
        $event->type = 'give';
        $event->box_id = $box->id;
        $event->user_id = $this->userId;
        $event->comment = 'Collector: ' . $collector->display;
        $event->save();

        $this->result = new BoxOperationResult(BoxOperationResult::KIND_MESSAGE,
            'Wydano puszkę wolontariuszowi ' .
            $collector->display . $box->display_id);
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
            new BoxAddingCooldownValidator()
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
