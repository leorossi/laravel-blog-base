# LaraVue Exercise

## Install & Run

```
$ git clone $THISREPO

$ cd laramind-laravue
$ git clone https://github.com/laradock/laradock
$ cd laradock
$ .env                                              // Edit your project info
$ docker-compose up -d nginx mysql workspace        // Start containers 
$ docker-compose exec workspace bash                // Attach to workspace container

# composer install
# php artisan migrate --seed
# phpunit                                           // Run test suite, everything should be green. 
                                                    // Remember to define a DB_DATABASE_TEST variable in your .env file and
                                                    // Create such database, and give the standard user all grants to it. 
 
```

You are ready to launch your project!

## Seed data

From within your workspace container

```
# php artisan users:generate 10 editor                    // Generates 10 editor users
# php artisan users:generate 10 reader                    // Generates 10 reader users
# php artisan posts:generate 50                           // Generates 50 posts
```

## API

### API Authentication

All requests to `/api/...` endpoints must be authenticated. 

Every user has an `api_token` field, that should be sent in a query parameter `&api_token=YOUR_TOKEN`

### API Documentation

#### Create Post

```
POST /api/posts
Params:
    title: string
    body: string
```

#### Delete Post

```
DELETE /api/posts/POST_ID
```

#### Update Post

```
PUT /api/posts/POST_ID
Params:
    title: string|optional
    body: string|optional   
```

#### Get Post list
```
GET /api/posts
```

#### Get user's post list
```
GET /api/users/USER_ID/posts
```

#### Create Comment

```
POST /api/posts/POST_ID/comments
Params:
    body: string
```

#### Delete Comment

```
DELETE /api/comments/COMMENT_ID
```

#### Update Comment

```
PUT /api/comments/COMMENT_ID
Params:
    body: string   
```

#### Get Post Comments
```
GET /api/posts/POST_ID/comments
```

There are policies so that only who created post/comment can delete that resource, otherwise a 403 error will be returned.

