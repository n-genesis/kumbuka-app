<?php

use App\Models\ActivityLogModel;

if (! function_exists('log_activity')) {
    /**
     * Quick helper to log user activity.
     *
     * @param string $description  Description of what the user did
     * @param string $category To help filter the User activity type
     * @param string $severity The Security level of the Activity
     * @param mixed $metadata JSON to stored any added information about the action
     */
    function log_activity(string $description, string $category, string $severity, $metadata = null): void
    {
        $activityModel = model(ActivityLogModel::class);
        $activityModel->logActivity( $description,  $category,  $severity, $metadata);
    }
}