![CSS](https://img.shields.io/badge/CSS-0%25-critical) ![UI](https://img.shields.io/badge/Beautiful%20UI-0%25-critical) ![Made with love](https://img.shields.io/badge/Made%20with%20-%E2%9D%A4%EF%B8%8F-success)

### ShareX ZWS Uploader
## I will probably never touch this pos again :)
Is a self-hosted ShareX upload server written in PHP.

I made this project due to there being no simple **ZWS** (Zero Width Space) uploaders for ShareX available.

#### Project Contents
- upload.php 
- dashboard.php
- logout.php
- embeds.js
- example.sxcu

#### Installation

Requirements: Web server with PHP installed (this was made with 7.4).

Steps:
- Upload the **upload.php** to your webserver.
- Edit the **$tokens** line in the **upload.php**.

(Skip these below if you don't want dashboard)

- Upload the **dashboard.php** & **logout.php**.
- Edit the **$password** line in the **dashboard.php**.
You should now be finished!

#### Embedding

Do you want embeds to work like this:

![embed](https://bad.is-on.top/󠁬󠁭󠁥󠁶󠁩󠁰󠁮󠁴󠁵󠁿󠁴󠁷󠁬󠁶󠁴󠁯󠁹󠁸󠁤󠁴)

Well then you will need to use [Cloudflare](https://cloudflare.com) for them.
Once you have your domain in Cloudflare enable the proxy like so:

![proxy](https://bad.is-on.top/󠁴󠁩󠁵󠁿󠁤󠁫󠁿󠁶󠁯󠁵󠁦󠁪󠁱󠁶󠁦󠁶󠁡󠁬󠁬󠁨)

After that go to [Cloudflare Workers](https://dash.cloudflare.com/sign-up/workers) and from there go to manage workers -> create a service -> http handler -> quick edit -> copy the contents of the **embeds.js** and edit the details const title & const color how you please. After this you press Save & Deploy. Then go back to your worker you just made -> triggers -> routes -> add route -> and add it for example like so:

![cloudflaretsku](https://bad.is-on.top/󠁥󠁨󠁵󠁡󠁸󠁸󠁵󠁬󠁯󠁴󠁢󠁱󠁿󠁰󠁸󠁬󠁧󠁤󠁤󠁬)

You probably get the idea of it.
Now you should be all set!


#### My NGINX configuration

```
server {
    listen 80;
    server_name bad.is-on.top;
    return 301 https://bad.is-on.top$request_uri;
}
server {
  listen 443;
  client_max_body_size 100M;
  server_name bad.is-on.top;
    ssl_certificate     /etc/nginx/top.cert;
    ssl_certificate_key /etc/nginx/top.key;
  root /var/www/bad;
  index index.html;
  location / {
    try_files $uri.png $uri $uri/ @mp4;
  }
  location @mp4 {
    rewrite ^(.*)$ $1.mp4 last;
  }
  
  location ~ \.php(?:$|/) {
        try_files $fastcgi_script_name =404;

        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $path_info;
        fastcgi_param HTTPS on;

        fastcgi_param modHeadersAvailable true;         
        fastcgi_param front_controller_active true;     
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;

        fastcgi_intercept_errors on;
        fastcgi_request_buffering off;

        fastcgi_max_temp_file_size 0;
  }
}
```

#### Sources
I may or may not have *cough* taken some code from places, here's a small list:
- https://github.com/ShareX/CloudflareWorkers/blob/main/DiscordEmbed.js Cloudflare Workers
- https://github.com/Inteliboi/ShareX-Custom-Upload Base uploader
- https://github.com/zws-im/tools/blob/3e7018bea8b471c417f24a89b6305fd9b6f41590/generate-env.js#L6-L32 Invisible spaces
- https://www.tutorialspoint.com/php/php_login_example.htm For shitty dashboard auth
- https://bad.is-having.fun aka me for the rest :)


#### If you have any suggestions or issues you can leave them in the github issues or just DM me in Discord. (Bad#3260)
