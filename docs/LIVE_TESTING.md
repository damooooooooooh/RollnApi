Read Only Testing
-----------------

Authenticate as Read Only
```
http --auth readonly:readonly_password -f POST http://rollnapi.com/oauth grant_type=client_credentials
```

Read all artists
```
http -f GET http://rollnapi.com/api/artist "Authorization: Bearer access_token"
```

Read all albums
```
http -f GET http://rollnapi.com/api/album "Authorization: Bearer access_token"
```

Read only your User Albums
```
http -f GET http://rollnapi.com/api/user-album "Authorization: Bearer access_token"
```

Try to add a new artist
```
echo '{"name": "Phish"}' | http -f POST http://rollnapi.com/api/artist "Content-Type: application/json" "Authorization: Bearer access_token"
```

Try to update an artist
```
echo '{"name": "Not Grateful Dead"}' | http -f PATCH http://rollnapi.com/api/artist/1 "Content-Type: application/json" "Authorization: Bearer access_token"
```

Try to add an album
```
echo '{"artist": 1, "name": "Farmhouse"}' | http -f POST http://rollnapi.com/api/album "Content-Type: application/json" "Authorization: Bearer access_token"
```

Add a User Album
```
echo '{"album": 1, "description": "Added from POST"}' | http -f POST http://rollnapi.com/api/user-album "Content-Type: application/json" "Authorization: Bearer access_token"
```

Try to update a User Album you don't own
```
echo '{"description": "Try to change unowned user-album"}' | http -f PATCH http://rollnapi.com/api/user-album/1 "Content-Type: application/json" "Authorization: Bearer access_token"
```
