# Zoom Sync Users Plugin for Moodle

## Overview

The `local_zoomsyncusers` plugin is a Moodle local plugin designed to synchronize users between Moodle and Zoom. This plugin ensures that user data is kept consistent across both platforms, streamlining user management for administrators.

## Features

- Synchronize Moodle users with Zoom accounts.
- Automatically create Zoom users based on Moodle user data.
- Scheduled tasks for periodic synchronization.
- Error logging for troubleshooting.

## Installation

1. Download or clone the plugin into the `local/zoomsyncusers` directory of your Moodle installation.
2. Navigate to **Site Administration > Notifications** in Moodle to complete the installation process.
3. Configure the plugin settings under **Site Administration > Plugins > Local plugins > Zoom Sync Users**.

## Requirements

- Moodle 4.1 or higher.
- mod_zoom intalled and patched as at https://github.com/yedidiaklein/moodle-mod_zoom.

## Configuration

1. Go to **Site Administration > Plugins > Local plugins > Zoom Sync Users**.
2. Enter your domain, only users with email from this domain will be synces.
3. Choose the way of creating users, autoCreate or create.
    1. Auto Create will create the users without their need to approve - it will only work if your zoom license allows it. (probably enterprise account)
    2. Create will send an approvement email to each created user.

## Usage

- The plugin will automatically synchronize users based on the configured schedule.
- You can manually trigger synchronization via the scheduled tasks interface in Moodle.

## Support

For issues or feature requests, please visit the [plugin repository](https://github.com/yedidiaklein/moodle-local_zoomsyncusers).

## License

This plugin is licensed under the [GNU GPL v3](https://www.gnu.org/licenses/gpl-3.0.html).