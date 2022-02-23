# Catalog REST API on Lumen

## Endpoints
- [Creators](#creators)
- [Genres](#genres)
- [Statuses](#statuses)
- [Titles](#titles)
- [Chapters](#chapters)
- [Pages](#pages)

# Creators
- [Creators: Get](#creators-get)
- [Creators: Post](#creators-post)
- [Creators: Update](#creators-update)
- [Creators: Delete](#creators-delete)

## Creators: Get

## All
<summary>Request</summary>

`/api/creators`

    curl GET 'localhost:8000/api/creators'


<details>
<summary>Response</summary>

```json
    {
        "current_page": 1,
        "data": [
            {
                "id":1,
                "name": "Noe Kuhlman",
                "info": "information about creator",
                "type": "author",
                "created_at": "",
                "updated_at": "",
            },
            ...
        ],
        "first_page_url": "http://localhost:8000/api/creators?page=1",
        "from": 1,
        "last_page": 5,
        "last_page_url": "http://localhost:8000/api/creators?page=5",
        "next_page_url": "http://localhost:8000/api/creators?page=2",
        "path": "http://localhost:8000/api/creators",
        "per_page": 10,
        "prev_page_url": null,
        "to": 10,
        "total": 45
    }
```
</details>


## Specific creator

<summary>Request</summary>

`/api/creators/{name}`

    curl GET 'localhost:8000/api/creators/{name}

<details>
<summary>Response</summary>

```json
    {
        "id": "1",
        "name": "Noe Kuhlman",
        "info": "information about creator",
        "type": "author",
        "created_at": "2022-02-21T14:48:50.000000Z",
        "updated_at": "2022-02-21T14:48:50.000000Z"
    }
```
</details>

## Creators: Create

<summary>Request</summary>

`/api/creators`

    curl POST 'localhost:8000/api/creators'

```json
    {
        "name": "Yamamoto Souchirou",
        "info": "Souichirou Yamamoto is a Japanese manga artist.",
        "type": "artist"
    }
```

<details>
<summary>Response</summary>

```json
    {
        "name": "Yamamoto Souchirou",
        "info": "Souichirou Yamamoto is a Japanese manga artist.",
        "type": "artist",
        "updated_at": "2022-02-23T13:26:33.000000Z",
        "created_at": "2022-02-23T13:26:33.000000Z",
        "id": 2
    }
```
</details>

## Creators: Update

<summary>Request</summary>

`api/creators/{id}`

    curl PUT 'localhost:8000/api/creators/2

```json
    {
        "name": "GEE So-Lyung",
        "info": "Author of popular manhva 'Solo Leveling'",
        "type": "author"
    }
```

<details>
<summary>Response</summary>

```json
    {
        "id": 2,
        "name": "GEE So-Lyung",
        "infor": "Author of popular manhva 'Solo Leveling'",
        "type": "author",
        "created_at": "2022-02-23T13:26:33.000000Z",
        "updated_at": "2022-02-23T13:35:01.000000Z"
    }
```
</details>

## Creators: Delete

<summary>Request</summary>

`api/creators/{id}`

    curl DELETE 'localhost:8000/api/creators/2'


<summary>Response</summary>

    HTTP/1.1 204 No Content
    Date: Tue, 23 Feb 2022 13:36:35 GMT
    Status: 204 No Content
    Content-Type: application/json

```json
    Deleted successfully
```

# Genres
- [Genres: Get](#genress-get)
- [Genres: Post](#genress-post)
- [Genres: Update](#genress-update)
- [Genres: Delete](#genress-delete)

## Genres: Get

## All

<summary>Request</summary>

`api/genres`

    curl GET 'localhost:8000/api/genres'

<details>
<summary>Response</details>

```json
    [
        {
            "id": 1,
            "name": "drama",
            "created_at": "2022-02-21T14:48:54.000000Z",
            "updated_at": "2022-02-21T14:48:54.000000Z"
        },
        {
            "id": 2,
            "name": "adventure",
            "created_at": "2022-02-21T14:48:54.000000Z",
            "updated_at": "2022-02-21T14:48:54.000000Z"
        },
        ...
    ]
```
</details>

## Specific genre

<summary>Request</summary>

`api/genres/{id}` or `api/genres/{name}`

    curl GET 'localhost:8000/api/genres/1'

<summary>Response</summary>

```json
    {
        "id": 1,
        "name": "drama",
        "created_at": "2022-02-21T14:48:54.000000Z",
        "updated_at": "2022-02-21T14:48:54.000000Z"
    }
```

## Genres: Create

<summary>Request</summary>

`api/genres`

    curl POST 'localhost:8000/api/genres'

```json
    {
        "name": "seinen"
    }
```

<summary>Response</summary>

```json
    {
        "name": "seinen",
        "updated_at": "2022-02-23T15:04:49.000000Z",
        "created_at": "2022-02-23T15:04:49.000000Z",
        "id": 3
    }
```

## Genres: Update

<summary>Request</summary>

`api/genres/{id}`

    curl PUT 'localhost:8000/api/genres/1'

```json
    {
        "name": "action"
    }
```

<summary>Response</summary>

```json
    {
        "id": 1,
        "name": "action",
        "created_at": "2022-02-21T14:48:54.000000Z",
        "updated_at": "2022-02-23T15:09:13.000000Z"
    }
```

## Genres: Delete
<summary>Request</summary>

`api/genres/{id}`

    curl DELETE 'localhost:8000/api/genres/3'

<summary>Response</summary>

    HTTP/1.1 204 No Content
    Date: Tue, 23 Feb 2022 15:10:05 GMT
    Status: 204 No Content
    Content-Type: application/json

```json
    Deleted sucessfully
```

