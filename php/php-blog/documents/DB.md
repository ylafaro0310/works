# DB定義

```uml
@startuml
entity "articles" as a {
    * id
    --
    * title
    * content
    * created_at
    * updated_at
} 
@enduml
```