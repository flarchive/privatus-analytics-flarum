<?php

/*
 * This file is part of privatus/flarum-privatus-analytics.
 *
 * Copyright (c) 2026 Two Phase LLC. MIT License.
 */

namespace Privatus\FlarumAnalytics;

use Flarum\Frontend\Document;
use Flarum\Http\RequestUtil;
use Flarum\Settings\SettingsRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Prints the Privatus Analytics tracking script in the head of every forum page.
 *
 * It only adds a script tag. The visitor's browser loads the tracker and sends
 * the pageviews. Nothing is sent from the forum server.
 */
class AddTrackingScript
{
    public const SCRIPT_SRC = 'https://privatusstats.com/js/pa.js';

    /**
     * A site id is "pa_" followed by letters and digits.
     */
    public const SITE_ID_PATTERN = '/\Apa_[A-Za-z0-9]{1,64}\z/';

    public function __construct(protected SettingsRepositoryInterface $settings)
    {
    }

    public function __invoke(Document $document, ServerRequestInterface $request): void
    {
        $siteId = trim((string) $this->settings->get('privatus-analytics.site_id', ''));

        if (! preg_match(self::SITE_ID_PATTERN, $siteId)) {
            return;
        }

        if ($this->skipAdmins() && RequestUtil::getActor($request)->isAdmin()) {
            return;
        }

        $document->head[] = sprintf(
            '<script defer src="%s" data-site="%s"></script>',
            self::SCRIPT_SRC,
            htmlspecialchars($siteId, ENT_QUOTES | ENT_HTML5, 'UTF-8')
        );
    }

    protected function skipAdmins(): bool
    {
        return (bool) $this->settings->get('privatus-analytics.skip_admins', true);
    }
}
