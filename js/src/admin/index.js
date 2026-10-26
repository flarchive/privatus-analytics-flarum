import app from 'flarum/admin/app';

const id = 'privatus-privatus-analytics';

app.initializers.add(id, () => {
  app.extensionData
    .for(id)
    .registerSetting(function () {
      return <p className="helpText">{app.translator.trans(`${id}.admin.settings.intro`)}</p>;
    })
    .registerSetting({
      setting: 'privatus-analytics.site_id',
      type: 'text',
      label: app.translator.trans(`${id}.admin.settings.site_id_label`),
      help: app.translator.trans(`${id}.admin.settings.site_id_help`),
      placeholder: 'pa_XXXXXXXXXX',
    })
    .registerSetting({
      setting: 'privatus-analytics.skip_admins',
      type: 'boolean',
      label: app.translator.trans(`${id}.admin.settings.skip_admins_label`),
      help: app.translator.trans(`${id}.admin.settings.skip_admins_help`),
    });
});
