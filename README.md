# Privatus Analytics for Flarum

**Real visitor numbers for your Flarum forum. No cookies, no cookie pop-up, no bots.**

You want to know if people visit your Flarum forum. But Google Analytics uses
cookies, so in many countries you must show a cookie pop-up first (the box that
asks visitors to say yes to cookies). Many people click no, so they never show
up in your numbers. Bots add fake visits on top.

This extension adds the Privatus Analytics script to every page of your forum.
You paste your site id once in the admin panel. Logged-in admins are not
counted, unless you turn that off. The script sets no cookies and keeps no IP
addresses. Bots are filtered out before they are counted.

So you see how many real people came, which pages they looked at and where they
came from, on one simple dashboard. A report comes to your inbox each week, and
you can set alerts for when traffic jumps or drops. And you don't need a cookie
pop-up for your analytics.

**Free plan, no card:** 10,000 events a month (an event is a page view or an action you track) on up to 3 sites. [Start free at privatusanalytics.com](https://privatusanalytics.com).

- **No cookies.** No cookies and no hidden IDs on your visitors' devices, and no IP
  addresses are kept. Laws differ by country, so check your own legal advice.
- **Real people, not bots.** Known bots, data centers and spam visits are left
  out on every plan.
- **Small and fast.** The script is about 3 KB when compressed.

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
