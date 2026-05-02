# Carbon Footprint Tracker

---

## Setup

### Apache Config must be configured (for XAMPP deployment)

Apache `httpd.conf` must **AllowOverride All** (from AllowOverride None)
excerpt from `httpd.conf`
```
#
# Deny access to the entirety of your server's filesystem. You must
# explicitly permit access to web content directories in other 
# <Directory> blocks below.
#
<Directory />
    AllowOverride All
    Require all denied
</Directory
```

---

## Setup for Docker deployment

`docker compose -p foot-print up -d --build`

---

### NOTE
The URI pattern will change for docker deployment 
due to `ENV APACHE_DOCUMENT_ROOT=/var/www/html/public`,
the URI would be `http://localhost:8080/dashboard` for docker deployment,
while `http://localhost/foot-print/public/dashboard` for XAMPP