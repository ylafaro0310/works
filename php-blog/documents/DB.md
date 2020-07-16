# DB定義

```uml
@startuml
entity "articles" as a {
    * id
    --
    * title
    * content
    * category_id
    * created_at
    * updated_at
} 

entity "comments" as co {
    * id
    --
    * articles_id
    * name
    * comment
    * created_at
    * updated_at
}

entity "categories" as ca {
    * id
    --
    * name
}

entity "tags" as t {
    * id
    --
    * name
}

entity "articles_tags" as at {
    * articles_id
    * tags_id
}

a ||--|| ca
a ||--o{ at
at }o--|| t
a ||--o{ co

@enduml
```