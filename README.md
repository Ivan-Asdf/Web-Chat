# Web-Chat
Simple Web chat app made with react and php


## Running
The app runs on two servers and uses one third party service: backend, frontend, and https://pusher.com/
You need to configure these:
```
ubuntu_setup/backend.env
ubuntu_setup/frontend.env
```
Write "pusher" keys, host names(for both backend and frontend) and the JWT secret.
If you dont change ports in config all should be fine, otherwise you need to also change ports in `ubuntu_setup/nginx.conf` and in `ubuntu_setup/setup.sh`.

When done with configuration run `ubuntu_setup/setup.sh`.

