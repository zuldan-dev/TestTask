# Description 
Empty Laravel 9 project with GraphQL API. Current API displays product records with pagination.
## Requirements
* PHP 8.0 or higher.
* Composer 2.5 or higher
## Usage
1. `git clone https://github.com/zuldan-dev/TestTask.git .`
2. `composer install`
3. Run Laravel: `php artisan serve`
4. Path to API: `http://127.0.0.1:8000/graphql`
## GraphQL request structure
```
query {
  product( page: 1, count: 1 ) {
    current_page
    last_page
    per_page
    total
    data{
      name
      description
      price      
    }
  }
}
```
**Page** and **Count** arguments are integer variables 
