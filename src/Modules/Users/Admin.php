<?php
namespace MiniStore\Modules\Users;

class Admin extends User {
    public function getRole(): string {
        return "Admin";
    }
}
