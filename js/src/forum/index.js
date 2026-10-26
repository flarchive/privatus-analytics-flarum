import app from 'flarum/forum/app';

// The tracking script is added to the page by the server (see extend.php), so
// the forum needs no code of its own. The tracker follows Flarum's page changes
// by itself, because it watches the browser history.
app.initializers.add('privatus-privatus-analytics', () => {});
