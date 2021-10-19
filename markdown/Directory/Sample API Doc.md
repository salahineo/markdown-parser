# X Project API Doc

## Routes

### Plural Routes

`Basic routes to with different methods`

|Method|Route|Description|
|---|---|---|
|POST|`/posts`|Add new post|
|GET|`/posts`|Get all posts|
|GET|`/posts/1`|Get post with `id` = 1|
|PUT|`/posts/1`|Update post with `id` = 1|
|PATCH|`/posts/1`|Update post with `id` = 1|
|Delete|`/posts/1`|Delete post with `id` = 1|

### Singular Routes

`Applied if the top level property contains only one record of data`

|Method|Route|Description|
|---|---|---|
|GET|`/profile`|Get profile data|
|PUT|`/profile`|Update profile data|
|PATCH|`/profile`|Update profile data|

> As you see you can't delete a singular route, because it can't be empty. Reset it to its initial value using PUT instead of deleting it

### Nested Routes

`Get or create records of nested routes`

|Method|Route|Description|
|---|---|---|
|GET|`/posts/1/comments`|Get nested route records (by default one leve)|
|POST|`/posts/1/comments`|Create data with nested routes (by default one leve)|

###### Call API

## JS Handle

### Fetch Resources

`Fetch all records in the endpoint`

```js
// Get & Render Posts Method
const renderPosts = async () => {
  // The End-Point For Posts
  let url = " http://localhost:3000/posts";

  // Fetch Data Then Log It
  fetch(url)
  .then((response) => response.json())
  .then((data) => console.log(data));
};

// Wait For Content Of Page To Be Loaded Then Get Posts
window.addEventListener("DOMContentLoaded", () => renderPosts());
```
