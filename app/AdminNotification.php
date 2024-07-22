<?php

namespace App\Notifications;

use App\Models\AdminAlert; // Assuming you have an AdminAlert model

class AdminNotification {
    public static function notifyNewRegistration($user) {
        // Create a new alert
        $alert = new AdminAlert();
        $alert->message = "New registration pending approval: {$user->name}";
        $alert->user_id = $user->id; // Associate the alert with the user
        $alert->save();

        // Additional logic (like sending an email) can be added here
    }
}
