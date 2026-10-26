<?php

/*
 * This file is part of privatus/flarum-privatus-analytics.
 *
 * Copyright (c) 2026 Two Phase LLC. MIT License.
 */

namespace Privatus\FlarumAnalytics;

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->content(AddTrackingScript::class),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Settings())
        ->default('privatus-analytics.site_id', '')
        ->default('privatus-analytics.skip_admins', true),
];
