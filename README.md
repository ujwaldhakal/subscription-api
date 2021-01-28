## Mobile Subscription Api
Api made on Php with Laravel framework for handling mobile subscription.

## Installation
* `clone this repo`
* `docker run --rm -v $(pwd):/app composer install`
* `cp .env.example .env`
* `chmod -R 777 storage`
* `docker-compose exec app php artisan key:generate`
* `curl localhost, you app is up and running`

## Project Architecture
In this project we are moving away from three layered architecture aka MVC one and trying to follow Clean Architecture where we could focus on capturing the Business Needs more clear. This architecture is similar to CQRS where i have named those read and write as action since
that way we could know what are the things domain could do or be doing. With this way it will be easier to talk with Domain Experts,Stackholder since i am trying to use exact phrases that doc is representing (in real life it will the things stackholders will talk about)

* App
    * Domains
      * Core
      * Device
      * Subscription
    
1) App -: Most things resides inside the app folder . As it encapsulates all domains,infrastructure (services & persistent logics) 
2) Domains -: This the most important part in this repo since it contains how the business will act upon certain data provided. So all our business domains will reside here creating a bounded context.
3) Core -: All reusable modules that can be used by every other domains.
4) Device -: All read, write are handled within Device. Things that related with Device & where the Device acts as the main actor will resides here.
5) Subscription -: All read, write are handled within Subscription. Things that related with Subscription & where the Subscription acts as the main actor will resides here.


## Api
I have used postman for the documentation where i excessively use curl for testing but i always prefer them via test (TDD Approach). And if you are lazy like me just https://www.postman.com/collections/bfa0b7f797ffa5aabeab here are the collection  just import on postman

## Assumptions
Several assumptions were made during code as the domain requirement was quite not clear and i had assumed things on my own since its a coding test where several skills matter like architecture,design,modules interaction,readable code etc. Here are things done on assumption -:
1) `There might be multiple register requests with the same uID.` I assumed that one is allowed register multiple device with same uid
2) On each registration a token has to be passed so i created a simple token on db itself to persist.
3) I have assumed that if the token is provided to Google & Ios service it will return expiry date
   from which we have to create a subscription.so i  havent mocked the real response of IOS & Android and just send an array expiry date if the last digit of token is an odd number.
4) For worker i assumed if the device doesnt have any subscription in susbcription table it is considered pending.
5) For reporting database i have considered new the current inserted record whose creation & update date are same


## Things that could have been done
* Intially integration test would be an ideal choice backing up by unit test for third part modules and create a CI/CD pipelines with github actions
  for running those tests
* DB can easily handle million request when keeping the indexing & introducing the reporting table where one cron would just project the data from any events & logs
  and finally we could scale horizontally if situation arises but most of the time caching, optimized query & reporting db would do the trick
* Logging so that we could send in some services like stackdriver / cloudwatch for debugging
* Could have fully gone with the CQRS but was more concern seperating out the bounded context
* For high traffic we could have adopt the option like serverless & kubernetes in future where load balancer will distribute the app load among servers
* Since the read and write has been seperated out it would be easier to cache the queries
* Event driven pattern could have been used since there are less things to do so i didnt think of over engineering them

