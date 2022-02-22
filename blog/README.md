# Catalog REST API on Lumen

## Endpoints
- [Creators](#creators-endpoint)
- [Genres](#genres-endpoint)
- [Statuses](#statuses-endpoint)
- [Titles](#titles-endpoint)
- [Chapters](#chapters-endpoint)
- [Pages](#pages-endpoint)

## Creators
- [Creators: Get](#creators-get)
- [Creators: Post](#creators-post)
- [Creators: Put](#creators-put)
- [Creators: Delete](#creators-delete)

## Creators: Get

### Request

`/api/creators`

    curl GET 'localhost:8000/api/authors'

### Response

<details>
<summary>Response</summary>

```json
    {
        "current_page": 1,
        "data": [
            {
                "id":1,
                "name": "",
                "info": "",
                "type": "",
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
