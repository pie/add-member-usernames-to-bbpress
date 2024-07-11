# BBPress: Append user nicenames (@names) to author link on forum posts

This is a very small plugin to extend the BBPress plugin and add the users @name (user_nicename) to the author name output on forum posts

## Steps to get up and running:

1. Download the zip of the latest release from https://github.com/pie/bbpress-add-member-usernames/releases
1. Upload to your WordPress install
1. Activate

## Contributing:

1. Create a branch from `next-release` for your feature
1. When complete and happy, merge your feature branch back in to `next-release`

## Deploying updates:

This plugin is set up to work with integrated WordPress updates through the use of
[yahnis-elsts/plugin-update-checker](https://github.com/YahnisElsts/plugin-update-checker) and 
[rymndhng/release-on-push-action](https://github.com/rymndhng/release-on-push-action)

In order to deploy an update:

1. Thoroughly test the `next-release` branch in your test environment
1. Create a pull request to merge the `next-release` branch into `main` and add the appropriate label:
    * `release:major`
    * `release:minor`
    * `release:patch`
1. When merged, the `release.yml` workflow will update all of your version numbers and commit them back into main and create a github release artifact: `bbpress-add-member-usernames.zip`
1. Updates should then show in wp-admin for any users of the plugin
