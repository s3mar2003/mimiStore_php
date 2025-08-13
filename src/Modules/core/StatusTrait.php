<?php
namespace MiniStore\Modules\Core;

trait StatusTrait {
    protected string $status = 'pending';

    final public function getStatus(): string {
        return $this->status;
    }

    final public function setStatus(string $status): void {
        $this->status = $status;
    }
}
