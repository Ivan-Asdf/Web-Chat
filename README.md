# Web-Chat
Simple Web chat app made with react and php
![Screenshot from 2021-08-11 23-10-35](https://user-images.githubusercontent.com/57415060/129098012-2f11aa8a-0046-4f46-a793-838f241048d0.png)

## Currently running instance
http://34.139.100.117/

For demo purposes, the database is deleted every hour.

**NOTE:** To register succesfully you need to provide a profile pic.
![image](https://user-images.githubusercontent.com/57415060/129198205-c777391f-92bd-4734-95d5-3ed50fa53985.png)


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

