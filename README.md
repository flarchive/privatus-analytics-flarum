# Privatus Analytics for Flarum

**See how many people visit your Flarum forum, which pages they read and where
they came from. No cookies, honest numbers, and a dashboard you understand in
seconds.**

## The problem

You run a forum and want to know if it is growing. Most analytics tools make
that hard. Google Analytics is slow, confusing and sends what your visitors do
to Google. In many countries it also means showing a cookie pop-up (the box
that asks visitors to accept cookies). Many people click "reject", so you never
see them. Bots fill up the numbers that are left.

## The solution

Privatus Analytics counts visits to your forum without cookies and never
stores IP addresses. Bots are filtered out before they are counted. This
extension adds the small Privatus Analytics script to every page of your
forum. You paste your site id once in the admin panel and you are done.

## What you get

- **A dashboard you understand in seconds.** Visitors, top discussions and
  where people came from, all on one screen.
- **No cookie pop-up needed for our analytics.** We set no cookies and store
  no personal data. Laws differ by country, so check your own legal advice.
- **Honest numbers.** Known bots and fake traffic are left out on every plan.
- **A fast forum.** The tracking script is about 3 KB and loads after your page.
- **Your own visits left out.** Logged in admins are not counted, unless you
  turn that off.
- **Data you own.** We never sell it or show you ads, and you can pull it out
  any time through the API.

**Start free.** The Free plan has 10,000 events a month and 3 sites, with no
card. Every new account also gets 14 days of Pro free, with no card.
[Create your account](https://privatusanalytics.com).

## Requirements

- Flarum 1.8 (`flarum/core` ^1.8).
- A Privatus Analytics site id. It starts with `pa_`. You find it in Privatus
  Analytics under Site settings, Tracking.

## Install

In your forum folder, run:

```sh
composer require privatus/flarum-privatus-analytics
php flarum cache:clear
```

Then open your admin panel, find **Privatus Analytics** under Features and
switch it on.

## Set it up

On the extension's page in the admin panel:

| Setting | What it does |
|---|---|
| **Site id** | Your Privatus Analytics site id, like `pa_7Q2K9XH3AB`. Leave it empty to turn tracking off. |
| **Do not count admins** | On by default. Forum admins who are logged in do not get the script, so your own visits stay out of your reports. |

Click **Save Changes**. Every forum page now has this in its `<head>`:

```html
<script defer src="https://privatusstats.com/js/pa.js" data-site="pa_7Q2K9XH3AB"></script>
```

Flarum changes pages without a full reload. The tracker sees those page
changes by itself, so every discussion you open is counted.

The admin panel never gets the script. A site id that does not look like
`pa_` followed by letters and digits prints nothing.

## Update

```sh
composer update privatus/flarum-privatus-analytics
php flarum cache:clear
```

## Remove

Switch the extension off in the admin panel, then run:

```sh
composer remove privatus/flarum-privatus-analytics
```

## Privacy

The extension only adds a script tag. Your visitors' browsers send the page
views to Privatus Analytics. Your forum server sends nothing. The script sets
no cookies and stores nothing in the browser. See the
[privacy documentation](https://privatusanalytics.com/docs/privacy) for what
is collected.

If you have a privacy policy, it should say which tools handle your visitors'
data. You can paste this:

> This website uses [Privatus Analytics](https://privatusanalytics.com/privacy-analytics)
> to count visits. It does not use cookies and does not follow you from one
> website to another. Your IP address is used for a moment to count visits and
> is never stored.

## More options

The tracker has more options, like extra modules, paths to leave out and page
masks. They are explained in the
[script attributes reference](https://privatusanalytics.com/docs/tracker/attributes).
This extension keeps things simple and prints the standard script only.

## Development

The JavaScript lives in `js/src` and is built into `js/dist`, which is
committed, as Flarum expects:

```sh
cd js
npm ci
npm run build
```

`test/` holds a throwaway Flarum 1.8 forum in Docker for trying the
extension:

```sh
cd test
docker compose -p patestflarum up -d --build
# open http://localhost:8089, log in as admin / testpassword123
docker compose -p patestflarum down -v
```

## Contributing

Bug reports and pull requests are welcome at
https://github.com/Privatus-Analytics/flarum.

## License

MIT. See [LICENSE](LICENSE). Privatus Analytics is a product of Two Phase LLC,
Wyoming, USA.
