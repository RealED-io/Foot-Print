# Carbon Footprint Tracker

---

## Setup

### Apache Config must be configured

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
