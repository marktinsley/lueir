# For Host File Permissions

https://medium.com/@nielssj/docker-volumes-and-file-system-permissions-772c1aee23ca

In short,

Set group ownership of the directory to be used as volume to some GID (in this example 1024) not used on any actual groups on the host

```bash
chown :1024 /data/myvolume
```

Change permissions on the directory to give full access to members of the group (read+write+execute)

```bash
chmod 775 /data/myvolume
```

Ensure all future content in the folder will inherit group ownership

```bash
chmod g+s /data/myvolume
```

