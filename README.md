# sharedRedream
POC to study and practice API development with Laravel 8.x

The API simulates a crowdfunding bussiness:
- The user can ~~create an incident~~ share a dream
- The user needs to reedem a voucher to get money
- Once you get the money you can start to help others to realize their dreams
- Yeah, now you got the idea of sharedReDREAM :star2:

## How to test locally

- Clone the repository with __git clone__

- Go to the sub-folder `cd sharedRedream-apis`
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan migrate__
- Run __php artisan serve__

## API DOCS 

- After start the server access [SCRIBE DOCS](http://localhost:8000/docs)

## Feature Tests

- Few tests were created to check if the API behaves as expected as you can see in the results 
#### Test Results
![image](https://user-images.githubusercontent.com/17599235/166080373-ddb9d7d1-7ddd-4c48-a41b-5ce99a4e2856.png)
