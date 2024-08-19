<?php

namespace Merijn\Pegasus\AppFacade\Action;

use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;

class ActionBuilder
{
    private Collection|null $who;
    private string $hotel;
    private ActionEnum $action;

    public function do(ActionEnum $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function who(Collection $collection): self
    {
        $this->who = $collection;

        return $this;
    }

    public function where(string $hotel): self
    {
        $this->hotel = $hotel;
        return $this;
    }

    #[ArrayShape(["Illuminate\\Support\\Collection", "string", "Merijn\\Pegasus\\ActionEnum"])]
    public function build(): array
    {
        return [
            $this->who ?? throw BuildFailed::noBotsDefined(),
            $this->hotel ?? throw BuildFailed::noHotelDefined(),
            $this->action ?? throw BuildFailed::noActionDefined()
        ];
    }
}