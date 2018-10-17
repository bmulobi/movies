[![CircleCI](https://circleci.com/gh/bmulobi/movies/tree/develop.svg?style=svg)](https://circleci.com/gh/bmulobi/movies/tree/develop)
# Movies

## A simple Laravel CRUD API

- **App Url**
  - https://mulobi-movies.herokuapp.com/api
  
- **End Points**

   | Endpoint             |  Inputs           | type   |
   |-----|-----|-----|
   | https://mulobi-movies.herokuapp.com/api/register | name, email, password, password_confirmation | post (public) |
   | https://mulobi-movies.herokuapp.com/api/login| email, password | post (public)|
   | https://mulobi-movies.herokuapp.com/api/categories| none| get (private)|
   | https://mulobi-movies.herokuapp.com/api/category| name, description| post (private) |
   | https://mulobi-movies.herokuapp.com/api/category/{id} | id | get (private) |
   | https://mulobi-movies.herokuapp.com/api/category/{id} | id | put (private) |
   | https://mulobi-movies.herokuapp.com/api/category/{category}| category_id | delete (private) |
   | https://mulobi-movies.herokuapp.com/api/movies| none | get (private) |
   | https://mulobi-movies.herokuapp.com/api/movies/{categoryId}| categoryId | get (private) |
   | https://mulobi-movies.herokuapp.com/api/movie | title, description, actors (array), url (poster url jpg|png), popularity (int), category (category name) | post (private) |
   | https://mulobi-movies.herokuapp.com/api/movie/{movie}| movie (movie ID) | get (private) |
   | https://mulobi-movies.herokuapp.com/api/movie/{movie} | title, description, actors, url, popularity, category (at least one) | put (private) |
   | https://mulobi-movies.herokuapp.com/api/movie/{movie} | movie (the id) | delete (private) |
   | https://mulobi-movies.herokuapp.com/api/movies/actor/{actor} | actor (the name) | get (private) |
