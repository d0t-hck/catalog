# Catalog REST API on Lumen

## Endpoints
- [Creators](#creators)
- [Genres](#genres)
- [Statuses](#statuses)
- [Titles](#titles)
- [Chapters](#chapters)
- [Pages](#pages)

# Creators
- [Creator: Get](#creator-get)
- [Creator: Post](#creator-post)
- [Creator: Put](#creator-put)
- [Creator: Delete](#creator-delete)


## _*creator*_: GET

---
## _*All*_
<summary>Request</summary>

`/api/creator`

    curl GET 'localhost:8000/api/creator'


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
        "first_page_url": "http://localhost:8000/api/creator?page=1",
        "from": 1,
        "last_page": 5,
        "last_page_url": "http://localhost:8000/api/creator?page=5",
        "next_page_url": "http://localhost:8000/api/creator?page=2",
        "path": "http://localhost:8000/api/creator",
        "per_page": 10,
        "prev_page_url": null,
        "to": 10,
        "total": 45
    }
```
</details>

---
## Specific _*creator*_

<summary>Request</summary>

`/api/creator/{name}`

    curl GET 'localhost:8000/api/creator/{name}

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

---
## _*creator*_: POST

<summary>Request</summary>

`/api/creator`

    curl POST 'localhost:8000/api/creator'

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

---
## _*creator*_: PUT

<summary>Request</summary>

`api/creator/{id}`

    curl PUT 'localhost:8000/api/creator/2

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

---
## _*creator*_: DELETE

<summary>Request</summary>

`api/creator/{id}`

    curl DELETE 'localhost:8000/api/creator/2'


<summary>Response</summary>

    HTTP/1.1 204 No Content
    Date: Tue, 23 Feb 2022 13:36:35 GMT
    Status: 204 No Content
    Content-Type: application/json

# Genres
- [Genre: Get](#genre-get)
- [Genre: Post](#genre-post)
- [Genre: Put](#genre-put)
- [Genre: Delete](#genre-delete)

## _*genre*_: GET

---
## All

<summary>Request</summary>

`api/genre`

    curl GET 'localhost:8000/api/genre'

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

---
## Specific _*genre*_

<summary>Request</summary>

`api/genre/{id}` or `api/genre/{name}`

    curl GET 'localhost:8000/api/genre/1'

<summary>Response</summary>

```json
    {
        "id": 1,
        "name": "drama",
        "created_at": "2022-02-21T14:48:54.000000Z",
        "updated_at": "2022-02-21T14:48:54.000000Z"
    }
```

---
## _*genre*_: POST

<summary>Request</summary>

`api/genre`

    curl POST 'localhost:8000/api/genre'

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

---
## _*genre*_: PUT

<summary>Request</summary>

`api/genre/{id}`

    curl PUT 'localhost:8000/api/genre/1'

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

---
## _*genre*_: DELETE
<summary>Request</summary>

`api/genre/{id}`

    curl DELETE 'localhost:8000/api/genre/3'

<summary>Response</summary>

    HTTP/1.1 204 No Content
    Date: Tue, 23 Feb 2022 15:10:05 GMT
    Status: 204 No Content
    Content-Type: application/json

# Statuses
- [Status: Get](#status-get)
- [Status: Post](#status-post)
- [Status: Put](#status-put)
- [Status: Delete](#status-delete)

## _*status*_: GET

## *All*

<summary>Request</summary>

`api/status`

    curl GET 'localhost:8000/api/status'

<details>
<summary>Response</summary>

```json
    [
        {
            "id": 1,
            "code": 2,
            "name": "Ongoing",
            "created_at": "2022-02-21T14:49:54.000000Z",
            "updated_at": "2022-02-21T14:49:54.000000Z"
        },
        {
            "id": 2,
            "code": 3,
            "name": "Completed",
            "created_at": "2022-02-21T14:50:14.000000Z",
            "updated_at": "2022-02-21T14:50:14.000000Z"
        },
    ]
```
</details>

---

## Specific _*status*_

<summary>Request</summary>

`api/status/{code}`

    curl GET 'localhost:8000/api/status/3'

<summary>Response</summary>

```json
    {
        "id": 2,
        "code": 3,
        "name": "Completed",
        "created_at": "2022-02-21T14:50:14.000000Z",
        "updated_at": "2022-02-21T14:50:14.000000Z"
    }
```
---
## _*status*_: POST

<summary>Request</summary>

`api/status`

    curl POST 'localhost:8000/api/status'

```json
    {
        "code": 1,
        "name": "Announced"
    }
```

<summary>Response</summary>

```json
    {
        "code": 1,
        "name": "Announced",
        "created_at": "2022-02-21T14:55:04.000000Z",
        "updated_at": "2022-02-21T14:55:04.000000Z",
        "id": 3
    }
```

---
## _*status*_: PUT

<summary>Request</summary>

`api/status/{code})`

    curl PUT 'localhost:8000/api/status/1

```json
    {
        "name": "Suspended"
    }
```

<summary>Response</summary>

```json
    {
        "id": 3,
        "code": 1,
        "name": "Suspended",
        "created_at": "2022-02-21T14:55:04.000000Z",
        "updated_at": "2022-02-21T14:58:24.000000Z"
    }
```

---
## _*status*_: DELETE

<summary>Request</summary>

`api/status/{code}`

    curl DELETE 'localhost:8000/api/status/1'

<summary>Response</summary>

    HTTP/1.1 204 No Content
    Date: Tue, 23 Feb 2022 13:36:35 GMT
    Status: 204 No Content
    Content-Type: application/json

# Titles

- [Title: Get](#title-get)
- [Title: Post](#title-post)
- [Title: Put](#title-put)
- [Title: Delete](#title-delete)

## _*title*_: GET

## *All*

<summary>Request</summary>

`api/title`

    curl GET 'localhost:8000/api/title'

<details>
<summary>Response</summary>

```json
    [
        {
            "id": 1,
            "name": "Ao Ashi",
            "release_year": 2017,
            "status_code": 2,
            "description": "Ashito Aoi is a young, aspiring soccer player from a backwater town in Japan. His hopes of getting into a high school with a good soccer club are dashed when he causes an incident during a critical match for his team, which results in their loss and elimination from the tournament.",
            "author_id": 5,
            "artist_id": 15,
            "publisher_id": 28,
            "normalized_name": "ao_ashi"
        },
    ]
```
</details>

## Specific _*title*_

<summary>Request</summary>

`api/title/{id}`

    curl GET 'localhost:8000/api/title/1'

<details>
<summary>Response</summary>

```json
    {
        "id": 1,
        "name": "Ao Ashi",
        "release_year": 2017,
        "status_code": 2,
        "description": "Ashito Aoi is a young, aspiring soccer player from a backwater town in Japan. His hopes of getting into a high school with a good soccer club are dashed when he causes an incident during a critical match for his team, which results in their loss and elimination from the tournament.",
        "author_id": 5,
        "artist_id": 15,
        "publisher_id": 28,
        "normalized_name": "ao_ashi"
    }
```
</details>

---
## _*title*_: POST

<summary>Request</summary>

`api/title`

    curl POST 'localhost:8000/api/title'

```json
    {
        "name": "Kuroko no Basket",
        "status_code":1,
        "description": "Manga abou basketball player Kuroko",
        "author_id": 1,
        "artist_id": 13,
        "publisher_id": 25,
        "genres": [1,2]
    }
```

<details>
<summary>Response</summary>

```json
    {
        "name": "Kuroko no Basket",
        "status_code":1,
        "description": "Manga abou basketball player Kuroko",
        "author_id": 1,
        "artist_id": 13,
        "publisher_id": 25,
        "normalized_name": "kuroko_no_basket",
        "id": 2
    }
```
</details>

---
## _*title*_: PUT

<summary>Request</summary>

`api/title/{id}`

    curl PUT 'localhost:8000/api/title/2'

```json
    {
        "name": "Akira",
        "description": "Set in a dystopian 2019, Akira tells the story of Shotaro Kaneda, a leader of a biker gang",
        "author_id": 7
    }
```

<details>
<summary>Response</summary>

```json
    {
        "id": 2,
        "name": "Akira",
        "status_code":1,
        "description": "Set in a dystopian 2019, Akira tells the story of Shotaro Kaneda, a leader of a biker gang",
        "author_id": 7,
        "artist_id": 13,
        "publisher_id": 25,
        "normalized_name": "akira",
    }
```
</details>

---
## _*title*_: DELETE

<summary>Request</summary>

`api/title/{id}`

    curl DELETE 'localhost:8000/api/title/2'

<summary>Response</summary>

    HTTP/1.1 204 No Content
    Date: Tue, 23 Feb 2022 15:10:05 GMT
    Status: 204 No Content
    Content-Type: application/json

# Chapter

- [Chapter: Get](#chapter-get)
- [Chapter: Post](#chapter-post)
- [Chapter: Put](#chapter-put)
- [Chapter: Delete](#chapter-delete)

## _*chapter*_: GET

## _*All*_
<summary>Request</summary>

`api/chapter'

    curl GET 'localhost:8000/api/chapter'

<details>
<summary>Response</summary>

```json
    [
        {
            "id": 1,
            "num": 1,
            "name": "Kuroko",
            "title_id": 2
        },
        {
            "id": 2,
            "num": 2,
            "name": "",
            "title_id": 2
        }
    ]
```
</details>

---
## Specific _*chapter*_

<summary>Request</summary>

`api/chapter/{id}`

    curl GET 'localhost:8000/api/chapter/1'

<details>
<summary>Response</summary>

```json
    {
        "id": 1,
        "num": 1,
        "name": "Kuroko",
        "title_id": 2
    }
```
</details>

---
## _*chapter*_: POST

<summary>Request</summary>

`api/chapter`

    curl POST 'localhost:8000/api/chapter'

```json
    {
        "num": 1,
        "name": "First Touch",
        "title_id": 1,
    }
```

<details>
<summary>Response</summary>

```json
    {
        "num": 1,
        "name": "First Touch",
        "title_id": 1,
        "id": 3
    }
```
</details>

---
## _*chapter*_: PUT

<summary>Request</summary>

`api/chapter/{id}

    curl PUT 'localhost:8000/api/chapter/3'

```json
    {
        "num": 2,
        "name": "Tokyo Esperion"
    }
```

<details>
<summary>Response</summary>

```json
    {
        "id": 3,
        "num": 2,
        "name": "Tokyo Esperion",
        "title_id": 1,
    }
```
</details>

---
## _*chapter*_: DELETE

<summary>Request</summary>

`api/chapter/{id}`

    curl DELETE 'localhost:8000/api/3'

<summary>Response</summary>

    HTTP/1.1 204 No Content
    Date: Tue, 23 Feb 2022 13:36:35 GMT
    Status: 204 No Content
    Content-Type: application/json

# Page

- [Page: Get](#page-get)
- [Page: Post](#page-post)
- [Page: Put](#page-put)
- [Page: Delete](#page-delete)

## _*page*_: GET
## _*All*_
<summary>Request</summary>

`api/page'

    curl GET 'localhost:8000/api/page'

<details>
<summary>Response</summary>

```json
    [
        {
            "id": 1,
            "page": 2,
            "chapter_id": 1
        },
        {
            "id": 2,
            "page": 3,
            "chapter_id": 1
        },
    ]
```
</details>

---
## Specific _*page*_

<summary>Request</summary>

`api/page/{id}`

    curl GET 'localhost:8000/api/page/2'

<details>
<summary>Response</summary>

```json
    {
        "id": 2,
        "page": 3,
        "chapter_id": 1
    }
```
</details>

---
## _*page*_: POST
<summary>Request</summary>

`api/page'

    curl POST 'localhost:8000/api/page'

```json
    {
        "page": 3,
        "chapter_id": 3
    }
```

<details>
<summary>Response</summary>

```json
    {
        "page": 3,
        "chapter_id": 3,
        "id": 5
    }
```
</details>

---
## _*page*_: PUT
<summary>Request</summary>

`api/page/{id}`

    curl PUT 'localhost:8000/api/page/5'

```json
    {
        "page": 2
    }
```

<details>
<summary>Response</summary>

```json
    {
        "id": 5,
        "page": 2,
        "chapter_id": 3
    }
```
</details>

---
## _*page*_: DELETE
<summary>Request</summary>

`api/page/{id}`

    curl DELETE 'localhost:8000/api/page/5

<summary>Response</summary>

    HTTP/1.1 204 No Content
    Date: Tue, 23 Feb 2022 13:36:35 GMT
    Status: 204 No Content
    Content-Type: application/json