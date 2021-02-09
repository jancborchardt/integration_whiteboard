# Whiteboard integration into Nextcloud

🖵 Whiteboard integration into Nextcloud, powered by Spacedeck.

# Install

This app will work on 64 bits GNU/Linux servers.

It is required to enable local remote servers requests. Add (or edit) this line in `nextcloud/config/config.php`:
```
'allow_local_remote_servers' => '1',
```

Spacedeck has a few optional requirements to be able to convert media files:
* `graphicsmagick` to convert images
* `ffmpeg` to convert audio and video files
* `ghostscript` for pdf import

# Features

* Drawing
    * Draw lines and shapes
    * Add images, audio files, videos files and PDFs
    * Create zones
    * Presenter mode (others follow your movements)
    * Show participants mouse cursors
* Sharing
    * Share to a Talk room
    * Share to users
    * Share via public links
