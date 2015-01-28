Read Only Testing
-----------------

Authenticate as Read Only
```
http --auth readonly:readonly_password -f POST http://localhost:8083/oauth grant_type=client_credentials
```

Read all artists
```
http -f GET http://localhost:8083/api/artist "Authorization: Bearer access_token"
```

Read all albums
```
http -f GET http://localhost:8083/api/album "Authorization: Bearer access_token"
```

Read only your User Albums
```
http -f GET http://localhost:8083/api/user-album "Authorization: Bearer access_token"
```

Try to add a new artist
```
echo '{"name": "Phish"}' | http -f POST http://localhost:8083/api/artist "Content-Type: application/json" "Authorization: Bearer access_token"
```

Try to update an artist
```
echo '{"name": "Not Grateful Dead"}' | http -f PATCH http://localhost:8083/api/artist/1 "Content-Type: application/json" "Authorization: Bearer access_token"
```

Try to add an album
```
echo '{"artist": 1, "name": "Farmhouse"}' | http -f POST http://localhost:8083/api/album "Content-Type: application/json" "Authorization: Bearer access_token"
```

Add a User Album
```
echo '{"album": 1, "description": "Added from POST"}' | http -f POST http://localhost:8083/api/user-album "Content-Type: application/json" "Authorization: Bearer access_token"
```

Try to update a User Album you don't own
```
echo '{"description": "Try to change unowned user-album"}' | http -f PATCH http://localhost:8083/api/user-album/1 "Content-Type: application/json" "Authorization: Bearer access_token"
```

Full Access Testing
-------------------

Authenticate as Root
```
http --auth root:root_password -f POST http://localhost:8083/oauth grant_type=client_credentials
```

Add a new Artist
```
echo '{"name": "Phish"}' | http -f POST http://localhost:8083/api/artist "Content-Type: application/json" "Authorization: Bearer access_token"
```

Add a new Album
```
echo '{"artist": 2, "name": "The Farmhouse"}' | http -f POST http://localhost:8083/api/album "Content-Type: application/json" "Authorization: Bearer access_token"
```

Update the new Album
```
echo '{"name": "Farmhouse"}' | http -f PATCH http://localhost:8083/api/album/7 "Content-Type: application/json" "Authorization: Bearer access_token"
```
