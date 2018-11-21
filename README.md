# Notes API built with CodeIgniter and Red Bean ORM

This API has been built to feed a Notes React app, where I will experiment with React Hooks and the Context API. I will link to the app here when it is ready.

Building this API has enabled me to better understand how other frameworks (besides Laravel) give you the tools to build REST APIs. 

The idea is inspired by [this](https://medium.freecodecamp.org/every-time-you-build-a-to-do-list-app-a-puppy-dies-505b54637a5d#a6c7) FreeCodeCamp blog post.

## What have I learned?

* How to integrate RedBean ORM (and other 3rd party libraries) with CodeIgniter 
* How to setup a REST API with CodeIgniter
* How to replicate Laravel's fillables functionality
* How to create one-to-many relationships with RedBean
* How to set up form validation

## What is next?

* Separate validation code from controllers with validation class
* Added date/time stamps to notes

## API endpoints

### Notes

#### Notes - GET

Retrieve all notes.

```
http://{baseURL}/notes/
```

#### Notes - GET a single note

Retrieve a single note.

```
http://{baseURL}/notes/note/id/{id}
```

#### Notes - GET notes for an Author
```
http://{baseURL}/notes/author/id/{id}
```

#### Notes - POST

Create a new note.

```
http://{baseURL}/notes/
```

```
{
	"title": "Noteworthy",
	"content": "This is such a great note.",
	"author_id": {id}
}
```

#### Notes - PUT 

Update an existing note.

```
http://{baseURL}/notes/note/id/{id}
```

```
{
	"title": "Noteworthy",
	"content": "This is an even better note.",
	"author_id": {id}
}
```

#### Notes - DELETE

Delete a single note.

```
http://{baseURL}/notes/note/id/{id}
```

### Authors

#### Authors - POST

Create an author.

```
http://{baseURL}/authors/
```

```
{
	"name": "Kye Buffery"
}
```