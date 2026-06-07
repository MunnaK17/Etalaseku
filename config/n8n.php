<?php

return [
    /*
    |--------------------------------------------------------------------------
    | N8N Webhook URLs
    |--------------------------------------------------------------------------
    |
    | Paste your n8n webhook URLs here. These are called by the server
    | when specific events occur (e.g. new inclusive program submission).
    |
    | Find these URLs in your n8n workflow editor:
    | Workflow Settings → Webhook URL
    |
    */

    'inclusive_webhook_url' => env('N8N_INCLUSIVE_WEBHOOK_URL'),
];